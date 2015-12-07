<?php
echo head(array('title' => __('Vocabulary Properties')));
$vocabulary = $this->item_relations_vocabulary;
$properties = $vocabulary->getProperties();
?>

<form method="post" action="<?php echo url('item-relations/vocabularies/save', array('vocabulary_id' => $vocabulary->id)); ?>">
  <?php if ($vocabulary->custom): ?>
    <h2><?php echo $this->formText("vocabulary_name", $vocabulary->name, array('size' => 20)); ?></h2>
    <p><?php echo $this->formTextarea("vocabulary_description", $vocabulary->description, array('cols' => 50, 'rows' => 2)); ?></p>
  <?php else: ?>
    <h2><?php echo $vocabulary->name; ?></h2>
    <p><?php echo url_to_link(html_escape($vocabulary->description)); ?></p>
  <?php endif; ?>
  <?php if ($vocabulary->custom): ?>
    <a class="button" href="<?php echo html_escape($this->url("item-relations/vocabularies/edit/id/{$vocabulary->id}")); ?>" class="edit"><?php echo __('Edit Vocabulary'); ?></a>
  <?php endif; ?>
  <?php if ($vocabulary->custom): ?>
    <input type="submit" class="button" name="submit" value="<?php echo __('Save Vocabulary'); ?>">
  <?php endif; ?>
  <?php if (!$properties): ?>
    <a class="button" href="<?php echo url('item-relations/vocabularies/delete', array('vocabulary_id' => $vocabulary->id));?>" class="delete"><?php echo __('Delete Vocabulary'); ?></a>
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

</form>
<?php echo foot(); ?>
