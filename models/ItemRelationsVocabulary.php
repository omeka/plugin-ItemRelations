<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Item Relations Vocabulary model.
 */
class ItemRelationsVocabulary extends Omeka_Record_AbstractRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * Human-readable name of the vocabulary.
     * @var string
     */
    public $name;

    /**
     * Human-readable description of the vocabulary.
     * @var string
     */
    public $description;

    /**
     * Namespace prefix for the vocabulary.
     * @var string
     */
    public $namespace_prefix;

    /**
     * Namespace URI for the vocabulary.
     * @var string
     */
    public $namespace_uri;

    /**
     * Whether the vocabulary is the custom vocabulary.
     * @var int
     */
    public $custom;

    /**
     * Get the properties for this vocabulary.
     *
     * @return array An array of ItemRelationsProperty objects.
     */
    public function getProperties()
    {
        if (!$this->id) {
            return array();
        }

        return $this->getDb()->getTable('ItemRelationsProperty')->findByVocabularyId($this->id);
    }
}
