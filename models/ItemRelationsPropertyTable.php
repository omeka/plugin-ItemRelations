<?php
class ItemRelationsPropertyTable extends Omeka_Db_Table
{
    protected $_alias = 'irp';
    
    public function findByVocabularyId($id)
    {
        $select = $this->getSelect();
        $select->where('vocabulary_id = ?', (int) $id);
        return $this->fetchObjects($select);
    }
}