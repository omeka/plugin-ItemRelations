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
<p>Here you can relate this item to another item and delete existing relations. For descriptions of the relations go to the <a href="<?php echo uri('item-relations/vocabularies/'); ?>">Browse Vocabularies</a> page. Invalid item IDs will be ignored.</p>
<table>
    <thead>
    <tr>
        <th>Subject</th>
        <th>Relation</th>
        <th>Object</th>
        <th>Delete?</th>
    </tr>
    </thead>
    <tbody>
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
    <tr class="item-relations-entry">
        <td>This Item</td>
        <td><?php echo __v()->formSelect('item_relations_property_id[]', null, array('multiple' => false), $formSelectProperties); ?></td>
        <td>Item ID <?php echo __v()->formText('item_relations_item_relation_object_item_id[]', null, array('size' => 8)); ?></td>
        <td><span style="color:#ccc;">n/a</span></td>
    </tr>
    </tbody>
</table>
<button type="button" class="item-relations-add-relation">Add a Relation</button>