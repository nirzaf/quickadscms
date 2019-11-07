<?php
// Path to root directory of app.
require_once('../includes/config.php');
require_once('../includes/sql_builder/idiorm.php');
require_once('../includes/db.php');
require_once('../includes/functions/func.global.php');
require_once('../includes/functions/func.admin.php');
require_once('../includes/functions/func.users.php');
require_once('../includes/functions/func.sqlquery.php');
require_once('../includes/lang/lang_'.$config['lang'].'.php');

admin_session_start();

if (isset($_SESSION['admin']['id'],
    $_SESSION['admin']['username'],
    $_SESSION['admin']['login_string'])) {
    echo '<script>window.location="index.php"</script>';
}

if(isset($_POST['username']))
{
    if($config['recaptcha_mode'] == 1){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            //your site secret key
            $secret = $config['recaptcha_private_key'];
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $recaptcha_responce = true;
            }else{
                $recaptcha_responce = false;
                $recaptcha_error = $lang['RECAPTCHA_ERROR'];
            }
        }else{
            $recaptcha_responce = false;
            $recaptcha_error = $lang['RECAPTCHA_CLICK'];
        }
    }else{
        $recaptcha_responce = true;
    }

    if($recaptcha_responce){
        if(adminlogin($_POST['username'],$_POST['password']))
        {
            echo '<script>window.location="index.php"</script>';
            exit;
        }
        else
        {
            $error = "Error: Username & Password do not match";
        }
    }else{
        $error = "Error: reCAPTCHA error";
    }

}

?>


<!DOCTYPE html>

<html class="app-ui">

<head>
    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <!-- Document title -->
    <title><?php echo $config['site_title']?> - Admin Login</title>

    <meta name="description" content="Quickad Classified Admin Template Login" />
    <meta name="robots" content="noindex, nofollow" />

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href=../storage/logo/<?php echo $config['site_favicon']?>">

    <!-- Google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

    <!-- Zeunix CSS stylesheets -->
    <link rel="stylesheet" id="css-font-awesome" href="assets/css/font-awesome.css" />
    <link rel="stylesheet" id="css-ionicons" href="assets/css/ionicons.css" />
    <link rel="stylesheet" id="css-bootstrap" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" id="css-app" href="assets/css/app.css" />
    <link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" />
    <!-- End Stylesheets -->
</head>

<body class="app-ui">
<div class="app-layout-canvas">
    <div class="app-layout-container">


        <main class="app-layout-content">


            <!-- Page content -->
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <!-- Login card -->
                        <div class="col-md-6 col-md-offset-3">
                            <div class="text-center"><img class="img-responsive" src="../storage/logo/<?php echo $config['site_admin_logo']?>"/></div>
                            <div class="card">
                                <h3 class="card-header h4">Login</h3>
                                <div class="card-block">
                                    <span style="color:#df6c6e;">
                                    <?php
                                    if(!empty($error)){
                                        echo '<div class="byMsg byMsgError">! '.$error.'</div>';
                                    }
                                    ?>
                                </span>
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Email</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" />
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="login_password">Password</label>
                                            <input type="password" name="password" class="form-control" id="login_password" placeholder="Password" />
                                        </div>
                                        <?php
                                        if($config['recaptcha_mode']== 1){
                                            ?>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="g-recaptcha" data-sitekey="<?php echo $config['recaptcha_public_key'] ?>"></div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label for="frontend_login_remember" class="css-input switch switch-sm switch-app">
                                                <input type="checkbox" id="frontend_login_remember" /><span></span> Remember me</a>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-app btn-block" name="login">Login</button>
                                    </form>
                                </div>
                                <!-- .card-block -->
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col-md-6 -->
                        <!-- End login -->

                        <!-- End sign up -->

                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- End page content -->


        </main>

    </div>
    <!-- .app-layout-container -->
</div>
<!-- .app-layout-canvas -->


<!-- Zeunix Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/core/jquery.slimscroll.min.js"></script>
<script src="assets/js/core/jquery.scrollLock.min.js"></script>
<script src="assets/js/core/jquery.placeholder.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/app-custom.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>
