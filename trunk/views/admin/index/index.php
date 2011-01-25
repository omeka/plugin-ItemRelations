<?php
$head = array('title' => html_escape('Item Relations'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<p>This table contains available relations and their definitions.</p>
<table>
    <tr>
        <th>Name</th>
        <th>Definition</th>
    </tr>
<?php foreach ($this->relations as $relation): ?>
    <tr>
        <td><?php echo $relation->name; ?></td>
        <td><?php echo $relation->definition; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>
<?php foot(); ?>