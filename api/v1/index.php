<?php
require_once('../../includes/config.php');
require_once('../../includes/sql_builder/idiorm.php');
require_once('../../includes/db.php');
require_once('../../includes/classes/class.template_engine.php');
require_once('../../includes/classes/class.country.php');
require_once('../../includes/functions/func.global.php');
require_once('../../includes/lib/password.php');
require_once('../../includes/functions/func.sqlquery.php');
require_once('../../includes/functions/func.users.php');
require_once('../../includes/lang/lang_'.$config['lang'].'.php');
require_once('../../includes/seo-url.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$con = db_connect();
sec_session_start();

if (isset($_REQUEST['action'])){
    if ($_REQUEST['action'] == "app_config") { app_config(); }

    if ($_REQUEST['action'] == "login") { login(); }
    if ($_REQUEST['action'] == "forgot_password") { forgot_password(); }
	if ($_REQUEST['action'] == "register") { register(); }
    if ($_REQUEST['action'] == "get_userdata_by_email") { get_userdata_by_email(); }  //not Using
    if ($_REQUEST['action'] == "home_latest_ads") { home_latest_ads(); }
    if ($_REQUEST['action'] == "home_premium_ads") { home_premium_ads(); }
    if ($_REQUEST['action'] == "ad_detail") { ad_detail(); }
    if ($_REQUEST['action'] == "installed_countries") { installed_countries(); }
    if ($_REQUEST['action'] == "getStateByCountryCode") {getStateByCountryCode();}
    if ($_REQUEST['action'] == "getCityByStateCode") {getCityByStateCode();}
    if ($_REQUEST['action'] == "getCityidByCityName") {getCityidByCityName();}

    if ($_REQUEST['action'] == "get_all_msg") {get_all_msg();}
    if ($_REQUEST['action'] == "chat_conversation") {chat_conversation();}
    if ($_REQUEST['action'] == "send_message") {send_message();}
    if ($_REQUEST['action'] == "languages_list") {languages_list();}
    if ($_REQUEST['action'] == "language_file") { language_file(); }
    if ($_REQUEST['action'] == "categories") {categories();}
    if ($_REQUEST['action'] == "sub_categories") {sub_categories();}

    if ($_REQUEST['action'] == "favorite_posts") {favorite_posts();}
    if ($_REQUEST['action'] == "add_to_favorite") {add_to_favorite();}
    if ($_REQUEST['action'] == "remove_favorite") {remove_favorite();}

    if ($_REQUEST['action'] == "make_offer") { make_offer(); }
    if ($_REQUEST['action'] == "get_notification") { get_notification(); }
    if ($_REQUEST['action'] == "add_firebase_device_token") { add_firebase_device_token(); }
    if ($_REQUEST['action'] == "getCustomFieldByCatID") {getCustomFieldByCatID();}
    if ($_REQUEST['action'] == "send_cusdata_getjson") {send_cusdata_getjson();}
    if ($_REQUEST['action'] == "custom_fields_json") { custom_fields_json(); }
    if ($_REQUEST['action'] == "upload_product_picture") { upload_product_picture(); }
    if ($_REQUEST['action'] == "upload_profile_picture") { upload_profile_picture(); }

    if ($_REQUEST['action'] == "save_post") { save_post(); }
    if ($_REQUEST['action'] == "search_post") { search_post(); }
}

$status = "";
$message = "";
$results = array();
/*Request Fields (* are mandatory)*/

/*
User Login Api
action = login
1. username or email
2. password

Messages
1. Success : Logged in success
2. Error : Username or Password not found
3. Error : This account has been banned
*/

function get_category_translation_api($cattype,$catid,$lang_code){
    global $config;
    $info = ORM::for_table($config['db']['pre'].'category_translation')
        ->select_many('title','slug')
        ->where(array(
            'translation_id' => $catid,
            'lang_code' => $lang_code,
            'category_type' => $cattype,
        ))
        ->find_one();
    return $info;
}

function app_config(){
    global $config,$results;

    $config['app_name'] = 'Quickad';
    $config['site_url'] = $config['site_url'];
    $config['default_country'] = $config['specific_country'];
    $config['detect_live_location'] = 'yes';
    $config['terms_page_link'] = 'https://classified.bylancer.com/page/terms';
    $config['policy_page_link'] = 'https://classified.bylancer.com/contact';

    $results['status'] = "success";
    $results['app_name'] = $config['app_name'];
    $results['default_country'] = $config['specific_country'];
    $results['detect_live_location'] = $config['detect_live_location'];
    $results['terms_page_link'] = $config['terms_page_link'];
    $results['policy_page_link'] = $config['policy_page_link'];


/**********************************************************************************************************/

    $lang_code = isset($_REQUEST['lang_code']) ? $_REQUEST['lang_code'] : null;

    if($lang_code == 'en'){
        $lang_code = null;
    }

    $category = array();
    $sub_category = array();

    $result1 = ORM::for_table($config['db']['pre'].'catagory_main')
        ->order_by_asc('cat_order')
        ->find_many();


    foreach ($result1 as $info1) {
        $cat['id'] = $info1['cat_id'];
        $cat['icon'] = $info1['icon'];
        $cat['name'] = $info1['cat_name'];
        $cat['picture'] = $info1['picture'];
        if($lang_code != null && $config['userlangsel'] == '1'){
            $maincat = get_category_translation_api("main",$info1['cat_id'],$lang_code);
            $cat['name'] = $maincat['title'];
        }

        $cat['sub_category'] = array();

        $result = ORM::for_table($config['db']['pre'].'catagory_sub')
            ->where('main_cat_id', $info1['cat_id'])
            ->find_many();
        foreach ($result as $info) {
            $subcat['id'] = $info['sub_cat_id'];
            $subcat['picture'] = $info['picture'];
            if($lang_code != null && $config['userlangsel'] == '1'){
                $scat = get_category_translation_api("sub",$info['sub_cat_id'],$lang_code);
                $subcat['name'] = $scat['title'];
            }else{
                $subcat['name'] = $info['sub_cat_name'];
            }

            $cat['sub_category'][] = $subcat;
        }

        $category[] = $cat;
    }

    $results['categories'] = $category;

/**********************************************************************************************************/

    $language_array = array();

    $result = ORM::for_table($config['db']['pre'].'languages')
        ->where('active', '1')
        ->order_by_asc('name')
        ->find_many();
    foreach ($result as $info) {
        $language['id'] = $info['id'];
        $language['code'] = $info['code'];
        $language['direction'] = $info['direction'];
        $language['name'] = $info['name'];
        $language['file_name'] = $info['file_name'];
        $language['active'] = $info['active'];
        $language['default'] = $info['default'];

        $language_array[] = $language;
    }

    $results['languages'] = $language_array;

    send_json($results);
    die();
}



function add_notification($SenderName,$SenderId,$OwnerName,$OwnerId,$productId,$productTitle,$type,$message)
{
    global $config, $lang, $results;

    if($OwnerId){

        $insert_note = ORM::for_table($config['db']['pre'].'push_notification')->create();
        $insert_note->sender_name = $SenderName;
        $insert_note->sender_id = $SenderId;
        $insert_note->owner_name = $OwnerName;
        $insert_note->owner_id = $OwnerId;
        $insert_note->product_id = $productId;
        $insert_note->product_title = $productTitle;
        $insert_note->type = $type;
        $insert_note->message = $message;
        $insert_note->save();

        $note_id = $insert_note->id();


        $info = ORM::for_table($config['db']['pre'].'firebase_device_token')
            ->select('token')
            ->where('user_id', $OwnerId)
            ->find_one();
        if(isset($info['token'])){
            $token = $info['token'];
            sendFCM($message,$token);
        }
    }

}


/*
Get Notification
action = get_notification

1. user_id

Messages
1. Success : array
2. Error : not found
*/

function get_notification()
{
    global $config, $lang, $results;

    $user_id = $_REQUEST["user_id"];

    $notification = array();

    $rows = ORM::for_table($config['db']['pre'].'push_notification')
        ->where('owner_id',$user_id)
        ->find_many();

    foreach ($rows as $info)
    {
        $note['sender_id'] = $info['sender_id'];
        $note['sender_name'] = $info['sender_name'];
        $note['owner_id'] = $info['owner_id'];
        $note['owner_name'] = $info['owner_name'];
        $note['product_id'] = $info['product_id'];
        $note['product_title'] = $info['product_title'];
        $note['type'] = $info['type'];
        $note['message'] = $info['message'];

        $notification[] = $note;
    }

    $results = $notification;
    send_json($results);
    die();
}

/*
Add firebase device token
action = add_firebase_device_token

1. user_id
2. device_id
3. name
4. token

Messages
1. Success
*/

function add_firebase_device_token()
{
    global $config, $lang, $results;

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $device_id = isset($_REQUEST['device_id']) ? $_REQUEST['device_id'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : null;

    $num_count = ORM::for_table($config['db']['pre'].'firebase_device_token')
        ->where('device_id', $device_id)
        ->count();
    if($num_count == 1){
        $pdo = ORM::get_db();
        $sql = "UPDATE ".$config['db']['pre']."firebase_device_token SET 
        user_id = '".$user_id."',
        device_id = '".$device_id."',
        name = '".$name."',
        token = '".$token."' 
        WHERE device_id = '".$device_id."'";
        $query_result = $pdo->query($sql);
    }else{
        $insert_token = ORM::for_table($config['db']['pre'].'firebase_device_token')->create();
        $insert_token->user_id = $user_id;
        $insert_token->device_id = $device_id;
        $insert_token->name = $name;
        $insert_token->token = $token;
        $insert_token->save();

        $note_id = $insert_token->id();
    }

    $results['status'] = "error";
    send_json($results);
    die();
}
/*
User Login Api
action = login
1. username or email
2. password

Messages
1. Success : Logged in success
2. Error : Username or Password not found
3. Error : This account has been banned
*/

function login(){
    global $config,$lang,$status,$message,$results;

    $loggedin = userlogin($_REQUEST['username'], $_REQUEST['password']);

    if(!is_array($loggedin))
    {
        $status = "error";
        $message = $lang['USERNOTFOUND'];
    }
    elseif($loggedin['status'] == 2)
    {
        $status = "error";
        $message = $lang['ACCOUNTBAN'];
    }
    else
    {
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
        $user_id = preg_replace("/[^0-9]+/", "", $loggedin['id']); // XSS protection as we might print this value
        $_SESSION['user']['id']  = $user_id;
        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loggedin['username']); // XSS protection as we might print this value
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['login_string'] = hash('sha512', $loggedin['password'] . $user_browser);

        update_lastactive();

        $status = "success";
        $message = $lang['LOGGEDIN_SUCCESS'];
    }

    $results['status'] = $status;
    $results['message'] = $message;

	$results['user_id'] = $user_id;
	$results['username'] = $username;

    $userdata = get_user_data($username);
    $results['email'] = $userdata['email'];
    $results['name'] = $userdata['name'];
    $results['picture'] = $config['site_url']."storage/profile/small_".$userdata['image'];

    send_json($results);
}

/*
User Forgot Password Api
action = forgot_password
1. email

Messages
1. Success : Please check your email account for the forgot password details
2. Error : Email address does not exist
*/

function forgot_password(){
    global $config,$lang,$status,$message,$results;

    // Lookup the email address
    $email_info1 = check_account_exists($_REQUEST['email']);

    // Check if the email address exists
    if($email_info1 != 0)
    {
        $email_userid = get_user_id_by_email($_REQUEST['email']);
        // Send the email
        send_forgot_email($_REQUEST['email'],$email_userid);

        $status = "success";
        $message = $lang['CHECKEMAILFORGOT'];
    }else{
        $status = "error";
        $message = $lang['EMAILNOTEXIST'];
    }

    $results['status'] = $status;
    $results['message'] = $message;

    send_json($results);
}

/*
User Register Api field name
action = register
1. name
2. username
3. email
4. password

Error Messages
1. Enter your full name.
2. Name must be between 4 and 20 characters long.
3. Please enter an username
4. Username may only contain alphanumeric characters
5. Username must be between 4 and 15 characters long
6. Username not available
7. Please enter an email address
8. This is not a valid email address
9. An account already exists with that e-mail address
10. Please enter password
11. Password must be between 4 and 20 characters long
*/

function register(){
    global $config,$con,$lang,$results;

    $name_length = strlen(utf8_decode($_REQUEST['name']));

    $status = "";
    $message = "";

    if(empty($_REQUEST["name"])) {
        $status = "error";
        $message = $lang['ENTER_FULL_NAME'];
    }
    elseif(empty($_REQUEST["username"]))
    {
        $status = "error";
        $message = $lang['ENTERUNAME'];
    }
    elseif(preg_match('/[^A-Za-z0-9]/',$_REQUEST['username']))
    {
        $status = "error";
        $message = $lang['USERALPHA'];
    }
    elseif( (strlen($_REQUEST['username']) < 4) OR (strlen($_REQUEST['username']) > 16) )
    {
        $status = "error";
        $message = $lang['USERLEN'];
    }
    else{
        if(isset($_REQUEST['fb_login']) && $_REQUEST['fb_login'] == 1){

        }else{
            $user_count = check_username_exists($_REQUEST["username"]);
            if($user_count>0) {
                $status = "error";
                $message = $lang['USERUNAV'];
            }
        }
    }


    // Check if this is an Email availability check from signup page using ajax
    $_REQUEST["email"] = strtolower($_REQUEST["email"]);
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if(empty($_REQUEST["email"])) {
        $status = "error";
        $message = $lang['ENTEREMAIL'];
    }
    elseif(!preg_match($regex, $_REQUEST['email'])) {
        $status = "error";
        $message = $lang['EMAILINV'];
    }
    else{
        if(!isset($_REQUEST['fb_login'])){
            $user_count = check_account_exists($_REQUEST["email"]);
            if($user_count>0) {
                $status = "error";
                $message = $lang['ACCAEXIST'];
            }
        }
    }

    // Check if this is an Password availability check from signup page using ajax
    if(!isset($_REQUEST['fb_login'])){
        if(empty($_REQUEST["password"])) {
            $status = "error";
            $message = $lang['ENTERPASS'];
        }
        elseif( (strlen($_REQUEST['password']) < 4) OR (strlen($_REQUEST['password']) > 21) ) {
            $status = "error";
            $message = $lang['PASSLENG'];
        }
    }

    if($status != "error") {
        if(isset($_REQUEST['fb_login']) && $_REQUEST['fb_login'] == '1'){
            $email = $_REQUEST['email'];

            $num_rows = ORM::for_table($config['db']['pre'].'user')
                ->select_many('id', 'email', 'username', 'name')
                ->where('email', $email)
                ->count();

            if ($num_rows >= 1) {

                $info = ORM::for_table($config['db']['pre'].'user')
                    ->select_many('id', 'email', 'username', 'name')
                    ->where('email', $email)
                    ->find_one();

                $results['status'] = "success";
                $results['message'] = $lang['SUCCESS'];

                $results['user_id'] = $info['id'];
                $results['username'] = $info['username'];
                $results['email'] = $info['email'];
                $results['name'] = $info['name'];
            }
            else{
                $password = get_random_id();
                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
                $confirm_id = get_random_id();
                $location = getLocationInfoByIp();

                $now = date("Y-m-d H:i:s");

                $insert_user = ORM::for_table($config['db']['pre'].'user')->create();
                $insert_user->status = '1';
                $insert_user->name = $_REQUEST["name"];
                $insert_user->username = $_REQUEST["username"];
                $insert_user->email = $_REQUEST['email'];
                $insert_user->password_hash = $pass_hash;
                $insert_user->confirm = $confirm_id;
                $insert_user->created_at = $now;
                $insert_user->updated_at = $now;
                $insert_user->country = $location['country'];
                $insert_user->city = $location['city'];
                $insert_user->save();

                $user_id = $insert_user->id();

                /*SEND CONFIRMATION EMAIL*/
                email_template("signup_confirm",$user_id);

                /*SEND ACCOUNT DETAILS EMAIL*/
                email_template("signup_details",$user_id,$password);

                $results['status'] = "success";
                $results['message'] = $lang['SUCCESS'];
                $userdata = get_user_data(null,$user_id);
                $results['user_id'] = $userdata['id'];;
                $results['username'] = $userdata['username'];;
                $results['email'] = $userdata['email'];
                $results['name'] = $userdata['name'];
            }
        }
        else{
            $confirm_id = get_random_id();
            $location = getLocationInfoByIp();
            $password = $_REQUEST["password"];
            $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);

            $now = date("Y-m-d H:i:s");

            $insert_user = ORM::for_table($config['db']['pre'].'user')->create();
            $insert_user->status = '0';
            $insert_user->name = $_REQUEST["name"];
            $insert_user->username = $_REQUEST["username"];
            $insert_user->email = $_REQUEST['email'];
            $insert_user->password_hash = $pass_hash;
            $insert_user->confirm = $confirm_id;
            $insert_user->created_at = $now;
            $insert_user->updated_at = $now;
            $insert_user->country = $location['country'];
            $insert_user->city = $location['city'];
            $insert_user->save();

            $user_id = $insert_user->id();

            /*SEND CONFIRMATION EMAIL*/
            email_template("signup_confirm",$user_id);

            /*SEND ACCOUNT DETAILS EMAIL*/
            email_template("signup_details",$user_id,$password);

            $results['status'] = "success";
            $results['message'] = $lang['SUCCESS'];
            $userdata = get_user_data(null,$user_id);
            $results['user_id'] = $userdata['id'];;
            $results['username'] = $userdata['username'];;
            $results['email'] = $userdata['email'];
            $results['name'] = $userdata['name'];
        }

        echo json_encode($results);
        die();
        
    }else{

        $results['status'] = "error";
        $results['message'] = $message;

        echo json_encode($results);
        die();
    }

    $results['status'] = "error";
    $results['message'] = "Something wrong.";

    send_json($results);
}

