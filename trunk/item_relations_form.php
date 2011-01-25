<div>
    <div class="item-relations-entry">This Item 
    <select name="item_relations_relation_id[]">
        <option value="">Select below...</option>
        <?php foreach ($relations as $relation): ?>
        <option value="<?php echo $relation->id; ?>"><?php echo $relation->name; ?></option>
        <?php endforeach; ?>
    </select> 
    Item ID <input type="text" name="item_relations_item_relation_object_item_id[]" size="8" />
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
<?php echo js('item_relations'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.ItemRelations.activateItemRelationButtons();
    });
</script>