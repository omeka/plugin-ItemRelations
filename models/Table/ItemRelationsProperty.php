<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Item Relations Property table.
 */
class Table_ItemRelationsProperty extends Omeka_Db_Table
{
    /**
     * Get the default select object.
     *
     * Automatically join with Vocabulary table to get vocab data for properties
     * and put custom properties first.
     *
     * @return Omeka_Db_Select
     */
    public function getSelect()
    {
        return parent::getSelect()
            ->join(
                array('item_relations_vocabularies' => $this->getDb()->ItemRelationsVocabulary),
                'item_relations_properties.vocabulary_id = item_relations_vocabularies.id',
                array(
                    'vocabulary_name' => 'name',
                    'vocabulary_description' => 'description',
                    'vocabulary_namespace_prefix' => 'namespace_prefix',
                    'vocabulary_namespace_uri' => 'namespace_uri'
                )
            )
            ->order('custom DESC')->order('name ASC')->order('label ASC');
    }

    /**
     * Find properties by vocabulary.
     * 
     * @param int $id The vocabulary ID.
     * @return array
     */
    public function findByVocabularyId($id)
    {
        $select = $this->getSelect();
        
        $select->where('vocabulary_id = ?', (int) $id)
               ->reset(Zend_Db_Select::ORDER)
               ->order('id');
        
        return $this->fetchObjects($select);
    }

    /**
     * Find properties by label.
     *
     * @param string $label The label to search for.
     * @return array
     */
    public function findByLabel($label)
    {
        $select = $this->getSelect();
        $select->where('label = ?', $label);
        return $this->fetchObjects($select);
    }

    /**
     * Get an array of property data for populating a SELECT element.
     *
     * Returns an array of property texts indexed by vocabulary name,
     * then property ID.
     *
     * @param array $options Search options, ignored.
     * @return array
     */
    public function findPairsForSelectForm(array $options = array())
    {
        $pairs = array();
        $properties = $this->findAll();

        foreach ($properties as $property) {
            $pairs[$property->vocabulary_name][$property->id] =
                $property->getText();
        }

        return $pairs;
    }
}
