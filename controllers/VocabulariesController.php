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
        $vocabularies = $this->getTable('ItemRelationsVocabulary')->findAll();
        $this->view->vocabularies = $vocabularies;
    }
    
    public function showAction()
    {
        $vocabularyId = $this->_getParam('id');
        
        $vocabulary = $this->getTable('ItemRelationsVocabulary')->find($vocabularyId);
        $properties = $this->getTable('ItemRelationsProperty')->findByVocabularyId($vocabulary->id);
        
        $this->view->vocabulary = $vocabulary;
        $this->view->properties = $properties;
    }
    
    public function editCustomAction()
    {
        $properties = $this->getTable('ItemRelationsProperty')->findByCustom();
        $this->view->properties = $properties;
    }
}
