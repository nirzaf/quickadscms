{OVERALL_HEADER}

<div id="page-content">
    <div class="container">
        <ul class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active"><a>{LANG_DASHBOARD}</a></li>
        </ul>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <!--end breadcrumb-->
        <section class="page-title center"><h1>{LANG_DASHBOARD}</h1></section>
        <!--end page-title-->
        <section>
            <div class="row">
                <aside class="col-md-3 col-sm-12">
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> {LANG_MY_CLASSIFIED} <a class="pull-right" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="MyClassified" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li class="active"><a href="{LINK_DASHBOARD}" class="waves-effect"><i class="fa fa-home"></i> {LANG_DASHBOARD} </a></li>
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
                                        <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i> {LANG_MY_ADS}<span class="badge">{MYADS}</span> </a></li>
                                        <li><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i> {LANG_FAVOURITE_ADS} <span class="badge">{FAVORITEADS}</span> </a></li>
                                        <li><a href="{LINK_PENDINGADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_PENDING-APPROVAL}<span class="badge">{PENDINGADS}</span></a></li>
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
                                        <li><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING}</a></li>
                                        <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i> {LANG_LOGOUT}</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-md-9 col-sm-12">
                    <form id="uploadForm" method="post" action="#" enctype="multipart/form-data">
                        <section>
                            <div class="user-details box">
                                <div class="user-image">
                                    <div class="image">
                                        <div class="bg-transfer">
                                            <img src="{SITE_URL}storage/profile/small_{AUTHORIMG}">
                                        </div>
                                        <!--end bg-transfer-->
                                        <div class="single-file-input">
                                            <input type="file" id="avatar" name="avatar">
                                            <div>{LANG_UPLOAD_PICTURE} <i class="fa fa-upload"></i></div>
                                        </div>
                                    </div>
                                    <!--end image-->
                                </div>
                                <!--end user-image-->
                                <div class="description clearfix">
                                    <h3>&nbsp;</h3>
                                    <h2>{AUTHORNAME}</h2>
                                    <a href="{LINK_ACCOUNT_SETTING}" class="btn btn-default btn-rounded scroll btn-xs">{LANG_ACCOUNT_SETTING}</a>
                                    <hr>
                                    <figure>
                                        <div class="pull-left"><strong>{LANG_JOIN_DATE} :</strong></div>
                                        <div class="pull-right">Feb 09, 2017</div>
                                    </figure>
                                </div>
                                <!--end description-->
                            </div>
                        </section>
                        <!--end user-details-->
                        <section>
                            {LOOP: ERRORS}
                            <article class="byMsg byMsgError" id="formErrors">! {ERRORS.message}</article>
                            {/LOOP: ERRORS}
                        </section>
                        <section>
                            <h3>{LANG_ABOUT_YOU}</h3>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="name">{LANG_FULL_NAME}</label>
                                        <input type="text" name="name" id="name" value="{AUTHORNAME}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-12-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="email">{LANG_EMAIL}</label>
                                        <input id="email" type="email" value="{EMAIL}" disabled required=""></div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="phone">{LANG_PHONE}</label>
                                        <input type="text" name="phone" id="Phone" value="{PHONE}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="postcode">{LANG_POSTCODE}</label>
                                        <input type="text" name="postcode" id="postcode" value="{POSTCODE}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="address">{LANG_ADDRESS}</label>
                                        <input type="text" id="address" rows="1" name="address" value="{ADDRESS}"/>
                                    </div>
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="city">{LANG_CITY}</label>
                                        <input type="text" id="city" rows="1" name="city" value="{CITY}"/>
                                    </div>
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <select name="country" class="meterialselect">
                                            {LOOP: COUNTRY}
                                            <option value="{COUNTRY.name}" IF("{COUNTRY}"=="{COUNTRY.name}"){ selected {:IF}>{COUNTRY.name}</option>
                                            {/LOOP: COUNTRY}
                                        </select>
                                        <label>{LANG_COUNTRY}</label>
                                    </div>
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="heading">{LANG_PROFILE_TAGLINE}</label>
                                        <input type="text" name="heading" id="heading" value="{AUTHORTAGLINE}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-12-->
                            </div>
                            <!--end row-->
                            <div class="input-field col s12">
                                <label for="content">{LANG_ABOUT_ME}</label>
                                <textarea class="materialize-textarea" id="content" rows="2" name="content">{AUTHORABOUT}</textarea>
                            </div>
                            <!--end input-field-->
                        </section>
                        <section><h3>{LANG_SOCIAL_NETWORKS}</h3>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" name="facebook" id="facebook" value="{FACEBOOK}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" name="twitter" id="twitter" value="{TWITTER}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="googleplus">Google+</label>
                                        <input type="text" name="googleplus" id="googleplus" value="{GOOGLEPLUS}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" name="instagram" id="instagram" value="{INSTAGRAM}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="linkedin">Linked In</label>
                                        <input type="text" name="linkedin" id="linkedin" value="{LINKEDIN}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-field">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" name="youtube" id="youtube" value="{YOUTUBE}">
                                    </div>
                                    <!--end input-field-->
                                </div>
                                <!--end col-md-6-->
                            </div>
                            <!--end row-->
                        </section>
                        <div>
                            <h3>{LANG_NEWSLETTER}</h3>
                            <div class="row form-group">
                                <label class="col-md-1 label-title">&nbsp; </label>
                                <div class="col-md-11">
                                    <div class="checkbox checkbox-inline checkbox-primary ">
                                        <input type="checkbox" name="notify" id="notify" value="1" onchange="NotifyValueChanged()" IF("{NOTIFY}"=="1"){ checked {:IF}>
                                        <label for="notify">{LANG_NOTIFYEMAIL}</label>
                                    </div>
                                    <div class="skills" style="margin: 0 25px">
                                        {LOOP: CATEGORY}
                                            <div class="checkbox checkbox-inline checkbox-primary">
                                                <input type="checkbox" name="choice[{CATEGORY.id}]" id="{CATEGORY.id}" value="{CATEGORY.id}" {CATEGORY.selected}>
                                                <label for="{CATEGORY.id}">{CATEGORY.name}</label>
                                            </div>
                                            <br>
                                        {/LOOP: CATEGORY}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <section class="center">
                            <div class="input-field">
                                <input type="submit" class="btn btn-primary btn-rounded" name="submit" value="{LANG_UPDATE}">
                            </div>
                            <!--end input-field-->
                        </section>
                    </form>
                    <!--end form-->
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </section>
    </div>
    <!--end container-->
</div>
<!--end page-content-->

{OVERALL_FOOTER}
<script type="text/javascript">
    function NotifyValueChanged()
    {
        if($('#notify').is(":checked"))
            $(".skills").show();
        else
            $(".skills").hide();
    }
    NotifyValueChanged();
</script>