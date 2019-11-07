
function setFav(adId, userId) {
    if (userId == 0) {
        window.location.href = loginurl;
    }
    $('.searchresult.grid #fav_'+adId).html('<i class="fa fa-spinner" aria-hidden="true"></i>');
    $('.searchresult.list #fav_'+adId).html('<i class="fa fa-spinner" aria-hidden="true"></i>');
    $.ajax({
        url: ajaxurl+"?action=setFavAd&id=" + adId + "&userId=" + userId,
        type: 'post',
        success: function (result) {
            if (result == 1) {
                $('.searchresult.grid #fav_'+adId).html('<i class="fa fa-check"></i> Added');
                $('.searchresult.list #fav_'+adId).html('<i class="fa fa-check"></i> Added');
            }
            else{
                alert("else");
            }
        }
    });
}

function removeFav(adId, userId) {
    $.ajax({
        url: ajaxurl+"?action=removeFavAd&id=" + adId + "&userId=" + userId,
        type: 'post',
        success: function (result) {
            if (result == '1') {
                window.location.href = favpageurl;
            }
        }
    });
}