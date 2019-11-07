var $ = jQuery.noConflict();
window.jQuery = $;

var nice = false;
(function($){
    "use strict";

    /* ------------------------------------------------------------------------ */
    /*  GLOBAL VARIABLES
     /* ------------------------------------------------------------------------ */
    if ($("body").hasClass("rtl")){
        var quickad_rtl = true;
    } else{
        var quickad_rtl = false;
    }

    var admin_bar = $('#wpadminbar');
    var top_bar = $('.top-bar');
    var header = $('.header-main');
    var header_bottom = header.find('.header-bottom');
    var header_splash = $('.splash-header');
    var search_bar = $('.advance-search-header');
    var header_mobile = $('.header-mobile');
    var search_bar_mobile = $('.advanced-search-mobile');
    var splash_footer = $('.splash-footer');


    var header_sticky = header.data('sticky');
    var header_bottom_sticky = header_bottom.data('sticky');
    var search_sticky = search_bar.data('sticky');
    var header_mobile_sticky = header_mobile.data('sticky');

    var header_height = header.outerHeight();
    var search_bar_height = search_bar.outerHeight();
    var header_bottom_height = header_bottom.outerHeight();
    var search_bar_mobile_height = search_bar_mobile.outerHeight();
    var mob_header_height = header_mobile.outerHeight();
    var mob_search_bar_height = search_bar_mobile.outerHeight();
    var splash_footer_height = splash_footer.outerHeight();
    var top_bar_height = top_bar.outerHeight();
    var admin_bar_height = admin_bar.outerHeight();
    var splash_header_height = header_splash.outerHeight();

    var section_body = $('#section-body');
    var header_media = $('.header-media');


    $('#styleswitch').styleSwitcher();
    $("#styleswitch h3").click(function () {
        if($(this).parent().css("left") == "-200px"){
            $(this).parent().animate({left:'0px'}, {queue: false, duration: 500});
        } else {
            $(this).parent().animate({left:'-200px'}, {queue: false, duration: 500});
        }
    });


    /* ------------------------------------------------------------------------ */
    /*  BOOTSTRAP POPOVER
     /* ------------------------------------------------------------------------ */
    var popover_ele = $('[data-toggle="popover"]');
    popover_ele.popover({
        trigger: "hover",
        html: true
    });

    /* ------------------------------------------------------------------------ */
    /*  BOOTSTRAP TOOLTIP
     /* ------------------------------------------------------------------------ */

    $('[data-toggle="tooltip"]').tooltip();

    /* ------------------------------------------------------------------------ */
    /*  CHECK USER AGENTS
     /* ------------------------------------------------------------------------ */
    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

    /* ------------------------------------------------------------------------ */
    /*  BODY LOAD
     /* ------------------------------------------------------------------------ */


    /* ------------------------------------------------------------------------ */
    /*  SCROLL TO TOP
     /* ------------------------------------------------------------------------ */
    //Check to see if the window is top if not then display button
    var scroll_btn = $('.scrolltop-btn');
    $(window).on('scroll',function(){
        if ($(this).scrollTop() > 100) {
            scroll_btn.show();
        } else {
            scroll_btn.hide();
        }
    });

    /* ------------------------------------------------------------------------ */
    /*  MAP ZOOM
     /* ------------------------------------------------------------------------ */
    var map_full_btn = $('.map-zoom-actions #quickad-gmap-full');
    var map_main = $('#quickad-gmap-main');

    map_full_btn.on('click',function () {
        var map_btn_this = $(this);
        if(map_btn_this.hasClass('active')){
            map_btn_this.removeClass('active').children('span').text('Fullscreen');
            map_btn_this.children('i').removeClass('fa-square-o').addClass('fa-arrows-alt');
            map_main.removeClass('mapfull');
            header_media.delay(1000).queue(function(next){
                header_media.css('height','auto');
                next();
            });

        }else{
            header_media.height(map_main.height());
            map_btn_this.addClass('active').children('span').text('Default');
            map_btn_this.children('i').removeClass('fa-arrows-alt').addClass('fa fa-square-o');
            map_main.addClass('mapfull');
        }
    });



    /* ------------------------------------------------------------------------ */
    /*  IF HEADER OR SEARCH STICKY
     /* ------------------------------------------------------------------------ */

    var topMargin = null;

    if(header_sticky === 1 && search_sticky === 0){
        topMargin = header_height;
    }
    if(search_sticky === 1 && header_sticky === 0){
        topMargin = search_bar_height;
    }
    if(header_bottom_sticky === 1 && search_sticky === 0){
        topMargin = header_bottom_height;
    }

    if(search_sticky === 1 && header_bottom_sticky === 0){
        topMargin = search_bar_height;
    }
    if(search_sticky === 0 && header_bottom_sticky === 0){
        topMargin = 0;
    }
    if(header_sticky === 0 && search_sticky === 0){
        topMargin = 0;
    }
    if(header.not('[data-sticky]') && search_bar.not('[data-sticky]')){
        topMargin = 0;
    }
    if(header_bottom.not('[data-sticky]') && search_bar.not('[data-sticky]')){
        topMargin = 0;
    }
    if(header_bottom === 1 && search_bar.not('[data-sticky]')){
        topMargin = header_bottom_height;
    }
    if(header_bottom.not('[data-sticky]') && search_sticky === 1){
        topMargin = search_bar_height;
    }
    if(header.not('[data-sticky]') && search_sticky === 1){
        topMargin = search_bar_height;
    }
    if(header_sticky === 1 && search_bar.not('[data-sticky]')){
        topMargin = header_height;
    }

    if(header.hasClass('header-section-3') && header_bottom_sticky === 1){
        topMargin = header_bottom_height;
    }

    if(header.hasClass('header-section-3') && search_sticky === 1){
        topMargin = search_bar_height;
    }

    if(header.hasClass('header-section-2') && header_bottom_sticky === 1){
        topMargin = header_bottom_height;
    }

    if(header.hasClass('header-section-2') && search_sticky === 1){
        topMargin = search_bar_height;
    }

    /* ------------------------------------------------------------------------ */
    /*  PROPERTY MENU TARGET NAV
     /* ------------------------------------------------------------------------ */
    var property_menu = $('.property-menu-wrap');
    var menu_target = $(".target");
    var target_block = $('.target-block');
    var property_menu_height = property_menu.innerHeight();
    var html_body = $("html, body");
    var detail_media = $('.detail-media');

    if(property_menu.length) {
        menu_target.each(function () {
            $(this).on('click', function (e) {
                var jump = $(this).attr("href");
                var scrollto = ($(jump).offset().top);
                scrollto = scrollto - (topMargin) - (property_menu_height);
                html_body.animate({scrollTop: scrollto}, {duration: 1000, easing: 'easeInOutExpo', queue: false});
                e.preventDefault();
            });
        });

        $(window).on('scroll', function () {
            var scroll_top = $(window).scrollTop();
            target_block.each(function () {
                var target_this = $(this);
                if (scroll_top >= target_this.offset().top - (topMargin) - (property_menu_height)) {
                    var id = target_this.attr('id');
                    menu_target.removeClass('active');
                    $('.target[href="#' + id + '"]').addClass('active');
                } else if (scroll_top <= 0) {
                    menu_target.removeClass('active');
                }
            });
        });
    }
    $(".back-top").on('click',function() {
        html_body.animate({ scrollTop: 0 },"slow");
        //e.preventDefault();
        return false;
    });

    /* ------------------------------------------------------------------------ */
    /*  PROPERTY MENU STICKY
     /* ------------------------------------------------------------------------ */

    if(property_menu.length) {
        $(window).on('scroll', function () {
            var scroll_top = $(window).scrollTop();
            if (scroll_top >= detail_media.offset().top + (200)) {
                property_menu.css({top: topMargin}).fadeIn();
            } else if (scroll_top <= detail_media.offset().top + (200)) {
                property_menu.css({top: topMargin}).fadeOut();
            }
        });
    }

    /* ------------------------------------------------------------------------ */
    /*  One page smooth scroll
     /* ------------------------------------------------------------------------ */
    $(function() {
        $('.header-main a[href*="#"]:not([href="#"])').on('click',function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    html_body.animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });





    /* ------------------------------------------------------------------------ */
    /*  HEADER STICKY
     /* ------------------------------------------------------------------------ */

    var get_header_class = header.attr('class');

    if(header_bottom_sticky === 1){
        this_sticky(header_bottom);
    }
    if(header_sticky === 1){
        this_sticky(header);
    }
    if(header_mobile_sticky === 1){
        this_sticky(header_mobile);
    }

    function this_sticky(ele){


        var header_position = ele.outerHeight();
        var sticky_nav = ele.clone().removeAttr('style').removeClass('quickad-header-transparent');
        var sticky_wrap = $(sticky_nav).wrap("<div class='sticky_nav'></div>").parent().addClass(get_header_class).removeClass('quickad-header-transparent');
        sticky_wrap = sticky_wrap.removeClass('header-transparent not-splash-header nav-left');

        $('body').append( sticky_wrap );

        function fix_header(){
            sticky_wrap.css( 'top', '0' );
        }

        $(window).on('scroll', function(){
            var scroll_top = $(window).scrollTop();
            if( scroll_top >= ele.position().top + header_position ){
                sticky_wrap.slideDown(function () {
                    quickad_megamenu();
                });
            }
            else if(scroll_top <= ele.position().top){
                sticky_wrap.fadeOut();
            }
        });

        fix_header();
        $(window).resize(function(){
            fix_header();
        });
    }

    /* ------------------------------------------------------------------------ */
    /*  ADVANCE SEARCH STICKY
     /* ------------------------------------------------------------------------ */
    function advancedSearchSticky() {
        var search = null;
        var thisHeight = null;
        var sr_sticky_top = null;
        var splash_search = $(".splash-search");

        if(getWindowWidth() > 991){
            search = search_bar;
            thisHeight = search_bar_height;
        }else{
            search = search_bar_mobile;
            thisHeight = search_bar_mobile_height;
        }
        if (!search.data('sticky')) {
            return;
        }

        if( splash_search[0] ) {
            sr_sticky_top = splash_search.offset().top;
            sr_sticky_top = sr_sticky_top + 200;
        } else {
            if(getWindowWidth() > 991){
                sr_sticky_top = search_bar.offset().top + 65;
            }else{
                sr_sticky_top = search_bar_mobile.offset().top;
            }
        }

        if( sr_sticky_top === 0 ) {
            sr_sticky_top = header_height;
        }

        $(window).on('scroll',function() {
            var scroll = $(window).scrollTop();
            var admin_nav = $('#wpadminbar').height() + 'px';

            if( admin_nav === 'nullpx' ) { admin_nav = '0px'; }

            if (scroll >= sr_sticky_top ) {
                search.addClass("advanced-search-sticky");
                search.css('top', admin_nav);
                section_body.css('padding-top',thisHeight);
            } else {
                search.removeClass("advanced-search-sticky");
                search.removeAttr("style");
                section_body.css('padding-top',0);
            }
        });
    }
    advancedSearchSticky();

    /* ------------------------------------------------------------------------ */
    /*  ADVANCE DROPDOWN
     /* ------------------------------------------------------------------------ */
    var expand_trigger = $('.search-expand-btn');
    var search_expand = $('.search-expandable .advanced-search');

    expand_trigger.on('click',function(){
        var btn_this = $(this);
        btn_this.toggleClass('active');
        if(btn_this.hasClass('active'))
        {
            search_expand.slideDown();
        }else
        {
            search_expand.add('.search-expandable .advance-fields').slideUp();
            $('.advance-btn').removeClass('active');

        }
    });

    var search_btn_trigger = $('.advanced-search .advance-btn');
    search_btn_trigger.on('click',function(){
        var trigger_this = $(this);
        trigger_this.toggleClass('active');
        if(trigger_this.hasClass('active'))
        {
            trigger_this.closest('.advanced-search').find('.advance-fields').slideDown();
        }else
        {
            trigger_this.closest('.advanced-search').find('.advance-fields').slideUp();
        }
    });

    var search_mobile_trigger = $('.advanced-search-mobile .advance-btn');
    search_mobile_trigger.on('click',function(){
        var mobile_trigger_this = $(this);
        mobile_trigger_this.toggleClass('active');
        if(mobile_trigger_this.hasClass('active'))
        {
            mobile_trigger_this.closest('.advanced-search-mobile').find('.advance-fields').slideDown();
        }else
        {
            mobile_trigger_this.closest('.advanced-search-mobile').find('.advance-fields').slideUp();
        }
    });

    var advance_trigger = $('.advance-trigger');
    var field_expand = $('.field-expand');
    advance_trigger.on('click',function(){
        var advance_trigger_this = $(this);
        advance_trigger_this.toggleClass('active');
        if(advance_trigger_this.hasClass('active'))
        {
            advance_trigger_this.children('i').removeClass('fa-plus-square').addClass('fa-minus-square');
            field_expand.slideDown(function () {
                $(".search-scroll-inner").animate({ scrollTop: $(document).height() });
            });
        }else
        {
            advance_trigger_this.children('i').removeClass('fa-minus-square').addClass('fa-plus-square');
            field_expand.slideUp();
        }
    });

    /* ------------------------------------------------------------------------ */
    /*  BANNER parallax
     /*------------------------------------------------------------------------- */

    function banner_parallax(){
        var parallax_ele = $('.banner-bg-wrap');

        if($('.header-media .banner-parallax').length){
            var start_scroll = header_media.offset().top;
            var parallax_scroll_top = $(window).scrollTop();
            var scrolled = parallax_scroll_top - start_scroll;
            if(parallax_scroll_top >= start_scroll){
                parallax_ele.css("transform","translate3d(0,"+-scrolled*-0.3+"px,0)");
            }else if(parallax_scroll_top < start_scroll){
                parallax_ele.css("transform","translate3d(0,0px,0)");
            }
        }
    }
    banner_parallax();
    $(window).on('scroll',function(){
        banner_parallax();
    });


    /* ------------------------------------------------------------------------ */
    /*  DETAIL LIGHT BOX SLIDE SHOW
     /* ------------------------------------------------------------------------ */
    var pretty_video_ele = $("a[data-fancy^='property_video']");

    if(pretty_video_ele.length > 0) {
        pretty_video_ele.prettyPhoto({
            allow_resize: true,
            default_width: 1900,
            default_height: 1000,
            animation_speed: 'normal',
            theme: 'default',
            slideshow: 3000,
            autoplay_slideshow: false
        });
    }

    var pretty_gallery_ele = $("a[data-fancy^='property_gallery']");

    if(pretty_gallery_ele.length > 0) {
        pretty_gallery_ele.prettyPhoto({
            allow_resize: true,
            default_width: 1900,
            default_height: 1000,
            animation_speed: 'normal',
            theme: 'facebook',
            slideshow: 3000,
            autoplay_slideshow: false
        });
    }



    /* ------------------------------------------------------------------------ */
    /*  NAVIGATION
     /* ------------------------------------------------------------------------ */
    $('.navi ul li').each(function(){
        $(this).has('ul').not('.quickad-megamenu li').addClass('has-child')
    });

    $('.navi ul .has-child').on({
        mouseenter: function () {
            $(this).addClass("active");
        },
        mouseleave: function () {
            $(this).removeClass("active");
        }
    });

    function quickad_megamenu(){
        if($(window).width() > 991){
            var nav_ele = $('.navi ul li');
            var megamenu_ele = $('.navi ul .quickad-megamenu');
            var container = $('.container');
            var header = $('.header-main');

            var containWidth = container.innerWidth();
            var windowWidth = $(window).width();
            var containOffset = container.offset();

            if(nav_ele.hasClass('quickad-megamenu')){

                megamenu_ele.each(function () {
                    var thisOffset = $(this).offset();
                    if(header.children('.container').length > 0){
                        $("> .sub-menu",this).css({width:containWidth,left:-(thisOffset.left-containOffset.left)});
                    }else{
                        $("> .sub-menu",this).css({width:windowWidth,left: -thisOffset.left});

                    }
                });

            }
        }
    }
    quickad_megamenu();
    $(window).on('resize',function () {
        quickad_megamenu();
    });
    $(window).bind('load',function () {
        quickad_megamenu();
    });




    /* ------------------------------------------------------------------------ */
    /*  SECTION HEIGHT
     /* ------------------------------------------------------------------------ */

    function bg_image_size(size,url){
        var get_url = url,image;
        if(get_url) {
            // Remove url() or in case of Chrome url("")
            get_url = get_url.match(/^url\("?(.+?)"?\)$/);

            if (get_url[1]) {
                get_url = get_url[1];
                image = new Image();
                image.src = get_url;
                if (size === 'height') {
                    return image.height;
                } else {
                    return image.width;
                }
            }
        }
    }

    function setSectionHeight() {
        var totalTopBarsHeight = 0;

        var searchH = (getWindowHeight()-splash_header_height)-splash_footer_height;
        var screen_fix_splash = $('.fave-screen-fix-inner');
        var screen_fix = $('.fave-screen-fix');
        var scree_fix_auto = $('.banner-parallax-auto');

        if (isChrome){
            screen_fix_splash.css( 'height', searchH-1 );
        }else{
            screen_fix_splash.css( 'height', searchH );
        }


        if(getWindowWidth() >= 992){
            if(header.length){
                totalTopBarsHeight = header_height;
            }
            if(header.length && search_bar.length && !search_bar.hasClass('search-hidden')) {
                totalTopBarsHeight = parseInt(search_bar_height) + parseInt(header_height);
            }
            if(header.is('*') && search_bar.hasClass('search-hidden')) {
                totalTopBarsHeight = header_height;
            }

            if(header.length && top_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(top_bar_height);
            }
            if(header.length
                && search_bar.length
                && !search_bar.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(top_bar_height) + parseInt(search_bar_height);
            }
            if(header.length
                && admin_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(admin_bar_height);
            }

            if(header.length
                && admin_bar.length
                && top_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(admin_bar_height) + parseInt(top_bar_height);
            }
            if(header.length
                && admin_bar.length
                && search_bar.length
                && !search_bar.hasClass('search-hidden')){
                totalTopBarsHeight = parseInt(header_height) + parseInt(admin_bar_height) + parseInt(search_bar_height);
            }
            if(header.length
                && admin_bar.length
                && search_bar.length
                && !search_bar.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(admin_bar_height) + parseInt(search_bar_height) + parseInt(top_bar_height);
            }
            if(header.length
                && admin_bar.length
                && search_bar.length
                && search_bar.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(header_height) + parseInt(admin_bar_height) + parseInt(top_bar_height);
            }

        }else{
            if(search_bar_mobile.length
                && !search_bar_mobile.hasClass('search-hidden')
                && header_mobile.length) {
                totalTopBarsHeight = parseInt(mob_search_bar_height) + parseInt(mob_header_height);
            }
            if(search_bar_mobile.hasClass('search-hidden')
                && header_mobile.is('*')) {
                totalTopBarsHeight = mob_header_height;
            }
            if(header_mobile.length){
                totalTopBarsHeight = mob_header_height;
            }
            if(header_mobile.length
                && top_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(top_bar_height);
            }
            if(header_mobile.length
                && search_bar_mobile.length
                && !search_bar_mobile.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(top_bar_height) + parseInt(mob_search_bar_height);
            }
            if(header_mobile.length
                && admin_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(admin_bar_height);
            }
            if(header_mobile.length
                && admin_bar.length
                && search_bar_mobile.length
                && !search_bar_mobile.hasClass('search-hidden')){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(admin_bar_height) + parseInt(mob_search_bar_height);
            }
            if(header_mobile.length
                && admin_bar.length
                && search_bar_mobile.length
                && !search_bar_mobile.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(admin_bar_height) + parseInt(mob_search_bar_height) + parseInt(top_bar_height);
            }
            if(header_mobile.length
                && admin_bar.length
                && search_bar_mobile.length
                && search_bar_mobile.hasClass('search-hidden')
                && top_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(admin_bar_height) + parseInt(top_bar_height);
            }
            if(header_mobile.length
                && admin_bar.length
                && top_bar.length){
                totalTopBarsHeight = parseInt(mob_header_height) + parseInt(admin_bar_height) + parseInt(top_bar_height);
            }
        }

        var topBarsHeight =  getWindowHeight() - totalTopBarsHeight;


        if (isChrome){
            screen_fix.css( 'height', topBarsHeight-1 );
        }else{
            screen_fix.css( 'height', topBarsHeight );
        }

        $('.banner-parallax-fix').css( 'height', topBarsHeight );


        if(getWindowWidth() > 768){
            var image_url = $('.banner-parallax-auto .banner-inner').css('background-image');

            if(image_url != 'none'){
                var bg_height = scree_fix_auto.width() * bg_image_size('height',image_url) / bg_image_size('width',image_url);
                if(bg_height > getWindowHeight()){
                    scree_fix_auto.css( 'height', topBarsHeight );
                }else{
                    scree_fix_auto.css( 'height', bg_height-totalTopBarsHeight );
                }
            }else{
                scree_fix_auto.css( 'height', topBarsHeight );
            }
        }else{
            scree_fix_auto.css( 'height', 300 );
        }
    }

    setSectionHeight();

    $(window).on('resize', function () {
        setSectionHeight();
        advancedSearchSticky();
    });

    $(window).bind('load',function () {
        setSectionHeight();
    });

    function getWindowWidth() {
        return Math.max( $(window).width(), window.innerWidth);
    }

    function getWindowHeight() {
        return Math.max( $(window).height(), window.innerHeight);
    }



    /* ------------------------------------------------------------------------ */
    /*  SLIDER initialized
     /* ------------------------------------------------------------------------ */
    var all_slider = $('#banner-slider, .carousel, .lightbox-slide, .property-widget-slider');
    all_slider.on('initialized.owl.carousel', function() {
        setTimeout(function(){
            all_slider.animate({opacity: 1}, 800);
            $('.gallery-area .slider-placeholder').remove();
        },800);
    });

    /* ------------------------------------------------------------------------ */
    /*  BANNER SLIDER
     /* ------------------------------------------------------------------------ */
    var banner_slider = $("#banner-slider");
    if(banner_slider.length > 0){
        banner_slider.owlCarousel({
            rtl: quickad_rtl,
            loop: true,
            dots: false,
            slideBy: 1,
            items:1,
            smartSpeed: 1000,
            nav: true,
            navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
            addClassActive: true,
            callbacks: true
        });
    }

    /* ------------------------------------------------------------------------ */
    /*  SLIDER FOR DETAIL PAGE
     /* ------------------------------------------------------------------------ */
    var slide_show = $('.slide');
    var slide_show_nav = $('.slideshow-nav');
    function quickad_detail_slider_main_settings() {
        return {
            speed: 500,
            autoplay: false,
            autoplaySpeed: 4000,
            rtl: quickad_rtl,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            //fade: true,
            accessibility: true,
            asNavFor: '.slideshow-nav'
        }
    }
    function quickad_detail_slider_nav_settings() {
        return {
            speed: 500,
            autoplay: false,
            autoplaySpeed: 4000,
            rtl: quickad_rtl,
            slidesToShow: 10,
            slidesToScroll: 1,
            asNavFor: '.slide',
            arrows: false,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings:{
                        slidesToShow: 8
                    }
                },
                {
                    breakpoint: 767,
                    settings:{
                        slidesToShow: 4
                    }
                }
            ]
        }
    }

    function property_detail_slideshow() {
        slide_show.slick(quickad_detail_slider_main_settings());
        slide_show_nav.slick(quickad_detail_slider_nav_settings());
    }
    if(slide_show.length){
        property_detail_slideshow();
    }
    /* ------------------------------------------------------------------------ */
    /*  ACCOUNT DROPDOWN
     /* ------------------------------------------------------------------------ */
    function accountDropdown(){

        // Account dropdown for desktop
        var account_action = $(".header-right .account-action > li");
        account_action.on({
            mouseenter: function () {
                $(this).addClass('active');
            },
            mouseleave: function () {
                $(this).removeClass('active');
            }
        });

        // Account dropdown for mobile
        var mobile_account_action = $('.header-user .account-action > li');
        mobile_account_action.on('click',function(){
            var action_this = $(this);
            if(action_this.hasClass('active')){
                action_this.removeClass('active');
            }else{
                action_this.addClass('active');
            }
        });
    }

    accountDropdown();

    /* ------------------------------------------------------------------------ */
    /*  MOBILE MENU
     /* ------------------------------------------------------------------------ */
    function mobileMenu(menu_html,menu_place){
        var siteMenu = $(menu_html).html();
        $(menu_place).html(siteMenu);

        $(menu_place+' ul li').each(function(){
            $(this).has('ul').addClass('has-child');
        });

        $(menu_place+' ul .has-child').append('<span class="expand-me"></span>');

        $(menu_place+' .expand-me').on('click',function(){
            var parent = $(this).parent('li');
            if(parent.hasClass('active')){
                parent.removeClass('active');
                parent.children('ul').slideUp();
            }else{
                parent.addClass('active');
                parent.children('ul').slideDown();
            }
        });
    }
    mobileMenu('.main-nav','.main-nav-dropdown');
    mobileMenu('.top-nav','.top-nav-dropdown');
    mobileMenu('.top-nav','.top-nav-dropdown');

    // Mobile menu Dropdown
    $('.nav-trigger').on('click',function(){
        var nav_this = $(this);
        if(nav_this.hasClass('mobile-open')){
            nav_this.removeClass('mobile-open');
        }else{
            nav_this.addClass('mobile-open');
        }
    });

    function element_hide(ele,ele_class){
        $(document).on('mouseup',function (e){
            var nav_trigger = $(ele);
            var nav_dropdown = $('.nav-dropdown');
            var account_dropdown = $('.account-dropdown');

            if (!nav_trigger.is(e.target) // if the target of the click isn't the container...
                && nav_trigger.has(e.target).length === 0 // ... nor a descendant of the container
                && !nav_dropdown.is(e.target)
                && nav_dropdown.has(e.target).length === 0
                && !account_dropdown.is(e.target)
                && account_dropdown.has(e.target).length === 0)
            {
                $(ele).removeClass(ele_class);
            }
        });
    }

    element_hide('.header-mobile .nav-trigger','mobile-open');
    element_hide('.top-bar .nav-trigger','mobile-open');
    element_hide('.account-action li','active');


    /* ------------------------------------------------------------------------ */
    /*  DETAIL LIGHT BOX VARS
     /* ------------------------------------------------------------------------ */
    var lightbox_popup_main = $('#lightbox-popup-main');
    var lightbox_popup = $('.lightbox-popup');
    var lightbox_popup_inner = $('.popup-inner');
    var lightbox_slider = $('.lightbox-slide');
    var lightbox_left = $('.lightbox-left');
    var lightbox_right = $('.lightbox-right');

    var lightbox_popup_trigger = $('.popup-trigger');
    var lightbox_close = $('.lightbox-close');
    var lightbox_left_close = $('.lightbox-left .lightbox-close');
    var lightbox_expand_icon = $('.expand-icon');
    var lightbox_left_expand_icon = $('.lightbox-left .expand-icon');
    var lightbox_expand = $('.lightbox-expand');
    var lightbox_gallery_inner = $('.gallery-inner');

    var lightbox_arrow_left = $('.lightbox-arrow-left');
    var lightbox_arrow_right = $('.lightbox-arrow-right');

    var popupRightWidth = lightbox_right.innerWidth();

    /* ------------------------------------------------------------------------ */
    /*  DETAIL LIGHT BOX SLIDE SHOW
     /* ------------------------------------------------------------------------ */
    function lightBoxSlide() {
        lightbox_slider.show(function(){
            lightbox_slider.owlCarousel({
                autoPlay : 3000,
                rtl: quickad_rtl,
                dots: false,
                items: 1,
                smartSpeed: 700,
                slideBy: 1,
                nav: false,
                stopOnHover : true,
                autoHeight : true,
                navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                responsive : {
                    // breakpoint from 768 up
                    768 : {
                        nav: true
                    }
                }
            });
        });

        // Custom Navigation Events
        lightbox_arrow_left.on('click',function() {
            lightbox_slider.trigger('prev.owl.carousel',[1000])
        });
        lightbox_arrow_right.on('click',function() {
            lightbox_slider.trigger('next.owl.carousel',[1000])
        });

        $(document).keydown(function(e){
            // handle cursor keys
            if (e.keyCode === 37) {
                lightbox_slider.trigger('prev.owl.carousel',[1000])
            } else if (e.keyCode === 39) {
                lightbox_slider.trigger('next.owl.carousel',[1000])
            }
        });

    }

    lightbox_slider.on('resized.owl.carousel', function () {
        var $this = $(this);
        $this.find('.owl-height').css('height', $this.find('.owl-item.active').height());
    });

    /* ------------------------------------------------------------------------ */
    /*  LIGHT BOX
     /* ------------------------------------------------------------------------ */

    function lightBox(){
        lightbox_popup_trigger.on('click',function(){
            lightbox_popup_main.addClass('active').addClass('in');
        });
        lightbox_close.on('click',function(){
            lightbox_popup_main.removeClass('active').removeClass('in');
        });
        $(document).keydown(function(e){
            if (e.keyCode === 27) {
                lightbox_popup_main.removeClass('active').removeClass('in');
            }
        });
    }
    lightBox();

    function popupResize(){
        var popupWidth = getPopupWidth()-60;
        lightbox_popup.css('width',popupWidth);

        if(lightbox_right.length > 0){

            lightbox_left.css('width', (popupWidth - popupRightWidth));
            lightbox_gallery_inner.css('width', (popupWidth - popupRightWidth)-40);
            lightbox_right.addClass('in');
            lightbox_left_close.removeClass('show');

            if (Modernizr.mq('(max-width: 1199px)')) {
                lightbox_expand_icon.removeClass('compress');
                lightbox_popup_inner.removeClass('pop-expand');
            }
            if (Modernizr.mq('(max-width: 1024px)')) {
                lightbox_left.css('width', '100%');
                lightbox_right.removeClass('in');
                lightbox_gallery_inner.css('width', '100%');
                lightbox_expand_icon.addClass('compress');
                lightbox_left_close.addClass('show');
            }
        }else{
            lightbox_left.css('width', '100%');
            lightbox_gallery_inner.css('width', '100%');
            lightbox_left_close.addClass('show');
            lightbox_left_expand_icon.hide('show');
        }
    }
    popupResize();
    function popForm_hide_show(){
        lightbox_expand.on('click',function(){
            var expand_this = $(this);
            var popupWidth = getPopupWidth();
            var popWidthTotal = (getPopupWidth()-60) - popupRightWidth;

            lightbox_left_close.toggleClass('show');

            if(popupWidth >= 1024){
                if(expand_this.hasClass('compress')){
                    lightbox_right.addClass('in');
                    lightbox_left.css('width', popWidthTotal);
                    expand_this.removeClass('compress');
                    lightbox_popup_inner.removeClass('pop-expand');
                }else{
                    lightbox_left.css('width', '100%');
                    lightbox_right.removeClass('in');
                    expand_this.addClass('compress');
                    lightbox_popup_inner.addClass('pop-expand');
                }
            }
            if(popupWidth <= 1024){

                if (expand_this.hasClass('compress')) {
                    lightbox_right.addClass('in');
                    lightbox_left.css('width', popWidthTotal);
                    expand_this.removeClass('compress');

                } else {
                    lightbox_left.css('width', '100%');
                    lightbox_right.removeClass('in');
                    expand_this.addClass('compress');
                }
            }
            if(popupWidth < 768){
                lightbox_left.css('width', '100%');
            }
        });
    }
    popForm_hide_show();

    function getPopupWidth() {
        return Math.max( $(window).width(), $(window).innerWidth());
    }

    $(window).on('load',function(){
        lightBoxSlide();
        popupResize();
        $('.tagcloud a').removeAttr('style');
    });

    $(window).on('resize', function () {
        popupResize();
    });



})(jQuery);