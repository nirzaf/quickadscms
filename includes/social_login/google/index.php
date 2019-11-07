<?php
//Include GP config file && User class
require_once 'gpConfig.php';
require_once('../../lang/lang_'.$config['lang'].'.php');


if( !ini_get('allow_url_fopen') ) {
    die('allow_url_fopen is disabled. file_get_contents would not work');
}

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
    $gender = isset($gpUserProfile['gender'])? $gpUserProfile['gender'] : "male";
    $link = isset($gpUserProfile['link'])? $gpUserProfile['link'] : "";
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'gender'        => $gender,
        'link'          => $link
    );

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $flargePic = file_get_contents($gpUserProfile['picture'], false, stream_context_create($arrContextOptions));
    $upOne = realpath(dirname(__FILE__) . '/../../..');

    $picname = $gpUserProfile['id'].'.jpg';
    $sfile = $upOne.'/storage/profile/small_'.$picname;
    $lfile = $upOne.'/storage/profile/'.$picname;
    file_put_contents($sfile, $flargePic);
    file_put_contents($lfile, $flargePic);

    if($gpUserData['email'] == "")
    {
        $error = "Please add email id in facebook account later try again";
        echo "<script type='text/javascript'>alert('$error');</script>";
        //redirect_parent($config['site_url'] ."login",true);
        //exit();
    }


    /* ---- Session Variables -----*/
    $userData = array();
    $userData = checkSocialUser($gpUserData,$picname);

    if(!is_array($userData))
    {
        $error = $lang['EMAILNOTEXIST'];
        echo "<script type='text/javascript'>alert('$error');</script>";
        //redirect_parent($config['site_url'] ."login",true);
    }
    elseif($userData['status'] == 2)
    {
        $error = $lang['ACCOUNTBAN'];
        echo "<script type='text/javascript'>alert('$error');</script>";
        redirect_parent($config['site_url'] ."login",true);
    }
    else
    {
        create_user_session($userData['id'],$userData['username'],$userData['password_hash']);

        update_lastactive();

        redirect_parent($config['site_url'] ."login",true);
    }
	
	//Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout">Google</a>';
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	//$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';

    echo "<script type='text/javascript'>window.location.href='$authUrl'</script>";
}
?>


<?php echo $output; ?>