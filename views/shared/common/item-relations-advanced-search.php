<div class="field">
    <div class="two columns alpha">
        <?php echo $this->formLabel('item_relations_item_relation', __('Item Relations')); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
        <?php
        echo __('Filter this search for items with the selected ' 
            . 'relation. For example, when selecting "Subject" items with the '
            . '"hasPart" relation, the search will return all items that have '
            . 'parts. When selecting "Object" items with the same relation, the '
            . 'search will return all items that are parts of other items.');
        ?>
        </p>
        <p>
            <input type="radio" name="item_relations_clause_part" value="subject" checked="checked" /><?php echo __('Subject '); ?>
            <input type="radio" name="item_relations_clause_part" value="object" /><?php echo __('Object'); ?>
        </p>
        <?php echo $this->formSelect('item_relations_property_id', @$_GET['item_relations_property_id'], array(), $formSelectProperties); ?>
    </div>
</div>
