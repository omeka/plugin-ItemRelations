<?php
$head = array('title' => 'Browse Vocabularies');
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<?php echo flash(); ?>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th></th>
        <th>Description</th>
        <th>Namespace Prefix</th>
        <th>Namespace URI</th>
    </tr>
    </thead>
    <tbody>
<?php foreach ($this->vocabularies as $vocabulary): ?>
    <tr>
        <td><?php echo $vocabulary->name; ?></td>
        <td><a href="<?php echo html_escape($this->url("item-relations/vocabularies/show/id/{$vocabulary->id}")); ?>">Show</a></td>
        <td><?php echo $vocabulary->description; ?></td>
        <td><?php echo $vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $vocabulary->namespace_prefix; ?></td>
        <td><?php echo $vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $vocabulary->namespace_uri; ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>
<?php foot(); ?>