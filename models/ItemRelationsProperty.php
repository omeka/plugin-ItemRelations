<?php
require_once 'ItemRelationsPropertyTable.php';
class ItemRelationsProperty extends Omeka_Record
{
    public $id;
    public $vocabulary_id;
    public $local_part;
    public $label;
    public $description;
}
