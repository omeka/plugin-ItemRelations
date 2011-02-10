<?php
$head = array('title' => html_escape('Edit Custom Vocabulary'));
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
<form method="post">
<h2>Edit Existing Properties</h2>
<?php if (!$this->properties): ?>
<p>This vocabulary has no properties.</p>
<?php else: ?>
<?php foreach ($this->properties as $property): ?>
<div><?php echo $property->label; ?> <?php echo __v()->formText("property_description[{$property->id}]", $property->description, null); ?><?php echo __v()->formCheckbox("property_delete[{$property->id}]") ?>Delete</div>
<?php endforeach; ?>
<?php endif; ?>
<h2>Add New Properties</h2>
<div>
    <div class="new-property">Label: <?php echo __v()->formText("new_property_label[]", null, null); ?> Description: <?php echo __v()->formText("new_property_description[]", null, null); ?></div>
</div>
<?php echo __v()->formButton('add_property', 'Add Property', array('id' => 'add-property')); ?>
<?php echo __v()->formSubmit('submit_edit_vocabulary', 'Edit Custom Vocabulary'); ?>
</form>
</div>
<?php foot(); ?>