<div class="field">
    <div class="two columns alpha">
        <?php echo get_view()->formLabel('item_relations_public_append_to_items_show', __('Append to Public Items Show')); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php
            echo __('Check this if you want to display an item\'s relations on '
                . 'its public show page.');
            ?>
        </p>
        <?php echo get_view()->formCheckbox('item_relations_public_append_to_items_show', null, array('checked' => $publicAppendToItemsShow)); ?>
    </div>
</div>
<div class="field">
    <div class="two columns alpha">
        <?php echo get_view()->formLabel('item_relations_admin_sidebar_or_maincontent', __('Display position in admin view')); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php
            echo __('Select the position where you would prefer to display the relations in admin view: '.
										'In the side bar in the lower right (default) or underneath the regular field values to the left.');
            ?>
        </p>
        <?php echo get_view()->formSelect('item_relations_admin_sidebar_or_maincontent', $adminSidebarOrMaincontent, null, array('sidebar' => __('Side bar'), 'maincontent' => __('Main content'))); ?>
    </div>
</div>
<div class="field">
    <div class="two columns alpha">
        <?php echo get_view()->formLabel('item_relations_provide_relation_comments', __('Provide comment field for relations')); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php
            echo __('Check this if you want to be able to enter a comment to a relation.');
            ?>
        </p>
        <?php echo get_view()->formCheckbox('item_relations_provide_relation_comments', null, array('checked' => $provideRelationComments)); ?>
    </div>
</div>
<div class="field">
    <div class="two columns alpha">
        <?php echo get_view()->formLabel('item_relations_relation_format', __('Relation Format')); ?>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php
            echo __('Select the format of an item\'s relations that you would '
                . 'prefer to show. If one is unavailable the other will be used.');
            ?>
        </p>
        <?php echo get_view()->formSelect('item_relations_relation_format', $relationFormat, null, array('prefix_local_part' => __('prefix:localPart'), 'label' => __('label'))); ?>
    </div>
</div>
