<fieldset id="fieldset-item-relations-input"><legend><?php echo __('Input'); ?></legend>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_allow_vocabularies',
            __('Limit Relations to Vocabularies')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Check the vocabularies that can be used to set relations.');
                echo ' ' . __('If none is checked, all vocabularies will be allowed.');
                ?>
            </p>
            <div class="input-block">
                <?php
                    $currentVocabularies = json_decode(get_option('item_relations_allow_vocabularies')) ?: array();
                    $vocabularies = get_records('ItemRelationsVocabulary', array(), 0);
                    echo '<ul style="list-style-type: none;">';
                    foreach ($vocabularies as $vocabulary) {
                        echo '<li>';
                        echo $this->formCheckbox('item_relations_allow_vocabularies[]', $vocabulary->name,
                            array('checked' => in_array($vocabulary->name, $currentVocabularies) ? 'checked' : '',
                                  'id' => 'item_relations_vocab_id_'.$vocabulary->id,
                                  )
                          );
                        echo " " .
                              $this->formLabel('item_relations_vocab_id_'.$vocabulary->id,
                                                $vocabulary->name,
                                                array( "style" => "float:none;" )
                                              );
                        echo '</li>';
                    }
                    echo '</ul>';
                ?>
            </div>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_provide_relation_comments',
                __('Provide comment field for relations')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Check this if you want to be able to enter a comment to a relation.');
                ?>
            </p>
            <?php echo $this->formCheckbox('item_relations_provide_relation_comments',
                null, array('checked' => get_option('item_relations_provide_relation_comments'))); ?>
        </div>
    </div>
</fieldset>
<fieldset id="fieldset-item-relations-display"><legend><?php echo __('Display'); ?></legend>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_relation_format',
                __('Relation Format')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Select the format of an item\'s relations that you would '
                    . 'prefer to show. If one is unavailable the other will be used.');
                ?>
            </p>
            <?php echo $this->formSelect('item_relations_relation_format',
                get_option('item_relations_relation_format'), null, array(
                    'prefix_local_part' => __('prefix:localPart'),
                    'label' => __('label'),
                )); ?>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_admin_sidebar_or_maincontent',
                __('Display position in admin view')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Select the position where you would prefer to display the relations in admin view: ' .
                    'In the side bar in the lower right (default) or underneath the regular field values to the left.');
                ?>
            </p>
            <?php echo $this->formSelect('item_relations_admin_sidebar_or_maincontent',
                    get_option('item_relations_admin_sidebar_or_maincontent'), null, array(
                        'sidebar' => __('Side bar'),
                        'maincontent' => __('Main content'),
                    )); ?>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_admin_display_mode',
            __('Admin Display Mode')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Set how to display the list of relations in the admin view.');
                echo ' ' . __('Anyway, the view can be themed.');
                ?>
            </p>
            <?php echo $this->formSelect('item_relations_admin_display_mode',
                    get_option('item_relations_admin_display_mode'), null, array(
                        'table' => __('As a table'),
                        'list' => __('As a list'),
                        'list-by-item-type' => __('By item type'),
                    )); ?>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_public_append_to_items_show',
            __('Append to Public Items Show')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __("Check this if you want to display an item's relations on its public show page.");
                ?>
            </p>
            <?php echo $this->formCheckbox('item_relations_public_append_to_items_show',
                null, array('checked' => get_option('item_relations_public_append_to_items_show'))); ?>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <?php echo $this->formLabel('item_relations_public_display_mode',
            __('Public Display Mode')); ?>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation">
                <?php
                echo __('Set how to display the list of relations in the public view.');
                echo ' ' . __('Anyway, the view can be themed.');
                ?>
            </p>
            <?php echo $this->formSelect('item_relations_public_display_mode',
                    get_option('item_relations_public_display_mode'), null, array(
                        'table' => __('As a table'),
                        'list' => __('As a list'),
                        'list-by-item-type' => __('By item type'),
                    )); ?>
        </div>
    </div>
</fieldset>
