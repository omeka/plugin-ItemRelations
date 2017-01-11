<?php $provideRelationComments = get_option('item_relations_provide_relation_comments'); ?>
<div id="item-relations-display-item-relations">
    <h2><?php echo __('Item Relations'); ?></h2>
    <?php if (!$subjectRelations && !$objectRelations): ?>
    <p><?php echo __('This item has no relations.'); ?></p>
    <?php else: ?>
    <table>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
        <tr>
            <td><?php echo __('This Item'); ?></td>
            <td><span title="<?php echo html_escape($subjectRelation['relation_description']); ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
            <td>Item: <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
            <?php if ($provideRelationComments): ?>
            <td><?php if (($subjectRelation['relation_comment'])) { echo "(".$subjectRelation['relation_comment'].")"; } ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr>
            <td>Item: <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
            <td><span title="<?php echo html_escape($objectRelation['relation_description']); ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
            <td><?php echo __('This Item'); ?></td>
            <?php if ($provideRelationComments): ?>
            <td><?php if ($objectRelation['relation_comment']) { echo "(".$objectRelation['relation_comment'].")"; } ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
