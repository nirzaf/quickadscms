jQuery(function($) {

    var $fields = $("#quickad-custom-fields"),
        $cf_per_service = $('#quickad_custom_fields_per_service');

    $fields.sortable({
        axis   : 'y',
        handle : '.quickad-js-handle',
        placeholder: 'draggable-placeholder',
        tolerance: 'pointer',
        start: function( e, ui ) {
            ui.placeholder.css({
                'height': ui.item.outerHeight(),
                'margin-bottom': ui.item.css( 'margin-bottom' )
            });
        },
        update : function( event, ui ) {
            var data = [];
            $fields.children('li').each(function() {
                var $this = $(this);
                var position = $this.data('quickad-field-id');
                data.push(position);
            });
            $.ajax({
                type : 'POST',
                url  : ajaxurl,
                data : { action: 'quickad_update_custom_field_position', position: data},
                success: function (response, textStatus, jqXHR) {
                    // Remove Ads item from DOM.
                    if(response != 0) {
                        quickadAlert({success: ['Custom field Order Changed Successfully.']});
                    }else{
                        quickadAlert({error: ['Problem in Reorder, Please try again.']});
                    }
                }
            });
        }

    });

    $cf_per_service.change(function() {
        if ($(this).val() == 1) {
            $('.quickad-services-holder').fadeIn('slow');
        } else {
            $('.quickad-services-holder').fadeOut('slow');
        }
    });

    /**
     * Build initial fields.
     */
    restoreFields();

    /**
     * On "Add new field" button click.
     */
    $('#quickad-js-add-fields').on('click', 'button', function() {
        addField($(this).data('type'));
        //$('.quickad_language_translation').hide();
    });

    /**
     * On "Add new item" button click.
     */
    $fields.on('click', 'button', function() {
        addItem($(this).prev('ul'), $(this).data('type'));
    });
    /**
     * Delete field .
     */
    $fields.on('click', '.quickad-js-delete', function(e) {
        e.preventDefault();
        var $item = $(this).closest('li'),
            id = $item.data('quickad-field-id'),
            data = { action: 'delete_custom_fields', id: id};

        $.post(ajaxurl, data, function(response) {
            if(response == 1) {
                $item.fadeOut('fast', function() { $item.remove(); });
                quickadAlert({success: ['Successfully deleted.']});
            }else{
                quickadAlert({error: ['Problem in delete, Please try again.']});
            }
        });
        return false;

    });
    /**
     * Delete checkbox/radio button/drop-down option.
     */
    $fields.on('click', '.quickad-option-delete', function(e) {
        e.preventDefault();
        var $item = $(this).closest('li'),
            id = $item.data('option_id'),
            field_id = $item.parents('li').data('quickad-field-id'),
            data = { action: 'delete_custom_option', id: id, field_id: field_id};

        $.post(ajaxurl, data, function(response) {
            if(response == 1) {
                $item.fadeOut('fast', function() { $item.remove(); });
                quickadAlert({success: ['Successfully deleted.']});
            }else{
                quickadAlert({error: ['Problem in delete, Please try again.']});
            }
        });
        return false;

    });
    /**
     * On "Custom fields Language Translation" button click.
     */
    $fields.on('click', '.quickad_language_translation', function(e) {
        // Keep category item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();

        $('#modal_LangTranslation #displayData').html('');
        $('#modal_LangTranslation').modal('show');
        $('#modal_LangTranslation .loader').show();
        var id = $(this).data('custom-field-id'),
            type = "custom-field",
            data = { action: 'CustomField_langTranslation_FormFields', id: id, cat_type: type};

        $.post(ajaxurl+'?action=CustomField_langTranslation_FormFields', data, function(response) {
            if(response != "") {
                $('#modal_LangTranslation #displayData').html(response);
                $('#modal_LangTranslation .loader').hide();
            }else{
                quickadAlert({error: ['Problem in saving, Please try again.']});
            }
        });
        return false;
    });

    $('#modal_LangTranslation').on('click', '#saveEditLanguage', function() {
        var $this = $(this),
            $item = $this.closest('#modal_LangTranslation'),
            id = $('#modal_LangTranslation #field_id').val(),
            $trans_name = new Array(),
            $trans_lang = new Array();

        $("#modal_LangTranslation .title_code").map(function(){
            $name = $(this).val();
            $lang = $(this).data('lang-code');
            $trans_name.push($name);
            $trans_lang.push($lang);
        }).get();

        $('#saveEditLanguage').addClass('bookme-progress');

        var data = { action: 'edit_langTranslation_custom_fields', id: id, trans_lang: $trans_lang, trans_name: $trans_name };
        $.ajax({
            type: "POST",
            data: data,
            url: ajaxurl+'?action=edit_langTranslation_custom_fields',
            success: function(response){
                if(response != 0) {
                    $('#modal_LangTranslation').modal('hide');
                    quickadAlert({success: ['Successfully edited.']});
                }else{
                    quickadAlert({error: ['Problem in saving, Please try again.']});
                }
                $('#saveEditLanguage').removeClass('bookme-progress');
            }
        });

        return false;
    });


    $fields.on('click', '.quickad_itmes_translation', function(e) {
        // Keep category item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();

        $('#Options_LangTranslation #displayData').html('');
        $('#Options_LangTranslation').modal('show');
        $('#Options_LangTranslation .loader').show();
        var id = $(this).closest('li').data('option_id'),
            type = "custom_option",
            data = { action: 'langTranslation_FormFields', id: id, cat_type: type};

        $.post(ajaxurl+'?action=langTranslation_FormFields', data, function(response) {
            if(response != "") {
                $('#Options_LangTranslation #displayData').html(response);
                $('#Options_LangTranslation .loader').hide();
            }else{
                quickadAlert({error: ['Problem in saving, Please try again.']});
            }
        });
        return false;
    });
    /**
     * Submit custom_option langTranslation form.
     */
    $('#Options_LangTranslation').on('click', '#saveEditLanguage', function() {
        var $this = $(this),
            $item = $this.closest('#Options_LangTranslation'),
            id = $('#Options_LangTranslation #category_id').val(),
            type = $('#Options_LangTranslation #category_type').val();


        $selected = [];
        $item.find('.translate_row').each(function() {
            var $title = jQuery(this).find('input.cat_title').val(),
                $code = jQuery(this).find('input.lang_code').val(),
                $slug = '';

            $selected.push({
                code: $code,
                title: $title,
                slug:  $slug
            });
        });

        $('#Options_LangTranslation #saveEditLanguage').addClass('bookme-progress');

        var data = { action: 'edit_langTranslation', id: id, cat_type: type, value: $selected };
        $.ajax({
            type: "POST",
            data: data,
            url: ajaxurl+'?action=edit_langTranslation',
            success: function(response){
                if(response != 0) {
                    $('#Options_LangTranslation').modal('hide');
                    quickadAlert({success: ['Successfully edited.']});
                }else{
                    quickadAlert({error: ['Problem in saving, Please try again.']});
                }
                $('#Options_LangTranslation #saveEditLanguage').removeClass('bookme-progress');
            }
        });

        return false;
    });
    /**
     * Submit custom fields form.
     */
    $('#ajax-send-custom-fields').on('click', function(e) {
        e.preventDefault();
        var ladda = Ladda.create(this),
            data = [];
        ladda.start();
        $fields.children('li').each(function() {
            var $this = $(this),
                field = {};
            switch ($this.data('type')) {
                case 'checkboxes':
                case 'radio-buttons':
                case 'drop-down':
                    field.items = [];
                    $this.find('ul.quickad-items li').each(function() {
                        var  $key = $(this).data('option_id');
                        var  $val = $(this).find('input').val();
                        field.items.push({
                            id: $key,
                            value:  $val
                        });
                    });
                case 'textarea':
                case 'text-field':
                case 'text-content':
                case 'captcha':
                    field.type     = $this.data('type');
                    field.label    = $this.find('.quickad-label').val();
                    field.required = $this.find('.quickad-required').prop('checked');
                    field.id       = $this.data('quickad-field-id');
                    field.allcat = $this.find('.quickad-services-holder .quickad-check-all-entities:checked')
                        .map(function() { return this.value; })
                        .get();
                    field.maincat = $this.find('.quickad-services-holder .quickad-js-check-entity:checked')
                        .map(function() { return this.value; })
                        .get();
                    field.services = $this.find('.quickad-services-holder .subcategory input:checked')
                        .map(function() { return this.value; })
                        .get();
            }
            data.push(field);
        });
        $.ajax({
            type      : 'POST',
            url       : ajaxurl,
            xhrFields : { withCredentials: true },
            data      : { action: 'save_custom_fields', csrf_token : quickadL10n.csrf_token, fields: JSON.stringify(data), cf_per_service: $cf_per_service.val() },
            complete  : function() {
                ladda.stop();
                quickadAlert({success : [quickadL10n.saved]});
                //location.reload();
            }
        });
    });

    /**
     * On 'Reset' click.
     */
    $('button[type=reset]').on('click', function() {
        $fields.empty();
        restoreFields();
    });

    /**
     * Add new field.
     *
     * @param type
     * @param id
     * @param label
     * @param required
     * @param services
     * @returns {*|jQuery}
     */
    function addField(type, id, label, required, services, translation) {
        var $new_field = $('ul#quickad-templates > li[data-type=' + type + ']').clone();
        // Set id, label and required.
        if (typeof id == 'undefined') {
            id = Math.floor((Math.random() * 100000) + 1);
        }
        if (typeof label == 'undefined') {
            label = '';
        }
        if (typeof required == 'undefined') {
            required = false;
        }
        if (typeof translation == 'undefined') {
            transclass = "hide";
        }else{
            transclass = "show";
        }
        $new_field
            .hide()
            .data('quickad-field-id', id)
            .find('.quickad-required').prop({
                id      : 'required-' + id,
                checked : required
            })
            .next('label').attr('for', 'required-' + id)
            .end().end()
            .find('.quickad-label').val(label)
            .end()
            .find('.quickad_language_translation').addClass(transclass).data('custom-field-id', id)
            .end()
            .find('.quickad-services-holder .subcategory input:checkbox').each(function (index) {
                if (services && $.inArray(this.value, services) > -1) {
                    this.checked = true;
                    var $holder = $(this).closest('.main-category');
                    var service_checked = $holder.find('.quickad-js-check-sub-entity:checked').length;

                    if( service_checked == $holder.find('.quickad-js-check-sub-entity').length)
                        $holder.find('.quickad-js-check-entity').prop('checked', true);
                    else
                        $holder.find('.quickad-js-check-entity').prop('checked', false);
                }
                this.id = 'check-sub-' + id + '-' + index;
                $(this).next().attr('for', 'check-sub-' + id + '-' + index);
            }).end()
            .find('.quickad-services-holder .quickad-js-check-entity').each(function (index) {
                this.id = 'check-main-' + id + '-' + index;
                $(this).next().attr('for', 'check-main-' + id + '-' + index);
            }).end()
            .find('.quickad-services-holder .quickad-check-all-entities').each(function (index) {
                this.id = 'check-all-' + id + '-' + index;
                $(this).next().attr('for', 'check-all-' + id + '-' + index);
            });
        // Add new field to the list.
        $fields.append($new_field);
        $new_field.fadeIn('fast');
        // Make it sortable.

        $new_field.find('ul.quickad-items').sortable({
            axis   : 'y',
            handle : '.quickad-js-handle',
            update : function( event, ui ) {
                var data = [],
                    field_id = $(this).parents('li').data('quickad-field-id');
                $(this).children('li').each(function() {
                    var $this = $(this);
                    var position = $this.data('option_id');
                    data.push(position);
                });
                $.ajax({
                    type : 'POST',
                    url  : ajaxurl,
                    data : { action: 'quickad_update_custom_option_position',field_id: field_id, position: data},
                    success: function (response, textStatus, jqXHR) {
                        // Remove Ads item from DOM.
                        if(response != 0) {
                            quickadAlert({success: ['Custom Option Order Changed Successfully.']});
                        }else{
                            quickadAlert({error: ['Problem in Reorder, Please try again.']});
                        }
                    }
                });
            }
        });
        // Set focus to label field.
        $new_field.find('.quickad-label').focus();

        return $new_field;
    }

    /**
     * Add new checkbox/radio button/drop-down option.
     *
     * @param $ul
     * @param type
     * @param value
     * @return {*|jQuery}
     */
    function addItem($ul, type, id, value) {
        var $new_item = $('ul#quickad-templates > li[data-type=' + type + ']').clone();
        if (typeof value != 'undefined'){
            $new_item.find('input').val(value);
        }
        if (typeof id == 'undefined') {
            id = Math.floor((Math.random() * 100000) + 1);
        }
        $new_item.data('option_id', id);
        $new_item.hide().appendTo($ul).fadeIn('fast').find('input').focus();

        return $new_item;
    }

    /**
     * Restore fields from quickadL10n.custom_fields.
     */
    function restoreFields() {
        if (quickadL10n.custom_fields) {
            var custom_fields = jQuery.parseJSON(quickadL10n.custom_fields);
            $.each(custom_fields, function (i, field) {
                services = field.services.split(',');
                var $new_field = addField(field.type, field.id, field.label, field.required, services, translation=true);

                // add children
                if (field.items) {
                    $.each(field.items, function (id, data) {
                        addItem($new_field.find('ul.quickad-items'), field.type + '-item', data.id, data.title);
                    });
                }
            });
        }
        $cf_per_service.change();
        $('.quickad-services-holder').each(function (id, elem) {
            updateServiceButton($(elem));
        });
        $(':focus').blur();
    }

    $('.quickad-popover').popover({trigger: 'hover'});

    function updateServiceButton($holder) {
        var service_checked = $holder.find('.quickad-js-check-sub-entity:checked').length;
        if (service_checked == 0) {
            $holder.find('.quickad-js-count').text(quickadL10n.selector.nothing_selected);
            $holder.find('.quickad-check-all-entities').prop('checked', false);
        }
        else if (service_checked == 1) {
            $holder.find('.quickad-js-count').text($holder.find('.quickad-js-check-sub-entity:checked').data('title'));
            $holder.find('.quickad-js-check-entity').prop('checked', (service_checked == $holder.find('.quickad-js-check-sub-entity').length));
        }
        else {
            if( service_checked == $holder.find('.quickad-js-check-sub-entity').length) {
                $holder.find('.quickad-check-all-entities').prop('checked', true);
                $holder.find('.quickad-js-count').text(quickadL10n.selector.all_selected);
            }
            else {
                $holder.find('.quickad-check-all-entities').prop('checked', false);
                $holder.find('.quickad-js-count').text(service_checked + '/' + $holder.find('.quickad-js-check-sub-entity').length);
            }
        }
    }

    $(document).on('click', '.quickad-check-all-entities', function () {
        var $holder = $(this).parents('.quickad-services-holder');
        $holder.find('.quickad-js-check-entity').prop('checked', $(this).prop('checked'));
        $holder.find('.quickad-js-check-sub-entity').prop('checked', $(this).prop('checked'));
        updateServiceButton($holder);
    });

    $(document).on('click', '.quickad-services-holder ul.dropdown-menu li a[href]', function (e) {
        e.stopPropagation();
    });

    $(document).on('click', '.quickad-js-check-entity', function (e) {
        $(this).closest('li').find('.quickad-js-check-sub-entity').prop('checked', $(this).prop('checked'));
        var $holder = $(this).parents('.quickad-services-holder');
        updateServiceButton($holder);
        e.stopPropagation();
    });

    $(document).on('click', '.quickad-js-check-sub-entity', function (e) {
        var $holder = $(this).closest('.main-category');
        var service_checked = $holder.find('.quickad-js-check-sub-entity:checked').length;

        if( service_checked == $holder.find('.quickad-js-check-sub-entity').length)
            $holder.find('.quickad-js-check-entity').prop('checked', true);
        else
            $holder.find('.quickad-js-check-entity').prop('checked', false);

        updateServiceButton($(this).parents('.quickad-services-holder'));
        e.stopPropagation();
    });

    $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'top',
        trigger: 'hover',
        template: '<div class="popover quickad-font-xs" style="width: 220px" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    });
});