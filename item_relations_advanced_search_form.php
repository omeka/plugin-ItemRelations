<div class="field">
    <?php echo __v()->formLabel('item_relations_has_relation', 'Has Relation'); ?>
    <div class="inputs">
        <?php echo __v()->formSelect('item_relations_property_id', null, array('multiple' => false), $formSelectProperties); ?>
    </div>
</div>