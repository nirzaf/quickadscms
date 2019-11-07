/*
 Copyright (c) 2015 Bylancer
 Developed by Dev Katriya
 Date : 10/1/2015
 */
var windowFocus = true;
var username;
var TOusername;
var msgid;
var chatboxtitle;
var chkSeenInterval;
var intervalChatHeart;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 5000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;
var audioogg = new Audio(siteurl+'plugins/wchat/audio/chat.ogg');
var audiomp3 = new Audio(siteurl+'plugins/wchat/audio/chat.mp3');

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();

$(document).on("click", "#refreshPage", function(){
    location.reload(true);
});
$(document).ready(function(){
    originalTitle = document.title;
    startChatSession();
    $([window, document]).blur(function(){
        windowFocus = false;
    }).focus(function(){
        windowFocus = true;
        document.title = originalTitle;
    });

    chatfrindList();
    scrollDown();
});

function scrollDown(){
    var wtf    = $('.wchat-chat-body');
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
    $(".scroll-down").css({'visibility':'hidden'});
}

function updateSeenmsg(chatuser) {
    $.post(siteurl+plugin_directory+"?action=updateSeenmsg", {chatuser: chatuser} , function(data){
    });
    $('#chatbox1_'+chatuser+' .count').html('');
}

function chatWith(chatuser,toid,img,status) {

    if ($("#pane-intro").css('visibility') == 'visible')
    {
        $("#pane-intro").css({'visibility':'hidden'});
        $(".chat-right-aside").css({'visibility':'visible'});
    }
    TOusername = chatuser;
    clearTimeout(chkSeenInterval);
    clearTimeout(intervalChatHeart);
    intervalChatHeart = setInterval('chatHeartbeat(TOusername);',chatHeartbeatTime);
    scrollDown();
    updateSeenmsg(chatuser);
    chatfrindList();
    checkMsgSeen("last",chatuser);
    createChatBox(chatuser,toid,img,status);

    $('.right .top').attr("data-user",chatuser);
}

function restructureChatBoxes() {
    align = 0;

    for (x in chatBoxes) {
        chatboxtitle = chatBoxes[x];

        if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
            if (align == 0) {
                //$("#chatbox_"+chatboxtitle).css('right', '300px');
            } else {
                width = (align)*(273+7)+300;
                //$("#chatbox_"+chatboxtitle).css('right', width+'px');
            }
            align++;
        }
    }
}

