<?php
/*
Wish List:
  * elegant selector for object items, instead of item ID; maybe use exhibit plugin?
  * automate inverse property relations, e.g. replaces/isReplacedBy, part/part of
*/

// Plugin hooks.
add_plugin_hook('install', 'ItemRelationsPlugin::install');
add_plugin_hook('uninstall', 'ItemRelationsPlugin::uninstall');
add_plugin_hook('config_form', 'ItemRelationsPlugin::configForm');
add_plugin_hook('config', 'ItemRelationsPlugin::config');
add_plugin_hook('after_save_form_record', 'ItemRelationsPlugin::afterSaveFormRecord');
add_plugin_hook('admin_append_to_items_show_secondary', 'ItemRelationsPlugin::adminAppendToItemsShowSecondary');
add_plugin_hook('public_append_to_items_show', 'ItemRelationsPlugin::publicAppendToItemsShow');
add_plugin_hook('admin_append_to_advanced_search', 'ItemRelationsPlugin::adminAppendToAdvancedSearch');
add_plugin_hook('item_browse_sql', 'ItemRelationsPlugin::itemBrowseSql');

// Plugin filters.
add_filter('admin_items_form_tabs', 'ItemRelationsPlugin::adminItemsFormTabs');
add_filter('admin_navigation_main', 'ItemRelationsPlugin::adminNavigationMain');

function item_relations_display_item_relations(Item $item)
{
    $db = get_db();
    $subjects = $db->getTable('ItemRelationsItemRelation')->findBySubjectItemId($item->id);
    $objects = $db->getTable('ItemRelationsItemRelation')->findByObjectItemId($item->id);
    include 'public_items_show.php';
}

class ItemRelationsPlugin
{
    /**
     * Install the plugin.
     */
    public static function install()
    {
        $db = get_db();
        $sql = "
        CREATE TABLE `{$db->prefix}item_relations_vocabularies` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `description` text,
            `namespace_prefix` varchar(100) NOT NULL,
            `namespace_uri` varchar(200) DEFAULT NULL,
            `custom` BOOLEAN NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
        
        $sql = "
        CREATE TABLE `{$db->prefix}item_relations_properties` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `vocabulary_id` int(10) unsigned NOT NULL,
            `local_part` varchar(100) NOT NULL,
            `label` varchar(100) DEFAULT NULL,
            `description` text,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
        
        $sql = "
        CREATE TABLE `{$db->prefix}item_relations_item_relations` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `subject_item_id` int(10) unsigned NOT NULL,
            `property_id` int(10) unsigned NOT NULL,
            `object_item_id` int(10) unsigned NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
        
        // Install the formal vocabularies and their properties.
        $formalVocabularies = include 'formal_vocabularies.php';
        foreach ($formalVocabularies as $formalVocabulary) {
            $vocabulary = new ItemRelationsVocabulary;
            $vocabulary->name = $formalVocabulary['name'];
            $vocabulary->description = $formalVocabulary['description'];
            $vocabulary->namespace_prefix = $formalVocabulary['namespace_prefix'];
            $vocabulary->namespace_uri = $formalVocabulary['namespace_uri'];
            $vocabulary->custom = 0;
            $vocabulary->save();
            
            $vocabularyId = $db->lastInsertId();
            
            foreach ($formalVocabulary['properties'] as $formalProperty) {
                $property = new ItemRelationsProperty;
                $property->vocabulary_id = $vocabularyId;
                $property->local_part = $formalProperty['local_part'];
                $property->label = $formalProperty['label'];
                $property->description = $formalProperty['description'];
                $property->save();
            }
        }
        
        // Install a custom vocabulary.
        $customVocabulary = new ItemRelationsVocabulary;
        $customVocabulary->name = 'Custom';
        $customVocabulary->description = 'Custom relations defined for this Omeka instance.';
        $customVocabulary->namespace_prefix = ''; // cannot be NULL
        $customVocabulary->namespace_uri = null;
        $customVocabulary->custom = 1;
        $customVocabulary->save();
    }
    
