jQuery(function($) {
    alertify.logPosition("top right");
    // Ads list delegated events.
    $('#ajax-services').on('click', '.item-js-delete', function(e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.
        var action = $(this).data('ajax-action'),
            $item = $(this).closest('tr'),
            data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to delete this.!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Yes, Delete!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    // Remove Ads item from DOM.
                    if(response != 0) {
                        $item.remove();
                        hideSiteActionBtn();
                        alertify.success("Deleted! item has been Deleted.");
                    }else{
                        alertify.error("Problem in deleting, Please try again.");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                },
                error: function (response, textStatus, errorThrown) {
                    alertify.error("Problem in deleting, Please try again.");
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                }
            });
        });
    });

    //Delete Marked.
    $("[data-ajax-response='deletemarked']").on("click", function (e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.
        var action = $(this).data('ajax-action');
        var $for_delete = $('.service-checker:checked'),
            data = { action: action},
            services = [],
            $panels = [];

        $for_delete.each(function(){
            var panel = $(this).parents('tr');
            $panels.push(panel);
            services.push(this.value);
        });
        data['list[]'] = services;

        swal({
            title: "Are you sure?",
            text: "You want to delete this.!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Yes, Delete!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $.each($panels.reverse(), function (index) {
                            $(this).delay(500 * index).fadeOut(200, function () {
                                $(this).remove();
                            });
                        });
                        refreshAjaxTable();
                        alertify.success("Deleted! item has been Deleted.");
                    }else{
                        alertify.error("Problem in deleting, Please try again.");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                },
                error: function (response, textStatus, errorThrown) {
                    alertify.error("Problem in deleting, Please try again.");
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                }
            });
        });
    });
    //Delete/Reject/Approve Single Ad From Detail Page
    $('#js-delete-single').on('click', '.item-js-action', function(e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.

        var action = $(this).data('ajax-action');
        var $item = $(this).closest('.ajax-item-listing');
        var data = { action: action, id: $item.data('item-id') };

        var color;
        var type = $(this).data('ajax-type');
        if(type == "approve"){
            color = "#8BC34A";
        }
        else if(type == "delete" || type == "reject"){
            color = "#f44336";
        }
        swal({
            title: "Are you sure?",
            text: "You want to "+type+" this.!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: color,
            confirmButtonText: "Yes, "+type+"!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    // Remove Ads item from DOM.
                    if(response != 0) {
                        alertify.success(type+"! Item has been "+type+".");
                        swal.close();
                        window.location.href = 'posts.php';
                    }else{
                        swal("Error!", "Problem in "+type+", Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in "+type+", Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                    swal.close();
                }
            });
        });
    });
    //Approve Ads
    $('#ajax-services').on('click', '.item-approve', function(e) {
        e.stopPropagation();
        e.preventDefault();

        var action = $(this).data('ajax-action');
        var $item = $(this).closest('tr');
        var data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to Approve this Item.!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#8BC34A",
            confirmButtonText: "Yes, Approve!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');

            $.post(ajaxurl+'?action='+action, data, function(response) {
                    if(response != 0) {
                        $item.find('.label').html("Approved");
                        $item.find('.label').removeClass('label-warning');
                        $item.find('.label').addClass('label-success');
                        $item.find('.item-approve').remove();

                        alertify.success("Approved! Item has been Approved.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in Item Approved, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');

            });
        });
    });

    //ACTIVE BANNED USER
    $('#ajax-services').on('click', '.user-js-active', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('tr');
        var data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to activate this user.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#8BC34A",
            confirmButtonText: "Yes, Activate it!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $item.find('.label').html("ACTIVE");
                        $item.find('.label').removeClass('label-warning');
                        $item.find('.label').addClass('label-info');
                        $item.find('.user-js-active').remove();
                        alertify.success("Activated! User has been Activated.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in User Activate, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in User Activate, Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                }
            });
        });
    });

    //BANNED USER
    $('#ajax-services').on('click', '.user-js-ban', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('tr');
        var data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to ban this user.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Yes, Ban it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                jQuery('.confirm').addClass('bookme-progress');
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: ajaxurl+'?action='+action,
                    success: function (response, textStatus, jqXHR) {
                        if(response != 0) {
                            $item.find('.label').html("BANNED");
                            $item.find('.label').removeClass('label-info');
                            $item.find('.label').addClass('label-warning');
                            $item.find('.user-js-ban').remove();
                            alertify.success("Banned! User has been Banned.");
                        }else{
                            swal("Error!", "Problem in User Ban, Please try again.", "error");
                        }
                        jQuery('.confirm').removeClass('bookme-progress');
                    },
                    error: function (response, textStatus, errorThrown) {
                        swal("Error!", "Problem in User Ban, Please try again.", "error");
                        jQuery('.confirm').removeClass('bookme-progress');
                    }
                });
            } else {
                swal("Cancelled", "This User is safe :)", "error");
            }
        });

    });


    //Install Country
    $('#ajax-services').on('click', '.install-country', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('tr');
        var data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to install this country.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#8BC34A",
            confirmButtonText: "Yes, Install it!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $item.find('.label').html("Installed");
                        $item.find('.label').removeClass('label-warning');
                        $item.find('.label').addClass('label-info');
                        $item.find('.install-country').remove();

                        alertify.success("Installed! Country has been Installed.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in Installation, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in Installation, Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                }
            });
        });
    });

    //Uninstall Country
    $('#js-table-list').on('click', '.uninstall-country', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('tr');
        var data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to Uninstall Country.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Yes, Uninstall it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $item.find('.label').html("Uninstall");
                        $item.find('.label').removeClass('label-info');
                        $item.find('.label').addClass('label-warning');
                        $item.find('.uninstall-country').remove();
                        alertify.success("Uninstalled! Country has been Uninstalled.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in Uninstall, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in Uninstall, Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                }
            });
        });

    });

    //Payment Install
    $('#js-table-list').on('click', '.install-payment', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action'),
            $item = $(this).closest('tr'),
            data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to install this Payment.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#8BC34A",
            confirmButtonText: "Yes, Install it!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $('#ajax_datatable').DataTable().ajax.reload();

                        alertify.success("Installed! Payment has been Installed.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in Installation, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in Installation, Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                }
            });
        });
    });

    //Payment Uninstall
    $('#js-table-list').on('click', '.uninstall-payment', function(e) {
        e.stopPropagation();
        e.preventDefault();

        //Parameter
        var action = $(this).data('ajax-action'),
            $item = $(this).closest('tr'),
            data = { action: action, id: $item.attr('id') };
        swal({
            title: "Are you sure?",
            text: "You want to Uninstall Payment.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Yes, Uninstall it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false
        }, function(){
            jQuery('.confirm').addClass('bookme-progress');
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl+'?action='+action,
                success: function (response, textStatus, jqXHR) {
                    if(response != 0) {
                        $('#ajax_datatable').DataTable().ajax.reload();
                        alertify.success("Uninstalled! Payment has been Uninstalled.");
                        swal.close();
                    }else{
                        swal("Error!", "Problem in Uninstall, Please try again.", "error");
                    }
                    jQuery('.confirm').removeClass('bookme-progress');
                },
                error: function (response, textStatus, errorThrown) {
                    swal("Error!", "Problem in Uninstall, Please try again.", "error");
                    jQuery('.confirm').removeClass('bookme-progress');
                }
            });
        });

    });

});

