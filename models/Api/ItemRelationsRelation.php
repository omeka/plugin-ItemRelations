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
        $subject=get_record_by_id('item',$record->subject_item_id);
        $object=get_record_by_id('item',$record->object_item_id);
        
        return array(
            'id' => $record->id,
            'subject' => array(
                'id' => $record->subject_item_id,
                'url' => self::getResourceUrl("/items/{$record->subject_item_id}"),
                'title' => ItemRelationsPlugin::getItemTitle($subject),
                'resource' => 'items',
            ),
            'relation' => array(
                'id' => $record->property_id,
                'term' => $term,
                'label' => $record->property_label,
                'vocabulary' => $record->vocabulary_name,
            ),
            'object' => array(
                'id' => $record->object_item_id,
                'url' => self::getResourceUrl("/items/{$record->object_item_id}"),
                'title' => ItemRelationsPlugin::getItemTitle($object),
                'resource' => 'items',
            ),
        );
    }
}
