jQuery(document).ready(function () {
    var $ = jQuery;
    var options = {};

    var updateTimer = null;

    init();

    function init() {
        resetOptions();

        $('#new_relation_object_item_id').val('');
        $('#object_id').html('');
        $('#object_title').html('<i>' + itemRelationsSearchAndSelect + '</i>');
        $('#new_relation_property_id').val('');
        $('#relation_comment').val('');
        $('#new_relation_object_item_type_id').val(-1);
        $('#new_relation_object_collection_id').val('');
        $('#partial_object_title').val('');
        $('#id_limit').val('');
        $('input[name=itemsListSort]:checked').val('timestamp');

        updateChoices();
        updateAddButton();
    }

    function resetOptions() {
        options = {
            subject_id: $('#subject_id').attr('data-subject-id'),
            partial: '',
            id_limit: '',
            item_type: -1,
            collection: -1,
            sort: 'mod_desc',
            page: 0,
            per_page: 15,
            max_page: 0
        };
    }

    function updateChoices() {
      if (updateTimer != null) { clearTimeout(updateTimer); }
      updateTimer = setTimeout(updateChoicesCore, 1000);
    }

    function updateChoicesCore() {
        if (updateTimer != null) { clearTimeout(updateTimer); updateTimer = null; }

        options['partial'] = $('#partial_object_title').val();
        options['id_limit'] = $('#id_limit').val();
        options['item_type'] = $('#new_relation_object_item_type_id').val();
        options['collection'] = $('#new_relation_object_collection_id').val();
        if ($('input[name=itemsListSort]:checked').val() === 'timestamp') {
            options['sort'] = 'mod_desc';
        }
        else {
            options['sort'] = 'alpha_asc';
        }
        if (options['page'] < 0) {
            options['page'] = 0;
        }
        if (options['page'] > options['max_page']) {
            options['page'] = options['max_page'];
        }
        $.ajax({
            url: url,
            dataType: 'json',
            data: options,
            success: function (data) {
                var i;
                var items = [];

                /* options */
                $('#lookup-results').find('li').remove();
                for (i = 0; i < data['items'].length; ++i) {
                    // items.push('<li data-value="' + data['items'][i]['value'] + '">' + data['items'][i]['label'] + '</li>');
                    items.push('<li data-value="' + data['items'][i]['value'] + '">' +
                    '<span class="relListItemId">#' + data['items'][i]['value'] + "</span> " +
                    data['items'][i]['label'] + '</li>');
                }
                $('#lookup-results').append(items.join(''));

                /* pagination */
                options['max_page'] = Math.floor(data['count'] / options['per_page']);

                if (0 < options['page']) {
                    $('#selector-previous-page').removeClass('pg_disabled');
                }
                else {
                    $('#selector-previous-page').addClass('pg_disabled');
                }

                if (options['page'] < options['max_page']) {
                    $('#selector-next-page').removeClass('pg_disabled');
                }
                else {
                    $('#selector-next-page').addClass('pg_disabled');
                }
            }
        });

        // Update the list of item types.
        $.ajax({
            url: url + 'list-item-types',
            dataType: 'json',
            success: function (data) {
                _loadList('select#new_relation_object_item_type_id', data);
            }
        });

        // Update the list of collections.
        $.ajax({
            url: url + 'list-collections',
            dataType: 'json',
            success: function (data) {
                _loadList('select#new_relation_object_collection_id', data);
            }
        });
    }

    function _loadList(element, data) {
        var currentValue = $(element).val();
        $(element).empty();
        $.each(data['id'], function(i, id) {
            $(element).append(
                $('<option></option>')
                    .val(id)
                    .html(data['label'][i]));
        });
        $(element).val(currentValue);
    }

    function updateAddButton() {
        var addButton = $('#add-relation');
        if ($('#new_relation_property_id').val() && $('#new_relation_object_item_id').val()) {
            addButton.removeProp('disabled');
            addButton.removeAttr('disabled');
        }
        else {
            addButton.prop('disabled', true);
            addButton.attr('disabled', true);
        }
    }

    function updateNewRelationHiddenProperty() {
        var entry = $(this).closest('tr.item-relations-entry');
        var hiddenInput = entry.find(".item-relations-hidden input[name='item_relations_property_id[]']");
        hiddenInput.val($(this).val());
    };

    function updateNewRelationHiddenComment() {
        var entry = $(this).closest('tr.item-relations-entry');
        var hiddenInput = entry.find(".item-relations-hidden input[name='item_relations_item_relation_relation_comment[]']");
        hiddenInput.val($(this).val());
    };

    function deleteNewRelation() {
        $(this).closest('tr.item-relations-entry').remove();
        return false;
    };

    /* Edit existing relations. */

    $("select[id^='item_relations_subject_property_']").change(function(e) {
        e.preventDefault();
        var id = this.id;
        var suffix = this.id.match(/\d+/);
        $("#item_relations_subject_property_" + suffix).siblings('span').remove();
        $("#item_relations_subject_property_" + suffix).parent().append('<span>'
            + '<input type="hidden" name="item_relations_item_relation_subject_property[]" value="' + suffix + '" />'
            + '</span>');
    });

    $("input[id^='item_relations_subject_comment_']").change(function(e) {
        e.preventDefault();
        var provideSubjectComments = ($("input[id^='item_relations_subject_comment_']").length > 0);
        if (provideSubjectComments) {
            var id = $(this).attr('id');
            var suffix = this.id.match(/\d+/);
            $("#item_relations_subject_comment_" + suffix).siblings('span').remove();
            $("#item_relations_subject_comment_" + suffix).parent().append('<span>'
                + '<input type="hidden" name="item_relations_item_relation_subject_comment[]" value="' + suffix + '" />'
                + '</span>');
        }
    });

    /* Add new relations. */

    $('#add-relation').click(function () {
        if ($('#add-relation').prop('disabled')) {
            return false;
        }

        // Set visible row.
        var oldRow = $('.item-relations-entry').last();
        var newRow = oldRow.clone();
        var provideRelationComments = ($('#relation_comment').length > 0);
        newRow.toggleClass('hidden');
        newRow.find("select[name='item_relations_subject_property[]']").val($('#new_relation_property_id').val());
        var new_url = newRow.find('.item-relations-object a').attr('href');
        newRow.find('.item-relations-object a').attr('href', new_url + $('#new_relation_object_item_id').val());
        newRow.find('.item-relations-object a').text($('#object_title').text());
        if (provideRelationComments) {
            newRow.find("input[name='item_relations_subject_comment[]']").val($('#relation_comment').val());
        }

        // Set hidden row for data.
        var hidden = _createHiddenNewRelation();
        newRow.find('.item-relations-hidden').html(hidden);
        oldRow.before(newRow);

        $(".delete-new-relation").bind('click', deleteNewRelation);
        $("select[name='item_relations_subject_property[]'").bind('change', updateNewRelationHiddenProperty);
        $("input[name='item_relations_subject_comment[]'").bind('change', updateNewRelationHiddenComment);

        init();
    });

    function _createHiddenNewRelation() {
        var hidden = [];
        hidden.push('<input type="hidden" name="item_relations_property_id[]" value="');
        hidden.push($('#new_relation_property_id').val());
        hidden.push('">');
        hidden.push('<input type="hidden" name="item_relations_item_relation_object_item_id[]" value="');
        hidden.push($('#new_relation_object_item_id').val());
        hidden.push('">');
        if ($('#relation_comment').length > 0) {
            hidden.push('<input type="hidden" name="item_relations_item_relation_relation_comment[]" value="');
            hidden.push($('#relation_comment').val());
            hidden.push('">');
        }
        return hidden.join('');
    };

    /* Search and select an object to create a new relation. */

    $('#refresh-results').click(function (e) {
        e.preventDefault();
        updateChoicesCore();
    });

    $('#new_relation_object_item_type_id').change(function () {
        updateChoices();
    });

    $('#new_relation_object_collection_id').change(function () {
        updateChoices();
    });

    $('#new_selectObjectSortTimestamp').click(function () {
        updateChoicesCore();
    });

    $('#new_selectObjectSortName').click(function () {
        updateChoicesCore();
    });

    $('#partial_object_title').on('input', function () {
        updateChoices();
    });

    $('#id_limit').on('input', function () {
        updateChoices();
    });

    $('#selector-previous-page a').click(function (e) {
        e.preventDefault();
        if (0 < options['page']) {
            options['page']--;
            updateChoicesCore();
        }
    });

    $('#selector-next-page a').click(function (e) {
        e.preventDefault();
        if (options['page'] < options['max_page']) {
            options['page']++;
            updateChoicesCore();
        }
    });

    $('#lookup-results').on('click', 'li', function () {
        $('#new_relation_object_item_id').val($(this).attr('data-value'));
        $('#object_id').html(
          '<a href="' + $('#object_id').attr('data-base-url') + '/items/show/' + $(this).attr('data-value') + '" target="_blank">#' +
            $(this).attr('data-value') +
          '</a>'
        );
        var htmlSansSpan = $(this).html();
        htmlSansSpan = htmlSansSpan.substr(htmlSansSpan.indexOf("</span>")+8);
        $('#object_title').html(
          '<a href="' + $('#object_id').attr('data-base-url') + '/items/show/' + $(this).attr('data-value') + '" target="_blank">' +
            htmlSansSpan +
          '</a>'
        );
        updateAddButton();
    });

    $('#new_relation_property_id').change(function () {
        updateAddButton();
    });

    $('#cancel-relation').click(function(e) { e.preventDefault(); });
});
