<div id="item-relations-display-item-relations">
    <h2>Item Relations</h2>
    <?php if (!$subjectRelations && !$objectRelations): ?>
    <p>This item has no relations.</p>
    <?php else: ?>
    <table>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
        <tr>
            <td>This Item</td>
            <td><span title="<?php echo $subjectRelation['relation_description']; ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
            <td>Item: <a href="<?php echo uri('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr>
            <td>Item: <a href="<?php echo uri('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
            <td><span title="<?php echo $objectRelation['relation_description']; ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
            <td>This Item</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>