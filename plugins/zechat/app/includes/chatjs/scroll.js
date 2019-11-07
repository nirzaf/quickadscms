$("#resultchat").scrollTop($("#resultchat")[0].scrollHeight);

    // Assign scroll function to chatBox DIV
    $("#resultchat").scroll(function(){
        if ($("#resultchat").scrollTop() == 0){
           
            var client = $(".chatbox.active-chat").attr("client");
			
			alert(client);
			
            if($("#chatbox_"+client+" .pagenum:first").val() != $("#chatbox_"+client+" .total-page").val()) {

                $("#loader").show();
                var pagenum = parseInt($("#chatbox_"+client+" .pagenum:first").val()) + 1;

                var URL = siteurl+"chat.php?page="+pagenum+"&action=get_all_msg&client="+client;

                get_all_msg(URL);

                $("#loader").hide();									// Hide loader on success

                if(pagenum != $("#chatbox_"+client+" .total-page").val()) {
                    setTimeout(function () {										//Simulate server delay;

                       $("#resultchat").scrollTop(100);							// Reset scroll
                    }, 458);
                }
            }

        }
    });