/*
Get Userdata with email
action = get_userdata_by_email
1. email

Messages
1. Success : success
2. Error : Email address does not exist
*/

function get_userdata_by_email(){
    global $config,$lang,$results;
    $email = $_REQUEST['email'];

    $num_rows = ORM::for_table($config['db']['pre'].'user')
        ->select_many('id', 'email', 'username', 'name')
        ->where('email', $email)
        ->count();

    if ($num_rows >= 1) {

        $info = ORM::for_table($config['db']['pre'].'user')
            ->select_many('id', 'email', 'username', 'name')
            ->where('email', $email)
            ->find_one();

        $results['status'] = "success";
        $results['message'] = $lang['SUCCESS'];

        $results['user_id'] = $info['id'];;
        $results['username'] = $info['username'];;
        $results['email'] = $info['email'];
        $results['name'] = $info['name'];
    }
    else{
        $results['status'] = "success";
        $results['message'] = $lang['EMAILNOTEXIST'];
    }
    send_json($results);
    die();
}

function get_products_data($userid=null,$cat_id=null,$subcat_id=null,$location=false,$country_code=null,$city=null,$status=null,$premium=false,$page=null,$limit=null,$order=false,$sort="id",$sort_order="DESC"){
    global $config,$con,$lang,$results;
    $where = '';
    if($userid != null){
        if($where == '')
            $where .= "where p.user_id = '".$userid."'";
        else
            $where .= " AND p.user_id = '".$userid."'";
    }
    if($status != null && $status != "hide"){
        if($where == '')
            $where .= "where p.status = '".$status."'";
        else
            $where .= " AND p.status = '".$status."'";
    }

    if($cat_id != null){
        if($where == '')
            $where .= "where p.category = '".$cat_id."'";
        else
            $where .= " AND p.category = '".$cat_id."'";
    }

    if($subcat_id != null){
        if($where == '')
            $where .= "where p.sub_category = '".$subcat_id."'";
        else
            $where .= " AND p.sub_category = '".$subcat_id."'";
    }

    if($status == "hide"){
        if($where == '')
            $where .= "where p.hide = '1'";
        else
            $where .= " AND p.hide = '1'";
    }else{
        if($where == '')
            $where .= "where p.hide = '0'";
        else
            $where .= " AND p.hide = '0'";
    }

    if($premium){
        if($where == '')
            $where .= "where (g.show_on_home = 'yes')";
        else
            $where .= " AND (g.show_on_home = 'yes')";
    }

    if($location){
		if($country_code == null){
			$country_code = check_user_country();
		}
        
        if($where == '')
            $where .= "where p.country = '".$country_code."'";
        else
            $where .= " AND p.country = '".$country_code."'";
    }

   if($order){
       $order_by = "
      (CASE
        WHEN g.show_on_home = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
        WHEN g.show_on_home = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
        WHEN g.show_on_home = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
        WHEN g.show_on_home = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
        WHEN g.show_on_home = 'yes' and p.urgent = '1' THEN 5
        WHEN g.show_on_home = 'yes' and p.featured = '1' THEN 6
        WHEN g.show_on_home = 'yes' and p.highlight = '1' THEN 7
        WHEN g.show_on_home = 'yes' THEN 8
        ELSE 9
      END), ".$sort." ".$sort_order;
       //$order_by = $sort." ".$sort_order;
    }else{
       $order_by = $sort." ".$sort_order;
   }

    $pagelimit = "";
    if($page != null && $limit != null){
        $pagelimit = "LIMIT  ".($page-1)*$limit.",".$limit;
    }

    $pdo = ORM::get_db();

    $query = "SELECT p.id,p.product_name,p.featured,p.urgent,p.highlight,p.price,p.category,p.sub_category,p.tag,p.screen_shot,p.user_id,p.city,p.country,p.status,p.hide,p.created_at,p.expire_date,
u.group_id, g.show_on_home
FROM `".$config['db']['pre']."product` as p
INNER JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
INNER JOIN `".$config['db']['pre']."usergroups` as g ON g.group_id = u.group_id
$where ORDER BY $order_by $pagelimit";

    $result = $pdo->query($query);
    $rows = $result->rowCount();
    $items = array();
    if ($rows > 0) {
        foreach($result as $info) {
            $item['id'] = $info['id'];
            $item['product_name'] = preg_replace('/[^A-Za-z0-9\-]/', ' ', $info['product_name']);
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];
            $item['highlight_bgClr'] = ($info['highlight'] == 1)? "highlight-premium-ad" : "";

            $cityname = get_cityName_by_id($info['city']);
            $item['location'] = $cityname;
            $item['city'] = $cityname;
            $item['status'] = $info['status'];
            $item['hide'] = $info['hide'];

            $item['created_at'] = timeAgo($info['created_at']);
            $expire_date_timestamp = $info['expire_date'];
            $expire_date = date('d-M-y', $expire_date_timestamp);
            $item['expire_date'] = $expire_date;

            $item['cat_id'] = $info['category'];
            $item['sub_cat_id'] = $info['sub_category'];
            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $item['category'] = $get_main['cat_name'];
            $item['sub_category'] = $get_sub['sub_cat_name'];

            $item['favorite'] = check_product_favorite($info['id']);

            if($info['tag'] != ''){
                $item['showtag'] = "1";
                $item['tag'] = $info['tag'];
            }else{
                $item['tag'] = "";
                $item['showtag'] = "0";
            }

            $picture = explode(',' ,$info['screen_shot']);
            $item['pic_count'] = count($picture);

            if($picture[0] != ""){
			$item['picture'] = $config['site_url']."storage/products/thumb/".$picture[0];
            }else{
                $item['picture'] = $config['site_url']."storage/products/thumb/default.png";
            }

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];


            $userinfo = get_user_data("",$info['user_id']);
            $item['username'] = $userinfo['username'];
            $item['user_id'] = $userinfo['id'];
            

            if(check_user_upgrades($info['user_id']))
            {
                $sub_info = get_user_membership_detail($info['user_id']);
                $item['subcription_title'] = $sub_info['sub_title'];
                $item['subcription_image'] = $sub_info['sub_image'];
            }else{
                $item['subcription_title'] = '';
                $item['subcription_image'] = '';
            }

            $items[] = $item;
        }
    }
    else {
        //echo "0 results";
    }

    return $items;
}



