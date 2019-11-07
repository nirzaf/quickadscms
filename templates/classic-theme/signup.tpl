{OVERALL_HEADER}
<!-- signup-page -->
<section id="main" class="clearfix user-page">
    <div class="container">
        <div class="row text-center"><!-- user-login -->
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2>{LANG_CREATE_AN_ACCOUNT}</h2>

                    <div class="social-signup socialLoginDivHide" style="padding-bottom: 20px;">
                        <div class="row">
                            IF("{FACEBOOK_APP_ID}"!=""){
                            <div class="col-xs-6">
                                <a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a>
                            </div>
                            {:IF}
                            IF("{GOOGLE_APP_ID}"!=""){
                            <div class="col-xs-6">
                                <a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google"></i> <span>Google</span></a>
                            </div>
                            {:IF}
                        </div>
                        <div class="clear"></div>
                    </div>
                    <form action="#" method="post" accept-charset="UTF-8">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{LANG_FULL_NAME}" value="{NAME_FIELD}" id="name" name="name" onBlur="checkAvailabilityName()">
                            <span id="name-availability-status">IF("{NAME_ERROR}"!=""){ {NAME_ERROR} {:IF}</span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{LANG_USERNAME}" value="{USERNAME_FIELD}" id="Rusername" name="username" onBlur="checkAvailabilityUsername()">
                            <span id="user-availability-status">IF("{USERNAME_ERROR}"!=""){ {USERNAME_ERROR} {:IF}</span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="{LANG_EMAIL}" value="{EMAIL_FIELD}" name="email" id="email" onBlur="checkAvailabilityEmail()">
                            <span id="email-availability-status">IF("{EMAIL_ERROR}"!=""){ {EMAIL_ERROR} {:IF}</span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="{LANG_CONPASS}" id="Rpassword" name="password" onBlur="checkAvailabilityPassword()">
                            <span id="password-availability-status">IF("{PASSWORD_ERROR}"!=""){ {PASSWORD_ERROR} {:IF}</span>
                        </div>
                        <div class="form-group text-center">
                            <div class="text-xs-center">
                                IF("{RECAPTCHA_MODE}"=="1"){
                                <div style="display: inline-block;" class="g-recaptcha" data-sitekey="{RECAPTCHA_PUBLIC_KEY}"></div>
                                {:IF}
                            </div>
                            <span>IF("{RECAPTCH_ERROR}"!=""){ {RECAPTCH_ERROR} {:IF}</span>
                        </div>
                        <div class="checkbox">
                            <label class="pull-left checked" for="signing">
                                <input type="checkbox" name="signing" id="signing">
                                {LANG_BY_CLICK_REGISTER} {LANG_TERM_CON}
                            </label>
                        </div>

                        <!-- checkbox -->
                        <button type="submit" name="submit" id="submit" class="btn">{LANG_REGISTER_NOW}</button>
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
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>

    var error = "";

    function checkAvailabilityName() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'name=' + $("#name").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#name").removeClass('has-success');
                    $("#name-availability-status").html(data);
                    $("#name").addClass('has-error mar-zero');
                }
                else {
                    error = 0;
                    $("#name").removeClass('has-error mar-zero');
                    $("#name-availability-status").html("");
                    $("#name").addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityUsername() {
        var $item = $("#Rusername").closest('.form-group');
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'username=' + $("#Rusername").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $item.removeClass('has-success');
                    $("#user-availability-status").html(data);
                    $item.addClass('has-error');
                }
                else {
                    error = 0;
                    $item.removeClass('has-error');
                    $("#user-availability-status").html("");
                    $item.addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityEmail() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#email").removeClass('has-success');
                    $("#email-availability-status").html(data);
                    $("#email").addClass('has-error mar-zero');
                }
                else {
                    error = 0;
                    $("#email").removeClass('has-error mar-zero');
                    $("#email-availability-status").html("");
                    $("#email").addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkAvailabilityPassword() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "{APP_URL}check_availability.php",
            data: 'password=' + $("#Rpassword").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    $("#Rpassword").removeClass('has-success');
                    $("#password-availability-status").html(data);
                    $("#Rpassword").addClass('has-error mar-zero');
                }
                else {
                    error = 0;
                    $("#Rpassword").removeClass('has-error mar-zero');
                    $("#password-availability-status").html("");
                    $("#Rpassword").addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }

</script>
{OVERALL_FOOTER}