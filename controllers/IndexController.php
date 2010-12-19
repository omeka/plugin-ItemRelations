<?php
class ItemRelations_IndexController extends Omeka_Controller_Action
{
    public function indexAction()
    {        
        $relations = $this->getTable('ItemRelationsRelation')->findAll();
        $this->view->relations = $relations;
    }
}