function createChatBox(chatboxtitle,toid,img,status,minimizeChatBox) {
    lastseen(chatboxtitle);
    var chatFormTpl =
        '<div class="block-wchat" id="chatForm_'+chatboxtitle+'">' +
        '<div id="typing_on"></div>'+
        '<button class="icon ti-face-smile font-24 btn-emoji" onclick="javascript:chatemoji()" href="#" id="toggle-emoji"></button>' +
        '<div class="input-container">' +
        '<div class="input-emoji">' +
        '<div class="input-placeholder" style="visibility: visible;display:none;">'+LANG_TYPE_A_MESSAGE+'</div>' +
        '<textarea class="input chatboxtextarea" id="chatboxtextarea" name="chattxt" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+toid+'\',\''+img+'\');" contenteditable spellcheck="true" style="resize:none;height:20px" placeholder="'+LANG_TYPE_A_MESSAGE+'"></textarea>' +
        '</div>' +
        '</div>' +
        '<button onclick="javascript:return clickTosendMessage(\''+chatboxtitle+'\',\''+toid+'\',\''+img+'\');" class="btn-icon icon-send fa fa-paper-plane-o font-24 send-container"></button>' +
        '</div>';


    if ($("#chatbox_"+chatboxtitle).length > 0) {

        $("#chatFrom").html(chatFormTpl);

        $("#chatForm_"+chatboxtitle+" .chatboxtextarea").blur(function(){
            chatboxFocus[chatboxtitle] = false;
            $("#chatForm_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
        }).focus(function(){
            chatboxFocus[chatboxtitle] = true;
            newMessages[chatboxtitle] = false;
            $('#chatbox1_'+chatboxtitle+'.chatboxhead').removeClass('chatboxblink');
            $("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
        });

        if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
            $("#chatbox_"+chatboxtitle).css('display','block');

            restructureChatBoxes();
        }

        $(".chatboxtextarea").focus();
        return;
    }


    $(" <div />" ).attr("id","chatbox_"+chatboxtitle)
        .addClass("chat chatboxcontent active-chat")
        .attr("data-chat","person_"+toid)
        .attr("client",chatboxtitle)
        .html('<span class="hidecontent"></span>')
        .appendTo($( "#resultchat" ));
    if (minimizeChatBox != 1) {
        $("#chatFrom").html(chatFormTpl);
    }

    get_all_msg(siteurl+plugin_directory+"?page=1&action=get_all_msg&client="+chatboxtitle);

    chatBoxeslength = 0;

    for (x in chatBoxes) {
        if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
            chatBoxeslength++;
        }
    }

    if (chatBoxeslength == 0) {

    } else {
        width = (chatBoxeslength)*(273+7)+300;

    }

    chatBoxes.push(chatboxtitle);



    chatboxFocus[chatboxtitle] = false;

    $("#chatForm_"+chatboxtitle+" .chatboxtextarea").blur(function(){
        chatboxFocus[chatboxtitle] = false;
        $("#chatForm_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
    }).focus(function(){
        chatboxFocus[chatboxtitle] = true;
        newMessages[chatboxtitle] = false;
        $('#chatbox1_'+chatboxtitle+'.chatboxhead').removeClass('chatboxblink');
        $("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
    });

    if (minimizeChatBox == 1) {
        if (minimizeChatBox == 1) {
            $('#chatbox_'+chatboxtitle).removeClass('active-chat');
        }
    }
    else{
        $("#chatbox_"+chatboxtitle).show();
    }


}

function get_all_msg(url){

    $.ajax({
        url: url,
        cache: false,
        dataType: "json",
        success: function(data) {
            //username = data.username;
            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    chatboxtitle = item.f;
                    toid = item.x;
                    img = item.p;
                    status = item.st;
                    seen = item.seen;
                    sender = item.sender;
                    page = item.page;
                    pages = item.pages;
                    msgtype = item.mtype;
                    message_content = item.m;



                    if (item.page != "" && i == 0) {
                        $("#chatbox_"+chatboxtitle).prepend('<div class="col-xs-12 p-b-10"><input type="hidden" class="pagenum" value="'+item.page+'" /><input type="hidden" class="total-page" value="'+pages+'" /></div>');
                    }

                    if (item.s == 1) {

                    }

                    if (item.s == 2) {
                        //$("#chatbox_"+chatboxtitle).prepend('<div class="col-xs-12 p-b-10"><div class="conversation-start"><span>'+item.m+'</span></div></div>');
                    } else
                    {

                        var message_content = item.m;

                        if (msgtype=="text")
                            message_content = item.m;
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


                        if (msgtype=="text"){



                            /*message_content = message_content.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");

                             var $con = message_content;
                             var $words = $con.split(' ');
                             for (i in $words) {
                             if ($words[i].indexOf('http://') == 0 || $words[i].indexOf('https://') == 0) {
                             $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                             }
                             else if ($words[i].indexOf('www') == 0 ) {
                             $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                             }
                             }
                             message_content = $words.join(' ');*/


                            message_content = emojione.shortnameToImage(message_content);


                        }

                        if (item.u == 2) {
                            $("#chatbox_"+chatboxtitle).prepend('<div class="col-xs-12 p-b-10"><div class="chat-image  profile-picture max-profile-picture"> <img alt="'+item.sender+'" src="'+siteurl+'storage/profile/'+img+'" class="bg-theme"> </div><div class="chat-body"><div class="chat-text"><h4>'+item.sender+'</h4><p>'+message_content+'</p><b>'+item.time+'</b> </div></div></div>');
                        } else
                        {
                            if(seen == 1){
                                var seentpl = '<span class="msg-status msg-'+chatboxtitle+'"><i class="fa fa-check-circle"></i> R</span>';
                            }
                            else{
                                var seentpl = '<span class="msg-status msg-'+chatboxtitle+'"><i class="fa fa-check"></i></span>';
                            }
                            $("#chatbox_"+chatboxtitle).prepend('<div class="col-xs-12 p-b-10 odd">' +
                            '<div class="chat-image  profile-picture max-profile-picture">' +
                            '<img alt="'+item.sender+'" src="'+siteurl+'storage/profile/'+img+'">' +
                            '</div>' +
                            '<div class="chat-body">' +
                            '<div class="chat-text">' +
                            '<h4>'+item.sender+'</h4><p>'+message_content+'</p>' +
                            '<b>'+item.time+'</b>'+seentpl+'</div></div></div>');
                        }
                    }

                }
                if (page == 1) {
                    scrollDown();
                }

            });
        },
        error: function(xhr, textStatus, errorThrown){
            /*var errortpl = '<div class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: block; padding-right: 17px;">' +
             '<div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header">  ' +
             '<h4 class="modal-title" id="mySmallModalLabel">Error</h4> </div> ' +
             '<div class="modal-body">'+textStatus+' : (Network Connection Error.)</div>' +
             '<div class="modal-footer"> <button type="button" class="btn btn-info waves-effect" id="refreshPage">Refresh</button> </div> </div> </div> </div>';
             $("#get-error").html(errortpl);
             $('#showErrorModal').trigger('click');
             clearTimeout(intervalChatHeart);*/
        }
    });

}

