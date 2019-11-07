jQuery(function($) {
    "use strict";

    /*=================
     * Content
     * ================
     * General
     * Drop downs
     * Modal
     * Tabs
     * Banner
     * Form Fields
     * Slick carousel
     * Progressbar
     * Accordion
     * Gallery
     * Quantity Controls on cart
     * Google Maps
     * */

    /*============================
     General
     =============================*/

    $('body').on('click',function(e) {
        if ($(e.target).closest('.radio-dropdown').length === 0) {
            $(".radio-dropdown").removeClass("active");
        }
        if ($(e.target).closest('.selection-dropdown').length === 0) {
            $(".selection-dropdown").removeClass("active");
        }
        if ($(e.target).closest(".mega-dropdown").length === 0) {
            $(".mega-dropdown").removeClass("active");
        }
        if ($(e.target).closest(".dropdown-wrap").length === 0) {
            $(".dropdown-wrap").removeClass("active");
        }
    });

    $(".mega-filtered-search > .mega-dropdown .category-list a").on("click",function (e) {
        e.preventDefault();
        var $this = $(this),
            newText = $this.text(),
            p = $this.parents(".mega-dropdown");
        p.children("button").text(newText);
        p.removeClass("active");

    });

    $(".mob-menu-trigger,.closeMobilMenu").on("click", function(e) {
        e.preventDefault();
        $(".mobile-menu-wrap").toggleClass("active");
    });
    $(".nav-trigger,.close-sliding-nav").on("click", function(e) {
        e.preventDefault();
        $(".sliding-nav").toggleClass("active");
    });


    $(".labeled-input input").each(function() {
        var $this = $(this);
        if ($this.val() !== "") {
            $this.siblings("label").not(".error").hide();
        }

    });

    $("body").on("click", ".labeled-input label", function() {
        var $this = $(this);
        $this.hide();
        $this.siblings("input").focus();
    });

    $("body").on("focusin", ".labeled-input input", function() {
        var $this = $(this);
        $this.siblings("label").not(".error").hide();
    });

    $("body").on("focusout", ".labeled-input input,.labeled-input textarea", function() {
        var $this = $(this);
        if ($this.val() === "") {
            $this.siblings("label").not(".error").show();
        }
        /* if($this.hasClass("valid")){
         $this.parent()
         }else{
         $this.parent().removeClass("valid-block");
         }*/
    });


    $("body").on("click", ".trigger-filter-block", function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parents(".listing-filter-block").find(".inner").slideToggle();
    });
    $("body").on("click", ".search-action > a", function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent().children().toggleClass("active");
    });
    $("body").on("click", ".layout-action > a", function(e) {
        e.preventDefault();
        var $this = $(this),
            p = $this.parent(),
            target = $this.parents(".listing-actions").attr("data-target");
        p.children().toggleClass("active");
        if (p.hasClass("reversed")) {
            $(target).toggleClass("list-style");
        } else {
            $(target).toggleClass("items-grid-style");
        }
    });
    $("body").on("click", ".sort-action li a", function(e) {
        e.preventDefault();
        var $this = $(this),
            newText = $this.text();
        $this.parents(".sort-action").children("span").text(newText);
    });
    $("body").on("click", ".sort-action", function(e) {
        e.preventDefault();
        $(this).toggleClass("active");
    });
    $("body").on("click", ".filter-options-widget a", function(e) {
        e.preventDefault();
        var $this = $(this),
            p = $this.parents(".filter-options-widget");
        p.find("li").removeClass("active");
        $this.parent("li").addClass("active");
    });
    $("body").on("click", ".button-action > a", function(e) {
        e.preventDefault();
        $(this).toggleClass("active");
    });

    $(".imgAsBg > img").each(function() {
        var $this = $(this),
            bg = $this.attr("src");
        $this.parent().css("background-image", "url(" + bg + ")");
    });

    $(".dismiss-alert").on("click", function(e) {
        e.preventDefault();
        $(this).parents(".alert").fadeOut();
    });


    if($(".grayscale-parent").length) {
        $(".grayscale-parent").on("mouseenter", function () {
            $(this).find('.grayscale').addClass('grayscale-off');
        });
        $(".grayscale-parent").on("mouseleave", function () {
            $(this).find('.grayscale').removeClass('grayscale-off');
        });
    }

    /*==================
     * Drop downs
     * ==================*/

    $("body").on("click", ".mega-dropdown > button", function(e) {
        e.preventDefault();
        var p = $(this).parent();
        $(".mega-dropdown").not(p).removeClass("active");
        p.toggleClass("active");
    });

    $("body").on("click", ".dropdown-wrap > a,.dropdown-wrap > button", function(e) {
        e.preventDefault();
        var p = $(this).parent();
        $(".dropdown-wrap").not(p).removeClass("active");
        p.toggleClass("active");
    });


    /*===================
     * Modal
     * =================*/
    $(".modal-overlay,.close_modal").on("click", function(e) {
        e.preventDefault();
        $(this).parents(".modal-container").removeClass("active");
    });

    $(".modal-trigger").on("click", function(e) {
        e.preventDefault();
        $(".modal-container").removeClass("active");
        $($(this).attr("href")).addClass("active");
    });

    /*=================================
     * Tabs
     * ================================*/

    $("body").on("click", ".nt-tab-triggers a", function(e) {
        e.preventDefault();
        var $this = $(this),
            target = $($this.attr("href")),
            targetParent = $($this.parents("ul").attr("data-target"));
        $this.parents("ul").find("li").removeClass("active");
        $this.parent("li").addClass("active");
        targetParent.find(".tab-panel").not($this).hide();
        target.fadeIn();

    });

    $(".tab-accordion-trigger").on("click", function(e) {
        e.preventDefault();
        $(this).parent(".tab-panel").toggleClass("mob-active");
    });

    /*===============================
     * Banners
     * ==================================*/

    $(".hero-banner").each(function() {
        var $this = $(this);
        if ($(".doc-header").hasClass("header-fixed")) {
            $this.css("height", $(window).height() + "px");
        } else {
            $this.css("height", $(window).height() - $(".doc-header").innerHeight() + "px");
        }
    });

    $(".hero-section").each(function() {
        var $this = $(this);
        $this.css("height", $(window).height() + "px");
    });

    $(".toggle-active a").on("click", function(e) {
        e.preventDefault();
        var $this = $(this),
            p = $this.parent();
        p.siblings().removeClass("active");
        $this.parent().addClass("active");
    });

    /*=================================
     * Form Fields
     * ================================*/

    $("body").on("click", ".radio-dropdown label", function() {
        var $this = $(this),
            newText = $this.text(),
            p = $this.parents(".radio-dropdown");
        p.children("button").text(newText);
        p.removeClass("active");
    });
    $("body").on("click", ".radio-dropdown > button", function(e) {
        e.preventDefault();
        var p = $(this).parent();
        $(".radio-dropdown").not(p).removeClass("active");
        $(this).parent().addClass("active");
    });


    $("body").on("click", ".showHideTarget", function() {
        var $this = $(this),
            target = $this.attr("data-target");
        if ($(this).is(":checked")) {
            $(target).fadeIn();
        } else {
            $(target).fadeOut();
        }
    });

    $("body").on("click", ".radio-accordion input", function() {
        var $this = $(this),
            target = $this.parents(".radio-accordion").find(".inner");
        if ($(this).is(":checked")) {
            target.slideDown();
        } else {
            target.slideUp();
        }
    });

    $("body").on("click", ".selection-dropdown > button", function() {
        $(this).parent().toggleClass("active");
    });

    $("body").on("change", ".item-admin-actions .custom-check input", function() {
        var $this = $(this);
        if ($this.is(":checked")) {
            $this.parents(".item-spot").addClass("item-selected");
        } else {
            $this.parents(".item-spot").removeClass("item-selected");
        }
    });

    $("body").on("change", ".msg-unit .custom-check input", function() {
        var $this = $(this);
        if ($this.is(":checked")) {
            $this.parents(".msg-unit").addClass("msg-selected");
        } else {
            $this.parents(".msg-unit").removeClass("msg-selected");
        }
    });


    /*=================
     Slick carousel
     =================*/
    var slick = $(".slick-carousel");
    slick.each(function() {
        var $this = $(this),
            viewDots = $this.data("dots"),
            isLoop = $this.data("loop"),
            isNav = $this.data("nav"),
            viewSlides = +$this.data("slides"),
            slidesScroll = +$this.data("slides-scroll"),
            viewSlides_lg = +$this.data("slides-lg"),
            viewSlides_md = +$this.data("slides-md"),
            viewSlides_sm = +$this.data("slides-sm"),
            nextIcon = $this.data("next"),
            prevIcon = $this.data("prev"),
            slideDrag = $this.data("drag"),
            slideFade = $this.data("fade"),
            slideAuto = $this.data("auto"),
            centerMode = $this.data("center"),
            centerPadding = $this.data("center-padding"),
            heightAuto = $this.data("height"),
            navFor = $this.data("asnav"),
            selectFocus = $this.data("focus");
        $this.slick({
            asNavFor: navFor,
            focusOnSelect: selectFocus,
            autoplaySpeed: 5000,
            speed: 700,
            infinite: isLoop,
            dots: viewDots,
            arrows: isNav,
            slidesToShow: viewSlides,
            centerPadding: centerPadding,
            draggable: slideDrag,
            fade: slideFade,
            autoplay: slideAuto,
            adaptiveHeight: heightAuto,
            slidesToScroll: slidesScroll,
            centerMode: centerMode,
            prevArrow: '<div class="owl-prev" style=""><i class="btn_prev slick-prev ' + prevIcon + ' "></i></div>',
            nextArrow: '<div class="owl-next" style=""><i class="btn_next slick-next ' + nextIcon + ' "></i></div>',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: viewSlides_lg
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: viewSlides_md
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: viewSlides_sm,
                    slidesToScroll: 1,
                    centerPadding: 0
                }
            }]
        }); /*Slick end*/


        $this.on('setPosition', function(event, slick, currentSlide, nextSlide) {
            var slickTimer = setTimeout(function() {
                $(window).resize();
                clearTimeout(slickTimer);
            }, 500);
        });

    }); /*==//each==*/

    /*====================
     * Progressbar
     * ====================*/
    $(".progress-bar").each(function(e) {
        var $this = $(this),
            progress = $this.data("progress");
        $this.find(".progress-line > div").css("width", progress);
    });



    /*====================
     * Accordion
     * ===================*/

    $("body").on("click", ".accordion > header > a", function(e) {
        e.preventDefault();
        var $this = $(this),
            p = $this.parents(".accordion"),
            sibAcc = p.siblings(".accordion");
        if (p.parent().hasClass("accordion-toggle")) {
            sibAcc.find(".accordion-content").slideUp();
            sibAcc.removeClass("active");
        }
        p.find(".accordion-content").slideToggle();
        p.toggleClass("active");
    });



    /*==============================
     * Gallery
     * ==============================*/

    $(".trigger-gallery,.close-lg-gallery").on("click", function(e) {
        e.preventDefault();
        $(".full-width-gallery").toggleClass("active");
    });


    /*=======================================
     Quantity control and cart
     =======================================*/
    var qtimer;

    function qtyMsg(alertMsg, p, defaultVal) {
        p.find(".alert-msg").remove();
        p.append('<span class="alert-msg">' + alertMsg + '</span>');
        if (typeof defaultVal != "undefined") {
            p.find("input").val(defaultVal);
        }
        qtimer = setInterval(function(e) {
            if (qtimer !== null) {
                clearTimeout(qtimer);
                qtimer = null;
            }
            p.find(".alert-msg").remove();
        }, 4000);
    }

    $('body').on("click", ".quantity-control .btn-plus", function(e) {
        var p = $(this).parents(".quantity-control"),
            tInput = p.find("input"),
            tValue = +tInput.val(),
            maxAllowed = +tInput.attr("data-max"),
            alertMsg = tInput.attr("data-maxalert");
        if (tValue < maxAllowed) {
            tInput.val(tValue + 1);
        } else if (!p.find(".alert-msg").length) {
            qtyMsg(alertMsg, p);
        }
    });

    $('body').on("click", ".quantity-control .btn-minus", function(e) {
        var p = $(this).parents(".quantity-control"),
            tInput = p.find("input"),
            tValue = +tInput.val(),
            minAllowed = +tInput.attr("data-min"),
            alertMsg = tInput.attr("data-minalert");
        if (tValue > minAllowed) {
            tInput.val(tValue - 1);
        } else if (!p.find(".alert-msg").length) {
            qtyMsg(alertMsg, p);
        }
    });

    $(".quantity-control input").keyup(function() {
        var $this = $(this),
            p = $this.parent(),
            val = $this.val(),
            minAllowed = +$this.attr("data-min"),
            maxAllowed = +$this.attr("data-max"),
            msgMax = $this.attr("data-maxalert"),
            msgMin = $this.attr("data-minalert"),
            msginvalid = $this.attr("data-invalid");
        if ($.isNumeric(val)) {
            if (val > maxAllowed) {
                qtyMsg(msgMax, p, maxAllowed);
            } else if (val < minAllowed) {
                qtyMsg(msgMin, p, minAllowed);
            }
        } else {

            $this.val(minAllowed);
            qtyMsg(msginvalid, p);
        }
    });

    /*================================
     Google Maps
     ================================*/

    function g_map(selector_map, address, type, zoom_lvl, map_pin) {
        var map = new google.maps.Map(document.getElementById(selector_map), {
            scrollwheel: false,
            draggable: true,
            zoom: zoom_lvl
        });
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
                'address': address
            },
            function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        icon: map_pin
                    });
                    map.setCenter(results[0].geometry.location);
                }
            });
    }

    var mapWidget = $('.widget-map');
    if (mapWidget.length !== 0) {
        mapWidget.each(function() {
            var $this = $(this);

            var selector_map = $this.attr('id'),
                mapAddress = $this.data('address'),
                mapType = $this.data('maptype'),
                zoomLvl = $this.data('zoomlvl'),
                map_pin = $this.data('pin');
            g_map(selector_map, mapAddress, mapType, zoomLvl, map_pin);
        });
    }




});