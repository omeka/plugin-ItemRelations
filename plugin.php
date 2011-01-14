<?php
/*
Wish List:
  * more vocabularies
  * custom relations
  * break out vocabularies from relations (item_relations_vocabularies table containing Dublin Core, BIBO, etc.)
  * elegant selector for object items (instead of item ID; maybe use exhibit plugin?)
  * advanced search for subject/object relations
  * automate inverse property relations (e.g. replaces/isReplacedBy, part/part of)
  * assign RDF URIs to relation properties
*/

// Plugin hooks.
add_plugin_hook('install', 'ItemRelationsPlugin::install');
add_plugin_hook('uninstall', 'ItemRelationsPlugin::uninstall');
add_plugin_hook('after_save_form_record', 'ItemRelationsPlugin::afterSaveFormRecord');
add_plugin_hook('admin_append_to_items_show_secondary', 'ItemRelationsPlugin::adminAppendToItemsShowSecondary');

// Plugin filters.
add_filter('admin_items_form_tabs', 'ItemRelationsPlugin::adminItemsFormTabs');
add_filter('admin_navigation_main', 'ItemRelationsPlugin::adminNavigationMain');

class ItemRelationsPlugin
{
    // refinements of Dublin Core:relation and all their refinements
    // Add SIOC, SKOS, etc?
    public static $relations = array(
        // Dublin Core: http://dublincore.org/documents/dcmi-terms/
        'dcterms:relation' => 'A related resource.', 
        'dcterms:conformsTo' => 'An established standard to which the described resource conforms.', 
        'dcterms:hasFormat' => 'A related resource that is substantially the same as the pre-existing described resource, but in another format.', 
        'dcterms:hasPart' => 'A related resource that is included either physically or logically in the described resource.', 
        'dcterms:hasVersion' => 'A related resource that is a version, edition, or adaptation of the described resource.', 
        'dcterms:isFormatOf' => 'A related resource that is substantially the same as the described resource, but in another format.', 
        'dcterms:isPartOf' => 'A related resource in which the described resource is physically or logically included.', 
        'dcterms:isReferencedBy' => 'A related resource that references, cites, or otherwise points to the described resource.', 
        'dcterms:isReplacedBy' => 'A related resource that supplants, displaces, or supersedes the described resource.', 
        'dcterms:isRequiredBy' => 'A related resource that requires the described resource to support its function, delivery, or coherence.', 
        'dcterms:isVersionOf' => 'A related resource of which the described resource is a version, edition, or adaptation.', 
        'dcterms:references' => 'A related resource that is referenced, cited, or otherwise pointed to by the described resource.', 
        'dcterms:replaces' => 'A related resource that is supplanted, displaced, or superseded by the described resource.', 
        'dcterms:requires' => 'A related resource that is required by the described resource to support its function, delivery, or coherence.', 
        'dcterms:source' => 'A related resource from which the described resource is derived.', 
        // BIBO: http://bibotools.googlecode.com/svn/bibo-ontology/trunk/doc/index.html
        'bibo:annotates' => 'Critical or explanatory note for a Document.', 
        'bibo:citedBy' => 'Relates a document to another document that cites the first document.', 
        'bibo:cites' => 'Relates a document to another document that is cited by the first document as reference, comment, review, quotation or for another purpose.', 
        'bibo:reviewOf' => 'Relates a review document to a reviewed thing (resource, item, etc.).', 
        'bibo:reproducedIn' => 'The resource in which another resource is reproduced.', 
        'bibo:affirmedBy' => 'A legal decision that affirms a ruling.', 
        'bibo:reversedBy' => 'A legal decision that reverses a ruling.', 
        'bibo:subsequentLegalDecision' => 'A legal decision on appeal that takes action on a case (affirming it, reversing it, etc.).', 
        'bibo:transcriptOf' => 'Relates a document to some transcribed original.', 
        'bibo:translationOf' => 'Relates a translated document to the original document.', 
        // FOAF: http://xmlns.com/foaf/spec/
        'foaf:based_near' => 'A location that something is based near, for some broadly human notion of near.', 
        'foaf:depiction' => 'A depiction of some thing.', 
        'foaf:depicts' => 'A thing depicted in this representation. ', 
        'foaf:fundedBy' => 'An organization funding a project or person.', 
        'foaf:img' => 'An image that can be used to represent some thing (ie. those depictions which are particularly representative of something, eg. one\'s photo on a homepage).', 
        'foaf:isPrimaryTopicOf' => 'A document that this thing is the primary topic of.', 
        'foaf:knows' => 'A person known by this person (indicating some level of reciprocated interaction between the parties).', 
        'foaf:logo' => 'A logo representing some thing.', 
        'foaf:made' => 'Something that was made by this agent.', 
        'foaf:maker' => 'An agent that made this thing.', 
        'foaf:member' => 'Indicates a member of a Group.', 
        'foaf:page' => 'A page or document about this thing.', 
        'foaf:primaryTopic' => 'The primary topic of some page or document.', 
        'foaf:thumbnail' => 'A derived thumbnail image.', 
        // FRBR: http://vocab.org/frbr/core.html
        'frbr:abridgement' => 'A property representing an abridgment of an expression.', 
        'frbr:abridgementOf' => 'A property representing an expression that is abridged.', 
        'frbr:adaption' => 'A property representing an adaption of a work or expression.', 
        'frbr:adaptionOf' => 'A property representing a work or expression that is adapted.', 
        'frbr:alternate' => 'A property representing an alternative to a manifestation.', 
        'frbr:alternateOf' => 'A property representing a manifestation that is alternated.', 
        'frbr:arrangement' => 'A property representing an arrangement of an expression.', 
        'frbr:arrangementOf' => 'A property representing an expression that is arranged.', 
        'frbr:complement' => 'A property representing a complement to a work or expression.', 
        'frbr:complementOf' => 'A property representing a work or expression that is complemented.', 
        'frbr:creator' => 'A property representing an entity in some way responsible for the creation of a work.', 
        'frbr:creatorOf' => 'A property representing a work that was in some way created by of an entity.', 
        'frbr:embodiment' => 'A property representing a manifestation that embodies an expression.', 
        'frbr:embodimentOf' => 'A property representing an expression that is embodied by a manifestation.', 
        'frbr:exemplar' => 'A property representing an item that is an exemplar of a manifestation.', 
        'frbr:exemplarOf' => 'A property representing the manifestation that is exemplified by a item.', 
        'frbr:imitation' => 'A property representing an imitation of a work or expression.', 
        'frbr:imitationOf' => 'A property representing a work or expression that is imitated.', 
        'frbr:owner' => 'A property representing an entity that owns an item.', 
        'frbr:ownerOf' => 'A property representing an item that is in some way owned an entity.', 
        'frbr:part' => 'A property representing a part of an endeavour.', 
        'frbr:partOf' => 'A property representing an endeavour incorporating an endeavour.', 
        'frbr:producer' => 'A property representing an entity in some way responsible for producing a manifestation.', 
        'frbr:producerOf' => 'A property representing a manifestation that was in some way produced an entity.', 
        'frbr:realization' => 'A property representing an expression that is an intellectual or artistic realization of a work.', 
        'frbr:realizationOf' => 'A property representing the work that has been realized by an expression.', 
        'frbr:realizer' => 'A property representing an entity in some way responsible for realizing an expression.', 
        'frbr:realizerOf' => 'A property representing an expression that was in some way realized by an entity.', 
        'frbr:reconfiguration' => 'A property representing a recongifuration of an item.', 
        'frbr:reconfigurationOf' => 'A property representing an item that is reconfigured.', 
        'frbr:relatedEndeavour' => 'A property representing another endeavour that is related in some way to an endeavour.', 
        'frbr:reproduction' => 'A property representing a reproduction of a manifestation or item.', 
        'frbr:reproductionOf' => 'A property representing a manifestation or item that is reproduced.', 
        'frbr:responsibleEntity' => 'A property representing an entity in some way responsible for an endeavour.', 
        'frbr:responsibleEntityOf' => 'A property representing an endeavour that is the responsibility of an entity.', 
        'frbr:revision' => 'A property representing a revision of an expression.', 
        'frbr:revisionOf' => 'A property representing an expression that is revised.', 
        'frbr:successor' => 'A property representing a successor to a work or expression.', 
        'frbr:successorOf' => 'A property representing a work or expression that is succeeded.', 
        'frbr:summarization' => 'A property representing a summarization of a work or expression.', 
        'frbr:summarizationOf' => 'A property representing a work or expression that is summarized.', 
        'frbr:supplement' => 'A property representing a supplement to a work or expression.', 
        'frbr:supplementOf' => 'A property representing a work or expression that is supplemented.', 
        'frbr:transformation' => 'A property representing a transformation of a work or expression.', 
        'frbr:transformationOf' => 'A property representing a work or expression that is transformed.', 
        'frbr:translation' => 'A property representing a translation of an expression.', 
        'frbr:translationOf' => 'A property representing an expression that is translated.', 
    );
    
