/*
 Copyright (c) 2015 Bylancer
 Developed by Dev Katriya
 Date : 10/1/2015
 */

var windowFocus = true;
var username;
var image_href;
var scrollcode;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 5000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;
var audioogg = new Audio(siteurl+'plugins/zechat/app/includes/audio/chat.ogg');
var audiomp3 = new Audio(siteurl+'plugins/zechat/app/includes/audio/chat.mp3');

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();
if(rtl){
    var chat_margin_from = "left";
}else{
    var chat_margin_from = "right";
}
// default is PNG but you may also use SVG
emojione.imageType = 'png';
emojione.sprites = false;
// default is ignore ASCII smileys like :) but you can easily turn them on
emojione.ascii = true;
// if you want to host the images somewhere else
// you can easily change the default paths
emojione.imagePathPNG = siteurl+'plugins/zechat/app/plugins/smiley/assets/png/';
emojione.imagePathSVG = siteurl+'plugins/zechat/app/plugins/smiley/assets/svg/';

function msg_eventpl(chatboxtitle,sender,img,message_content,time,position){
    //var tooltip = '<div class=\'tooltiptext\'><img class=\'pull-left\' src=\'storage/profile/'+img+'\'> '+sender+' <i>'+time+'</i></div>';
    var zechat_eventpl = '<li class="clearfix m-t-10 conversers2">' +
        '<div class="conversation-text" data-toggle="tooltip" data-placement="left" data-html="true">' +
        '<div class="ctext-wrap"><p class="">'+message_content+' <br><i class="text-right">'+time+'</i></p></div></div></li>';

    if(position == "append"){
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").append(zechat_eventpl);
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
    }
    else{
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend(zechat_eventpl);
    }

}
function msg_oddtpl(chatboxtitle,sender,img,message_content,time,position,icon){

    //var tooltip = '<div class=\'tooltiptext\'><img class=\'pull-left\' src=\'storage/profile/'+img+'\'> '+sender+' <i>'+time+'</i></div>';
    var zechat_oddtpl = '<li class="clearfix m-t-10 odd conversers1">' +
        '<div class="conversation-text" data-toggle="tooltip" data-placement="right" data-html="true">' +
        '<div class="ctext-wrap"><p class="">'+message_content+'</p><i class="text-right">'+time+'</i><span class="msg-status msg-'+chatboxtitle+'"><i class="fa '+icon+'"></i></span></div></div></li>';

    if(position == "append"){
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").append(zechat_oddtpl);
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
    }
    else{
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend(zechat_oddtpl);
    }
}

$(document).ready(function(){
    originalTitle = document.title;
    startChatSession();

    $([window, document]).blur(function(){
        windowFocus = false;
    }).focus(function(){
        windowFocus = true;
        document.title = originalTitle;
    });
});

function restructureChatBoxes() {
    align = 0;
    for (x in chatBoxes) {
        chatboxtitle = chatBoxes[x];

        if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {

            if (align == 0) {
                $("#chatbox_"+chatboxtitle).css(chat_margin_from, '10px');
            } else {
                width = (align)*(273+7)+10;
                $("#chatbox_"+chatboxtitle).css(chat_margin_from, width+'px');
            }
            align++;
        }
    }
}

