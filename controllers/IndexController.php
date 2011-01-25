<?php
class ItemRelations_IndexController extends Omeka_Controller_Action
{
    public function indexAction()
    {        
        $this->redirect->gotoSimple('browse', 'vocabularies');
        return;
    }
}
