{OVERALL_HEADER}
<!-- signin-page -->
<section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2>{LANG_USER_LOGIN}</h2>

                    <div class="social-signup socialLoginDivHide" style="padding-bottom: 20px;">
                        <div class="row">
                            IF("{FACEBOOK_APP_ID}"!=""){
                            <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                            {:IF}
                            IF("{GOOGLE_APP_ID}"!=""){
                            <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google"></i> <span>Google</span></a></div>
                            {:IF}
                        </div>
                        <div class="clear"></div>
                    </div>
                    IF("{ERROR}"!=""){
                    <article class="byMsg byMsgError" style="margin-bottom: 40px;" id="formErrors">! {ERROR}</article>
                    {:IF}
                    <!-- form -->
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{LANG_USERNAME} / {LANG_EMAIL}" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="{LANG_PASSWORD}" name="password">
                        </div>
                        <input type="hidden" name="ref" value="{REF}"/>
                        <button type="submit" name="submit" id="submit" class="btn ">{LANG_LOGIN}</button>
                        &nbsp;&nbsp;
                    </form>
                    <!-- form -->
                    <!-- forgot-password -->
                    <div class="user-option">
                        <div class="checkbox pull-left">
                            <label for="logged"><input type="checkbox" name="logged" id="logged">{LANG_KEEP_ME_LOGIN}</label>
                        </div>
                        <div class="pull-right forgot-password"><a href="{LINK_LOGIN}?fstart=1">{LANG_FORGOTPASS}?</a>
                        </div>
                    </div>
                    <!-- forgot-password -->
                </div>
                <a href="{LINK_SIGNUP}" class="btn-primary">{LANG_CREATE_NEW_ACCOUNT}</a></div>
            <!-- user-login -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- signin-page -->
{OVERALL_FOOTER}