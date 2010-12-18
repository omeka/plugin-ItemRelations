<?php
/*
Wish List:
  * more vocabularies
  * custom relations
  * break out vocabularies from relations (item_relations_vocabularies table containing Dublin Core, BIBO, etc.)
  * elegant selector for object items (instead of item ID; maybe use exhibit plugin?)
*/

// Plugin hooks.
add_plugin_hook('install', 'ItemRelationsPlugin::install');
add_plugin_hook('uninstall', 'ItemRelationsPlugin::uninstall');
add_plugin_hook('after_save_form_record', 'ItemRelationsPlugin::afterSaveFormRecord');
add_plugin_hook('admin_append_to_items_show_secondary', 'ItemRelationsPlugin::adminAppendToItemsShowSecondary');

// Plugin filters.
add_filter('admin_items_form_tabs', 'ItemRelationsPlugin::adminItemsFormTabs');

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
    );
    
    public static function install()
    {
        $db = get_db();
        $sql = "
        CREATE TABLE `{$db->prefix}item_relations_relations` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $db->query($sql);
        
        foreach (self::$relations as $name => $description) {
            $sql = "INSERT INTO `{$db->prefix}item_relations_relations` (`name`, `description`) VALUES (?, ?);";
            $db->query($sql, array($name, $description));
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
            $itemRelation = new ItemRelationsItemRelation;
            $itemRelation->subject_item_id = $record->id;
            $itemRelation->object_item_id = $post['item_relations_item_relation_object_item_id'][$key];
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
?>
<div class="info-panel">
    <h2>Item Relations</h2>
    <div>
        <?php if ($subjects || $objects): ?>
        <ul>
            <?php foreach ($subjects as $subject): ?>
            <?php
            $title = item('Dublin Core', 'Title', array(), get_item_by_id($subject->object_item_id));
            if (!$title) {
                $title = $subject->object_item_id;
            }
            ?>
            <li>This Item <strong><?php echo $subject->name; ?></strong> <a href="<?php echo uri('items/show/' . $subject->object_item_id); ?>" target="_blank"><?php echo $title; ?></a></li>
            <?php endforeach; ?>
            <?php foreach ($objects as $object): ?>
            <?php
            $title = item('Dublin Core', 'Title', array(), get_item_by_id($object->subject_item_id));
            if (!$title) {
                $title = $object->subject_item_id;
            }
            ?>
            <li><a href="<?php echo uri('items/show/' . $object->subject_item_id); ?>" target="_blank"><?php echo $title; ?></a> <strong><?php echo $object->name; ?></strong> This Item</li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>This item has no relations.</p>
        <?php endif; ?>
    </div>
</div>
<?php
    }
    
    public static function adminItemsFormTabs($tabs, $item)
    {
        $tabContent = '';
        $tabContent .= self::itemRelationsFormScripts();
        $tabContent .= self::itemRelationsFormContent($item);
        $tabs['Item Relations'] = $tabContent;
        return $tabs;
    }
    
    // Put "Add Relation" JavaScript here.
    public static function itemRelationsFormScripts()
    {
        return '';
    }
    
    public static function itemRelationsFormContent($item)
    {
        $db = get_db();
        
        $relations = $db->getTable('ItemRelationsRelation')->findAll();
        $subjects = $db->getTable('ItemRelationsItemRelation')->findBySubjectItemId($item->id);
        $objects = $db->getTable('ItemRelationsItemRelation')->findByObjectItemId($item->id);
        
        ob_start();
?>
<p>This Item 
<select name="item_relations_relation_id[]">
    <option value="">Select below...</option>
    <?php foreach ($relations as $relation): ?>
    <option value="<?php echo $relation->id; ?>"><?php echo $relation->name; ?></option>
    <?php endforeach; ?>
</select> 
Item ID <input type="text" name="item_relations_item_relation_object_item_id[]" size="8" /></p>
<?php if ($subjects || $objects): ?>
<table>
    <tr>
        <th>Subject</th>
        <th>Relation</th>
        <th>Object</th>
        <th>Delete?</th>
    </tr>
    <?php foreach ($subjects as $subject): ?>
    <?php
    $title = item('Dublin Core', 'Title', array(), get_item_by_id($subject->object_item_id));
    if (!$title) {
        $title = $subject->object_item_id;
    }
    ?>
    <tr>
        <td>This Item</td>
        <td><?php echo $subject->name; ?></td>
        <td><a href="<?php echo uri('items/show/' . $subject->object_item_id); ?>" target="_blank"><?php echo $title; ?></a></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $subject->id ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($objects as $object): ?>
    <?php
    $title = item('Dublin Core', 'Title', array(), get_item_by_id($object->subject_item_id));
    if (!$title) {
        $title = $object->subject_item_id;
    }
    ?>
    <tr>
        <td><a href="<?php echo uri('items/show/' . $object->subject_item_id); ?>" target="_blank"><?php echo $title; ?></a></td>
        <td><?php echo $object->name; ?></td>
        <td>This Item</td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $object->id ?>" /></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>This item has no relations.</p>
<?php endif; ?>
<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
