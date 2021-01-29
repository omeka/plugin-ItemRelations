<?php

/**
 * API record adapter for item relations
 */
class Api_ItemRelationsRelation extends Omeka_Record_Api_AbstractRecordAdapter
{
    public function getRepresentation(Omeka_Record_AbstractRecord $record)
    {
        $term = $record->vocabulary_namespace_prefix . ':' . $record->property_local_part;
        if ($term == ':') {
            $term = null;
        }
        return array(
            'subject' => array(
                'id' => $record->subject_item_id,
                'url' => self::getResourceUrl("/items/{$record->subject_item_id}"),
                'resource' => 'items',
            ),
            'relation' => array(
                'term' => $term,
                'label' => $record->property_label,
                'vocabulary' => $record->vocabulary_name,
            ),
            'object' => array(
                'id' => $record->object_item_id,
                'url' => self::getResourceUrl("/items/{$record->object_item_id}"),
                'resource' => 'items',
            ),
        );
    }
}
