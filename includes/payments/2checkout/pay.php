<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!checkloggedin()){
    header("Location: ".$link['LOGIN']);
    exit();
}

require_once("lib/Twocheckout.php");

$checkout_seller_id = get_option('checkout_account_number');
$checkout_private_key = get_option('checkout_private_key');

Twocheckout::privateKey($checkout_private_key); //Private Key
Twocheckout::sellerId($checkout_seller_id); // 2Checkout Account Number
Twocheckout::sandbox(true); // Set to false for production accounts.
Twocheckout::verifySSL(false);

if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {
    $currency = $config['currency_code'];
    $title = $_SESSION['quickad'][$access_token]['name'];
    $amount = $_SESSION['quickad'][$access_token]['amount'];

    $fname =$_SESSION['quickad'][$access_token]['firstname'];
    $lname = $_SESSION['quickad'][$access_token]['lastname'];
    $fullname = $fname." ".$lname;
    $address = $_SESSION['quickad'][$access_token]['BillingAddress'];
    $city = $_SESSION['quickad'][$access_token]['BillingCity'];
    $state = $_SESSION['quickad'][$access_token]['BillingState'];
    $zipcode = $_SESSION['quickad'][$access_token]['BillingZipcode'];
    $country = $_SESSION['quickad'][$access_token]['BillingCountry'];

    $userdata = get_user_data($_SESSION['user']['username']);
    $email = $userdata['email'];
    $phone = $userdata['phone'];

    $_SESSION['quickad'][$access_token]['merchantOrderId'] = $access_token;

    try {
        $charge = Twocheckout_Charge::auth(array(
            "merchantOrderId" => $title,
            "token"      => $_POST['2checkoutToken'],
            "currency" => $currency,
            "total" => $amount,
            "billingAddr" => array(
                "name" => $fullname,
                "addrLine1" => $address,
                "city" => $city,
                "state" => $state,
                "zipCode" => $zipcode,
                "country" => $country,
                "email" => $email,
                "phoneNumber" => $phone
            )
        ));


        if ($charge['response']['responseCode'] == 'APPROVED') {
            /*Success*/
            payment_success_save_detail($access_token);
        } else {
            payment_fail_save_detail($access_token);
            mail($config['admin_email'],'2Checkout error in '.$config['site_title'],'2Checkout error in '.$config['site_title'].', status from 2Checkout');

            $error_msg = $lang['INVALID_TRANSACTION'];
            payment_error("error",$error_msg,$access_token);

            exit();
        }

    } catch (Twocheckout_Error $e) {
        $error = $e->getMessage();
        $error_msg = create_slug($error);
        payment_error("error",$error_msg,$access_token);

        exit();
    }

    exit;
}
else {
    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
    exit();
}

?>