<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('.item-relations-add-relation').click(function () {
        var oldDiv = jQuery('.item-relations-entry').last();
        var div = oldDiv.clone();
        oldDiv.parent().append(div);
        var inputs = div.find('input');
        var selects = div.find('select');
        inputs.val('');
        selects.val('');
    });
});
</script>
<div>
    <div class="item-relations-entry">This Item 
    <?php echo __v()->formSelect('item_relations_property_id[]', null, array('multiple' => false), $formSelectProperties); ?>
    Item ID <?php echo __v()->formText('item_relations_item_relation_object_item_id[]', null, array('size' => 8)); ?>
    </div>
</div>
<button type="button" class="item-relations-add-relation">Add Relation</button>
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
        <td><?php echo "{$subject->vocabulary_namespace_prefix}:{$subject->property_local_part}"; ?></td>
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
        <td><?php echo "{$object->vocabulary_namespace_prefix}:{$object->property_local_part}"; ?></td>
        <td>This Item</td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $object->id ?>" /></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>This item has no relations.</p>
<?php endif; ?>