<div id="item-relations-display-item-relations">
    <h2>Item Relations</h2>
    <?php if ($subjects || $objects): ?>
    <table>
        <tr>
            <th>Subject</th>
            <th>Relation</th>
            <th>Object</th>
        </tr>
        <?php foreach ($subjects as $subject): ?>
        <?php
        $title = item('Dublin Core', 'Title', array(), get_item_by_id($subject->object_item_id));
        if (!$title) {
            $title = $subject->object_item_id;
        }
        ?>
        <tr>
            <td>This Item</td>
            <td><?php echo $subject->vocabulary_namespace_prefix . ':' . $subject->property_local_part; ?></td>
            <td><a href="<?php echo uri('items/show/' . $subject->object_item_id); ?>"><?php echo $title; ?></a></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objects as $object): ?>
        <?php
        $title = item('Dublin Core', 'Title', array(), get_item_by_id($object->object_item_id));
        if (!$title) {
            $title = $object->object_item_id;
        }
        ?>
        <tr>
            <td><a href="<?php echo uri('items/show/' . $object->object_item_id); ?>"><?php echo $title; ?></a></td>
            <td><?php echo $object->vocabulary_namespace_prefix . ':' . $object->property_local_part; ?></td>
            <td>This Item</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>This item has no relations.</p>
    <?php endif; ?>
</div>