/*
Home page show premium ads
action = home_premium_ads
1. status = "active"
2. location = true or false
3. country_code 
4. premium = true or false
5. page   
6. limit
7. sorting = true or false
*/

function home_premium_ads(){
    global $config,$lang,$results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

	$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
	$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
	$country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
	$city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
	$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
	$premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : true;
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
	$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : null;
	$sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
	$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
	$sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";
	
	$results = get_products_data($user_id,$cat_id,$subcat_id,false,$country_code,$city,$status,$premium,$page,$limit,$order=false,$sort="id",$sort_order="DESC");

    send_json($results);
    die();
}



/*
Home page show latest ads
action = home_latest_ads
1. country_code
2. limit
3. user_id
4. session_user_id
5. category_id
6. subcategory_id
*/

function home_latest_ads(){
    global $results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

	$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
	$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
	$country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
	$city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
	$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
	$premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : false;
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
	$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';
	$sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
	$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
	$sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";

	if($_REQUEST['country_code']){
        $location = true;
    }
	
	$results = get_products_data($user_id,$cat_id,$subcat_id,$location,$country_code,$city,$status,$premium,$page,$limit,$order=false,$sort="id",$sort_order="DESC");

    send_json($results);
}

/*
Ad details by ad id
action = ad_detail
1. item_id

Messages
1. Success : ad data in json
2. Error : not found
*/

