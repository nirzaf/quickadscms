////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// jQuery
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var $ = jQuery.noConflict();
window.jQuery = $;

var resizeId;
var lastModal;
var customizerEnabled = 1;
var defaultColor;
$(document).ready(function($) {
    "use strict";

    if( $("body").hasClass("navigation-fixed") ){
        fixedNavigation(true);
    }
    else {
        fixedNavigation(false);
    }


    if( $(".tse-scrollable").length ){
        $(".tse-scrollable").TrackpadScrollEmulator();
    }

    if( $(".date-picker").length ){
        $(".date-picker").datepicker();
    }

    if( viewport.is('xs') ){
        $(".map-wrapper").height( $(window).height() - $("#page-header").height() );
        $(".has-background").css( "min-height", $(window).height() - $("#page-header").height() + "px" );
    }
    else {
        if( $("body").hasClass("navigation-fixed") ){
            $(".quickad-section.full-screen").height( $(window).height() - $("#page-header nav").height() );
        }
        else {
            $(".quickad-section.full-screen").height( $(window).height() - $("#page-header").height() );
        }
    }


//  Count down  --------------------------------------------------------------------------------------------------------

    if( $(".count-down").length ){

        var date = new Date();
        $(".count-down").countdown( {until: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2 ), padZeroes: true, format: 'HMS'} );
    }

// Render hero search form ---------------------------------------------------------------------------------------------

    $("select").on("rendered.bs.select", function () {
        $('head').append( $('<link rel="stylesheet" type="text/css">').attr('href', 'assets/css/bootstrap-select.min.css') );
        if( !viewport.is('xs') ){
            $(".search-form.vertical").css( "top", ($(".quickad-section").height()/2) - ($(".search-form .wrapper").height()/2) );
        }
        trackpadScroll("initialize");
    });

    if( !viewport.is('xs') ){
        $(".search-form.vertical").css( "top", ($(".quickad-section").height()/2) - ($(".search-form .wrapper").height()/2) );
        trackpadScroll("initialize");
    }

//  iCheck -------------------------------------------------------------------------------------------------------------




//  Smooth Scroll ------------------------------------------------------------------------------------------------------

    $('.main-nav a[href^="#"], a[href^="#"].scroll').on('click',function (e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 2000, 'swing', function () {
            window.location.hash = target;
        });
    });

//  Modal after click --------------------------------------------------------------------------------------------------

    $("[data-modal-external-file], .quick-detail").live("click", function(e){
        e.preventDefault();
        var modalTarget, modalFile;
        if( $(this).closest(".item").attr("data-id") ){
            modalTarget = $(this).closest(".item").attr("data-id");
            modalFile = "modal_item.php";
        }
        else {
            modalTarget = $(this).attr("data-target");
            modalFile = $(this).attr("data-modal-external-file");
        }
        if( $(this).attr("data-close-modal") == "true" ){
            lastModal.modal("hide");
            setTimeout(function() {
                openModal(modalTarget, modalFile);
            }, 400);
        }
        else {
            openModal(modalTarget, modalFile);
        }
    });

//  Multiple modal hack ------------------------------------------------------------------------------------------------

    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });


//  Close "More" menu on click anywhere on page ------------------------------------------------------------------------

    $(document).on("click", function(e){
        if( e.target.className == "controls-more" ){
            $(".controls-more.show").removeClass("show");
            $(e.target).addClass("show");

        }
        else {
            $(".controls-more.show").each(function() {
                $(this).removeClass("show");
            });
        }
    });

// Mobile navigation button --------------------------------------------------------------------------------------------

    $(".nav-btn").on("click", function(){
        $(this).toggleClass("active");
        $(".primary-nav").toggleClass("show");
    });

//  Duplicate desired element ------------------------------------------------------------------------------------------

    $(".duplicate").live("click", function(e){
        e.preventDefault();
        var duplicateElement = $(this).attr("href");
        var parentElement = $(duplicateElement)[0].parentElement;
        $(parentElement).append( $(duplicateElement)[0].outerHTML );
    });

//  Enable image previews in multi file input --------------------------------------------------------------------------

    if( $("input[type=file].with-preview").length ){
        $("input.file-upload-input").MultiFile({
            list: ".file-upload-previews"
        });
    }

