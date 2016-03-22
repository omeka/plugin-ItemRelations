<p><?php
    $link = '<a href="' . url('item-relations/vocabularies/') . '">'
        . __('Browse Vocabularies') . '</a>';
    echo __('Here you can relate this item to another item and delete existing relations.');
    echo ' ' . __('For descriptions of the relations, see the %s page.', $link);
    echo ' ' . __('Invalid item IDs will be ignored.');
?></p>
<table>
    <thead>
        <tr>
            <th><?php echo __('Subject '); ?></th>
            <th><?php echo __('Relation'); ?></th>
            <th><?php echo __('Object'); ?></th>
            <?php if ($provideRelationComments): ?>
            <th><?php echo __('Comment'); ?></th>
            <?php endif; ?>
            <th><?php echo __('Delete'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $thisItemId = $item->id;
        $colspan = ($provideRelationComments ? 4 : 3);
        $lastVocab = -1;
        foreach ($allRelations as $relation) {
            if ($lastVocab != $relation['vocabulary_id']) {
                echo "<tr><th colspan='$colspan'>"
                    . "<span title='" . $relation['vocabulary_desc'] . "'>"
                    . $relation['vocabulary']
                    . "</span><th></tr>";
                    $lastVocab = $relation['vocabulary_id'];
            }
            $subjectRelation = $relation['subject_item_id'] == $thisItemId;
            $objectRelation = $relation['object_item_id'] == $thisItemId;
            echo '<tr>';
            echo '<td>'
                . ($subjectRelation
                    ? __('This Item')
                    : '<a href="' . url('items/show/' . $relation['subject_item_id']) . '">' . $relation['subject_item_title'] . '</a>'
                )
                . '</td>';
            echo '<td>';
            if ($subjectRelation) {
                echo $this->formSelect('item_relations_subject_property[' . $relation['item_relation_id'] . ']',
                    $relation['relation_property'],
                    array(
                        'id' => 'item_relations_subject_property_' . $relation['item_relation_id'],
                        'multiple' => false,
                        'style' => 'width: 150px;',
                    ),
                    array_slice($formSelectProperties, 1));
            }
            else {
                 echo '<strong>' . $relation['relation_text'] . '</strong>';
            }
            echo '</td>';
            echo '<td>'
                . ($objectRelation
                    ? __('This Item')
                    : '<a href="' . url('items/show/' . $relation['object_item_id']) .'">' . $relation['object_item_title'] . '</a>'
                )
                . '</td>';
            if ($provideRelationComments) {
                echo '<td>';
                if ($subjectRelation) { ?>
                    <input name="item_relations_subject_comment[<?php echo $relation['item_relation_id']; ?>]"
                    id="item_relations_subject_comment_<?php echo $relation['item_relation_id']; ?>"
                    size="10" maxlength="60" value="<?php echo $relation['relation_comment'];  ?>" />
                <?php }
                else {
                     echo $relation['relation_comment'];
                }
                echo '</td>';
            } ?>
            <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $relation['item_relation_id']; ?>" /></td>
            <?php
            echo '</tr>';
        } ?>
        <tr>
            <th colspan="<?php echo $colspan; ?>">
                <span><?php echo __('New Relations'); ?></span>
            <th>
        </tr>
        <tr class="hidden item-relations-entry new">
            <td><?php echo __('This Item'); ?><span class="item-relations-hidden"></span></td>
            <td class="item-relations-property">
                <?php
                echo $this->formSelect('item_relations_subject_property[]',
                    null,
                    array(
                        'multiple' => false,
                        'style' => 'width: 150px;',
                    ),
                    array_slice($formSelectProperties, 1));
                ?>
            </td>
            <td class="item-relations-object"><a href="<?php echo url('items/show/'); ?>" target="_blank">.</a></td>
            <?php if ($provideRelationComments): ?>
                <td class="item-relations-comment">
                    <input name="item_relations_subject_comment[]" size="10" maxlength="60" value="" />
                </td>
            <?php endif; ?>
            <td><a href="#" class="delete-new-relation"><?php echo __('Delete now'); ?></a></td>
        </tr>
    </tbody>
</table>

<a href="#item-relation-selector" class="green button" data-lity><?php echo __('Add a Relation'); ?></a>

<div id="item-relation-selector" style="overflow: auto; padding: 20px; border-radius: 6px; background: #fff" class="lity-hide container-twelve">
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('new_relation_property_id', __('This Subject')); ?>
        </div>
        <div class="inputs one column">
            <span id="subject_id" class="subject-id" <?php echo empty($item->id) ? '' : 'data-subject-id="' . $item->id . '"'; ?>><?php echo empty($item->id) ? __('[New]') : '#' . $item->id; ?></span>
        </div>
        <div class="nine columns omega">
            <?php echo empty($item->id) ? '' : metadata('item', array('Dublin Core', 'Title')); ?>
        </div>
    </div>
    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('new_relation_property_id', __('Is Related By')); ?>
        </div>
        <div class="nine columns omega">
            <?php echo $this->formSelect('new_relation_property_id',
                null, array('multiple' => false), $formSelectProperties); ?>
        </div>
    </div>
    <div class="field">
        <div class="inputs two columns alpha">
            <?php echo $this->formLabel('object_title', __('With Object')); ?>
        </div>
        <div class="inputs one column">
            <span id="object_id" class="object-id" data-base-url="<?php echo CURRENT_BASE_URL; ?>"></span>
        </div>
        <div class="inputs nine columns omega">
            <span id="object_title"><i><?php echo __('[Search and Select Below]'); ?></i></span>
        </div>
    </div>

    <?php if ($provideRelationComments): ?>
    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('relation_comment', __('Comment')); ?>
        </div>
        <div class="inputs nine columns omega">
            <?php echo $this->formText('relation_comment', null); ?>
        </div>
    </div>
    <?php endif; ?>

    <input id="new_relation_object_item_id" type="hidden">

    <div class="action">
        <div class="nine columns alpha">
            <a href="#" id="add-relation" class="green button" data-lity-close><?php echo __('Add this Relation'); ?></a>
        </div>
        <div class="three columns omega">
            <div class="right">
                <a href="#" id="cancel-relation" class="red button" data-lity-close><?php echo __('Cancel'); ?></a>
            </div>
        </div>
    </div>

    <div class="nine columns alpha">
        <h3><?php echo __('Search and Select a Record'); ?></h3>
    </div>
    <div class="action three columns omega">
        <div class="right">
            <a href="<?php echo url('/items/add'); ?>" id="create-record" class="blue button" target="_blank"><?php echo __('Create a new Relation'); ?></a>
        </div>
        <div class="right">
            <a href="#" id="refresh-results" class="green button"><?php echo __('Refresh'); ?></a>
        </div>
    </div>
    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('new_relation_object_item_type_id', __('By Item Types')); ?>
        </div>
        <div class="inputs nine columns omega">
            <?php echo $this->formSelect('new_relation_object_item_type_id',
                null, array('multiple' => false), $itemTypesList); ?>
        </div>
    </div>
    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('new_relation_object_collection_id', __('By Collection')); ?>
        </div>
        <div class="inputs nine columns omega">
            <?php echo $this->formSelect('new_relation_object_collection_id',
                null, array('multiple' => false), get_table_options('Collection')); ?>
        </div>
    </div>

    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('partial_object_title', __('By Partial Title')); ?>
        </div>
        <div class="inputs nine columns omega">
            <?php echo $this->formText('partial_object_title', null, array('size' => 10, 'maxlength' => 60)); ?>
        </div>
    </div>

    <div class="field">
        <div class="three columns alpha">
            <?php echo $this->formLabel('new_relation_item_sort', __('Sort By')); ?>
        </div>
        <fieldset class="inputs nine columns omega">
            <div class="four columns alpha">
                <input type="radio" name="itemsListSort" id="new_selectObjectSortTimestamp" value="timestamp" checked>
                <label for="selectObjectSortTimeStamp"><?php echo __("Most recently updated"); ?></label>
            </div>
            <div class="four columns omega">
                <input type="radio" name="itemsListSort" id="new_selectObjectSortName" value="name">
                <label for="selectObjectSortName"><?php echo __("Alphabetically"); ?></label>
                </div>
        </fieldset>
    </div>

    <br class="clear" />
    <div>
        <ul id="lookup-results"></ul>
    </div>

    <div class="twelve columns">
        <div class="two columns">
            <ul class="pagination" class="left">
                <li id="selector-previous-page" class="pg_disabled pagination_previous"><a href="#">&lt;</a></li>
                <li id="selector-next-page" class="pg_disabled pagination_next"><a href="#">&gt;</a></li>
            </ul>
        </div>
    </div>
</div>
