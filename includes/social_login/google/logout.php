<?php
//Include GP config file
include_once 'gpConfig.php';

//Unset token and user data from session
unset($_SESSION['token']);
unset($_SESSION['userData']);

//Reset OAuth access token
$gClient->revokeToken();

//Destroy entire session
session_destroy();

//Redirect to homepage
header("Location: ".$config['site_url']."index");
?>