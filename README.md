
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quickad classified PhpScript theme Documentation</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
    <link rel="stylesheet" type="text/css" href="assets/css/skin-blue.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- All dynamic styles -->
    <style type="text/css">
        .social,
        .content-header .version,
        .steps > li,
        aside::after {
            background: #72bf3b;
        }

        .main-header .sidebar-toggle::before,
        .skin-blue .sidebar-menu > li:hover > a,
        .skin-blue .sidebar-menu > li.active > a,
        .nav > li > a:hover,
        .nav > li > a:active,
        .nav > li > a:focus {
            color: #72bf3b
        }

        .nav.treeview-menu {
            border-color: #72bf3b;
        }

        .skin-blue .wrapper,
        .skin-blue .main-sidebar,
        .skin-blue .left-side {
            background: #333333;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .xdocs-pre-loader {
            background: url(assets/img/loader1.gif) center no-repeat #fff;
        }
    </style>

</head>

<body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">

<div class="xdocs-pre-loader"></div>
<div class="wrapper">
    <header class="main-header">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <ul class='social'>
            <li><a target='_blank' href='http://bylancer.com/product/quickad'><i class='fa fa-home'></i></a></li>
            <li><a target='_blank' href='http://facebook.com/bylancer.in'><i class='fa fa-facebook'></i></a></li>
            <li><a target='_blank' href='http://twitter.com/thebylancer'><i class='fa fa-twitter'></i></a></li>
            <li><a target='_blank' href='http://facebook.com/bylancer.in'><i class='fa fa-support'></i></a></li>
        </ul>
        <div class="logo">
            <img src="assets/img/logo-1.png" alt="" />
        </div>

        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="nav sidebar-menu">
                <li class="active"><a href="#introduction">Introduction</a>
                <li><a href="#Installing-Theme">Installation</a></li>
                <li><a href="#upgrading-theme">Upgrade</a></li>
                <li><a href="#Change-Theme">Change Theme</a></li>
                <li><a href="#social-login">Social Login</a>
                    <ul class="nav treeview-menu">
                        <li><a href="#facebook">Facebook.</a></li>
                        <li><a href="#google">Google.</a></li>
                    </ul>
                </li>
                <li><a href="#google-maps">Google Maps</a></li>
                <li><a href="#google-captcha">Google Captcha</a></li>
                <li><a href="#Theme-Features">Theme Setup</a>
                    <ul class="nav treeview-menu">
                        <li><a href="#choose-specific-country">How to choose specific country.</a></li>
                        <li><a href="#setup-home-page">How to setup home page.</a></li>
                    </ul>
                </li>


                <li><a href="#Manage-Category">Manage Category</a></li>
                <li><a href="#Manage-Customfield">Manage Custom-fields</a></li>
            </ul>
        </div>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content body">
            <!-- Introduction Section -------------------------------------------------------------->
            <section id="introduction">
                <div class='section-content'>
                    <div class="content-header">
                        <h1>Quickad Classified PhpScript Documentation</h1>
                        <div class="version"> Version 6.4</div> &nbsp; <div class="version"> Last Updated Documtation - 06 June 18</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="assets/screenshot/screen4.jpg" alt="" style="border: 1px solid #333;">
                        </div>
                        <div class="col-sm-6">
                            <h1>Welcome</h1>
                            <p>Thank you for purchasing Quickad Classified. We covered almost everything in this document that how easily you can setup this script. If you have any questions that are beyond the scope of this help file, please feel free to use the free support forums.</p>
                            <p><b>Author</b> : Bylancer</p>
                            <p><b>Demo</b> : <a href="https://bylancer.com/products/classified-php-script/" target="_blank">Quickad Demo</a> </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Installing Theme -------------------------------------------------------------->
            <section id="Installing-Theme" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#Installing-Theme' class='header-link'><i class='fa fa-link'></i></a>Installing Quickad Classified Script</h2>

                    <h2 id="installation"><a href="#installation">Installation</a></h2>

                    <strong>Before install, Your server must match following requirements to run the script properly</strong>
<pre><code>PHP 5.6.0+
OpenSSL PHP Extension
Mbstring PHP Extension
PHP Fileinfo extension
PHP Zip Archive
PDO PHP Extension
XML PHP Extension
JSON PHP Extension
Rewrite Module (Apache or Nginx)</code>
</pre>
                    <p>Please consider that some other php setting values might be required.</p>