function ad_detail(){
    global $config,$con,$lang,$results;

    $item = array();
    if(isset($_REQUEST['item_id'])){
        $item_id = $_REQUEST['item_id'];

        $num_rows = ORM::for_table($config['db']['pre'].'product')
            ->where('id',$item_id)
            ->count();

        if ($num_rows > 0) {

            $info = ORM::for_table($config['db']['pre'].'product')->find_one($item_id);
            update_itemview($item_id);

            $item['id'] = $info['id'];
            $item['title'] = $info['product_name'];
            $item['status'] = $info['status'];
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];

            $item['category_id'] = $info['category'];
            $item['sub_category_id'] = $info['sub_category'];

            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $item['category_name'] = $get_main['cat_name'];
            $item['sub_category_name'] = $get_sub['sub_cat_name'];

            $latlong = $info['latlong'];
            $map = explode(',', $latlong);
            $item['map_latitude'] = $map[0];
            $item['map_longitude'] = $map[1];

            $item_phone = $info['phone'];
            $item_hide_phone = $info['hide_phone'];
            if($item_phone != "" && $item_hide_phone == '0'){
                $item['hide_phone'] = "no";
            }else{
                $item['hide_phone'] = "yes";
            }

            $item['phone'] = $item_phone;

            $item_author_id = $info['user_id'];
            $info2 = get_user_data(null,$item_author_id);
            $item['seller_id'] = $item_author_id;
            $item['seller_name'] = $info2['name'];
            $item['seller_username'] = $info2['username'];
            $item['seller_email'] = $info2['email'];
            $item['seller_image'] = $info2['image'];

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];

            $item_negotiable = $info['negotiable'];
            if($item_negotiable == 1)
                $item['negotiable'] = $lang['NEGOTIABLE_PRICE'];
            else
                $item['negotiable'] = "";

            $item['location'] = $info['location'];
            $item['city'] = get_cityName_by_id($info['city']);
            $item['state'] = get_stateName_by_id($info['state']);
            $item['country'] = get_countryName_by_id($info['country']);

            $item['view'] = $info['view'];
            $item['created_at'] = timeAgo($info['created_at']);
            $item['updated_at'] = date('d M Y', $info['updated_at']);

            $item['original_images_path'] = $config['site_url'].'storage/products/';
            $item['small_images_path'] = $config['site_url'].'storage/products/thumb/';
            $item['images'] = explode(",",$info['screen_shot']);
            $item['tag'] = $info['tag'];
            $item['description'] = strip_tags($info['description']);

            $pro_url = create_slug($info['product_name']);

            $item['product_url'] = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;
            $custom_data = array();
            $rows = ORM::for_table($config['db']['pre'].'custom_data')
                ->where('product_id', $item_id)
                ->find_many();
            $item_custom_field = count($rows);
            foreach ($rows as $customdata){
                $field_id = $customdata['field_id'];
                $field_type = $customdata['field_type'];
                $field_data = $customdata['field_data'];

                $custom_fields_title = get_customField_title_by_id($field_id);
                $item_custom['type'] = $field_type;
                if($field_type == 'text-field') {
                    $custom_fields_data = stripslashes($field_data);
                    $item_custom['title'] = $custom_fields_title;
                    $item_custom['value'] = $custom_fields_data;
                }

                if($field_type == 'textarea') {
                    $item_custom['title'] = $custom_fields_title;
                    $item_custom['value'] = stripslashes($field_data);
                }

                if($field_type == 'radio-buttons' or  $field_type == 'drop-down') {
                    $custom_fields_data = get_customOption_by_id($field_data);
                    $item_custom['title'] = $custom_fields_title;
                    $item_custom['value'] = $custom_fields_data;
                }

                if($field_type == 'checkboxes'){
                    $checkbox_value2 = array();
                    $checkbox_value = explode(",",$field_data);

                    foreach ($checkbox_value as $val) {
                        $val = get_customOption_by_id(trim($val));
                        $checkbox_value2[] = $val;
                    }
                    if($custom_fields_title != ""){
                        $item_custom['title'] = $custom_fields_title;
                        $item_custom['value'] = implode(', ', $checkbox_value2);
                    }
                }

                $pro_url = create_slug($info['product_name']);
                $item['page_link']  = $config['site_url'].'ad/' . $info['id'] . '/'.$pro_url;

                $custom_data[] = $item_custom;
            }

            $item['custom_data'] = $custom_data;

            $results = $item;

        }else{
            $results['status'] = "error";
            $results['message'] = $lang['PAGE_NOT_FOUND'];
        }
    }else{
        $results['status'] = "error";
        $results['message'] = "Unique id not provided.";
    }

    send_json($results);
}

function get_countries_list($selected="",$selected_text='selected',$installed=1)
{
    global $config;
    $countries_array = array();
    if($installed){
        $result = ORM::for_table($config['db']['pre'].'countries')
            ->select_many('id','code','asciiname','languages')
            ->where('active' , '1')
            ->order_by_asc('asciiname')
            ->find_many();
    }else{

        $result = ORM::for_table($config['db']['pre'].'countries')
            ->select_many('id','code','asciiname','languages')
            ->order_by_asc('asciiname')
            ->find_many();
    }

    foreach ($result as $info)
    {
        $countries['id'] = $info['id'];
        $countries['code'] = $info['code'];
        $countries['lowercase_code'] = strtolower($info['code']);
        $countries['name'] = $info['asciiname'];
        $countries['lang'] = getLangFromCountry($info['languages']);
        if($selected!="")
        {
            if(is_array($selected))
            {
                foreach($selected as $select)
                {

                    $select = strtoupper(str_replace('"','',$select));
                    if($select == $info['id'])
                    {
                        $countries['selected'] = $selected_text;
                    }
                }
            }
            else{
                if($selected==$info['id'] or $selected==$info['code'] or $selected==$info['asciiname'])
                {
                    $countries['selected'] = $selected_text;
                }
                else
                {
                    $countries['selected'] = "";
                }
            }
        }

        $countries_array[] = $countries;
    }

    return $countries_array;
}

/*
Installed Countries
action = installed_countries

Messages
1. Success : Countries list json
2. Error : not found
*/

function installed_countries(){
    global $config,$con,$lang,$results;

    $countries = new Country();
    $country_list = $countries->transAll(get_countries_list());

    if(is_array($country_list)){
        $results = $country_list;
        send_json($results);
    }

    $results['status'] = "error";
    $results['message'] = "No country found";
}

/*
Get State By Country Code
action = getStateByCountryCode
1. country_code

Messages
1. Success : States list json
2. Error : not found
*/

function getStateByCountryCode(){
    global $config,$con,$lang,$results;

    if(isset($_REQUEST['country_code'])) {
        $country_code = $_REQUEST['country_code'];

        $result = ORM::for_table($config['db']['pre'].'subadmin1')
            ->select_many('id','code','name')
            ->where(array(
                'country_code' => $country_code,
                'active' => '1'
            ))
            ->order_by_asc('name')
            ->find_many();

        $states = array();
        foreach ($result as $info){
            $get_state['id'] = $info['id'];
            $get_state['code'] = $info['code'];
            $get_state['name'] = $info['name'];

            $states[] = $get_state;
        }
        $results = $states;
        send_json($results);
    }


    $results['status'] = "error";
    $results['message'] = "No state found";
}

/*
Get City id By State Code
action = getCityByStateCode
1. state_code

Messages
1. Success : cities list json
2. Error : not found
*/

function getCityByStateCode()
{
    global $config,$con,$lang,$results;

    if(isset($_REQUEST['state_code'])) {
        $state_id = $_REQUEST['state_code'];

        $result = ORM::for_table($config['db']['pre'].'cities')
            ->select_many('id','name','longitude','latitude')
            ->where(array(
                'subadmin1_code' => $state_id,
                'active' => '1'
            ))
            ->order_by_asc('name')
            ->find_many();

        $cities = array();
        foreach ($result as $info){
            $get_city['id'] = $info['id'];
            $get_city['name'] = $info['name'];
            $get_city['longitude'] = $info['longitude'];
            $get_city['latitude'] = $info['latitude'];

            $cities[] = $get_city;
        }
        $results = $cities;
        send_json($results);
    }


    $results['status'] = "error";
    $results['message'] = "No state found";
}

/*
Get City id By CityName
action = getCityidByCityName
1. country_code
2. state_name
2. city_name

Messages
1. Success : city_id
2. Error : not found
*/

function getCityidByCityName()
{
    global $config,$con,$lang,$results;

    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : "";
    $state = isset($_REQUEST['state_name']) ? $_REQUEST['state_name'] : "";
    $city_name = isset($_REQUEST['city_name']) ? $_REQUEST['city_name'] : "";

    $row = ORM::for_table($config['db']['pre'].'subadmin1')
        ->select('code')
        ->where('active', 1)
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($state, $state))
        ->find_one();

    $state_code = $row['code'];

    $info2 = ORM::for_table($config['db']['pre'].'cities')
        ->select('id')
        ->where(array(
            'subadmin1_code' => $state_code,
            'country_code' => $country_code,
            'active' => '1'
        ))
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($city_name, $city_name))
        ->find_one();

    $id = $info2['id'];
    if ($id) {
        $results['status'] = "success";
        $results['city_id'] = $id;
        send_json($results);
        die();
    }

    $results['status'] = "error";
    $results['message'] = $lang['NO-RESULT-FOUND'];
    send_json($results);
    die();
}


/*
Get Chat Messages
action = get_all_msg
1. ses_userid
2. client_id

Messages
1. Success : messages array
2. Error : not found
*/

