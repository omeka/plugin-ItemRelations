<?php
$head = array('title' => html_escape('Browse Vocabularies'));
head($head);
?>
<h1><?php echo $head['title']; ?></h1>
<div id="primary">
<?php echo flash(); ?>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Namespace Prefix</th>
        <th>Namespace URI</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<?php foreach ($this->vocabularies as $vocabulary): ?>
    <tr>
        <td><a href="show/id/<?php echo $vocabulary->id; ?>"><?php echo $vocabulary->name; ?></a></td>
        <td><?php echo $vocabulary->description; ?></td>
        <td><?php echo $vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $vocabulary->namespace_prefix; ?></td>
        <td><?php echo $vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $vocabulary->namespace_uri; ?></td>
        <td><?php if ($vocabulary->custom): ?>
            <form method="post" action="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>">
                <?php echo __v()->formSubmit('item_relations_edit_vocabulary_submit', 'Edit') ?>
            </form>
        <?php endif; ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>
<?php foot(); ?>