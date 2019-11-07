<!DOCTYPE html>
<html lang="{LANG_CODE}" dir="{LANGUAGE_DIRECTION}">
<head>
    <title>{PAGE_TITLE} - {SITE_TITLE}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{SITE_TITLE}">
    <meta name="keywords" content="{META_KEYWORDS}">
    <meta name="description" content="{META_DESCRIPTION}">

    <meta property="fb:app_id" content="{FACEBOOK_APP_ID}" />
    <meta property="og:site_name" content="{SITE_TITLE}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:url" content="{LINK_POST-AD}" />
    <meta property="og:title" content="{PAGE_TITLE}" />
    <meta property="og:description" content="{META_DESCRIPTION}" />
    <meta property="og:type" content="website" />
    <meta property="twitter:card" content="summary">
    <meta property="twitter:title" content="{PAGE_TITLE}">
    <meta property="twitter:description" content="{META_DESCRIPTION}">
    <meta property="twitter:domain" content="{SITE_URL}">
    <link rel="shortcut icon" href="{SITE_URL}storage/logo/{SITE_FAVICON}">

    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap.min.css">


    <!-- Render-blocking styles -->
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/base.css" type="text/css" rel="stylesheet" />
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/PageLoggedOutPostAd.css" type="text/css" rel="stylesheet" />
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/styles.css" type="text/css" rel="stylesheet">
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/ModalDeferredLogin.less" type="text/css" rel="stylesheet">

    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/file-uploader.css" type="text/css" rel="stylesheet" />
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/checkbox-radio.css" type="text/css" rel="stylesheet" >
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/category-modal.css" type="text/css" rel="stylesheet">
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/owl.post.carousel.css" type="text/css" rel="stylesheet">
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/loader.css" type="text/css" rel="stylesheet">

    <link href="{SITE_URL}templates/{TPL_NAME}/css/flags/flags.min.css" type="text/css" rel="stylesheet">

    <!-- Template Developed By Bylancer -->
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery-2.2.1.min.js'></script>



    IF("{LANGUAGE_DIRECTION}"=="rtl"){
    <link href="{SITE_URL}templates/{TPL_NAME}/css/post-ad/post-rtl.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-rtl.min.css">
    {:IF}
    <!-- orakuploader -->
    <link type="text/css" href="{SITE_URL}plugins/orakuploader/orakuploader.css" rel="stylesheet"/>
    <script type="text/javascript" src="{SITE_URL}plugins/orakuploader/jquery.min.js"></script>
    <script type="text/javascript" src="{SITE_URL}plugins/orakuploader/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{SITE_URL}plugins/orakuploader/orakuploader.js"></script>
    IF("{LANGUAGE_DIRECTION}"=="rtl"){
    <link type="text/css" href="{SITE_URL}plugins/orakuploader/orakuploader-rtl.css" rel="stylesheet"/>
    {:IF}
    <!-- orakuploader -->
    IF("{POST_WATERMARK}"=="1"){
    <script>
        var watermark_image = 'storage/logo/watermark.png';
    </script>
    {:IF}
    IF("{POST_WATERMARK}"=="0"){
    <script>
        var watermark_image = '';
    </script>
    {:IF}
    <script>
        var ajaxurl = "{APP_URL}user-ajax.php";
        var lang_edit_cat = "{LANG_EDIT_CATEGORY}";
        var lang_upload_images = "{LANG_UPLOAD_IMAGES}";
        var siteurl = '{SITE_URL}';
        var template_name = '{TPL_NAME}';
        var max_image_upload = '{MAX_IMAGE_UPLOAD}';

        // Language Var
        var LANG_MAIN_IMAGE = "{LANG_MAIN_IMAGE}";
        var LANG_LOGGED_IN_SUCCESS = "{LANG_LOGGED_IN_SUCCESS}";
        var LANG_ERROR_TRY_AGAIN = "{LANG_ERROR_TRY_AGAIN}";
        var LANG_HIDDEN = "{LANG_HIDDEN}";
        var LANG_ERROR = "{LANG_ERROR}";
        var LANG_CANCEL = "{LANG_CANCEL}";
        var LANG_DELETED = "{LANG_DELETED}";
        var LANG_ARE_YOU_SURE = "{LANG_ARE_YOU_SURE}";
        var LANG_YOU_WANT_DELETE = "{LANG_YOU_WANT_DELETE}";
        var LANG_YES_DELETE = "{LANG_YES_DELETE}";
        var LANG_AD_DELETED = "{LANG_AD_DELETED}";
        var LANG_SHOW = "{LANG_SHOW}";
        var LANG_HIDE = "{LANG_HIDE}";
        var LANG_HIDDEN = "{LANG_HIDDEN}";
        var LANG_ADD_FAV = "{LANG_ADD_FAVOURITE}";
        var LANG_REMOVE_FAV = "{LANG_REMOVE_FAVOURITE}";
        var LANG_SELECT_CITY = "{LANG_SELECT_CITY}";
        $(document).ready(function(){
            // -------------------------------------------------------------
            //  Intialize orakuploader
            // -------------------------------------------------------------
            $('#item_screen').orakuploader({
                site_url :  siteurl,
                orakuploader_path : 'plugins/orakuploader/',
                orakuploader_main_path : 'storage/products',
                orakuploader_thumbnail_path : 'storage/products/thumb',
                orakuploader_add_image : siteurl+'plugins/orakuploader/images/add.svg',
                orakuploader_watermark : watermark_image,
                orakuploader_add_label : lang_upload_images,
                orakuploader_use_main : true,
                orakuploader_use_sortable : true,
                orakuploader_use_dragndrop : true,
                orakuploader_use_rotation: true,
                orakuploader_resize_to : 800,
                orakuploader_thumbnail_size  : 250,
                orakuploader_maximum_uploads : max_image_upload,
                orakuploader_max_exceeded : max_image_upload,
                orakuploader_hide_on_exceed : true,
                orakuploader_main_changed    : function (filename) {
                    $("#mainlabel-images").remove();
                    $("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
                },
                orakuploader_max_exceeded : function() {
                    alert("You exceeded the max. limit of "+max_image_upload+" images.");
                }
            });
        });
    </script>
    <script>
        $('body').toggleClass('loaded');
        $(document).ready(function() {
            setTimeout(function(){
                $('body').addClass('loaded');
            }, 3000);

        });
    </script>
</head>
<body data-role="page" class="{LANGUAGE_DIRECTION}">
<div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
<!-- /.modal -->

<!-- Change Country Modal -->
<div class="modal fade modalHasList" id="selectCountry" tabindex="-1" role="dialog" aria-labelledby="selectCountryLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{LANG_CLOSE}</span>
                </button>
                <h4 class="modal-title uppercase font-weight-bold" id="selectCountryLabel">
                    <i class="icon-map"></i> {LANG_SELECT_YOUR_COUNTRY}
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="row" style="padding: 0 20px">
                        <ul class="column col-md-12 col-sm-12 cities">
                            {LOOP: COUNTRYLIST}
                                <li><span class="flag flag-{COUNTRYLIST.lowercase_code}"></span><a href="{LINK_POST-AD}/{COUNTRYLIST.lang}/{COUNTRYLIST.lowercase_code}" data-id="{COUNTRYLIST.id}" data-name="{COUNTRYLIST.name}">{COUNTRYLIST.name}</a></li>
                            {/LOOP: COUNTRYLIST}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Change Country Modal -->
<!-- Select Category Modal -->
<div class="modal fade tg-thememodal tg-categorymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog tg-thememodaldialog" role="document">
        <button type="button" id="dismiss-modal" class="tg-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content tg-thememodalcontent">
            <div class="tg-title">
                <strong>{LANG_SELECT_CATEGORY}</strong>
            </div>
            <div id="tg-dbcategoriesslider" class="tg-dbcategoriesslider tg-categories owl-carousel select-category post-option">
                {LOOP: CATEGORY}
                    <div class="tg-category {CATEGORY.selected}" data-ajax-catid="{CATEGORY.id}" data-ajax-action="getsubcatbyidList" data-cat-name="{CATEGORY.name}">
                        <div class="tg-categoryholder">
                            IF("{CATEGORY.picture}"==""){
                            <div><i class="{CATEGORY.icon}"></i></div>
                            {:IF}
                            IF("{CATEGORY.picture}"!=""){
                            <div><img src="{CATEGORY.picture}"/></div>
                            {:IF}
                            <h3><a href="#">{CATEGORY.name}</a></h3>
                        </div>
                    </div>
                {/LOOP: CATEGORY}

            </div>
            <ul class="tg-subcategories" style="display: none">
                <li>
                    <div class="tg-title">
                        <strong>{LANG_SELECT_SUBCATEGORY}</strong><div id="sub-category-loader" style="visibility:hidden"></div>
                    </div>
                    <div class=" tg-verticalscrollbar tg-dashboardscrollbar">
                        <ul id="sub_category">

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Select Category Modal -->
<!-- Link to existing Quickad account -->
<div class="quickad-template">
    <div class="responsive-modal hide" id="post_ad_email_exist">
        <section class="FacebookSignUpModal modal fb-bs-identifier">
            <header class="FacebookSignUpModal-header modal-header">
                <a class="close FacebookSignUpModal-close close-fb-modal-bs" data-dismiss="modal">
                    <span>&times;</span>
                </a>
                <h3 id="link_account_welcome" class="FacebookSignUpModal-heading" style="display: block">
                    {LANG_LINK_EXIST_ACCOUNT}
                </h3>
                <h3 id="link_account_success" class="FacebookSignUpModal-heading" style="display: none">
                    {LANG_LINK_ACCOUNT_SUCCESS}
                </h3>
                <div id="link_account_error" class="FacebookSignUpModal-heading text-danger" style="display: none">{LANG_USERNOTFOUND}</div>
            </header>

            <div class="modal-body" id="fb-modal-body">
                <div class="FacebookSignUpModal-content">
                    <div id="post_loading" class="modal-loader Loader Loader--full" style="display: none"></div>

                    <!-- Link To Existing Account -->
                    <form class="FacebookSignUpModal-form fl-form" style="display:block">
                        <div class="form-step">
                            <p>
                                <span id="quickad_email_already_linked"></span>
                                <br>
                                <span>{LANG_ENTER_PASS_LINK_AC}</span>
                            </p>
                        </div>
                        <div class="form-step">
                            <label>{LANG_USERNAME}:</label>
                            <div id="quickad_username_display"></div>
                        </div>
                        <div class="form-step">
                            <label>{LANG_EMAIL}:</label>
                            <div id="quickad_email_display"></div>
                        </div>
                        <div class="form-step">
                            <input type="hidden">
                            <label>{LANG_PASSWORD}:</label>
                            <input type="password" class="default-input" id="password" name="password">
                            <p>
                                <a href="{LINK_LOGIN}?fstart=1" target="_blank" id="fb_forgot_password_btn">
                                    <small>{LANG_FORGOTPASS}</small>
                                </a>
                            </p>
                        </div>
                        <div class="link-account-error alert alert-error" style="display:none"></div>
                        <div class="form-step">
                            <input type="hidden" name="email" id="email" value=""/>
                            <input type="hidden" name="username" id="username" value=""/>
                            <button id="link_account" type="button" value="Submit" class="btn btn-info FacebookSignUpModal-ctaButton">
                                {LANG_LINK_ACCOUNT}
                            </button>
                            <div class="FacebookSignUpModal-loader Loader Loader--full fb_submit_loading" style="display:none;" ></div>
                        </div>
                    </form>

                    <!-- Error -->
                    <div id="post_error_div" style="display:none">
                        <div id="post_error_content">

                        </div>
                        <button class="fbCloseBtn btn FacebookSignUpModal-ctaButton">{LANG_CLOSE}</button>
                    </div>

                </div>
            </div>
        </section>
        <div id="facebookConnect-backdrop" class="modal-backdrop"></div>
    </div>
</div>
<!-- Link to existing Quickad account -->

<!-- Premium Ad -->
<div class="quickad-template">
    <div class="responsive-modal hide" id="premium_ad_modal">
        <section class="FacebookSignUpModal modal fb-bs-identifier">
            <header class="FacebookSignUpModal-header modal-header">
                <a class="close FacebookSignUpModal-close close-fb-modal-bs" data-dismiss="modal"><span>&times;</span></a><br>
            </header>

            <div class="modal-body">
                <div class="ModalPayment-body">
                    <div id="post_loading" class="modal-loader Loader Loader--full" style="display: none"></div>
                    <figure class="ModalPayment-figure">
                        <img class="ModalPayment-image" src="{SITE_URL}templates/{TPL_NAME}/images/secure-payment.png" alt="Secure Payment">
                    </figure>
                    <div class="ModalPayment-heading">{LANG_CONFIRM_PAYMENT}</div>

                    <div class="ModalPayment-subHeading">{LANG_UPGRADES}</div>
                    <div id="display_premium_tpl">

                    </div>

                </div>
                <div class="ModalPayment-footer">
                    <p>{LANG_CONFIRM_PAYMENT_TEXT}</p>
                    <button id="paymentModalConfirmButton" class="btn btn-large btn-success ModalPayment-footer-btn">{LANG_CONFIRM_PAYMENT}</button>
                </div>
            </div>
        </section>
        <div id="facebookConnect-backdrop" class="modal-backdrop"></div>
    </div>
</div>
<!-- Premium Ad -->
<!-- /.modal -->

<div class="quickad-template">
    <main id="main" class="main-content" id="page" data-ipapi="GPS">
        <section class="PagePostProject">
            <div class="PagePostProject-container container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="PagePostProject-bg-container">
                            <div class="PagePostProject-bg">
                                <div class="PagePostProject-bg-shape PagePostProject-bg-shape--one"></div>
                                <div class="PagePostProject-bg-shape PagePostProject-bg-shape--two"></div>
                                <div class="PagePostProject-bg-shape PagePostProject-bg-shape--three"></div>
                            </div>
                        </div>
                        <header class="PagePostProject-header">
                            <div class="PagePostProject-logo">
                                <!-- LOGO HERE -->
                                <a href="{LINK_INDEX}">
                                    <img class="img-responsive" src="{SITE_URL}storage/logo/{SITE_LOGO}" alt="Logo">
                                </a>
                                IF("{COUNTRY_TYPE}"=="multi"){
                                <button class="flag-menu country-flag btn btn-default" id="#selectCountry" data-toggle="modal" data-target="#selectCountry" style="margin-left: 20px">
                                    <img src="{SITE_URL}templates/{TPL_NAME}/images/flags/{USER_COUNTRY}.png" style="float: left;">
                                </button>
                                {:IF}
                            </div>

                            <div id="post_success_uploaded" class="middle-container" style="display: none">
                                <div class="middle-dabba">
                                    <h1>{LANG_SUCCESS}!</h1>

                                    <p>{LANG_ADSUCCESS}</p>
                                </div>
                            </div>

                            <div id="ad_post_title">
                                <h1 class="PagePostProject-header-title">{LANG_POST_ADVERTISE}</h1>
                                <p class="PagePostProject-header-desc">
                                    {LANG_POST_ADVERTISE_QUTO}
                                </p>
                            </div>
                        </header>


                        <fl-project-form id="ad_post_form">
                            <div id="post_error">

                            </div>
                            <form class="fl-form" action="{LINK_POST-AD}?action=post_ad" id="post-advertise-form" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                <div class="form-group text-center">
                                    <a href="#" id="choose-category" class="tg-btn" data-toggle="modal" data-target=".tg-categorymodal">{LANG_CHOOSE_CATEGORY}</a>
                                </div>
                                <div class="form-group selected-product" id="change-category-btn" style='display: none'>
                                    <ul class="select-category list-inline">
                                        <li id="main-category-text"></li>
                                        <li id="sub-category-text"></li>
                                        <li class="active"><a href="#" data-toggle="modal" data-target=".tg-categorymodal"><i class="fa fa-pencil-square-o"></i> {LANG_EDIT}</a></li>
                                    </ul>

                                    <input type="hidden" id="input-maincatid" name="catid" value="">
                                    <input type="hidden" id="input-subcatid" name="subcatid" value="">
                                </div>
                                <ol>
                                <li>
                                    <fieldset class="PagePostProject-fieldset">
                                        <legend class="PagePostProject-legend">{LANG_AD_TITLE} *</legend>
                                        <ol>
                                            <li class="form-step">
                                                <input type="text" class="large-input focusable-field" placeholder="{LANG_AD_TITLE}" name="title" value="">
                                                <div class="ng-active hidden">
                                                    <div class="form-error"></div>
                                                </div>
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset class="PagePostProject-fieldset">
                                        <legend class="PagePostProject-legend">{LANG_DESCRIPTION} *</legend>
                                        <ol>
                                            <li class="form-step">
                                                <textarea class="large-textarea focusable-field" id="pageContent" placeholder="{LANG_AD_DESCRIPTION}..." name="content" rows="3"></textarea>
                                            </li>
                                        </ol>
                                    </fieldset>
                                </li>



                                <li id="quickad-photo-field">
                                    <fieldset class="PagePostProject-fieldset">
                                        <div id="item_screen" orakuploader="on"></div>
                                    </fieldset>
                                </li>

                                <li style="padding-bottom: 20px;">
                                    <fieldset class="PagePostProject-fieldset">
                                        <legend class="PagePostProject-legend">{LANG_ADDITIONAL_INFO}</legend>
                                    </fieldset>

                                    <div id='custom-field-block IF("{SHOWCUSTOMFIELD}"!="1"){ hidden {:IF}'>
                                        <div id="ResponseCustomFields">
                                            {LOOP: CUSTOMFIELDS}
                                                IF("{CUSTOMFIELDS.type}"=="text-field"){
                                                <div class="row form-group {CUSTOMFIELDS.title}">
                                                    <label class="col-sm-3 label-title">{CUSTOMFIELDS.title}</label>
                                                    <div class="col-sm-9">{CUSTOMFIELDS.textbox}</div>
                                                </div>
                                            {:IF}
                                                IF("{CUSTOMFIELDS.type}"=="textarea"){
                                                <div class="row form-group {CUSTOMFIELDS.title}">
                                                    <label class="col-sm-3 label-title">{CUSTOMFIELDS.title}</label>
                                                    <div class="col-sm-9">{CUSTOMFIELDS.textarea}</div>
                                                </div>
                                            {:IF}
                                            IF("{CUSTOMFIELDS.type}"=="drop-down"){
                                            <div class="row form-group {CUSTOMFIELDS.title}">
                                                <label class="col-sm-3 label-title">{CUSTOMFIELDS.title}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="custom[{CUSTOMFIELDS.id}]" {CUSTOMFIELDS.required}>
                                                        <option value="" selected>{LANG_SELECT} {CUSTOMFIELDS.title}</option>
                                                        {CUSTOMFIELDS.selectbox}
                                                    </select>
                                                </div>
                                            </div>
                                            {:IF}
                                                IF("{CUSTOMFIELDS.type}"=="radio-buttons"){
                                                <div class="row form-group {CUSTOMFIELDS.title}">
                                                    <label class="col-sm-3 label-title">{CUSTOMFIELDS.title}</label>
                                                    <div class="col-sm-9">{CUSTOMFIELDS.radio}</div>
                                                </div>
                                            {:IF}
                                                IF("{CUSTOMFIELDS.type}"=="checkboxes"){
                                                <div class="row form-group {CUSTOMFIELDS.title}">
                                                    <label class="col-sm-3 label-title">{CUSTOMFIELDS.title}</label>
                                                    <div class="col-sm-9">
                                                        {CUSTOMFIELDS.checkboxBootstrap}
                                                    </div>
                                                </div>
                                            {:IF}
                                            {/LOOP: CUSTOMFIELDS}
                                        </div>
                                    </div>

                                    <div class="row form-group" id="quickad-price-field">
                                        <label class="col-sm-3 label-title">{LANG_PRICE} </label>
                                        <div class="col-sm-9">
                                            <div class="input-group custom-input-group">
                                                <span class="input-group-addon currency-adon">{USER_CURRENCY_SIGN}</span>
                                                <input type="text" class="form-control" placeholder="e.g. 1000" name="price">
                                            </div>
                                            <label class="btn border-left-zero label-adon">
                                                <input type="checkbox" name="negotiable" id="negotiable"
                                                       class="FacebookSignUpModal-radio" value="1">{LANG_NEGOTIATE}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 label-title">{LANG_MOB_NO} </label>
                                        <div class="col-sm-9">
                                            <div class="input-group custom-input-group">
                                                        <span class="input-group-addon" style="padding: 4px 10px;">
                                                            <img src="{SITE_URL}templates/{TPL_NAME}/images/flags/{USER_COUNTRY}.png">
                                                        </span>
                                                <input type="text" class="form-control" placeholder="e.g. 987654321" name="phone">
                                            </div>
                                            <label class="btn border-left-zero label-adon">
                                                <input type="checkbox" name="hide_phone" id="phone"
                                                       class="FacebookSignUpModal-radio" value="1">{LANG_HIDE}
                                            </label>
                                        </div>
                                    </div>
                                    IF("{POST_TAGS_MODE}"=="1"){
                                    <div class="row form-group">
                                        <label class="col-sm-3 label-title">{LANG_TAGS} </label>
                                        <div class="col-sm-9">
                                            <input name="tags" class="form-control" type="text" value="" placeholder="{LANG_TAGS}">
                                            <span>{LANG_TAGS_DETAIL}</span>
                                        </div>
                                    </div>
                                    {:IF}
                                </li>
                                <li>
                                    <fieldset class="PagePostProject-fieldset">
                                        <legend class="PagePostProject-legend">{LANG_CITY} *</legend>
                                        <ol>
                                            <li class="form-step">
                                                <select id="postadcity" name="city" class="large-input focusable-field" lang="ar">
                                                    <option value="0" selected="selected">{LANG_SELECT_CITY}</option>
                                                </select>
                                            </li>
                                        </ol>
                                    </fieldset>



                                    <fieldset class='PagePostProject-fieldset IF("{POST_ADDRESS_MODE}"!="1"){ hidden {:IF}'>
                                        <legend class="PagePostProject-legend">{LANG_ADDRESS}</legend>
                                        <ol>
                                            <li class="form-step">
                                                <div class="tg-inputwithicon">
                                                    <div class="geo-location"><i class="fa fa-crosshairs"></i></div>
                                                    <input type="text" class="large-input focusable-field" placeholder="{LANG_AD_LOCATION}" name="location" id="address-autocomplete">
                                                    <input type="hidden" id="latitude" name="latitude"  value="{LATITUDE}"/>
                                                    <input type="hidden" id="longitude" name="longitude" value="{LONGITUDE}"/>
                                                    <div class="map height-200px shadow" id="map"></div>
                                                    <p class="note" style="opacity: 1">{LANG_DRAG_MAP_MARKER}.</p>
                                                </div>
                                            </li>
                                        </ol>
                                    </fieldset>

                                </li>

                                IF("{LOGGED_IN}"=="0"){
                                <li>
                                    <fieldset class="PagePostProject-fieldset" style="margin-bottom: 20px">
                                        <legend class="PagePostProject-legend">{LANG_SELLER_INFO} *</legend>
                                    </fieldset>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <fieldset class="PagePostProject-fieldset">
                                                <ol>
                                                    <li class="form-step">
                                                        <label>{LANG_SELLER_NAME}</label>
                                                        <input type="text" class="large-input focusable-field" placeholder="{LANG_SELLER_NAME}" name="seller_name">
                                                    </li>
                                                </ol>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <fieldset class="PagePostProject-fieldset">
                                                <ol>
                                                    <li class="form-step">
                                                        <label>{LANG_SELLER_EMAIL}</label>
                                                        <input type="text" class="large-input focusable-field" placeholder="{LANG_SELLER_EMAIL}" name="seller_email">
                                                    </li>
                                                </ol>
                                            </fieldset>
                                        </div>
                                    </div>


                                </li>
                                {:IF}

                                <!-- PACKAGE -->
                                <li>
                                    <div class='NumberedForm-content  IF("{POST_PREMIUM_LISTING}"=="0"){ hidden {:IF}'>
                                        <fieldset class="PagePostProject-fieldset">
                                            <legend class="PagePostProject-legend">{LANG_MAKE_PREMIUM} {LANG_OPTIONAL}</legend>
                                            <div class="PagePostProject-optionalTabs">
                                                <ul class="PagePostProject-optionalTabs-list">
                                                    <li class="PagePostProject-optionalTabs-item">
                                                        <input type="radio" id="standard" name="optional-upgrades" value="free" class="PagePostProject-selectableCard-input PagePostProject-optionalTabs-input ng-valid ng-dirty ng-touched">
                                                        <label for="standard" class="PagePostProject-selectableCard-label PagePostProject-optionalTabs-label">
                                                            <img class="PagePostProject-optionalTabs-icon" alt="decoration" src="{SITE_URL}templates/{TPL_NAME}/images/standard-project-icon.svg">
                                                            <div class="PagePostProject-optionalTabs-copy">
                                                                <h4 class="PagePostProject-optionalTabs-heading">{LANG_FREE_AD}</h4>
                                                                <p class="PagePostProject-optionalTabs-intro">{LANG_CHECK_BY_TEAM}</p>
                                                            </div>
                                                            <div class="PagePostProject-optionalTabs-price PagePostProject-optionalTabs-price--large"><strong>{LANG_FREE}</strong></div>
                                                        </label>
                                                    </li>
                                                    <li class="PagePostProject-optionalTabs-item ">
                                                        <input type="radio" id="advanced" name="optional-upgrades" value="premium" class="PagePostProject-selectableCard-input PagePostProject-optionalTabs-input">
                                                        <label for="advanced" class="PagePostProject-selectableCard-label PagePostProject-optionalTabs-label">
                                                            <img class="PagePostProject-optionalTabs-icon" alt="decoration" src="{SITE_URL}templates/{TPL_NAME}/images/recruiter-icon.svg">
                                                            <div class="PagePostProject-optionalTabs-copy">
                                                                <h4 class="PagePostProject-optionalTabs-heading" >{LANG_PREMIUM} <span class="PagePostProject-optionalTabs-promotion">{LANG_RECOMMENDED}</span></span></h4>
                                                                <p class="PagePostProject-optionalTabs-intro">{LANG_UPGRADE_TEXT_INFO}</p>

                                                                <div class="PagePostProject-optionalTabs-content">
                                                                    <div class="PagePostProject-optionalTabs-content-inner">
                                                                        <table class="UpgradeListing">
                                                                            <tbody class="UpgradeListing-body">
                                                                            <!-- FEATURED UPGRADE -->
                                                                            <tr id="project-upgrade-item-featured" class="UpgradeListing-option">
                                                                                <td class="UpgradeListing-info">
                                                                                    <div class="Checkbox">
                                                                                        <input type="checkbox" name="featured" class="Checkbox-input focusable-field" id="featured" onclick="fillPrice(this,{FEATURED_FEE});">
                                                                                        <label class="UpgradeListing-checkbox Checkbox-label Checkbox-label--large" for="featured">
                                                                                            <span class="Checkbox-addIcon"></span>
                                                                                        </label>
                                                                                        <div class="UpgradeListing-tags">
                                                                                            <span class="UpgradeListing-promoTag promotion-tag has-no-icon promotion-featured">
                                                                                                {LANG_FEATURED}
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td class="UpgradeListing-intro">
                                                                                    <p class="UpgradeListing-desc">{LANG_FEATURED_AD_TEXT}</p>
                                                                                </td>

                                                                                <td class="UpgradeListing-price js-upgrade-price">
                                                                                    <div id="priced_featured_upgrade_block" class="UpgradeListing-price-value">
                                                                                        <span id="featured-upgrade-price">{CURRENCY_SIGN}{FEATURED_FEE} {LANG_FOR} {FEATURED_DURATION} {LANG_DAYS}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- URGENT UPGRADE -->
                                                                            <tr id="project-upgrade-item-urgent" class="UpgradeListing-option" data-robots="ProjectUpgradeUrgent">
                                                                                <td class="UpgradeListing-info">
                                                                                    <div class="Checkbox">
                                                                                        <input type="checkbox" name="urgent" data-name="urgent" class="Checkbox-input focusable-field" id="urgent" onclick="fillPrice(this,{URGENT_FEE});">
                                                                                        <label class="UpgradeListing-checkbox Checkbox-label Checkbox-label--large" for="urgent">
                                                                                            <span class="Checkbox-addIcon"></span>
                                                                                        </label>
                                                                                        <div class="UpgradeListing-tags">
                                                                                                                <span class="UpgradeListing-promoTag promotion-tag has-no-icon promotion-assisted">
                                                                                                                    {LANG_URGENT}
                                                                                                                </span>
                                                                                        </div>
                                                                                    </div>

                                                                                </td>

                                                                                <td class="UpgradeListing-intro">
                                                                                    <p class="UpgradeListing-desc">{LANG_URGENT_AD_TEXT}</p>
                                                                                </td>

                                                                                <td class="UpgradeListing-price js-upgrade-price">
                                                                                    <div id="priced_urgent_upgrade_block" class="UpgradeListing-price-value">
                                                                                        <span id="urgent-upgrade-price">{CURRENCY_SIGN}{URGENT_FEE} {LANG_FOR} {URGENT_DURATION} {LANG_DAYS}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- HIGHLIGHT UPGRADE -->
                                                                            <tr id="project-upgrade-item-private" class="UpgradeListing-option" data-robots="ProjectUpgradePrivate">
                                                                                <td class="UpgradeListing-info">
                                                                                    <div class="Checkbox">
                                                                                        <input type="checkbox" name="highlight" class="Checkbox-input focusable-field" id="highlight" value="" onclick="fillPrice(this,{HIGHLIGHT_FEE});">
                                                                                        <label class="UpgradeListing-checkbox Checkbox-label Checkbox-label--large" for="highlight">
                                                                                            <span class="Checkbox-addIcon"></span>
                                                                                        </label>
                                                                                        <div class="UpgradeListing-tags">
                                                                                                                <span class="UpgradeListing-promoTag promotion-tag has-no-icon promotion-private">
                                                                                                                    {LANG_HIGHLIGHT}
                                                                                                                </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>


                                                                                <td class="UpgradeListing-intro">
                                                                                    <p class="UpgradeListing-desc" >{LANG_HIGHLIGHT_AD_TEXT}</p>
                                                                                </td>

                                                                                <td class="UpgradeListing-price js-upgrade-price">

                                                                                    <div id="priced_private_upgrade_block" class="UpgradeListing-price-value">
                                                                                        <span id="private-upgrade-price">{CURRENCY_SIGN}{HIGHLIGHT_FEE} {LANG_FOR} {HIGHLIGHT_DURATION} {LANG_DAYS}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>

                                                                        </table>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </fieldset>
                                    </div>
                                </li>
                                <!-- PACKAGE -->

                                <li>
                                    <div class="PagePostProject-submit">
                                        <input type="hidden" name="submit">
                                        <button id="submit_advertise" class="btn btn-xlarge btn-info " type="submit" name="Submit"><span>{LANG_POST_Y_AD}</span></button>
                                        <div id="ad_total_cost_container" class="PagePostProject-totalCost" style="display: none;">
                                            <strong>
                                                {LANG_TOTAL}:
                                                <span class="currency-sign">{CURRENCY_SIGN}</span>
                                                <span id="totalPrice">0</span>
                                                <span class="currency-code">{CURRENCY_CODE}</span>
                                            </strong>

                                        </div>
                                    </div>

                                    <p class="PagePostProject-submit-terms">
                                        {LANG_CLICK_CON}
                                        <a  class="PagePostProject-submit-link" target="_blank" href="{TERMCONDITION_LINK}">{LANG_TERM_CON}</a>
                                        {LANG_AND}
                                        <a  class="PagePostProject-submit-link" target="_blank" href="{PRIVACY_LINK}">{LANG_PRIVACY}</a>
                                        <br>
                                    </p>
                                </li>
                            </ol>
                            </form>
                        </fl-project-form>

                        <footer class="FooterLite">
                            <p class="FooterLite-copyright">
                                {COPYRIGHT_TEXT}
                            </p>
                            <nav class="FooterLite-nav">
                                {LOOP: HTMLPAGE}
                                    <a href="{HTMLPAGE.link}" class="FooterLite-nav-link">{HTMLPAGE.title}</a>
                                {/LOOP: HTMLPAGE}
                            </nav>
                        </footer>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="{SITE_URL}templates/{TPL_NAME}/js/bootstrap.min.js"></script>

<link href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/select2/select2.min.css" rel="stylesheet" />
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/select2/select2.min.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/owl.carousel-category.min.js"></script>
<script>
    var lang_code = '{LANG_CODE}';
    var lang_code = lang_code.toLowerCase();
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/{LANG_CODE}.js"></script>
IF("{POST_ADDRESS_MODE}"=="1"){
<!-- If address mode enable: ADDRESS FIELD JAVASCRIPT -->
<link href="{SITE_URL}templates/{TPL_NAME}/css/map/map-marker.css" type="text/css" rel="stylesheet">
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript' src='//maps.google.com/maps/api/js?key={GMAP_API_KEY}&#038;libraries=places%2Cgeometry&#038;ver=2.2.1'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/richmarker-compiled.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/markerclusterer_packed.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/gmapAdBox.js'></script>
<script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/maps.js'></script>


<script>
    var _latitude = '{LATITUDE}';
    var _longitude = '{LONGITUDE}';
    var element = "map";
    var color = '#9C27B0';
    var zoom = '#9C27B0';
    var getCity = false;
    var path = '{SITE_URL}templates/{TPL_NAME}/';
    var Countries = '{USER_COUNTRY}';
    if(Countries != ""){
        var str = Countries;
        var str_array = str.split(',');
        var getCountry = [];
        for(var i = 0; i < str_array.length; i++)
        {
            getCountry.push(str_array[i]);

        }
    }
    else{
        var getCountry = "all";
    }
    simpleMap(_latitude, _longitude, element, true);

    $('#postadcity').on('change', function() {
        var data = $("#postadcity option:selected").val();
        var custom_data= $("#postadcity").select2('data')[0];
        var latitude = custom_data.latitude;
        var longitude = custom_data.longitude;
        var address = custom_data.text;
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        simpleMap(latitude, longitude, element, true, address);
    });
</script>
<!-- If address mode enable: ADDRESS FIELD JAVASCRIPT -->
{:IF}
<script>
    var ajaxurl = "{APP_URL}user-ajax.php";
    var lang_edit_cat = "{LANG_EDIT_CATEGORY}";
</script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/ajaxForm/jquery.form.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/js/ad_post_js.js"></script>
IF("{POST_DESC_EDITOR}"=="1"){
<!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
<link media="all" rel="stylesheet" type="text/css" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/styles/simditor.css" />
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/mobilecheck.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/module.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/uploader.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/hotkeys.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/scripts/simditor.js"></script>
<script>
    (function() {
        $(function() {
            var $preview, editor, mobileToolbar, toolbar, allowedTags;
            Simditor.locale = 'en-US';
            toolbar = ['bold','italic','underline','fontScale','|','ol','ul','blockquote','table','link'];
            mobileToolbar = ["bold", "italic", "underline", "ul", "ol"];
            if (mobilecheck()) {
                toolbar = mobileToolbar;
            }
            allowedTags = ['br','span','a','img','b','strong','i','strike','u','font','p','ul','ol','li','blockquote','pre','h1','h2','h3','h4','hr','table'];
            editor = new Simditor({
                textarea: $('#pageContent'),
                placeholder: '{LANG_AD_DESCRIPTION}',
                toolbar: toolbar,
                pasteImage: false,
                defaultImage: '{SITE_URL}templates/{TPL_NAME}/assets/plugins/simditor/images/image.png',
                upload: false,
                allowedTags: allowedTags
            });
            $preview = $('#preview');
            if ($preview.length > 0) {
                return editor.on('valuechanged', function(e) {
                    return $preview.html(editor.getValue());
                });
            }
        });
    }).call(this);
</script>
{:IF}
</body>
</html>