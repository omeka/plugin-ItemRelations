<div class="info-panel">
    <h2>Item Relations</h2>
    <div>
        <?php if (!$subjectRelations && !$objectRelations): ?>
        <p>This item has no relations.</p>
        <?php else: ?>
        <ul>
            <?php foreach ($subjectRelations as $subjectRelation): ?>
            <li>This Item <strong><?php echo $subjectRelation['relation_text']; ?></strong> <a href="<?php echo uri('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></li>
            <?php endforeach; ?>
            <?php foreach ($objectRelations as $objectRelation): ?>
            <li><a href="<?php echo uri('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a> <strong><?php echo $objectRelation['relation_text']; ?></strong> This Item</li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>