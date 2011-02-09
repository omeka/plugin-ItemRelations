<?php
class ItemRelationsVocabularyTable extends Omeka_Db_Table
{
    protected $_alias = 'irv';
    
    /**
     * Finds all vocabularies beginning with custom ones.
     * 
     * @return array
     */
    public function findAllCustomFirst()
    {
        $select = $this->getSelect();
        
        $select->order('custom DESC');
        
        return $this->fetchObjects($select);
    }
}
