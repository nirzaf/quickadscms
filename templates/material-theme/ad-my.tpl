{OVERALL_HEADER}

<div id="page-content">
    <div class="container">
        <ul class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active"><a>{LANG_MY_ADS}</a></li>
        </ul>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <!--end breadcrumb-->
        <section class="page-title center"><h1>{LANG_MY_ADS_LISTINGS}</h1></section>
        <!--end page-title-->
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
                                            <li><a href="{LINK_MEMBERSHIP}" class="waves-effect"><i
                                                            class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP} </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box"><h5 class="collapse-title"> {LANG_MY_ADS} <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>

                                    <div id="MyAds" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li class="active"><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i> {LANG_MY_ADS} <span class="badge">{MYADS}</span> </a></li>
                                            <li><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i> {LANG_FAVOURITE_ADS} <span class="badge">{FAVORITEADS}</span> </a></li>
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
                                            <li><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING} </a></li>
                                            <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i> {LANG_LOGOUT} </a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-sm-9 page-content">
                    <div class="inner-box"><h1>{LANG_MY_ADS} </h1>

                        <div class="table-responsive">
                            <div class="table-action">
                                <div class="table-search pull-right col-xs-12">
                                    <div class="form-group">
                                        <div class="col-xs-7 control-label text-right"> &nbsp; </div>
                                        <div class="col-xs-5 searchpan">
                                            <form method="post">
                                                <div class="input-field">
                                                    <label for="filter" class="active"></label>
                                                    <input type="text" class="live-search-box" id="filter" name="filter" placeholder="Press enter for search" value="">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="success-msg hideresult" id="successMsg"></span> <span class="error-msg hideresult" id="errorMsg"></span>
                            <table id="js-table-list" class="table table-striped table-bordered add-manage-table table demo footable-loaded footable" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th> {LANG_PHOTO}</th>
                                    <th data-sort-ignore="true"> {LANG_ADS_DETAILS}</th>
                                    <th> {LANG_STATUS}</th>
                                    <th data-type="numeric"> {LANG_PRICE}</th>
                                    <th> {LANG_OPTION}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {LOOP: ITEM}
                                    <tr class='ajax-item-listing IF("{ITEM.status}"=="hide"){ opapcityLight {:IF}' data-item-id="{ITEM.id}" data-search-term="{ITEM.product_name}"  >
                                        <td class="add-img-td  width-14-per">
                                            <a href="{ITEM.link}">
                                                <img class="thumbnail  img-responsive" src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="img">
                                            </a>
                                        </td>
                                        <td class="ads-details-td width-58-per">
                                            <div>
                                                <p><strong><a href="{ITEM.link}">{ITEM.product_name}</a></strong>
                                                IF("{ITEM.featured}"=="1"){ <span class="label featured">{LANG_FEATURED}</span> {:IF}
                                                IF("{ITEM.urgent}"=="1"){ <span class="label urgent">{LANG_URGENT}</span> {:IF}
                                                IF("{ITEM.highlight}"=="1"){ <span class="label highlight"> {LANG_HIGHLIGHT}</span> {:IF}
                                                </p>
                                                <p><i class="fa fa-clock-o"></i> <strong> {LANG_POSTED_ON} </strong>: {ITEM.created_at} </p>
                                                <p><i class="fa fa-calendar-times-o"></i> <strong>{LANG_EXPIRY_DATE}:</strong> {ITEM.expire_date} </p>
                                                <p><i class="fa fa-map-marker"></i> <strong>{LANG_LOCATED_IN}:</strong> {ITEM.location} </p>

                                            </div>
                                        </td>
                                        <td class="price-td width-16-per">
                                            <div>
                                                IF("{ITEM.status}"=="active"){ <span class="label label-success">{ITEM.status}</span>{:IF}
                                                IF("{ITEM.status}"=="pending"){ <span class="label label-warning">{ITEM.status}</span> {:IF}
                                                IF("{ITEM.status}"=="rejected"){ <span class="label label-danger">{ITEM.status}</span> {:IF}
                                                IF("{ITEM.status}"=="expire"){ <span class="label label-danger">{ITEM.status}</span> {:IF}
                                                IF("{ITEM.hide}"=="1"){ <span class="label label-info label-hidden">{LANG_HIDDEN}</span>{:IF}
                                            </div>
                                        </td>
                                        <td class="price-td width-16-per">
                                            IF("{ITEM.price}"!="0"){ <div><strong>{ITEM.price}</strong></div>{:IF}

                                        </td>
                                        <td class="action-td width-10-per">
                                            <div>
                                                <p class="opacity1">
                                                    <a class="btn btn-info btn-rounded btn-xs" href="{LINK_EDIT-AD}/{ITEM.id}" data-ajax-action="deleteMyAd"><i class=" fa fa-pencil"></i> {LANG_EDIT}</a>
                                                </p>

                                                <p class='opacity1'><a class="btn btn-warning btn-rounded btn-xs item-js-hide" href="#" data-ajax-action="hideItem">
                                                        IF("{ITEM.hide}"=="0"){ <i class="fa  fa-eye-slash"></i> {LANG_HIDE} {:IF}
                                                        IF("{ITEM.hide}"=="1"){ <i class="fa  fa-eye"></i> {LANG_SHOW} {:IF}
                                                    </a>
                                                </p>
                                                <p class="opacity1">
                                                    <a class="btn btn-danger btn-rounded btn-xs item-js-delete" href="#" data-ajax-action="deleteMyAd"><i class=" fa fa-trash-o"></i> {LANG_DELETE}</a>
                                            </p></div>
                                        </td>
                                    </tr>
                                    {/LOOP: ITEM}

                                    <tr id="norecord" IF("{TOTALITEM}"!="0"){ style="display: none;" {:IF}>
                                        <td colspan="5">{LANG_NO_RESULT_FOUND}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="mt30 clearfix">
                                <ul class="pagination pull-right">
                                    {LOOP: PAGES}
                                    IF("{PAGES.current}"=="0"){ <li><a href="{PAGES.link}">{PAGES.title}</a> </li>{:IF}
                                    IF("{PAGES.current}"=="1"){ <li class="active"> <a>{PAGES.title}</a> </li>{:IF}
                                    {/LOOP: PAGES}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!--end container-->
</div> <!--end page-content-->
{OVERALL_FOOTER}