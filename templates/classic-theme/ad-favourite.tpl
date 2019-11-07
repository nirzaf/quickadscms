{OVERALL_HEADER}
<!-- myads-page -->
<section id="main" class="clearfix myads-page">
    <div class="container">

        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_FAVOURITE_ADS}</li>
                <div class="pull-right back-result">
                    <a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i> {LANG_BACK_RESULT}
                    </a>
                </div>
            </ol>
            <!-- breadcrumb -->
        </div>
        <!-- banner -->
        <div class="ads-info">
            <div class="row">
                <!-- Page-Sidebar -->
                <aside class="col-sm-3 hidden-xs hidden-sm">
                    <div class="section">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border">{LANG_MY_CLASSIFIED} <a class="pull-right" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="MyClassified" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_DASHBOARD}" class="waves-effect"><i class="fa fa-home"></i>{LANG_DASHBOARD} </a></li>
                                        <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"><i class="fa fa-user"></i> {LANG_PROFILE_PUBLIC}</a></li>
                                        <li><a href="{LINK_POST-AD}" class="waves-effect"><i class="fa fa-pencil"></i>{LANG_POST_AD}</a></li>
                                        <li><a href="{LINK_MEMBERSHIP}" class="waves-effect"><i class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP} </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">
                                <h5 class="collapse-title"> {LANG_MY_ADS} <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="MyAds" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i>{LANG_MY_ADS} <span class="badge">{MYADS}</span> </a></li>
                                        <li class="active"><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i>{LANG_FAVOURITE_ADS} <span class="badge">{FAVORITEADS}</span> </a></li>
                                        <li><a href="{LINK_PENDINGADS}" class="waves-effect"><i class="fa fa-info-circle"></i> {LANG_PENDING_ADS}<span class="badge">{PENDINGADS}</span></a></li>
                                        <li><a href="{LINK_HIDDENADS}" class="waves-effect"><i class="fa fa-eye-slash"></i> {LANG_HIDDEN_ADS} <span class="badge">{HIDDENADS}</span></a></li>
                                        <li><a href="{LINK_EXPIREADS}" class="waves-effect"><i class="fa fa-calendar-times-o"></i> {LANG_EXPIRE_ADS} <span class="badge">{EXPIREADS}</span></a>
                                        <li><a href="{LINK_RESUBMITADS}" class="waves-effect"><i class="fa fa-briefcase"></i> {LANG_RESUBMITED_ADS} <span class="badge">{RESUBMITADS}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> {LANG_MY_ACCOUNT} <a class="pull-right" data-toggle="collapse" href="#account"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="account" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_TRANSACTION}" class="waves-effect"><i class="fa fa-money"></i> {LANG_TRANSACTION}</a></li>
                                        <li><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING} </a></li>
                                        <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i>{LANG_LOGOUT} </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- # End Page-Sidebar -->
                <!-- my-quickad -->
                <div class="col-sm-9">
                    <div class="my-quickad section">
                        <div class="row">
                            <div class="col-md-5">
                                <h2>{LANG_FAVOURITE_ADS}</h2>
                            </div>
                            <div class="col-md-7">
                            </div>
                        </div>
                        <div  id="serchlist">
                            {LOOP: ITEM}<!-- quick-item -->
                            <div class='quick-item row IF("{ITEM.highlight}"=="1"){ highlight {:IF}' ><!-- item-image -->
                                <div class="ad-listing">
                                    <div class="image bg-transfer">
                                        <figure>
                                            <div class="item-badges">
                                                IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                                IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                                            </div>
                                        </figure>
                                        <img src="{SITE_URL}storage/products/{ITEM.picture}"
                                             alt="{ITEM.product_name}"></div>
                                    <div class="item-info col-sm-12"><!-- ad-info -->
                                        <div class="ad-info">
                                            <h4 class="item-title"><a href="{ITEM.link}">{ITEM.product_name}</a>
                                            </h4>
                                            <ul class="contact-options pull-right" id="set-favorite">
                                                <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}"
                                                       data-action="removeFavAd" class="fav_{ITEM.id} fa fa-heart IF("
                                                    {ITEM.favorite}"=="1"){ active {:IF}"></a></li>
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



                    <div class="clearfix"></div>

                    IF("{TOTALITEM}"=="0"){
                    <div class="alert alert-info">
                        <a href="#" class="alert-link">{LANG_NO_AD_FAVOURITE}</a>.
                    </div>
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
            <!-- my-quickad -->
        </div>
        <!-- row -->
    </div>
    <!-- row -->
    </div><!-- container -->
</section>
<!-- myads-page -->
<script>
    var loginurl = "{LINK_LOGIN}?ref=favourite-ads.php";
</script>
{OVERALL_FOOTER}


