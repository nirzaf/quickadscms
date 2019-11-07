{OVERALL_HEADER}
<!-- main -->
<link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/checkbox-radio.css" type="text/css" rel="stylesheet" >
<section id="main" class="clearfix category-page">
    <form method="get" action="{LINK_LISTING}" name="locationForm" id="ListingForm">
        <div class="container">
            <div class="breadcrumb-section"><!-- breadcrumb -->
                <ol class="breadcrumb">
                    <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                    <li>{MAINCATEGORY}{SUBCATEGORY}IF("{MAINCATEGORY}{SUBCATEGORY}"==""){ {LANG_ALL_CATEGORIES} {:IF}</li>
                    <div class="pull-right back-result"><a href="{LINK_INDEX}"><i class="fa fa-angle-double-left"></i>
                            {LANG_BACK_RESULT}</a>
                    </div>
                </ol>
                <!-- breadcrumb -->
            </div>
            <div class="banner">
                <!-- banner-form -->
                <div class="banner-form banner-form-full">
                    <div class="listing-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dropdown category-dropdown"><a data-toggle="dropdown" href="#"><span
                                                class="change-text">{LANG_SELECT_CATEGORY}</span><i class="fa fa-navicon"></i></a>
                                    {CAT_DROPDOWN}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="keywords" value="{KEYWORDS}"
                                       placeholder="{LANG_WHAT} ?" id="keywords" style="box-shadow: none !important;">
                            </div>
                            <div class="col-md-3 banner-icon"><i class="fa fa-map-marker"></i>
                                <input type="text" class="form-control location" id="searchStateCity" name="location"
                                       placeholder="{LANG_WHERE} ?">
                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" id="input-maincat" name="cat" value="{MAINCAT}"/>
                                <input type="hidden" id="input-subcat" name="subcat" value="{SUBCAT}"/>
                                <input type="hidden" id="input-filter" name="filter" value="{FILTER}"/>
                                <input type="hidden" id="input-sort" name="sort" value="{SORT}"/>
                                <input type="hidden" id="input-order" name="order" value="{ORDER}"/>
                                <button data-ajax-response='map' type="submit" name="Submit" class="form-control"><i
                                            class="fa fa-search"></i> {LANG_SEARCH}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- banner-form -->
            </div>
            <div class="category-info">
                <!-- Subcategory -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="sub-categories">
                            {LOOP: SUBCATLIST}
                            <div class="sub-category-container col-xs-6 col-sm-4 col-md-4 col-lg-5ths">
                                <div class="sub-category">
                                    <a href="{SUBCATLIST.link}">{SUBCATLIST.name}</a> <span class="count">({SUBCATLIST.adcount})</span>
                                </div>
                            </div>
                            {/LOOP: SUBCATLIST}
                        </div>
                    </div>
                </div>
                <!-- Subcategory -->
                <div class="row recommended-ads">
                    <div class="col-sm-3 col-md-3">

                        <div class="tg-sidebartitle"><h2>{LANG_ADVANCE_SEARCH}:</h2></div>
                        <div id="custom-field-block" class='section IF("{SHOWCUSTOMFIELD}"=="0"){ hidden {:IF}'>

                            <div id="ResponseCustomFields">
                                {LOOP: CUSTOMFIELDS}
                                    IF("{CUSTOMFIELDS.type}"=="text-field"){
                                    <div class="form-group">
                                        <label class="label-title">{CUSTOMFIELDS.title}</label>
                                        {CUSTOMFIELDS.textbox}
                                    </div>
                                {:IF}
                                    IF("{CUSTOMFIELDS.type}"=="textarea"){
                                    <div class="form-group">
                                        <label class="label-title">{CUSTOMFIELDS.title}</label>
                                        {CUSTOMFIELDS.textarea}
                                    </div>
                                {:IF}
                                    IF("{CUSTOMFIELDS.type}"=="drop-down"){
                                    <div class="form-group">
                                        <label class="label-title">{CUSTOMFIELDS.title}</label><br>
                                        <select class="form-control" name="custom[{CUSTOMFIELDS.id}]">
                                            <option value="" selected>{LANG_SELECT} {CUSTOMFIELDS.title}</option>
                                            {CUSTOMFIELDS.selectbox}
                                        </select>
                                    </div>
                                {:IF}
                                    IF("{CUSTOMFIELDS.type}"=="radio-buttons"){
                                    <div class="form-group">
                                        <label class="label-title">{CUSTOMFIELDS.title}</label><br>
                                        {CUSTOMFIELDS.radio}
                                    </div>
                                {:IF}
                                    IF("{CUSTOMFIELDS.type}"=="checkboxes"){
                                    <div class="form-group">
                                        <label class="label-title">{CUSTOMFIELDS.title}</label><br>
                                        {CUSTOMFIELDS.checkboxBootstrap}
                                    </div>
                                {:IF}
                                {/LOOP: CUSTOMFIELDS}

                                <div class="inner">
                                    <div class="form-group">
                                        <label class="label-title">{LANG_PRICE}</label>
                                        <div class="range-widget">
                                            <div class="range-inputs">
                                                <input type="text" placeholder="{LANG_FROM}" name="range1" value="{RANGE1}">
                                                <input type="text" placeholder="{LANG_TO}" name="range2" value="{RANGE2}">
                                            </div>
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="Submit" class="btn tg-btn" id="advance-search-btn" style="padding: 0 40px;">{LANG_ADVANCE_SEARCH}</button>
                            </div>

                        </div>


                    </div>

                    IF("{POST_PREMIUM_LISTING}"=="0"){
                    <style>
                        #premium_featured{ display: none !important;}
                        #premium_urgent{ display: none !important;}
                    </style>
                    {:IF}
                    <div class="col-sm-9 col-md-9">
                        <div class="section allAd">
                            <!-- featured-top -->
                            <div class="featured-top" id="listing-filter">
                                <div class="tab-box ">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" id="quick-filter">
                                        <li role="presentation" IF("{FILTER}"==""){ class="active" {:IF}><a href="#" data-filter-type="filter" data-filter-val="">{LANG_FIND_ADS}
                                        <span class="badge">{TOTALADSFOUND}</span></a></li>
                                        <li role="presentation" id="premium_featured" IF("{FILTER}"=="featured"){ class="active" {:IF}><a href="#" data-filter-type="filter" data-filter-val="featured">{LANG_FEATURED}
                                        <span class="badge"> {FEATUREDFOUND} </span></a></li>
                                        <li role="presentation" id="premium_urgent" IF("{FILTER}"=="urgent"){ class="active" {:IF}><a href="#" data-filter-type="filter" data-filter-val="urgent">{LANG_URGENT}
                                        <span class="badge"> {URGENTFOUND} </span></a></li>
                                        <div class="dropdown pull-right">
                                            <!-- category-change -->
                                            <div class="dropdown category-dropdown">
                                                <h5>{LANG_SORT_BY}:</h5>
                                                <a id="sort-dropdown" data-toggle="dropdown" href="#"><span
                                                        class="change-text">
                                                        IF("{SORT}"==""){ {LANG_NEWEST} {:IF}
                                                        IF("{SORT}"=="id"){ {LANG_NEWEST} {:IF}
                                                        IF("{SORT}"=="title"){ {LANG_NAME} {:IF}
                                                        IF("{SORT}"=="date"){ {LANG_DATE} {:IF}
                                                        IF("{SORT}"=="price"){ {LANG_PRICE} {:IF}
                                                    </span><i
                                                        class="fa fa-caret-square-o-down"></i></a>
                                                <ul class="dropdown-menu category-change">
                                                    <li><a href="#" data-filter-type="sort" data-filter-val="id" data-order="desc">{LANG_NEWEST}</a>
                                                    </li>
                                                    <li><a href="#" data-filter-type="sort" data-filter-val="title" data-order="desc">{LANG_NAME}</a>
                                                    </li>
                                                    <li><a href="#" data-filter-type="sort" data-filter-val="date" data-order="desc">{LANG_DATE}</a>
                                                    </li>
                                                    <li><a href="#" data-filter-type="sort" data-filter-val="price" data-order="desc">{LANG_PRICE}:
                                                        {LANG_HIGH_TO_LOW}</a></li>
                                                    <li><a href="#" data-filter-type="sort" data-filter-val="price" data-order="asc">{LANG_PRICE}:
                                                        {LANG_LOW_TO_HIGH}</a></li>
                                                </ul>
                                            </div>
                                            <!-- category-change -->
                                        </div>
                                    </ul>
                                </div>
                                <div class="filter-section">
                                    <h2>
                                        IF("{FILTER}"==""){ {LANG_ALL_ADS} {:IF}
                                        IF("{FILTER}"=="featured"){ {LANG_FEATURED_AD} {:IF}
                                        IF("{FILTER}"=="urgent"){ {LANG_URGENT_ADS} {:IF}
                                    </h2>

                                    <div class="sorting well">
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn" id="list"><i class="fa fa-th-list fa-white icon-white"></i></button>
                                            <button type="button" class="btn" id="grid"><i class="fa fa-th fa"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- featured-top -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="allad">
                                    <div class="" id="serchlist">
                                        <div class="searchresult list " style="display: none;">
                                            {LOOP: ITEM}
                                                <!-- quick-item -->
                                            <div class="quick-item row">
                                                <!-- item-image -->
                                            <div class="ad-listing">
                                                <div class="image bg-transfer">
                                                    <figure>
                                                        <div class="item-badges">
                                                            IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                                            IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                                                        </div>
                                                    </figure>
                                                    <img src="{SITE_URL}storage/products/thumb/{ITEM.picture}"
                                                         alt="{ITEM.product_name}"></div>
                                                <div class="item-info col-sm-12 {ITEM.highlight_bg}">
                                                    <!-- ad-info -->
                                                    <div class="ad-info">
                                                        <h4 class="item-title">
                                                            IF("{ITEM.sub_image}"!=""){
                                                            <img src="{ITEM.sub_image}" width="24px" alt="{ITEM.sub_title}" title="{ITEM.sub_title}"/>
                                                            {:IF}
                                                            <a href="{ITEM.link}">{ITEM.product_name}</a>
                                                        </h4>
                                                        <ul class="contact-options pull-right" id="set-favorite">
                                                            <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}"
                                                                   data-action="setFavAd"
                                                                   class="fav_{ITEM.id} fa fa-heart IF("{ITEM.favorite}"=="1"){ active {:IF}"></a></li>
                                                        </ul>
                                                        <ol class="breadcrumb">
                                                            <li><a href="{ITEM.catlink}">{ITEM.category}</a></li>
                                                            <li><a href="{ITEM.subcatlink}">{ITEM.sub_category}</a></li>
                                                        </ol>
                                                        <ul class="item-details">
                                                            <li><i class="fa fa-map-marker"></i><a href="{ITEM.citylink}">{ITEM.city}</a>
                                                            </li>
                                                            <li><i class="fa fa-clock-o"></i>{ITEM.created_at}</li>
                                                        </ul>
                                                        IF("{ITEM.price}"!="0"){ <span class="item-price"> {ITEM.price} </span> {:IF}

                                                        <div><a class="view-btn" href="{ITEM.link}">{LANG_VIEW_AD}</a></div>
                                                    </div>
                                                    <!-- ad-info -->
                                                </div>
                                                <!-- item-info -->
                                            </div>
                                        </div>
                                            <!-- quick-item -->
                                            {/LOOP: ITEM}
                                        </div>
                                        <div class="searchresult grid" style="display: none;">
                                            <div class="gird-layout row">
                                                {LOOP: ITEM2}
                                                <div class="col-md-4 col-sm-6 col-xs-12 mar-bot-10 clear-left-3">
                                                    <div style="border: 1px solid #f3f3f3;">
                                                        <div class="item-image-box">
                                                            <div class="item-image"><a href="{ITEM2.link}"><img src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="{ITEM2.product_name}" class=""></a>

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
                                                                <h4 class="item-title">
                                                                    IF("{ITEM2.sub_image}"!=""){
                                                                    <img src="{ITEM2.sub_image}" width="24px" alt="{ITEM2.sub_title}" title="{ITEM2.sub_title}"/>
                                                                    {:IF}
                                                                    <a href="{ITEM2.link}">{ITEM2.product_name}</a>
                                                                </h4>
                                                                <ol class="breadcrumb">
                                                                    <li><a href="{ITEM2.catlink}">{ITEM2.category}</a></li>
                                                                    <li><a href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                                                                    </li>
                                                                </ol>
                                                                <ul class="item-details">
                                                                    <li><i class="fa fa-map-marker"></i><a href="{ITEM2.citylink}">{ITEM2.city}</a></li>
                                                                    <li><i class="fa fa-clock-o"></i>{ITEM2.created_at}</li>
                                                                </ul>
                                                                <div class="ad-meta">
                                                                    IF("{ITEM2.price}"!="0"){ <span class="item-price"> {ITEM2.price} </span> {:IF}
                                                                    <ul class="contact-options pull-right" id="set-favorite">
                                                                        <li>
                                                                            <a href="#" data-item-id="{ITEM2.id}"
                                                                               data-userid="{USER_ID}" data-action="setFavAd"
                                                                               class="fav_{ITEM2.id} fa fa-heart IF("
                                                                               {ITEM2.favorite}"=="1"){ active {:IF}"></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- ad-info -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- quick-item -->
                                                {/LOOP: ITEM2}
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        IF("{ADSFOUND}"=="0"){
                                        <h4> {LANG_NO_RESULT_FOUND} : {PAGETITLE}.</h4><br>

                                        {:IF}
                                        <!-- Pagination-->
                                        <div class="pagination-container">
                                            <ul class="pagination">
                                                {LOOP: PAGES}
                                                IF("{PAGES.current}"=="0"){
                                                <li><a href="{PAGES.link}">{PAGES.title}</a></li>
                                                {:IF}
                                                IF("{PAGES.current}"=="1"){
                                                <li class="active"><a>{PAGES.title}</a></li>
                                                {:IF}
                                                {/LOOP: PAGES}
                                            </ul>
                                        </div>
                                        <!-- Pagination-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- container -->
    </form>
</section>
<!-- main -->

<script type="text/javascript">
    $(document).ready(function () {
        $(".current").addClass("active");
        if ($('.getParent').length > 0) {
            $('.getParent').parent().addClass('in');
        }
    });

    $('#listing-filter').on('click', '#quick-filter li a', function (e) {
        var $item = $(this).closest('a');

        var filtertype = $item.data('filter-type');
        var filterval = $item.data('filter-val');
        $('#input-' + filtertype).val(filterval);
        $('#input-order').val($item.data('order'));
        $('#ListingForm').submit();
    });

    var getMaincatId = '{MAINCAT}';
    var getSubcatId = '{SUBCAT}';

    $(window).bind("load", function () {
        if (getMaincatId != "") {
            $('li a[data-cat-type="maincat"][data-ajax-id="' + getMaincatId + '"]').trigger('click');
        } else if (getSubcatId != "") {
            $('li ul li a[data-cat-type="subcat"][data-ajax-id="' + getSubcatId + '"]').trigger('click');
        } else {
            $('li a[data-cat-type="all"]').trigger('click');
        }
    });
    var loginurl = "{LINK_LOGIN}?ref=listing"</script>


{OVERALL_FOOTER}