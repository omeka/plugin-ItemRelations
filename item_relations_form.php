<p>
<?php
$link = '<a href="' . url('item-relations/vocabularies/') . '">'
      . __('Browse Vocabularies') . '</a>';

echo __('Here you can relate this item to another item and delete existing '
     . 'relations. For descriptions of the relations, see the %s page. Invalid '
     . 'item IDs will be ignored.', $link
);
?>
</p>
<table>
    <thead>
    <tr>
        <th><?php echo __('Subject'); ?></th>
        <th><?php echo __('Relation'); ?></th>
        <th><?php echo __('Object'); ?></th>
        <th><?php echo __('Delete'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subjectRelations as $subjectRelation): ?>
    <tr class="item-relations-entry">
        <td><?php echo __('This Item'); ?></td>
        <td><?php echo $subjectRelation['relation_text']; ?></td>
        <td><a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>" target="_blank"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $subjectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($objectRelations as $objectRelation): ?>
    <tr class="item-relations-entry">
        <td><a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>" target="_blank"><?php echo $objectRelation['subject_item_title']; ?></a></td>
        <td><?php echo $objectRelation['relation_text']; ?></td>
        <td><?php echo __('This Item'); ?></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $objectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <tr class="hidden item-relations-entry">
        <td><?php echo __('This Item'); ?><span class="item-relations-hidden"></span></td>
        <td class="item-relations-property"></td>
        <td class="item-relations-object"><a href="<?php echo url('items/show/'); ?>" target="_blank">.</a></td>
        <td><span style="color:#ccc;"><?php echo __("[n/a]") ?></span></td>
    </tr>
    </tbody>
</table>

<a href="#item-relation-selector" class="green button" data-lity><?php echo __('Add a Relation'); ?></a>

<?php
$db = get_db();
$sql = "SELECT id, name from {$db->Item_Types} ORDER BY id";
$itemtypes = $db->fetchAll($sql);
$m = array(
    '-1' => 'All',
);
foreach ($itemtypes as $type) {
    $m[$type['id']] = $type['name'];
}
?>
<div id="item-relation-selector" style="overflow: auto; padding: 20px; border-radius: 6px; background: #fff" class="lity-hide">
    <h2><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h2>

    <label for="new_relation_property_id"><?php echo __('This Item'); ?>: </label>
    <?php echo get_view()->formSelect('new_relation_property_id', null, array('multiple' => false), $formSelectProperties); ?><br>

    <p><label for="new_relation_object_item_type_id"><?php echo __('Item Types'); ?>: </label>
    <?php echo get_view()->formSelect('new_relation_object_item_type_id', null, array('multiple' => false), $m); ?></p>

    <p>
    <?php echo __('Item Sort'); ?>:
    <fieldset>
        <input type="radio" name="itemsListSort" id="new_selectObjectSortTimestamp" value="timestamp" checked>
        <label for="selectObjectSortTimeStamp">Most recently updated</label>

        <input type="radio" name="itemsListSort" id="new_selectObjectSortName" value="name">
        <label for="selectObjectSortName">Alphabetically</label>
    </fieldset>
    </p>

    <p><?php echo __('Object Title'); ?>: <span id="object_title"></span></p>
    <input id="new_relation_object_item_id" type="hidden">

    <label for="partial_object_title"><?php echo __('Partial Object Title'); ?>: </label>
    <input id="partial_object_title">

<br>
    <ul class="pagination">
      <li id="selector-previous-page" class="pg_disabled pagination_previous"><a href="#">&lt;</a></li>
      <li id="selector-next-page" class="pg_disabled pagination_next"><a href="#">&gt;</a></li>
    </ul>
<br>

    <ul id="lookup-results">
    </ul>

    <a href="#" id="add-relation" class="green button" data-lity-close><?php echo __('Add Relation'); ?></a>
</div>

<link href="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/lity/lity.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/lity/lity.min.js"></script>
<link href="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/item_relations_styles.css" rel="stylesheet">
<script type="text/javascript">
var url = '<?php echo url('item-relations/lookup/'); ?>';
</script>
<script type="text/javascript" src="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/item_relations_script.js"></script>