function get_all_msg() {

    global $config,$con,$lang,$results;
    $chat_message = array();
    $perPage = 10;
    $ses_userid = $_REQUEST['ses_userid'];
    $client_id = $_REQUEST['client_id'];

    /*$info = ORM::for_table($config['db']['pre'].'messages')
        ->where_any_is(array(
            array('to_id' => $ses_userid, 'from_id' => $client_id),
            array('to_id' => $client_id, 'from_id' => $ses_userid)))
        ->order_by_desc('message_id')
        ->find_many();*/

    $sql = "select * from `".$config['db']['pre']."messages` where ((to_id = '".$ses_userid."' AND from_id = '".$client_id."') OR (to_id = '".$client_id."' AND from_id = '".$ses_userid."' ))order by message_id DESC ";

    $page = 1;
    if(!empty($_GET["page"])) {
        $_SESSION['chatpage'] = $page = $_GET["page"];
    }

    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;

    $query =  $sql . " limit " . $start . "," . $perPage;

    $query = $con->query($query);

    if(empty($_GET["rowcount"])) {
        $_GET["rowcount"] = $rowcount = mysqli_num_rows(mysqli_query($con, $sql));
    }

    $pages  = ceil($_GET["rowcount"]/$perPage);

    $chatBoxes = array();
    $items = '';
    if(!empty($query)) {

    }

    while ($chat = mysqli_fetch_array($query)) {

        $picname = "";
        $picname2 = "";

        $info = ORM::for_table($config['db']['pre'].'user')
            ->select('image')
            ->where('username', $chat['from_uname'])
            ->find_one();
        $picname = "small_".$info['image'];

        $info4 = ORM::for_table($config['db']['pre'].'user')
            ->select('image')
            ->where('username', $chat['to_uname'])
            ->find_one();
        $picname2 = "small_".$info4['image'];

        if($picname == "small_")
            $picname = "default_user.png";

        if($picname2 == "small_")
            $picname2 = "default_user.png";

        $status = "0";
        if($status == "0")
            $status = "Offline";
        else
            $status = "Online";


        $chat['message_content'] = sanitize($chat['message_content']);


        if (strpos($chat['message_content'], sanitize('file_name')) !== false) {

        }
        else{
            // The Regular Expression filter
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

            // Check if there is a url in the text
            if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                // make the urls hyper links
                $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

            } else {
                // The Regular Expression filter
                $reg_exUrl = "/(www)\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

                // Check if there is a url in the text
                if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                    // make the urls hyper links
                    $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);

                }
            }
        }

        $timeago = timeAgo($chat['message_date']);
        $chatContent = stripslashes($chat['message_content']);

        $chatting['sender_username'] = $chat['from_uname'];
        $chatting['sender_id'] = $chat['from_id'];
        $chatting['client_username'] = $chat['to_uname'];
        $chatting['sender_pic'] = $picname;
        $chatting['client_pic'] = $picname2;
        $chatting['total_pages'] = $pages;
        $chatting['page'] = $_SESSION['chatpage'];
        $chatting['mtype'] = $chat['message_type'];
        $chatting['message'] = $chatContent;
        $chatting['time'] = $timeago;
        $chatting['seen'] = $chat['seen'];

        $chat_message[] = $chatting;
    }

    $results = $chat_message;

    $pdo = ORM::get_db();

    $sql = "update `".$config['db']['pre']."messages` set recd = 1 where to_id = '".$ses_userid."' and recd = 0";
    $query = $pdo->query($sql);

    send_json($results);
    die();
}


/*
Get Chat Conversation
action = chat_conversation
1. session_user_id

Messages
1. Success : messages array
2. Error : not found
*/

function getlastActiveTime($username){
    global $lang;
    $json3 = file_get_contents('../../plugins/wchat/json/online-status.json');
    $obj3 = json_decode($json3,true);
    $lastActiveTime = $obj3['lastActive'];

    $lastseen = "";
    for ($i = 0; $i < count($lastActiveTime); $i++) {
        if ($lastActiveTime[$i]['username'] == $username) {
            $last_active = $lastActiveTime[$i]['last_active_timestamp'];

            $timeFirst  = strtotime($last_active);
            $timeSecond = strtotime($GLOBALS['timenow']);
            $differenceInSeconds = $timeSecond - $timeFirst;

            if($differenceInSeconds >= "0" and $differenceInSeconds <= "5")
                $lastseen = "Online";
            else
                $lastseen = $lang['LAST_SEEN']." ".timeAgo($last_active);

            break;
        }
        else{
            $lastseen = "Offline";
        }
    }
    return $lastseen;
}

function chat_conversation()
{
    global $config, $con, $lang, $results;

    $chat_message = array();
    $session_user_id = $_REQUEST['session_user_id'];
    $row1 = ORM::for_table($config['db']['pre'].'user')
        ->select_many('username','image')
        ->where('id' , $session_user_id)
        ->find_one();
    $session_username = $row1['username'];
    $session_user_image = $row1['image'];

    if($session_user_image == "")
        $session_user_image = "default_user.png";


    //This query shows user contact list by conversation
    $query = "select id,username,name,image,message_date from `".$config['db']['pre']."user` as u
            INNER JOIN
            (
                select max(message_id) as message_id,to_id,from_id,message_date from `".$config['db']['pre']."messages` where to_id = '".$session_user_id."' or from_id = '".$session_user_id."' GROUP BY to_id,from_id
            )
            m ON u.id = m.from_id or u.id = m.to_id  where (u.id != '".$session_user_id."') GROUP BY u.id
            ORDER BY message_id DESC";

    //This query shows all user list publicly
    //$query = "select id,username,name,image from `".$config['db']['pre'].$GLOBALS['MySQLi_user_table_name']."` where `".$GLOBALS['MySQLi_userid_field']."` != '".$session_user_id."' ORDER BY id DESC";

    $result = $con->query($query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        while ($row = mysqli_fetch_array($result)) {
            $from_user_id = $row['id'];
            $from_username = $row['username'];
            $from_fullname = $row['name'];
            $from_user_image = $row['image'];
            if($from_user_image == "")
                $from_user_image = "default_user.png";
            else{
                $from_user_image = "small_".$from_user_image;
            }

            $unseen_message = ORM::for_table($config['db']['pre'].'messages')
                ->where(array(
                    'to_uname' => $session_username,
                    'from_uname' => $from_username,
                    'seen' => '0',
                ))
                ->count();

            $onofst =  getlastActiveTime($from_username);

            $chatting['session_user_id'] = $session_user_id;
            $chatting['session_username'] = $session_username;
            $chatting['session_user_image'] = $session_user_image;
            $chatting['from_user_id'] = $from_user_id;
            $chatting['from_username'] = $from_username;
            $chatting['from_user_image'] = $from_user_image;
            $chatting['from_fullname'] = $from_fullname;
            $chatting['unseen'] = $unseen_message;
            $chatting['status'] = $onofst;

            $chat_message[] = $chatting;

        }

        $results = $chat_message;

    }
    else{
        $results['status'] = "error";
        $results['message'] = $lang['NO-RESULT-FOUND'];
    }

    send_json($results);
    die();
}

/*
Send Message
action = send_message

1. from_id
2. to_id
3. message

Messages
1. Success : message_id
2. Error : not found
*/

function send_message()
{
    global $config, $con, $lang, $results;

    $from_id = $_REQUEST['from_id'];
    $to_id = $_REQUEST['to_id'];
    $message = $_REQUEST['message'];
    $now = time();

    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('username')
        ->where('id', $from_id)
        ->find_one();

    $from = $info['username'];

    $info2 = ORM::for_table($config['db']['pre'].'user')
        ->select('username')
        ->where('id', $to_id)
        ->find_one();
    $to = $info2['username'];

    if($to){

        //$pdo = ORM::get_db();
        $sql = "insert into `".$config['db']['pre']."messages` (from_uname,to_uname,from_id,to_id,message_content,message_type,message_date) values ('".mysqli_real_escape_string($con,$from)."', '".mysqli_real_escape_string($con,$to)."','".mysqli_real_escape_string($con,$from_id)."','".mysqli_real_escape_string($con,$to_id)."','".mysqli_real_escape_string($con,$message)."','text','".$now."')";

        $query = $con->query($sql);

        $msg_id = $con->insert_id;

        $results['status'] = $msg_id;
        send_json($results);
        die();
    }
    else{
        $results['status'] = "error";
        send_json($results);
        die();
    }


    $results['status'] = "error";
    send_json($results);
    die();
}

/*
Get Laguages List
action = languages_list
*/

function languages_list()
{

    global $config, $con, $lang, $results;

    $language_array = array();

    $rows = ORM::for_table($config['db']['pre'].'languages')
        ->where('active', '1')
        ->order_by_asc('name')
        ->find_many();

    foreach ($rows as $info)
    {
        $language['id'] = $info['id'];
        $language['code'] = $info['code'];
        $language['direction'] = $info['direction'];
        $language['name'] = $info['name'];
        $language['file_name'] = $info['file_name'];
        $language['active'] = $info['active'];
        $language['default'] = $info['default'];

        $language_array[] = $language;
    }

    $results = $language_array;
    send_json($results);
    die();
}

/*
Get language variables
action = language_file
1. file_name

Messages
1. Success : array
*/
function language_file(){
    global $lang,$results;

    $lang_file_path = 'lang/all-languages.json';

    if(file_exists($lang_file_path)){
        echo $json_lang = file_get_contents($lang_file_path);
        die();
    }else{
        $results['status'] = "Language File Not exist";
        send_json($results);
        die();
    }
    die();
}

