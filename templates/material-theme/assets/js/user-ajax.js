jQuery(function ($) {
    // Ads list delegated events.
    // On delete Ad clickc(Single Delete).
    $('#js-table-list').on('click', '.item-js-delete', function (e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('.ajax-item-listing');
        var data = {action: action, id: $item.data('item-id')};
        /*swal("Permission Denied!", "You can't delete ads in demo site.", "warning");
        return ;*/
        swal({
            title: LANG_ARE_YOU_SURE,
            text: LANG_YOU_WANT_DELETE,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#c9302c",
            confirmButtonText: LANG_YES_DELETE,
            cancelButtonText: LANG_CANCEL,
            closeOnConfirm: false
        }, function () {
            $.post(ajaxurl + '?action=' + action, data, function (response) {
                if (response != 0) {
                    $item.remove();
                    swal(LANG_DELETED+"!", LANG_AD_DELETED, "success");
                } else {
                    swal(LANG_ERROR+"!", LANG_ERROR_TRY_AGAIN, "error");
                }
            });
        });
    });

    $('#js-table-list').on('click', '.item-js-hide', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var action = $(this).data('ajax-action');
        var $item = $(this).closest('.ajax-item-listing');
        var data = {action: action, id: $item.data('item-id')};

        $.post(ajaxurl + '?action=' + action, data, function (response) {
            if (response == 1) {
                $item.addClass('opapcityLight');
                $item.find('.label-hidden').html(LANG_HIDDEN)
                $item.find('.item-js-hide').html('<i class="fa  fa-eye"></i>'+LANG_SHOW);
            }
            else if (response == 2) {
                $item.removeClass('opapcityLight');
                $item.find('.label-hidden').html(LANG_SHOW)
                $item.find('.item-js-hide').html('<i class="fa  fa-eye-slash"></i>'+LANG_HIDE);
            }
            else {
                alert(LANG_ERROR_TRY_AGAIN);
            }
        });
    });

    $("#category").change(function () {
        var catid = $(this).val();
        var action = $(this).data('ajax-action');
        var data = {action: action, catid: catid};
        $.ajax({
            type: "POST",
            url: ajaxurl + "?action=" + action + "?catid=" + catid,
            data: data,
            success: function (result) {
                //$("#sub_category").html(result);
                var $selectDropdown = $("#sub_category");
                $selectDropdown.empty().html('');
                $selectDropdown.append($("<option></option>").attr("value", "hi").text("tit"));
                $selectDropdown.trigger('contentChanged');

                $('#sub_category').on('contentChanged', function () {
                    // re-initialize (update)
                    $(this).material_select();
                });
            }
        });
        //$('#sub_category.meterialselect').material_select('destroy');
    });

    $('#serchlist').on('click','.add-to-fav a', function(e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.

        var adId = $(this).data('item-id');
        var userId = $(this).data('userid');
        var action = $(this).data('action');
        var $item = $(this).closest('.item');

        if (userId == 0) {
            window.location.href = loginurl;
        }

        $('.fav_'+adId).html('<i class="fa fa-spinner"></i>');

        var data = { action: action, id: adId, userId : userId };
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function(result){
                if (result == 1) {
                    if(action == 'removeFavAd'){
                        $item.remove();
                        var val = $('#favCount').text();
                        var favcount = val-1;
                        $('#favCount').html(favcount);

                    }
                    else{
                        $('.fav_'+adId).html('<i class="fa fa-heart"></i>');
                        $('.fav_'+adId).attr('data-original-title',LANG_REMOVE_FAV);
                        $('.tooltip').remove();
                    }

                }
                else if(result == 2){
                    $('.fav_'+adId).html('<i class="fa fa-heart-o"></i>');
                    $('.fav_'+adId).attr('data-original-title',LANG_ADD_FAV);
                    $('.tooltip').remove();
                }
                else{
                    alert(LANG_ERROR_TRY_AGAIN);
                }
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
                $("#city").html('<option value="">'+LANG_SELECT_CITY+'</option>');
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
            }
        });
    });

    $('#country-popup').on('click', '#getCities ul li .statedata', function (e) {

        e.stopPropagation();
        e.preventDefault();
        $('#getCities #results').hide();
        $('#getCities .loader').show();
        var $item = $(this).closest('.statedata');
        var id = $item.data('id');
        var action = "ModelGetCityByStateID";
        var data = {action: action, id: id};

        $.post(ajaxurl, data, function (result) {
            $("#getCities #results").html(result);
            $('#getCities .loader').hide();
            $('#getCities #results').show();
        });
    });

    $('#country-popup').on('click', '#getCities ul li #changeState', function (e) {
        // Keep ads item click from being executed.
        e.stopPropagation();
        // Prevent navigating to '#'.
        e.preventDefault();
        // Ask user if he is sure.
        $('#getCities #results').hide();
        $('#getCities .loader').show();
        var $item = $(this).closest('.quick-states');
        var id = $item.data('country-id');
        var action = "ModelGetStateByCountryID";
        var data = {action: action, id: id};

        $.post(ajaxurl, data, function (result) {
            $("#getCities #results").html(result);
            $('#getCities .loader').hide();
            $('#getCities #results').show();
        });
    });

    $('#country-popup').on('click', 'ul li .selectme', function (e) {

        e.stopPropagation();
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var type = $(this).data('type');
        $('#inputStateCity').val(name);
        $('#searchStateCity').val(name);
        $('#headerStateCity').html(name + ' <i class="fa fa-pencil"></i>');
        $('#searchPlaceType').val(type);
        $('#searchPlaceId').val(id);

        /*$.cookie('Quick_placeText',name,"1","/");
         $.cookie('Quick_PlaceId',id,"1","/");
         $.cookie('Quick_PlaceType',type,"1","/");*/
        localStorage.Quick_placeText = name;
        localStorage.Quick_PlaceId = id;
        localStorage.Quick_PlaceType = type;
        if(name != "" && id != "")
            $('#clear-city').show();
        else
            $('#clear-city').hide();

        $("#searchDisplay").html('').hide();
    });

});
function clear_localStorage_city(){
    localStorage.Quick_placeText = "";
    localStorage.Quick_PlaceId = "";
    localStorage.Quick_PlaceType = "";
    $('#FindResultDisplay').hide();
    $('#searchDisplay').hide();
}
$(function () {
    $('#searchStateCity').focus(function () {
        $('#change-city').trigger('click');
    });

    if (localStorage.Quick_placeText != "") {
        var placeText = localStorage.Quick_placeText;
        var PlaceId = localStorage.Quick_PlaceId;
        var PlaceType = localStorage.Quick_PlaceType;

        if (placeText != null) {
            $('#inputStateCity').val(placeText);
            $('#searchStateCity').val(placeText);
            $('#headerStateCity').html(placeText + ' <i class="fa fa-pencil"></i>');
            $('#searchPlaceId').val(PlaceId);
            $('#searchPlaceType').val(PlaceType);
            $('#clear-city').show();
        }
    }

    $('#selectCountry').on('click', 'ul li a', function (e) {
        e.stopPropagation();
        e.preventDefault();

        clear_localStorage_city();
        var url = $(this).attr('href');
        window.location.href = url;
    });

    $('#clear-city').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();

        clear_localStorage_city();
        $('#inputStateCity').val('');
        $('#clear-city').hide();
    });

    $("#inputStateCity").keyup(function () {
        var searchbox = $(this).val();
        var dataString = 'searchword1=' + searchbox;

        var action = "searchStateCountry";
        var data = {action: action, dataString: searchbox};

        if (searchbox == '') {
            $('#clear-city').hide();
            $('#searchDisplay').hide();
        }
        else {
            $('#clear-city').show();
            $('#searchDisplay').show();
            $.post(ajaxurl, data, function (result) {
                $("#searchDisplay").html(result).show();
            });
        }
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

$(document).ready(function () {
    $("#login").click(function () {
        $("#login-status").show();
        var action = $("#lg-form").attr('action');
        var form_data = {
            action: action,
            username: $("#username").val(),
            password: $("#password").val(),
            is_ajax: 1
        };

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: form_data,
            success: function (response) {
                if (response == "success") {
                    $("#lg-form").slideUp('slow', function () {
                        $("#login-status").removeClass('info-notice').addClass('success-notice');
                        $("#login-status #login-status-message").html(LANG_LOGGED_IN_SUCCESS);
                        location.reload();
                    });
                }
                else {
                    $("#login-status").removeClass('info-notice').addClass('error-notice');
                    $("#login-status #login-status-message").html(response);
                }
            }
        });
        return false;
    });
});