function chatWith(chatuser,chatheaderimg,status) {
    if(chatuser.toLowerCase() == session_uname.toLowerCase()){
        alert(LANG_ENABLE_CHAT_YOURSELF);
        return;
    }
    createChatBox(chatuser,chatheaderimg,status);
    $("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxtitle,chatheaderimg,status,minimizeChatBox) {
    if ($("#chatbox_"+chatboxtitle).length > 0) {
        if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
            $("#chatbox_"+chatboxtitle).css('display','block');
            restructureChatBoxes();
        }
        $("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
        return;
    }

    $("<div />" ).attr("id","chatbox_"+chatboxtitle)
        .addClass("chatbox active-chat")
        .attr("client",chatboxtitle)
        .html('<div class="chatbox-icon" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')" href="#"><div class="contact-floating red"><img class="chat-image img-circle pull-left" src="'+siteurl+'storage/profile/'+chatheaderimg+'"><small class="unread-msg">2</small><small class="status"></small></div></div>' +
        '<div class="panel personal-chat"> ' +
        '<div class="panel-heading chatboxhead"> ' +
        '<div class="panel-title">' +
        '<img class="chat-image img-circle pull-left" height="36" width="36" src="'+siteurl+'storage/profile/'+chatheaderimg+'" alt="avatar-image"> ' +
        '<div class="header-elements">' +
        '<a href="'+siteurl+'profile/'+chatboxtitle+'">'+chatboxtitle+'</a>' +
        '</h3>' +
        '<br> ' +
        '<small class="status '+status+'"><b>'+status+'</b></small> ' +
        '<div class="pull-right options"> ' +
        '<div class="btn-group uploadFile" id="uploadFile" data-client="'+chatboxtitle+'"><span><i class="ti-clip attachment"></i></span></div> ' +
        '<div class="btn-group"  onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')" href="#">' +
        '<span>' +
        '<i class="fa fa-minus-circle"></i>' +
        '</span>' +
        '</div> ' +
        '<div class="btn-group" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')" href="#">' +
        '<span><i class="fa fa-times-circle"></i></span>' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '<div class="panel-body"><div id="uploader_'+chatboxtitle+'" style="display: none;height: 342px;"><p>Your browser does not have Flash, Silverlight or HTML5 support.</p></div>' +
        '<div class="chat-conversation"> ' +
        '<ul class="conversation-list chatboxcontent" id="resultchat_'+chatboxtitle+'"> </ul> ' +
        '<footer class="wchat-footer wchat-chat-footer chatboxinput"> ' +
        '<div id="chatFrom"> ' +
        '<div class="block-wchat"> ' +
        '<button class="icon ti-face-smile font-24 btn-emoji" id="toggle-emoji"></button>' +
        '<div class="input-container"> ' +
        '<div class="input-emoji"> ' +
        '<div class="input-placeholder" style="visibility: hidden; display: none;">'+LANG_TYPE_A_MESSAGE+'</div> ' +
        '<textarea class="input chatboxtextarea" id="chatboxtextarea" name="chattxt" contenteditable="" spellcheck="true" style="resize:none;height:20px" placeholder="'+LANG_TYPE_A_MESSAGE+'" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea>' +
        '<input id="to_uname" name="to_uname" value="'+chatboxtitle+'" type="hidden">' +
        '<input id="from_uname" name="from_uname" value="Beenny" type="hidden"> ' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '<div class="wchat-box-items-positioning-container"><div class="wchat-box-items-overlay-container"><div class="target-emoji" style="display: none"><div id="include-smiley-panel"></div></div></div></div>'+
        '</footer> ' +
        '</div> ' +
        '</div>' +
        '</div>')
        .appendTo($( "body" ));

    var scrollcode = $("#resultchat_"+chatboxtitle).scroll(function(){
        if ($("#resultchat_"+chatboxtitle).scrollTop() == 0){

            var client = $("#chatbox_"+chatboxtitle).attr("client");

            if($("#chatbox_"+client+" .pagenum:first").val() != $("#chatbox_"+client+" .total-page").val()) {

                $("#loader").show();
                var pagenum = parseInt($("#chatbox_"+client+" .pagenum:first").val()) + 1;

                var URL = siteurl+plugin_directory+"?page="+pagenum+"&action=get_all_msg&client="+client;

                get_all_msg(URL);

                $("#loader").hide();									// Hide loader on success

                if(pagenum != $("#chatbox_"+client+" .total-page").val()) {
                    setTimeout(function () {										//Simulate server delay;

                        $("#resultchat_"+chatboxtitle).scrollTop(100);							// Reset scroll
                    }, 458);
                }
            }

        }
    });


    $('<script type="text/javascript">scrollcode</' + 'script>').appendTo(document.body);

    get_all_msg(siteurl+plugin_directory+"?page=1&action=get_all_msg&client="+chatboxtitle);
    lastseen(chatboxtitle);

    smiley_tpl(chatboxtitle);

    $("#chatbox_"+chatboxtitle).css('bottom', '0px');

    chatBoxeslength = 0;
    for (x in chatBoxes) {
        if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
            chatBoxeslength++;
        }
    }

    if (chatBoxeslength == 0) {
        $("#chatbox_"+chatboxtitle).css(chat_margin_from, '10px');
    } else {
        width = (chatBoxeslength)*(273+7)+10;
        $("#chatbox_"+chatboxtitle).css(chat_margin_from, width+'px');
    }

    chatBoxes.push(chatboxtitle);

    if (minimizeChatBox == 1) {
        minimizedChatBoxes = new Array();

        if ($.cookie('chatbox_minimized')) {
            minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
        }
        minimize = 0;
        for (j=0;j<minimizedChatBoxes.length;j++) {
            if (minimizedChatBoxes[j] == chatboxtitle) {
                minimize = 1;
            }
        }

        if (minimize == 1) {
            $('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
            $('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
        }
    }

    chatboxFocus[chatboxtitle] = false;

    $("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
        chatboxFocus[chatboxtitle] = false;
        $("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
    }).focus(function(){
        chatboxFocus[chatboxtitle] = true;
        newMessages[chatboxtitle] = false;
        $('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
        $("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
    });


    $("#chatbox_"+chatboxtitle).show();

}

function chatHeartbeat(){

    var itemsfound = 0;
    if (windowFocus == false) {

        var blinkNumber = 0;
        var titleChanged = 0;
        for (x in newMessagesWin) {
            if (newMessagesWin[x] == true) {
                ++blinkNumber;
                if (blinkNumber >= blinkOrder) {
                    document.title = x+' says...';
                    titleChanged = 1;
                    break;
                }
            }
        }

        if (titleChanged == 0) {
            document.title = originalTitle;
            blinkOrder = 0;
        } else {
            ++blinkOrder;
        }

    } else {
        for (x in newMessagesWin) {
            newMessagesWin[x] = false;
        }
    }

    for (x in newMessages) {
        if (newMessages[x] == true) {
            if (chatboxFocus[x] == false) {
                //FIXME: add toggle all or none policy, otherwise it looks funny
                $('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
            }
        }
    }

    $.ajax({
        url: siteurl+plugin_directory+"?action=chatheartbeat",
        cache: false,
        dataType: "json",
        success: function(data) {

            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    chatboxtitle = item.f;
                    sender = item.f;
                    senderimg = item.p;
                    img = item.p2;
                    status = item.st;
                    msgtype = item.mtype;
                    time = item.time;

                    if ($("#chatbox_"+chatboxtitle).length <= 0) {
                        createChatBox(chatboxtitle,senderimg,status);
                        if (eval(localStorage.sound)) {
                            audiomp3.play();
                            audioogg.play();
                        }
                        return;
                    }
                    if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
                        $("#chatbox_"+chatboxtitle).css('display','block');
                        restructureChatBoxes();
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    var message_content = item.m;
                    if (msgtype=="text")
                        message_content = item.m;
                    else if (msgtype == "file") {

                        var str = item.m;
                        str = str.replace(/&quot;/g, '"');
                        var file_content = JSON.parse(str);
                        var message_content = "";

                        if (file_content.file_type == "image") {
                            message_content = "<a url='" + file_content.file_path + "' onclick='trigq(this)'><img src='" + siteurl + "storage/user_files/small" + file_content.file_name + "' class='userfiles'/></a>";
                        }
                        else if (file_content.file_type == "video") {
                            message_content = '<video class="userfiles" controls>' +
                            '<source src="' + siteurl + "storage/user_files/" + file_content.file_name + '" type="video/mp4">' +
                            'Your browser does not support HTML5 video.' +
                            '</video>';
                        }
                        else {
                            message_content = "<a href='" + file_content.file_path + "' class='download-link' download></a>";
                        }

                    }

                    if (item.s == 2) {
                        $("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
                    } else {

                        if (msgtype == "text") {
                            message_content = emojione.shortnameToImage(message_content);  // Set imotions
                        }
                        newMessages[chatboxtitle] = true;
                        newMessagesWin[chatboxtitle] = true;

                        msg_eventpl(chatboxtitle,sender,senderimg,message_content,time,"append");

                        if (eval(localStorage.sound)) {
                            audiomp3.play();
                            audioogg.play();
                        }
                    }


                    itemsfound += 1;
                }
            });

            chatHeartbeatCount++;

            if (itemsfound > 0) {
                chatHeartbeatTime = minChatHeartbeat;
                chatHeartbeatCount = 1;
            } else if (chatHeartbeatCount >= 10) {
                chatHeartbeatTime *= 2;
                chatHeartbeatCount = 1;
                if (chatHeartbeatTime > maxChatHeartbeat) {
                    chatHeartbeatTime = maxChatHeartbeat;
                }
            }
            if (itemsfound > 0) {
                $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
            }
        }});
    setTimeout('chatHeartbeat();',chatHeartbeatTime);

}

function get_all_msg(url){

    $.ajax({
        url: url,
        cache: false,
        dataType: "json",
        success: function(data) {

            $.each(data.items, function(i,item){
                if (item) { // fix strange ie bug

                    chatboxtitle = item.f;
                    chatboximg = item.p2;
                    senderimg = item.p;
                    status = item.st;
                    sender = item.sender;
                    page = item.page;
                    pages = item.pages;
                    msgtype = item.mtype;
                    time = item.time;

                    /*if ($("#chatbox_"+chatboxtitle).length <= 0) {
                     createChatBox(chatboxtitle,status,1);
                     }*/

                    if (item.page != "" && i == 0) {
                        $("#chatbox_" + chatboxtitle + " .chatboxcontent").prepend('<input type="hidden" class="pagenum" value="' + item.page + '" /><input type="hidden" class="total-page" value="' + pages + '" />');
                    }

                    if (item.s == 1) {
                        //item.f = username;
                    }

                    var message_content = item.m;
                    if (msgtype == "text") {
                        message_content = item.m;
                        message_content = emojione.shortnameToImage(message_content);
                    }
                    else if (msgtype=="file") {

                        var str = item.m;
                        str = str.replace(/&quot;/g, '"');
                        var file_content = JSON.parse(str);
                        var message_content="";

                        if (file_content.file_type == "image") {
                            message_content = "<a url='" + file_content.file_path + "' onclick='trigq(this)'><img src='" + siteurl + "storage/user_files/" + file_content.file_name + "' class='userfiles'/></a>";
                        }
                        else if(file_content.file_type == "video") {
                            message_content = '<video class="userfiles" controls>' +
                            '<source src="' + file_content.file_path + '" type="video/mp4">' +
                            'Your browser does not support HTML5 video.' +
                            '</video>';
                        }
                        else{
                            message_content = "<a href='"+file_content.file_path+"' class='download-link' download></a>";
                        }

                    }

                    if (item.s == 2) {
                        $("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
                    } else {
                        if (item.u == 2) {
                            msg_eventpl(chatboxtitle,sender,senderimg,message_content,time,"prepend");
                        } else {
                            msg_oddtpl(chatboxtitle,sender,senderimg,message_content,time,"prepend","fa-check");
                        }
                    }
                }
                if (page == 1) {
                    $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
                }
            });



            /*for (i=0;i<chatBoxes.length;i++) {
             chatboxtitle = chatBoxes[i];
             $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
             setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
             }*/

        }});


}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) {

    if(event.keyCode == 13 && event.shiftKey == 0)  {
        message = $(chatboxtextarea).val();
        message = message.replace(/^\s+|\s+$/g,"");


        $(chatboxtextarea).val('');
        $(chatboxtextarea).focus();
        $(chatboxtextarea).css('height','20px');
        if (message != '') {
            $.post(siteurl+plugin_directory+"?action=sendchat", {to: chatboxtitle, message: message} , function(data){

                message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");

                var $con = message;
                var $words = $con.split(' ');
                for (i in $words) {
                    if ($words[i].indexOf('http://') == 0 || $words[i].indexOf('https://') == 0) {
                        $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                    }
                    else if ($words[i].indexOf('www') == 0 ) {
                        $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                    }
                }
                message = $words.join(' ');
                message = emojione.shortnameToImage(message); // Set imotions

                $('#chatbox_'+chatboxtitle+' .target-emoji').css({'display':'none'});
                $('#chatbox_'+chatboxtitle+' .btn-emoji').removeClass('ti-arrow-circle-down').addClass('ti-face-smile');

                msg_oddtpl(chatboxtitle,session_uname,session_img,message,LANG_JUST_NOW,"append","fa-clock-o");

                $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);

                if(data == '1'){
                    $("#chatbox_"+chatboxtitle+" .msg-"+chatboxtitle).last().html('<i class="fa fa-check"></i>');
                }else{
                    $("#chatbox_"+chatboxtitle+" .msg-"+chatboxtitle).last().html('<i class="fa fa-exclamation-circle"></i> Error');
                }
            });
        }
        chatHeartbeatTime = minChatHeartbeat;
        chatHeartbeatCount = 1;

        return false;
    }

    var adjustedHeight = chatboxtextarea.clientHeight;
    var maxHeight = 94;

    if (maxHeight > adjustedHeight) {
        adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
        if (maxHeight)
            adjustedHeight = Math.min(maxHeight, adjustedHeight);
        if (adjustedHeight > chatboxtextarea.clientHeight)
            $(chatboxtextarea).css('height',adjustedHeight+8 +'px');
    } else {
        $(chatboxtextarea).css('overflow','auto');
    }

}

function lastseen(uname){
    $.ajax({
        url: siteurl + plugin_directory+"?action=lastseen&uname="+uname,
        cache: false,
        type: "POST",
        success: function (data) {
            if(data == "Online"){
                $("#chatbox_"+uname+" .panel-heading .status").removeClass("Offline");
            } else{
                $("#chatbox_"+uname+" .panel-heading .status").removeClass("Online");
            }
            $("#chatbox_"+uname+" .panel-heading .status").addClass(data).html(data);
        },
        error: function( error )
        {
            //alert( error );
        }
    });
}

function startChatSession(){
    $.ajax({
        url: siteurl+plugin_directory+"?action=startchatsession",
        cache: false,
        dataType: "json",
        success: function(data) {

            username = session_uname;

            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    chatboxtitle = item.f;
                    //img = item.spic;
                    chatboximg = item.p;
                    sesimg = item.p2;
                    status = item.st;

                    if ($("#chatbox_"+chatboxtitle).length <= 0) {
                        createChatBox(chatboxtitle,chatboximg,status,1);
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    if (item.s == 2) {
                        //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
                    } else {

                        if (item.u == 2) {
                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+item.f+'</span></div><img class="direct-chat-img" src="'+siteurl+'storage/profile/'+item.p+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        } else {
                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+item.f+'</span></div><img class="direct-chat-img" src="'+siteurl+'storage/profile/'+img+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        }
                    }
                }
            });

            for (i=0;i<chatBoxes.length;i++) {
                chatboxtitle = chatBoxes[i];
                $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
                setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug

            }

            setTimeout('chatHeartbeat();',chatHeartbeatTime);
        }});
}

