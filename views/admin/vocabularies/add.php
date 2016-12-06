<?php
echo head(array('title' => __('Add New Vocabulary')));
$vocabulary = $this->item_relations_vocabulary;
?>
<form method="post" action="<?php echo url('item-relations/vocabularies/create'); ?>">
  <h2><?php echo __("Vocabulary Name"); ?></h2>
  <?php echo $this->formText("vocabulary_name", null , array('size' => 20)); ?>
  <p>
    <h2><?php echo __("Vocabulary Description"); ?></h2>
    <?php echo $this->formTextarea("vocabulary_description", null , array('cols' => 50, 'rows' => 2)); ?></p>
    <input type="submit" class="button" name="submit" value="<?php echo __('Save Vocabulary'); ?>">
  </form>
<?php echo foot(); ?>
