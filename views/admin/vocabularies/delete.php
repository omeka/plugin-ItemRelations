<?php
$pageTitle = __('Delete Vocabulary');
echo head(array('title'=>$pageTitle));
echo flash();
$vocabularyId = null;
if (isset($_GET['vocabulary_id'])) { $vocabularyId = intval($_GET['vocabulary_id']); }

?>
<section class="seven columns alpha">
  <fieldset class="bulk-metadata-editor-fieldset" id='bulk-metadata-editor-items-set' style="border: 1px solid black; padding:15px; margin:10px;">
    <div class="field">
      <?php
      if ($vocabularyId){
        $db = get_db();
        $sql = "DELETE FROM `$db->ItemRelationsVocabulary` WHERE id = $vocabularyId";
        $db->query($sql);
        ?>
        <h2><?php echo __("You have successfully deleted the vocabulary."); ?></h2>
        <?php }
        else {?>
          <h2><?php echo __("The vocabulary name cannot be deleted"); ?></h2>
          <?php  }
          ?>
        </div>
      </fieldset>
    </section>
    <section class="three columns omega">
      <div id="save" class="panel">
        <a href="<?php echo html_escape(url('item-relations/vocabularies/show')); ?>" class="add big green button"><?php echo __('Back'); ?></a>
      </div>
    </section>
    <?php echo foot(); ?>