/*
Get main categories List
action = categories
*/
function categories()
{
    global $config, $con, $lang, $results;

    $category = array();

    $rows = ORM::for_table($config['db']['pre'].'catagory_main')
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($rows as $info)
    {
        $cat['id'] = $info['cat_id'];
        $cat['icon'] = $info['icon'];

        if($config['lang_code'] != 'en' && $config['userlangsel'] == '1'){
            $maincat = get_category_translation("main",$info['cat_id']);
            $cat['name'] = $maincat['title'];
            $cat['slug'] = $maincat['slug'];
        }else{
            $cat['name'] = $info['cat_name'];
            $cat['slug'] = $info['slug'];
        }

        $category[] = $cat;
    }

    $results = $category;
    send_json($results);
    die();
}

/*
Get sub categories By main category id
action = sub_categories
1. category_id

Messages
1. Success : array
*/
function sub_categories()
{
    global $config, $con, $lang, $results;
    $category_id = $_REQUEST['category_id'];
    $sub_category = array();

    $rows = ORM::for_table($config['db']['pre'].'catagory_sub')
        ->where('main_cat_id', $category_id)
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($rows as $info)
    {
        $subcat['id'] = $info['sub_cat_id'];
        $subcat['photo_show'] = $info['photo_show'];
        $subcat['price_show'] = $info['price_show'];

        if($config['lang_code'] != 'en' && $config['userlangsel'] == '1'){
            $subcategory = get_category_translation("sub",$info['sub_cat_id']);

            $subcat['name'] = $subcategory['title'];
            $subcat['slug'] = $subcategory['slug'];
        }else{
            $subcat['name'] = $info['sub_cat_name'];
            $subcat['slug'] =  $info['slug'];
        }

        $sub_category[] = $subcat;
    }

    $results = $sub_category;
    send_json($results);
    die();
}

/*
Make Offer
action = make_offer
1. SenderName
2. SenderId
3. OwnerName
4. OwnerId
5. email
6. subject
7. message
8. productId
9. productTitle
10. type

Messages
1. Success
*/

/*Post Ad APi*/
function custom_fields_json(){

    global $config;
    $maincatid = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcatid = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $custom_fields = array();


    $custom_fields = get_customFields_by_catid($maincatid,$subcatid);

    $results = $custom_fields;
    send_json($results);
    die();
}

function send_cusdata_getjson(){
    global $config,$lang;
    $cusfields = array();
    $maincatid = isset($_REQUEST['catid']) ? $_REQUEST['catid'] : 0;
    $subcatid = isset($_REQUEST['subcatid']) ? $_REQUEST['subcatid'] : 0;
    if ($maincatid > 0) {
        $custom_fields = get_customFields_by_catid($maincatid,$subcatid);
        if(isset($_REQUEST['custom'])){
            foreach ($custom_fields as $key => $value) {
                if ($value['userent']) {
                    $cf['id'] = $value['id'];
                    $cf['type'] = $value['type'];
                    if($cf['textarea'] == "textarea")
                        $cf['value'] = validate_input($value['default'],true);
                    else
                        $cf['value'] = validate_input($value['default']);

                    $cusfields[] = $cf;
                }
            }

            echo json_encode($cusfields);
            die();
        }
    } else {
        echo "error";
        die();
    }
}


function save_post_customField_data($custom_fields=array(),$product_id){

    global $config;

    if(count($custom_fields) > 0){
        foreach ($custom_fields as $key => $value) {
            $field_id = $value['id'];
            $field_type = $value['type'];
            if($field_type == "textarea")
                $field_data = validate_input($value['value'],true);
            else
                $field_data = validate_input($value['value']);

            if(isset($product_id)){
                $exist = 0;
                //Checking Data exist
                $exist = ORM::for_table($config['db']['pre'].'custom_data')
                    ->where(array(
                        'product_id' => $product_id,
                        'field_id' => $field_id
                    ))
                    ->count();

                if($exist > 0){
                    //Update here
                    $pdo = ORM::get_db();
                    $query = "UPDATE `".$config['db']['pre']."custom_data` set field_type = '".$field_type."', field_data = '".$field_data."' where product_id = '".$product_id."' and field_id = '".$field_id."' LIMIT 1";
                    $pdo->query($query);

                }else{
                    //Insert here
                    if($field_data != "") {
                        $field_insert = ORM::for_table($config['db']['pre'].'custom_data')->create();
                        $field_insert->product_id = $product_id;
                        $field_insert->field_id = $field_id;
                        $field_insert->field_type = $field_type;
                        $field_insert->field_data = $field_data;
                        $field_insert->save();
                    }
                }
            }
        }
    }
}


function getCustomFieldByCatID()
{
    global $config,$lang;
    $cusfields = array();
    $maincatid = isset($_REQUEST['catid']) ? $_REQUEST['catid'] : 0;
    $subcatid = isset($_REQUEST['subcatid']) ? $_REQUEST['subcatid'] : 0;

    if(isset($_REQUEST['additionalinfo'])){
        $_REQUEST['custom'] = array();
        $json_array = json_decode($_REQUEST['additionalinfo'], true);

        if(is_array($json_array)){

            $field_id = array();
            $field_value = array();

            foreach ($json_array as $key => $value) {
                $field_id[] = $value['id'];
                $field_value[] = $value['value'];
            }

            $custom_fields = get_customFields_by_catid($maincatid,$subcatid,false, $field_id, $field_value);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;

        }elseif ($maincatid > 0) {
            $custom_fields = get_customFields_by_catid($maincatid,$subcatid);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
        } else {
            $showCustomField = 0;
            die();
        }

    }else{
        if ($maincatid > 0) {
            $custom_fields = get_customFields_by_catid($maincatid,$subcatid);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
        } else {
            $showCustomField = 0;
            die();
        }
    }


    $tpl = '
    <input type="hidden" name="catid" value="'.$maincatid.'"/>
    <input type="hidden" name="subcatid" value="'.$subcatid.'"/>
    ';
    if ($showCustomField) {
        foreach ($custom_fields as $row) {
            $id = $row['id'];
            $name = $row['title'];
            $type = $row['type'];
            $required = $row['required'];

            if($type == "text-field"){
                $lookFront = $row['textbox'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                            <div class="col-sm-9">
                                '.$lookFront.'
                            </div>
                        </div>';
            }
            elseif($type == "textarea"){
                $lookFront = $row['textarea'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    '.$lookFront.'
                                </div>
                            </div>';
            }
            elseif($type == "radio-buttons"){
                $lookFront = $row['radio'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "checkboxes"){
                $lookFront = $row['checkboxBootstrap'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">'.$lookFront.'</div>
                            </div>';
            }
            elseif($type == "drop-down"){
                $lookFront = $row['selectbox'];
                $tpl .= '<div class="row form-group">
                                <label class="col-sm-3 label-title">'.$name.' '.($required === "1" ? '<span class="required">*</span>' : "").'</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="custom['.$id.']" '.$required.'>
                                        <option value="" selected>'.$lang['SELECT'].' '.$name.'</option>
                                        '.$lookFront.'
                                    </select>
                                </div>
                            </div>';
            }
        }

echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
    <title>Additional information form</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" href="checkbox-radio.css">
  </head>
  <body>
        <form method="post" id="custom_field_frm" action="'.$config['site_url'].'api/v1/?action=send_cusdata_getjson" accept-charset="UTF-8">
        '.$tpl.'
        <input type="submit"  type="button" value="Done" class="button btn-info">
        </form>
        
       <script type="text/javascript">
       
       // this is the id of the form
$("#custom_field_frm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr(\'action\');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form\'s elements.
           success: function(data)
           {
               AndroidInterface.additionalInfo(data);
           }
         });


});
        </script>
  </body>
</html>';

        die();
    }
    else {
        echo 0;
        die();
    }
}

/*
Save Post
action = save_post
1. user_id
2. category_id
3. subcategory_id
4. country_code
5. state
6. city
7. description
8. location
9. hide_phone
10. negotiable
11. price
12. phone
13. latitude
14. longitude
15. tags
16. item_screen

Messages
1. Success : insert id
*/
function save_post(){
    global $config,$lang,$results;


    $item_screen = "";

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;
    $country = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
    $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : null;
    $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : null;
    $hide_phone = isset($_REQUEST['hide_phone']) ? $_REQUEST['hide_phone'] : null;
    $negotiable = isset($_REQUEST['negotiable']) ? $_REQUEST['negotiable'] : null;
    $price = isset($_REQUEST['price']) ? $_REQUEST['price'] : 0;
    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : 0;
    $tags = isset($_REQUEST['tags']) ? $_REQUEST['tags'] : null;
    $additionalinfo = isset($_REQUEST['additionalinfo']) ? $_REQUEST['additionalinfo'] : null;
    $custom_fields = array();
    if($additionalinfo != null){
        $custom_fields = json_decode($additionalinfo, true);
    }

    $mapLat = $_REQUEST['latitude'];
    $mapLong = $_REQUEST['longitude'];
    $latlong = $mapLat . "," . $mapLong;
    $slug = create_post_slug($_REQUEST['title']);

    // Get usergroup details
    $user_info = ORM::for_table($config['db']['pre'].'user')
        ->select('group_id')
        ->find_one($user_id);

    $group_id = isset($user_info['group_id'])? $user_info['group_id'] : 0;

    // Get membership details
    $group_get_info = get_usergroup_settings($group_id);

    $urgent_project_fee = $group_get_info['urgent_project_fee'];
    $featured_project_fee = $group_get_info['featured_project_fee'];
    $highlight_project_fee = $group_get_info['highlight_project_fee'];

    $ad_duration = $group_get_info['ad_duration'];
    $timenow = date('Y-m-d H:i:s');
    $expire_time = date('Y-m-d H:i:s', strtotime($timenow . ' +'.$ad_duration.' day'));
    $expire_timestamp = strtotime($expire_time);

    if($config['post_auto_approve'] == 1){
        $status = "active";
    }else{
        $status = "pending";
    }

    if (isset($_REQUEST['item_screen'])) {
        $valid_formats = array("jpg", "jpeg", "png"); // Valid image formats
        $countScreen = 0;
        $picture = explode(',',$_REQUEST['item_screen']);
        foreach ($picture as $name) {
            $filename = stripslashes($name);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    //Valid File extension check

                } else {
                    $errors[]['message'] = $lang['ONLY_JPG_ALLOW'];
                }
                if ($countScreen == 0)
                    $item_screen = $filename;
                elseif ($countScreen >= 1)
                    $item_screen = $item_screen . "," . $filename;
                $countScreen++;
            }
        }
    }

    $item_insrt = ORM::for_table($config['db']['pre'].'product')->create();
    $item_insrt->user_id = $_REQUEST['user_id'];
    $item_insrt->product_name = $_REQUEST['title'];
    $item_insrt->slug = $slug;
    $item_insrt->status = $status;
    $item_insrt->category = $cat_id;
    $item_insrt->sub_category = $subcat_id;
    $item_insrt->description = $description;
    $item_insrt->price = $price;
    $item_insrt->negotiable = $negotiable;
    $item_insrt->phone = $phone;
    $item_insrt->hide_phone = $hide_phone;
    $item_insrt->location = $location;
    $item_insrt->city = $_REQUEST['city'];
    $item_insrt->state = $state;
    $item_insrt->country = $country;
    $item_insrt->latlong = $latlong;
    $item_insrt->screen_shot = $item_screen;
    $item_insrt->created_at = $timenow;
    $item_insrt->updated_at = $timenow;
    $item_insrt->expire_date = $expire_timestamp;
    $item_insrt->save();

    $product_id = $item_insrt->id();
    save_post_customField_data($custom_fields,$product_id);
    $results['status'] = "success";
    $results['id'] = $product_id;
    send_json($results);
    die();
}