$(document).ready(function () {

    $("#category").change(function(){
        var catid = $(this).val();
        var action = $(this).data('ajax-action');
        var data = { action: action, catid: catid };
        $.ajax({
            type: "POST",
            url: ajaxurl+"?action="+action,
            data: data,
            success: function(result){
                $("#sub_category").html(result);
            }
        });
    });

    $("#country").change(function () {
        var id = $(this).val();
        var action = $(this).data('ajax-action');
        var data = {action: action, id: id};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function (result) {
                $("#state").html(result);
                $("#state").select2();
                $("#city").html('');
                $("#city").select2();
            }
        });
    });

    $("#state").change(function () {
        var id = $(this).val();
        var action = $(this).data('ajax-action');
        var data = {action: action, id: id};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function (result) {
                $("#city").html(result);
                $("#city").select2();
            }
        });
    });

    $("#statetoDistrict").change(function () {
        var id = $(this).val();
        var country = $(this).data('country');
        var stateid = country+'.'+id;
        var action = $(this).data('ajax-action');
        var data = {action: action, id: stateid};
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function (result) {
                $("#district").html(result);
            }
        });
    });

    $("#editAjaxForm").on('submit', function() {

        $("#editAjaxForm #login-status").show();
        var action = $("#editAjaxForm").attr('action');
        var form_data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: ajaxurl+'?action='+action,
            data: form_data,
            success: function (response) {
                if (response == "success") {
                    $("#editAjaxForm #login-status").removeClass('info-notice').addClass('success-notice');
                    $("#editAjaxForm #login-status #login-status-message").html('Setting Saved....');
                    location.reload();
                }
                else {
                    $("#editAjaxForm #login-status").removeClass('info-notice').addClass('error-notice');
                    $("#editAjaxForm #login-status #login-status-message").html(response);
                }
            }
        });
        return false;
    });

    $("#addAjaxForm").on('submit', function() {

        $("#addAjaxForm #login-status").show();
        var action = $("#addAjaxForm").attr('action');
        var form_data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: ajaxurl+'?action='+action,
            data: form_data,
            success: function (response) {
                if (response == "success") {
                    $("#addAjaxForm #login-status").removeClass('info-notice').addClass('success-notice');
                    $("#addAjaxForm #login-status #login-status-message").html('Setting Saved....');
                    location.reload();
                }
                else {
                    $("#addAjaxForm #login-status").removeClass('info-notice').addClass('error-notice');
                    $("#addAjaxForm #login-status #login-status-message").html(response);
                }
            }
        });
        return false;
    });

    $("#findCityStateCountry").keyup(function () {
        var searchbox = $(this).val();
        var dataString = 'searchword1=' + searchbox;
        var action = "searchCityStateCountry";
        var data = {action: action, dataString: searchbox};

        if (searchbox == '') {
            $('#FindResultDisplay').hide();
        }
        else {
            $('#FindResultDisplay').show();
            $.post(ajaxurl, data, function (result) {
                $("#FindResultDisplay").html(result).show();
            });
            $.ajax({
                type: 'POST',
                data: data,
                url: ajaxurl,
                success: function (result, textStatus, jqXHR) {
                    $("#FindResultDisplay").html(result).show();
                },
                error: function (response, textStatus, errorThrown) {
                    console.log("error to FindResultDisplay");
                }
            });
        }
        return false;
    });

    $('#select-post-ad-city').on('click', 'ul li .selectme', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var cityId = $(this).data('cityid');
        var stateId = $(this).data('stateid');
        var countryId = $(this).data('countryid');
        $('#findCityStateCountry').val(name);
        $('#searchPlaceId').val(cityId);
        $('#searchplaceState').val(stateId);
        $('#searchplaceCountry').val(countryId);

        $("#FindResultDisplay").html('').hide();
    });

});

