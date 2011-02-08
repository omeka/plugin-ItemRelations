<?php
$head = array('title' => html_escape('Show Relations'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<p class="edit-button"><a href="<?php echo html_escape($this->url('item-relations/vocabularies/edit-custom')); ?>" class="edit">Edit Custom Vocabulary</a></p>
<div id="primary">
<h2><?php echo $this->vocabulary->name; ?></h2>
<table>
    <tr>
        <th>Local Part</th>
        <th>Label</th>
        <th>Description</th>
    </tr>
<?php foreach ($this->properties as $property): ?>
    <tr>
        <td><?php echo $property->local_part; ?></td>
        <td><?php echo $property->label; ?></td>
        <td><?php echo $property->description; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>
<?php foot(); ?>