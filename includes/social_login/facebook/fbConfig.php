<?php
require_once('../../config.php');
require_once('../../sql_builder/idiorm.php');
require_once('../../db.php');
require_once('../../functions/func.global.php');
require_once('../../functions/func.users.php');
require_once('../../functions/func.sqlquery.php');
sec_session_start();

// Include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuration and setup Facebook SDK
 */

$appId 			= get_option("facebook_app_id"); //Facebook App ID
$appSecret 		= get_option("facebook_app_secret"); //Facebook App Secret
$redirectURL 	= $config['site_url'].'includes/social_login/facebook/index.php'; //Callback URL
$fbPermissions 	= array('email');  //Optional permissions

$fb = new Facebook(array(
	'app_id' => $appId,
	'app_secret' => $appSecret,
	'default_graph_version' => 'v2.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
	if(isset($_SESSION['facebook_access_token'])){
		$accessToken = $_SESSION['facebook_access_token'];
	}else{
  		$accessToken = $helper->getAccessToken($redirectURL);
	}
} catch(FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
}

?>