{OVERALL_HEADER}
<link href="{SITE_URL}templates/{TPL_NAME}/css/user-html.css" rel="stylesheet" type="text/css"/>
<!-- starReviews stylesheet -->
<link href="{SITE_URL}plugins/starreviews/assets/css/starReviews.css" rel="stylesheet" type="text/css"/>
<!-- main -->
<section id="main" class="clearfix details-page">
    <div class="container" id="serchlist">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li><a href="{ITEM_CATLINK}">{ITEM_CATEGORY}</a></li>
                <li class="active">{ITEM_SUB_CATEGORY}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>{LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
        </div>
        <div class="section banner">
            <!-- banner-form -->
            <div class="banner-form banner-form-full">
                <form method="get" action="{SITE_URL}listing" name="locationForm" id="ListingForm">
                    <!-- category-change -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dropdown category-dropdown"><a data-toggle="dropdown" href="#"><span class="change-text">{LANG_SELECT_CATEGORY}</span><i class="fa fa-navicon"></i></a>{CAT_DROPDOWN}</div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="keywords" value="" placeholder="{LANG_WHAT} ?" style="padding: 0px;">
                        </div>
                        <div class="col-md-3 banner-icon"><i class="fa fa-map-marker"></i>
                            <input type="text" class="form-control location" id="searchStateCity" name="location" placeholder="{LANG_WHERE} ?" >
                            <input type="hidden" name="placetype" id="searchPlaceType" value="">
                            <input type="hidden" name="placeid" id="searchPlaceId" value="">
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" id="input-maincat" name="cat" value=""/>
                            <input type="hidden" id="input-subcat" name="subcat" value=""/>
                            <button data-ajax-response='map' type="submit" name="Submit" class="form-control"><i class="fa fa-search"></i> {LANG_SEARCH}</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- banner-form -->
        </div>
        <!-- banner -->
        <div class="section slider">
            <div class="row">
                <!-- carousel -->
                <div class="col-md-8">
                    <div class="ad-details">

                        IF("{ITEM_HIDE_PHONE}"=="no"){ <ul class="detail-corner-icon"><li><a href="tel:{ITEM_PHONE}" class="fa fa-phone tooltip-parent field-tip"><span class="tip-content">{ITEM_PHONE}</span></a></li></ul> {:IF}

                        <h1 class="title">{ITEM_TITLE}
                            <span class="label-wrap hidden-sm hidden-xs">
                            IF("{ITEM_FEATURED}"=="1"){ <span class="label featured"> {LANG_FEATURED}</span> {:IF}
                            IF("{ITEM_URGENT}"=="1"){ <span class="label urgent"> {LANG_URGENT}</span> {:IF}
                            IF("{ITEM_HIGHLIGHT}"=="1"){ <span class="label highlight"> {LANG_HIGHLIGHT}</span> {:IF}
                            </span>
                        </h1>
                        <span class="icon"><i class="fa fa-clock-o"></i><a href="#">{ITEM_CREATED}</a></span>
                        <span class="icon"><i class="fa fa-map-marker"></i><a href="#">{ITEM_CITY}, {ITEM_COUNTRY}</a></span>
                        <span class="icon"><i class="fa fa-eye"></i><a href="#">{LANG_AD_VIEWS}:{ITEM_VIEW}</a></span>
                        <span> {LANG_AD_ID}:<a href="#" class="time"> {ITEM_ID}</a></span>
                    </div>

                    IF("{SHOW_IMAGE_SLIDER}"=="1"){
                    <figure class="ad-detail-page">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel" style="position: inherit">

                            <!-- Wrapper for slides -->
                            <?php
                            if("{ITEM_PRICE}"!="0"){
                                echo '<div class="ribbon ribbon-clip ribbon-reverse"><span class="ribbon-inner">{ITEM_PRICE}</span></div>';
                            }
                            ?>
                            <div class="carousel-inner" role="listbox">{ITEM_SCREENS_CLASSB}
                                <!-- Controls -->
                                <a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                <a class="right carousel-control" href="#product-carousel" role="button" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                <!-- Controls -->
                            </div>
                            <!-- carousel-inner -->
                            <!-- Indicators -->
                            <ol class="carousel-indicators">{ITEM_SCREENS_CLASSSM}</ol>
                        </div>

                    </figure>
                    {:IF}

                    <div class="description-info">
                        <div class="ads-details">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-details" data-toggle="tab" aria-expanded="false"><h4>{LANG_ADS_DETAILS}</h4></a></li>
                                <li><a href="#tab-reviews" data-toggle="tab" aria-expanded="true"><h4>{LANG_REVIEWS} ({ITEMREVIEW})</h4></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-details">
                                    IF("{ITEM_CUSTOMFIELD}"!="0"){
                                    <div class="quick-info">
                                        <div class="detail-title"><h2 class="title-left">{LANG_ADDITIONAL_DETAILS}</h2></div>
                                        <ul class="clearfix">
                                            {LOOP: ITEM_CUSTOM}
                                                <li><div class="inner clearfix"><span class="label">{ITEM_CUSTOM.title}</span><span class="desc">{ITEM_CUSTOM.value}</span></div></li>
                                            {/LOOP: ITEM_CUSTOM}
                                        </ul>
                                    </div>
                                    {:IF}
                                    {LOOP: ITEM_CUSTOM_TEXTAREA}
                                        <div class="text-widget">
                                            <div class="detail-title"><h2 class="title-left">{ITEM_CUSTOM_TEXTAREA.title}</h2></div>
                                            <div class="inner"><div class="user-html">{ITEM_CUSTOM_TEXTAREA.value}</div></div>
                                        </div>
                                    {/LOOP: ITEM_CUSTOM_TEXTAREA}

                                    {LOOP: ITEM_CUSTOM_CHECKBOX}
                                        <div class="text-widget">
                                            <div class="detail-title"><h2 class="title-left">{ITEM_CUSTOM_CHECKBOX.title}</h2></div>
                                            <div class="inner row">{ITEM_CUSTOM_CHECKBOX.value}</div>
                                        </div>
                                    {/LOOP: ITEM_CUSTOM_CHECKBOX}

                                    <div class="description">
                                        <div class="detail-title"><h2 class="title-left">{LANG_DESCRIPTION}</h2></div>
                                        <div class="user-html">{ITEM_DESC}</div>
                                        <!-- <p class="show-more"></p>
                                        <a href="#" class="show-more-button" data-more-title="{LANG_SHOW_MORE}"
                                           data-less-title="{LANG_SHOW_LESS}"><i class="fa fa-angle-down"></i></a> -->
                                    </div>

                                    IF("{SHOW_TAG}"=="1"){
                                    <div class="text-widget">
                                        <div class="detail-title"><h2 class="title-left">{LANG_PRODUCT_TAG}</h2></div>
                                        <div class="inner"><ul class="tags">{ITEM_TAG}</ul></div>
                                    </div>
                                    {:IF}

                                    <div class="description">
                                        <div class="detail-title"><h2 class="title-left">{LANG_LOCATION}</h2></div>
                                        <div><div class="map-widget map height-200px" id="map-detail"></div></div>
                                    </div>
                                </div>

                                <div class="reviews-widget tab-pane" id="tab-reviews">
                                    <!-- **** Start reviews **** -->
                                    <div class="starReviews text-widget">
                                        <!-- This is where your product ID goes -->
                                        <div id="review-productId" class="review-productId" style="">{ITEM_ID}</div>
                                        <!-- Show current reviews -->
                                        <div class="show-reviews"><div class="loader" style="margin: 0 auto;"></div></div>
                                        <hr>

                                        IF("{LOGGED_IN}"=="0"){
                                        <div style="padding-top: 10px"><a class="modal-trigger btn btn-primary" href="#loginPopUp">{LANG_LOGINTOREVIEW}</a></div>
                                        {:IF}
                                        IF("{LOGGED_IN}"=="1"){
                                        <!-- Add new review -->
                                        <div class="add-review"></div>
                                        {:IF}

                                        <script type="text/javascript">
                                            var LANG_ADDREVIEWS     = "{LANG_ADDREVIEWS}";
                                            var LANG_SUBMITREVIEWS  = "{LANG_SUBMITREVIEWS}";
                                            var LANG_HOW_WOULD_RATE = "{LANG_HOW_WOULD_RATE}";
                                            var LANG_REVIEWS        = "{LANG_REVIEWS}";
                                            var LANG_YOURREVIEWS    = "{LANG_YOURREVIEWS}";
                                            var LANG_ENTER_REVIEW   = "{LANG_ENTER_REVIEW}";
                                            var LANG_STAR           = "{LANG_STAR}";
                                        </script>
                                    </div>
                                    <!-- **** End reviews **** -->
                                </div>
                            </div>
                            <!-- /.tab content -->
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <!-- slider-text -->
                <div class="col-md-4">
                    <div class="ad-details">
                        <div class="aside">
                            <div class="aside-header">{LANG_CONTACT_ADVERTISER}</div>
                            <div class="aside-body text-center">
                                <!-- short-info -->
                                <div class="user-info ">
                                    <div class="profile-picture">
                                        <img width="70px" style="min-height:73px" src="{SITE_URL}storage/profile/{ITEM_AUTHORIMG}" alt="{ITEM_AUTHORUNAME}">
                                    </div>
                                    <h4><a href="{ITEM_AUTHORLINK}"> {ITEM_AUTHORNAME} IF("{ITEM_AUTHORNAME}"==""){ {ITEM_AUTHORUNAME} {:IF}</a>
                                        IF("{SUB_IMAGE}"!=""){
                                        <img src="{SUB_IMAGE}" alt="{SUB_TITLE}" title="{SUB_TITLE}" width="24px"/>
                                        {:IF}
                                    </h4>
                                    <p><strong>{LANG_JOINED}: </strong><a href="#">{ITEM_AUTHORJOINED}</a></p>
                                    IF("{ITEM_HIDE_PHONE}"=="no"){
                                    <p><strong>{LANG_PHONE} : </strong><a href="tel:{ITEM_PHONE}">{ITEM_PHONE}</a></p>
                                    {:IF}
                                </div>
                                <!-- short-info -->

                                <!-- contact-advertiser -->
                                <div class="contact-advertiser">
                                    IF("{LOGGED_IN}"=="0"){
                                    <a class="modal-trigger btn btn-warning" href="#loginPopUp"><i class="fa fa-comment-o"></i>Login to Chat</a>
                                    {:IF}
                                    IF("{LOGGED_IN}&{ZECHAT}"=="1&on"){
                                    <a href="#"><button type="button" class="btn btn-warning" href="#" onclick="javascript:chatWith('{ITEM_AUTHORUNAME}','{ITEM_AUTHORIMG}','{ITEM_AUTHORONLINE}')"><i class="fa fa-comment-o"></i> Chat Now</button></a>
                                    {:IF}
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#emailToSeller"><i class="fa fa-envelope"></i>{LANG_REPLY_MAIL}</a>
                                </div>
                                <!-- contact-advertiser -->
                                <!-- social-links -->
                                <div class="social-links text-center">
                                    <h4>{LANG_SHARE_AD}</h4>
                                    <div class="social-share"></div>
                                    <!--end social-->
                                </div>
                                <!-- social-links -->
                            </div>
                        </div>

                        <!-- Rating-info -->
                        <div class="aside margin-top-20">
                            <div class="aside-body ">
                                <div class="more-info">
                                    <!-- **** Start reviews **** -->
                                    <div class="starReviews">
                                        <!-- Show average-rating -->
                                        <div class="average-rating"><div class="small_loader" style="margin: 0 auto;"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rating-info -->
                        <!-- short-info -->
                        <div class="aside margin-top-20">
                            <div class="aside-body ">
                                <div class="more-info">
                                    <h4>{LANG_MORE_INFO}</h4>
                                    <!-- social-icon -->
                                    <ul id="set-favorite">
                                        <li><a href="#" data-item-id="{ITEM_ID}" data-userid="{USER_ID}" data-action="setFavAd" class="fav_{ITEM_ID} fa fa-heart IF("
                                            {ITEM_FAVORITE}"=="1"){ active {:IF}"><span style="font-family: 'Open Sans', sans-serif;color: #707070;font-size: 15px;">{LANG_SAVE_AS_FAVOURITE}</span></a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li><i class="fa fa-user-plus"></i><a href="{ITEM_AUTHORLINK}">{LANG_MORE_ADS}<span> {ITEM_AUTHORUNAME} </span></a></li>
                                        <li><i class="fa fa-exclamation-triangle"></i><a href="{LINK_REPORT}">{LANG_REPORT_THIS_AD}</a></li>
                                    </ul>
                                    <!-- social-icon -->
                                </div>
                            </div>
                        </div>
                        <!-- short-info -->

                        <!-- Advertise-Box -->
                        IF("{RIGHT_ADSTATUS}"=="1"){
                        <div class="quickad-section" id="quickad-right">
                            <div class="text-center visible-md visible-lg">
                                {RIGHT_ADSCODE}
                            </div>
                        </div>
                        {:IF}
                        <!-- Advertise-Box -->
                    </div>
                </div>
                <!-- slider-text -->
        </div>
    </div>
    <!-- slider -->
    <!-- featured-slide -->
    <div class="section recommended-ads">
        <div class="row">
            <div class="col-sm-12">
                <div class="featured-top"><h4>{LANG_RECOMMENDED_ADS}</h4></div>
            </div>
        </div>
        <!-- featured-slider -->
        <div class="recommended-slider">
            <div id="recommended-slider-id">
                {LOOP: ITEM}
                    <!-- quick-item -->
                    <div class='quick-item IF(" {ITEM.highlight}"=="1"){ highlight {:IF}'>
                        <!-- item-image -->
                        <div class="item-image-box">
                            <div class="item-image">
                                <a href="{ITEM.link}"><img src="{SITE_URL}storage/products/{ITEM.picture}" alt="{ITEM.product_name}" class="img-responsive"></a>
                                <div class="item-badges">
                                    IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span> {:IF}
                                    IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span> {:IF}
                                </div>
                            </div>
                        </div>
                        <!-- item-image -->
                        <div class="item-info">
                            <!-- ad-info -->
                            <div class="ad-info">
                                <h4 class="item-title"><a href="{ITEM.link}">{ITEM.product_name}</a></h4>
                                <ol class="breadcrumb"><li><a href="{ITEM.catlink}">{ITEM.category}</a></li></ol>
                                <ul class="item-details">
                                    <li><i class="fa fa-map-marker"></i><a href="{ITEM.citylink}">{ITEM.cityname}, {ITEM.country}</a></li>
                                    <li><i class="fa fa-clock-o"></i>{ITEM.created_at}</li>
                                </ul>
                                <div class="ad-meta">
                                    IF("{ITEM.price}"!="0"){ <span class="item-price"> {ITEM.price}</span> {:IF}
                                    <ul class="contact-options pull-right" id="set-favorite">
                                        <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}" data-action="setFavAd" class="fav_{ITEM.id} fa fa-heart IF("{ITEM.favorite}"=="1"){ active {:IF}"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- ad-info -->
                        </div>
                        <!-- item-info -->
                    </div>
                    <!-- quick-item -->
                {/LOOP: ITEM}
            </div>
        </div>
        <!-- #featured-slider -->
    </div>
    <!-- featured -->
    </div>
    <!-- container -->
</section>
<!-- main -->
<!-- Modal -->
<div id="emailToSeller" class="modal fade" role="dialog">
    <div class="modal-dialog"><!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{LANG_SEND-MAIL} {LANG_TO} {ITEM_AUTHORUNAME}</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="email_success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{LANG_MAILSENTTOSELLER}</div>
                <div class="alert alert-danger" id="email_error" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{LANG_ERROR_TRY_AGAIN}</div>
                <div class="feed-back-form">
                    <form method="post" id="email_contact_seller" action="email_contact_seller">
                        <div id="post_loading" class="loader" style="display: none;margin: 0 auto;"></div>
                        <input type="text" class="form-control" name="name" placeholder="Full Name" required="" style="width: 100%">
                        <input type="text" class="form-control" name="email" placeholder="Email" required="" style="width: 100%">
                        <input type="text" class="form-control" name="phone" placeholder="Phone No" style="width: 100%">
                        <!---728x90--->
                        <span>{LANG_MESSAGE} ?</span>
                        <textarea type="text" class="form-control" name="message" placeholder="{LANG_ENTER_YOUR_MESSAGE}..." required="" rows="2" style="width: 100%;height: 100px"></textarea>
                        <input type="hidden" class="form-control" name="id" value="{ITEM_ID}">
                        <input type="hidden" class="form-control" name="sendemail" value="1">
                        <input type="submit" class="btn btn-outline" value="{LANG_SEND_MAIL}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#email_contact_seller").on('submit', function() {

        $('#email_contact_seller #post_loading').show();
        var action = $("#email_contact_seller").attr('action');
        var form_data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: ajaxurl+'?action='+action,
            data: form_data,
            success: function (response) {
                if (response == "success") {
                    $('#email_success').show();
                }
                else {
                    $('#email_error').show();
                }
                $('#email_contact_seller #post_loading').hide();
            }
        });
        return false;
    });

    $('.show-more-button').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.show-more').toggleClass('visible');
        if ($('.show-more').is(".visible")) {
            var el = $('.show-more'),
                    curHeight = el.height(),
                    autoHeight = el.css('height', 'auto').height();
            el.height(curHeight).animate({
                height: autoHeight
            }, 400);
        } else {
            $('.show-more').animate({
                height: '100px'
            }, 400);
        }
    });
</script>
<script async="async" type="text/javascript">
    var _latitude = {ITEM_LAT};
    var _longitude = {ITEM_LONG};
    var site_url = '{SITE_URL}';
    var color = '{MAP_COLOR}';
    var path = '{SITE_URL}templates/{TPL_NAME}';
    var element = "map-detail";
    simpleMap(_latitude, _longitude, element);


    function socialShare() {
        var socialButtonsEnabled = 1;
        if (socialButtonsEnabled == 1) {
            $('head').append($('<link rel="stylesheet" type="text/css">').attr('href', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css'));
            $('head').append($('<link rel="stylesheet" type="text/css">').attr('href', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css'));
            $.getScript("{SITE_URL}templates/{TPL_NAME}/assets/plugins/social-share/jssocials.min.js", function (data, textStatus, jqxhr) {
                $(".social-share").jsSocials({
                    showLabel: false,
                    showCount: false,
                    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
                });
            });
        }
    }
    //  Social Share -------------------------------------------------------------------------------------------------------
    if ($(".social-share").length) {
        socialShare();
    }

    var loginurl = "{LINK_LOGIN}?ref=listing";
</script>



{OVERALL_FOOTER}
<!-- jQuery Form Validator -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.34/jquery.form-validator.min.js"></script>

<!-- jQuery Barrating plugin -->
<script src="{SITE_URL}plugins/starreviews/assets/js/jquery.barrating.js"></script>

<!-- jQuery starReviews -->
<script src="{SITE_URL}plugins/starreviews/assets/js/starReviews.js"></script>

<script type="text/javascript">

    $(document).ready(function () {

        /* Activate our reviews */
        $().reviews('.starReviews');

    });

</script>