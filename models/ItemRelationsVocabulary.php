<?php
require_once 'ItemRelationsVocabularyTable.php';
class ItemRelationsVocabulary extends Omeka_Record
{
    public $id;
    public $name;
    public $description;
    public $namespace_prefix;
    public $namespace_uri;
    public $custom;
}
