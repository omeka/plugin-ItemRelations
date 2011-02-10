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
<?php if ($subjectRelations || $objectRelations): ?>
<table>
    <tr>
        <th>Subject</th>
        <th>Relation</th>
        <th>Object</th>
        <th>Delete?</th>
    </tr>
    <?php foreach ($subjectRelations as $subjectRelation): ?>
    <tr>
        <td>This Item</td>
        <td><?php echo $subjectRelation['relation_text']; ?></td>
        <td><a href="<?php echo uri('items/show/' . $subjectRelation['object_item_id']); ?>" target="_blank"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $subjectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($objectRelations as $objectRelation): ?>
    <tr>
        <td><a href="<?php echo uri('items/show/' . $objectRelation['subject_item_id']); ?>" target="_blank"><?php echo $objectRelation['subject_item_title']; ?></a></td>
        <td><?php echo $objectRelation['relation_text']; ?></td>
        <td>This Item</td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $objectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>This item has no relations.</p>
<?php endif; ?>