<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Vocabularies controller.
 */
class ItemRelations_VocabulariesController extends Omeka_Controller_AbstractActionController
{
    /**
     * Initialize the controller before each request.
     *
     * Set ItemRelationsVocabulary as the model for the controller.
     */
    public function init()
    {
        $this->_helper->db->setDefaultModelName('ItemRelationsVocabulary');
    }

    /**
     * Dummy add action.
     *
     * Vocabularies cannot be added through the UI.
     */
    public function addAction()
    {
        throw new Omeka_Controller_Exception_404;
    }

    /**
     * Edit action.
     */
    public function editAction()
    {
        $vocabulary = $this->_helper->db->findById();
        
        // Only custom vocabularies can be edited.
        if (!$vocabulary->custom) {
            throw new Omeka_Controller_Exception_404;
        }
        
        // Handle edit vocabulary form.
        if ($this->getRequest()->isPost()) {
            $this->_handleEditVocabularyForm($vocabulary->id);
            
            // Redirect to browse.
            $this->_helper->flashMessenger(__('The vocabulary was successfully edited.'), 'success');
            $this->_helper->redirector('browse');
            return;
        }
        
        $properties = $vocabulary->getProperties();
        $this->view->properties = $properties;
    }

    /**
     * Actually alter and save the vocabulary with the request data.
     * 
     * @param int $vocabularyId
     */
    protected function _handleEditVocabularyForm($vocabularyId)
    {
        // Edit existing properties.
        $propertyDescriptions = $this->_getParam('property_description');
        foreach ($propertyDescriptions as $propertyId => $propertyDescription) {
            $property = $this->_helper->db->getTable('ItemRelationsProperty')->find($propertyId);
            $property->description = $propertyDescription;
            $property->save();
        }
        
        // Add new properties.
        $newPropertyLabels = $this->_getParam('new_property_label');
        $newPropertyDescriptions = $this->_getParam('new_property_description');
        foreach ($newPropertyLabels as $key => $newPropertyLabel) {
            $newPropertyLabel = trim($newPropertyLabel);
            $newPropertyDescription = trim($newPropertyDescriptions[$key]);
            
            // Labels are required.
            if (!$newPropertyLabel) {
                continue;
            }
            
            // Labels must be unique.
            if ($this->_helper->db->getTable('ItemRelationsProperty')->findByLabel($newPropertyLabel)) {
                continue;
            }
            
            $newProperty = new ItemRelationsProperty;
            $newProperty->vocabulary_id = $vocabularyId;
            $newProperty->local_part = ''; // cannot be NULL
            $newProperty->label = $newPropertyLabel;
            $newProperty->description = $newPropertyDescription;
            $newProperty->save();
        }
        
        // Delete existing properties.
        $propertyDeletes = $this->_getParam('property_delete');
        foreach ($propertyDeletes as $propertyId => $propertyDelete) {
            if ($propertyDelete) {
                $this->_helper->db->getTable('ItemRelationsProperty')->find($propertyId)->delete();
            }
        }
    }
}
