<?php
$config['lang'] = check_user_lang();
$config['lang_code'] = get_current_lang_code();
$config['tpl_name'] = check_user_theme();

function get_random_id(){

    $random = '';

    for ($i = 1; $i <= 8; $i++)
    {
        $random.= mt_rand(0, 9);
    }

    return $random;
}

function change_user_country($country_code){

    global $config;

    if(get_option("country_type") == "multi"){
        $countryName = get_countryName_by_sortname($country_code);
        if(!$countryName) return;
        $_SESSION['user']['country'] = $country_code;
        set_user_currency($country_code);
    }
}
// Function to get the client IP address
function get_client_ip() {

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function check_user_country(){
    global $config;
    if(isset($_SESSION['user']['country']))
    {
        $country_code = $_SESSION['user']['country'];
    }
    else{
        if($config['country_type'] == 'multi'){
            $geo_api = "";
            $ip = get_client_ip();
            if($geo_api == "ipapi"){
                $country_json = file_get_contents("http://ip-api.com/json/{$ip}");
                $country = json_decode($country_json);
                $country_code = isset($country->countryCode)? $country->countryCode : $config['specific_country'];
            }
            elseif($geo_api == "apinotes"){
                $country_json = file_get_contents("http://apinotes.com/ipaddress/ip.php?ip={$ip}");
                $country = json_decode($country_json);
                $country_code = isset($country->countryCode)? $country->countryCode : $config['specific_country'];
            }
            elseif($geo_api == "ipinfo"){
                $country_code= file_get_contents("http://ipinfo.io/{$ip}/country");
                $country_code = isset($country_code)? trim($country_code) : $config['specific_country'];
            }
            else{
                $country_code = $config['specific_country'];
            }
        }else{
            $country_code = $config['specific_country'];
        }

        if(isset($country_code) && $config['country_type'] == 'multi'){

            if(check_country_activated($country_code)){
                $_SESSION['user']['country'] = $country_code;
            }else{
                $_SESSION['user']['country'] = $config['specific_country'];
                $country_code = $_SESSION['user']['country'];
            }
        }else{
            $_SESSION['user']['country'] = $config['specific_country'];
            $country_code = $_SESSION['user']['country'];
        }
    }

    return $country_code;
}

function get_user_group(){

    global $config;
    $usergroup = 0;

    if(isset($_SESSION['user']['id'])) {

        $user_info = ORM::for_table($config['db']['pre'].'user')
            ->select('group_id')
            ->find_one($_SESSION['user']['id']);

        $usergroup = isset($user_info['group_id'])? $user_info['group_id'] : 0;

    }
    return $usergroup;
}

function set_user_currency($country_code){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'countries')
        ->select('currency_code')
        ->where('code', $country_code)
        ->find_one();
    $currency_code = $info['currency_code'];

    $currency_info = ORM::for_table($config['db']['pre'].'currencies')
        ->where('code', $currency_code)
        ->find_one();

    /*$config['currency_code'] = $info['code'];
    $config['currency_sign'] = $info['html_entity'];
    $config['currency_pos'] = $info['in_left'];*/

    return $currency_info;
}

function change_user_lang($lang_code){

    global $config;

    $lang_code = get_language_by_code($lang_code,true);
    if(!$lang_code) return;
    $cookie_name = "Quick_lang";
    $cookie_value = $lang_code['file_name'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    if($config['userlangsel'] == '1')
    {
        $config['lang'] = $lang_code['file_name'];
        $config['lang_code'] = get_current_lang_code();
    }
}

function check_user_lang(){

    global $config;

    if($config['userlangsel'] == '1')
    {
        $cookie_name = "Quick_lang";
        if(isset($_COOKIE[$cookie_name])) {
            $config['lang'] = $_COOKIE[$cookie_name];
        }
    }
    return $config['lang'];
}

function get_current_lang_code(){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'languages')
        ->select('code')
        ->where('file_name', $config['lang'])
        ->find_one();
    return strtolower($info['code']);
}