function closeChatBox(chatboxtitle) {
    $('#chatbox_'+chatboxtitle).css('display','none');
    restructureChatBoxes();

    $.post(siteurl+plugin_directory+"?action=closechat", { chatbox: chatboxtitle} , function(data){
    });

}

function toggleChatBoxGrowth(chatboxtitle) {

    if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {
        var minimizedChatBoxes = new Array();

        if ($.cookie('chatbox_minimized')) {
            minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
        }

        var newCookie = '';

        for (i=0;i<minimizedChatBoxes.length;i++) {
            if (minimizedChatBoxes[i] != chatboxtitle) {
                newCookie += chatboxtitle+'|';
            }
        }

        newCookie = newCookie.slice(0, -1)


        $.cookie('chatbox_minimized', newCookie);
        $('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
        $('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
    } else {
        var newCookie = chatboxtitle;

        if ($.cookie('chatbox_minimized')) {
            newCookie += '|'+$.cookie('chatbox_minimized');
        }


        $.cookie('chatbox_minimized',newCookie);
        $('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
        $('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
    }

}

/**
 * Cookie plugin
 *
 * Copyright (c) 2015 Dev Katariya (Bylancer.com)

 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

var lastTypedTime = new Date(0); // it's 01/01/1970, actually some time in the past
var typingDelayMillis = 5000; // how long user can "think about his spelling" before we show "No one is typing -blank space." message

function refreshTypingStatus(chatboxtitle){
    if (!$('#textarea').is(':focus') || $('#textarea').val() == '' || new Date().getTime() - lastTypedTime.getTime() > typingDelayMillis) {
        $("#typing_on").html('');
    } else {
        //$("#typing_on").html('User is typing...');
        $.post(siteurl+plugin_directory+"?action=typingstatus", {to: chatboxtitle, typing: 1} , function(data){

        });
    }
}
function updateLastTypedTime() {
    lastTypedTime = new Date();
}
//setInterval(refreshTypingStatus, 100)

//ScrollDown Function
function scrollDown2(chatboxtitle){
    var wtf    = $("#chatbox_"+chatboxtitle+" .chatboxcontent");
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
}
//Search User In contactList
jQuery(document).ready(function(){
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

//Uploading Image And files
// Initialize the widget when the DOM is ready
$(document).on('click', ".uploadFile", function (e){
    var touname = $(this).data('client');
    $(function() {

        $('#uploader_'+touname).plupload({
            // General settings
            runtimes : 'html5,flash,silverlight,html4',
            url: siteurl+"php/upload-chat-file.php?tun="+touname,

            // User can upload no more then 20 files in one go (sets multiple_queues to false)
            max_file_count: 5,

            chunk_size: '1mb',

            // Resize images on clientside if we can
            /*resize : {
             width : 200,
             height : 200,
             quality : 90,
             crop: false // crop to exact dimensions
             },*/

            filters : {
                // Maximum file size
                max_file_size : '100mb',
                // Specify what files to browse for
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png"},
                    {title : "Zip files", extensions : "zip,rar,mp3,mp4,txt,doc,docx,pdf,ppt,psd,xls,xlsx,xml"}
                ]
            },

            // Rename files by clicking on their titles
            rename: false,

            // Sort files
            sortable: true,

            // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
            dragdrop: true,

            // Views to activate
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },

            // Flash settings
            flash_swf_url : '../plugins/uploader/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url : '../plugins/uploader/Moxie.xap',

            init: {

                FileUploaded: function(up, file, info) {
                    // Called when file has finished uploading
                    log('[FileUploaded] File:', file, "Info:", info);
                },
                Destroy: function(up) {
                    // Called when uploader is destroyed
                    //log('[Destroy] ');
                },
                Error: function(up, err) {
                    document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                }
            }

        });

        $('#uploader_'+touname).on('click', '#close_uploadFile', function(e) {
            $('#uploader_'+touname).plupload('destroy');
            $('#uploader_'+touname).css({'display':'none'});
            $('#chatbox_'+touname+' .chat-conversation').css({'display':'block'});
            //console.clear();
        });
        $('#uploader_'+touname).on('complete', function() {
            $('#uploader_'+touname).plupload('destroy');
            $('#uploader_'+touname).css({'display':'none'});
            $('#chatbox_'+touname+' .chat-conversation').css({'display':'block'});
            //console.clear();
        });
    });
    $('#uploader_'+touname).css({'display':'block'});
    $('#chatbox_'+touname+' .chat-conversation').css({'display':'none'});
});
function log() {
    plupload.each(arguments, function(arg) {
        if (typeof(arg) != "string") {
            plupload.each(arg, function(value, key) {
                if (typeof(value) != "function") {
                    if(key == "response"){
                        var json_var = JSON.parse(value);
                        var id = json_var.id;
                        var toName = json_var.toName;
                        var username = json_var.username;
                        var picname = json_var.picname;
                        var file_name = json_var.file_name;
                        var file_path = json_var.file_path;
                        var file_type = json_var.file_type;

                        if (file_type == "image"){
                            var message_content = "<a url='"+file_path+"' onclick='trigq(this)' style='cursor: pointer;'><img src='"+file_path+"' style='max-width:156px;padding: 4px 0 4px 0; border-radius: 7px;cursor: pointer;'/></a>";
                        }
                        else if(file_type == "video"){
                            message_content = '<video class="userfiles" controls>' +
                            '<source src="'+file_path+'" type="video/mp4">'+
                            'Your browser does not support HTML5 video.'+
                            '</video>';
                        }
                        else{
                            message_content = "<a href='"+file_path+"' class='download-link' download></a>";
                        }

                        msg_oddtpl(toName,session_uname,session_img,message_content,LANG_JUST_NOW,"append","fa-check");

                        $("#chatbox_"+toName+" .chatboxcontent").scrollTop($("#chatbox_"+toName+" .chatboxcontent")[0].scrollHeight);

                    }
                }
            });
        } else {

        }
    });
}


