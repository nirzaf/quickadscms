$(document).ready(function () {
    $(function () {
        $(".preloader").fadeOut();
    });

    // Theme settings

    //Open-Close-right sidebar
    $(".right-side-toggle").click(function () {

        $(".right-sidebar").slideDown(50);
        $(".right-sidebar").toggleClass("shw-rside");

        // Fix header

        $(".fxhdr").click(function () {
            $("body").toggleClass("fix-header");
        });

        // Fix sidebar

        $(".fxsdr").click(function () {
            $("body").toggleClass("fix-sidebar");
        });


        // Service panel js

        if ($("body").hasClass("fix-header")) {
            $('.fxhdr').attr('checked', true);
        } else {
            $('.fxhdr').attr('checked', false);
        }

        if ($("body").hasClass("fix-sidebar")) {
            $('.fxsdr').attr('checked', true);
        } else {
            $('.fxsdr').attr('checked', false);
        }

    });

    //Loads the correct sidebar on window load,
    //collapses the sidebar on window resize.
    // Sets the min-height of #page-wrapper to window size
    $(function () {
        $(window).bind("load resize", function () {
            topOffset = 60;
            width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
            if (width < 768) {
                $('div.navbar-collapse').addClass('collapse');
                topOffset = 100; // 2-row-menu
            } else {
                $('div.navbar-collapse').removeClass('collapse');
            }

            height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
            height = height - topOffset;
            if (height < 1) height = 1;
            if (height > topOffset) {
                $("#page-wrapper").css("min-height", (height) + "px");
            }
        });

        var url = window.location;
        var element = $('ul.nav a').filter(function () {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }).addClass('active').parent().parent().addClass('in').parent();
        if (element.is('li')) {
            element.addClass('active');
        }
    });

    // This is for resize window
    $(function () {
        $(window).bind("load resize", function () {
            width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
            if (width < 1170) {
                $('body').addClass('content-wrapper');
                $(".open-close i").removeClass('icon-arrow-left-circle');
                $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
                $(".logo span").hide();
            } else {
                $('body').removeClass('content-wrapper');
                $(".open-close i").addClass('icon-arrow-left-circle');
                $(".logo span").show();
            }
        });
    });


    // This is for click on open close button
    // Sidebar open close
    $(".open-close").on('click', function () {
        if ($("body").hasClass("content-wrapper")) {
            $("body").trigger("resize");
            $(".sidebar-nav, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible");
            $("body").removeClass("content-wrapper");
            $(".open-close i").addClass("icon-arrow-left-circle");
            $(".logo span").show();

        } else {
            $("body").trigger("resize");
            $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");

            $("body").addClass("content-wrapper");
            $(".open-close i").removeClass("icon-arrow-left-circle");
            $(".logo span").hide();
        }

    });

    // Collapse Panels

    (function ($, window, document) {
        var panelSelector = '[data-perform="panel-collapse"]';

        $(panelSelector).each(function () {
            var $this = $(this),
                parent = $this.closest('.panel'),
                wrapper = parent.find('.panel-wrapper'),
                collapseOpts = {
                    toggle: false
                };

            if (!wrapper.length) {
                wrapper =
                    parent.children('.panel-heading').nextAll()
                        .wrapAll('<div/>')
                        .parent()
                        .addClass('panel-wrapper');
                collapseOpts = {};
            }
            wrapper
                .collapse(collapseOpts)
                .on('hide.bs.collapse', function () {
                    $this.children('i').removeClass('ti-minus').addClass('ti-plus');
                })
                .on('show.bs.collapse', function () {
                    $this.children('i').removeClass('ti-plus').addClass('ti-minus');
                });
        });
        $(document).on('click', panelSelector, function (e) {
            e.preventDefault();
            var parent = $(this).closest('.panel');
            var wrapper = parent.find('.panel-wrapper');
            wrapper.collapse('toggle');
        });
    }(jQuery, window, document));

    // Remove Panels

    (function ($, window, document) {
        var panelSelector = '[data-perform="panel-dismiss"]';
        $(document).on('click', panelSelector, function (e) {
            e.preventDefault();
            var parent = $(this).closest('.panel');
            removeElement();

            function removeElement() {
                var col = parent.parent();
                parent.remove();
                col.filter(function () {
                    var el = $(this);
                    return (el.is('[class*="col-"]') && el.children('*').length === 0);
                }).remove();
            }
        });
    }(jQuery, window, document));


    //tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    // Task
    $(".list-task li label").click(function () {
        $(this).toggleClass("task-done");
    });

    $(".settings_box a").click(function () {
        $("ul.theme_color").toggleClass("theme_block");
    });


});
//Colepsible toggle

$(".collapseble").click(function () {
    $(".collapseblebox").fadeToggle(350);
});

// Sidebar
/*$('.slimscrollright').slimScroll({
 height: '100%',
 position: 'right',
 size: "0px",
 color: '#dcdcdc'

 });
 $('.slimscrollsidebar').slimScroll({
 height: '100%',
 position: 'right',
 size: "5px",
 color: '#000',
 railVisible: true

 });
 $('.chat-list').slimScroll({
 height: '100%',
 position: 'right',
 size: "5px",
 color: '#000',
 railVisible: true

 });*/

// Resize all elements
$("body").trigger("resize");

// visited ul li
$('.visited li a').click(function (e) {

    $('.visited li').removeClass('active');

    var $parent = $(this).parent();
    if (!$parent.hasClass('active')) {
        $parent.addClass('active');
    }
    e.preventDefault();
});

// Login and recover password
$('#to-recover').click(function () {
    $("#loginform").slideUp();
    $("#recoverform").fadeIn();
});


// Update 1.5

// this is for close icon when navigation open in mobile view
$(".navbar-toggle").click(function () {
    $(".navbar-toggle i").toggleClass("ti-menu");
    $(".navbar-toggle i").addClass("ti-close");
});

// Update 1.4

// this is for the left-aside-fix in content area with scroll

/* $('.chatonline').slimScroll({
 height: '100%',
 position: 'right',
 size: "0px",
 color: '#dcdcdc'
 });*/

/*$(function(){
 $(window).load(function(){ // On load
 $('.chat-left-inner').css({'height':(($(window).height())-0)+'px'});
 });
 $(window).resize(function(){ // On resize
 $('.chat-left-inner').css({'height':(($(window).height())-0)+'px'});
 });
 });

 $(function(){
 $(window).load(function(){ // On load
 $('.chat-list').css({'height':(($(window).height())-140)+'px'});
 });
 $(window).resize(function(){ // On resize
 $('.chat-list').css({'height':(($(window).height())-140)+'px'});
 });
 });*/

$(function () {
    $(window).load(function () { // On load
        //$('.chat-left-inner').css({'height':(($(window).height())-50)+'px'});
    });
    $(window).resize(function () { // On resize
        //$('.chat-left-inner').css({'height':(($(window).height())-50)+'px'});
    });
});

$(function () {
    $(window).load(function () { // On load
        //$('.chat-list').css({'height':(($(window).height())-179)+'px'});
    });
    $(window).resize(function () { // On resize
        //$('.chat-list').css({'height':(($(window).height())-179)+'px'});
    });
});

$(".open-panel").click(function () {
    $(".chat-left-aside").toggleClass("open-pnl");
    $(".open-panel i").toggleClass("ti-angle-left");
});
$(".chatboxhead").click(function () {
    $(".chat-left-aside").toggleClass("open-pnl");
    $(".open-panel i").toggleClass("ti-angle-left");
});



