<!DOCTYPE html>
<html lang="{LANG_CODE}" dir="{LANGUAGE_DIRECTION}">
<head>
    <title>
        IF("{PAGE_TITLE}"!=""){
        {PAGE_TITLE} -
        {:IF}
        {SITE_TITLE}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{SITE_TITLE}">
    <meta name="keywords" content="{PAGE_META_KEYWORDS}">
    <meta name="description" content="{PAGE_META_DESCRIPTION}">

    <meta property="fb:app_id" content="{FACEBOOK_APP_ID}" />
    <meta property="og:site_name" content="{SITE_TITLE}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:url" content="{PAGE_LINK}" />
    <meta property="og:title" content="IF("{PAGE_TITLE}"!=""){ {PAGE_TITLE} - {:IF}{SITE_TITLE}" />
    <meta property="og:description" content="{PAGE_META_DESCRIPTION}" />
    <meta property="og:type" content="{META_CONTENT}" />
    IF("{META_CONTENT}"=="article"){
    <meta property="article:author" content="#" />
    <meta property="article:publisher" content="#" />
    <meta property="og:image" content="{META_IMAGE}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="800" />
    {:IF}
    IF("{META_CONTENT}"=="website"){
    <meta property="og:image" content="{META_IMAGE}" />
    {:IF}

    <meta property="twitter:card" content="summary">
    <meta property="twitter:title" content="{PAGE_TITLE} - {SITE_TITLE}">
    <meta property="twitter:description" content="{PAGE_META_DESCRIPTION}">
    <meta property="twitter:domain" content="{SITE_URL}">
    <meta name="twitter:image:src" content="{META_IMAGE}" />

    <link rel="shortcut icon" href="{SITE_URL}storage/logo/{SITE_FAVICON}">
    <style>
        :root {
            --theme-color: transparent;
        }
        .highlight-premium-ad{ background: #ffedc0 !important;}
    </style>
    <script>
        var themecolor = '{THEME_COLOR}';
        var mapcolor = '{MAP_COLOR}';
        var siteurl = '{SITE_URL}';
        var template_name = '{TPL_NAME}';
    </script>
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/fonts/font-awesome.css' type='text/css'/>
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/fonts/elegant-fonts.css' type='text/css' />

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato%3A400%2C300%2C700%2C900%2C400italic%7COpen+Sans%3A700italic%2C400%2C800%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.7.3' type='text/css' />
    <link rel='stylesheet'  href='{SITE_URL}templates/{TPL_NAME}/assets/bootstrap/css/bootstrap.css' type='text/css' />
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/css/bootstrap-select.min.css' type='text/css' />

    <link rel='stylesheet'  href='{SITE_URL}templates/{TPL_NAME}/assets/css/owl.carousel.css' type='text/css' />
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/css/trackpad-scroll-emulator.css' type='text/css' />
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/css/jquery.nouislider.min.css' type='text/css' />
    <link rel='stylesheet'  href='{SITE_URL}templates/{TPL_NAME}/assets/css/style.css' type='text/css' />
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/css/flags/flags.min.css">
    <link rel='stylesheet'  href='{SITE_URL}templates/{TPL_NAME}/assets/css/map-marker.css' type='text/css' />
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/css/main-theme.css' type='text/css' />
    <link rel='stylesheet' href='{SITE_URL}templates/{TPL_NAME}/assets/materialize/css/materialize.css' type='text/css' />
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/css/membership.css" >
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/css/styleswitcher.css" >
    <!--Sweet Alert CSS -->
    <link href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/jquery-2.2.1.min.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/jquery-migrate-1.2.1.min.js'></script>

    <script type='text/javascript' src='//maps.google.com/maps/api/js?key={GMAP_KEY}&#038;libraries=places%2Cgeometry&#038;ver=2.2.1'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/richmarker-compiled.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/markerclusterer_packed.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/gmapAdBox.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/maps.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/assets/js/jquery.style-switcher.js'></script>

    IF("{LANGUAGE_DIRECTION}"=="rtl"){
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/css/rtl.css">
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/css/bootstrap-rtl.min.css">
    {:IF}

    <script>var ajaxurl = "{APP_URL}user-ajax.php";</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.resend').click(function(e) { 						// Button which will activate our modal

                the_id = $(this).attr('id');						//get the id

                // show the spinner
                $(this).parent().html("<img src='{SITE_URL}templates/{TPL_NAME}/images/spinner.gif'/>");

                $.ajax({											//the main ajax request
                    type: "POST",
                    data: "action=email_verify&id="+$(this).attr("id"),
                    url: ajaxurl,
                    success: function(data)
                    {
                        $("span#resend_count"+the_id).html(data);
                        //fadein the vote count
                        $("span#resend_count"+the_id).fadeIn();
                        //remove the spinner
                        $("span#resend_buttons"+the_id).remove();

                    }
                });

                return false;
            });
        });
    </script>
    <!-- ==================================
    ===============External Code===========
    ======================================= -->
    {EXTERNAL_CODE}
    <!-- ==================================
    ===============External Code===========
    ======================================= -->
</head>
<body class="{LANGUAGE_DIRECTION}">

<!--*********************************Modals*************************************-->
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
                    <div style="padding: 20px">
                        <ul class="column col-md-12 col-sm-12 cities">
                            {LOOP: COUNTRYLIST}
                                <li><span class="flag flag-{COUNTRYLIST.lowercase_code}"></span> <a href="{LINK_HOME}/{COUNTRYLIST.lang}/{COUNTRYLIST.lowercase_code}" data-id="{COUNTRYLIST.id}" data-name="{COUNTRYLIST.name}"> {COUNTRYLIST.name}</a></li>
                            {/LOOP: COUNTRYLIST}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="loginPopUp">
    <i class="loading-icon fa fa-circle-o-notch fa-spin"></i>
    <div class="modal-dialog width-400px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="section-title">
                    <h2>{LANG_LOGIN}</h2>
                </div>
            </div>
            <div class="socialLoginHere">
                <div class="row text-center">
                    <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                    <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google-plus"></i> <span>Google+</span></a></div>
                </div>
                <div class="clear"></div>
            </div>
            <div id="login-status" class="info-notice" style="display: none;margin-bottom: 20px">
                <div class="content-wrapper">
                    <div id="login-detail">
                        <div id="login-status-icon-container"><span class="login-status-icon"></span></div>
                        <div id="login-status-message">{LANG_AUTHENTICATING}...</div>
                    </div>
                </div>
            </div>
            <form action="ajaxlogin" id="lg-form">
                <div class="modal-body">
                <form class="form inputs-underline">
                    <div class="form-group">
                        <label for="username">{LANG_USERNAME} / {LANG_EMAIL}</label>
                        <input type="email" class="form-control" id="username" placeholder="{LANG_USERNAME} / {LANG_EMAIL}">
                    </div>
                    <!--end form-group-->
                    <div class="form-group">
                        <label for="password">{LANG_PASSWORD}</label>
                        <input type="password" class="form-control" id="password" placeholder="{LANG_PASSWORD}">
                    </div>
                    <div class="form-group center">
                        <button id="login" type="button" class="btn btn-primary width-100">{LANG_LOGIN}</button>
                    </div>
                    <!--end form-group-->
                </form>

                <hr>

                <a href="{LINK_LOGIN}?fstart=1">{LANG_FORGOTPASS}?</a>
                <!--end form-->
            </div>
                <!--end modal-body-->
            </form>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>
<!--*********************************Modals*************************************-->
IF("{USERSTATUS}"=="0"){
<div class="pam fbPageBanner uiBoxYellow noborder">
    <div class="fbPageBannerInner">
        <table class="uiGrid _51mz _5ud_" cellspacing="0" cellpadding="0">
            <tbody>
            <tr class="_51mx">
                <td class="_51m- phm" style="width:78%">
                    <span class="uiIconText">
                        <i class="icon-lock text-18"></i>
                        <span class="pts5 fsl fwb fs13 fbold">{LANG_WELCOME} <span class="coffel">{USERNAME}</span>, go to <span class="coffel">{USEREMAIL}</span> {LANG_TO} {LANG_VERIFY_EMAIL_ADDRESS}</span>
                    </span>
                </td>
                <td class="_51m- phm _51mw">
                    <table class="uiGrid _51mz _5ud-" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr class="_51mx">
                            <td class="_51m- phm"><a class="uiButton uiButtonLarge" style="box-sizing:content-box;" onMouseOver="LinkshimAsyncLink.swap(this, "http:\/\/www.{EMAILDOMAIN}\/");" rel="nofollow" target="_blank" role="button" href="http://www.{EMAILDOMAIN}/"><span class="uiButtonText">{LANG_GOTO_UR_EMAIL}</span></a>
                            </td>
                            <td class="_51m- phm _51mw">
                                <span class='resend_buttons' id='resend_buttons{USER_ID}'><a class="uiButton uiButtonLarge resend" style="box-sizing:content-box;" href='javascript:;' id="{USER_ID}"><span class="uiButtonText">{LANG_RESEND_EMAIL}</span></a></span>
                                <span class='resend_count' id='resend_count{USER_ID}' style="box-sizing:content-box;"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
{:IF}
<div class="page-wrapper" id="page-header">
    <!--start header section header v1-->
    <header class="header-section-default header-main nav-left hidden-sm hidden-xs">
        <div class="container">
            <div class="header-left">
                <div class="logo">
                    <a href="{LINK_INDEX}">
                        <img src="{SITE_URL}storage/logo/material-theme_logo.png" alt="logo">
                    </a>
                </div>
                IF("{COUNTRY_TYPE}"=="multi"){
                <div class="pull-left">
                    <button class="flag-menu country-flag btn btn-default" id="#selectCountry" data-toggle="modal" data-target="#selectCountry" style="margin-left: 20px;">
                        <img src="{SITE_URL}templates/{TPL_NAME}/images/flags/{USER_COUNTRY}.png" style="float: left;">
                    </button>
                </div>
                {:IF}
                <nav class="navi main-nav">
                    <ul>
                        <li><a href="{LINK_HOME}">{LANG_HOME}</a>
                            <ul class="sub-menu">
                                <li> <a class="" href="{LINK_INDEX1}">{LANG_HOME_IMAGE} </a> </li>
                                <li> <a class="" href="{LINK_INDEX2}">{LANG_HOME_MAP} </a> </li>
                            </ul>
                        </li>
                        <li><a href="{LINK_LISTING}">{LANG_LISTING}</a></li>
                        <li><a href="{LINK_CONTACT}">{LANG_CONTACT}</a></li>
                    </ul>
                </nav>

            </div>
            <div class="header-right">
                IF("{LOGGED_IN}"=="0"){
                <div class="user">
                    <a href="#" data-toggle="modal" data-target="#loginPopUp" class="waves-effect pad-lr-10 modal-trigger">{LANG_SIGN_IN}</a>
                    <a href="{LINK_SIGNUP}" class="waves-effect pad-lr-10">{LANG_REGISTER}</a>
                    <a href="{LINK_POST-AD}" class="btn btn-rounded btn-default waves-effect">{LANG_POST_FREE_AD}</a>
                </div>
                {:IF}
                IF("{LOGGED_IN}&{WCHAT}"=="1&on"){
                <div class="user">
                    <a href="{LINK_MESSAGE}" class="waves-effect message-link"><i class="fa fa-envelope"></i> </a>
                </div>
                {:IF}
                IF("{LOGGED_IN}"=="1"){
                <ul class="account-action">

                    <li class="">
                        <span class="hidden-sm hidden-xs">{USERNAME} <i class="fa fa-angle-down"></i></span>
                        <img src="{SITE_URL}storage/profile/{USERPIC}" alt="{USERNAME}" class="user-image" height="22" width="22">

                        <div class="account-dropdown">
                            <ul>
                                <li><a href="{LINK_DASHBOARD}" class="waves-effect"> <i class="fa fa-file"></i>{LANG_MY_CLASSIFIED}</a></li>
                                <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"> <i class="fa fa-user"></i>{LANG_PROFILE_PUBLIC}</a></li>
                                <li><a href="{LINK_POST-AD}" class="waves-effect"> <i class="fa fa-plus-circle"></i>{LANG_POST_FREE_AD}</a></li>
                                <li><a href="{LINK_MYADS}" class="waves-effect"> <i class="fa fa-building"></i>{LANG_MY_ADS_LISTINGS}</a></li>
                                <li><a href="{LINK_FAVADS}" class="waves-effect"> <i class="fa fa-heart"></i>{LANG_FAVOURITE_ADS}</a></li>
                                <li><a href="{LINK_PENDINGADS}" class="waves-effect"> <i class="fa fa-clock-o"></i>{LANG_MY_PENDING_ADS}</a></li>
                                <li><a href="{LINK_LOGOUT}" class="waves-effect"> <i class="fa fa-unlock"></i>{LANG_LOGOUT}</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

                {:IF}

                IF("{LANG_SEL}"=="1"){
                <div class="dropdown lang-dropdown" id="lang-dropdown">
                    <button class="btn dropdown-toggle btn-default-lite" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false"><span id="selected_lang">EN</span><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
                        {LOOP: LANGS}
                            <li><a role="menuitem" tabindex="-1" rel="alternate" href="{LINK_HOME}/{LANGS.code}">{LANGS.name}</a></li>
                        {/LOOP: LANGS}
                    </ul>
                </div>
                {:IF}


            </div>
        </div>
    </header>
    <div class="header-mobile visible-sm visible-xs">
        <div class="container">
            <!--start mobile nav-->
            <div class="mobile-nav">
                <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
                <div class="nav-dropdown main-nav-dropdown"></div>
            </div>
            <!--end mobile nav-->
            <div class="header-logo">
                <a href="{LINK_INDEX}"><img src="{SITE_URL}storage/logo/{SITE_LOGO}" alt="logo"></a>
            </div>
            <div class="header-user">

                <ul class="account-action">
                    <li>
                        IF("{LOGGED_IN}"=="0"){
                        <span class="user-image"><i class="fa fa-ellipsis-v"></i></span>
                        {:IF}
                        IF("{LOGGED_IN}"=="1"){
                        <img src="{SITE_URL}storage/profile/{USERPIC}" alt="{USERNAME}" class="user-image" width="36" height="36">
                        {:IF}
                        <div class="account-dropdown">
                            <ul>
                                IF("{LOGGED_IN}"=="0"){
                                <li><a href="{LINK_LOGIN}" class="waves-effect"><i class="fa fa-user"></i> {LANG_SIGN-IN}</a></li>
                                <li><a href="{LINK_SIGNUP}" class="waves-effect"><i class="fa fa-lock"></i> {LANG_REGISTER}</a></li>
                                <li><a href="{LINK_POST-AD}" class="waves-effect"><i class="fa fa-plus-circle"></i> {LANG_POST_FREE_AD}</a></li>
                                {:IF}
                                IF("{LOGGED_IN}"=="1"){
                                <li><a href="{LINK_DASHBOARD}" class="waves-effect"> <i class="fa fa-file"></i>{LANG_MY_CLASSIFIED}</a></li>
                                <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"> <i class="fa fa-user"></i>{LANG_PROFILE_PUBLIC}</a></li>
                                <li><a href="{LINK_POST-AD}" class="waves-effect"> <i class="fa fa-plus-circle"></i>{LANG_POST_FREE_AD}</a></li>
                                <li><a href="{LINK_MYADS}" class="waves-effect"> <i class="fa fa-building"></i>{LANG_MY_ADS_LISTINGS}</a></li>
                                <li><a href="{LINK_FAVADS}" class="waves-effect"> <i class="fa fa-heart"></i>{LANG_FAVOURITE_ADS}</a></li>
                                <li><a href="{LINK_PENDINGADS}" class="waves-effect"> <i class="fa fa-clock-o"></i>{LANG_MY_PENDING_ADS}</a></li>
                                <li><a href="{LINK_LOGOUT}" class="waves-effect"> <i class="fa fa-unlock"></i>{LANG_LOGOUT}</a></li>
                                {:IF}
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end header section header v1-->


