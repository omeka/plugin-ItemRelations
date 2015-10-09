jQuery(document).ready(function () {
    var $ = jQuery;
    var options = {};

    function resetOptions() {
        options['partial'] = '';
        options['item_type'] = -1;
        options['sort'] = 'mod_desc';
        options['page'] = 0;
        options['per_page'] = 15;
        options = {
            partial: '',
            item_type: -1,
            sort: 'mod_desc',
            page: 0,
            per_page: 15,
            max_page: 0
        };
    }

    resetOptions();
    updateChoices();

    function updateChoices() {
        options['partial'] = $('#partial_object_title').val();
        options['item_type'] = $('#new_relation_object_item_type_id').val();
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
                    items.push('<li data-value="' + data['items'][i]['value'] + '">' + data['items'][i]['label'] + '</li>');
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
    }

    $('#add-relation').click(function () {
        var oldRow = $('.item-relations-entry').last();
        var newRow = oldRow.clone();
				var provideRelationComments = ($('#relation_comment').length > 0);
        newRow.toggleClass('hidden');
        newRow.find('.item-relations-property').html($('#new_relation_property_id').find(':selected').html());
        var new_url = newRow.find('.item-relations-object a').attr('href');
        newRow.find('.item-relations-object a').attr('href', new_url + $('#new_relation_object_item_id').val());
        newRow.find('.item-relations-object a').text($('#object_title').text());
				if (provideRelationComments) {
					newRow.find('.item-relations-comment').text($('#relation_comment').val());
				}
        var hidden = [];
        hidden.push('<input type="hidden" name="item_relations_property_id[]" value="');
        hidden.push($('#new_relation_property_id').val());
        hidden.push('">');
        hidden.push('<input type="hidden" name="item_relations_item_relation_object_item_id[]" value="');
        hidden.push($('#new_relation_object_item_id').val());
        hidden.push('">');
				if (provideRelationComments) {
	        hidden.push('<input type="hidden" name="item_relations_item_relation_relation_comment[]" value="');
	        hidden.push($('#relation_comment').val());
	        hidden.push('">');
				}
        newRow.find('.item-relations-hidden').html(hidden.join(''));
        oldRow.before(newRow);
    });

    $('#lookup-results').on('click', 'li', function () {
        $('#new_relation_object_item_id').val($(this).attr('data-value'));
        $('#object_title').html($(this).html());
    });

    $('#selector-previous-page').click(function () {
        if (0 < options['page']) {
            options['page']--;
            updateChoices();
        }
    });

    $('#selector-next-page').click(function () {
        if (options['page'] < options['max_page']) {
            options['page']++;
            updateChoices();
        }
    });

    $('#new_relation_object_item_type_id').change(function () {
        updateChoices();
    });

    $('#new_selectObjectSortTimestamp').click(function () {
        updateChoices();
    });

    $('#new_selectObjectSortName').click(function () {
        updateChoices();
    });

    $('#partial_object_title').on('input', function () {
        updateChoices();
    });

    $("input[id^='item_relations_subject_comment_']").change(function(e) {
      e.preventDefault();
      var provideSubjectComments = ($("input[id^='item_relations_subject_comment_']").length > 0);
      var id = $(this).attr('id');
      var suffix = this.id.match(/\d+/);
      if (provideSubjectComments) {
      $("#item_relations_subject_comment_"+suffix).siblings('span').remove();
      $("#item_relations_subject_comment_"+suffix).parent().append('<span>'+
        '<input type="hidden" name="item_relations_item_relation_subject_comment[]" value="'+suffix+'" />'
        +'</span>');
      }
    });
    $("select[id^='item_relations_subject_property_']").change(function(e) {
        e.preventDefault();
        var provideSubjectProperty = ($("select[id^='item_relations_subject_property_']").length > 0);
        var id = this.id;
        var suffix = this.id.match(/\d+/);
        if (provideSubjectProperty) {
        $("#item_relations_subject_property_"+suffix).siblings('span').remove();
        $("#item_relations_subject_property_"+suffix).parent().append('<span>'+
          '<input type="hidden" name="item_relations_item_relation_subject_property[]" value="'+suffix+'" />'
          +'</span>');
        }
    });
} );
