<?php
echo head(array('title' => __('Vocabulary Properties')));
$vocabulary = $this->item_relations_vocabulary;
$properties = $vocabulary->getProperties();
?>
<?php if ($vocabulary->custom): ?>
<a class="button" href="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>" class="edit"><?php echo __('Edit Vocabulary'); ?></a>
<?php endif; ?>

<h2><?php echo $vocabulary->name; ?></h2>
<p><?php echo url_to_link(html_escape($vocabulary->description)); ?></p>
<?php if (!$properties): ?>
<p>
    <?php echo __('This vocabulary has no properties.'); ?>
    <?php if ($vocabulary->custom): ?>
    <a href="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>"><?php echo __("Why don't you add some?"); ?></a>
    <?php endif; ?>
</p>
<?php else: ?>
<table>
    <thead>
    <tr>
        <th><?php echo __('Local Part'); ?></th>
        <th><?php echo __('Label'); ?></th>
        <th><?php echo __('Description'); ?></th>
    </tr>
    </thead>
    <tbody>
<?php foreach ($properties as $property): ?>
    <tr>
        <td><?php echo $vocabulary->custom ? '<span style="color:#ccc;">n/a</span>' : $property->local_part; ?></td>
        <td><?php echo $property->label; ?></td>
        <td><?php echo $property->description; ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<?php echo foot(); ?>
