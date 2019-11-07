(function ($) {

  jQuery.fn.reviews = function (e_review) {

    /* Save the product ID */
    var pid = $("#review-productId").text();

    /* Get and show the average rating for the product */
    $.get(siteurl+"plugins/starreviews/current.php?show=average&productid=" + pid + "", function ( data ) {
      $("" + e_review + " .average-rating").append(data);
    });

    /* Get and show the current reviews for the product */
    $.get(siteurl+"plugins/starreviews/current.php?productid=" + pid + "", function ( data ) {
      $("" + e_review + " .show-reviews").append(data);
    });

      /* Insert the HTML review form */
      $("" + e_review + " .add-review").append('<form class="form-add-review" role="form" id="form-add-review" class="form-add-review" ><h2>Add your review</h2><div class="form-group select rating-new"><label for="example-f">How would you rate this product?</label><select id="rating-new" name="rating-new"><option value="1">1 Star</option><option value="2">2 Stars</option><option value="3">3 Stars</option><option value="4">4 Stars</option><option value="5">5 Stars</option></select></div><div class="form-group"><label for="review"><span class="mandatory">*</span> Review</label><div><textarea name="comments" id="comments" class="form-control review-comments" placeholder="Your review" rows="3" data-validation="required"  data-validation-error-msg="Please enter your review."></textarea></div></div><div class="form-group"><div><button type="submit" class="btn btn-primary">Submit review</button></div></div></form><div class="notice"></div>');



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

        /* Make ajax call to our PHP file to save the review & rating */
        $.ajax({

          type : "POST",
          url : siteurl+"plugins/starreviews/save-rating.php?productid=" + pid + "", // our php file for saving the review
          data : dataString,
          cache : false,
          success : function (data) {
            $("" + e_review + " .add-review #form-add-review").fadeOut(600);
            $("" + e_review + " .add-review .notice").append(data).fadeIn(1500);
          }

        });

        return false;

      }
    });

  }

})(jQuery);