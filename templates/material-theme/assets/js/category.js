var $ = jQuery.noConflict();
window.jQuery = $;

jQuery(function($) {


    var $no_result = $('#quickad-services-wrapper .no-result');
    // Remember user choice in the modal dialog.
    var update_staff_choice = null,
        $new_category_popover = $('#quickad-new-category'),
        $new_category_form = $('#new-category-form'),
        $new_category_name = $('#quickad-category-name');

    $new_category_popover.popover({
        html: true,
        placement: 'bottom',
        template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        content: $new_category_form.show().detach(),
        trigger: 'manual'
    }).on('click', function () {
        $(this).popover('toggle');
    }).on('shown.bs.popover', function () {
        // focus input
        $new_category_name.focus();
    }).on('hidden.bs.popover', function () {
        //clear input
        $new_category_name.val('');
    });

    // Save new category.
    $new_category_form.on('submit', function() {
        var data = $(this).serialize();
        $.post(ajaxurl+'?action=addNewCat', data, function(response) {
            if(response != 0){
                $data = response.split(',');
                $name = $data[0];
                $id = $data[1];
                $icon = $data[2];
                var appendtpl = '<li class="quickad-nav-item quickad-category-item" ' +
                    'data-category-id="'+$id+'"> ' +
                    '<div class="quickad-flexbox">' +
                    ' <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%"> <i id="quickad-cat-icon" class="quickad-margin-right-sm fa '+$icon+'"></i> </div> <div class="quickad-flex-cell quickad-vertical-middle"> <span class="displayed-value" style="display: inline;"> '+$name+' </span> <form method="post" id="edit-category-form" style="display: none"><div class="form-field form-required"> <label for="quickad-category-name" style="color:#000;">Title</label> <input class="form-control input-lg" id="cat-name" type="text" name="name" value="'+$name+'">  </div> <div class="form-field form-required">  <label for="quickad-category-name" style="color:#000;">Category icon</label>  <input class="form-control input-lg" id="cat-icon" type="text" name="icon" placeholder="fa-usd"   value="'+$icon+'"> </div> <input class="form-control input-lg" id="cat-id" type="hidden" name="id"  value="'+$id+'" > <div class="text-right">  <button type="submit" class="btn btn-success">'+quickad_lang_save+'</button> <button type="button" id="cancel-button" class="btn btn-default">'+quickad_lang_cancel+'</button>  </div>  </form> </div> <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%"> <a href="#" class="fa fa-edit quickad-margin-horizontal-xs quickad-js-edit" title="Edit"></a> </div> <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%"> <a href="#" class="fa fa-trash text-danger quickad-js-delete" title="Delete"></a> </div> </div> </li>';
                $('#quickad-category-item-list').append(appendtpl);
            }

        });
        $new_category_popover.popover('hide');
        return false;
    });

    // Cancel button.
    $new_category_form.on('click', 'button[type="button"]', function (e) {
        $new_category_popover.popover('hide');
    });

    var $new_subcategory_popover = $('.new-subcategory'),
        $new_subcategory_form = $('#new-subcategory-form'),
        $new_subcategory_name = $('#new-subcategory-name');

    $new_subcategory_popover.popover({
        html: true,
        placement: 'bottom',
        template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        content: $new_subcategory_form.show().detach(),
        trigger: 'manual'
    }).on('click', function () {
        $(this).popover('toggle');
    }).on('shown.bs.popover', function () {
        // focus input
        $new_subcategory_name.focus();
    }).on('hidden.bs.popover', function () {
        //clear input
        $new_subcategory_name.val('');
    });

    // Save new category.
    $new_subcategory_form.on('submit', function() {
        var id = $('.quickad-category-item.active').data('category-id');
        $('#cat-id').val(id);
        var data = $(this).serialize();
        $.post(ajaxurl+'?action=addSubCat', data, function(response) {
            if(response != 0){
                $data = response.split(',');
                $name = $data[0];
                $id = $data[1];
                var appendtpl = '<div class="panel panel-default quickad-js-collapse" data-service-id="'+$id+'"> <div class="panel-heading" role="tab" id="s_'+$id+'"> <div class="row"> <div class="col-sm-8 col-xs-10"> <div class="quickad-flexbox"> <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%"> <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder"></i> </div> <div class="quickad-flex-cell quickad-vertical-middle"> <a role="button" class="panel-title collapsed quickad-js-service-title" data-toggle="collapse" data-parent="#services_list"  href="#service_'+$id+'" aria-expanded="false" aria-controls="service_'+$id+'">'+$name+' </a> </div> </div> </div> <div class="col-sm-4 col-xs-2"> <div class="quickad-flexbox"> <div class="quickad-flex-cell quickad-vertical-middle text-right" style="width: 10%"> <div class="checkbox quickad-margin-remove"> <label><input type="checkbox" class="service-checker" value="'+$id+'"></label> </div> </div> </div> </div> </div> </div> <div id="service_'+$id+'" class="panel-collapse collapse" role="tabpanel"style="height: 0"> <div class="panel-body"> <form method="post" id="'+$id+'"> <div class="row"> <div class="col-md-12 col-sm-6"> <div class="form-group"> <label for="title_'+$id+'">Title</label> <input name="title" value="'+$name+'" id="title_'+$id+'" class="form-control" type="text"> <input name="id" value="'+$id+'" type="hidden"> </div> </div> </div> <div class="panel-footer"> <button type="button" class="btn btn-lg btn-success ladda-button ajax-service-send" data-style="zoom-in" data-spinner-size="40" onclick="editSubCat('+$id+');"><span class="ladda-label">'+quickad_lang_save+'</span></button> <button class="btn btn-lg btn-default js-reset" type="reset">'+quickad_lang_reset+' </button> </div> </form> </div> </div> </div>';
                $('#ab-services-list').append(appendtpl);
                quickadAlert({success: [quickad_lang_created]});
            }else{
                quickadAlert({error: [quickad_lang_problem]});
            }

        });
        $new_subcategory_popover.popover('hide');
        return false;
    });

    // Cancel button.
    $new_subcategory_form.on('click', 'button[type="button"]', function (e) {
        $new_subcategory_popover.popover('hide');
    });

    // Categories list delegated events.
    $('#quickad-categories-list')

        // On category item click.
        .on('click', '.quickad-category-item', function(e) {
            if ($(e.target).is('.quickad-js-handle')) return;
            $('#ab-services-list').html('<div class="quickad-loading"></div>');
            var $clicked = $(this);

            $.get(ajaxurl, {action:'getSubCat', category_id: $clicked.data('category-id')}, function(response) {
                if ( response != 0 ) {
                    $('.quickad-category-title').text($clicked.find('.displayed-value').text());
                    $('#ab-services-list').html(response);
                }else{
                    $('#ab-services-list').html('<h3>'+quickad_lang_nofound+'</h3>');
                }
                $('.quickad-category-item').not($clicked).removeClass('active');
                $clicked.addClass('active');
                if($clicked.data('category-id') != undefined){
                    $('.new-subcategory').show();
                }else{
                    $('.new-subcategory').hide();
                }
            });
        })

        // On edit category click.
        .on('click', '.quickad-js-edit', function(e) {
            // Keep category item click from being executed.
            e.stopPropagation();
            // Prevent navigating to '#'.
            e.preventDefault();
            var $this = $(this).closest('.quickad-category-item');
            $this.find('.displayed-value').hide();
            $this.find('#quickad-cat-icon').hide();
            $this.find('#edit-category-form').show();
        })

        // On blur save changes.
        .on('submit', '#edit-category-form', function() {
            var $this = $(this),
                $item = $this.closest('.quickad-category-item'),
                data = $this.serialize();
            $.post(ajaxurl+'?action=editCat', data, function(response) {
                if(response != 0) {
                value = response.split(',');
                    // Hide input field.
                    $item.find('form').hide();
                    $item.find('.displayed-value').show();
                    $item.find('#quickad-cat-icon').show();
                    // Show modified category name.
                    $item.find('.displayed-value').text(value[0]);
                    $item.find('#quickad-cat-icon').attr('class','quickad-margin-right-sm fa '+ value[1]);
                    quickadAlert({success: [quickad_lang_edited]});
                }else{
                    quickadAlert({error: [quickad_lang_problem]});
                }
            });
            return false;
        })



.on('click', '#cancel-button', function(e) {
e.stopPropagation();
            // Prevent navigating to '#'.
            e.preventDefault();
var $item = $(this).closest('.quickad-category-item');
            $item.find('form').hide();
                    $item.find('.displayed-value').show();
                    $item.find('#quickad-cat-icon').show();
        })



        // On press Enter save changes.
        .on('keypress', 'input', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                $(this).blur();
            }
        })

        // On delete category click.
        .on('click', '.quickad-js-delete', function(e) {
            // Keep category item click from being executed.
            e.stopPropagation();
            // Prevent navigating to '#'.
            e.preventDefault();
            // Ask user if he is sure.
            if (confirm('Are you sure?')) {
                var $item = $(this).closest('.quickad-category-item');
                var data = { action: 'deleteCat', id: $item.data('category-id') };
                $.post(ajaxurl, data, function(response) {
                    // Remove category item from DOM.
                    $item.remove();
                    if ($item.is('.active')) {
                        $('.quickad-js-all-services').click();
                    }
                });
            }
        })

        .on('click', 'input', function(e) {
            e.stopPropagation();
        });

    // Services list delegated events.
    $('#quickad-services-wrapper')
        // On click on 'Delete' button.
        .on('click', '#quickad-delete', function(e) {
            if (confirm('Are you sure?')) {

                var $for_delete = $('.service-checker:checked'),
                    data = { action: 'delSubCat' },
                    services = [],
                    $panels = [];

                $for_delete.each(function(){
                    var panel = $(this).parents('.quickad-js-collapse');
                    $panels.push(panel);
                    services.push(this.value);
                });
                data['subCatids[]'] = services;
                $.post(ajaxurl, data, function(response) {
                    if(response != 0) {
                        $.each($panels.reverse(), function (index) {
                            $(this).delay(500 * index).fadeOut(200, function () {
                                $(this).remove();
                            });
                        });
                        quickadAlert({success: [quickad_lang_deleted]});
                    }else{
                        quickadAlert({error: [quickad_lang_problem]});
                    }
                });
            }
        });

});

function editSubCat(id){
    var data = $('#'+id).serialize();
    $.post(ajaxurl+'?action=editSubCat&'+data, function (response) {
        if (response != 0) {
            quickadAlert({success: [quickad_lang_edited]});
        } else {
            quickadAlert({error: [quickad_lang_problem]});
    }
});
}

$(window).bind("load", function() {
    $('.quickad-category-item:first').trigger('click');
});