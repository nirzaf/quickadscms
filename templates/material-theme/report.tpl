{OVERALL_HEADER}


<div class="row">
    <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
        <div class="middle-container">
            <div class="middle-dabba">
                <h1>{LANG_REPORTVIO}</h1>
                <div id="post-form" style="padding:10px">
                    <form name="form1" method="post" action="" id="send">

                        <div class="input-field">
                            <label for="name">{LANG_YNAME} IF("{NAME_ERROR}"!=""){<span class="redc">({NAME_ERROR})</span>{:IF}</label>
                            <input name="name" type="text" id="name" value="{NAME}">
                        </div>

                        <div class="input-field">
                            <label for="email">{LANG_YEMAIL} IF("{EMAIL_ERROR}"!=""){<span class="redc">({EMAIL_ERROR})</span>{:IF}</label>
                            <input name="email" type="text" id="email"  value="{EMAIL}">
                        </div>

                        <div class="input-field">
                            <label for="username">{LANG_YUSERNAME}</label>
                            <input name="username" type="text" id="username" value="{USERNAME}" >
                        </div>
                        <div class="input-field">

                            <select name="violation" class="meterialselect">
                                <option>Select {LANG_VIOLATION} {LANG_TYPE}</option>
                                <option value="{LANG_POSTCONTACT}">{LANG_POSTCONTACT}</option>
                                <option value="{LANG_ADVWEBSITE}">{LANG_ADVWEBSITE}</option>
                                <option value="{LANG_FAKEPROJ}">{LANG_FAKEPROJ}</option>
                                <option value="{LANG_ABNORMALBID}">{LANG_ABNORMALBID}</option>
                                <option value="{LANG_OTHER}">{LANG_OTHER}</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="username2">{LANG_USEROTHER}</label>
                            <input name="username2" type="text" id="username2" value="{USERNAME2}" size="42">
                        </div>
                        <div class="input-field">
                            <label for="url">{LANG_URLVIOLATION}</label>
                            <input name="url" type="text" id="url" size="42" value="{REDIRECT_URL}">
                        </div>
                        <div class="input-field">
                            <label for="details">{LANG_VIODETAILS} IF("{VIOL_ERROR}"!=""){<span class="redc">({VIOL_ERROR})</span>{:IF}</label>
                            <textarea name="details" class="materialize-textarea" cols="32" rows="6" id="details">{DETAILS}</textarea></div>
                        </div>
                        <div class="input-field center">
                            <input type="submit" name="Submit" class="btn btn-primary btn-rounded" value="{LANG_REPORTVIO}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}