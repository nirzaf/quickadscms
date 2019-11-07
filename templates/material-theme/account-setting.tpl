{OVERALL_HEADER}
<div id="page-content">
    <div class="container">
        <ul class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active"><a>{LANG_ACCOUNT_SETTING}</a></li>
        </ul>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <!--end breadcrumb-->
        <section class="page-title center"><h1>{LANG_SETTING}</h1></section>
        <!--end page-title-->
        <section>
            <div class="row">
                <aside class="col-md-3 col-sm-12">
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> {LANG_MY_CLASSIFIED} <a class="pull-right" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="MyClassified" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_DASHBOARD}" class="waves-effect"><i class="fa fa-home"></i> {LANG_DASHBOARD}</a></li>
                                        <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"><i class="fa fa-user"></i> {LANG_PROFILE_PUBLIC}</a></li>
                                        <li><a href="{LINK_POST-AD}" class="waves-effect"><i class="fa fa-pencil"></i> {LANG_POST_AD}</a></li>
                                        <li><a href="{LINK_MEMBERSHIP}" class="waves-effect"><i class="fa fa-shopping-bag"></i> {LANG_MEMBERSHIP} </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box"><h5 class="collapse-title"> {LANG_MY_ADS} <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>

                                <div id="MyAds" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i> {LANG_MY_ADS}<span class="badge">{MYADS}</span> </a></li>
                                        <li><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i> {LANG_FAVOURITE_ADS} <span class="badge">{FAVORITEADS}</span> </a></li>
                                        <li><a href="{LINK_PENDINGADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_PENDING-APPROVAL}<span class="badge">{PENDINGADS}</span></a></li>
                                        <li><a href="{LINK_HIDDENADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_HIDDEN_ADS} <span class="badge">{HIDDENADS}</span></a></li>
                                        <li><a href="{LINK_EXPIREADS}" class="waves-effect"><i class="fa fa-calendar-times-o"></i> {LANG_EXPIRE_ADS} <span class="badge">{EXPIREADS}</span></a>
                                        <li><a href="{LINK_RESUBMITADS}" class="waves-effect"><i class="fa fa-flag"></i> {LANG_RESUBMITED_ADS} <span class="badge">{RESUBMITADS}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> {LANG_MY_ACCOUNT} <a class="pull-right" data-toggle="collapse" href="#account"><i class="fa fa-angle-down"></i></a></h5>
                                <div id="account" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li><a href="{LINK_TRANSACTION}" class="waves-effect"><i class="fa fa-money"></i> {LANG_TRANSACTION}</a></li>
                                        <li class="active"><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i> {LANG_ACCOUNT_SETTING}</a></li>
                                        <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i> {LANG_LOGOUT}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-md-9 col-sm-12">
                    <section>
                        <h3>{LANG_ACCOUNT_SETTING}</h3>
                        <div class="row">
                            <form method="post" action="#">
                                <div class="input-field">
                                    <label for="email">{LANG_EMAIL}</label>
                                    <input type="email" name="email" id="email" value="{EMAIL_FIELD}"  onBlur="checkAvailabilityEmail()">
                                </div>
                                <span id="email-availability-status">IF("{EMAIL_ERROR}"!=""){ {EMAIL_ERROR} {:IF}</span>
                                <!--end input-field-->
                                <div class="input-field">
                                    <label for="username">{LANG_USERNAME}</label>
                                    <input type="text" name="username" id="username" value="{USERNAME_FIELD}" onBlur="checkAvailabilityUsername()">
                                </div>
                                <span id="user-availability-status">IF("{USERNAME_ERROR}"!=""){ {USERNAME_ERROR} {:IF}</span>
                                <!--end input-field-->
                                <input type="password" class="hide">
                                <div class="input-field">
                                    <label for="password">{LANG_NEWPASS}</label>
                                    <input type="password" name="password" id="password" onkeyup="checkAvailabilityPassword()" autocomplete="off">
                                </div>
                                <span id="password-availability-status">IF("{PASSWORD_ERROR}"!=""){ {PASSWORD_ERROR} {:IF}</span>
                                <div class="input-field center">
                                    <button type="submit" class="btn btn-primary btn-framed btn-rounded btn-light-frame" name="submit">{LANG_SAVE}</button>
                                </div>
                                <!--end input-field-->
                            </form>
                        </div>
                    </section>


                    <hr>
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </section>

    </div>
    <!--end container-->
</div> <!--end page-content-->
<script>
    var error = "";
    function checkAvailabilityUsername() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                if(data!="success"){
                    error = 1;
                    $("#username").removeClass('has-success');
                    $("#user-availability-status").html(data);
                    $("#username").addClass('has-error mar-zero');
                }
                else{
                    error = 0;
                    $("#username").removeClass('has-error mar-zero');
                    //$("#user-availability-status").html("<span class='status-available'>Username available</span>");
                    $("#user-availability-status").html("");
                    $("#username").addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
    function checkAvailabilityEmail() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
                if(data!="success"){
                    error = 1;
                    $("#email").removeClass('has-success');
                    $("#email-availability-status").html(data);
                    $("#email").addClass('has-error mar-zero');
                }
                else{
                    error = 0;
                    $("#email").removeClass('has-error mar-zero');
                    $("#email-availability-status").html("");
                    $("#email").addClass('has-success');
                }
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
    function checkAvailabilityPassword() {
        var length = $('#password').val().length;
        if(length != 0){
            var PASSLENG = "{LANG_PASSLENG}";
            if(length < 5 || length > 21){
                $("#password").removeClass('has-success');
                $("#password-availability-status").html("<span class='status-not-available'>"+PASSLENG+"</span>");
                $("#password").addClass('has-error mar-zero');
            }
            else{
                $("#password").removeClass('has-error');
                $("#password-availability-status").html("<span class='status-available'>Leave blank if don't want to change password.</span>");
                $("#password").addClass('has-success mar-zero');
            }
        }

    }
    $(window).load(function(){
        $('#password').val("");
    });
</script>
{OVERALL_FOOTER}