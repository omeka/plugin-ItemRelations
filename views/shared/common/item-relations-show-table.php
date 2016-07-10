<?php
  $provideRelationComments = get_option('item_relations_provide_relation_comments');
  $thisItemId = $item-> id;

  $relVocabShowHide = __("Show / Hide");
  $relVocabShowHideAll = __("Show / Hide All");
  echo "
    <script type='text/javascript'>
      var relVocabShowHide = '$relVocabShowHide';
      var relVocabShowHideAll = '$relVocabShowHideAll';
    </script>
  ";

  $jsFile = WEB_PLUGIN."/ItemRelations/views/shared/javascripts/item-relations-vocab-toggle.js";
  echo "<script type='text/javascript' src='$jsFile'></script>";

  echo "<table id='relVocabTable'><tbody>";
  $colspan = ($provideRelationComments ? 4 : 3);
  $lastVocab = -1;
  foreach ($allRelations as $relation) {
    if ($lastVocab != $relation["vocabulary_id"]) {
      $lastVocab = $relation["vocabulary_id"];
      echo "<tr class='relVocabHead' data-vocab='$lastVocab'><th colspan='$colspan'>"
      ."<span title='".$relation["vocabulary_desc"]."'>"
      .$relation["vocabulary"]
      ."</span></th></tr>";
    }
    echo "<tr class='relVocabRow relVocab_$lastVocab'>";
    echo "<td>" .
          ( $relation['subject_item_id']==$thisItemId ? __('This Item')
            : "<a href='".url('items/show/' . $relation['subject_item_id'])."'>".
                $relation['subject_item_title'] . "</a>"
          ) .
          "</td>";
    echo "<td><strong>" . $relation['relation_text'] . "</strong></td>";
    echo "<td>" .
          ( $relation['object_item_id']==$thisItemId ? __('This Item')
            : "<a href='".url('items/show/' . $relation['object_item_id'])."'>".
                $relation['object_item_title'] . "</a>"
          ).
          "</td>";
    if ($provideRelationComments) {
      echo "<td>(".$relation['relation_comment'].")</td>";
    }
    echo "</tr>";
  } # foreach
  echo "</table>";
?>
