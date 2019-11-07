<?php
require_once("includes/lib/curl/curl.php");
require_once("includes/lib/curl/CurlResponse.php");

if(!checkloggedin())
{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    exit();
}

if(isset($_GET['i']) && trim($_GET['i']) == '')
{
    error($lang['INVALID_PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
    exit();
}

if(isset($_GET['i']) && isset($_GET['access_token']))
{
    $access_token = $_GET['access_token'];
    if(isset($_SESSION['quickad'][$access_token])){
        $payment_settings = ORM::for_table($config['db']['pre'].'payments')
            ->select('payment_folder')
            ->where('payment_folder', $_GET['i'])
            ->find_one();

        if(!isset($payment_settings['payment_folder']))
        {
            error($lang['NOT_FOUND_PAYMENT'], __LINE__, __FILE__, 1);
            exit();
        }
        require_once('includes/payments/'.$payment_settings['payment_folder'].'/pay.php');
    }
}

if(isset($_GET['status']) && $_GET['status'] == 'cancel') {

    $access_token = isset($_GET['access_token']) ? $_GET['access_token'] : 0;

    if($access_token){
        payment_fail_save_detail($access_token);

        $error_msg = "Payment has been cancelled.";

        payment_error("cancel",$error_msg,$access_token);
    }else{
        error($lang['INVALID_PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
        exit();
    }
}
if(isset($_POST['payment_method_id']))
{
    $access_token = $_POST['token'];
    $payment_type = $_SESSION['quickad'][$access_token]['payment_type'];
    $_SESSION['quickad'][$access_token]['payment_mode'] = "one-time";
    $_SESSION['quickad'][$access_token]['plan_interval'] = "day";

    if (isset($payment_type)) {
        $info = ORM::for_table($config['db']['pre'].'payments')
            ->where(array(
                'payment_id' => $_POST['payment_method_id'],
                'payment_install' => '1'
            ))
            ->find_one();

        $folder = $info['payment_folder'];

        $_SESSION['quickad'][$access_token]['folder'] = $folder;

        if($folder == "2checkout"){
            $_SESSION['quickad'][$access_token]['firstname'] = $_POST['checkoutCardFirstName'];
            $_SESSION['quickad'][$access_token]['lastname'] = $_POST['checkoutCardLastName'];
            $_SESSION['quickad'][$access_token]['BillingAddress'] = $_POST['checkoutBillingAddress'];
            $_SESSION['quickad'][$access_token]['BillingCity'] = $_POST['checkoutBillingCity'];
            $_SESSION['quickad'][$access_token]['BillingState'] = $_POST['checkoutBillingState'];
            $_SESSION['quickad'][$access_token]['BillingZipcode'] = $_POST['checkoutBillingZipcode'];
            $_SESSION['quickad'][$access_token]['BillingCountry'] = $_POST['checkoutBillingCountry'];
        }

        require_once('includes/payments/' . $folder . '/pay.php');
    }else{

        error($lang['INVALID_PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
        exit();
    }
}
else if(isset($_GET['token'])) {
    $access_token = $_GET['token'];
    if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {
        $_SESSION['quickad'][$access_token]['name'];
        $_SESSION['quickad'][$access_token]['payment_type'];
        $payment_types = array();

        $rows = ORM::for_table($config['db']['pre'].'payments')
            ->where('payment_install', '1')
            ->find_many();
        foreach ($rows as $info)
        {
            $payment_types[$info['payment_id']]['id'] = $info['payment_id'];
            $payment_types[$info['payment_id']]['title'] = $info['payment_title'];
            $payment_types[$info['payment_id']]['folder'] = $info['payment_folder'];
            $payment_types[$info['payment_id']]['desc'] = $info['payment_desc'];
        }

        $product_id = $_SESSION['quickad'][$access_token]['product_id'];
        $amount = $_SESSION['quickad'][$access_token]['amount'];
        $title = $_SESSION['quickad'][$access_token]['name'];
        $trans_desc = $_SESSION['quickad'][$access_token]['trans_desc'];
        $payment_type = $_SESSION['quickad'][$access_token]['payment_type'];
        // assign posted variables to local variables
        $bank_information = nl2br(get_option('company_bank_info'));
        $userdata = get_user_data($_SESSION['user']['username']);
        $email = $userdata['email'];

        $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/payment.tpl');
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADES']));
        $page->SetLoop ('PAYMENT_TYPES', $payment_types);
        $page->SetParameter ('BANK_INFO', $bank_information);
        $page->SetParameter ('ORDER_TITLE', $title);
        $page->SetParameter ('ORDER_DESC', $trans_desc);
        $page->SetParameter ('PAYMENT_TYPE', $payment_type);
        $page->SetParameter ('AMOUNT', $amount);
        $page->SetParameter ('TOKEN', $access_token);
        $page->SetParameter ('EMAIL', $email);
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();
    }
    else{
        error($lang['INVALID_PAYMENT_PROCESS'], __LINE__, __FILE__, 1);
        exit();
    }
}
else
{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    exit();
}

?>