<strong>PHP.INI Requirements</strong>
<pre><code>open_basedir must be disabled</code></pre>
<strong>File and folder permissions</strong>
<pre>
<code>/includes/config.php        775</code>
</pre>




                    <p>Create a new database on your mysql server, after unzpip the file you downloaded from CodeCanyon and upload the <br><strong>contents</strong> of <strong>QUICKAD-CMS-VER</strong> folder to your server root, usually <code>/path/to/www/</code> or <code>/path/to/html/</code> or <code>/path/to/public_html/</code>.</p>
                    <div class="alert alert-warning" role="alert">
                        <strong>Important:</strong>
                        Make sure that <strong>.htaccess</strong> file got copied properly from the download to main QuickadClassified folder on your server.
                    </div>
                    <ul>
                        <li>Open your site in the browser.</li>
                        <li>It will redirect to <strong>/install</strong> directory (like http://mysite.com to http://mysite.com/install)
                            <ul>
                                <li><strong>Step 1:</strong> Choose language and click next.</li>
                                <li><strong>Step 2:</strong> Write codecanyon purchase code.</li>
                                <li><strong>Step 3:</strong> Create a database with phpmyadmin.</li>
                                <li><strong>Step 4:</strong> Enter database dbhostname,dbusername,dbpassword,dbname. and click Next</li>
                                <li><strong>Step 5:</strong> Enter Admin login details. and click Next</li>
                            </ul>
                        </li>
                        <li class="p-t-10">All is done Installation completed. click on frontend and enjoy with Quickad</li>
                        <a href="assets/screenshot/install.jpg"><img class="size-full wp-image-124 alignnone" src="assets/screenshot/install.jpg" alt="Installation" width="1280" height="898"/></a>
                    </ul>


                </div>
            </section>

            <!-- Upgrading-theme -------------------------------------------------------------->
            <section id="upgrading-theme" class="stickem-container">
                <div class='section-content'>
                    <h2 class="page-header"><a href="#upgrading-theme" class="header-link"><i class="fa fa-link"></i></a>Upgrade</h2>

                    <ul>
                        <li>Step 1:- Go to Admin &gt; Update page.</li>
                        <li>Step 2:- Upload there QUICKAD-CMS-VERSION.zip file in uploader.</li>
                        <li>Step 3:- After uploading completed you can see install button.</li>
                        <li>Step 4:- Click on install button and wait for complete</li>
                        <li>Step 5:- Done.</li>
                    </ul>
                    <a href="assets/screenshot/update.png"><img class="size-full wp-image-124 alignnone" src="assets/screenshot/update.png" alt="update" width="1280" height="898"/></a>
                </div>
            </section>

            <!-- Change-Theme -------------------------------------------------------------->
            <section id="Change-Theme" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#Theme-Features' class='header-link'><i class='fa fa-link'></i></a>Change Theme</h2>
                    <p>Go to <strong>Admin &gt; Site Setting &gt; Change Theme</strong> and choose your theme and click on activate button.</p>

                    <a href="assets/screenshot/Change-Theme.png"><img class="size-full wp-image-124 alignnone" src="assets/screenshot/Change-Theme.png" alt="Change Theme" width="1280" height="898"/></a>
                    <p>More Theme Coming Soon</p>
                </div>
            </section>

            <!-- social-login -------------------------------------------------------------->
            <section id="social-login" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#social-login' class='header-link'><i class='fa fa-link'></i></a>Social Login</h2>



                    <div id='facebook' class='step-content clearfix'>
                        <h3 class='steps-header'><a href='#facebook'>Facebook</a></h3>
                        <p>To enable Facebook Login you just need Facebook App ID and App Secret.</p>
                        <p>This is a how to getting Facebook App ID and App Secret. Check this link.<br>
                            <a href="https://www.codexworld.com/create-facebook-app-id-app-secret/" target="_blank">How to Create Facebook App, App ID, and App Secret</a>
                        </p>
                    </div>
                    <div id='google' class='step-content clearfix'>
                        <h3 class='steps-header'><a href='#google'>Google</a></h3>
                        <p>To enable Google Login you just need Google App ID and App Secret.</p>
                        <p>This is a How to Create Google Developers Console Project. Check this link.<br>
                        <a href="https://www.codexworld.com/create-google-developers-console-project/" target="_blank">How to Create Google Developers Console Project</a>
                        </p>
                        <blockquote>Note : copy redirect url from Your Quickad admin > Setting > Social login setting
                            <img class="size-full wp-image-124 alignnone" src="assets/screenshot/social-login-redirecturl.png" alt="social-login-redirecturl" width="1280" height="898"/>
                        </blockquote>
                    </div>


                    <p>After getting App Id and App Secret, you have to setup your admin panel:</p>
                    <ul>
                        <li>Go to your <strong>Admin panel</strong> -&gt; <strong>Setting</strong> -&gt; <strong>Site Setting</strong> -&gt; <strong>Social Login Setting</strong></li>
                        <li>For Facebook: set '<strong>Facebook App ID</strong>' and '<strong>Facebook App Secret</strong>'</li>
                        <li>For Google: set '<strong>Google app ID</strong>' and '<strong>Google app Secret</strong>'</li>
                        <li>And save your changes.</li>
                    </ul>
                </div>
            </section>

            <!-- google-maps -------------------------------------------------------------->
            <section id="google-maps" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#google-maps' class='header-link'><i class='fa fa-link'></i></a>Google Maps</h2>

                    <div id='setup-gmap' class='step-content clearfix'>
                        <h3 class='steps-header'><a href='#setup-gmap'>How to setup Google map.</a> <span style="color:black;">(<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get Key</a>)</span></h3>
                        <p><strong>Admin panel setup</strong></p>
                        <ul>
                            <li>Go to your&nbsp;<strong>Admin panel</strong>&nbsp;-&gt;&nbsp;<strong>Site Setting</strong> -&gt; <strong>General Settings</strong></li>
                            <li>Set&nbsp;‘<strong>Google Map API Key</strong>‘</li>
                            <li>And save your changes.</li>
                        </ul>
                        <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/gmap-key.png" alt="gmap" width="1280" height="869"/></p>
                    </div>
                </div>
            </section>


            <!-- google-captcha -------------------------------------------------------------->
            <section id="google-captcha" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#google-captcha' class='header-link'><i class='fa fa-link'></i></a>Google Captcha</h2>
                    <strong>How to setup.</strong><br>
                    <ul>
                        <li>Visit <a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a></li>
                        <li>Follow as given in below image</li>
                    </ul>
                    <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/google-captcha1.png" alt="gmap" width="1280" height="869"/></p>
                    <ul>
                        <li>Click on <strong>Register</strong></li>
                        <li>You will now get your <strong>site key</strong> and <strong>secret key</strong></li>
                    </ul>
                    <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/google-captcha2.png" alt="gmap" width="1280" height="869"/></p>

                    <p><strong>Admin panel setup</strong></p>
                    <ul>
                        <li>Go to your&nbsp;<strong>Admin panel</strong>&nbsp;-&gt;&nbsp;<strong>Site Setting</strong> -&gt; <strong>Google reCAPTCHA tab</strong></li>
                        <li>Enable reCaptcha‘</li>
                        <li>Add reCaptcha Site key (Public Key) and Secret key (Private key)‘</li>
                        <li>And save your changes.</li>
                    </ul>
                    <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/google-captcha3.png" alt="gmap" width="1280" height="869"/></p>
                </div>
            </section>

            <!-- Theme-Features -------------------------------------------------------------->
            <section id="Theme-Features" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#Theme-Features' class='header-link'><i class='fa fa-link'></i></a>Theme Features</h2>

                    <div id='choose-specific-country' class='step-content clearfix'>
                        <h3 class='steps-header'><a href='#choose-specific-country'>How to Setup International setting.</a></h3>
                        <p>Go to <strong>Admin &gt; Site Setting  &gt; International</strong></p>
                        <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/specific-country.png" alt="specific-country" width="1280" height="869"/></p>
                    </div>
                    <div id='setup-home-page' class='step-content clearfix'>
                        <h3 class='steps-header'><a href='#setup-home-page'>How to setup home page.</a></h3>
                        <p>Go to <strong>Admin &gt; Site Setting  &gt; General</strong></p>
                        <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/home-page.png" alt="home-page" width="1280" height="869"/></p>
                    </div>
                </div>
            </section>

            <!-- Manage-Category -------------------------------------------------------------->
            <section id="Manage-Category" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#Manage-Category' class='header-link'><i class='fa fa-link'></i></a>Manage Category</h2>
                    <div class="alert alert-info ">
                        <p><strong>All demo category are pre inserted on theme activation.</strong> If you want to change it here is a category management tool. As you can see in following screenshot.</p>
                    </div>
                    <p><strong>Go  to Admin &gt; Category.</strong></p>
                    <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/Category.png" alt="manage-category" width="1280" height="869"/></p>
                </div>
            </section>


            <!-- Manage-Customfield -------------------------------------------------------------->
            <section id="Manage-Customfield" class="stickem-container">
                <div class='section-content'>
                    <h2 class='page-header'><a href='#Manage-Customfield' class='header-link'><i class='fa fa-link'></i></a>Manage Custom fields</h2>
                    <div class="alert alert-info ">
                        <p>We integrate a custom fields managment app in which you can easily create, drag-drop, edit, delete language translate on one page. You can set single custom fields for multi categories or assign to all categories.</p>
                    </div>
                    <p><strong>Go  to Admin &gt; Custom Fields.</strong></p>
                    <p><img class="aligncenter size-full wp-image-288" src="assets/screenshot/custom-fields.png" alt="manage-custom fields" width="1280" height="869"/></p>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

        <div class="pull-right hidden-xs">
            <div class="version"> Version 1.0.0</div>
        </div>

        <div class="copyrights">Copyright © 2017 Bylancer. All rights reserved.</div>
    </footer>

</div>
<!-- ./wrapper -->

<script type="text/javascript" src="assets/js/jQuery-2.2.0.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/jquery.stickem.js"></script>
<script type="text/javascript" src="assets/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="assets/js/prism.js"></script>
<script type="text/javascript" src="assets/js/docs.js"></script>
</body>

</html>
