<div class="field">
    <?php echo __v()->formLabel('item_relations_has_relation', 'Has Relation'); ?>
    <div class="inputs">
        <input type="radio" name="item_relations_clause_part" value="subject" checked="checked" />Subject
        <input type="radio" name="item_relations_clause_part" value="object" />Object
        <?php echo __v()->formSelect('item_relations_property_id', null, array('multiple' => false), $formSelectProperties); ?>
    </div>
</div>