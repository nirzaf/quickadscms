{OVERALL_HEADER}

<div id="page-content" style="transform: translateY(0px);">
    <div class="container">
        <ol class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">{LANG_PROFILE}</li>
        </ol>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <div class="row">
            <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                <section class="page-title">
                    <h1> {FULLNAME}</h1>
                </section>
                <!--end section-title-->
                <section>
                    <div class="subject-detail">
                        <div class="image">
                            <div class="bg-transfer">
                                <img src="{SITE_URL}storage/profile/{USERIMAGE}" alt="{FULLNAME}">
                            </div>
                        </div>
                        <div class="description">
                            <section class="name">
                                <h2>{USERNAME}
                                    IF("{SUB_IMAGE}"!=""){
                                    <img src="{SUB_IMAGE}" alt="{SUB_TITLE}" title="{SUB_TITLE}" width="28px"/>
                                    {:IF}
                                </h2>
                                <p><strong>{TAGLINE}</strong></p>
                                <p>{ABOUT}</p>
                            </section>
                            <!--end description-->
                            <section class="contacts">
                                <figure class="social-links"><i class="fa fa-user"></i>{USERNAME}</figure>
                                <figure class="social-links"><i class="fa fa-phone"></i>{PHONE}</figure>
                                <figure class="social-links"><a href="mailto:{EMAIL}"><i class="fa fa-envelope"></i>{EMAIL}</a></figure>
                                <figure class="social-links"><i class="fa fa-map-marker"></i>{ADDRESS}</figure>
                            </section>
                            <!--end contacts-->
                            <section class="social social-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </section>
                            <!--end social-->
                        </div>
                        <!--end description-->
                    </div>
                    <!--end subject-detail-->
                </section>
                <section>
                    <h2>{FULLNAME} {LANG_LISTINGS}</h2>
                    <section>
                        <form action="#" id="filterForm" method="get">
                            <div class="search-results-controls clearfix">
                                <div class="pull-left">
                                    <span id="grid" class="circle-icon cursor-point active"><i class="fa fa-th icon-white"></i></span>
                                    <span id="list" class="circle-icon cursor-point"><i class="fa fa-bars"></i></span>
                                </div>
                                <input type="hidden" name="username" value="{USERNAME}">
                                <!--end left-->
                                <div class="pull-right">
                                    <div class="input-group inputs-underline min-width-150px">
                                        <select class="meterialselect" name="limit" onchange="this.form.submit()">
                                            <option value="6">Limit Order</option>
                                            <option value="10" IF("{LIMIT}"=="10"){ selected {:IF} >10</option>
                                            <option value="15" IF("{LIMIT}"=="15"){ selected {:IF} >15</option>
                                            <option value="20" IF("{LIMIT}"=="20"){ selected {:IF} >20</option>
                                            <option value="25" IF("{LIMIT}"=="25"){ selected {:IF} >25</option>
                                            <option value="30" IF("{LIMIT}"=="30"){ selected {:IF} >30</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end right-->
                                <div class="pull-right mar-right-20">
                                    <div class="input-group inputs-underline min-width-150px">
                                        <select class="meterialselect" name="sort" onchange="this.form.submit()">
                                            <option value="">Sort by</option>
                                            <option value="title" IF("{SORT}"=="title"){ selected {:IF} >Name </option>
                                            <option value="price" IF("{SORT}"=="price"){ selected {:IF} >Price </option>
                                            <option value="date" IF("{SORT}"=="date"){ selected {:IF} >Date </option>
                                        </select>
                                    </div>
                                </div>
                                <!--end right-->
                            </div>
                            <!--end search-results-controls-->
                        </form>
                    </section>
                    <section>
                        <div class="" id="serchlist">
                            <div class="searchresult grid hideresult" style="display: none;">
                                <div class="row">
                                    {LOOP: ITEM}
                                    <div class="col-md-4 col-sm-4">
                                        <div class="item" data-id="{ITEM.id}">
                                            <div class="ad-listing">
                                                <div class="description">

                                                    <a href="{ITEM.catlink}"><div class="label label-default">{ITEM.category}</div></a>

                                                    <h3 title="{ITEM.product_name}">
                                                        <a href="{ITEM.link}">{ITEM.product_name}</a>
                                                    </h3>
                                                    <h4>{ITEM.location}</h4>
                                                </div>
                                                <!--end description-->
                                                <div class="image bg-transfer">
                                                    <img src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="{ITEM.product_name}">
                                                </div>
                                                <!--end image-->
                                            </div>
                                            <div class="additional-info {ITEM.highlight_bg}">
                                                <ul class="icondetail">
                                                    <li><i class="fa fa-th-list"></i> {LANG_SUB_CATEGORY}:
                                                        <a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                                    </li>
                                                    <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM.location}</li>
                                                    <li><i class="fa fa-calendar"></i> {LANG_POSTED_ON} : {ITEM.created_at}</li>
                                                    <li><i class="fa fa-user"></i> {LANG_POSTED_BY} : <a href="{ITEM.author_link}" target="_blank">{ITEM.username}</a></li>
                                                </ul>

                                                <div class="ad-footer-tags">
                                                    IF("{ITEM.price}"!="0"){ <div class="price-tag">{ITEM.price}</div> {:IF}
                                                </div>
                                                <!--end controls-more-->
                                            </div>
                                            <!--end additional-info-->
                                        </div>
                                        <!--end item-->
                                    </div>
                                    <!--<end col-md-4-->
                                    {/LOOP: ITEM}
                                </div>
                                <!--end row-->
                            </div>
                            <div class="searchresult list hideresult" style="display: none;">
                                <div class="row">
                                    {LOOP: ITEM2}
                                    <div class="item item-row" data-id="{ITEM2.id}">
                                        <div class="ad-listing">
                                            <div class="image bg-transfer">

                                                <figure><a href="{ITEM2.catlink}"><div class="label-featured label label-default">{ITEM2.category}</div></a></figure>

                                                <img src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="{ITEM2.product_name}">
                                            </div>

                                            <!--end image-->

                                            <div class="description {ITEM2.highlight_bg}">
                                                <h3 title="{ITEM2.product_name}">
                                                    <a href="{ITEM2.link}">{ITEM2.product_name}</a>
                                                </h3>
                                                <ul class="icondetail">
                                                    <li><i class="fa fa-th-list"></i> {LANG_SUB_CATEGORY} :
                                                        <a title="{ITEM2.sub_category}" href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                                                    </li>
                                                    <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM2.location}</li>
                                                    <li><i class="fa fa-calendar"></i> {LANG_POSTED_ON} : {ITEM2.created_at}</li>
                                                    <li><i class="fa fa-user"></i> {LANG_POSTED_BY} : <a href="{ITEM2.author_link}" target="_blank">{ITEM2.username}</a></li>
                                                </ul>
                                                IF("{ITEM2.showtag}"=="1"){
                                                <ul class="tags">
                                                    {ITEM2.tag}
                                                </ul>
                                                {:IF}
                                                <div class="ad-footer-tags">
                                                    IF("{ITEM2.price}"!="0"){ <div class="price-tag">{ITEM2.price}</div> {:IF}
                                                </div>
                                            </div>
                                            <!--end description-->

                                        </div>

                                    </div>
                                    <!--end item.row-->
                                    {/LOOP: ITEM2}
                                </div>
                            </div>
                        </div>
                    </section>

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
            <!--end col-md-9-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</div>

{OVERALL_FOOTER}