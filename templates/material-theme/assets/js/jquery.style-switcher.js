/*
 * jQuery styleSwitcher Plugin
 */
(function ($) {
    $.fn.styleSwitcher = function (options) {
        var defaults = {
            slidein: true,
            preview: true,
            container: this.selector
        };
        var opts = $.extend(defaults, options);
        // if using cookies and using JavaScript to load css
        if (localStorage) {
            if (typeof localStorage.quickadColor != 'undefined') {
                document.documentElement.style.setProperty('--theme-color', localStorage.quickadColor);
                change_map_colour(localStorage.quickadColor);
            } else {
                document.documentElement.style.setProperty('--theme-color', themecolor);
                change_map_colour(mapcolor);
            }
        }
        // if using slidein
        if (opts.slidein) {
            $(opts.container).slideDown("slow");
        }
        else {
            $(opts.container).show();
        }
        if (opts.preview) {
            $(opts.container + " a").click(
                function () {
                    document.documentElement.style.setProperty('--theme-color', $(this).html());
                    change_map_colour($(this).html());
                }
            );
        }

        $(opts.container + " a").click(
            function () {
                document.documentElement.style.setProperty('--theme-color', $(this).html());
                change_map_colour($(this).html());
                if (localStorage) {
                    localStorage.quickadColor = $(this).html();
                }
            }
        );

    };
    function change_map_colour(color) {
        if(typeof map != 'undefined') {
            map.setOptions({
                styles: null
            });
            map.setOptions({
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "landscape",
                        "stylers": [{"saturation": -100}, {"lightness": 60}]
                    }, {
                        "featureType": "road.local",
                        "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]
                    }, {
                        "featureType": "transit",
                        "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
                    }, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {
                        "featureType": "water",
                        "stylers": [{"visibility": "on"}, {"lightness": 30}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": color}, {"lightness": 40}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": color}, {"lightness": 60}, {"saturation": -40}]
                    }, {}]
            });
        }
    }
})(jQuery);