<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Item Relations Vocabulary table.
 */
class Table_ItemRelationsVocabulary extends Omeka_Db_Table
{
    /**
     * Get the default select object.
     * 
     * Automatically sorts the custom vocabulary to the top.
     * 
     * @return Omeka_Db_Select
     */
    public function getSelect()
    {
        return parent::getSelect()
            ->order('custom DESC');
    }
}
