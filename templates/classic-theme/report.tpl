{OVERALL_HEADER}
<style>
    label{margin-top: 40px;}
</style>
<!-- signup-page -->
<section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center"><!-- user-login -->
            <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                <div class="user-account clearfix">
                    <h2 style="margin-bottom: 50px;">{LANG_REPORTVIO}</h2>

                    <form action="#" method="post">
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_YNAME}
                                IF("{NAME_ERROR}"!=""){ <span class="required">({NAME_ERROR})</span>{:IF}
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control border-form" type="text" name="name" value="{NAME}"
                                       placeholder="{LANG_YNAME}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_YEMAIL} IF("{EMAIL_ERROR}"!=""){ <span
                                    class="redc">({EMAIL_ERROR})</span>{:IF}</label>

                            <div class="col-sm-9">
                                <input class="form-control border-form" type="email" name="email" value="{EMAIL}"
                                       placeholder="{LANG_YEMAIL}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_YUSERNAME}</label>

                            <div class="col-sm-9">
                                <input class="form-control border-form" type="text" name="username" value="{USERNAME}"
                                       placeholder="{LANG_YUSERNAME}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_VIOLATION} {LANG_TYPE}</label>

                            <div class="col-sm-9">
                                <select name="violation" class="form-control">
                                    <option>Select {LANG_VIOLATION} {LANG_TYPE}</option>
                                    <option value="{LANG_POSTCONTACT}">{LANG_POSTCONTACT}</option>
                                    <option value="{LANG_ADVWEBSITE}">{LANG_ADVWEBSITE}</option>
                                    <option value="{LANG_FAKEPROJ}">{LANG_FAKEPROJ}</option>
                                    <option value="{LANG_ABNORMALBID}">{LANG_ABNORMALBID}</option>
                                    <option value="{LANG_OTHER}">{LANG_OTHER}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_USEROTHER}</label>

                            <div class="col-sm-9">
                                <input class="form-control border-form" type="text" name="username2" value="{USERNAME2}"
                                       placeholder="{LANG_USEROTHER}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_URLVIOLATION}</label>

                            <div class="col-sm-9">
                                <input class="form-control border-form" type="text" name="url" value="{REDIRECT_URL}"
                                       placeholder="{LANG_URLVIOLATION}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">{LANG_VIODETAILS} IF("{VIOL_ERROR}"!=""){ <span
                                    class="redc">({VIOL_ERROR})</span>{:IF} </label>

                            <div class="col-sm-9">
                                <textarea class="form-control border-form" name="details">{DETAILS}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="Submit" id="submit" href="#" class="btn">{LANG_REPORTVIO}</button>
                        </div>
                    </form>
                    <!-- checkbox -->
                </div>
            </div>
            <!-- user-login -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- signup-page -->
</div>
{OVERALL_FOOTER}