{OVERALL_HEADER}
<!-- home-one-info -->
<section class="clearfix home-one" id="page" data-ipapi="ip_api">
    <!-- world -->
    <div id="banner-two" style="background-image:url({SITE_URL}storage/banner/{BANNER_IMAGE});background-size: cover;">
        <div class="overlay"></div>
        <div class="d-flex align-items-center h-100">
            <div class="container">
                <div class="row text-center">

                    <div class="col-sm-12 ">
                        <div class="banner">

                            <h1 class="title">{LANG_HOME_BANNER_HEADING}</h1>
                            <h3>{LANG_HOME_BANNER_TAGLINE}</h3>


                            <!-- banner-form -->
                            <form autocomplete="off" class="form-inline" method="get" action="{LINK_LISTING}" accept-charset="UTF-8" style="display:block">
                                <div class="search-banner-wrapper">
                                    <div class="search-banner row justify-content-center no-gutters">

                                        <div class="col-md-6">
                                            <div class="form-group bg-white d-flex align-items-center px-3 mb-3 mb-lg-0 border-right">
                                                <label for="textwords" class="font-weight-bold">{LANG_WHAT} </label>
                                                <input autocomplete="off" type="text" class="form-control border-0 qucikad-ajaxsearch-input" placeholder="{LANG_WHAT_LOOK_FOR}" data-prev-value="0" data-noresult="{LANG_MORE_RESULTS_FOR}">
                                                <i class="qucikad-ajaxsearch-close fa fa-times-circle" aria-hidden="true" style="display: none;"></i>
                                                <div id="qucikad-ajaxsearch-dropdown" size="0" tabindex="0" style="display: none; overflow-y: hidden; outline: none; cursor: -webkit-grab;">
                                                    <ul>
                                                        {LOOP: CATEGORY}
                                                        <li class="qucikad-ajaxsearch-li-cats" data-catid="{CATEGORY.slug}">
                                                            IF("{CATEGORY.picture}"==""){
                                                            <i class="qucikad-as-caticon {CATEGORY.icon}"></i>
                                                            {:IF}
                                                            IF("{CATEGORY.picture}"!=""){
                                                            <img src="{CATEGORY.picture}"/>
                                                            {:IF}
                                                            <span class="qucikad-as-cat">{CATEGORY.name}</span>
                                                        </li>
                                                        {/LOOP: CATEGORY}
                                                    </ul>

                                                    <div style="display:none" id="def-cats">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pl-3 live-location-search">
                                                <label for="city" class="font-weight-bold">{LANG_WHERE} </label>
                                                <div data-option="no" class="loc-tracking"><i class="fa fa-crosshairs"></i></div>
                                                <input type="text" class="form-control border-0" id="searchStateCity" name="location" placeholder="{LANG_YOUR_CITY}">

                                                <input type="hidden" name="latitude" id="latitude" value="">
                                                <input type="hidden" name="longitude" id="longitude" value="">
                                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                                <input type="hidden" id="input-keywords" name="keywords" value="">
                                                <input type="hidden" id="input-maincat" name="cat" value=""/>
                                                <input type="hidden" id="input-subcat" name="subcat" value=""/>
                                                <button data-ajax-response='map' type="submit" name="searchform" class="btn btn-primary ml-auto">
                                                    <i class="fa fa-search"></i>
                                                    <span class="align-middle ml-2 dn-text-sm">{LANG_SEARCH}</span>
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>
                            <!-- banner-form -->


                        </div>
                    </div>
                    <!-- banner -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="clearfix">
    <!-- world -->
    <div class="container">
        <!-- main-content -->
        <div class="main-content" id="serchlist">
            <!-- row -->
            <div class="row">
                IF("{LEFT_ADSTATUS}"=="1"){
                <div class="hidden-xs hidden-sm col-md-2 text-center">
                    <div class="advertisement" id="quickad-left">{LEFT_ADSCODE}</div>
                </div>
                {:IF}
                <!-- product-list -->
                <div class="{CATEGORY_COLUMN}">
                    <!-- categorys -->
                    <div class="section category-quickad text-center">
                        <ul class="category-list">
                            {LOOP: CAT}
                            <li class="category-item"><a href="{CAT.catlink}">
                                    IF("{CAT.picture}"==""){
                                    <div class="category-icon"><i class="{CAT.icon}"></i></div>
                                    {:IF}
                                    IF("{CAT.picture}"!=""){
                                    <div class="category-icon"><img src="{CAT.picture}"/></div>
                                    {:IF}

                                <span class="category-title">{CAT.main_title}</span></a>
                            </li>
                            <!-- category-item -->
                            {/LOOP: CAT}
                        </ul>
                    </div>
                    <!-- category-ad -->
                    <!-- quickad-section -->
                    <div class="quickad-section text-center" id="quickad-top">{TOP_ADSCODE}</div>
                    <!-- quickad-section -->

                    <!-- featured-slide -->
                    <div class='section featured-slide IF("{POST_PREMIUM_LISTING}"=="0"){ hidden {:IF}'>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-title featured-top">
                                    <h4>{LANG_PREMIUM_ADS}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- featured-slider -->
                        <div class="featured-slider">
                            <div id="featured-slider" >
                                {LOOP: ITEM}
                                <div class="quick-item">
                                <!-- item-image -->
                                <div class="item-image-box">
                                    <div class="item-image"><a href="{ITEM.link}"><img
                                            src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="{ITEM.product_name}"
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
                                        <h4 class="item-title">
                                            IF("{ITEM.sub_image}"!=""){
                                            <img src="{ITEM.sub_image}" width="24px" alt="{ITEM.sub_title}" title="{ITEM.sub_title}" style="display: inline-block;width: 24px"/>
                                            {:IF}
                                            <a href="{ITEM.link}">{ITEM.product_name}</a>

                                        </h4>
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
                            <div id="latest-slider">
                                {LOOP: ITEM2}
                                <div class="quick-item ">
                                <!-- item-image -->
                                <div class="item-image-box">
                                    <div class="item-image"><a href="{ITEM2.link}"><img
                                            src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="{ITEM2.product_name}" class="img-responsive"></a>

                                        <div class="item-badges">
                                            IF("{ITEM2.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span> {:IF}
                                            IF("{ITEM2.urgent}"=="1"){ <span>{LANG_URGENT}</span> {:IF}
                                        </div>
                                    </div>
                                    <!-- item-image -->
                                </div>
                                <div class="item-info {ITEM2.highlight_bg}">
                                    <!-- ad-info -->
                                    <div class="ad-info">
                                        <h4 class="item-title">
                                            IF("{ITEM2.sub_image}"!=""){
                                            <img src="{ITEM2.sub_image}" width="24px" alt="{ITEM2.sub_title}" title="{ITEM2.sub_title}" style="display: inline-block;width: 24px"/>
                                            {:IF}
                                            <a href="{ITEM2.link}">{ITEM2.product_name}</a></h4>
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
                </div>
                <!-- product-list -->
                <!-- advertisement -->

                IF("{RIGHT_ADSTATUS}"=="1"){
                <div class="hidden-xs hidden-sm col-md-2 text-center">
                    <div class="advertisement" id="quickad-right">{RIGHT_ADSCODE}</div>
                </div>
                {:IF}
                <!-- advertisement -->
            </div>
            <!-- row -->
        </div>
        <!-- main-content -->
    </div>
    <!-- container -->
</section>
<!-- home-one-info -->
<script>
    var loginurl = "{LINK_LOGIN}?ref=index.php";
</script>

{OVERALL_FOOTER}