/*
Search Post
action = search_post
1. page
2. order
3. limit
4. keywords
5. cat
6. subcat
7. placetype
8. placeid
9. range1 (price min)
10. range2 (price max)
11. custom (array for custom values)

Messages
1. array
*/

function search_post(){
    global $config,$lang,$results;
    $pdo = ORM::getDb();
    $mysqli = db_connect();
    $category = "";
    $subcat = "";
    $total = 0;
    $where = '';
    $order_by_keyword = '';

    $page_number = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $order = isset($_REQUEST['order']) && ($_REQUEST['order'] != "") ? $_REQUEST['order'] : "DESC";
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
    $filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : "";
    $sorting = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "Newest";
    $budget = isset($_REQUEST['budget']) ? $_REQUEST['budget'] : "";
    $keywords = isset($_REQUEST['keywords']) ? str_replace("-"," ",$_REQUEST['keywords']) : "";
    $city = isset($_REQUEST['city']) && ($_REQUEST['city'] != "") ? $_REQUEST['city'] : "";


    if(!isset($_REQUEST['sort']))
        $sort = "id";
    elseif($_REQUEST['sort'] == "title")
        $sort = "product_name";
    elseif($_REQUEST['sort'] == "price")
        $sort = "price";
    elseif($_REQUEST['sort'] == "date")
        $sort = "created_at";
    else
        $sort = "id";

    if(isset($_REQUEST['subcategory_id']) && !empty($_REQUEST['subcategory_id'])){

        if(is_numeric($_REQUEST['subcategory_id'])){
            if(check_sub_category_exists($_REQUEST['subcategory_id'])){
                $subcat = $_REQUEST['subcategory_id'];
            }
        }
    }

    if(isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id'])){
        if(is_numeric($_REQUEST['category_id'])){
            if(check_category_exists($_REQUEST['category_id'])){
                $category = $_REQUEST['category_id'];
            }
        }
    }

    /*if($subcat != ''){
        $custom_fields = get_customFields_by_catid('',$subcat,false);
    }else if($category != ''){
        $custom_fields = get_customFields_by_catid($category,'',false);
    }else{
        $custom_fields = get_customFields_by_catid('','',false);
    }*/

    if(isset($_REQUEST['keywords']) && !empty($_REQUEST['keywords'])){

        $where.= "AND (p.product_name LIKE '%$keywords%' or p.tag LIKE '%$keywords%') ";
        $order_by_keyword = "(CASE
    WHEN p.product_name = '$keywords' THEN 1
    WHEN p.product_name LIKE '$keywords%' THEN 2
    WHEN p.product_name LIKE '%$keywords%' THEN 3
    WHEN p.tag = '$keywords' THEN 4
    WHEN p.tag LIKE '$keywords%' THEN 5
    WHEN p.tag LIKE '%$keywords%' THEN 6
    ELSE 7
  END),";

    }

    if(isset($category) && !empty($category)){

        $where.= "AND (p.category = '$category') ";
    }

    if(isset($subcat) && !empty($subcat)){

        $where.= "AND (p.sub_category = '$subcat') ";
    }

    if (isset($_REQUEST['range1']) && $_REQUEST['range1'] != '') {

        $range1 = str_replace('.', '', $_REQUEST['range1']);
        $range2 = str_replace('.', '', $_REQUEST['range2']);
        $where.= ' AND (p.price BETWEEN '.$range1.' AND '.$range2.')';
    } else {
        $range1 = "";
        $range2 = "";
    }

    if(isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

        $where.= "AND (p.city = '".$_REQUEST['city']."') ";
    }
    elseif(isset($_REQUEST['location']) && !empty($_REQUEST['location'])) {

        $placetype = $_REQUEST['placetype'];
        $placeid = $_REQUEST['placeid'];

        if($placetype == "country"){
            $where.= "AND (p.country = '$placeid') ";
        }elseif($placetype == "state"){
            $where.= "AND (p.state = '$placeid') ";
        }else{
            $where.= "AND (p.city = '$placeid') ";
        }
    }
    else{
        $country_code = check_user_country();
        $where.= "AND (p.country = '$country_code') ";
    }

    $additionalinfo = isset($_REQUEST['additionalinfo']) ? $_REQUEST['additionalinfo'] : null;
    $custom_fields = array();
    if($additionalinfo != null){

        $custom_fields = json_decode($additionalinfo, true);

        $whr_count = 1;
        $custom_where = "";
        $custom_join = "";
        foreach ($custom_fields as $key => $value) {
            $field_id = $value['id'];
            $field_type = $value['type'];
            $field_value = $value['value'];

            if (empty($field_value)) {
                unset($custom_fields[$key]);
            }
            if (!empty($field_value)) {
                // custom value is not empty.

                if ($field_id != "" && $field_value != "") {
                    $c_as = "c".$whr_count;
                    $custom_join .= " 
                    JOIN `".$config['db']['pre']."custom_data` AS $c_as ON $c_as.product_id = p.id AND `$c_as`.`field_id` = '$field_id' ";

                    if (is_array($field_value)) {
                        $custom_where = " AND ( ";
                        $cond_count = 0;
                        foreach ($field_value as $val) {
                            if ($cond_count == 0) {
                                $custom_where .= " find_in_set('$val',$c_as.field_data) <> 0 ";
                            } else {
                                $custom_where .= " AND find_in_set('$val',$c_as.field_data) <> 0 ";
                            }
                            $cond_count++;
                        }
                        $custom_where .= " )";
                    }else{
                        $custom_where .= " AND `$c_as`.`field_data` = '$field_value' ";
                    }

                    $whr_count++;
                }
            }
        }
        if($custom_where != "")
            $where .= $custom_where;

        if($additionalinfo != null){
            $sql = "SELECT DISTINCT p.*
FROM `".$config['db']['pre']."product` AS p
$custom_join
 WHERE p.status = 'active' AND p.hide = '0' ";
        }else{
            $sql = "SELECT DISTINCT p.*
FROM `".$config['db']['pre']."product` AS p
 WHERE p.status = 'active' AND p.hide = '0' ";
        }

        $q = "$sql $where";
        $query = $pdo->query($q);
        $totalWithoutFilter = $query->rowCount();
    }
    else{
        $q = "SELECT 1 FROM ".$config['db']['pre']."product as p where status = 'active' $where";
        $query = $pdo->query($q);
        $totalWithoutFilter = $query->rowCount();
    }

    if(isset($_REQUEST['filter'])){
        if($_REQUEST['filter'] == 'free')
        {
            $where.= "AND (p.urgent='0' AND p.featured='0' AND p.highlight='0') ";
        }
        elseif($_REQUEST['filter'] == 'featured')
        {
            $where.= "AND (p.featured='1') ";
        }
        elseif($_REQUEST['filter'] == 'urgent')
        {
            $where.= "AND (p.urgent='1') ";
        }
        elseif($_REQUEST['filter'] == 'highlight')
        {
            $where.= "AND (p.highlight='1') ";
        }
    }

    $order_by = "
      (CASE
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
        WHEN g.top_search_result = 'yes' and p.urgent = '1' THEN 5
        WHEN g.top_search_result = 'yes' and p.featured = '1' THEN 6
        WHEN g.top_search_result = 'yes' and p.highlight = '1' THEN 7
        WHEN g.top_search_result = 'yes' THEN 8
        WHEN p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 9
        WHEN p.urgent = '1' and p.featured = '1' THEN 10
        WHEN p.urgent = '1' and p.highlight = '1' THEN 11
        WHEN p.featured = '1' and p.highlight = '1' THEN 12
        WHEN p.urgent = '1' THEN 13
        WHEN p.featured = '1' THEN 14
        WHEN p.highlight = '1' THEN 15
        ELSE 16
      END),".$order_by_keyword." $sort $order";

    if($additionalinfo != null){

        if ($additionalinfo != null) {
            $sql = "SELECT DISTINCT p.* FROM `".$config['db']['pre']."product` AS p $custom_join WHERE status = 'active' ";
        }else{
            $sql = "SELECT DISTINCT p.* FROM `".$config['db']['pre']."product` AS p WHERE p.status = 'active' ";
        }

        $query =  $sql . " $where ORDER BY $sort $order LIMIT ".($page_number-1)*$limit.",$limit";

        $total = mysqli_num_rows(mysqli_query($mysqli, "$sql $where"));
        $featuredAds = mysqli_num_rows(mysqli_query($mysqli, "$sql and (p.featured='1') $where"));
        $urgentAds = mysqli_num_rows(mysqli_query($mysqli, "$sql and (p.urgent='1') $where"));
    }
    else{
        $total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM ".$config['db']['pre']."product as p where status = 'active' $where"));
        $featuredAds = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM ".$config['db']['pre']."product as p where status = 'active' and featured='1' $where"));
        $urgentAds = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM ".$config['db']['pre']."product as p where status = 'active' and urgent='1' $where"));


        $query = "SELECT p.*,u.group_id,g.top_search_result FROM `".$config['db']['pre']."product` as p
            INNER JOIN `".$config['db']['pre']."user` as u ON u.id = p.user_id
            INNER JOIN `".$config['db']['pre']."usergroups` as g ON g.group_id = u.group_id 
            where p.status = 'active' $where ORDER BY $order_by LIMIT ".($page_number-1)*$limit.",$limit";
    }

    $count = 0;
    $noresult_id = "";
    //Loop for list view
    $item = array();
    $posts = array();
    $result = $pdo->query($query);
    $row_count = $result->rowCount();
    if ($row_count > 0) {
        // output data of each row
        foreach($result as $info) {
            $item['id'] = $info['id'];
            $item['product_name'] = $info['product_name'];
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];
            $item['highlight_bgClr'] = ($info['highlight'] == 1)? "highlight-premium-ad" : "";

            $cityname = get_cityName_by_id($info['city']);
            $item['location'] = $cityname;
            $item['city'] = $cityname;
            $item['status'] = $info['status'];
            $item['hide'] = $info['hide'];

            $item['created_at'] = timeAgo($info['created_at']);
            $expire_date_timestamp = $info['expire_date'];
            $expire_date = date('d-M-y', $expire_date_timestamp);
            $item['expire_date'] = $expire_date;

            $item['cat_id'] = $info['category'];
            $item['sub_cat_id'] = $info['sub_category'];
            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $item['category'] = $get_main['cat_name'];
            $item['sub_category'] = $get_sub['sub_cat_name'];

            $item['favorite'] = check_product_favorite($info['id']);

            if($info['tag'] != ''){
                $item['showtag'] = "1";
                $item['tag'] = $info['tag'];
            }else{
                $item['tag'] = "";
                $item['showtag'] = "0";
            }

            $picture = explode(',' ,$info['screen_shot']);
            $item['pic_count'] = count($picture);

            if($picture[0] != ""){
                $item['picture'] = $config['site_url']."storage/products/thumb/".$picture[0];
            }else{
                $item['picture'] = $config['site_url']."storage/products/thumb/default.png";
            }

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];


            $userinfo = get_user_data("",$info['user_id']);
            $item['username'] = $userinfo['username'];
            $item['user_id'] = $userinfo['id'];


            if(check_user_upgrades($info['user_id']))
            {
                $sub_info = get_user_membership_detail($info['user_id']);
                $item['subcription_title'] = $sub_info['sub_title'];
                $item['subcription_image'] = $sub_info['sub_image'];
            }else{
                $item['subcription_title'] = '';
                $item['subcription_image'] = '';
            }

            $posts[] = $item;
        }
    }

    $results = $posts;
    send_json($results);
    die();
}


