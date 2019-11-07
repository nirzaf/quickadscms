// Theme color settings
$(document).ready(function(){
    function store(name, val) {
        //if (typeof (Storage) !== "undefined") {
        if(eval(localStorage.setItem(name, val))){
          localStorage.setItem(name, val);
        } else {
          window.alert('Please use a modern browser to properly view this template!');
        }
    }

    /********Main Theme***********/

    $("*[maintheme]").click(function(e){
        e.preventDefault();
        var currentStyle = $(this).attr('maintheme');
        localStorage.setItem('wchat_maintheme', currentStyle);
        //createCookie("wchat_maintheme",currentStyle,30);
        $('#maintheme').attr({href: 'assets/css/'+currentStyle+'.css'})
    });

    var currentTheme = localStorage.wchat_maintheme;
    if(currentTheme)
    {
        $('#maintheme').attr({href: 'assets/css/'+currentTheme+'.css'});
        $('#mainthemecolors li a').removeClass('working');
        $( 'a[ maintheme=' + currentTheme + ']' ).addClass( 'working' );
    }
    // color selector
    $('#mainthemecolors').on('click', 'a', function(){
        $('#mainthemecolors li a').removeClass('working');
        $(this).addClass('working')
    });

    /********Theme Colors***********/

    $("*[theme]").click(function(e){
        e.preventDefault();
        var currentStyle = $(this).attr('theme');
        localStorage.setItem('wchat_themecolor', currentStyle);
        //createCookie("wchat_themecolor",currentStyle,30);
        $('#theme').attr({href: 'assets/css/colors/'+currentStyle+'.css'})
    });

    //var currentTheme = readCookie('wchat_themecolor');
    var currentTheme = localStorage.wchat_themecolor;

    if(currentTheme)
    {
        $('#theme').attr({href: 'assets/css/colors/'+currentTheme+'.css'});
        $('#themecolors li a').removeClass('working');
        $( 'a[ theme=' + currentTheme + ']' ).addClass( 'working' );
    }
    // color selector
    $('#themecolors').on('click', 'a', function(){
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });

});



function get(name) {

}


function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {
    createCookie(name,"",-1);
}