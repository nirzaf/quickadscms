$(document).ready(function() {
    // -------------------------------------------------------------
    //  prepare the form when the DOM is ready
    // -------------------------------------------------------------
    $('#submit_advertise').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        post_advertise();
    });
});
var payment_uri = '';

function post_advertise(){
    $('#submit_advertise').addClass('bookme-progress').prop('disabled', true);

    // submit the form
    $('#post-advertise-form').ajaxSubmit(function(data) {
        data = JSON.parse(data);

        if(data.status == "error"){
            if(data["errors"].length > 0){
                for(var i=0;i<data["errors"].length;i++){
                    var $message = data["errors"][i]["message"];
                    if(i == 0){
                        $('#post_error').html('<article class="byMsg byMsgError" id="formErrors">! '+$message+'</article>');
                    }else{
                        $('#post_error').append('<article class="byMsg byMsgError" id="formErrors">! '+$message+'</article>');
                    }
                }
                $('html, body').animate({
                    scrollTop: $("#post_error").offset().top
                }, 2000);
            }
            $('#submit_advertise').removeClass('bookme-progress').prop('disabled', false);
        }
        else if(data.status == "success"){
            if(data.ad_type == "package"){
                //window.location = data.redirect;
                payment_uri = data.redirect;
                $('#premium_ad_modal #display_premium_tpl').html(data.tpl);
                $('#premium_ad_modal').removeClass('hide').addClass('show');
                $('#submit_advertise').removeClass('bookme-progress').prop('disabled', false);
            }else{
                $('#post_ad_email_exist').removeClass('show').addClass('hide');
                $('#ad_post_title').hide();
                $('#ad_post_form').hide();
                $('#post_success_uploaded').show();
                var delay = 2000;
                setTimeout(function(){ window.location = data.redirect; }, delay);
                $('#submit_advertise').removeClass('bookme-progress').prop('disabled', false);
            }

        }
        else if(data.status == "email-exist"){

            $('#post_ad_email_exist #quickad_email_already_linked').html(data.errors);
            $('#post_ad_email_exist #quickad_username_display').html(data.username);
            $('#post_ad_email_exist #quickad_email_display').html(data.email);
            $('#post_ad_email_exist #username').val(data.username);
            $('#post_ad_email_exist #email').val(data.email);
            $('#post_ad_email_exist').removeClass('hide').addClass('show');
            $('#submit_advertise').removeClass('bookme-progress').prop('disabled', false);

        }



    });
    // return false to prevent normal browser submit and page navigation
    return false;

    /*// attach handler to form's submit event
     $('#post-advertise-form').submit(function(e) {
     e.stopPropagation();
     e.preventDefault();

     });*/

}

$(document).ready(function() {

    $('.quickad-template .modal .close').on('click', function () {
        $('#post_ad_email_exist').removeClass('show').addClass('hide');
        $('#premium_ad_modal').removeClass('show').addClass('hide');
    });

    $("#premium_ad_modal #paymentModalConfirmButton").click(function () {
        $('#premium_ad_modal #post_loading').show();
        $('#premium_ad_modal .ModalPayment-figure').hide();
        window.location = payment_uri;
    });
    $("#post_ad_email_exist #link_account").click(function () {
        $('#post_ad_email_exist #post_loading').show();
        var action = "ajaxlogin";
        var $formData = {
            action: action,
            username: $("#username").val(),
            password: $("#password").val(),
            is_ajax: 1
        };

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $formData,
            success: function (response) {
                if (response == "success") {
                    $('#post_ad_email_exist #link_account_welcome').hide();
                    $('#post_ad_email_exist #link_account_success').show();
                    $('#post_ad_email_exist #link_account_error').html('').hide();

                    post_advertise();
                }
                else {
                    $('#post_ad_email_exist #link_account_error').html(response).show();
                    post_advertise();
                }
                $('#post_ad_email_exist #post_loading').hide();
            }
        });
        return false;
    });

    /* Get and Bind cities */
    $('#postadcity').select2({
        ajax: {
            url: ajaxurl + '?action=searchCityFromCountry',
            dataType: 'json',
            delay: 50,
            data: function (params) {
                var query = {
                    q: params.term, /* search term */
                    page: params.page
                };

                return query;
            },
            processResults: function (data, params) {
                /*
                 // parse the results into the format expected by Select2
                 // since we are using custom formatting functions we do not need to
                 // alter the remote JSON data, except to indicate that infinite
                 // scrolling can be used
                 */
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalEntries
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, /* let our custom formatter work */
        minimumInputLength: 2,
        templateResult: function (data) {
            return data.text;
        },
        templateSelection: function (data, container) {
            return data.text;
        }
    });

    $('.file-upload-previews').on('click','#removeAdImg', function(e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.

        var id = $(this).data('item-id');
        var img = $(this).data('img-name');
        var action = 'removeAdImg';
        var $item = $(this).closest('.MultiFile-label');



        var delPrevImg = $('#deletePrevImg').val();
        if(delPrevImg != ""){
            $('#deletePrevImg').val(delPrevImg+','+img);
        }else{
            $('#deletePrevImg').val(img);
        }
        $('.file-upload').show();
        $item.remove();
        /*
         var data = { action: action, id: id, img : img };
         $.ajax({
         type: "POST",
         url: ajaxurl,
         data: data,
         success: function (result) {
         if(result == 1)
         {
         $item.remove();
         location.reload();
         }
         else
         {
         alert('Some error occurred.');
         }
         },
         error: function (result)
         {
         alert('Some error occurred.');
         }
         });*/
    });
});

