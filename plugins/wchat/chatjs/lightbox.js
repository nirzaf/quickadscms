$(document).ready(function() {
    //Click anywhere on the page to get rid of lightbox window
    $('#lightbox').click(function() { //must use live, as the lightbox element is inserted into the DOM
        $('#lightbox').hide();
    });

});


function trigq(event) {

    var image_href = $(event).attr("url");

    if ($('#lightbox').length > 0) { // #lightbox exists

        //place href as img src value
        $('#content').html('<img src="' + image_href + '" />');

        //show lightbox window - you could use .show('fast') for a transition
        $('#lightbox').show();
    }

    else { //#lightbox does not exist - create and insert (runs 1st time only)

        //create HTML markup for lightbox window
        var lightbox =
            '<div id="lightbox">' +
            '<p>Click to close</p>' +
            '<div id="content">' + //insert clicked link's href into img src
            '<img src="' + image_href +'" />' +
            '</div>' +
            '</div>';

        //insert lightbox HTML into page
        $('body').append(lightbox);
    }
}

/*if ($('#lightbox').length > 0) { // #lightbox exists

    //insert img tag with clicked link's href as src value
    $('#content').html('<img src="' + image_href + '" />');

    //show lightbox window - you can use a transition here if you want, i.e. .show('fast')
    $('#lightbox').show();
}
else { //#lightbox does not exist

    //create HTML markup for lightbox window
    var lightbox =
        '<div id="lightbox">' +
        '<p>Click to close</p>' +
        '<div id="content">' + //insert clicked link's href into img src
        '<img src="' + image_href +'" />' +
        '</div>' +
        '</div>';

    //insert lightbox HTML into page
    $('body').append(lightbox);
}*/

/*$('#lightbox').live('click', function() {
    $('#lightbox').hide();
});*/