    /**
     * Uninstall the plugin.
     */
    public static function uninstall()
    {
        $db = get_db();
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_vocabularies`";
        $db->query($sql);
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_properties`";
        $db->query($sql);
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_item_relations`";
        $db->query($sql);
        
        delete_option('item_relations_public_append_to_items_show');
    }
    
    /**
     * Display the plugin configuration form.
     */
    public static function configForm()
    {
        include 'config_form.php';
    }
    
    /**
     * Handle the plugin configuration form.
     * 
     * @param array $params
     */
    public static function config($params)
    {
        set_option('item_relations_public_append_to_items_show', 
                   $params['item_relations_public_append_to_items_show']);
    }
    
    /**
     * Save the item relations after saving an item add/edit form.
     * 
     * @param Omeka_Record $record
     * @param array $post
     */
    public static function afterSaveFormRecord($record, $post)
    {
        $db = get_db();
        
        if (!($record instanceof Item)) {
            return;
        }
        
        // Save item relations.
        foreach ($post['item_relations_property_id'] as $key => $propertyId) {
            if (!is_numeric($propertyId)) {
                continue;
            }
            
            $objectItem = $db->getTable('Item')->find($post['item_relations_item_relation_object_item_id'][$key]);
            
            // Don't save the relation if the object item doesn't exist.
            if (!$objectItem) {
                continue;
            }
            
            $itemRelation = new ItemRelationsItemRelation;
            $itemRelation->subject_item_id = $record->id;
            $itemRelation->property_id = $propertyId;
            $itemRelation->object_item_id = $objectItem->id;
            $itemRelation->save();
        }
        
        // Delete item relations.
        if (isset($post['item_relations_item_relation_delete'])) {
            foreach ($post['item_relations_item_relation_delete'] as $itemRelationId) {
                $itemRelation = $db->getTable('ItemRelationsItemRelation')->find($itemRelationId);
                $itemRelation->delete();
            }
        }
    }
    
    /**
     * Display item relations on the admin items show page.
     */
    public static function adminAppendToItemsShowSecondary($item)
    {
        $db = get_db();
        
        $subjects = $db->getTable('ItemRelationsItemRelation')->findBySubjectItemId($item->id);
        $objects = $db->getTable('ItemRelationsItemRelation')->findByObjectItemId($item->id);
        include 'item_relations_secondary.php';
    }
    
    /**
     * Display item relations on the public items show page.
     */
    public static function publicAppendToItemsShow()
    {
        if ('1' == get_option('item_relations_public_append_to_items_show')) {
            $item = get_current_item();
            item_relations_display_item_relations($item);
        }
    }
    
    /**
     * Add the "Item Relations" tab to the admin items add/edit page.
     * 
     * @return array
     */
    public static function adminItemsFormTabs($tabs, $item)
    {
        $tabs['Item Relations'] = self::itemRelationsFormContent($item);
        return $tabs;
    }
    
    /**
     * Return the content of the "Item Relations" form.
     * 
     * @param Item $item
     * @return string
     */
    public static function itemRelationsFormContent($item)
    {
        $db = get_db();
        
        $formSelectProperties = self::getFormSelectProperties();
        
        $subjects = $db->getTable('ItemRelationsItemRelation')->findBySubjectItemId($item->id);
        $objects = $db->getTable('ItemRelationsItemRelation')->findByObjectItemId($item->id);
        
        ob_start();
        include 'item_relations_form.php';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    /**
     * Add the "Item Relations" tab to the admin navigation.
     * 
     * @param array $nav
     * @return array
     */
    public static function adminNavigationMain($nav)
    {
        $nav['Item Relations'] = uri('item-relations');
        return $nav;
    }
    
    /**
     * Display the item relations form on the admin advanced search page.
     */
    public static function adminAppendToAdvancedSearch()
    {
        $formSelectProperties = self::getFormSelectProperties();
        include 'advanced_search_form.php';
    }
    
    /**
     * Filter for an item relation after search page submission.
     * 
     * @param Omeka_Db_Select $select
     * @param array $params
     * @return Omeka_Db_Select
     */
    public static function itemBrowseSql($select, $params)
    {
        if (is_numeric($_GET['item_relations_property_id'])) {
            $db = get_db();
            // Set the field on which to join.
            if ($_GET['item_relations_clause_part'] == 'subject') {
                $onField = 'subject_item_id';
            } else {
                $onField = 'object_item_id';
            }
            $select->join(array('irir' => $db->ItemRelationsItemRelation), 
                          "irir.$onField = i.id", 
                          array())
                   ->where('irir.property_id = ?', $_GET['item_relations_property_id']);
        }
        return $select;
    }
    
    /**
     * Prepare an array for formSelect().
     * 
     * @return array
     */
    public static function getFormSelectProperties()
    {
        $db = get_db();
        $properties = $db->getTable('ItemRelationsProperty')->findAllWithVocabularyData();
        $formSelectProperties = array('' => 'Select below...');
        foreach ($properties as $property) {
            $formSelectProperties[$property->name][$property->id] = $property->local_part;
        }
        return $formSelectProperties;
    }
}
