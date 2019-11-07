{OVERALL_HEADER}

<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">{LANG_HOME}</a></li>
            <li class="active">{LANG_REGISTER}</li>
        </ol>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                <div class="middle-dabba">
                    <h1>{LANG_REGISTER}</h1>
                    <div class="social-signup" style="padding-bottom: 20px;">
                        <div class="row">
                            <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                            <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google-plus"></i> <span>Google+</span></a></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="post-form" style="padding:10px">
                        <form method="post" action="#" accept-charset="UTF-8">
                            <div class="input-field">
                                <label for="name">{LANG_FIRST_NAME}</label>
                                <input type="text" value="{NAME_FIELD}" id="name" name="name" onBlur="checkAvailabilityName()">
                            </div>
                            <span id="name-availability-status">IF("{NAME_ERROR}"!=""){ {NAME_ERROR} {:IF}</span>
                            <div class="input-field">
                                <label for="username">{LANG_USERNAME}</label>
                                <input type="text" value="{USERNAME_FIELD}" id="Rusername" name="username" onBlur="checkAvailabilityUsername()">
                            </div>
                            <span id="user-availability-status">IF("{USERNAME_ERROR}"!=""){ {USERNAME_ERROR} {:IF}</span>
                            <div class="input-field">
                                <label for="email">{LANG_EMAIL}</label>
                                <input type="email" value="{EMAIL_FIELD}" name="email" id="email" onBlur="checkAvailabilityEmail()">
                                <span id="email-availability-status">IF("{EMAIL_ERROR}"!=""){ {EMAIL_ERROR} {:IF}</span>
                            </div>

                            <!--end input-field-->
                            <div class="input-field">
                                <label for="password">{LANG_PASSWORD}</label>
                                <input type="password" id="Rpassword" name="password" onBlur="checkAvailabilityPassword()">
                                <span id="password-availability-status">IF("{PASSWORD_ERROR}"!=""){ {PASSWORD_ERROR} {:IF}</span>
                            </div>

                            <!--end input-field-->
                            <div class="input-field">
                                <div class="text-xs-center">
                                    IF("{RECAPTCHA_MODE}"=="1"){
                                    <div style="display: inline-block;" class="g-recaptcha" data-sitekey="{RECAPTCHA_PUBLIC_KEY}"></div>
                                    {:IF}
                                </div>
                                <span>IF("{RECAPTCH_ERROR}"!=""){ {RECAPTCH_ERROR} {:IF}</span>
                            </div>

                            <div class="input-field center">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect">{LANG_REGISTER_NOW}</button>
                            </div>
                            <!--end input-field-->
                            <hr>

                            <p class="center">{LANG_BY_CLICK_REGISTER} <a href="{TERMCONDITION_LINK}">{LANG_TERM_CON}</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--end ro-->
    </div>
    <!--end container-->
</div>
<!--end page-content-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>

    var error = "";

    function checkAvailabilityName() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
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
        var $item = $("#Rusername");
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'username=' + $("#Rusername").val(),
            type: "POST",
            success: function (data) {
                if (data != "success") {
                    error = 1;
                    console.log(error);
                    $item.removeClass('has-success');
                    $("#user-availability-status").html(data);
                    $item.addClass('has-error  mar-zero');
                }
                else {
                    error = 0;
                    console.log(error);
                    $item.removeClass('has-error mar-zero');
                    $("#user-availability-status").html("");
                    $item.addClass('has-success mar-zero');
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
            url: "check_availability.php",
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
            url: "check_availability.php",
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