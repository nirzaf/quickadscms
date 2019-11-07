{OVERALL_HEADER}

<div id="page-content" style="transform: translateY(0px);">
    <div class="quickad-section has-background height-600px" id="page" data-ipapi="ip_api">
        <div class="wrapper">
            <div class="inner">
                <div class="container">
                    <div class="page-title center">
                        <h1 class="title">{LANG_HOME_BANNER_HEADING}</h1>
                        <h2>{LANG_HOME_BANNER_TAGLINE}</h2>
                    </div>

                    <!--end page-title-->
                    <div class="row">
                        <div class="">
                            <div class="container">
                                <div class="pad-50-lr">
                                    <form class="" id="withimg" method="get" action="{LINK_LISTING}">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5">
                                                <div class="input-field">
                                                    <input type="text" name="keywords" placeholder="{LANG_WHAT} ?" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group input-field tg-inputwithicon live-location-search" id="country-popup">
                                                    <div data-option="no" class="loc-tracking"><i class="fa fa-crosshairs"></i></div>
                                                    <i class="fa fa-close hidden" id="clear-city" style="display: none"></i>
                                                    <input type="text" id="inputStateCity" name="location" placeholder="{LANG_WHERE} ?" autocomplete="off">

                                                    <div id="searchDisplay"></div>
                                                    <input type="hidden" name="latitude" id="latitude" value="">
                                                    <input type="hidden" name="longitude" id="longitude" value="">
                                                    <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                                    <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                                </div>
                                            </div>
                                            <!--end col-md-4-->
                                            <div class="col-md-3 col-sm-3">
                                                <div  class="input-field">
                                                    <select name="cat" class="meterialselect">
                                                        <option value="">{LANG_ALL_CATEGORIES}</option>
                                                        {LOOP: CATEGORY}
                                                        <option value="{CATEGORY.id}" {CATEGORY.selected}>{CATEGORY.name}</option>
                                                        {/LOOP: CATEGORY}
                                                    </select>
                                                </div>

                                            </div>
                                            <!--end col-md-4-->
                                            <div class="col-md-1 col-sm-1">
                                                <div class="input-field">
                                                    <button type="submit" name="Submit" class="btn btn-defauilt btn-rounded "><i class="fa fa-search"></i> {LANG_SEARCH}</button>
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-md-4-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end form-hero-->
                            </div>
                            <!--end container-->
                        </div>
                        <!--end search-form-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </div>
            <!--end inner-->
        </div>
        <!--end wrapper-->
        <div class="background-wrapper">
            <div class="bg-transfer opacity-30"><img src="{SITE_URL}storage/banner/{BANNER_IMAGE}" alt=""></div>
            <div class="background-color background-color-black"></div>
        </div>

        <!--end background-wrapper-->
    </div>


    <section class="block">
        <div class="container">
            <div class="section-title">
                <div class="center">
                    <h2>{LANG_BROWSE_LISTING}</h2>
                </div>
            </div>

            <!--end section-title-->
            <div class="categories-list">
                <div class="row">

<!--Category display dynamically -->
                    {LOOP: CAT}
                        <div class="col-md-3 col-sm-3">
                            <div class="list-item min-height-150">
                                <div class="title">
                                    <div class="icon"><i class="{CAT.icon}"></i></div>
                                    <h3><a href="{CAT.catlink}">{CAT.main_title}</a></h3>
                                </div>
                                <div class="tse-scrollable catListing">
                                    <div class="tse-content">
                                        <ul>{CAT.sub_title}</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/LOOP: CAT}
