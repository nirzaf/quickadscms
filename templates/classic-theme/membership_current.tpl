{OVERALL_HEADER}
<style>
    #post-form table th {
        font-size: 14px;
        font-weight: 700;
        color: #f5f5f5;
        background-color: #555555;
    }
    #post-form table td{ font-size:14px; font-weight:normal}
</style>

<!-- Payment-Method-page -->
<section id="main" class="clearfix  myads-page">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_CURRENT_PLAN}</li>
                <div class="pull-right back-result"><a href="{LINK_DASHBOARD}"><i class="fa fa-angle-double-left"></i>{LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
        </div>
        <!-- Main Content -->
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
                                    <li class="active"><a href="{LINK_MEMBERSHIP}" class="waves-effect"><i class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP} </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="collapse-box">
                            <h5 class="collapse-title"> {LANG_MY_ADS} <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>
                            <div id="MyAds" class="panel-collapse collapse in">
                                <ul class="acc-list">
                                    <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i>{LANG_MY_ADS} <span class="badge">{MYADS}</span> </a></li>
                                    <li><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i>{LANG_FAVOURITE_ADS} <span class="badge">{FAVORITEADS}</span> </a></li>
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
            <!-- Page-Content -->
            <div class="col-sm-9 page-content">
                <div class="my-quickad section"  id="post-form">
                    <h2>{LANG_CURRENT_PLAN}</h2>
                    <table width="100%" cellspacing="1" cellpadding="5" class="table table-striped table-hover">
                        <tr class="no-mar no-pad">
                            <th>{LANG_MEMBERSHIP}</th>
                            <th>{LANG_COST}</th>
                            <th>{LANG_TERM}</th>
                            <th>{LANG_STATUS}</th>
                            <th>{LANG_START_DATE}</th>
                            <th>{LANG_EXPIRY_DATE}</th>
                            IF("{SHOW_CANCEL_BUTTON}"=="1"){ <th>{LANG_CANCEL}</th>{:IF}
                        </tr>
                        <tr class="alt-row">
                            <td>{UPGRADE_TITLE}</td>
                            <td>{CURRENCY_SIGN}{UPGRADE_COST}</td>
                            <td>{UPGRADE_TERM}</td>
                            <td>{UPGRADE_STATUS}</td>
                            <td>{UPGRADE_START_DATE}</td>
                            <td>{UPGRADE_EXPIRY_DATE}</td>
                            IF("{SHOW_CANCEL_BUTTON}"=="1"){
                            <td><a href="{LINK_MEMBERSHIP}/?action=cancel_auto_renew"><i class="fa fa-remove"></i> {LANG_CANCEL}</a></td>
                            {:IF}
                        </tr>
                        <tr>
                            <td colspan="7">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right" colspan="7"><button type="button" class="btn btn-primary" onClick="window.location.href='{LINK_MEMBERSHIP}/changeplan'">{LANG_CHANGE_PLAN}</button></td>
                        </tr>

                    </table>


                </div>


            </div>
            <!-- # End Page-Content -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- ad-dashboard-page -->
{OVERALL_FOOTER}