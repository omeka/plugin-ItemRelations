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
    
    public function findAllWithVocabularyData()
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irv' => $db->ItemRelationsVocabulary), 
                              'irp.vocabulary_id = irv.id', 
                              array('name', 'description', 
                                    'namespace_prefix', 'namespace_uri'));
        return $this->fetchObjects($select);
    }
    
    public function findByCustom()
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irv' => $db->ItemRelationsVocabulary), 
                              'irp.vocabulary_id = irv.id', 
                              array())
                       ->where('irv.name = ?', ItemRelationsVocabularyTable::CUSTOM_VOCABULARY_NAME);
        return $this->fetchObjects($select);
    }
}
