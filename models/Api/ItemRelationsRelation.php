<?php

class Api_ItemRelationsRelation extends Omeka_Record_Api_AbstractRecordAdapter
{

    // Get the REST representation of a record.
    public function getRepresentation(Omeka_Record_AbstractRecord $record)
    {
        // Return a PHP array, representing the passed record.
        $representation = array(
            'id' => $record->id,
            'subject_item_id' => $record->subject_item_id,
            'property_id' => $record->property_id,
            'object_item_id' => $record->object_item_id
        );

        return $representation;
    }

}