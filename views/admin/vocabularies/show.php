<?php
$head = array('title' => 'Show Vocabulary Properties');
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<?php if ($this->vocabulary->custom): ?><p class="edit-button"><a href="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>" class="edit">Edit Custom Vocabulary</a></p><?php endif; ?>
<div id="primary">
<h2><?php echo $this->vocabulary->name; ?></h2>
<p><?php echo preg_replace('#(https?://\S+)#', '<a href="$1">$1</a>', $vocabulary->description); ?></p>
<?php if (!$this->properties): ?>
<p>This vocabulary has no properties.<?php if ($this->vocabulary->custom): ?> <a href="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>">Why don't you add some?</a><?php endif; ?></p>
<?php else: ?>
<table>
    <thead>
    <tr>
        <th>Local Part</th>
        <th>Label</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
<?php foreach ($this->properties as $property): ?>
    <tr>
        <td><?php echo $this->vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $property->local_part; ?></td>
        <td><?php echo $property->label; ?></td>
        <td><?php echo $property->description; ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
</div>
<?php foot(); ?>