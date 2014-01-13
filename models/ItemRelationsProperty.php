<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Item Relations Property model.
 */
class ItemRelationsProperty extends Omeka_Record_AbstractRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $vocabulary_id;

    /**
     * Internal name for the property within its vocabulary.
     * @var string
     */
    public $local_part;

    /**
     * Human-readable name for the property.
     * @var string 
     */
    public $label;

    /**
     * Human-readable description for the property.
     * @var string
     */
    public $description;

    /**
     * Get a text representation of the property.
     *
     * The format of the representation is controlled by the
     * 'item_relations_relation_format' option.
     *
     * @return string
     */
    public function getText()
    {
        $hasPrefixLocalPart =
            (bool) $this->vocabulary_namespace_prefix && (bool) $this->local_part;
        $hasLabel = (bool) $this->label;

        if (get_option('item_relations_relation_format') == 'prefix_local_part'
            && $hasPrefixLocalPart
        ) {
            $text = $this->vocabulary_namespace_prefix . ':' . $this->local_part;
        } else if ($hasLabel) {
            $text = $this->label;
        } else {
            $text = __('[unknown]');
        }

        return $text;
    }
}
