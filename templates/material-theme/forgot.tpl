{OVERALL_HEADER}

<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li><a href="{LINK_LOGIN}">{LANG_LOGIN}</a></li>
            <li class="active">{LANG_FORGOTPASS}</li>
        </ol>
        <!--end breadcrumb-->
        <section>
            <div class="row">
                <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                    <div class="middle-dabba">
                    <h1>{LANG_CHANGE_PASS}</h1>
                    <div style="padding:10px">


                        <form name="form1" method="post" action="{LINK_LOGIN}" id="send">
                            <p>
                                IF("{FORGOT_ERROR}"!=""){<article class="byMsg byMsgError" id="formErrors">! {FORGOT_ERROR}</article>{:IF}
                            </p>
                            <div class="input-field">
                                <span class="fbold">{LANG_USERNAME} : </span> {USERNAME}<br />
                            </div>

                            <div class="input-field">
                                <label for="password">{LANG_PASSWORD}</label>
                                <input type="password" name="password" id="password"/>
                            </div>

                            <div class="input-field">
                                <label for="password2">{LANG_CONPASS}</label>
                                <input type="password" name="password2" id="password2"/>
                            </div>

                            <div class="input-field">
                                <input type="hidden" name="forgot" id="forgot" value="{FIELD_FORGOT}">
                                <input type="hidden" name="r" id="r" value="{FIELD_R}">
                                <input type="hidden" name="e" id="e" value="{FIELD_E}">
                                <input type="hidden" name="t" id="t" value="{FIELD_T}">
                                <input type="hidden" name="type" id="type" value="{FIELD_TYPE}">
                                <input name="Submit" type="hidden" id="Submit" value="Login">
                                <button class="btn btn-primary waves-effect" type="submit" name="Submit"><span>{LANG_CHANGE_PASS}</span></button>
                            </div>

                        </form>
                    </div>
                </div>
                </div>
            </div>

        </section>
        <!--end ro-->
    </div>
    <!--end container-->
</div>
<!--end page-content-->


{OVERALL_FOOTER}