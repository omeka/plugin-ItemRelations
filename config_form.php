<div class="field">
    <?php echo __v()->formLabel('item_relations_public_append_to_items_show', 'Append to Public Item Show'); ?>
    <div class="inputs">
        <?php echo __v()->formCheckbox('item_relations_public_append_to_items_show', null, array('checked' => $publicAppendToItemsShow)); ?>
        <p class="explanation">Check this if you want to display an item's relations on its public show page.</p>
    </div>
</div>
<div class="field">
    <?php echo __v()->formLabel('item_relations_relation_format', 'Relation Format'); ?>
    <div class="inputs">
        <?php echo __v()->formSelect('item_relations_relation_format', $relationFormat, null, array('prefix_local_part' => 'prefix:localPart', 'label' => 'label')); ?>
        <p class="explanation">Select the format of an item's relations that you'd prefer to show. If one is unavailable the other will be used.</p>
    </div>
</div>