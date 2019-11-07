<?php
function check_allow()
{
    if(isset($_SESSION['admin']['id']) && $_SESSION['admin']['id'] == 1)
    {
        return TRUE;
    }
    else
    {
        return TRUE;
    }
}

function check_update_available(){
    global $config;
    //Check For An Update
    $getVersions = file_get_contents('https://bylancer.com/api/quickad-release-versions.php') or die ('ERROR');
    $versionList = explode("\n", $getVersions);
    foreach ($versionList as $aV) {
        if ($aV > $config['version']) {
            return $aV;
        }
    }
    return false;
}

function admin_session_start() {
    define("CAN_REGISTER", "no");
    define("DEFAULT_ROLE", "admin");
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

function checkloggedadmin(){

    global $config,$password;
    $mysqli = db_connect();
    // Check if all session variables are set
    if (isset($_SESSION['admin']['id'],
        $_SESSION['admin']['username'],
        $_SESSION['admin']['login_string'])) {

        $user_id = $_SESSION['admin']['id'];
        $login_string = $_SESSION['admin']['login_string'];
        $username = $_SESSION['admin']['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password_hash FROM `".$config['db']['pre']."admins` WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

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
    } else {
        // Not logged in
        echo '<script>window.location="login.php"</script>';
    }
}

function adminlogin($email,$password){

    global $config, $user_id, $username,  $db_password, $where;
    $mysqli = db_connect();

    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if(!preg_match("/^[[:alnum:]]+$/", $email))
    {
        if(!preg_match($regex,$email))
        {
            return false;
        }
        else{
            //checking in email
            $where = " WHERE email = ? ";
        }
    }
    else{
        //checking in username
        $where = " WHERE username = ? ";
    }

    // Using prepared statements means that SQL injection is not possible.
    $sql = "SELECT id, username, password_hash 
        FROM `".$config['db']['pre']."admins`
        $where
        LIMIT 1";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts

            // Check if the password in the database matches
            // the password the user submitted. We are using
            // the password_verify function to avoid timing attacks.
            if (password_verify($password, $db_password)) {
                // Password is correct!
                // Login successful.
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
                $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
                $_SESSION['admin']['id']  = $user_id;
                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_id); // XSS protection as we might print this value
                $_SESSION['admin']['username'] = $username;
                $_SESSION['admin']['login_string'] = hash('sha512', $db_password . $user_browser);

                return true;

            } else {
                // Password is not correct
                return false;
            }
        } else {
            // No user exists.
            return false;
        }
    }

}

