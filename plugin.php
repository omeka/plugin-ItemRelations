<?php
/*
Wish List:
  * custom relations
  * elegant selector for object items (instead of item ID; maybe use exhibit plugin?)
  * advanced search for subject/object relations
  * automate inverse property relations (e.g. replaces/isReplacedBy, part/part of)
*/

// Plugin hooks.
add_plugin_hook('install', 'ItemRelationsPlugin::install');
add_plugin_hook('uninstall', 'ItemRelationsPlugin::uninstall');
add_plugin_hook('after_save_form_record', 'ItemRelationsPlugin::afterSaveFormRecord');
add_plugin_hook('admin_append_to_items_show_secondary', 'ItemRelationsPlugin::adminAppendToItemsShowSecondary');
add_plugin_hook('admin_append_to_advanced_search', 'ItemRelationsPlugin::adminAppendToAdvancedSearch');
add_plugin_hook('item_browse_sql', 'ItemRelationsPlugin::itemBrowseSql');

// Plugin filters.
add_filter('admin_items_form_tabs', 'ItemRelationsPlugin::adminItemsFormTabs');
add_filter('admin_navigation_main', 'ItemRelationsPlugin::adminNavigationMain');

class ItemRelationsPlugin
{
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
        
        // Install the vocabularies and their properties.
        $vocabularies = include 'vocabularies.php';
        foreach ($vocabularies as $vocabulary) {
            $sql = "
            INSERT INTO `{$db->prefix}item_relations_vocabularies` (
                `name`, 
                `description`, 
                `namespace_prefix`, 
                `namespace_uri`
            ) VALUES (?, ?, ?, ?)";
            $db->query($sql, array($vocabulary['name'], 
                                   $vocabulary['description'], 
                                   $vocabulary['namespace_prefix'], 
                                   $vocabulary['namespace_uri']));
            $vocabularyId = $db->lastInsertId();
            
            foreach ($vocabulary['properties'] as $property) {
                $sql = "
                INSERT INTO `{$db->prefix}item_relations_properties` (
                    `vocabulary_id`, 
                    `local_part`, 
                    `label`, 
                    `description`
                ) VALUES (?, ?, ?, ?)";
                $db->query($sql, array($vocabularyId, 
                                       $property['local_part'], 
                                       $property['label'], 
                                       $property['description']));
            }
        }
    }
    
    public static function uninstall()
    {
        $db = get_db();
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_vocabularies`";
        $db->query($sql);
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_properties`";
        $db->query($sql);
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_item_relations`";
        $db->query($sql);
    }
    
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
    
    public static function adminAppendToItemsShowSecondary($item)
    {
        $db = get_db();
        
        $subjects = $db->getTable('ItemRelationsItemRelation')->findBySubjectItemId($item->id);
        $objects = $db->getTable('ItemRelationsItemRelation')->findByObjectItemId($item->id);
        include 'item_relations_secondary.php';
    }
    
    public static function adminItemsFormTabs($tabs, $item)
    {
        $tabs['Item Relations'] = self::itemRelationsFormContent($item);
        return $tabs;
    }
    
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
    
    public static function adminNavigationMain($nav)
    {
        $nav['Item Relations'] = uri('item-relations');
        return $nav;
    }
    
    public static function adminAppendToAdvancedSearch()
    {
        $formSelectProperties = self::getFormSelectProperties();
        include 'item_relations_advanced_search_form.php';
    }
    
    /**
     * Instead of one "Has Relation" form element, using two---"Is Subject Of" 
     * and "Is Object Of"---form elements would be more useful. Unfortunately, 
     * this is tricky because 1) Zend doesn't allow duplicate correlation names 
     * (table aliases), which complicates select object building; and 2) joining 
     * twice on the same table using different ON clauses does not replicate an
     * AND conditional (e.g. it will not select an item that is both a subject 
     * of AND an object of "isPartOf"). Will have to fine another way to perform 
     * this search operation.
     */
    public static function itemBrowseSql($select, $params)
    {
        $db = get_db();
        if (is_numeric($_GET['item_relations_property_id'])) {
            $select->join(array('irir' => $db->ItemRelationsItemRelation), 
                          'irir.subject_item_id = i.id', 
                          array())
                   ->where('irir.property_id = ?', $_GET['item_relations_property_id']);
        }
        return $select;
    }
    
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
