$(document).ready(function() {

    $(".e1").click(function(event){
        var client = $('.chat.active-chat').attr('client');

        var prevMsg = $('#chatFrom .chatboxtextarea').val();
        var shortname = $(this).data('shortname');

        $('#chatFrom .chatboxtextarea').val(prevMsg+' '+shortname+' ');
        //$('#chatFrom .chatboxtextarea').focus();
    });
    $(".chat-head .personName").click(function(){
        var personName = $(this).text();
    });



    $("#launchProfile").click(function(){
        var usname = $(this).find('img').attr('alt');

        $('#wchat .wchat').removeClass('two');
        $('#wchat .wchat').addClass('three');
        $('.wchat-three').slideDown(50);
        $('.wchat-three').toggleClass("shw-rside");

        $("#userProfile").html('<div class="preloader"><div class="cssload-speeding-wheel"></div></div>');
        userProfile(usname);
    });

    $(".header-close").click(function(){
        $('#wchat .wchat').removeClass('three');
        $('#wchat .wchat').addClass('two');
        $('.wchat-three').css({'display':'none'});

    });

    $(".scroll-down").click(function(){
        scrollDown();
    });

    $("#mute-sound").click(function(){
        if(eval(localStorage.sound)){
            localStorage.sound = false;
            $("#mute-sound").html('<i class="icon icon-volume-off"></i>');
        }
        else{
            localStorage.sound = true;
            $("#mute-sound").html('<i class="icon icon-volume-2"></i>');
            audiomp3.play();
            audioogg.play();
        }
    });
    $("#MobileChromeplaysound").click(function(){
        if(eval(localStorage.sound)){
            audiomp3.play();
            audioogg.play();
        }
    });
    if(eval(localStorage.sound)){
        $("#mute-sound").html('<i class="icon icon-volume-2"></i>');
    }
    else{
        $("#mute-sound").html('<i class="icon icon-volume-off"></i>');
    }

    //For Mobile on keyboard show/hide

    /*var _originalSize = $(window).width() + $(window).height()
    $(window).resize(function(){
        if($(window).width() + $(window).height() != _originalSize){
            //alert("keyboard show up");
            $(".target-emoji").css({'display':'none'});
            $('.wchat-filler').css({'height':0+'px'});

        }else{
            //alert("keyboard closed");
            $('#chatFrom .chatboxtextarea').blur();
        }
    });*/
});


function ShowProfile() {
    var usname = $('.right .top').attr("data-user");
    $('#wchat .wchat').removeClass('two');
    $('#wchat .wchat').addClass('three');
    $('.wchat-three').slideDown(50);
    $('.wchat-three').toggleClass("shw-rside");

    $("#userProfile").html('<div class="preloader"><div class="cssload-speeding-wheel"></div></div>');
    userProfile(usname);
}

function chatemoji() {
    $(".target-emoji").slideToggle( 'fast', function(){

        if ($(".target-emoji").css('display') == 'block') {
            //alert($(window).height());
            //$('.chat-list').css({'height':(($(window).height())-279)+'px'});
            $('.wchat-filler').css({'height':225+'px'});
            $('.btn-emoji').removeClass('ti-face-smile').addClass('ti-arrow-circle-down');
        } else {
            //$('.chat-list').css({'height':(($(window).height())-179)+'px'});
            $('.wchat-filler').css({'height':0+'px'});
            $('.btn-emoji').removeClass('ti-arrow-circle-down').addClass('ti-face-smile');
        }
    });
    var heit = $('#resultchat').css('max-height');
}

function typePlace() {

    if(!$('#textarea').html() == '')
    {
        $(".input-placeholder").css({'visibility':'hidden'});
    }
    else{
        $(".input-placeholder").css({'visibility':'visible'});
    }

}

/*Get get on scroll
$("#resultchat").scrollTop($("#resultchat")[0].scrollHeight);
Assign scroll function to chatBox DIV*/
$('.wchat-chat-msgs ').scroll(function(){
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
        $(".scroll-down").css({'visibility':'hidden'});
    }
    if ($('.wchat-chat-msgs ').scrollTop() == 0){

        $(".scroll-down").css({'visibility':'visible'});

        var client = $('.chat.active-chat').attr('client');

        if($("#chatbox_"+client+" .pagenum:first").val() != $("#chatbox_"+client+" .total-page").val()) {

            $('#loader').show();
            var pagenum = parseInt($("#chatbox_"+client+" .pagenum:first").val()) + 1;

            var URL = siteurl+'plugins/wchat/chat.php?page='+pagenum+'&action=get_all_msg&client='+client;

            get_all_msg(URL);                                       // Calling get_all_msg function

            $('#loader').hide();									// Hide loader on success

            if(pagenum != $("#chatbox_"+client+" .total-page").val()) {
                setTimeout(function () {										//Simulate server delay;

                    $('.wchat-chat-msgs').scrollTop(100);							// Reset scroll
                }, 458);
            }
        }

    }
});
/*Get get on scroll*/

//Inbox User search
$(document).ready(function(){
    $('.live-search-list li').each(function(){
        $(this).attr('data-search-term', $(this).text().toLowerCase());
    });

    $('.live-search-box').on('keyup', function(){
        var searchTerm = $(this).val().toLowerCase();
        $('.live-search-list li').each(function(){

            if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

$(window).bind("load", function() {


    $('.chatboxtextarea').on('focus',function(e) {
        $(".target-emoji").css({'display':'none'});
        $('.wchat-filler').css({'height':0+'px'});
    });
});

$('.left .person').mousedown(function(){
    if ($(this).hasClass('.active')) {
        return false;
    } else {
        var findChat = $(this).attr('data-chat');
        var personName = $(this).find('.personName').text();
        $('.right .top .personName').html(personName);
        //$('.right .top').attr("data-user",personName);
        var userImage = $(this).find('.userimage').html();
        $('.right .top .userimage').html(userImage);
        var personStatus = $(this).find('.personStatus').html();
        $('.right .top .personStatus').html(personStatus);
        var hideContent = $(this).find('.hidecontent').html();
        $('.right .hidecontent').html(hideContent);
        $('.chat').removeClass('active-chat');
        $('.left .person').removeClass('active');
        $(this).addClass('active');
        $('.chat[data-chat = '+findChat+']').addClass('active-chat');
    }
});






/*
function start() {
    add = setInterval("chatfrindList();",3000);
}start();*/
