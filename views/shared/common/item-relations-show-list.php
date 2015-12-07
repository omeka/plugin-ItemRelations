<?php
  $provideRelationComments = get_option('item_relations_provide_relation_comments');
  $thisItemId = $item->id;

  $lastVocab = -1;
  foreach ($allRelations as $relation) {
    if ($lastVocab != $relation["vocabulary_id"]) {
      if ($lastVocab != -1) { echo "</ul>"; }
      echo "<h5>"
      ."<span title='".$relation["vocabulary_desc"]."'>"
      .$relation["vocabulary"]
      ."</span></h5><ul>";
      $lastVocab = $relation["vocabulary_id"];
    }
    echo "<li>";
    echo ( $relation['subject_item_id']==$thisItemId ? __('This Item')
            : "<a href='".url('items/show/' . $relation['subject_item_id'])."'>".
                $relation['subject_item_title'] . "</a>"
          );
    echo " <strong>" . $relation['relation_text'] . "</strong> ";
    echo ( $relation['object_item_id']==$thisItemId ? __('This Item')
            : "<a href='".url('items/show/' . $relation['object_item_id'])."'>".
                $relation['object_item_title'] . "</a>"
          );
    if ( ($provideRelationComments) and ($relation['relation_comment']) ) {
      echo " (".$relation['relation_comment'].")";
    }
    echo "</li>";
  } # foreach
  echo "</ul>";
?>