function check_user_theme(){

    global $config;

    if($config['userthemesel'])
    {
        $cookie_name = "Quick_theme";
        if(isset($_COOKIE[$cookie_name])) {
            $config['tpl_name'] = $_COOKIE[$cookie_name];
        }
    }

    return $config['tpl_name'];
}

function check_account_exists($email){

    global $config;

    $count = ORM::for_table($config['db']['pre'].'user')
        ->where('email', $email)
        ->count();

    // check existing email
    if ($count) {
        return $count;
    } else {
        return 0;
    }
}

function check_table_row_exists($id_field_name,$id_value,$table_name){

    global $config;

    $count = ORM::for_table($config['db']['pre'].$table_name)
        ->where($id_field_name, $id_value)
        ->count();

    // check row exist
    if ($count) {
        return $count;
    } else {
        return 0;
    }
}

function check_username_exists($username){

    global $config;

    $count = ORM::for_table($config['db']['pre'].'user')
        ->where('username', $username)
        ->count();

    // check row exist
    if ($count) {
        return $count;
    } else {
        return 0;
    }
}

function get_user_id($username){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('id')
        ->where('username', $username)
        ->find_one();

    if(isset($info['id'])){
        return $info['id'];
    }
    else{
        return FALSE;
    }
}

function get_user_id_by_email($email){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('id')
        ->where('email', $email)
        ->find_one();

    if(isset($info['id'])){
        return $info['id'];
    }
    else{
        return FALSE;
    }
}

function get_username_by_email($email){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('username')
        ->where('email', $email)
        ->find_one();

    if(isset($info['username'])){
        return $info['username'];
    }
    else{
        return FALSE;
    }
}

function is_seller($username){

    global $config;

    $info = ORM::for_table($config['db']['pre'].'user')
        ->select('user_type')
        ->where('username', $username)
        ->find_one();

    if(isset($info['user_type'])){
        $user_type = $info['user_type'];
        if($user_type == "seller")
            return TRUE;
        else
            return FALSE;
    }
    else{
        return FALSE;
    }
}

function create_user_session($userid,$username,$password){
    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

    $user_id = preg_replace("/[^0-9]+/", "", $userid); // XSS protection as we might print this value
    $_SESSION['user']['id']  = $user_id;

    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
    $_SESSION['user']['username'] = $username;

    $_SESSION['user']['login_string'] = hash('sha512', $password . $user_browser);
}

function userlogin($email,$password)
{
    global $config, $user_id, $username,  $db_password, $where;

    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if(!preg_match("/^[[:alnum:]]+$/", $email))
    {
        if(!preg_match($regex,$email))
        {
            return false;
        }
        else{
            //checking in email
            $where = 'email';
        }
    }
    else{
        //checking in username
        $where = 'username';
    }

    $num_rows = ORM::for_table($config['db']['pre'].'user')
        ->select_many('id', 'status', 'username', 'password_hash')
        ->where($where, $email)
        ->count();

    if ($num_rows >= 1) {
        $info = ORM::for_table($config['db']['pre'].'user')
            ->select_many('id', 'status', 'username', 'password_hash')
            ->where($where, $email)
            ->find_one();

        $user_id = $info['id'];
        $status = $info['status'];
        $username = $info['username'];
        $db_password = $info['password_hash'];

        // If the user exists we check if the account is locked
        // from too many login attempts

        /*if (checkbrute($user_id) == true) {
            // Account is locked
            // Send an email to user saying their account is locked
            return false;
        } else {
            // Check if the password in the database matches
            // the password the user submitted. We are using
            // the password_verify function to avoid timing attacks.

        }*/
        if (password_verify($password, $db_password)) {
            // Password is correct!

            // Login successful.
            $userinfo = array();
            $userinfo['id'] = $user_id;
            $userinfo['status'] = $status;
            $userinfo['username'] = $username;
            $userinfo['password'] = $db_password;

            return $userinfo;

        } else {
            // Password is not correct
            // We record this attempt in the database
            $now = time();
            $login_attempts = ORM::for_table($config['db']['pre'].'login_attempts')->create();
            $login_attempts->user_id = $user_id;
            $login_attempts->time = $now;
            $login_attempts->save();

            return false;
        }
    } else {
        // No user exists.
        return false;
    }
	
}

