<div id="item-relations-display-item-relations">
    <h2><?php echo __('Item Relations'); ?></h2>
    <?php if (empty($subjectRelations) && empty($objectRelations)): ?>
    <p><?php echo __('This item has no relations.'); ?></p>
    <?php else:
        $mode = get_option('item_relations_public_display_mode') ?: 'table';
        echo common('item-relations-show-' . $mode, array(
            'item' => $item,
            'subjectRelations' => $subjectRelations,
            'objectRelations' => $objectRelations,
        ));
    endif; ?>
</div>