function check_purchse_valid(){

    global $config;

    $cron_validation_time = isset($config['cron_validation_time']) ? $config['cron_validation_time'] : time();
    $cron_validation_exec_time = isset($config['cron_validation_exec_time']) ? $config['cron_validation_exec_time'] : "86400";
    if((time()-$cron_validation_exec_time) > $cron_validation_time) {
        ignore_user_abort(1);
        @set_time_limit(0);
        $start_time = time();
        update_option('cron_validation_time',time());
        $status = "";
        $message = "";
        if(isset($config['purchase_key'])){
            $url = "https://bylancer.com/api/api.php?verify-purchase=" . $config['purchase_key'] . "&site_url=". $config['site_url'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            $output = json_decode(curl_exec($ch), true);
            curl_close($ch);
            if ($output['success']) {
                $status = "success";
                $message = 'success';
            } else {
                $filename = $config['quickad_secret_file'];
                $filename = $filename.".php";
                unlink($filename);
                delete_option("quickad_secret_file");
                delete_option("purchase_key");
                $status = "error";
                $message = $output['error'];
            }
        }else{
            if(isset($config['quickad_secret_file'])){
                $filename = "admin/".$config['quickad_secret_file'];
                unlink($filename);
                delete_option("quickad_secret_file");
                delete_option("purchase_key");
                $status = "error";
                $message = "Invalid";
            }
        }
        $end_time = (time()-$start_time);
        $valid = "yes";
        $cron_details = "Vaidation: ".$valid."<br>";
        $cron_details.= $status ." : ". $message."<br>";
        $cron_details.= "Cron Took: ".$end_time." seconds";
        //log_adm_action('P-C-Validation',$cron_details);
    }
    else {
        return false;
    }
}
check_purchse_valid();

function transaction_success($transaction_id){

    global $config;
    $mysqli = db_connect();

    $result = $mysqli->query("SELECT * FROM `".$config['db']['pre']."transaction` WHERE `id` = '" . $transaction_id . "' LIMIT 1");
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $info = mysqli_fetch_assoc($result);

        $item_pro_id = $info['product_id'];
        $user_id = $info['seller_id'];
        $item_amount = $info['amount'];

        if($info['transaction_method'] == 'Subscription'){
            $subcription_id = $item_pro_id;

            // Check that the payment is valid
            $subsc_details = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM ".$config['db']['pre']."subscriptions WHERE sub_id='".validate_input($subcription_id)."' LIMIT 1"));

            $term = 0;
            if($subsc_details['sub_term'] == 'DAILY')
                $term = 86400;
            elseif($subsc_details['sub_term'] == 'WEEKLY')
                $term = 604800;
            elseif($subsc_details['sub_term'] == 'MONTHLY')
                $term = 2678400;
            elseif($subsc_details['sub_term'] == 'YEARLY')
                $term = 31536000;

            $sub_group_id = $subsc_details['group_id'];
            $sub_amount = $subsc_details['sub_amount'];

            // Check valid user
            $user_check = mysqli_num_rows(mysqli_query($mysqli,"SELECT 1 FROM ".$config['db']['pre']."user WHERE id='".validate_input($user_id)."' LIMIT 1"));

            if(!$user_check)
            {
                exit('error, user does not exist');
            }

            $subsc_check = mysqli_num_rows(mysqli_query($mysqli,"select * from `".$config['db']['pre']."upgrades` WHERE `user_id` = '".validate_input($user_id)."' LIMIT 1 ;"));

            if($subsc_check == 1)
            {
                $txn_type = 'subscr_update';
            }
            else
            {
                $txn_type = 'subscr_signup';
            }

            // Add time to their subscription
            $expires = (time()+$term);

            if($txn_type == 'subscr_update')
            {
                mysqli_query($mysqli,"UPDATE `".$config['db']['pre']."upgrades` SET `sub_id` = '".validate_input($subcription_id)."',`upgrade_expires` = '".validate_input($expires)."' WHERE `user_id` = '".validate_input($user_id)."' LIMIT 1 ");

                mysqli_query($mysqli,"UPDATE `".$config['db']['pre']."user` SET `group_id` = '".validate_input($sub_group_id)."' WHERE `id` = '".validate_input($user_id)."' LIMIT 1 ;");

            }elseif($txn_type == 'subscr_signup')
            {
                mysqli_query($mysqli,"INSERT INTO `".$config['db']['pre']."upgrades` (`sub_id` ,`user_id` ,`upgrade_lasttime` ,`upgrade_expires`) VALUES ('".validate_input($subcription_id)."', '".validate_input($user_id)."', '".time()."','".validate_input($expires)."')") OR error(mysqli_error($mysqli));

                mysqli_query($mysqli,"UPDATE `".$config['db']['pre']."user` SET `group_id` = '".validate_input($sub_group_id)."' WHERE `id` = '".validate_input($user_id)."' LIMIT 1 ;");
            }


        }else{
            $item_featured = $info['featured'];
            $item_urgent = $info['urgent'];
            $item_highlight = $info['highlight'];

            if($item_featured == 1){
                $mysqli->query("UPDATE ". $config['db']['pre'] . "product set featured = '$item_featured' where id='".$item_pro_id."' LIMIT 1");
            }
            if($item_urgent == 1){
                $mysqli->query("UPDATE ". $config['db']['pre'] . "product set urgent = '$item_urgent' where id='".$item_pro_id."' LIMIT 1");
            }
            if($item_highlight == 1){
                $mysqli->query("UPDATE ". $config['db']['pre'] . "product set highlight = '$item_highlight' where id='".$item_pro_id."' LIMIT 1");
            }

            $query = "SELECT 1 FROM ".$config['db']['pre']."product_resubmit WHERE product_id='" . $item_pro_id . "' and user_id='" . $user_id . "' LIMIT 1";
            $query_result = mysqli_query(db_connect(), $query);
            $num_rows = mysqli_num_rows($query_result);
            if($num_rows == 1){
                if($item_featured == 1){
                    $mysqli->query("UPDATE ". $config['db']['pre'] . "product_resubmit set featured = '$item_featured' where product_id='".$item_pro_id."' LIMIT 1");
                }
                if($item_urgent == 1){
                    $mysqli->query("UPDATE ". $config['db']['pre'] . "product_resubmit set urgent = '$item_urgent' where product_id='".$item_pro_id."' LIMIT 1");
                }
                if($item_highlight == 1){
                    $mysqli->query("UPDATE ". $config['db']['pre'] . "product_resubmit set highlight = '$item_highlight' where product_id='".$item_pro_id."' LIMIT 1");
                }
            }
        }

        //Transaction status Updating "Success"
        $mysqli->query("UPDATE ". $config['db']['pre'] . "transaction set status = 'success' where id='".$transaction_id."' LIMIT 1");

        //Add Amoint in balance table
        $result2 = $mysqli->query("SELECT * FROM `".$config['db']['pre']."balance` WHERE id = '1' LIMIT 1");
        if (mysqli_num_rows($result2) > 0) {
            $info2 = mysqli_fetch_assoc($result2);
            $current_amount=$info2['current_balance'];
            $total_earning=$info2['total_earning'];

            $updated_amount=($item_amount+$current_amount);
            $total_earning=($item_amount+$total_earning);

            $mysqli->query("UPDATE ". $config['db']['pre'] . "balance set current_balance = '" . $updated_amount . "', total_earning = '" . $total_earning . "' where id='1' LIMIT 1");
        }
        return true;
    }
    else{
        return false;
    }
}

function validStrLen($str, $min, $max){

    global $config;
    $con = db_connect();
    $len = strlen($str);
    if($len < $min){
        return "Username is too short, minimum is $min characters ($max max)";
    }
    elseif($len > $max){
        return "Username is too long, maximum is $max characters ($min min).";
    }
    elseif(!preg_match("/^[a-zA-Z0-9]+$/", $str))
    {
        return "Only use numbers and letters please";
    }
    else{
        //get the username
        $username = mysqli_real_escape_string($con, $_POST['username']);

        //mysql query to select field username if it's equal to the username that we check '
        $result = mysqli_query($con, "select username from `".$config['db']['pre']."userdata` where username = '".$username."'");

        //if number of rows fields is bigger them 0 that means it's NOT available '
        if(mysqli_num_rows($result)>0){
            //and we send 0 to the ajax request
            return "Error: Username not available";
        }
    }
    return TRUE;
}
?>