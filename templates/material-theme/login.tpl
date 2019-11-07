{OVERALL_HEADER}
<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">{LANG_LOGIN}</li>
        </ol>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                <div class="middle-dabba">
                    <h1>{LANG_LOGIN_HERE}</h1>

                    <div class="social-signup" style="padding-bottom: 20px;">
                        <div class="row">
                            <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                            <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google-plus"></i> <span>Google+</span></a></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div id="post-form" style="padding:10px">
                        IF("{ERROR}"!=""){
                        <article class="byMsg byMsgError" style="margin-bottom: 40px;" id="formErrors">! {ERROR}</article>
                        {:IF}
                        <form method="post">
                            <div class="input-field">
                                <label for="username">{LANG_USERNAME} / {LANG_EMAIL}</label>
                                <input type="text" name="username" id="username">
                            </div>
                            <!--end form-group-->
                            <div class="input-field">
                                <label for="password">{LANG_PASSWORD}</label>
                                <input type="password" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="ref" value="{REF}"/>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect">{LANG_LOGIN}</button>&nbsp;&nbsp;
                                <a href="{LINK_LOGIN}?fstart=1" class="forgotlink">{LANG_FORGOTPASS}?</a>
                            </div>
                            <!--end form-group-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
</div>
<!--end page-content-->

{OVERALL_FOOTER}