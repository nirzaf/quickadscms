{OVERALL_HEADER}
<!-- signin-page -->
<section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">

                    <h2>{LANG_FORGOTPASS}</h2>

                    IF("{SUCCESS}"!=""){
                    <div style="padding-top:20px">
                        <div class="callout callout-success">
                            <h4>{LANG_CONFIRMATION_MAIL_SENT}</h4>
                            <p>{SUCCESS}</p>
                        </div>
                    </div>
                    {:IF}

                    IF("{LOGIN_ERROR}"!=""){
                    <article class="byMsg byMsgError" id="formErrors" style="width:92%">! {LOGIN_ERROR}</article>
                    {:IF}

                    <!-- form -->
                    <form method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required="required">
                        </div>
                        <button type="submit" name="Submit" id="submit" class="btn ">{LANG_REQ_PASS}</button>
                        &nbsp;&nbsp;
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