//  No UI Slider -------------------------------------------------------------------------------------------------------

    if( $('.ui-slider').length > 0 ){
        $('.ui-slider').each(function() {
            if( $("body").hasClass("rtl") ) var rtl = "rtl";
            else rtl = "ltr";

            var step;
            if( $(this).attr('data-step') ) {
                step = parseInt( $(this).attr('data-step') );
            }
            else {
                step = 10;
            }
            var sliderElement = $(this).attr('id');
            var element = $( '#' + sliderElement);
            var valueMin = parseInt( $(this).attr('data-value-min') );
            var valueMax = parseInt( $(this).attr('data-value-max') );
            var startMin = parseInt( $(this).attr('data-start-min') );
            var startMax = parseInt( $(this).attr('data-start-max') );
            $(this).noUiSlider({
                start: [ startMin, startMax ],
                connect: true,
                direction: rtl,
                range: {
                    'min': valueMin,
                    'max': valueMax
                },
                step: step
            });
            if( $(this).attr('data-value-type') == 'price' ) {
                if( $(this).attr('data-currency-placement') == 'before' ) {
                    $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                    $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                }
                else if( $(this).attr('data-currency-placement') == 'after' ){
                    $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                    $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                }
            }
            else {
                $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ decimals: 0 }));
                $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ decimals: 0 }));
            }
        });
    }

//  Calendar

    if( $(".calendar").length ){
        var date = new Date();
        var month = date.getMonth();
        for( var i = 1 ; i<=12 ; i++ ){
            $('.calendar-wrapper').append('<div id="month_'+i+'" class="month"></div>');
            $("#month_"+i).zabuto_calendar({
                ajax: {
                    url: "assets/php/calendar.php",
                    modal: true
                },
                action: function () {
                    var date = $("#" + this.id).data("date");
                    $("#modal-date").val(date);
                    return checkDate(this.id);
                },
                language: "en",
                month: i,
                show_previous: false,
                show_next: false,
                today: true,
                nav_icon: {
                    prev: '<i class="arrow_left"></i>',
                    next: '<i class="arrow_right"></i>'
                }
            });
        }
        $(".calendar-wrapper").owlCarousel({
            items: 2,
            nav: true,
            autoHeight: true,
            navText: [],
            startPosition: month
        });
    }

//  Form Validation

    $(".form-email .btn[type='submit']").on("click", function(){
        var button = $(this);
        var form = $(this).closest("form");
        button.prepend("<div class='status'></div>");
        form.validate({
            submitHandler: function() {
                $.post("assets/external/email.php", form.serialize(),  function(response) {

                    button.find(".status").append(response);
                    form.addClass("submitted");
                });
                return false;
            }
        });
    });

    equalHeight(".container");
    ratingPassive("body");
    bgTransfer();
    responsiveNavigation();

});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// On Load
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(window).load(function(){
    initializeOwl();
});