//  Enable image previews in multi file input --------------------------------------------------------------------------
if ($("input[type=file].with-preview").length) {
    $("input.file-upload-input").MultiFile({
        list: ".file-upload-previews"
    });
}

$('#premium_ad_modal form').bind("keypress", function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});
$('#post_ad_email_exist form').bind("keypress", function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});


/*--------------------------------------
 POST SLIDER
 --------------------------------------*/
if(jQuery('#tg-dbcategoriesslider').length > 0){

    if ($("body").hasClass("rtl")) var rtl = true;
    else rtl = false;
    var _tg_postsslider = jQuery('#tg-dbcategoriesslider');
    _tg_postsslider.owlCarousel({
        items : 4,
        nav: true,
        rtl: rtl,
        loop: false,
        dots: false,
        autoplay: false,
        dotsClass: 'tg-sliderdots',
        navClass: ['tg-prev', 'tg-next'],
        navContainerClass: 'tg-slidernav',
        navText: ['<span class="icon-chevron-left"></span>', '<span class="icon-chevron-right"></span>'],
        responsive:{
            0:{ items:2, },
            640:{ items:3, },
            768:{ items:4, },
        }
    });
}
// -------------------------------------------------------------
//  select-main-category Change
// -------------------------------------------------------------
$('.select-category.post-option .tg-category').on('click', function () {
    $('.select-category.post-option .tg-category.selected').removeClass('selected');
    $(this).addClass('selected');
    $('#sub-category-loader').css("visibility", "visible");
    var catid = $(this).data('ajax-catid');
    var action = $(this).data('ajax-action');
    var data = {action: action, catid: catid};
    $('#main-category-text').html($(this).data('cat-name'));
    $('#input-maincatid').val(catid);
    getsubcat(catid, action, "");
    $(".tg-subcategories").show();
    $('#sub-category-loader').css("visibility", "hidden");
    $('#input-subcatid').val('');
    $('#sub-category-text').html('--');
});
// -------------------------------------------------------------
//  select-sub-category Change
// -------------------------------------------------------------
$('#sub_category').on('click', 'li', function (e) {
    var $item = $(this).closest('li');
    $('#sub_category li.selected').removeClass('selected active');
    $item.addClass('selected');
    var subcatid = $item.data('ajax-subcatid');
    var photoshow = $item.data('photo-show');
    var priceshow = $item.data('price-show');
    $('#input-subcatid').val(subcatid);
    $('#sub-category-text').html($item.text());

    $('#change-category-btn').show();
    // -------------------------------------------------------------
    //  Get custom fields
    // -------------------------------------------------------------
    var catid = $('#input-maincatid').val();
    var action = 'getCustomFieldByCatID';
    var data = { action: action, catid: catid , subcatid: subcatid };
    $.ajax({
        type: "POST",
        url: ajaxurl+"?action="+action,
        data: data,
        success: function(result){
            if(result!=0){
                $("#ResponseCustomFields").html(result);
                $('#custom-field-block').show();
            }
            else{
                $('#custom-field-block').hide();
                $("#ResponseCustomFields").html('');
            }

        }
    });
    if(photoshow == 1){
        $('#quickad-photo-field').show();
    }else{
        $('#quickad-photo-field').hide();
    }
    if(priceshow == 1){
        $('#quickad-price-field').show();
    }else{
        $('#quickad-price-field').hide();
    }
    $('#choose-category').text(lang_edit_cat);
    $( "#dismiss-modal" ).trigger( "click");
});

function getsubcat(catid, action, selectid) {

    var data = {action: action, catid: catid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl + '?action=' + action,
        data: data,
        success: function (result) {
            $("#sub_category").html(result);
        }
    });
}

function fillPrice(obj,val)
{
    if ($(obj).is(':checked')) {
        var a = $('#totalPrice').text();
        var c = parseInt(a, 10) + parseInt(val, 10);
    }
    else{
        var a = $('#totalPrice').text();
        var c = parseInt(a, 10) - parseInt(val, 10);
    }

    $('#totalPrice').html(c);
}
