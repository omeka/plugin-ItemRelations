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
    <?php foreach ($subjectRelations as $subjectRelation): ?>
        <tr class="item-relations-entry">
            <td><?php echo __('This Item'); ?></td>
            <td><?php
                echo $this->formSelect('item_relations_subject_property[' . $subjectRelation['item_relation_id'] . ']',
                    $subjectRelation['subject_id'],
                    array(
                        'id' => 'item_relations_subject_property_' . $subjectRelation['item_relation_id'],
                        'multiple' => false,
                        'style' => 'width: 150px;',
                    ),
                    array_slice($formSelectProperties, 1));
            ?></td>
            <td><?php echo link_to_item($subjectRelation['object_item_title'], array('target' => '_blank'), 'show', $subjectRelation['object_item']); ?></td>
            <?php if ($provideRelationComments): ?>
            <td><input name="item_relations_subject_comment[<?php echo $subjectRelation['item_relation_id']; ?>]" id="item_relations_subject_comment_<?php echo $subjectRelation['item_relation_id']; ?>" size="10" maxlength="60" value="<?php echo $subjectRelation['relation_comment'];  ?>" /></td>
            <?php endif; ?>
            <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $subjectRelation['item_relation_id']; ?>" /></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr class="item-relations-entry">
            <td><?php echo link_to_item($objectRelation['subject_item_title'], array('target' => '_blank'), 'show', $objectRelation['subject_item']); ?></td>
            <td><?php echo $objectRelation['relation_text']; ?></td>
            <td><?php echo __('This Item'); ?></td>
            <?php if ($provideRelationComments): ?>
            <td><?php echo $objectRelation['relation_comment']; ?></td>
            <?php endif; ?>
            <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $objectRelation['item_relation_id']; ?>" /></td>
        </tr>
        <?php endforeach; ?>
        <tr class="hidden item-relations-entry">
            <td><?php echo __('This Item'); ?><span class="item-relations-hidden"></span></td>
            <td class="item-relations-property"></td>
            <td class="item-relations-object"><a href="<?php echo url('items/show/'); ?>" target="_blank">.</a></td>
            <?php if ($provideRelationComments): ?>
            <td class="item-relations-comment"></td>
            <?php endif; ?>
            <td><span style="color:#ccc;"><?php echo __("[n/a]") ?></span></td>
        </tr>
    </tbody>
</table>

<a href="#item-relation-selector" class="green button" data-lity><?php echo __('Add a Relation'); ?></a>

<div id="item-relation-selector" style="overflow: auto; padding: 20px; border-radius: 6px; background: #fff" class="lity-hide">
    <h2><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h2>
    <label for="new_relation_property_id"><?php echo __('This Item'); ?>: </label>
    <?php echo $this->formSelect('new_relation_property_id',
        null, array('multiple' => false), $formSelectProperties); ?><br>
    <p><label for="new_relation_object_item_type_id"><?php echo __('Item Types'); ?>: </label>
    <?php echo $this->formSelect('new_relation_object_item_type_id',
        null, array('multiple' => false), $itemTypesList); ?></p>

    <p><?php echo __('Item Sort'); ?>:
        <fieldset>
            <input type="radio" name="itemsListSort" id="new_selectObjectSortTimestamp" value="timestamp" checked>
            <label for="selectObjectSortTimeStamp"><?php echo __("Most recently updated"); ?></label>
            <input type="radio" name="itemsListSort" id="new_selectObjectSortName" value="name">
            <label for="selectObjectSortName"><?php echo __("Alphabetically"); ?></label>
        </fieldset>
    </p>

    <p><?php echo __('Object Title'); ?>: <span id="object_title"></span></p>
    <input id="new_relation_object_item_id" type="hidden">
    <label for="partial_object_title"><?php echo __('Partial Object Title'); ?>: </label>
    <input id="partial_object_title">

    <br>
    <ul class="pagination">
        <li id="selector-previous-page" class="pg_disabled pagination_previous"><a href="#">&lt;</a></li>
        <li id="selector-next-page" class="pg_disabled pagination_next"><a href="#">&gt;</a></li>
    </ul>

    <br>
    <ul id="lookup-results"></ul>

    <?php if ($provideRelationComments): ?>
    <br>
    <p><?php echo __('Comment'); ?>: <?php echo $this->formText('relation_comment', null, array('size' => 10, 'maxlength' => 60)); ?></p>
    <?php endif; ?>

    <a href="#" id="add-relation" class="green button" data-lity-close><?php echo __('Add Relation'); ?></a>
</div>
