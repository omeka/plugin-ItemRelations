<?php $provideRelationComments = get_option('item_relations_provide_relation_comments'); ?>
<ul>
    <?php foreach ($subjectRelations as $subjectRelation): ?>
    <li>
        <?php echo __('This Item'); ?>
        <strong><?php echo $subjectRelation['relation_text']; ?></strong>
        <?php echo link_to_item($subjectRelation['object_item_title'], array(), 'show', $subjectRelation['object_item']); ?>
        <?php
        if ($provideRelationComments && $subjectRelation['relation_comment']):
            echo '(' . $subjectRelation['relation_comment'] . ')';
        endif;
        ?>
    </li>
    <?php endforeach; ?>
    <?php foreach ($objectRelations as $objectRelation): ?>
    <li>
        <?php echo link_to_item($objectRelation['subject_item_title'], array(), 'show', $objectRelation['subject_item']); ?>
        <strong><?php echo $objectRelation['relation_text']; ?></strong>
        <?php echo __('This Item'); ?>
        <?php
        if ($provideRelationComments && $objectRelation['relation_comment']):
            echo '(' . $objectRelation['relation_comment'] . ')';
        endif;
        ?>
    </li>
    <?php endforeach; ?>
</ul>
