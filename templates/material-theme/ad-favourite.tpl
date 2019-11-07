{OVERALL_HEADER}
<div id="page-content">
    <div class="container">
        <ul class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active"><a>{LANG_FAVOURITE_ADS}</a></li>
        </ul>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <!--end breadcrumb-->

        <section>
            <div class="row mt40">
                <div class="col-sm-3 page-sidebar">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> {LANG_MY_CLASSIFIED} <a class="pull-right" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                                    <div id="MyClassified" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li><a href="{LINK_DASHBOARD}" class="waves-effect"><i class="fa fa-home"></i> {LANG_DASHBOARD} </a></li>
                                            <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"><i class="fa fa-user"></i> {LANG_PROFILE_PUBLIC}</a></li>
                                            <li><a href="{LINK_POST-AD}" class="waves-effect"><i class="fa fa-pencil"></i> {LANG_POST_AD}</a></li>
                                            <li><a href="{LINK_MEMBERSHIP}" class="waves-effect"><i class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP} </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box"><h5 class="collapse-title"> {LANG_MY_ADS} <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>

                                    <div id="MyAds" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i> {LANG_MY_ADS} <span class="badge">{MYADS}</span> </a></li>
                                            <li class="active"><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i> {LANG_FAVOURITE_ADS} <span class="badge" id="favCount">{FAVORITEADS}</span> </a></li>
                                            <li><a href="{LINK_PENDINGADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_PENDING_ADS} <span class="badge">{PENDINGADS}</span></a></li>
                                            <li><a href="{LINK_HIDDENADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_HIDDEN_ADS} <span class="badge">{HIDDENADS}</span></a></li>
                                            <li><a href="{LINK_EXPIREADS}" class="waves-effect"><i class="fa fa-calendar-times-o"></i> {LANG_EXPIRE_ADS} <span class="badge">{EXPIREADS}</span></a>
                                            <li><a href="{LINK_RESUBMITADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_RESUBMITED_ADS} <span class="badge">{RESUBMITADS}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> {LANG_MY_ACCOUNT} <a class="pull-right" data-toggle="collapse" href="#account"><i class="fa fa-angle-down"></i></a></h5>
                                    <div id="account" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li><a href="{LINK_TRANSACTION}" class="waves-effect"><i class="fa fa-money"></i> {LANG_TRANSACTION}</a></li>
                                            <li class="active"><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING} </a></li>
                                            <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i> {LANG_LOGOUT} </a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>

                <div class="col-md-9 col-sm-9">
                    <section>
                        <section class="page-title"><h1>{LANG_MY_FAVOURITE_ADS}</h1></section>

                        <section>
                            <div>
                                <div class="searchresult list hideresult" style="display: block;">
                                    <div class="row" id="serchlist">
                                        {LOOP: ITEM}
                                        <div class="quick-item item item-row ajax-item-listing" data-id="{ITEM.id}">
                                            <div class="premium">
                                                IF("{ITEM.featured}"=="1"){ <span class="listing-box-premium featured">{LANG_FEATURED}</span> {:IF}
                                                IF("{ITEM.urgent}"=="1"){ <span class="listing-box-premium urgent">{LANG_URGENT}</span>{:IF}
                                                IF("{ITEM.highlight}"=="1"){ <span class="listing-box-premium highlight">{LANG_HIGHLIGHT}</span> {:IF}

                                            </div>
                                            <div class="ad-listing">
                                                <div class="image bg-transfer">

                                                    <figure><a href="{ITEM.catlink}"><div class="label-featured label label-default">{ITEM.category}</div></a></figure>

                                                    <img src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="{ITEM.product_name}">
                                                </div>

                                                <!--end image-->

                                                <div class="description">
                                                    <h3 title="{ITEM.product_name}">
                                                        <a href="{ITEM.link}">{ITEM.product_name}</a>
                                                    </h3>
                                                    <ul class="icondetail">
                                                        <li><i class="fa fa-th-list"></i> {LANG_SUB_CATEGORY} :
                                                            <a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                                        </li>
                                                        <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM.city}, {ITEM.country}</li>
                                                        <li><i class="fa fa-calendar"></i> {LANG_POSTED_ON} : {ITEM.created_at}</li>
                                                        <li><i class="fa fa-user"></i> {LANG_POSTED_BY} : <a href="{ITEM.author_link}" target="_blank">{ITEM.username}</a></li>
                                                    </ul>
                                                    IF("{ITEM.showtag}"=="1"){
                                                    <ul class="tags">
                                                        {ITEM.tag}
                                                    </ul>
                                                    {:IF}
                                                    <div class="ad-footer-tags">
                                                        <div class="add-to-fav">
                                                            <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="{LANG_REMOVE_FAVOURITE}" data-item-id="{ITEM.id}" data-userid="{USER_ID}" data-action="removeFavAd" class="fav_{ITEM.id}">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </div>

                                                        IF("{ITEM.price}"!="0"){ <div class="price-tag">{ITEM.price}</div>{:IF}
                                                    </div>
                                                </div>
                                                <!--end description-->

                                            </div>

                                        </div>
                                        <!--end ITEM.row-->
                                        {/LOOP: ITEM}
                                    </div>
                                </div>
                            </div>
                        </section>
                        IF("{TOTALITEM}"=="0"){
                        <div class="alert alert-info">
                            <a href="#" class="alert-link">{LANG_NO_AD_FAVOURITE}</a>.
                        </div>
                        {:IF}
                        <section>
                            <div class="center">
                                <ul class="pagination center">
                                    {LOOP: PAGES}
                                    IF("{PAGES.current}"=="0"){ <li><a href="{PAGES.link}">{PAGES.title}</a> </li>{:IF}
                                    IF("{PAGES.current}"=="1"){ <li class="active"> <a>{PAGES.title}</a> </li>{:IF}
                                    {/LOOP: PAGES}
                                </ul>
                            </div>
                        </section>

                    </section>
                </div>
            </div>
        </section>

    </div>
    <!--end container-->
</div>
<script>
    var loginurl = "{LINK_LOGIN}?ref=favourite-ads.php";
</script>
{OVERALL_FOOTER}


