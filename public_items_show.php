<div id="item-relations-display-item-relations">
    <h2>Item Relations</h2>
    <?php if (!$subjectRelations && !$subjectRelation): ?>
    <p>This item has no relations.</p>
    <?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Subject</th>
            <th>Relation</th>
            <th>Object</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
        <tr>
            <td>This Item</td>
            <td><?php echo $subjectRelation['relation_text']; ?></td>
            <td><a href="<?php echo uri('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr>
            <td><a href="<?php echo uri('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
            <td><?php echo $objectRelation['relation_text']; ?></td>
            <td>This Item</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>