function getStateSelected(countryid, action, selectid) {
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

function getsubcat(catid, action, selectid) {
    var data = {action: action, catid: catid, selectid: selectid};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $("#sub_category").html(result);
        }
    });
}

function removeFav(adId, userId) {
    $.ajax({
        url: ajaxurl + "?action=removeFavAd&id=" + adId + "&userId=" + userId,
        type: 'post',
        success: function (result) {
            if (result == '1') {
                window.location.href = "../../../../php/listing.php";
            }
        }
    });
}


var w = 400;
var h = 580;
var left = (screen.width / 2) - (w / 2);
var top = (screen.height / 2) - (h / 2);
function fblogin() {
    var newWin = window.open(siteurl+"includes/social_login/facebook/index.php", "fblogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,display=popup, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}

function gmlogin() {
    var newWin = window.open(siteurl+"includes/social_login/google/index.php", "gmlogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}

$(document).ready(function () {
    $('#button').click(function (e) { // Button which will activate our modal
        $('.modal').reveal({ // The item which will be opened with reveal
            animation: 'fade',                   // fade, fadeAndPop, none
            animationspeed: 600,                       // how fast animtions are
            closeonbackgroundclick: true,              // if you click background will modal close?
            dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
        });
        return false;
    });

});

$('.meterialselect').material_select();

$(".modal-trigger").on("click", function (e) {
    e.preventDefault();
    $(".modal-container").removeClass("active");
    $($(this).attr("href")).addClass("active");
});

$('#LocationForm form').bind("keypress", function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});

jQuery(document).ready(function($) {
    var inputField = jQuery('.qucikad-ajaxsearch-input');
    var inputSubcatField = jQuery('#input-subcat');
    var inputCatField = jQuery('#input-maincat');
    var inputKeywordsField = jQuery('#input-keywords');
    var myDropDown = jQuery("#qucikad-ajaxsearch-dropdown");
    var myDropDown1 = jQuery("#qucikad-ajaxsearch-dropdown ul li");
    var myDropOption = jQuery('#qucikad-ajaxsearch-dropdown > option');
    var html = jQuery('html');
    var select = jQuery('.qucikad-ajaxsearch-input, #qucikad-ajaxsearch-dropdown > option');
    var lps_tag = jQuery('.qucikad-as-tag');
    var lps_cat = jQuery('.qucikad-as-cat');


    jQuery("#def-cats").append(jQuery('#qucikad-ajaxsearch-dropdown ul').html());

    var length = myDropOption.length;
    inputField.on('click', function(event) {
        //event.preventDefault();
        myDropDown.attr('size', length);
        myDropDown.css('display', 'block');
    });

    //myDropDown1.on('click', function(event) {
    jQuery(document).on('click', '#qucikad-ajaxsearch-dropdown ul li', function(event) {
        myDropDown.attr('size', 0);
        var dropValue =  jQuery.trim(jQuery(this).text());
        var tagVal =  jQuery(this).data('tagid');
        var catVal =  jQuery(this).data('catid');
        var moreVal =  jQuery(this).data('moreval');

        inputField.val(dropValue);
        inputSubcatField.val(tagVal);
        inputCatField.val(catVal);
        if( tagVal==null && catVal==null && moreVal!=null){
            inputField.val(moreVal);
            inputKeywordsField.val(moreVal);
        }
        jQuery("form i.qucikad-ajaxsearch-close").css("display","block");
        myDropDown.css('display', 'none');
    });

    jQuery('form i.qucikad-ajaxsearch-close').on('click', function(){
        jQuery("form i.qucikad-ajaxsearch-close").css("display","none");
        jQuery('form .qucikad-ajaxsearch-input').val('');
        jQuery("img.loadinerSearch").css("display","block");
        var qString = '';

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: {
                'action': 'quickad_ajax_home_search',
                'tagID': qString
            },
            success: function (data) {
                if (data) {
                    jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
                    var resArray = [];
                    if (data.suggestions.cats) {
                        jQuery.each(data.suggestions.cats, function (i, v) {
                            resArray.push(v);
                        });

                    }
                    jQuery('img.loadinerSearch').css('display', 'none');
                    jQuery("#qucikad-ajaxsearch-dropdown ul").append(resArray);
                    myDropDown.css('display', 'block');
                }
            }
        });
        jQuery('img.loadinerSearch').css('display','none');
    });

    html.on('click', function(event) {
        //event.preventDefault();
        myDropDown.attr('size', 0);
        myDropDown.css('display', 'none');

        jQuery("#searchDisplay").css('display', 'none');
    });

    select.on('click', function(event) {
        event.stopPropagation();
    });

    var resArray = [];
    var newResArray = [];
    var bufferedResArray = [];
    var prevQString = '?';

    function trimAttributes(node) {
        jQuery.each(node.attributes, function() {
            var attrName = this.name;
            var attrValue = this.value;
            // remove attribute name start with "on", possible unsafe,
            // for example: onload, onerror...
            //
            // remvoe attribute value start with "javascript:" pseudo protocol, possible unsafe,
            // for example href="javascript:alert(1)"
            if (attrName.indexOf('on') == 0 || attrValue.indexOf('javascript:') == 0) {
                jQuery(node).removeAttr(attrName);
            }
        });
    }

    function sanitize(html) {
        var output = jQuery($.parseHTML('<div>' + html + '</div>', null, false));
        output.find('*').each(function() {
            trimAttributes(this);
        });
        return output.html();
    }

    inputField.on('input', function(){
        $this = jQuery(this);
        var qString = sanitize(this.value);
        lpsearchmode = jQuery('body').data('lpsearchmode');
        lpsearchmode = "titlematch";
        noresultMSG = jQuery(this).data('noresult');
        jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
        jQuery("#qucikad-ajaxsearch-dropdown ul li").remove();
        prevQuery = $this.data('prev-value');
        $this.data( "prev-value", qString.length );


        if(qString.length==0){

            defCats = jQuery('#def-cats').html();
            myDropDown.css('display', 'none');
            jQuery("#qucikad-ajaxsearch-dropdown ul").empty();

            jQuery("#qucikad-ajaxsearch-dropdown ul").append(defCats);
            myDropDown.css('display', 'block');
            $this.data( "prev-value", qString.length );

        }
        else if( (qString.length==1 && prevQString!=qString) || (qString.length==1 && prevQuery < qString.length) ){

            myDropDown.css('display', 'none');
            jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
            resArray = [];
            //jQuery('#selector').val().length
            jQuery("form i.qucikad-ajaxsearch-close").css("display","none");
            jQuery("img.loadinerSearch").css("display","block");
            //jQuery(this).addClass('loaderimg');
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    'action': 'quickad_ajax_home_search',
                    'tagID': qString
                },
                success: function(data){
                    if(data){

                        if(data.suggestions.tag|| data.suggestions.tagsncats || data.suggestions.cats || data.suggestions.titles){

                            if(data.suggestions.tag){
                                jQuery.each(data.suggestions.tag, function(i,v) {
                                    resArray.push(v);
                                });
                            }

                            if(data.suggestions.tagsncats){
                                jQuery.each(data.suggestions.tagsncats, function(i,v) {
                                    resArray.push(v);
                                });

                            }


                            if(data.suggestions.cats){
                                jQuery.each(data.suggestions.cats, function(i,v) {

                                    resArray.push(v);

                                });

                                if(data.suggestions.tag==null && data.suggestions.tagsncats==null && data.suggestions.titles==null ){
                                    resArray = resArray;
                                }
                                else{
                                }
                            }

                            if(data.suggestions.titles){
                                jQuery.each(data.suggestions.titles, function(i,v) {

                                    resArray.push(v);

                                });

                            }

                        }
                        else{
                            if(data.suggestions.more){
                                jQuery.each(data.suggestions.more, function(i,v) {
                                    resArray.push(v);
                                });

                            }
                        }

                        prevQString = data.tagID;

                        jQuery('img.loadinerSearch').css('display','none');
                        if(jQuery('form #select').val() == ''){
                            jQuery("form i.qucikad-ajaxsearch-close").css("display","none");
                        }
                        else{
                            jQuery("form i.qucikad-ajaxsearch-close").css("display","block");
                        }

                        bufferedResArray = resArray;
                        filteredRes = [];
                        qStringNow = jQuery('.qucikad-ajaxsearch-input').val();
                        jQuery.each( resArray, function( key, value ) {

                            if(jQuery(value).find('a').length=="1"){
                                rText = jQuery(value).find('a').text();
                            }
                            else{
                                rText = jQuery(value).text();
                            }

                            if(lpsearchmode=="keyword"){

                                qStringNow = qStringNow.toUpperCase();
                                rText = rText.toUpperCase();
                                var regxString = new RegExp(qStringNow, 'g');
                                var lpregxRest = rText.match(regxString);
                                if (lpregxRest){
                                    filteredRes.push(value);
                                }

                            }else{
                                if (rText.substr(0, qStringNow.length).toUpperCase() == qStringNow.toUpperCase()) {
                                    filteredRes.push(value);
                                }
                            }
                        });

                        if( filteredRes.length > 0){
                            myDropDown.css('display', 'none');
                            jQuery("#qucikad-ajaxsearch-dropdown ul").empty();

                            jQuery("#qucikad-ajaxsearch-dropdown ul").append(filteredRes);
                            myDropDown.css('display', 'block');
                            $this.data( "prev-value", qString.length );

                        }

                        else if( filteredRes.length < 1 && qStringNow.length < 2){
                            myDropDown.css('display', 'none');
                            jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
                            jQuery('#qucikad-ajaxsearch-dropdown ul li').remove();
                            $mResults = '<strong>'+noresultMSG+' </strong>';
                            $mResults = $mResults+qString;
                            var defRes = '<li class="qucikad-ajaxsearch-li-more-results" data-moreval="'+qString+'">'+$mResults+'</li>';
                            newResArray.push(defRes);
                            jQuery("#qucikad-ajaxsearch-dropdown ul").append(newResArray);
                            myDropDown.css('display', 'block');
                            $this.data( "prev-value", qString.length );
                        }
                    }
                }

            });
        }
        /* get results from buffered data */
        else{
            newResArray = [];
            myDropDown.css('display', 'none');
            jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
            jQuery.each( bufferedResArray, function( key, value ) {
                var stringToCheck = jQuery(value).find('span').first().text();

                if(lpsearchmode=="keyword"){

                    qString = qString.toUpperCase();
                    stringToCheck = stringToCheck.toUpperCase();

                    var regxString = new RegExp(qString, 'g');
                    var lpregxRest = stringToCheck.match(regxString);
                    if (lpregxRest){
                        newResArray.push(value);
                    }

                }else{

                    if (stringToCheck.substr(0, qString.length).toUpperCase() == qString.toUpperCase()) {
                        newResArray.push(value);
                    }
                }
            });
            if(newResArray.length == 0){
                jQuery("#qucikad-ajaxsearch-dropdown ul").empty();
                jQuery('#qucikad-ajaxsearch-dropdown ul li').remove();
                $mResults = '<strong>'+noresultMSG+' </strong>';
                $mResults = $mResults+qString;
                var defRes = '<li class="qucikad-ajaxsearch-li-more-results" data-moreval="'+qString+'">'+$mResults+'</li>';
                newResArray.push(defRes);
            }

            jQuery("#qucikad-ajaxsearch-dropdown ul").append(newResArray);
            myDropDown.css('display', 'block');
        }
    });
});


