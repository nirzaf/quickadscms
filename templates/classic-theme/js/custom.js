jQuery(function (e) {
    "use strict";
    var s;
    bgTransfer(), e.scrollUp(), s = document.getElementsByTagName("textarea"), Array.prototype.forEach.call(s, function (e) {
        e.placeholder = e.placeholder.replace(/\\n/g, "\n")
    }), e("document").ready(function () {
        e(".more-category.one").hide(), e(".show-more.one").click(function () {
            e(".more-category.one").show(), e(".show-more.one").hide()
        })
    }), e("document").ready(function () {
        e(".more-category.two").hide(), e(".show-more.two").click(function () {
            e(".more-category.two").show(), e(".show-more.two").hide()
        })
    }), e("document").ready(function () {
        e(".more-category.three").hide(), e(".show-more.three").click(function () {
            e(".more-category.three").show(), e(".show-more.three").hide()
        })
    }), e(".modal-overlay,.close_modal").on("click", function (s) {
        s.preventDefault(), e(this).parents(".modal-container").removeClass("active")
    }), e(".modal-trigger").on("click", function (s) {
        s.preventDefault(), e(".modal-container").removeClass("active"), e(e(this).attr("href")).addClass("active")
    }), e('[data-toggle="tooltip"]').tooltip(), e(".collapse").on("show.bs.collapse", function () {
        var s = e(this).attr("id");
        e('a[href="#' + s + '"]').closest(".panel-heading").addClass("active-faq"), e('a[href="#' + s + '"] .panel-title span').html('<i class="fa fa-minus"></i>')
    }), e(".collapse").on("hide.bs.collapse", function () {
        var s = e(this).attr("id");
        e('a[href="#' + s + '"]').closest(".panel-heading").removeClass("active-faq"), e('a[href="#' + s + '"] .panel-title span').html('<i class="fa fa-plus"></i>')
    }), e('input[type="checkbox"]').change(function () {
        e(this).is(":checked") ? e(this).parent("label").addClass("checked") : e(this).parent("label").removeClass("checked")
    }), e(".show-number").on("click", function () {
        e(".hide-text").fadeIn(500, function () {
            e(this).addClass("hide")
        }), e(".hide-number").fadeIn(500, function () {
            e(this).addClass("show")
        })
    })
}), function () {
    if ($("body").hasClass("rtl"))var e = !0; else e = !1;
    $("#featured-slider").owlCarousel({
        items: 3,
        nav: !0,
        autoplay: !0,
        dots: !1,
        autoplayHoverPause: !0,
        rtl: e,
        navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {items: 1, slideBy: 1},
            500: {items: 2, slideBy: 1},
            991: {items: 2, slideBy: 1},
            1200: {items: 3, slideBy: 1}
        }
    }), $("#latest-slider").owlCarousel({
        items: 3,
        nav: !0,
        autoplay: !0,
        dots: !1,
        autoplayHoverPause: !0,
        rtl: e,
        navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {items: 1, slideBy: 1},
            500: {items: 2, slideBy: 1},
            991: {items: 2, slideBy: 1},
            1200: {items: 3, slideBy: 1}
        }
    }), $("#recent-slider-id").owlCarousel({
        items: 4,
        nav: !0,
        autoplay: !0,
        dots: !1,
        autoplayHoverPause: !0,
        rtl: e,
        navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {items: 1, slideBy: 1},
            480: {items: 2, slideBy: 1},
            991: {items: 3, slideBy: 1},
            1e3: {items: 4, slideBy: 1}
        }
    }), $("#recommended-slider-id").owlCarousel({
        items: 4,
        nav: !0,
        autoplay: !0,
        dots: !1,
        autoplayHoverPause: !0,
        nav: !0,
        rtl: e,
        navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {items: 1, slideBy: 1},
            480: {items: 2, slideBy: 1},
            991: {items: 3, slideBy: 1},
            1e3: {items: 4, slideBy: 1}
        }
    }), $(".pricing-plans-carousel").owlCarousel({
        autoplay: !1,
        autoplayTimeout: 3e3,
        nav: !1,
        loop: !0,
        touchDrag: !0,
        checkVisibility: !0,
        dots: !0,
        margin: 10,
        rtl: e,
        responsive: {0: {items: 1}, 762: {items: 2}, 1350: {items: 3}}
    })
}(), $(".testimonial-carousel").owlCarousel({items: 1, autoplay: !0, autoplayHoverPause: !0});
var s = localStorage.listGrid;
function bgTransfer() {
    $(".bg-transfer").each(function () {
        $(this).css("background-image", "url(" + $(this).find("img").attr("src") + ")")
    })
}
s ? "grid" == s ? ($("#serchlist .searchresult.grid").fadeIn(), $("#grid").addClass("btn-success").children("i").addClass("icon-white"), $("#list").removeClass("btn-success").children("i").removeClass("icon-white")) : ($("#serchlist .searchresult.list").fadeIn(), $("#list").addClass("btn-success").children("i").addClass("icon-white"), $("#grid").removeClass("btn-success").children("i").removeClass("icon-white")) : $("#serchlist .searchresult:first").show(), $("#list").click(function () {
    $(this).addClass("btn-success").children("i").addClass("icon-white"), $(".grid").fadeOut(), $(".list").fadeIn(), $("#grid").removeClass("btn-success").children("i").removeClass("icon-white"), localStorage.listGrid = "list"
}), $("#grid").click(function () {
    $(this).addClass("btn-success").children("i").addClass("icon-white"), $(".list").fadeOut(), $(".grid").fadeIn(), $("#list").removeClass("btn-success").children("i").removeClass("icon-white"), localStorage.listGrid = "grid"
}), $(".select-category.post-option ul li a").on("click", function () {
    $(".select-category.post-option ul li.link-active").removeClass("link-active"), $(this).closest("li").addClass("link-active")
}), $(".subcategory.post-option ul li a").on("click", function () {
    $(".subcategory.post-option ul li.link-active").removeClass("link-active"), $(this).closest("li").addClass("link-active")
}), $(".navbar-dropdown").on("click", ".language-change a", function (e) {
    "#" === $(this).attr("href") && (e.preventDefault(), $(this).parents(".navbar-dropdown").find(".change-text").html($(this).html()))
}), $("#styleswitch").styleSwitcher(), $("#styleswitch h3").click(function () {
    "-200px" == $(this).parent().css("left") ? $(this).parent().animate({left: "0px"}, {
        queue: !1,
        duration: 500
    }) : $(this).parent().animate({left: "-200px"}, {queue: !1, duration: 500})
}), $(".styleswitch .toggler").on("click", function (e) {
    e.preventDefault(), $(this).closest(".styleswitch").toggleClass("opened")
}), $(".user-menu").on("click", function () {
    $(this).toggleClass("active")
});