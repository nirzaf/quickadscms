(function($){
    // Update the site title in real time...
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '.logo .logo-title' ).html( newval );
        } );
    } );


    wp.customize("color_scheme", function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--theme-color', newval);
        } );
    });

    wp.customize("heading", function(value) {
        value.bind(function(newval) {
            $( '.quickad-section .container .page-title h1' ).html( newval );
        } );
    });

    wp.customize("sub_heading", function(value) {
        value.bind(function(newval) {
            $( '.quickad-section .container .page-title h2' ).html( newval );
        } );
    });

    wp.customize("back_image", function(value) {
        value.bind(function(newval) {
            $( '.has-background .background-wrapper .bg-transfer').css("background-image", 'url( ' + newval + ')');
        } );
    });


})(jQuery);