function startChatSession(){

    $.ajax({
        url: siteurl+plugin_directory+"?action=startchatsession",
        cache: false,
        dataType: "json",
        success: function(data) {

            username = data.username;
            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    chatboxtitle = item.f;
                    toid = item.x;
                    img = item.p2;
                    status = item.st;

                    if ($("#chatbox_"+chatboxtitle).length <= 0) {

                        //createChatBox(chatboxtitle,toid,img,status,1);
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    if (item.s == 2) {

                        //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
                    } else {

                        if (item.u == 2) {

                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+item.f+'</span></div><img class="direct-chat-img" src="'storage/profile/'+item.p+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        } else {

                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+item.f+'</span></div><img class="direct-chat-img" src="storage/profile/'+img+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        }
                    }
                }
            });


        }});

    intervalChatHeart = setInterval('chatHeartbeat("null");',chatHeartbeatTime);
    scrollDown();
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle,toid,img,send) {

    $(".input-placeholder").css({'visibility':'hidden'});

    if((event.keyCode == 13 && event.shiftKey == 0) || (send == 1))  {
        message = $(chatboxtextarea).val();
        message = message.replace(/^\s+|\s+$/g,"");

        $(chatboxtextarea).val('');
        $(chatboxtextarea).focus();
        $(".input-placeholder").css({'visibility':'visible'});
        $(".chatboxtextarea").css('height','20px');
        if (message != '') {
            $.post(siteurl+plugin_directory+"?action=sendchat", {to: chatboxtitle, toid: toid, message: message} , function(data){
                message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
                message = message.replace(/\n/g, "<br />");
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
                $("#chatbox_"+chatboxtitle).append('<div class="col-xs-12 p-b-10 odd">' +
                '<div class="chat-image  profile-picture max-profile-picture">' +
                '<img alt="'+username+'" src="'+siteurl+'storage/profile/small_'+img+'">' +
                '</div>' +
                '<div class="chat-body">' +
                '<div class="chat-text">' +
                '<h4>'+username+'</h4>' +
                '<p>'+message+'</p>' +
                '<b>'+LANG_JUST_NOW+'</b><span class="msg-status msg-'+chatboxtitle+'"><i class="fa fa-clock-o"></i></span>' +
                '</div>' +
                '</div>' +
                '</div>');

                $(".target-emoji").css({'display':'none'});
                $('.wchat-filler').css({'height':0+'px'});

                if(data == '1'){
                    $("#chatbox_"+chatboxtitle+" .msg-"+chatboxtitle).html('<i class="fa fa-check"></i>');
                }else{
                    $("#chatbox_"+chatboxtitle+" .msg-"+chatboxtitle).html('<i class="fa fa-exclamation-circle"></i> Error');
                }

                msgid = data;
                /*clearTimeout(chkSeenInterval);
                 chkSeenInterval = setTimeout('checkMsgSeen(msgid,chatboxtitle);',2000);*/
                scrollDown();
            });
            chatfrindList();
        }
        chatHeartbeatTime = minChatHeartbeat;
        chatHeartbeatCount = 1;

        return false;
    }

    var adjustedHeight = chatboxtextarea.clientHeight;
    var maxHeight = 60;

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

function clickTosendMessage(chatboxtitle,toid,img) {

    message = $(".chatboxtextarea").val();

    message = message.replace(/^\s+|\s+$/g,"");

    $(".chatboxtextarea").val('');
    $(".chatboxtextarea").focus();
    $(".input-placeholder").css({'visibility':'visible'});
    $(".chatboxtextarea").css('height','20px');
    if (message != '') {

        $.post(siteurl+plugin_directory+"?action=sendchat", {to: chatboxtitle, toid: toid, message: message} , function(data){

            message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
            message = message.replace(/\n/g, "<br />");
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
            message = emojione.shortnameToImage(message);  // Set imotions

            $("#chatbox_"+chatboxtitle).append('<div class="col-xs-12 p-b-10 odd">' +
            '<div class="chat-image  profile-picture max-profile-picture">' +
            '<img alt="'+username+'" src="'+siteurl+'storage/profile/small_'+img+'">' +
            '</div>' +
            '<div class="chat-body">' +
            '<div class="chat-text">' +
            '<h4>'+username+'</h4>' +
            '<p>'+message+'</p>' +
            '<b>'+LANG_JUST_NOW+'</b><span class="msg-status msg-'+chatboxtitle+'"><i class="fa fa-check"></i></span>' +
            '</div>' +
            '</div>' +
            '</div>');

            $(".target-emoji").css({'display':'none'});
            $('.wchat-filler').css({'height':0+'px'});

            msgid = data;
            /*clearTimeout(chkSeenInterval);
             chkSeenInterval = setTimeout('checkMsgSeen(msgid,chatboxtitle);',3000);*/
            scrollDown();
        });
        chatfrindList();
    }
    chatHeartbeatTime = minChatHeartbeat;
    chatHeartbeatCount = 1;




    var adjustedHeight = $(".chatboxtextarea").clientHeight;
    var maxHeight = 40;

    if (maxHeight > adjustedHeight) {
        adjustedHeight = Math.max($(".chatboxtextarea").scrollHeight, adjustedHeight);
        if (maxHeight)
            adjustedHeight = Math.min(maxHeight, adjustedHeight);
        if (adjustedHeight > $(".chatboxtextarea").clientHeight)
            $($(".chatboxtextarea")).css('height',adjustedHeight+8 +'px');
    } else {
        $($(".chatboxtextarea")).css('overflow','auto');
    }
    return false;
}

function chatHeartbeat(TOusername){

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
                //FIX ME: add toggle all or none policy, otherwise it looks funny

                $('#chatbox1_'+x+'.chatboxhead').toggleClass('chatboxblink');
                //$('#chatbox1_'+x+'.chatboxhead').removeClass('chatboxblink');

            }
        }
        /*else {
         for (x in newMessages) {
         newMessages[x] = false;
         }
         }*/
    }


    $.ajax({
        url: siteurl+plugin_directory+"?action=chatheartbeat&fromuname="+TOusername,
        cache: false,
        dataType: "json",
        success: function(data) {

            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    if(item.isTyping == 1){
                        fromUtyp = item.fromUtyp;
                        fromIDtyp = item.fromIDtyp;
                        $('header[data-user="'+fromUtyp+'"] #typing_on').html('is typing...');
                        itemsfound += 1;
                    }
                    else{
                        fromUtyp = item.fromUtyp;
                        fromIDtyp = item.fromIDtyp;
                        $('header[data-user="'+fromUtyp+'"] #typing_on').html(item.lastseen);
                    }

                    if(typeof item.f != "undefined")
                    {
                        chatboxtitle = item.f;
                        toid = item.x;
                        img = item.p2;
                        fromPic = item.p;
                        status = item.st;
                        msgtype = item.mtype;

                        var cLenth = 1;
                        if ($("#chatbox_" + chatboxtitle).length <= 0) {

                            createChatBox(chatboxtitle, toid, img, status, '1');
                            cLenth = 0;
                            if (eval(localStorage.sound)) {
                                audiomp3.play();
                                audioogg.play();
                            }
                        }
                        if ($("#chatbox_" + chatboxtitle).css('display') == 'none') {
                            //$("#chatbox_"+chatboxtitle).css('display','block');
                            //restructureChatBoxes();
                        }

                        if (item.s == 1) {
                            item.f = username;
                        }

                        var message_content = item.m;

                        if (msgtype == "text")
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
                            //$("#chatbox_"+chatboxtitle).append('<div class="col-xs-12 p-b-10 odd"><div class="conversation-start"><span>'+item.m+'</span></div></div>');
                        } else if(cLenth != 0)
                        {
                            if (msgtype == "text") {
                                message_content = emojione.shortnameToImage(message_content);  // Set imotions
                            }

                            newMessages[chatboxtitle] = true;
                            newMessagesWin[chatboxtitle] = true;

                            $("#chatbox_" + chatboxtitle).append('<div class="col-xs-12 p-b-10">' +
                            '<div class="chat-image  profile-picture max-profile-picture">' +
                            '<img alt="' + chatboxtitle + '" src="' + siteurl + 'storage/profile/' + fromPic + '" class="bg-theme">' +
                            '</div>' +
                            '<div class="chat-body">' +
                            '<div class="chat-text">' +
                            '<h4>' + chatboxtitle + '</h4>' +
                            '<p>' + message_content + '</p><b>' + item.time + '</b> </div></div></div>');

                            if (eval(localStorage.sound)) {
                                audiomp3.play();
                                audioogg.play();

                                $("#MobileChromeplaysound").trigger('click');
                            }

                            $("#chatForm_" + chatboxtitle + " .chatboxtextarea").focus(function () {
                                updateSeenmsg(chatboxtitle);
                            });

                        }

                        chatfrindList();
                        $("#chatbox_"+chatboxtitle+" .msg-"+chatboxtitle).html('<i class="fa fa-check-circle"></i> R');
                        //$("#chatbox_"+chatboxtitle).scrollTop($("#chatbox_"+chatboxtitle)[0].scrollHeight);
                        scrollDown();
                        itemsfound += 1;
                    }

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

            clearTimeout(intervalChatHeart);
            intervalChatHeart = setInterval('chatHeartbeat(TOusername);',chatHeartbeatTime);
            //setTimeout('chatHeartbeat();',chatHeartbeatTime);
        },
        error: function(xhr, textStatus, errorThrown){
            /*var errortpl = '<div class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: block; padding-right: 17px;">' +
             '<div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header">  ' +
             '<h4 class="modal-title" id="mySmallModalLabel">Error</h4> </div> ' +
             '<div class="modal-body">'+textStatus+' : (Network Connection Error.)</div>' +
             '<div class="modal-footer"> <button type="button" class="btn btn-info waves-effect" id="refreshPage">Refresh</button> </div> </div> </div> </div>';
             $("#get-error").html(errortpl);
             $('#showErrorModal').trigger('click');
             clearTimeout(intervalChatHeart);*/
        }
    });
}

