function loadColor(action, newColor){
    /*$.ajax({
        url: "assets/misc/customizer.php",
        method: "POST",
        cache: false,
        data: { action: action, new_color: newColor, default_color: defaultColor },
        success: function(results){
            if( action == "change_color" ){
                $('head').append( $('<link rel="stylesheet" type="text/css">').attr('href', 'assets/css/temporary-style.css') );
                $('link').each(function() {
                    if ($(this).attr("type").indexOf("css") > -1) {
                        $(this).attr("href", $(this).attr("href") + "?id=" + new Date().getMilliseconds());
                    }
                });
            }
            else if ( action == "load_default_color" ){
                createCustomizer(results);
            }
            defaultColor = results;
        },
        error : function (e) {
            console.log(e);
        }
    });*/
}

function createCustomizer(defaultColor) {
    var customizerHtml =
        '<div class="customizer">' +
            '<div class="cog"><i class="fa fa-cog"></i></div>' +
            '<h3>Customizer</h3>' +
            '<ul class="checkboxes">' +
                '<li>' +
                    '<label class="" id="checkbox-fixed-navigation"><input type="checkbox" name="fixed_navigation">Fixed Navigation</label>' +
                '</li>' +
                '<li>' +
                    '<label class="" id="checkbox-nav-btn-only"><input type="checkbox" name="nav_btn_only">Minimized Navigation</label>' +
                '</li>' +
                '<li>' +
                    '<label class="" id="checkbox-rtl"><input type="checkbox" name="rtl">RTL</label>' +
                '</li>' +
            '</ul>' +
            '<input type="text" id="color-picker">' +
        '</div>';

    $(".customizer .cog").live("click", function(){
       $(".customizer").toggleClass("show-it");
    });

    $.getScript( "assets/js/icheck.min.js", function( data, textStatus, jqxhr ) {
        if ($("input[type=checkbox]").length > 0) {
            $("input[type=checkbox]").iCheck();

            if( $("body").hasClass("navigation-fixed") ){
                $('.customizer #checkbox-fixed-navigation').iCheck('check');
            }
            if( $("body").hasClass("rtl") ){
                $('.customizer #checkbox-rtl').iCheck('check');
            }
            if( $("body").hasClass("nav-btn-only") ){
                $('.customizer #checkbox-nav-btn-only').iCheck('check');
            }

            $('.customizer #checkbox-fixed-navigation').on('ifChecked', function(event){
                fixedNavigation(true);
            });
            $('.customizer #checkbox-fixed-navigation').on('ifUnchecked', function(event){
                fixedNavigation(false);
            });

            $('.customizer #checkbox-rtl').on('ifChecked', function(event){
                $('head').append( $('<link rel="stylesheet" type="text/css">').attr('href', 'assets/css/rtl.css') );
                $("body").addClass("rtl");
                $(".owl-carousel").trigger("destroy.owl.carousel");
                initializeOwl();
            });
            $('.customizer #checkbox-rtl').on('ifUnchecked', function(event){
                $('link[href="assets/css/rtl.css"]').remove();
                $("body").removeClass("rtl");
                $(".owl-carousel").trigger("destroy.owl.carousel");
                initializeOwl();
            });

            $('.customizer #checkbox-nav-btn-only').on('ifChecked', function(event){
                $("body").addClass("nav-btn-only");
                responsiveNavigation();
            });
            $('.customizer #checkbox-nav-btn-only').on('ifUnchecked', function(event){
                $("body").removeClass("nav-btn-only");
            });
        }
    });

    $("body").append(customizerHtml);
    $('head').append( $('<link rel="stylesheet" type="text/css">').attr('href', 'assets/misc/spectrum.css') );
    $.getScript( "assets/misc/spectrum.js", function( data, textStatus, jqxhr ) {
        $("#color-picker").spectrum({
            color: defaultColor,
            flat: true,
            preferredFormat: "hex",
            showInput: true,
            clickoutFiresChange: false,
            chooseText: "Save Color",
            cancelText: "",
            showPalette: true,
            showSelectionPalette: false,
            palette: ["#948f77", "#ae0303", "#0e8b4f", "#0c3c7c", "4611a7"],
            change: function(color) {
                loadColor( "change_color", $(".sp-input").val() );
                $(".sp-choose").on("click", function(){

                });
            }
        });
    });
}