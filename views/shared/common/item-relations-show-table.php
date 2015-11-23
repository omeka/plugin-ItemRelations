<?php $provideRelationComments = get_option('item_relations_provide_relation_comments'); ?>
<table>
    <?php foreach ($subjectRelations as $subjectRelation): ?>
    <tr>
        <td><?php echo __('This Item'); ?></td>
        <td><span title="<?php echo html_escape($subjectRelation['relation_description']); ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
        <td><?php echo __('Item: %s', link_to_item($subjectRelation['object_item_title'], array(), 'show', $subjectRelation['object_item'])); ?></td>
        <?php if ($provideRelationComments): ?>
        <td><?php if ($subjectRelation['relation_comment']) echo '(' . $subjectRelation['relation_comment'] . ')'; ?></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($objectRelations as $objectRelation): ?>
    <tr>
        <td><?php echo __('Item: %s', link_to_item($objectRelation['subject_item_title'], array(), 'show', $objectRelation['subject_item'])); ?></td>
        <td><span title="<?php echo html_escape($objectRelation['relation_description']); ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
        <td><?php echo __('This Item'); ?></td>
        <?php if ($provideRelationComments): ?>
        <td><?php if ($objectRelation['relation_comment']) echo '(' . $objectRelation['relation_comment'] . ')'; ?></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