function chatfrindList(){
    $.ajax({
        url: siteurl + plugin_directory+"?action=chatfrindList",
        cache: false,
        type: "POST",
        success: function (data) {
            $(".chat-left-inner .chatonline").html(data);

            $('.left .person').mousedown(function(){
                if ($(this).hasClass('.active')) {
                    $(".chat-left-aside").toggleClass("open-pnl");
                    $(".open-panel i").toggleClass("ti-angle-left");
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

                    $(".chat-left-aside").toggleClass("open-pnl");
                    $(".open-panel i").toggleClass("ti-angle-left");
                }
            });
        },
        error: function( error )
        {
            //alert( error );
        }
    });
}

function checkMsgSeen(id,chatuser){
    $.ajax({
        url: siteurl + plugin_directory+"?action=checkMsgSeen&msgid="+id+"&uname="+chatuser,
        cache: false,
        type: "POST",
        success: function (data) {
            if(data == 1)
            {
                $("#chatbox_"+chatuser+" .msg-"+chatuser).html('<i class="fa fa-check-circle"></i> R');
                clearTimeout(chkSeenInterval);
            }
        },
        error: function( error )
        {
            //alert( error );
        }
    });
}

function userProfile(username){
    $.ajax({
        url: siteurl + plugin_directory+"?action=userProfile&uname="+username,
        cache: false,
        type: "POST",
        success: function (data) {
            $("#userProfile").html(data);
        },
        error: function( error )
        {
            //alert( error );
        }
    });

}