    public static function install()
    {
        $db = get_db();
        $sql = "
        CREATE TABLE `{$db->prefix}item_relations_relations` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `definition` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
        
        foreach (self::$relations as $name => $definition) {
            $sql = "INSERT INTO `{$db->prefix}item_relations_relations` (`name`, `definition`) VALUES (?, ?);";
            $db->query($sql, array($name, $definition));
        }
        
        $sql = "
        CREATE TABLE IF NOT EXISTS `{$db->prefix}item_relations_item_relations` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `subject_item_id` int(10) unsigned NOT NULL,
            `object_item_id` int(10) unsigned NOT NULL,
            `relation_id` int(10) unsigned NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
    }
    
    public static function uninstall()
    {
        $db = get_db();
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}item_relations_relations`";
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
        foreach ($post['item_relations_relation_id'] as $key => $relationId) {
            if (!is_numeric($relationId)) {
                continue;
            }
            
            $objectItem = $db->getTable('Item')->find($post['item_relations_item_relation_object_item_id'][$key]);
            // Don't save the relation if the object item doesn't exist.
            if (!$objectItem) {
                continue;
            }
            
            $itemRelation = new ItemRelationsItemRelation;
            $itemRelation->subject_item_id = $record->id;
            $itemRelation->object_item_id = $objectItem->id;
            $itemRelation->relation_id = $relationId;
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
        
        $relations = $db->getTable('ItemRelationsRelation')->findAll();
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
}