//GPS LIVE LOCATION
var geocoderr;
function GetCurrentGpsLoc(lpcalback){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            var clat = position.coords.latitude;
            var clong = position.coords.longitude;
            jpCodeLatLng(clat,clong, function(citynamevalue){

                lpcalback(citynamevalue);

            });
        });

    } else {
        alert("Geolocation is not supported by this browser.");
    }

}

function lpgeocodeinitialize() {
    geocoderr = new google.maps.Geocoder();
}

function jpCodeLatLng(lat, lng, lpcitycallback) {

    latlng 	 = new google.maps.LatLng(lat, lng),
        geocoderrr = new google.maps.Geocoder();
    geocoderrr.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                for (var i = 0; i < results.length; i++) {
                    if (results[i].types[0] === "locality") {
                        var city = results[i].address_components[0].short_name;
                        var region = results[i].address_components[2].long_name;
                        var country = results[i].address_components[3].short_name;

                        var $citydata = {};
                        $citydata['city'] = city;
                        $citydata['region'] = region;
                        $citydata['country'] = country;
                        lpcitycallback($citydata);
                    }
                }
            }
            else {console.log("No reverse geocode results.")}
        }
        else {console.log("Geocoder failed: " + status)}
    });

}
function getCityidByCityName(country,state,city) {
    var data = {action: "getCityidByCityName", city: city, state: state, country: country};
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        success: function (result) {
            $('#searchPlaceType').val("city");
            $('#searchPlaceId').val(result);
        }
    });
}
jQuery(document).ready(function($) {
    var loc = jQuery('.loc-tracking').data('option');
    var apiType = jQuery('#page').data('ipapi');
    var currentlocationswitch = '1';
    currentlocationswitch = jQuery('#page').data('lpcurrentloconhome');

    if (currentlocationswitch == "0") {
        loc = 'locationifoff';
        jQuery('.lp-location-search .loc-tracking > i').fadeOut('fast');
    }

    if (loc == 'yes') {
        if (jQuery('.form-group').is('.live-location-search')) {
            if (apiType === "geo_ip_db") {
                jQuery.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?')
                    .done(function (location) {

                        getCityidByCityName(location.country_code, location.state, location.city);
                        jQuery('input[name=location]').val(location.city);

                        jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');
                    });
            }
            else if (apiType === "ip_api") {
                jQuery.get("https://ipapi.co/json", function (location) {

                    getCityidByCityName(location.country, location.region, location.city);
                    jQuery('input[name=location]').val(location.city);

                    jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');
                }, "json");
            }
            else {
                GetCurrentGpsLoc(function (GpsLocationCityData) {
                    myCurrentGpsLocation = GpsLocationCityData;
                    getCityidByCityName(myCurrentGpsLocation.country, myCurrentGpsLocation.region, myCurrentGpsLocation.city);
                    jQuery('input[name=location]').val(myCurrentGpsLocation.city);

                    jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');
                });
            }

        }
    }
    else if (loc == 'no') {
        jQuery('.live-location-search .loc-tracking > i').on('click', function (event) {
            event.preventDefault();
            jQuery(this).addClass('fa-circle-o-notch fa-spin');
            jQuery(this).removeClass('fa-crosshairs');
            if (jQuery('.form-group').is('.live-location-search')) {
                if (apiType === "geo_ip_db") {
                    jQuery.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?')
                        .done(function (location) {

                            if (location.city == null) {
                            }
                            else {
                                getCityidByCityName(location.country_code, location.state, location.city);
                                jQuery('input[name=latitude]').val(location.latitude);
                                jQuery('input[name=longitude]').val(location.longitude);
                                jQuery('input[name=location]').val(location.city);
                            }
                            jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');
                        });
                }
                else if (apiType === "ip_api") {
                    jQuery.get("https://ipapi.co/json", function (location) {
                        if (location.city == null) {
                        }
                        else {
                            getCityidByCityName(location.country, location.region, location.city);

                            jQuery('input[name=latitude]').val(location.latitude);
                            jQuery('input[name=longitude]').val(location.longitude);
                            jQuery('input[name=location]').val(location.city);
                        }
                        jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');

                    }, "json");
                }
                else {

                    GetCurrentGpsLoc(function (GpsLocationCityData) {
                        myCurrentGpsLocation = GpsLocationCityData;
                        getCityidByCityName(myCurrentGpsLocation.country, myCurrentGpsLocation.region, myCurrentGpsLocation.city);
                        jQuery('input[name=location]').val(myCurrentGpsLocation.city);
                        jQuery('.live-location-search .loc-tracking > i').fadeOut('slow');
                    });

                }
            }
        });
    }
});

jQuery(window).load(function() {

    jQuery('.qucikad-ajaxsearch-input').on('click', function (event) {

        jQuery("#qucikad-ajaxsearch-dropdown").niceScroll({
            cursorcolor: "#363F48",
            cursoropacitymax: 1,
            boxzoom: false,
            cursorwidth: "10px",
            cursorborderradius: "0px",
            cursorborder: "0px solid #fff",
            touchbehavior: true,
            preventmultitouchscrolling: false,
            cursordragontouch: true,
            background: "#f7f7f7",
            horizrailenabled: false,
            autohidemode: false,
            zindex: "999999"
        });

    });
});