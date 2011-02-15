<?php
$head = array('title' => 'Edit Custom Vocabulary');
head($head);
?>
<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('#add-property').click(function () {
        var oldDiv = jQuery('.new-property').last();
        var div = oldDiv.clone();
        oldDiv.parent().append(div);
        var inputs = div.find('input');
        inputs.val('');
    });
});
</script>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<p>Here you can add, edit, and delete properties in your custom vocabulary. 
Property labels must be unique. You cannot edit property lables once they've 
been created, so make sure they're spelled correctly and convey the exact 
relation you want them to convey.</p>
<form method="post">
<table>
    <thead>
        <tr>
            <th>Label</th>
            <th>Description</th>
            <th>Delete?</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->properties as $property): ?>
        <tr>
            <td><?php echo $property->label; ?></td>
            <td><?php echo __v()->formTextarea("property_description[{$property->id}]", $property->description, array('cols' => 50, 'rows' => 2)); ?></td>
            <td><?php echo __v()->formCheckbox("property_delete[{$property->id}]") ?></td>
        </tr>
<?php endforeach; ?>
        <tr class="new-property">
            <td><?php echo __v()->formText("new_property_label[]", null, array('size' => 30)); ?></td>
            <td><?php echo __v()->formTextarea("new_property_description[]", null, array('cols' => 50, 'rows' => 2)); ?></td>
            <td><span style="color:#ccc;">n/a</span></td>
        </tr>
    </tbody>
</table>
<?php echo __v()->formButton('add_property', 'Add a Property', array('id' => 'add-property')); ?>
<?php echo __v()->formSubmit('submit_edit_vocabulary', 'Submit', array('class' => 'submit submit-medium')); ?>
</form>
</div>
<?php foot(); ?>