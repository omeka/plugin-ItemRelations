<?php
class ItemRelations_VocabulariesController extends Omeka_Controller_Action
{
    public function indexAction()
    {        
        $this->redirect->gotoSimple('browse');
        return;
    }
    
    public function browseAction()
    {
        $vocabularies = $this->getTable('ItemRelationsVocabulary')->findAllCustomFirst();
        $this->view->vocabularies = $vocabularies;
    }
    
    public function showAction()
    {
        $vocabularyId = $this->_getParam('id');
        
        $vocabulary = $this->getTable('ItemRelationsVocabulary')->find($vocabularyId);
        $properties = $this->getTable('ItemRelationsProperty')->findByVocabularyId($vocabularyId);
        
        $this->view->vocabulary = $vocabulary;
        $this->view->properties = $properties;
    }
    
    public function editAction()
    {
        $vocabularyId = $this->_getParam('id');
        
        // Only custom vocabularies can be edited.
        $vocabulary = $this->getTable('ItemRelationsVocabulary')->find($vocabularyId);
        if (!$vocabulary->custom) {
            $this->redirect->gotoSimple('browse');
        }
        
        $properties = $this->getTable('ItemRelationsProperty')->findByVocabularyId($vocabularyId);
        $this->view->properties = $properties;
    }
}
