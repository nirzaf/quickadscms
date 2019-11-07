{OVERALL_HEADER}
<!-- main -->
<section id="main" class="clearfix page">
    <div class="container">

        <div class="breadcrumb-section">
            <ul class="breadcrumb bcstyle2">
                <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                <li class="active"><a>{LANG_FEEDBACK}</a></li>
            </ul>
            <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
            <!--end breadcrumb-->
            <section class="page-title center"><h1>{LANG_FEEDBACK}</h1></section>
        </div>
        <div class="section">
            <div class="feed-back">
                <h3>{LANG_WHAT_YOU_THINK}</h3>

                <div class="feed-back-form">
                    <form method="post">
                        <span>{LANG_USER_DETAILS}</span>
                        <input type="text" class="form-control" name="name" placeholder="{LANG_FULL_NAME}" required="">
                        <input type="text" class="form-control" name="email" placeholder="{LANG_EMAIL}" required="">
                        <input type="text" class="form-control" name="phone" placeholder="{LANG_PHONE_NO}">
                        <input type="text" class="form-control" name="subject" placeholder="{LANG_SUBJECT}" required="">
                        <!---728x90--->
                        <span>{LANG_ANYTHING_TO_TELL}?</span>
                        <textarea type="text" class="form-control" name="message" placeholder="{LANG_MESSAGE}..." required=""></textarea>
                        <input type="submit" name="Submit" class="btn btn-primary" value="{LANG_SUBMIT}">
                    </form>
                </div>
            </div>
        </div>
    </div><!-- container -->
</section><!-- main -->


{OVERALL_FOOTER}