// Ajax Data table functionality
var uiHelperTableToolsAjax = function() {
    var $jsonfile = jQuery( '#ajax_datatable').data('jsonfile');
    jQuery('#ajax_datatable').DataTable({
        "bProcessing": true,
        "serverSide": true,
        columnDefs: [
            { orderable: false, targets: [0,-1] }
        ],
        "ajax":{
            url :"datatable-json/"+$jsonfile, // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            error: function(){
                jQuery("#ajax_datatable_processing").css("display","none");
            }
        },
        "initComplete":function(){

            // call your function here
        }
    });
}

function refreshAjaxTable(){
    $('#ajax_datatable').DataTable().ajax.reload();
    $.slidePanel.hide();
    var actionBtn = $(".site-action").actionBtn().data("actionBtn");
    actionBtn.hide();
}

function hideSiteActionBtn(){
    var actionBtn = $(".site-action").actionBtn().data("actionBtn");
    actionBtn.hide();
}

function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function getcountryToStateSelected(countryid, action, selectid) {
    var data = {action: action, id: countryid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $("#state").html(result);
        }
    });
}

function getStateSelected(countryid, action, selectid) {
    var data = {action: action, id: countryid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $("#statetoDistrict").html(result);
        }
    });
}

function getDistrictSelected(stateid, action, selectid) {
    var data = {action: action, id: stateid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $("#district").html(result);
        }
    });
}

function getCitySelected(stateid, action, selectid) {
    var data = {action: action, id: stateid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $("#city").html(result);
        }
    });
}

function getsubcat(catid,action,selectid){
    var data = { action: action, catid: catid, selectid : selectid };
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function(result){
            $("#sub_category").html(result);
        }
    });
}



/*Sidepanel custom js for ajax call*/


$(document).on("click", "#post_sidePanel_data", function (e) {
    var loader = $('#post_sidePanel_data'),
        action = $('#sidePanel_form').data('ajax-action'),
        options = {
            url:  sidepanel_ajaxurl + '?action='+action,
            dataType:  'json',
            success:   showResponse
        };
    loader.addClass('bookme-progress');
    $('#sidePanel_form').ajaxSubmit(options);

    function showResponse(data, statusText, xhr, $form) {
        var loader = $('#post_sidePanel_data');
        if (data == 0) {
            alertify.error("Unknown Error generated.");
        } else {
            if (data.status == "success") {
                alertify.success(data.message);
                refreshAjaxTable();
            }
            else if (data.status == "error") {
                //console.log(typeof data["errors"]);
                if(typeof data["errors"] === 'undefined'){

                }else{
                    if(data["errors"].length > 0){
                        for(var i=0;i<data["errors"].length;i++){
                            var $message = data["errors"][i]["message"];
                            if(i == 0){
                                $('#post_error').html('<article class="byMsg byMsgError" id="formErrors">! '+$message+'</article>');
                            }else{
                                $('#post_error').append('<article class="byMsg byMsgError" id="formErrors">! '+$message+'</article>');
                            }
                        }
                    }
                }
                alertify.error(data.message);
            } else {
                alertify.error(data.message);
            }
        }
        loader.removeClass('bookme-progress');
    }
});

/*End--Sidepanel custom js for ajax call*/