function checkloggedin()
{
    global $config,$password;

    // Check if all session variables are set
    if (isset($_SESSION['user']['id'],
        $_SESSION['user']['username'],
        $_SESSION['user']['login_string'])) {

        $user_id = $_SESSION['user']['id'];
        $login_string = $_SESSION['user']['login_string'];
        $username = $_SESSION['user']['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $result = ORM::for_table($config['db']['pre'].'user')
            ->select('password_hash')
            ->where('id', $user_id)
            ->find_one();

        if (!empty($result)) {

            $login_check = hash('sha512', $result['password_hash'] . $user_browser);

            if (hash_equals($login_check, $login_string) ){
                // Logged In!!!!
                return true;
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Not logged in
            return false;
        }
    } else {
        // Not logged in
        return false;
    }
}

function createusernameslug($title){
    global $config;
    $numHits = 0;
    $slug = $title;

    $numHits = ORM::for_table($config['db']['pre'].'user')
        ->where_like('username', ''.$slug.'%')
        ->count();

    return ($numHits > 0) ? ($slug.$numHits) : $slug;
}

function checkSocialUser($userData = array(),$picname){

    global $config;

    if(!empty($userData)){

        $fullname = $userData['first_name'].' '.$userData['last_name'];
        $fbfirstname = $userData['first_name'];

        // Check whether user data already exists in database
        $info = ORM::for_table($config['db']['pre'].'user')
            ->where_any_is(array(
                array('email' => $userData['email']),
                array('oauth_provider' => 'Fred', $userData['oauth_provider'] => $userData['oauth_uid'])))
            ->count();

        if(isset($info['id'])){
            $userData = $info;
        }else{
            if(check_username_exists($fbfirstname)){
                $username = createusernameslug($fbfirstname);
            }
            else{
                $username = $fbfirstname;
            }

            $location = getLocationInfoByIp();
            $gender = ($userData['gender'] == "") ? "Male" : $userData['gender'];
            $password = get_random_id();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
            // Insert user data
            $now = date("Y-m-d H:i:s");

            $insert_user = ORM::for_table($config['db']['pre'].'user')->create();
            $insert_user->oauth_provider = $userData['oauth_provider'];
            $insert_user->oauth_uid = $userData['oauth_uid'];
            $insert_user->status = '1';
            $insert_user->name = $fullname;
            $insert_user->username = $username;
            $insert_user->password_hash = $pass_hash;
            $insert_user->email = $userData['email'];
            $insert_user->sex = $gender;
            $insert_user->image = $picname;
            $insert_user->oauth_link = $userData['link'];
            $insert_user->created_at = $now;
            $insert_user->updated_at = $now;
            $insert_user->country = $location['country'];
            $insert_user->city = $location['city'];
            $insert_user->save();

            $user_id = $insert_user->id();
            // Get user data from the database
            $userData['id'] = $user_id;
            $userData['username'] = $username;
            $userData['password_hash'] = $pass_hash;
            $userData['status'] = 1;
        }
    }

    // Return user data
    return $userData;
}

function get_user_data($username=null,$userid=null){

    global $config;

    if($username != null){
        $info = ORM::for_table($config['db']['pre'].'user')
            ->where('username', $username)
            ->find_one();
    }
    else{
        $info = ORM::for_table($config['db']['pre'].'user')
            ->where('id', $userid)
            ->find_one();
    }

    if (isset($info['id'])) {
        $userinfo['id']         = $info['id'];
        $userinfo['username']   = $info['username'];
        $userinfo['user_type']  = $info['user_type'];
        $userinfo['name']       = $info['name'];
        $userinfo['email']      = $info['email'];
        $userinfo['confirm']    = $info['confirm'];
        $userinfo['password']   = $info['password_hash'];
        $userinfo['forgot']     = $info['forgot'];
        $userinfo['status']     = $info['status'];
        $userinfo['view']       = $info['view'];
        $userinfo['image']      = $info['image'];
        $userinfo['tagline']    = $info['tagline'];
        $userinfo['description'] = $info['description'];
        $userinfo['sex']        = $info['sex'];
        $userinfo['phone']      = $info['phone'];
        $userinfo['postcode']   = $info['postcode'];
        $userinfo['address']    = $info['address'];
        $userinfo['country']    = $info['country'];
        $userinfo['city']       = $info['city'];
        $userinfo['lastactive'] = $info['lastactive'];
        $userinfo['online']     = $info['online'];
        $userinfo['created_at'] = timeAgo($info['created_at']);
        $userinfo['updated_at'] = $info['updated_at'];

        $userinfo['facebook']   = $info['facebook'];
        $userinfo['twitter']    = $info['twitter'];
        $userinfo['googleplus'] = $info['googleplus'];
        $userinfo['instagram']  = $info['instagram'];
        $userinfo['linkedin']   = $info['linkedin'];
        $userinfo['youtube']    = $info['youtube'];

        $userinfo['notify']    = $info['notify'];
        $userinfo['notify_cat']    = $info['notify_cat'];
        $userinfo['website']    = $info['website'];
        return $userinfo;
    }
    else{
        return 0;
    }
}

function update_lastactive(){

    global $config;

    if(isset($_SESSION['user']['id']))
    {
        $person = ORM::for_table($config['db']['pre'].'user')->find_one($_SESSION['user']['id']);
        $person->set_expr('lastactive', 'NOW()');
        $person->save();
    }
}

function send_forgot_email($to,$id)
{
    global $config,$lang,$link;
	$time = time();
	$rand = getrandnum(10);
	$forgot = md5($time.'_:_'.$rand.'_:_'.$to);

    $person = ORM::for_table($config['db']['pre'].'user')->find_one($id);
    $person->forgot = $forgot;
    $person->save();

    $get_userdata = get_user_data(null,$id);
    $to_name = $get_userdata['name'];

    $page = new HtmlTemplate();
    $page->html = $config['email_sub_forgot_pass'];
    $page->SetParameter ('EMAIL', $to);
    $page->SetParameter ('USER_FULLNAME', $to_name);
    $email_subject = $page->CreatePageReturn($lang,$config,$link);

    $forget_password_link = $config['site_url']."login?forgot=".$forgot."&r=".$rand."&e=".$to."&t=".$time;
    $page = new HtmlTemplate();
    $page->html = $config['email_message_forgot_pass'];
    $page->SetParameter ('FORGET_PASSWORD_LINK', $forget_password_link);
    $page->SetParameter ('EMAIL', $to);
    $page->SetParameter ('USER_FULLNAME', $to_name);
    $email_body = $page->CreatePageReturn($lang,$config,$link);

    email($to,$to_name,$email_subject,$email_body);
}

function getrandnum($length)
{
    $randstr='';
    srand((double)microtime()*1000000);
    $chars = array ( 'a','b','C','D','e','f','G','h','i','J','k','L','m','N','P','Q','r','s','t','U','V','W','X','y','z','1','2','3','4','5','6','7','8','9');
    for ($rand = 0; $rand <= $length; $rand++)
    {
        $random = rand(0, count($chars) -1);
        $randstr .= $chars[$random];
    }

    return $randstr;
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function update_profileview($user_id){

    global $config;

    $person = ORM::for_table($config['db']['pre'].'user')->find_one($user_id);
    $person->set_expr('view', 'view+1');
    $person->save();
}


/********************SECURE LOGIN*********************/
function sec_session_start() {
    define("CAN_REGISTER", "any");
    define("DEFAULT_ROLE", "member");
    define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function checkbrute($user_id) {

    global $config;
    // Get timestamp of current time
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    $num_rows = ORM::for_table($config['db']['pre'].'login_attempts')
        ->where_any_is(array(
            array('user_id' => $user_id, 'time' => $valid_attempts)), array('time' => '>'))
        ->count();

    // If there have been more than 5 failed login
    if ($num_rows > 5) {
        return true;
    } else {
        return false;
    }
}

function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
?>