<!--Category display dynamically-->
                </div>
                <!--end row-->
            </div>
            <!--end categories-list-->
        </div>
        <!--end container-->
    </section>
    <!--end block-->
    IF("{POST_PREMIUM_LISTING}"=="0"){
    <style>
        #premium_crousel{ display: none !important;}
    </style>
    {:IF}
    <section class="block background-is-dark" id="premium_crousel">
        <div class="container">
            <div class="section-title vertical-aligned-elements">
                <div class="element text-align-right">
                    <h2 class="invisible-on-mobile pull-left featured-ads-label">{LANG_PREMIUM_ADS}</h2>
                    <div id="premium-nav" class="gallery-nav"></div>
                </div>
            </div>
            <!--end section-title-->
        </div>
        <div class="gallery featured container">
            <div class="owl-carousel" data-owl-items="4" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="1" data-owl-nav-container="#premium-nav">
                {LOOP: ITEM}
                <div class="ribbon-pad">
                    <div class="item mar-left-zero" data-id="1">
                        <div class="premium">
                            IF("{ITEM.featured}"=="1"){ <span class="listing-box-premium featured">{LANG_FEATURED}</span> {:IF}
                            IF("{ITEM.urgent}"=="1"){ <span class="listing-box-premium urgent">{LANG_URGENT}</span> {:IF}
                            IF("{ITEM.highlight}"=="1"){ <span class="listing-box-premium highlight">{LANG_HIGHLIGHT}</span> {:IF}

                        </div>
                        <div class="ad-listing">
                            <div class="description">
                                <div class="label label-default"><a href="{ITEM.catlink}">{ITEM.category}</a></div>
                                <h3 title="{ITEM.product_name}"><a href="{ITEM.link}">{ITEM.product_name}</a>
                                    IF("{ITEM.sub_image}"!=""){
                                    <img src="{ITEM.sub_image}" alt="{ITEM.sub_title}" title="{ITEM.sub_title}" style="width: 24px;display: inline-block;"/>
                                    {:IF}
                                </h3>
                                <h4>{ITEM.location}</h4>
                            </div>
                            <!--end description-->
                            <div class="image bg-transfer"><img src="{SITE_URL}storage/products/thumb/{ITEM.picture}"></div>
                            <!--end image-->
                        </div>
                        <div class="additional-info {ITEM.highlight_bg}">
                            <ul class="icondetail">
                                <li><i class="fa fa-th-list"></i> {LANG_SUB_CATEGORY} :
                                    <a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                </li>
                                <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM.location}</li>
                                <li><i class="fa fa-calendar"></i> {LANG_POSTED_ON} : {ITEM.created_at} </li>
                                <li><i class="fa fa-user"></i> {LANG_POSTED_BY} : <a href="{ITEM.author_link}" target="_blank">{ITEM.username}</a></li>
                            </ul>

                            <!--end controls-more-->
                        </div>
                        <!--end additional-info-->
                    </div>
                    <!--end item-->
                </div>
                {/LOOP: ITEM}

            </div>
        </div>
        <!--end gallery-->
        <div class="background-wrapper">
            <div class="background-color background-color-default">

            </div>
        </div>
        <!--end background-wrapper-->
    </section>
    <!--end block-->


    <section class="block background-is-dark" style="background: #8e8e89;">
        <div class="container">
            <div class="section-title vertical-aligned-elements">
                <div class="element text-align-right">
                    <h2 class="invisible-on-mobile pull-left featured-ads-label">{LANG_LATEST_ADS}</h2>
                    <div id="latest-nav" class="gallery-nav"></div>
                </div>
            </div>
            <!--end section-title-->
        </div>
        <div class="gallery featured container">
            <div class="owl-carousel" data-owl-items="4" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="1" data-owl-nav-container="#latest-nav">
                {LOOP: ITEM2}
                <div class="ribbon-pad">
                    <div class="item mar-left-zero" data-id="1">
                        <div class="premium">
                            IF("{ITEM2.featured}"=="1"){ <span class="listing-box-premium featured">{LANG_FEATURED}</span> {:IF}
                            IF("{ITEM2.urgent}"=="1"){ <span class="listing-box-premium urgent">{LANG_URGENT}</span> {:IF}
                            IF("{ITEM2.highlight}"=="1"){ <span class="listing-box-premium highlight">{LANG_HIGHLIGHT}</span> {:IF}

                        </div>
                        <div class="ad-listing">
                            <div class="description">
                                <div class="label label-default"><a href="{ITEM2.catlink}">{ITEM2.category}</a></div>
                                <h3 title="{ITEM2.product_name}"><a href="{ITEM2.link}">{ITEM2.product_name}</a>
                                    IF("{ITEM2.sub_image}"!=""){
                                    <img src="{ITEM2.sub_image}" alt="{ITEM2.sub_title}" title="{ITEM2.sub_title}" style="width: 24px;display: inline-block;"/>
                                    {:IF}
                                </h3>
                                <h4>{ITEM2.location}</h4>
                            </div>
                            <!--end description-->
                            <div class="image bg-transfer"><img src="{SITE_URL}storage/products/thumb/{ITEM2.picture}"></div>
                            <!--end image-->
                        </div>
                        <div class="additional-info {ITEM2.highlight_bg}">
                            <ul class="icondetail">
                                <li><i class="fa fa-th-list"></i> {LANG_SUB_CATEGORY} :
                                    <a title="{ITEM2.sub_category}" href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                                </li>
                                <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM2.location}</li>
                                <li><i class="fa fa-calendar"></i> {LANG_POSTED_ON} : {ITEM2.created_at} </li>
                                <li><i class="fa fa-user"></i> {LANG_POSTED_BY} : <a href="{ITEM2.author_link}" target="_blank">{ITEM2.username}</a></li>
                            </ul>

                            <!--end controls-more-->
                        </div>
                        <!--end additional-info-->
                    </div>
                    <!--end item-->
                </div>
                {/LOOP: ITEM2}

            </div>
        </div>
        <!--end gallery-->
        <div class="background-wrapper">
            <div class="background-color background-color-default">

            </div>
        </div>
        <!--end background-wrapper-->
    </section>
    <!--end block-->
</div>


{OVERALL_FOOTER}