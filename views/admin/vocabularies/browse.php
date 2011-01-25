<?php
$head = array('title' => html_escape('Item Relations | Vocabularies | Browse'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Namespace Prefix</th>
        <th>Namespace URI</th>
    </tr>
<?php foreach ($this->vocabularies as $vocabulary): ?>
    <tr>
        <td><a href="show/id/<?php echo $vocabulary->id; ?>"><?php echo $vocabulary->name; ?></a></td>
        <td><?php echo $vocabulary->description; ?></td>
        <td><?php echo $vocabulary->namespace_prefix; ?></td>
        <td><?php echo $vocabulary->namespace_uri; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>
<?php foot(); ?>