function lastseen(username){
    $.ajax({
        url: siteurl + plugin_directory+"?action=lastseen&uname="+username,
        cache: false,
        type: "POST",
        success: function (data) {
            $(".wchat-header .chat-status").html(data);
            //alert(data);
        },
        error: function( error )
        {
            //alert( error );
        }
    });
}

function savechat(mail){
    var username = $('.chat.active-chat').attr('client');
    var mail = typeof mail != "undefined" ? mail : false;
    $.ajax({
        url: siteurl + plugin_directory+"?action=savechat&uname="+username+"&mail="+mail,
        cache: false,
        type: "POST",
        success: function (data) {
            if(mail == false){
                window.location = 'savechat.php?content='+data.toString()+'&uname='+username;
            }
            else{
                alert(data);
            }
        },
        error: function( error )
        {
            //alert( error );
        }
    });
}

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

$(document).ready(function(){

    $('.search_bg').on('keyup', function(){

        //clearTimeout(add);
        var searchbox = $(this).val();

        var dataString = 'searchword1='+ searchbox;

        if(searchbox == '')
        {
            $("#display").css('display','block');

            $("#display").html("<div class='cssload-speeding-wheel' style='margin-top: 100px;'></div>");
            //start();
            chatfrindList();
        }
        else
        {
            $("#display").css('display','block');
            $.ajax({
                type: "POST",
                url: siteurl+plugin_directory+"?action=searchUser",
                data: dataString,
                cache: false,
                success: function(data)
                {

                    //clearTimeout(refreshIntervalId);
                    $("#display").html(data);

                    $('.left .person').mousedown(function(){
                        if ($(this).hasClass('.active')) {
                            $(".chat-left-aside").toggleClass("open-pnl");
                            $(".open-panel i").toggleClass("ti-angle-left");
                            return false;
                        } else {
                            var findChat = $(this).attr('data-chat');
                            var personName = $(this).find('.personName').text();
                            $('.right .top .personName').html(personName);
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

                            $(".chat-left-aside").toggleClass("open-pnl");
                            $(".open-panel i").toggleClass("ti-angle-left");
                        }
                    });

                }
            });
        }return false;
    });
});



