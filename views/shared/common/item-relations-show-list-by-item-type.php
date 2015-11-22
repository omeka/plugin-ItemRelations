<?php
    $provideRelationComments = get_option('item_relations_provide_relation_comments');
    // Reorder relations by types.
    $subjectRelationsByObjectType = array();
    foreach ($subjectRelations as $subjectRelation) {
        $typeId = (integer) $subjectRelation['object_item']->item_type_id;
        $subjectRelationsByObjectType[$typeId][] = $subjectRelation;
    }
    $objectRelationsBySubjectType = array();
    foreach ($objectRelations as $objectRelation) {
        $typeId = (integer) $objectRelation['subject_item']->item_type_id;
        $objectRelationsBySubjectType[$typeId][] = $objectRelation;
    }
    // Prepare the list of types with one query.
    $itemTypes = array();
    foreach (get_records('ItemType', array(), 0) as $itemType) {
        $itemTypes[$itemType->id] = $itemType;
    }
?>
<h3><?php echo __('Relation from this item'); ?></h3>
<?php if (empty($subjectRelationsByObjectType)): ?>
<p><?php echo __('This item has no relation to other records.'); ?></p>
<?php else: ?>
<ul>
    <?php foreach ($subjectRelationsByObjectType as $typeId => $relations): ?>
        <li><?php
            echo $typeId ? __($itemTypes[$typeId]->name) : __('No Item Type'); ?>
            <ul>
                <?php foreach ($relations as $subjectRelation): ?>
                <li>
                    <?php echo link_to_item($subjectRelation['object_item_title'], array(), 'show', $subjectRelation['object_item']); ?>
                    <em>[<?php echo $subjectRelation['relation_text']; ?>]</em>
                    <?php
                    if ($provideRelationComments && $subjectRelation['relation_comment']):
                        echo '(' . $subjectRelation['relation_comment'] . ')';
                    endif;
                    ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<h3><?php echo __('Relations to this item'); ?></h3>
<?php if (empty($objectRelationsBySubjectType)): ?>
<p><?php echo __('No record is related to this item.'); ?>
<?php else: ?>
<ul>
    <?php foreach ($objectRelationsBySubjectType as $typeId => $relations): ?>
        <li><?php
            echo $typeId ? __($itemTypes[$typeId]->name) : __('No Item Type'); ?>
            <ul>
                <?php foreach ($relations as $objectRelation): ?>
                <li>
                    <?php echo link_to_item($objectRelation['subject_item_title'], array(), 'show', $objectRelation['subject_item']); ?>
                    <em>[<?php echo $objectRelation['relation_text']; ?>]</em>
                    <?php
                    if ($provideRelationComments && $objectRelation['relation_comment']):
                        echo '(' . $objectRelation['relation_comment'] . ')';
                    endif;
                    ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
