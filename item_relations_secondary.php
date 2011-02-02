<div class="info-panel">
    <h2>Item Relations</h2>
    <div>
        <?php if ($subjects || $objects): ?>
        <ul>
            <?php foreach ($subjects as $subject): ?>
            <?php
            $title = item('Dublin Core', 'Title', array(), get_item_by_id($subject->object_item_id));
            if (!$title) {
                $title = $subject->object_item_id;
            }
            ?>
            <li>This Item <strong><?php echo $subject->vocabulary_namespace_prefix . ':' . $subject->property_local_part; ?></strong> <a href="<?php echo uri('items/show/' . $subject->object_item_id); ?>" target="_blank"><?php echo $title; ?></a></li>
            <?php endforeach; ?>
            <?php foreach ($objects as $object): ?>
            <?php
            $title = item('Dublin Core', 'Title', array(), get_item_by_id($object->subject_item_id));
            if (!$title) {
                $title = $object->subject_item_id;
            }
            ?>
            <li><a href="<?php echo uri('items/show/' . $object->subject_item_id); ?>" target="_blank"><?php echo $title; ?></a> <strong><?php echo $object->vocabulary_namespace_prefix . ':' . $object->property_local_part; ?></strong> This Item</li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>This item has no relations.</p>
        <?php endif; ?>
    </div>
</div>