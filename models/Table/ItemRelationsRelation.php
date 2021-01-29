<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Item Relations Relation table.
 */
class Table_ItemRelationsRelation extends Omeka_Db_Table
{
    /**
     * Get the default select object.
     *
     * Automatically join with both Property and Vocabulary to get all the
     * data necessary to describe a whole relation.
     *
     * @return Omeka_Db_Select
     */
    public function getSelect()
    {
        $db = $this->getDb();
        $select = parent::getSelect()
            ->join(
                array('item_relations_properties' => $db->ItemRelationsProperty),
                'item_relations_relations.property_id = item_relations_properties.id',
                array(
                    'property_vocabulary_id' => 'vocabulary_id',
                    'property_local_part' => 'local_part',
                    'property_label' => 'label',
                    'property_description' => 'description'
                )
            )
            ->join(
                array('item_relations_vocabularies' => $db->ItemRelationsVocabulary),
                'item_relations_properties.vocabulary_id = item_relations_vocabularies.id',
                array(
                    'vocabulary_namespace_prefix' => 'namespace_prefix',
                    'vocabulary_name' => 'name',
                )
            );

        // Filter by item permission for both subject and object
        // When searching/browsing, only relations where both sides are visible
        // to the current user will be shown.
        $select->joinInner(array('item_relations_subjects' => $db->Item), 'item_relations_subjects.id = item_relations_relations.subject_item_id', array());
        $subjectPermissions = new Omeka_Db_Select_PublicPermissions('Items');
        $subjectPermissions->apply($select, 'item_relations_subjects');

        $select->joinInner(array('item_relations_objects' => $db->Item), 'item_relations_objects.id = item_relations_relations.object_item_id', array());
        $objectPermissions = new Omeka_Db_Select_PublicPermissions('Items');
        $objectPermissions->apply($select, 'item_relations_objects');

        return $select;
    }

    /**
     * Handle findBy/count searching for item relations
     *
     * Supports subject_id, object_id, item_id parameters
     */
    public function applySearchFilters($select, $params)
    {
        if (isset($params['subject_id'])) {
            $this->filterBySubjectItemId($select, $params['subject_id']);
        }
        if (isset($params['object_id'])) {
            $this->filterByObjectItemId($select, $params['object_id']);
        }
        if (isset($params['item_id'])) {
            $this->filterByItemId($select, $params['item_id']);
        }
    }

    /**
     * Find item relations by subject item ID.
     *
     * @return array
     */
    public function findBySubjectItemId($subjectItemId)
    {
        $select = $this->getSelect();
        $this->filterBySubjectItemId($select, $subjectItemId);
        return $this->fetchObjects($select);
    }
    
    /**
     * Find item relations by object item ID.
     *
     * @return array
     */
    public function findByObjectItemId($objectItemId)
    {
        $select = $this->getSelect();
        $this->filterByObjectItemId($select, $objectItemId);
        return $this->fetchObjects($select);
    }

    /**
     * Filter a select by subject item id
     *
     * @param Omeka_Db_Select $select
     * @param mixed $subjectItemId
     */
    public function filterBySubjectItemId($select, $subjectItemId)
    {
        $select->where('item_relations_relations.subject_item_id = ?', (int) $subjectItemId);
    }

    /**
     * Filter a select by object item id
     *
     * @param Omeka_Db_Select $select
     * @param mixed $objectItemId
     */
    public function filterByObjectItemId($select, $objectItemId)
    {
        $select->where('item_relations_relations.object_item_id = ?', (int) $objectItemId);
    }

    /**
     * Filter a select by item id as either subject or object
     *
     * @param Omeka_Db_Select $select
     * @param mixed $itemId
     */
    public function filterByItemId($select, $itemId)
    {
        $select->where('item_relations_relations.subject_item_id = ? OR item_relations_relations.object_item_id = ?',
            (int) $itemId, (int) $itemId);
    }
}
