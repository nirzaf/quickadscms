<?php
require_once('../../config.php');
require_once('../../sql_builder/idiorm.php');
require_once('../../db.php');
require_once('../../functions/func.global.php');
require_once('../../functions/func.users.php');
require_once('../../functions/func.sqlquery.php');
sec_session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */

$clientId = get_option("google_app_id"); //Google client ID
$clientSecret = get_option("google_app_secret"); //Google client secret
$redirectURL = $config['site_url'].'includes/social_login/google/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to '.$config['site_title']);
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>