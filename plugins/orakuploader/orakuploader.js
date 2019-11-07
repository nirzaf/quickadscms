(function ( $ ) {

    $.fn.orakuploader = function( options ) {

        var settings = $.extend({
            site_url                         :  '',
            orakuploader       		    	 : true,
            orakuploader_use_main          	 : false,
            orakuploader_use_sortable      	 : false,
            orakuploader_use_dragndrop       : false,
            orakuploader_use_rotation        : false,
            orakuploader_hide_on_exceed      : false,
            orakuploader_hide_in_progress    : false,
            orakuploader_attach_images       : [],
            orakuploader_path  		         : 'orakuploader/',
            orakuploader_main_path           : 'files',
            orakuploader_thumbnail_path      : 'files/tn',
            orakuploader_resize_to           : 0,
            orakuploader_thumbnail_size      : 0,
            orakuploader_file_delete_label 	 : "",
            orakuploader_file_rotation_label : "",
            orakuploader_field_name          : $(this).attr('id'),
            orakuploader_add_image           : '',
            orakuploader_add_label           : 'Browser for images',
            orakuploader_main_changed        : "",
            orakuploader_finished		     : "",
            orakuploader_picture_deleted     : "",
            orakuploader_maximum_uploads     : 100,
            orakuploader_crop_to_width       : 0,
            orakuploader_crop_to_height      : 0,
            orakuploader_crop_thumb_to_width : 0,
            orakuploader_crop_thumb_to_height: 0,
            orakuploader_max_exceeded 	     : "",
            orakuploader_watermark           : ""

        }, options);

        var holdername = this;

        if($(this).attr('orakuploader') == 'on') {
            var imageHolderId = '#'+$(this).attr('id');
            holdername = $(this).replaceWith(getHtml($(this).attr('id'), settings.orakuploader_add_image, settings.orakuploader_add_label, settings.orakuploader_path,settings.site_url));
            holdername = $("body").find(imageHolderId);
        }

        jQuery.data(holdername, 'already_uploaded', 1);
        jQuery.data(holdername, 'count', 0);
        jQuery.data(holdername, 'counter', 0);

        if(settings.orakuploader_use_sortable)
        {
            $(holdername).sortable({
                update: function(event, ui) {

                    if (typeof settings.orakuploader_rearranged == 'function') {
                        settings.orakuploader_rearranged();
                    }
                    changeMain(holdername, settings);
                }
            });

            $("#"+holdername.attr("id")+"_to_clone").find(".file").css("cursor", "move");
            $("#"+holdername.attr("id")+"_to_clone").find(".multibox .file").css("cursor", "move");
        }
        else
        {
            $("#"+holdername.attr("id")+"_to_clone").find(".file").css("cursor", "auto");
            $("#"+holdername.attr("id")+"_to_clone").find(".multibox .file").css("cursor", "auto");
        }
        $(holdername).disableSelection();

        $(document).on("change", "."+$(holdername).attr("id")+"Input", function() {
            if(settings.orakuploader_hide_in_progress == true) {
                if(parseInt(jQuery.data(holdername, 'currently_uploading')) == 1) return false;
                jQuery.data(holdername, 'currently_uploading', 1);
                $(holdername).parent().find('.uploadButton').hide();
            }
            jQuery.data(holdername, 'count', 0);
            orakuploaderHandle(this.files,holdername,settings);
        });


        for (i = 0; i < settings.orakuploader_attach_images.length; i++) {
            var image = settings.orakuploader_attach_images[i];

            var clone = $("#"+$(holdername).attr("id")+"_to_clone").find(".multibox").clone();
            $(holdername).append($(clone));
            $(clone).html("<div class='picture_delete'>"+settings.orakuploader_file_delete_label+"</div><img src='"+settings.site_url+settings.orakuploader_thumbnail_path+"/"+image+"' alt='' onerror=this.src='"+settings.site_url+settings.orakuploader_path+"/images/no-image.jpg' class='picture_uploaded'/> <input type='hidden' value='"+image+"' name='"+settings.orakuploader_field_name+"[]' />");
            $(clone).attr('id', image);
            $(clone).attr('filename', image);
        }

        if(settings.orakuploader_attach_images.length > 0) {
            changeMain(holdername, settings);
        }

        $(holdername).on("click", ".picture_delete", function() {

            jQuery.data(holdername, "already_uploaded", jQuery.data(holdername, "already_uploaded")-1);

            $.ajax({
                url: settings.site_url+settings.orakuploader_path+"orakuploader.php?delete="+encodeURIComponent($(this).parent().attr('filename'))+"&path="+settings.orakuploader_path+"&resize_to="+settings.orakuploader_resize_to+"&thumbnail_size="+settings.orakuploader_thumbnail_size+"&main_path="+settings.orakuploader_main_path+"&thumbnail_path="+settings.orakuploader_thumbnail_path
            });

            $(this).parent().fadeOut("slow", function() {
                $(this).remove();

                if(jQuery.data(holdername, "already_uploaded")-1 > 0) {
                    changeMain(holdername, settings);
                }

                if(settings.orakuploader_hide_on_exceed == true) {
                    $(holdername).parent().find('.uploadButton').show();
                }
            });

            if (typeof settings.orakuploader_picture_deleted == 'function') {
                settings.orakuploader_picture_deleted($(this).parent().attr('filename'));
            }
        });

        $(holdername).on("click", ".rotate_picture", function() {
            var context = this;

            $.ajax({
                url: settings.site_url+settings.orakuploader_path+"orakuploader.php?rotate="+encodeURIComponent($(this).parent().attr('filename'))+"&degree_lvl="+$(this).closest('.rotate_picture').attr('degree-lvl')+"&path="+settings.orakuploader_path+"&resize_to="+settings.orakuploader_resize_to+"&thumbnail_size="+settings.orakuploader_thumbnail_size+"&main_path="+settings.orakuploader_main_path+"&thumbnail_path="+settings.orakuploader_thumbnail_path
            }).done(function(file_name) {
                $img = $('html,body').find("input[value^='"+file_name+"']").prev('img');

                if(parseInt($(context).closest('.rotate_picture').attr('degree-lvl')) > 3)  {
                    $(context).closest('.rotate_picture').attr('degree-lvl', 1)
                } else {
                    $(context).closest('.rotate_picture').attr('degree-lvl', parseInt($(context).closest('.rotate_picture').attr('degree-lvl'))+1)
                }

                $img.attr('src', $img.attr('src') +"?"+ new Date().getTime());
            });
        });

        if(settings.orakuploader_use_dragndrop)
        {
            var holder = document.getElementById($(holdername).attr("id")+"DDArea");
            holder.ondragover = function () { $(".uploadButton").addClass("DragAndDropHover"); return false; };
            holder.ondragend  = function () { $(".uploadButton").removeClass("DragAndDropHover"); return false; };

            holder.ondrop = function (e) {
                $(".uploadButton").removeClass("DragAndDropHover");
                e.preventDefault();
                orakuploaderHandle(e.dataTransfer.files,holdername,settings);
            }
        }

    };

    function changeMain(holder, settings) {
        if(settings.orakuploader_use_main)
        {
            $(holder).find(".multibox").removeClass("main");
            $(holder).find(".multibox").first().addClass("main");

            if (typeof settings.orakuploader_main_changed == 'function') {
                settings.orakuploader_main_changed($(holder).find(".multibox").first().attr('filename'));
            }
        }
    }

    function orakuploaderHandle(files,holder,settings) {
        var i = 0;
        var msg_alert = false;
        for(i=0;i<files.length;i++)
        {
            if(jQuery.data(holder, "already_uploaded") > settings.orakuploader_maximum_uploads && (typeof settings.orakuploader_max_exceeded == 'function')) {
                if(msg_alert == false) settings.orakuploader_max_exceeded();
                    msg_alert = true;
                if(settings.orakuploader_hide_on_exceed == true) $(holder).closest('.uploadButton').hide();
            }
            var re = /(?:\.([^.]+))?$/;
            var ext = re.exec(files[i].name)[1].toLowerCase();

            if((ext == 'jpg' || ext == 'jpeg' || ext == 'png') &&  jQuery.data(holder, "already_uploaded") <= settings.orakuploader_maximum_uploads)
            {
                var clone = $("#"+$(holder).attr("id")+"_to_clone").find(".multibox").clone();

                $(holder).append($(clone));
                upload(files[i], clone, i, holder, settings);
                jQuery.data(holder, "already_uploaded", jQuery.data(holder, "already_uploaded")+1);
                jQuery.data(holder, "count", jQuery.data(holder, "count")+1);
            }
        }
    }

    window.counter = 0;
    function upload(file, clone, place, holder, settings)
    {
        if(settings.orakuploader_hide_on_exceed == true && parseInt(jQuery.data(holder, 'already_uploaded')) == parseInt(settings.orakuploader_maximum_uploads)) {
            $(holder).parent().find('.uploadButton').hide();
        }
        var xhr = new XMLHttpRequest();
        xhr.open("POST", settings.site_url+settings.orakuploader_path+"orakuploader.php?filename="+encodeURIComponent(file.name)+"&path="+encodeURIComponent(settings.orakuploader_path)+"&resize_to="+settings.orakuploader_resize_to+"&thumbnail_size="+settings.orakuploader_thumbnail_size+"&main_path="+encodeURIComponent(settings.orakuploader_main_path)+"&thumbnail_path="+encodeURIComponent(settings.orakuploader_thumbnail_path)+"&watermark="+encodeURIComponent(settings.orakuploader_watermark)+"&orakuploader_crop_to_width="+settings.orakuploader_crop_to_width+"&orakuploader_crop_to_height="+settings.orakuploader_crop_to_height+"&orakuploader_crop_thumb_to_width="+settings.orakuploader_crop_thumb_to_width+"&orakuploader_crop_thumb_to_height="+settings.orakuploader_crop_thumb_to_height, true);
        xhr.setRequestHeader('Content-Type', 'text/plain; charset="utf-8"');
        xhr.send(file);
        xhr.onreadystatechange = function()
        {
            var rotation_html = "";
            if (xhr.readyState == 4)
            {
                if(settings.orakuploader_use_rotation == true) {
                    rotation_html = "<div class='rotate_picture' degree-lvl='1'>"+settings.orakuploader_file_rotation_label+"</div>";
                }
                $(clone).html("<div class='picture_delete'>"+settings.orakuploader_file_delete_label+"</div>"+rotation_html+"<img src='"+settings.site_url+settings.orakuploader_thumbnail_path+"/"+xhr.responseText+"' alt='' onerror=this.src='"+settings.site_url+settings.orakuploader_path+"/images/no-image.jpg' class='picture_uploaded'/> <input type='hidden' value='"+xhr.responseText+"' name='"+settings.orakuploader_field_name+"[]' />");
                $(clone).attr('id', xhr.responseText);
                $(clone).attr('filename', xhr.responseText);
                jQuery.data(holder, "counter", jQuery.data(holder, "counter")+1);
                if(jQuery.data(holder, "count") == jQuery.data(holder, "counter"))
                {
                    if (typeof settings.orakuploader_finished == 'function') {
                        settings.orakuploader_finished();
                    }
                    changeMain(holder, settings);
                    jQuery.data(holder, "counter", 0);
                    if(settings.orakuploader_hide_in_progress == true) {
                        jQuery.data(holder, 'currently_uploading', 0);
                        $(holder).parent().find('.uploadButton').show();
                    }
                }
            }
        }
    }

}( jQuery ));

window.initialized = 0;

function orakuploaderLoad(name) {
    $('.'+(name)+'Input').click();
    window.initialized++;
}

function getHtml(name, add_image, add_label, path,site_url)
{
    return '<div id="'+name+'_to_clone" class="clone_item"><div class="multibox file"><div class="loading"><img src="'+site_url+path+'/images/loader.gif" alt="loader"/></div></div></div>\
		<div id="'+name+'DDArea">\
			<div id="'+name+'">\
			</div>\
			<div class="multibox uploadButton" onclick="javascript:orakuploaderLoad(\''+name+'\');">\
			<img src="'+add_image+'"/>\
			<br/><br/>'+add_label+'\
			</div>\
			<input type="file" class="'+name+'Input orakuploaderFileInput" accept="image/*" multiple/>\
			<div class="clear"> </div>\
		</div>';

}