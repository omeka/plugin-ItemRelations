<div class="field">
    <?php echo __v()->formLabel('item_relations_item_relation', 'Item Relation'); ?>
    <div class="inputs">
        <input type="radio" name="item_relations_clause_part" value="subject" checked="checked" />Subject
        <input type="radio" name="item_relations_clause_part" value="object" />Object
        <?php echo __v()->formSelect('item_relations_property_id', null, array('multiple' => false), $formSelectProperties); ?>
        <p class="explanation">Filter this search for items with the selected 
        relation. For example, when selecting "Subject" items with the "hasPart" 
        relation, the search will return all items that have parts. When 
        selecting "Object" items with the same relation, the search will return 
        all items that are parts of other items.</p>
    </div>
</div>