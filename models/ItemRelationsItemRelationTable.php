<?php
class ItemRelationsItemRelationTable extends Omeka_Db_Table
{
    protected $_alias = 'irir';
    
    public function findBySubjectItemId($subjectItemId)
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irr' => $db->ItemRelationsRelation), 'irir.relation_id = irr.id')
                       ->where('irir.subject_item_id = ?', (int) $subjectItemId);
        return $this->fetchObjects($select);
    }
    
    public function findByObjectItemId($objectItemId)
    {
        $db = $this->getDb();
        $select = $this->getSelect()
                       ->join(array('irr' => $db->ItemRelationsRelation), 'irir.relation_id = irr.id')
                       ->where('irir.object_item_id = ?', (int) $objectItemId);
        return $this->fetchObjects($select);
    }
}