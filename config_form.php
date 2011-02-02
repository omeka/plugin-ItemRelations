<div class="field">
    <?php echo __v()->formLabel('item_relations_public_append_to_items_show', 'Append to Public Item Show'); ?>
    <div class="inputs">
        <?php echo __v()->formCheckbox('item_relations_public_append_to_items_show', null, array('checked' => get_option('item_relations_public_append_to_items_show'))); ?>
        <p class="explanation">Checking this will append an item's relations to its public show page.</p>
    </div>
</div>