$(window).resize(function(){
    clearTimeout(resizeId);
    resizeId = setTimeout(doneResizing, 250);
    responsiveNavigation();
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function openModal(target, modalPath){

    $("body").append('<div class="modal modal-external fade" id="'+ target +'" tabindex="-1" role="dialog" aria-labelledby="'+ target +'"><i class="loading-icon fa fa-circle-o-notch fa-spin"></i></div>');

    $("#" + target + ".modal").on("show.bs.modal", function () {
        var _this = $(this);
        lastModal = _this;
        $.ajax({
            url: "assets/external/" + modalPath,
            method: "POST",
            data: { id: target },
            success: function(results){
                _this.append(results);
                $('head').append( $('<link rel="stylesheet" type="text/css">').attr('href', 'assets/css/bootstrap-select.min.css') );
                $(".selectpicker").selectpicker();
                _this.find(".gallery").addClass("owl-carousel");
                ratingPassive(".modal");
                var img = _this.find(".gallery img:first")[0];
                if( img ){
                    $(img).load(function() {
                        timeOutActions(_this);
                    });
                }
                else {
                    timeOutActions(_this);
                }
                socialShare();
                _this.on("hidden.bs.modal", function () {
                    $(lastClickedMarker).removeClass("active");
                    $(".pac-container").remove();
                    _this.remove();
                });
            },
            error : function (e) {
                console.log(e);
            }
        });

    });

    $("#" + target + ".modal").modal("show");

    function timeOutActions(_this){
        setTimeout(function(){
            if( _this.find(".map").length ){
                if( _this.find(".modal-dialog").attr("data-address") ){
                    simpleMap( 0, 0, "map-modal", _this.find(".modal-dialog").attr("data-marker-drag"), _this.find(".modal-dialog").attr("data-address") );
                }
                else {
                    simpleMap( _this.find(".modal-dialog").attr("data-latitude"), _this.find(".modal-dialog").attr("data-longitude"), "map-modal", _this.find(".modal-dialog").attr("data-marker-drag") );
                }
            }
            initializeOwl();
            initializeFitVids();
            initializeReadMore();
            _this.addClass("show");
        }, 200);

    }

}

//  Transfer "img" into CSS background-image

function bgTransfer(){
    //disable-on-mobile
    if( viewport.is('xs') ){

    }
    $(".bg-transfer").each(function() {
        $(this).css("background-image", "url("+ $(this).find("img").attr("src") +")" );
    });
}

function ratingPassive(element){
    $(element).find(".rating-passive").each(function() {
        for( var i = 0; i <  5; i++ ){
            if( i < $(this).attr("data-rating") ){
                $(this).find(".stars").append("<figure class='active fa fa-star'></figure>")
            }
            else {
                $(this).find(".stars").append("<figure class='fa fa-star'></figure>")
            }
        }
    });
}

function initializeFitVids(){
    if ($(".video").length > 0) {
        $(".video").fitVids();
    }
}

function initializeOwl(){
    if( $("body").hasClass("rtl") ) var rtl = true;
    else rtl = false;


    if( $(".pricing-plans-carousel").length ){
        $(".pricing-plans-carousel").owlCarousel({
            autoplay: false,
            autoplayTimeout: 3000,
            nav: false,
            loop:true,
            touchDrag: true,
            checkVisibility: true,
            dots: true,
            margin:10,
            rtl: rtl,
            responsive:{
                0:{
                    items:1
                },
                762: {
                    items:2
                },

                1350:{
                    items:3
                }
            }
        });
    }
    else if( $(".owl-carousel").length ){
        $(".owl-carousel").each(function() {

            var items = parseInt( $(this).attr("data-owl-items"), 10);
            if( !items ) items = 1;

            var nav = parseInt( $(this).attr("data-owl-nav"), 2);
            if( !nav ) nav = 0;

            var dots = parseInt( $(this).attr("data-owl-dots"), 2);
            if( !dots ) dots = 0;

            var center = parseInt( $(this).attr("data-owl-center"), 2);
            if( !center ) center = 0;

            var loop = parseInt( $(this).attr("data-owl-loop"), 2);
            if( !loop ) loop = 0;

            var margin = parseInt( $(this).attr("data-owl-margin"), 2);
            if( !margin ) margin = 0;

            var autoWidth = parseInt( $(this).attr("data-owl-auto-width"), 2);
            if( !autoWidth ) autoWidth = 0;

            var navContainer = $(this).attr("data-owl-nav-container");
            if( !navContainer ) navContainer = 0;

            var autoplay = $(this).attr("data-owl-autoplay");
            if( !autoplay ) autoplay = 0;

            var fadeOut = $(this).attr("data-owl-fadeout");
            if( !fadeOut ) fadeOut = 0;
            else fadeOut = "fadeOut";


            $(this).owlCarousel({
                navContainer: navContainer,
                animateOut: fadeOut,
                autoplaySpeed: 2000,
                autoplay: autoplay,
                autoheight: 1,
                center: center,
                loop: loop,
                margin: margin,
                autoWidth: autoWidth,
                items: items,
                nav: nav,
                dots: dots,
                autoHeight: true,
                rtl: rtl,
                lazyLoad : true,
                navText: []
            });
        });
    }
}



// Do after resize

function doneResizing(){
    var $equalHeight = $('.container');
    for( var i=0; i<$equalHeight.length; i++ ){
        equalHeight( $equalHeight );
    }
    responsiveNavigation()
}

// Responsive Navigation

function responsiveNavigation(){
    if( viewport.is('xs') ){
        $("body").addClass("nav-btn-only");
    }
    if( $("body").hasClass("nav-btn-only") ){
        $(".primary-nav .has-child").children("a").attr("data-toggle", "collapse");
        $(".primary-nav .has-child").find(".nav-wrapper").addClass("collapse");
        $(".mega-menu .heading").each(function(e) {
            $(this).wrap("<a href='" + "#mega-menu-collapse-"+e + "'></a>");
            $(this).parent().attr("data-toggle", "collapse");
            $(this).parent().addClass("has-child");
            $(this).parent().attr("aria-controls", "mega-menu-collapse-"+e);
        });
        $(".mega-menu ul").each(function(e) {
            $(this).attr("id", "mega-menu-collapse-"+e);
            $(this).addClass("collapse");
        });
    }
}

function equalHeight(container){
    if( !viewport.is('xs') ){
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0;

        $(container).find('.equal-height').each(function() {
            $el = $(this);
            $($el).height('auto');
            topPostion = $el.position().top;
            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }
}

// Viewport ------------------------------------------------------------------------------------------------------------

var viewport = (function() {
    var viewPorts = ['xs', 'sm', 'md', 'lg'];

    var viewPortSize = function() {
        return window.getComputedStyle(document.body, ':before').content.replace(/"/g, '');
    };

    var is = function(size) {
        if ( viewPorts.indexOf(size) == -1 ) throw "no valid viewport name given";
        return viewPortSize() == size;
    };

    var isEqualOrGreaterThan = function(size) {
        if ( viewPorts.indexOf(size) == -1 ) throw "no valid viewport name given";
        return viewPorts.indexOf(viewPortSize()) >= viewPorts.indexOf(size);
    };

    // Public API
    return {
        is: is,
        isEqualOrGreaterThan: isEqualOrGreaterThan
    }

})();

// Rating --------------------------------------------------------------------------------------------------------------

function rating(element){
    var ratingElement =
            '<span class="stars">'+
                '<i class="fa fa-star s1" data-score="1"></i>'+
                '<i class="fa fa-star s2" data-score="2"></i>'+
                '<i class="fa fa-star s3" data-score="3"></i>'+
                '<i class="fa fa-star s4" data-score="4"></i>'+
                '<i class="fa fa-star s5" data-score="5"></i>'+
                '<i class="fa fa-star s6" data-score="6"></i>'+
                '<i class="fa fa-star s7" data-score="7"></i>'+
                '<i class="fa fa-star s8" data-score="8"></i>'+
                '<i class="fa fa-star s9" data-score="9"></i>'+
                '<i class="fa fa-star s10" data-score="10"></i>'+
                '</span>'
        ;
    if( !element ) { element = ''; }
    $.each( $(element + ' .star-rating'), function(i) {
        $(this).append(ratingElement);
        if( $(this).hasClass('active') ){
            $(this).append('<input readonly hidden="" name="score_' + $(this).attr('data-name') +'" id="score_' + $(this).attr('data-name') +'">');
        }
        // If rating exists
        var rating = $(this).attr('data-rating');
        for( var e = 0; e < rating; e++ ){
            var rate = e+1;
            console.log("a");
            $(this).children('.stars').children( '.s' + rate ).addClass('active');
        }
    });

    var ratingActive = $('.star-rating.active i');

    ratingActive.mouseenter(function() {
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).addClass('hover');
        }
    })
    .mouseleave(function() {
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).removeClass('hover');
        }
    });

    ratingActive.on('click', function(){
        $(this).parents(".star-rating").find("input").val( $(this).attr('data-score') );
        $(this).parent().children('.fa').removeClass('active');
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).addClass('active');
        }
        return false;
    });
}

