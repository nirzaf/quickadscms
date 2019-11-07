(function ($) {

  jQuery.fn.reviews = function (e_review) {

    /* Save the product ID */
    var pid = $("#review-productId").text();

    /* Get and show the average rating for the product */
    $.get(siteurl+"plugins/starreviews/current.php?show=average&productid=" + pid + "", function ( data ) {
      $("" + e_review + " .average-rating").html(data);
        ratingPassive(".average-rating");
    });

    /* Get and show the current reviews for the product */
    $.get(siteurl+"plugins/starreviews/current.php?productid=" + pid + "", function ( data ) {
      $("" + e_review + " .show-reviews").html(data);
        ratingPassive(".show-reviews");
        bgTransfer();
    });

      /* Insert the HTML review form */
      $("" + e_review + " .add-review").append('<form class="form-add-review" role="form" id="form-add-review" class="form-add-review" ><h2>'+LANG_ADDREVIEWS+'</h2><div class="form-group select rating-new"><label for="example-f">'+LANG_HOW_WOULD_RATE+'</label><select id="rating-new" name="rating-new"><option value="1">1 '+LANG_STAR+'</option><option value="2">2 '+LANG_STAR+'</option><option value="3">3 '+LANG_STAR+'</option><option value="4">4 '+LANG_STAR+'</option><option value="5">5 '+LANG_STAR+'</option></select></div><div class="form-group"><label for="review"><span class="mandatory">*</span> '+LANG_REVIEWS+'</label><div><textarea name="comments" id="comments" class="form-control review-comments" placeholder="'+LANG_YOURREVIEWS+'" rows="3" data-validation="required"  data-validation-error-msg="'+LANG_ENTER_REVIEW+'"></textarea></div></div><div class="form-group"><div><button type="submit" class="btn btn-primary" id="submit_review">'+LANG_SUBMITREVIEWS+'</button></div></div></form><div class="notice"></div>');



    /* Load the rating stars using the barrating jquery plugin */
    $("" + e_review + " #rating-new").barrating({
      showSelectedRating:true
    });

    /* Validate and process the rating & review form */
    $.validate({
      modules : 'security',
      form : '#form-add-review',
      onSuccess : function () { // If validation is valid we process the form
        var rating = $("" + e_review + " #rating-new").val();
        var message = $("" + e_review + " #comments").val();
        var dataString = '&message=' + message + '&rating=' + rating;
          $('#submit_review').addClass('bookme-progress');
        /* Make ajax call to our PHP file to save the review & rating */
        $.ajax({

          type : "POST",
          url : siteurl+"plugins/starreviews/save-rating.php?productid=" + pid + "", // our php file for saving the review
          data : dataString,
          cache : false,
          success : function (data) {
            $('#submit_review').removeClass('bookme-progress');
            $("" + e_review + " .add-review #form-add-review").fadeOut(600);
            $("" + e_review + " .add-review .notice").append(data).fadeIn(1500);
          }

        });

        return false;

      }
    });

  }

})(jQuery);

function bgTransfer() {
    //disable-on-mobile

    $(".bg-transfer").each(function () {
        $(this).css("background-image", "url(" + $(this).find("img").attr("src") + ")");
    });
}

function ratingPassive(element){
    $(element).find(".rating-passive").each(function() {
        for( var i = 0; i <  5; i++ ){
            if( i < $(this).attr("data-rating") ){
                $(this).find(".stars").append("<figure class='active fa fa-star'></figure>")
            }
            else {
                $(this).find(".stars").append("<figure class='fa fa-star'></figure>")
            }
        }
    });
}