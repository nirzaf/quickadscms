<!DOCTYPE html>
<html lang="{LANG_CODE}" dir="{LANGUAGE_DIRECTION}">
<head>
    <title>IF("{PAGE_TITLE}"!=""){ {PAGE_TITLE} - {:IF}{SITE_TITLE}</title>
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

    <script async>
        var themecolor = '{THEME_COLOR}';
        var mapcolor = '{MAP_COLOR}';
        var siteurl = '{SITE_URL}';
        var template_name = '{TPL_NAME}';
    </script>
    <!-- CSS -->
    <style>
        :root {
            --theme-color: transparent;
        }
        /*=====Pre-Load-Wrap=====*/
        .load-wrapp{background:#fff;color:#fff;position:fixed;left:0;top:0;width:100%;height:100%;z-index:99999;text-align:center;display:flex;flex-direction:column;justify-content:center}.load-wrapp .wrap{position:absolute;left:50%;top:50%;transform:translateX(-50%) translateY(-50%)}.load-wrapp .wrap ul.dots-box{position:relative;width:80px;height:80px;list-style:none}.load-wrapp .wrap ul.dots-box li.dot{width:100%;height:100%;border-radius:52px;top:0;left:0;z-index:99;text-indent:-9999px;display:block;position:absolute;border:none;animation-iteration-count:infinite;animation-timing-function:linear;animation-name:orbit;animation-duration:4s}.load-wrapp .wrap ul.dots-box li.dot span{background:#1c90f3;background: var(--theme-color);bottom:0;left:50%;margin-left:-2px;display:block;position:absolute;width:10px;height:10px;border-radius:10px}.load-wrapp .wrap ul.dots-box li:nth-child(2){animation-delay:.2s}.load-wrapp .wrap ul.dots-box li:nth-child(3){animation-delay:.4s}.load-wrapp .wrap ul.dots-box li:nth-child(4){animation-delay:.6s}.load-wrapp .wrap ul.dots-box li:nth-child(5){animation-delay:.8s}@keyframes orbit{0%{transform:rotate(0);opacity:1}5%{transform:rotate(90deg);opacity:1}45%{transform:rotate(270deg);opacity:1}55%{transform:rotate(540deg);opacity:1}75%{transform:rotate(630deg);opacity:1}100%,80%{transform:rotate(720deg);opacity:0}}
        /*=====End-Pre-Load-Wrap=====*/
    </style>
    <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap.min.css">
    <noscript id="deferred-styles">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/map/map-marker.css">

        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/owl.carousel.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/slidr.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/less/icons.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/main.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/ajax-search.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/membership.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/styleswitcher.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/responsive.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/flags/flags.min.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/font-awesome.min.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/icofont.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/pe-icon-7-stroke.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/js/sweetalert/sweetalert.css" type="text/css">
        IF("{LANGUAGE_DIRECTION}"=="rtl"){
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/rtl.css">
        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/bootstrap-rtl.min.css">
        {:IF}

        <link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/css/color.css">
    </noscript>


    <!-- icons -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script async src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script async src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Template Developed By Bylancer -->
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery-2.2.1.min.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery-migrate-1.2.1.min.js'></script>
    <script type='text/javascript' src='//maps.google.com/maps/api/js?key={GMAP_KEY}&#038;libraries=places%2Cgeometry&#038;ver=2.2.1'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/richmarker-compiled.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/markerclusterer_packed.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/gmapAdBox.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/map/maps.js'></script>
    <script type='text/javascript' src='{SITE_URL}templates/{TPL_NAME}/js/jquery.style-switcher.js'></script>
    <script async type="text/javascript" src="{SITE_URL}templates/{TPL_NAME}/js/mmenu.min.js"></script>

    <script async>var ajaxurl = "{APP_URL}user-ajax.php";</script>

    <script async type="text/javascript">
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

    <script>
        var loadDeferredStyles = function() {
            var addStylesNode = document.getElementById("deferred-styles");
            var replacement = document.createElement("div");
            replacement.innerHTML = addStylesNode.textContent;
            document.body.appendChild(replacement)
            addStylesNode.parentElement.removeChild(addStylesNode);
        };
        var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
        if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
        else window.addEventListener('load', loadDeferredStyles);
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
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="load-wrapp">
    <div class="wrap">
        <ul class="dots-box">
            <li class="dot"><span></span></li>
            <li class="dot"><span></span></li>
            <li class="dot"><span></span></li>
            <li class="dot"><span></span></li>
            <li class="dot"><span></span></li>
        </ul>
    </div>
</div>
<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container
     ================================================== -->
    <header id="header-container">

        <!-- Header -->
        <div id="header">
            <div class="container">

                <!-- Left Side Content -->
                <div class="left-side">
                    <!-- Logo -->
                    <div id="logo">
                        <a href="{LINK_INDEX}"><img src="{SITE_URL}storage/logo/{SITE_LOGO}" alt=""></a>
                    </div>



                    <!-- Mobile Navigation -->
                    <button class="btn btn-primaryy hidden" id="change-city" data-toggle="modal" data-target="#countryModal">{LANG_SELECT_CITY}</span></button>
                    IF("{COUNTRY_TYPE}"=="multi"){
                    <div class="mmenu-trigger" id="#selectCountry" data-toggle="modal" data-target="#selectCountry">
                        <button class="hamburger hamburger--collapse country-flag">
                            <img src="{SITE_URL}templates/{TPL_NAME}/images/flags/{USER_COUNTRY}.png">
                        </button>
                    </div>
                    {:IF}
                    IF("{COUNTRY_TYPE}"=="multi"){
                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
                            <li>
                                <div class="flag-menu">

                                    <button class="hamburger hamburger--collapse country-flag" id="#selectCountry" data-toggle="modal" data-target="#selectCountry">
                                        <img src="{SITE_URL}templates/{TPL_NAME}/images/flags/{USER_COUNTRY}.png">
                                    </button>

                                </div>
                            </li>
                        </ul>
                    </nav>
                    {:IF}

                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->


                <!-- Right Side Content / End -->
                <div class="right-side">
                    <div class="header-widget">
                        IF("{LOGGED_IN}&{WCHAT}"=="1&on"){
                        <a href="{LINK_MESSAGE}" class="sign-in popup-with-zoom-anim"><i class="fa fa-envelope"></i> <span class="hidden-xs">{LANG_MESSAGE}</span></a>
                        {:IF}
                        IF("{LOGGED_IN}"=="1"){
                        <!-- User Menu -->
                        <div class="user-menu">
                            <div class="user-name"><span><img src="{SITE_URL}storage/profile/{USERPIC}" alt="{USERNAME}"></span>{USERNAME}</div>
                            <ul>
                                <li><a href="{LINK_DASHBOARD}"><i class="fa fa-home"></i> {LANG_DASHBOARD}</a></li>
                                <li><a href="{LINK_MYADS}"><i class="fa fa-book"></i> {LANG_MY_ADS}</a></li>
                                <li><a href="{LINK_PROFILE}/{USERNAME}"><i class="fa fa-user"></i> {LANG_MY_PROFILE}</a></li>
                                <li><a href="{LINK_MEMBERSHIP}"><i class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP}</a></li>
                                <li><a href="{LINK_TRANSACTION}"><i class="fa fa-money"></i> {LANG_TRANSACTION}</a></li>
                                <li><a href="{LINK_ACCOUNT_SETTING}"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING}</a></li>
                                <li><a href="{LINK_LOGOUT}"><i class="fa fa-unlock"></i> {LANG_LOGOUT}</a></li>
                            </ul>
                        </div>
                        {:IF}
                        IF("{LOGGED_IN}"=="0"){
                        <a href="#loginPopUp" class="sign-in popup-with-zoom-anim modal-trigger"><i class="fa fa-sign-in"></i> {LANG_LOGIN}</a>
                        <a href="{LINK_SIGNUP}" class="sign-in popup-with-zoom-anim"> {LANG_REGISTER}</a>
                        {:IF}
                        <a href="{LINK_POST-AD}" class="button border with-icon">{LANG_POST_FREE_AD} <i class="fa fa-plus-circle"></i></a>
                        <!-- lang-dropdown -->
                        IF("{LANG_SEL}"=="1"){
                        <div class="dropdown lang-dropdown" id="lang-dropdown">
                            <button class="btn dropdown-toggle btn-default-lite" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-expanded="false"><span id="selected_lang">EN</span><span
                                        class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
                                {LOOP: LANGS}
                                    <li><a role="menuitem" tabindex="-1" rel="alternate" href="{LINK_HOME}/{LANGS.code}">{LANGS.name}</a></li>
                                {/LOOP: LANGS}
                            </ul>
                        </div>
                        {:IF}
                        <!-- lang-dropdown -->
                    </div>
                </div>
                <!-- Right Side Content / End -->
            </div>
        </div>
        <!-- Header / End -->

    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->


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
                        <div class="row" style="padding: 0 20px">
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
    <div class="modal" id="countryModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:23px">
                <div class="quick-states" id="country-popup" data-country-id="{DEFAULT_COUNTRY_ID}" style="display: block;">
                    <div id="regionSearchBox" class="title clr">
                        <a class="closeMe icon close fa fa-close" data-dismiss="modal" title="Close"></a>

                        <div class="clr row">
                            IF("{COUNTRY_TYPE}"=="multi"){
                            <span style="line-height: 30px;">
                                <span class="flag flag-{USER_COUNTRY}"></span> <a href="#"  id="#selectCountry" data-toggle="modal" data-target="#selectCountry">{LANG_CHANGE_COUNTRY}</a>
                            </span>
                            {:IF}
                            <div class="locationrequest smallBox br5 col-sm-4">
                                <div class="rel input-container"><span class="watermark_container" style="display: block;">
                    <input class="light cityfield ca2" type="text" id="inputStateCity" placeholder="{LANG_TYPE_YOUR_CITY}">
                    </span>
                                    <label for="inputStateCity" class="icon locmarker2 abs"><i class="fa fa-map-marker"></i></label>

                                    <div id="searchDisplay"></div>
                                    <div class="suggest bottom abs small br3 error hidden"><span
                                                class="target abs icon"></span>

                                        <p></p>
                                    </div>
                                </div>
                                <div id="lastUsedCities" class="last-used binded" style="display: none;">{LANG_LAST_VISITED}:
                                    <ul id="last-locations-ul">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popular-cities clr">
                        <p>{LANG_POPULAR_CITIES}:</p>

                        <div class="list row">

                            <ul class="col-lg-12 col-md-12 popularcity">
                                {LOOP: POPULARCITY}
                                {POPULARCITY.tpl}
                                {/LOOP: POPULARCITY}
                            </ul>
                        </div>
                    </div>
                    <div class="viewport">

                        <div class="row full" id="getCities">
                            <div class="col-sm-12 col-md-12 loader" style="display: none"></div>
                            <div id="results" class="animate-bottom">
                                <ul class="column col-md-12 col-sm-12 cities">
                                    {LOOP: STATELIST}
                                    {STATELIST.tpl}
                                    {/LOOP: STATELIST}
                                </ul>
                            </div>
                        </div>
                        <div class="table full subregionslinks hidden" id="subregionslinks"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loginPopUp" class="modal-container"><a href="#" class="modal-overlay"> {LANG_CLOSE_MODAL}</a>

        <div class="inner">
            <button class="close_modal"><i class="fa fa-remove"></i></button>

            <div class='socialLoginDiv IF("{FACEBOOK_APP_ID}{GOOGLE_APP_ID}"==""){ hidden {:IF}'>
                <div class="socialLoginHere">
                    <div class="row text-center">
                        IF("{FACEBOOK_APP_ID}"!=""){
                        <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i
                                        class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                        {:IF}
                        IF("{GOOGLE_APP_ID}"!=""){
                        <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i
                                        class="fa fa-google"></i> <span>Google</span></a></div>
                        {:IF}
                    </div>
                    <div class="clear"></div>
                </div>
                <span class="split-opt">or</span>
            </div>
            <div class="modal-content signin text-center">
                <div id="login-status" class="info-notice" style="display: none;margin-bottom: 20px">
                    <div class="content-wrapper">
                        <div id="login-detail">
                            <div id="login-status-icon-container"><span class="login-status-icon"></span></div>
                            <div id="login-status-message">{LANG_AUTHENTICATING}...</div>
                        </div>
                    </div>
                </div>
                <form action="ajaxlogin" id="lg-form">
                    <header>
                        <h4>{LANG_WELCOME_BACK}!</h4>

                        <p>{LANG_ENTER_DETAILS}</p>
                    </header>
                    <div class="field-block">
                        <div class="labeled-input">
                            <input type="text" id="username" placeholder="{LANG_USERNAME} / {LANG_EMAIL}">
                        </div>
                    </div>
                    <div class="field-block">
                        <div class="labeled-input">
                            <input id="password" type="password" placeholder="{LANG_PASSWORD}">
                        </div>
                    </div>
                    <div class="text-center"><a href="{LINK_LOGIN}?fstart=1">{LANG_FORGOTPASS}?</a></div>
                    <button id="login" href="#" class="btn field-block">{LANG_LOGIN}</button>
                    <div class="login-cta text-center">
                        <p>{LANG_FORGOTPASS}?</p>
                        <a href="{LINK_SIGNUP}">{LANG_CREATE_NEW_ACCOUNT}</a></div>
                </form>
            </div>
        </div>
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
                            <span class="pts5 fsl fwb fs13 fbold">{LANG_WELCOME} <span class="coffel">{USERNAME}</span>, {LANG_GOTO_UR_EMAIL} <span class="coffel">{USEREMAIL}</span> {LANG_TO} {LANG_VERIFY_EMAIL_ADDRESS}</span>
                        </span>
                    </td>
                    <td class="_51m- phm _51mw">
                        <table class="uiGrid _51mz _5ud-" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr class="_51mx">
                                <td class="_51m- phm"><a class="uiButton uiButtonLarge" style="box-sizing:content-box;" rel="nofollow" target="_blank" role="button" href="http://www.{EMAILDOMAIN}/"><span class="uiButtonText">{LANG_GOTO_UR_EMAIL}</span></a>
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

