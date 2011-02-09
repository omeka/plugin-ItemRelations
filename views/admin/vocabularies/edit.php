<?php
$head = array('title' => html_escape('Edit Custom Vocabulary'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<form method="post">
<?php if (!$this->properties): ?>
<p>This vocabulary has no properties.</p>
<?php else: ?>
<?php foreach ($this->properties as $property): ?>
<div>
    Label <?php echo __v()->formText("item_relations_property_label[{$property->id}]", $property->label, null); ?>
    Description <?php echo __v()->formText("item_relations_property_description[{$property->id}]", $property->description, null); ?>
    <?php echo __v()->formCheckbox("item_relations_property_delete[{$property->id}]") ?>Delete
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php echo __v()->formButton('add_relation', 'Add Property', array('id' => 'item-relations-add-property')); ?>
<?php echo __v()->formSubmit('submit_edit_custom_vocabulary', 'Edit Custom Vocabulary'); ?>
</form>
</div>
<?php foot(); ?>