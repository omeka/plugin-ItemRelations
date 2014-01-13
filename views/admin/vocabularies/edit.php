<?php echo head(array('title' => __('Edit Custom Vocabulary'))); ?>
<?php echo flash(); ?>

<form method="post">
<section class="seven columns alpha">
    <p>
    <?php
    echo __('Here you can add, edit, and delete properties in your custom '
        . 'vocabulary. Property labels must be unique. You cannot edit property '
        . 'labels once they have been created, so make sure they are spelled '
        . 'correctly and convey the exact relation you want them to convey.');
    ?>
    </p>
    <table>
        <thead>
            <tr>
                <th><?php echo __('Label'); ?></th>
                <th><?php echo __('Description'); ?></th>
                <th><?php echo __('Delete'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($this->properties as $property): ?>
            <tr>
                <td><?php echo $property->label; ?></td>
                <td><?php echo $this->formTextarea("property_description[{$property->id}]", $property->description, array('cols' => 50, 'rows' => 2)); ?></td>
                <td><?php echo $this->formCheckbox("property_delete[{$property->id}]") ?></td>
            </tr>
    <?php endforeach; ?>
            <tr class="new-property">
                <td><?php echo $this->formText("new_property_label[]", null, array('size' => 20)); ?></td>
                <td><?php echo $this->formTextarea("new_property_description[]", null, array('cols' => 50, 'rows' => 2)); ?></td>
                <td><span style="color:#ccc;">n/a</span></td>
            </tr>
        </tbody>
    </table>
    <?php echo $this->formButton('add_property', __('Add a Property'), array('id' => 'add-property')); ?>
</section>
<section class="three columns omega">
    <div id="save" class="panel">
        <?php echo $this->formSubmit('submit_edit_vocabulary', __('Save Changes'), array('class' => 'submit big green')); ?>
    </div>
</section>
</form>
<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('#add-property').click(function () {
        var oldRow = jQuery('.new-property').last();
        var newRow = oldRow.clone();
        oldRow.parent().append(newRow);
        newRow.find('input').val('');
    });
});
</script>
<?php echo foot(); ?>