function make_offer()
{
    global $config, $lang, $results;
    $SenderName = $_REQUEST['SenderName'];
    $SenderId = $_REQUEST['SenderId'];
    $OwnerName = $_REQUEST['OwnerName'];
    $OwnerId = $_REQUEST['OwnerId'];
    $productId = $_REQUEST['productId'];
    $productTitle = $_REQUEST['productTitle'];
    $type = $_REQUEST['type'];
    $message = $_REQUEST['message'];

    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];



    //email($email,$SenderName,$subject,$message);

    add_notification($SenderName,$SenderId,$OwnerName,$OwnerId,$productId,$productTitle,$type,$message);



    $results['status'] = "success";
    send_json($results);
    die();
}

function upload_product_picture(){
    global $config,$results;


    $file_avatar = $_FILES["fileToUpload"];
    $path_avatar = "../../storage/products/";
    $first_title = uniqid();

    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title, 800, 800,true);

    if($getAvatar != ""){

        $imagePath = $path_avatar."small_".$getAvatar;
        $newpath = "../../storage/products/thumb/".$getAvatar;
        $copied = rename($imagePath , $newpath);

        $picture_url = $config['site_url'].'storage/products/thumb/' . $getAvatar;

        $results['status'] = "success";
        $results['picture'] = $getAvatar;
        send_json($results);

    }else{
        $results['status'] = "failed";
        $results['picture'] = "";
        send_json($results);
    }

    send_json($results);
    die();
}


function upload_profile_picture(){
    global $config,$results;

    $user_id = $_REQUEST['user_id'];
    $file_avatar = $_FILES["fileToUpload"];
    $path_avatar = "../../storage/profile/";
    $first_title = uniqid();


    // receive image as POST Parameter
    $image = str_replace('data:image/png;base64,', '', $_POST['image']);
    $image = str_replace(' ', '+', $image);
    // Decode the Base64 encoded Image
    $data = base64_decode($image);
    // Create Image path with Image name and Extension
    $file = '../images/' . "MyImage" . '.jpg';
    // Save Image in the Image Directory
    $success = file_put_contents($file, $data);

    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title, 800, 800,true);

    if($getAvatar != ""){
        if($user_id){
            $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($user_id);
            $user_update->set('image', $getAvatar);
            $user_update->save();
        }
        $picture_url = $config['site_url'].'storage/profile/small_' . $getAvatar;

        $results['status'] = "success";
        $results['url'] = $picture_url;
        send_json($results);

    }else{
        $results['status'] = "failed";
        $results['url'] = "";
        send_json($results);
    }

    send_json($results);
    die();
}

function sendFCM($mess,$id) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
        'to' => $id,
        'notification' => array (
            "body" => $mess,
            "title" => "Title",
            "icon" => "myicon"
        )
    );
    $fields = json_encode ( $fields );
    $headers = array (
        'Authorization: key=' . "AAAAPwvjc5I:APA91bFf8l14tuvDM4eU6XMyXDXOhktFMk8PxSl0wwWMg_w3CufvsnX8sXoivnBh8UdvpvGoMk163LnWvM2IzKZlPm63kTtPfDHuTrYFxQRKT4f76vFrn8zq_b00yoI6U064xd_U_eJs",
        'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    curl_close ( $ch );
}


function send_json($results = array()){
    //echo "<pre>". print_r($results)."</pre>";
    echo json_encode($results);
    unset($_SESSION['user']);
    die();
}

