// Emulate application/views/scripts/javascripts/search.js

if (typeof Omeka === 'undefined') {
    Omeka = {};
}

Omeka.ItemRelations = {};

/**
 * Activate onclick handlers for the dynamic add/remove buttons on the form.
 */
Omeka.ItemRelations.activateItemRelationButtons = function () {
    
    var addButton = jQuery('.item-relations-add-relation');
    var removeButtons = jQuery('.item-relations-remove-relation');

    /**
     * Callback for adding a new row of options.
     */
    function addItemRelation() {
        // Copy the div that is already on the form.
        var oldDiv = jQuery('.item-relations-entry').last();

        // Clone the div and append it to the form.
        var div = oldDiv.clone();

        oldDiv.parent().append(div);

        var inputs = div.find('input');
        var selects = div.find('select');
        
        inputs.val('');
        selects.val('');
    }

    // Make each button respond to clicks
    addButton.click(function () {
        addItemRelation();
    });
};
