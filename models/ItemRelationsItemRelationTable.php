<?php
class ItemRelationsItemRelationTable extends Omeka_Db_Table
{
    protected $_alias = 'irir';
    
    /**
     * Finds all item relations by subject item ID.
     * 
     * @return array
     */
    public function findBySubjectItemId($subjectItemId)
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irp' => $db->ItemRelationsProperty), 
                              'irir.property_id = irp.id', 
                              array('property_vocabulary_id' => 'vocabulary_id', 
                                    'property_local_part' => 'local_part', 
                                    'property_label' => 'label', 
                                    'property_description' => 'description'))
                       ->join(array('irv' => $db->ItemRelationsVocabulary), 
                              'irp.vocabulary_id = irv.id', 
                              array('vocabulary_namespace_prefix' => 'namespace_prefix'))
                       ->where('irir.subject_item_id = ?', (int) $subjectItemId);
        return $this->fetchObjects($select);
    }
    
    /**
     * Finds all item relations by object item ID.
     * 
     * @return array
     */
    public function findByObjectItemId($objectItemId)
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irp' => $db->ItemRelationsProperty), 
                              'irir.property_id = irp.id', 
                              array('property_vocabulary_id' => 'vocabulary_id', 
                                    'property_local_part' => 'local_part', 
                                    'property_label' => 'label', 
                                    'property_description' => 'description'))
                       ->join(array('irv' => $db->ItemRelationsVocabulary), 
                              'irp.vocabulary_id = irv.id', 
                              array('vocabulary_namespace_prefix' => 'namespace_prefix'))
                       ->where('irir.object_item_id = ?', (int) $objectItemId);
        return $this->fetchObjects($select);
    }
}