var typingStatus = $('#typing_on');
var lastTypedTime = new Date(0); // it's 01/01/1970, actually some time in the past
var typingDelayMillis = 5000; // how long user can "think about his spelling" before we show "No one is typing -blank space." message
var dataSendDelay = 2500;
var lastDataSentTime = new Date(0);

function refreshTypingStatus(chatboxtitle,toid) {

    updateLastTypedTime();
    if (new Date().getTime() - lastTypedTime.getTime() > typingDelayMillis) {
        //typingStatus.html('No one is typing -blank space.');
    } else {
        if (new Date().getTime() - lastDataSentTime.getTime() > dataSendDelay) {
            $.post(siteurl+"chat.php?action=typingstatus", {toUname: chatboxtitle, toid: toid, typing: 1} , function(data){
                if(data){
                    //typingStatus.html('User is typing...2');
                }
            });
            lastDataSentTime = new Date();
        }

    }

}
function updateLastTypedTime() {
    lastTypedTime = new Date();
}


//Uploading Image And files
// Initialize the widget when the DOM is ready
$(".uploadFile").click(function(){

    $(function() {
        var touname = $('.chat.active-chat').attr('client');

        $("#uploader").plupload({
            // General settings
            runtimes : 'html5,flash,silverlight,html4',
            url: siteurl+"php/upload-chat-file.php?tun="+touname,

            // User can upload no more then 20 files in one go (sets multiple_queues to false)
            max_file_count: 10,

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
                max_file_size : '10mb',
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
            flash_swf_url : 'plugins/uploader/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url : 'plugins/uploader/Moxie.xap',

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

        $('#close_uploadFile').click(function(){
            $('#uploader').plupload('destroy');
            $('#uploader').css({'display':'none'});
            //console.clear();
        });
        $('#uploader').on('complete', function() {
            $('#uploader').plupload('destroy');
            $('#uploader').css({'display':'none'});
            //console.clear();
        });
    });
    $('#uploader').css({'display':'block'});
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
                            var message_content = "<a url='"+file_path+"' onclick='trigq(this)' style='cursor: pointer;'>" +
                                "<img src='"+file_path+"' class='userfiles'/></a>";
                        }
                        else if(file_type == "video"){
                            message_content = '<video class="userfiles" controls>' +
                            '<source src="'+file_path+'" type="video/mp4">'+
                            'Your browser does not support HTML5 video.'+
                            '</video>';
                            // message_content = "<a href='"+fileUPath+getfilename+"' class='download-link'></a>";
                        }
                        else{
                            message_content = "<a href='"+file_path+"' class='download-link' download></a>";
                        }
                        $("#chatbox_"+toName).append('<div class="col-xs-12 p-b-10 odd">' +
                        '<div class="chat-image">' +
                        '<img alt="male" src="'+siteurl+'storage/profile/'+picname+'">' +
                        '</div>' +
                        '<div class="chat-body">' +
                        '<div class="chat-text">' +
                        '<h4>'+username+'</h4>' +
                        '<p>'+message_content+'</p>' +
                        '<b>'+LANG_JUST_NOW+'</b><span class="msg-status msg-'+toName+'"><i class="fa fa-check"></i></span>' +
                        '</div>' +
                        '</div>' +
                        '</div>');

                        /*clearTimeout(chkSeenInterval);
                         chkSeenInterval = setTimeout('checkMsgSeen('+id+',"'+toName+'");',3000);*/

                    }
                }
            });
        } else {

        }
    });
}