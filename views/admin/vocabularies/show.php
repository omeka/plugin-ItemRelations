<?php
$head = array('title' => html_escape('Item Relations | Vocabularies | Show'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
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