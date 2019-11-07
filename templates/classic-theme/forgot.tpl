{OVERALL_HEADER}
<!-- signin-page -->
<section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">

                    <h2>{LANG_CHANGE-PASS}</h2>

                    IF("{FORGOT_ERROR}"!=""){
                    <article class="byMsg byMsgError" id="formErrors">! {FORGOT_ERROR}</article>
                    {:IF}

                    <!-- form -->
                    <form method="post">
                        <div class="form-group"><span class="fbold">{LANG_USERNAME} : </span> {USERNAME}<br/>
                        </div>
                        <div class="form-group">
                            <label for="password">{LANG_PASSWORD}</label>
                            <input type="password" class="form-control" name="password" id="password"/>
                        </div>
                        <div class="form-group">
                            <label for="password2">{LANG_CONPASS}</label>
                            <input type="password" class="form-control" name="password2" id="password2"/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="forgot" id="forgot" value="{FIELD_FORGOT}">
                            <input type="hidden" name="r" id="r" value="{FIELD_R}">
                            <input type="hidden" name="e" id="e" value="{FIELD_E}">
                            <input type="hidden" name="t" id="t" value="{FIELD_T}">
                            <input type="hidden" name="type" id="type" value="{FIELD_TYPE}">
                            <input name="Submit" type="hidden" id="Submit" value="Login">
                            <button class="btn" type="submit" name="Submit"><span>{LANG_CHANGE_PASS}</span></button>
                        </div>
                    </form>
                    <!-- form -->
                </div>
            </div>
            <!-- user-login -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- signin-page -->
{OVERALL_FOOTER}