// Read more -----------------------------------------------------------------------------------------------------------

function initializeReadMore(){

    $.ajax({
        type: "GET",
        url: "assets/js/readmore.min.js",
        success: readMoreCallBack,
        dataType: "script",
        cache: true
    });

    function readMoreCallBack(){
        var collapseHeight;
        var $readMore = $(".read-more");
        if( $readMore.attr("data-collapse-height") ){
            collapseHeight =  parseInt( $readMore.attr("data-collapse-height"), 10 );
        }else {
            collapseHeight = 55;
        }
        $readMore.readmore({
            speed: 500,
            collapsedHeight: collapseHeight,
            blockCSS: 'display: inline-block; width: auto; min-width: 120px;',
            moreLink: '<a href="#" class="btn btn-primary btn-xs btn-light-frame btn-framed btn-rounded">More<i class="icon_plus"></i></a>',
            lessLink: '<a href="#" class="btn btn-primary btn-xs btn-light-frame btn-framed btn-rounded">Less<i class="icon_minus-06"></i></a>'
        });
    }
}

function fixedNavigation(state){
    if( state == true ){
        $("body").addClass("navigation-fixed");
        var headerHeight = $("#page-header").height();
        $("#page-header").css("position", "fixed");
        $("#page-content").css({
            "-webkit-transform" : "translateY(" + headerHeight + "px)",
            "-moz-transform"    : "translateY(" + headerHeight + "px)",
            "-ms-transform"     : "translateY(" + headerHeight + "px)",
            "-o-transform"      : "translateY(" + headerHeight + "px)",
            "transform"         : "translateY(" + headerHeight + "px)"
        });
    }
    else if( state == false ) {
        $("body").removeClass("navigation-fixed");
        $("#page-header").css("position", "relative");
        $("#page-content").css({
            "-webkit-transform" : "translateY(0px)",
            "-moz-transform"    : "translateY(0px)",
            "-ms-transform"     : "translateY(0px)",
            "-o-transform"      : "translateY(0px)",
            "transform"         : "translateY(0px)"
        });
    }
}

