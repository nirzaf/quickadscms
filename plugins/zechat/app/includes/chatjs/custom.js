


$(window).bind("load",function(){
// $('[data-toggle="tooltip"]').tooltip();

    /*$('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        container: 'body',
        content: function () {
            return $(this).prop('title');
        }

    });*/
});

$(document).on('click', ".e1", function (e){
    // Keep ads item click from being executed.
    e.stopPropagation();
    // Prevent navigating to '#'.
    e.preventDefault();
    var $item = $(this).closest('.chatbox');
    var client = $item.attr('client');
    //alert(client);
    var prevMsg = $("#chatbox_"+client+" .chatboxtextarea").val();
    var shortname = $(this).data('shortname');

    $("#chatbox_"+client+" .chatboxtextarea").val(prevMsg+' '+shortname+' ');
    $("#chatbox_"+client+" .chatboxtextarea").focus();

});

$(document).on('click', "#toggle-emoji", function (e){
    // Keep ads item click from being executed.
    e.stopPropagation();
    // Prevent navigating to '#'.
    e.preventDefault();
    var $item = $(this).closest('.chatbox');
    var client = $item.attr('client');
    //alert(client);
    $("#chatbox_"+client+" .target-emoji").slideToggle( 'fast', function(){

        if ($("#chatbox_"+client+" .target-emoji").css('display') == 'block') {
            $('#chatbox_'+client+' .btn-emoji').removeClass('ti-face-smile').addClass('ti-arrow-circle-down');
        } else {
            $('#chatbox_'+client+' .btn-emoji').removeClass('ti-arrow-circle-down').addClass('ti-face-smile');
        }
    });
    var heit = $('#resultchat').css('max-height');
});



function typePlace() {

    if(!$('#textarea').html() == '')
    {
        $(".input-placeholder").css({'visibility':'hidden'});
    }
    else{
        $(".input-placeholder").css({'visibility':'visible'});
    }
}

$(document).ready(function() {
    $("#minmaxchatlist").click(function(){
        if(eval(localStorage.chatlist)){
            localStorage.chatlist = false;
            $("#showhidechatlist").css('display','none');
        }
        else{
            localStorage.chatlist = true;
            $("#showhidechatlist").css('display','block');
        }
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

    if(eval(localStorage.chatlist)){
        $("#showhidechatlist").css('display','block');
    }
    else{
        $("#showhidechatlist").css('display','none');
    }

    if(eval(localStorage.sound)){
        $("#mute-sound").html('<i class="icon icon-volume-2"></i>');
    }
    else{
        $("#mute-sound").html('<i class="icon icon-volume-off"></i>');
    }
});


