{OVERALL_HEADER}
<!-- world-gmap -->
<section id="main" class="clearfix home-two">
    <!-- gmap -->
    <div id="road_map" class="map"></div>
    <div class="container">
        <div class="row">
            <!-- banner -->
            <div class="col-sm-12">
                <div class="banner">
                    <!-- banner-form -->
                    <div class="banner-form banner-form-full">
                        <form action="#" id="hero-home-map">
                            <!-- category-change -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dropdown category-dropdown"><a data-toggle="dropdown" href="#"><span class="change-text">{LANG_SELECT_CATEGORY}</span><i class="fa fa-navicon"></i></a>{CAT_DROPDOWN}</div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="serachStr" placeholder="{LANG_WHAT} ?" style="padding: 0px;">
                                </div>
                                <div class="col-md-3 banner-icon geo-location"><i class="fa fa-map-marker"></i>
                                    <input type="text" class="form-control" id="address-autocomplete" name="location" placeholder="{LANG_WHERE} ?" style=" border-left: 1px solid #e0e0e0;">
                                    <input type="hidden" id="latitude" name="latitude"/>
                                    <input type="hidden" id="longitude" name="longitude"/>
                                    <input type="hidden" id="locality" name="locality"/>
                                    <input type="hidden" id="administrative_area_level_2" name="city"/>
                                    <input type="hidden" id="administrative_area_level_1" name="state"/>
                                    <input type="hidden" id="country" name="country"/>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" id="input-maincat" name="searchBox" value=""/>
                                    <input type="hidden" id="input-subcat" name="subcat" value=""/>
                                    <button data-ajax-response='map' data-ajax-auto-zoom="1" type="submit" name="searchform"
                                            class="form-control"><i class="fa fa-search"></i> {LANG_SEARCH}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- banner-form -->
                </div>
            </div>
            <!-- banner -->
        </div>
        <!-- row -->
        <div class="section services">
            <style>
                .single-service figure {
                    display: none;
                }
            </style>
            {LOOP: CAT}
            <!-- single-service -->
            <div class="single-service">
                IF("{CAT.picture}"==""){
                <div class="services-icon"><i class="{CAT.icon}"></i></div>
                {:IF}
                IF("{CAT.picture}"!=""){
                <div class="services-icon"><img src="{CAT.picture}"/></div>
                {:IF}
                <h5><a href="{CAT.catlink}">{CAT.main_title}</a></h5>
                <ul>
                    {CAT.sub_title}
                </ul>
            </div>
            <!-- single-service -->
            {/LOOP: CAT}
        </div>
        <!-- services -->
        <!-- quickad-section-Mobile -->
        <div class="quickad-section" id="quickad-top">{TOP_ADSCODE}</div>
        <!-- quickad-section-Mobile -->

        <!-- featured-slide -->
        <div class='section recommended-ads IF("{POST_PREMIUM_LISTING}"=="0"){ hidden {:IF}'>
            <div class="row">
                <div class="col-sm-12">
                    <div class="featured-top">
                        <h4>{LANG_PREMIUM_ADS}</h4>
                    </div>
                </div>
            </div>
            <!-- featured-slider -->
            <div class="recommended-slider" id="serchlist">
                <div id="recommended-slider-id">
                    {LOOP: ITEM}
                    <div class="quick-item IF(" {ITEM.highlight}"=="1"){ highlight {:IF}">
                    <!-- item-image -->
                    <div class="item-image-box">
                        <div class="item-image"><a href="{ITEM.link}"><img
                                src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="Image"
                                class="img-responsive"></a>

                            <div class="item-badges">
                                IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                            </div>
                        </div>
                        <!-- item-image -->
                    </div>
                    <div class="item-info {ITEM.highlight_bg}">
                        <!-- ad-info -->
                        <div class="ad-info">
                            <h4 class="item-title"><a href="{ITEM.link}">{ITEM.product_name}</a></h4>
                            <ol class="breadcrumb">
                                <li><a href="{ITEM.catlink}">{ITEM.category}</a></li>
                                <li class="hidden"><a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                </li>
                            </ol>
                            <ul class="item-details">
                                <li><i class="fa fa-map-marker"></i><a href="{ITEM.citylink}">{ITEM.location}</a></li>
                                <li><i class="fa fa-clock-o"></i>{ITEM.created_at}</li>
                            </ul>
                            <div class="ad-meta">
                                IF("{ITEM.price}"!="0"){ <span class="item-price"> {ITEM.price} </span> {:IF}
                                <ul class="contact-options pull-right" id="set-favorite">
                                    <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}"
                                           data-action="setFavAd" class="fav_{ITEM.id} fa fa-heart IF("{ITEM.favorite}"=="1"){ active {:IF}"></a></li>
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
            <!-- featured-slider -->
        </div>
        <!-- #featured-slider -->
    </div>
    <!-- featured-slide -->

    <!-- recent-slide -->
    <div class="section recommended-ads">
        <div class="row">
            <div class="col-sm-12">
                <div class="featured-top">
                    <h4>{LANG_LATEST_ADS}</h4>
                </div>
            </div>
        </div>
        <!-- recent-slider -->
        <div class="recommended-slider" id="serchlist">
            <div id="recent-slider-id">
                {LOOP: ITEM2}
                <div class="quick-item IF(" {ITEM2.highlight}"=="1"){ highlight {:IF}">
                <!-- item-image -->
                <div class="item-image-box">
                    <div class="item-image"><a href="{ITEM2.link}"><img
                            src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="Image"
                            class="img-responsive"></a>

                        <div class="item-badges">
                            IF("{ITEM2.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                            IF("{ITEM2.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                        </div>
                    </div>
                    <!-- item-image -->
                </div>
                <div class="item-info {ITEM2.highlight_bg}">
                    <!-- ad-info -->
                    <div class="ad-info">
                        <h4 class="item-title"><a href="{ITEM2.link}">{ITEM2.product_name}</a></h4>
                        <ol class="breadcrumb">
                            <li><a href="{ITEM2.catlink}">{ITEM2.category}</a></li>
                            <li class="hidden"><a title="{ITEM2.sub_category}" href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                            </li>
                        </ol>
                        <ul class="item-details">
                            <li><i class="fa fa-map-marker"></i><a href="{ITEM2.citylink}">{ITEM2.location}</a></li>
                            <li><i class="fa fa-clock-o"></i>{ITEM2.created_at}</li>
                        </ul>
                        <div class="ad-meta">
                            IF("{ITEM2.price}"!="0"){ <span class="item-price"> {ITEM2.price} </span> {:IF}

                            <ul class="contact-options pull-right" id="set-favorite">
                                <li><a href="#" data-item-id="{ITEM2.id}" data-userid="{USER_ID}" data-action="setFavAd"
                                       class="fav_{ITEM2.id} fa fa-heart IF("{ITEM2.favorite}"=="1"){ active {:IF}"></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- ad-info -->
                </div>
                <!-- item-info -->
            </div>
            <!-- quick-item -->
            {/LOOP: ITEM2}
        </div>
        <!-- recent-slider -->
    </div>
    <!-- #recent-slider -->
    </div>
    <!-- recent-slide -->

    <div class="quickad-section" id="quickad-bottom">{BOTTOM_ADSCODE}</div>
    </div>
    <!-- container -->
</section>
<!-- world-gmap -->

<script>
    $('#address-autocomplete').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    var _latitude = {LATITUDE};
    var _longitude = {LONGITUDE};
    var element = "road_map";
    var site_url = '{SITE_URL}';
    var path = '{SITE_URL}templates/{TPL_NAME}/';
    var color = '{MAP_COLOR}';
    var optimizedDatabaseLoading = 0;
    var markerTarget = "gmapAdBox";
    var sidebarResultTarget = "sidebar";
    var showMarkerLabels = true;
    var mapDefaultZoom = {ZOOM};
    var getCity = true;
    var Countries = '{SPECIFIC_COUNTRY}';
    if (Countries != "") {
        var getCountry = Countries;
    }
    else {
        var getCountry = "all";
    }

    heroMap(_latitude, _longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
    loginurl = "{LINK_LOGIN}?ref=index.php";
</script>
{OVERALL_FOOTER}