//  Show element after desired time ------------------------------------------------------------------------------------

if( !viewport.is('xs') ){
    var messagesArray = [];
    $("[data-toggle=popover]").popover({
        template: '<div class="popover" role="tooltip"><div class="close"><i class="fa fa-close"></i></div><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    });
    $(".popover .close").live('click',function () {
        $(this).closest(".popover").popover("hide");
    });
    $("[data-show-after-time]").each(function() {
        var _this = $(this);
        setTimeout(function(){
            if( _this.attr("data-toggle") == "popover" ){
                _this.popover("show");
            }
            else {
                for( var i=0; i < messagesArray.length; i++ ){
                    $(messagesArray[i]).css("bottom", parseInt( $(messagesArray[i]).css("bottom") ) + _this.context.clientHeight + 10 );
                }
                messagesArray.push(_this);
                _this.addClass("show");
                if( _this.attr("data-close-after-time") ){
                    setTimeout(function(){
                        closeThis();
                    }, _this.attr("data-close-after-time") );
                }
            }
        }, _this.attr("data-show-after-time") );
        $(this).find(".close").on("click",function () {
            closeThis();
        });
        function closeThis(){
            _this.removeClass("show");
            setTimeout(function(){
                _this.remove();
            }, 400 );
        }
    });

}
//  STYE SWITCHER JQUERY *******************************
$('#styleswitch').styleSwitcher();
$("#styleswitch h3").click(function () {
    if($(this).parent().css("left") == "-200px"){
        $(this).parent().animate({left:'0px'}, {queue: false, duration: 500});
    } else {
        $(this).parent().animate({left:'-200px'}, {queue: false, duration: 500});
    }
});
$('.styleswitch .toggler').on('click', function(event){
    event.preventDefault();
    $(this).closest('.styleswitch').toggleClass('opened');
});
//  STYE SWITCHER JQUERY *******************************

//  Show element when scrolled desired amount of pixels ----------------------------------------------------------------

$("[data-show-after-scroll]").each(function() {
    var _this = $(this);
    var scroll = _this.attr("data-show-after-scroll");
    var offsetTop = $(this).offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= scroll) {
            _this.addClass("show");
        }
        else {
            _this.removeClass("show");
        }
    });
});


var s = localStorage.listGrid;
if (s) {
    if (s == 'grid') {
        $('#serchlist .searchresult.grid').fadeIn();
        $('#grid').addClass('active').children('i').addClass('icon-white');
        $('#list').removeClass('active').children('i').removeClass('icon-white');
    } else {
        $('#serchlist .searchresult.list').fadeIn();
        $('#list').addClass('active').children('i').addClass('icon-white');
        $('#grid').removeClass('active').children('i').removeClass('icon-white');
    }
} else {
    $('#serchlist .searchresult:first').show();
}
$('#list').click(function () {
    $(this).addClass('active').children('i').addClass('icon-white');
    $('.grid').fadeOut();
    $('.list').fadeIn();
    $('#grid').removeClass('active').children('i').removeClass('icon-white');
    localStorage.listGrid = 'list';
});
$('#grid').click(function () {
    $(this).addClass('active').children('i').addClass('icon-white');
    $('.list').fadeOut();
    $('.grid').fadeIn();
    $('#list').removeClass('active').children('i').removeClass('icon-white');
    localStorage.listGrid = 'grid';
});


$('#address-autocomplete').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

function trackpadScroll(method){
    if( method == "initialize" ){
        if( $(".results-wrapper").find("form").length ) {
            $(".results-wrapper .results").height( $(".results-wrapper").height() - $(".results-wrapper .form")[0].clientHeight );
        }
    }
    else if ( method == "recalculate" ){
        setTimeout(function(){
            if( $(".tse-scrollable").length ){
                $(".tse-scrollable").TrackpadScrollEmulator("recalculate");
            }
        }, 1000);
    }
}

//Ads Search
$(document).ready(function(){

    $('.live-search-box').on('keyup', function(){

        var searchTerm = $(this).val().toLowerCase();
        $('#js-table-list tr').each(function(){

            if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                $(this).show();
                $("#norecord").hide();
            }
            else {
                $(this).hide();
                if($(this).filter('[data-search-term *= ' + searchTerm + ']').length == 0 ) {
                    $("#norecord").show();
                }
            }
        });
    });
});
