<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!checkloggedin()){
    header("Location: ".$link['LOGIN']);
    exit();
}

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');


// manually set action for paypal payments
if (empty($action) && isset($_REQUEST['token']) && isset($_REQUEST['PayerID'])) {
    $action = 'paypal_ipn';
}
else if ( empty($action) ) {
    $action = 'paypal_payment';
}

$currency = $config['currency_code'];

if(isset($access_token)){
    $total = $_SESSION['quickad'][$access_token]['amount'];
    $plan_interval = ucfirst($_SESSION['quickad'][$access_token]['plan_interval']);
    $payment_mode = $_SESSION['quickad'][$access_token]['payment_mode'];
}

$plan_interval_count = 1;
$enable_trial = 0;
$trial_days = 7;

if ( !empty($action) ) {

    switch ($action) {

/***********************************************************************************************************************/
        case 'renew':
            try{

                message($lang['SUCCESS'],$lang['MEMEBERSHIP_CANCEL'],$link['MEMBERSHIP']);
                exit();
            }
            catch (Exception $e) {
                $status = false;
                $message = $e->getMessage();
            }
            break;
        case 'paypal_payment':
            try{
                if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {

                    if ( $payment_mode == 'recurring' ) {
                        $data = array(
                            'SOLUTIONTYPE' => 'Sole',
                            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
                            'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,
                            'NOSHIPPING' => 1,

                            'L_PAYMENTREQUEST_0_NAME0' => $_SESSION['quickad'][$access_token]['name'],
                            'L_PAYMENTREQUEST_0_DESC0' => $_SESSION['quickad'][$access_token]['name'],
                            'L_PAYMENTREQUEST_0_QTY0' => 1,
                            'L_PAYMENTREQUEST_0_AMT0' => $total,
                            'PAYMENTREQUEST_0_AMT' => $total,
                            'PAYMENTREQUEST_0_ITEMAMT' => $total,

                            'L_BILLINGTYPE0' => 'RecurringPayments',
                            'L_BILLINGAGREEMENTDESCRIPTION0' => $_SESSION['quickad'][$access_token]['name'],

                            'CANCELURL' => $link['PAYMENT']."/?access_token=".$access_token."&status=cancel",
                            'RETURNURL' => $link['PAYMENT']."/?access_token=".$access_token."&i=paypal",
                        );
                    }else{
                        $data = array(
                            'SOLUTIONTYPE' => 'Sole',
                            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
                            'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,
                            'NOSHIPPING' => 1,

                            'L_PAYMENTREQUEST_0_NAME0' => $_SESSION['quickad'][$access_token]['name'],
                            'L_PAYMENTREQUEST_0_QTY0' => 1,
                            'L_PAYMENTREQUEST_0_AMT0' => $total,
                            'PAYMENTREQUEST_0_AMT' => $total,
                            'PAYMENTREQUEST_0_ITEMAMT' => $total,

                            'CANCELURL' => $link['PAYMENT']."/?access_token=".$access_token."&status=cancel",
                            'RETURNURL' => $link['PAYMENT']."/?access_token=".$access_token."&i=paypal",
                        );
                    }


                    $response = sendNvpRequest('SetExpressCheckout', $data,$config);

                    // Respond according to message we receive from PayPal
                    $ack = strtoupper($response['ACK']);

                    if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
                        // Redirect to PayPal.
                        $paypal_url = sprintf(
                            'https://www%s.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=%s',
                            (get_option('paypal_sandbox_mode') == 'Yes')?
                                '.sandbox':
                                '' ,
                            urlencode($response['TOKEN'])
                        );
                        header('Location: ' . $paypal_url);
                    } else {
                        payment_fail_save_detail($access_token);

                        $error = isset($response['L_SHORTMESSAGE0']) ? $response['L_SHORTMESSAGE0'] : 0;
                        $error_msg = isset($response['L_LONGMESSAGE0']) ? $response['L_LONGMESSAGE0'] : 0;
                        payment_error("error",$error_msg,$access_token);
                    }

                    exit;
                }
                else {
                    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
                    exit();
                }
            }
            catch (Exception $e) {
                $status = false;
                $message = $e->getMessage();
            }
            break;

/***********************************************************************************************************************/

        case 'cancel_auto_renew':
            try{
                $data = array(
                    'PROFILEID' => $subscription->paypal_profile_id,
                    'ACTION' => 'Cancel'
                );
                $response = sendNvpRequest('ManageRecurringPaymentsProfileStatus', $data,$config);
                print_r($response);

                $paypal_payer_id = $response['payer_id'];

                $num_rows = ORM::for_table($config['db']['pre'].'upgrades')
                    ->where('paypal_profile_id', $paypal_payer_id)
                    ->count();
                if($num_rows){
                    $info = ORM::for_table($config['db']['pre'].'upgrades')
                        ->where('paypal_profile_id', $paypal_payer_id)
                        ->find_one();

                    $upgrade_id = $info['upgrade_id'];

                    $pdo = ORM::get_db();
                    $query = "UPDATE `".$config['db']['pre']."upgrades` SET `status` = 'Canceled' WHERE `upgrade_id` = '".validate_input($upgrade_id)."' LIMIT 1 ";
                    $pdo->query($query);
                }

                message($lang['SUCCESS'],$lang['MEMEBERSHIP_CANCEL'],$link['MEMBERSHIP']);
                exit();
            }
            catch (Exception $e) {
                $status = false;
                $message = $e->getMessage();
            }
            break;

/***********************************************************************************************************************/

        case 'paypal_ipn':
            try{

                if (isset($_REQUEST['token']) && isset($_REQUEST['PayerID'])) {

                    $token = $_REQUEST['token'];
                    $PayerID = $_REQUEST['PayerID'];
                    $now = time();

                    if ( $payment_mode == 'recurring' ) {

                        $pdo = ORM::get_db();
                        $title = $_SESSION['quickad'][$access_token]['name'];
                        $amount = $_SESSION['quickad'][$access_token]['amount'];
                        $folder = $_SESSION['quickad'][$access_token]['folder'];
                        $payment_type = $_SESSION['quickad'][$access_token]['payment_type'];
                        $user_id = $_SESSION['user']['id'];
                        $now = time();

                        if($payment_type == "subscr"){
                            $trans_desc = $title;
                            $subcription_id = $_SESSION['quickad'][$access_token]['sub_id'];

                            // Check that the payment is valid
                            $subsc_details = ORM::for_table($config['db']['pre'].'subscriptions')
                                ->where('sub_id', $subcription_id)
                                ->find_one();
                            if(!empty($subsc_details)){
                                // output data of each row

                                $term = 0;
                                if($subsc_details['sub_term'] == 'DAILY') {
                                    $term = 86400;
                                }
                                elseif($subsc_details['sub_term'] == 'WEEKLY') {
                                    $term = 604800;
                                }
                                elseif($subsc_details['sub_term'] == 'MONTHLY') {
                                    $term = 2678400;
                                }
                                elseif($subsc_details['sub_term'] == 'YEARLY') {
                                    $term = 31536000;
                                }

                                $sub_group_id = $subsc_details['group_id'];
                                $sub_amount = $subsc_details['sub_amount'];

                                $subsc_check = ORM::for_table($config['db']['pre'].'upgrades')
                                    ->where(array(
                                        'user_id' => $user_id,
                                        'status' => 'Active'
                                    ))
                                    ->count();

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
                                    $info = ORM::for_table($config['db']['pre'].'upgrades')
                                        ->select('paypal_profile_id')
                                        ->where('user_id', $user_id)
                                        ->find_one();

                                    $id = $info['paypal_profile_id'];
                                    // Update Subscription

                                    $data = array(
                                        'PROFILEID' => $id,
                                        'AMT' => $total,
                                        'NOTE' => $_SESSION['quickad'][$access_token]['name']
                                    );

                                    $response = sendNvpRequest('UpdateRecurringPaymentsProfile', $data,$config);

                                    $subscription_billing_day = "";
                                    $subscription_date_trial_ends = $enable_trial ? date('Y-m-d', strtotime('+' . $trial_days . ' days')) : null;


                                    $query = "UPDATE `".$config['db']['pre']."upgrades` SET
                                    `sub_id` = '".validate_input($subcription_id)."',
                                    `upgrade_expires` = '".validate_input($expires)."'
                                    WHERE `user_id` = '".validate_input($user_id)."' LIMIT 1 ";
                                    $pdo->query($query);

                                    $person = ORM::for_table($config['db']['pre'].'user')->find_one($user_id);
                                    $person->group_id = $sub_group_id;
                                    $person->save();

                                }
                                elseif($txn_type == 'subscr_signup')
                                {
                                    $data = array(
                                        'TOKEN' => $token,
                                        'PayerID' => $PayerID,
                                        'PROFILESTARTDATE' => $now,

                                        'DESC' => $_SESSION['quickad'][$access_token]['name'],
                                        'BILLINGPERIOD' => $plan_interval,
                                        'BILLINGFREQUENCY' => '1',
                                        'AMT' => $total,

                                        'L_PAYMENTREQUEST_0_NAME0' => $_SESSION['quickad'][$access_token]['name'],
                                        'L_PAYMENTREQUEST_0_QTY0' => 1,
                                        'L_PAYMENTREQUEST_0_AMT0' => $total
                                    );

                                    $response = sendNvpRequest('CreateRecurringPaymentsProfile', $data,$config);

                                    $paypal_profile_id = $response['PROFILEID'];
                                    $subscription_status = 'Active';
                                    $subscription_trial_days =  $enable_trial ? $trial_days : null;
                                    $subscription_date_trial_ends = $enable_trial ? date('Y-m-d', strtotime('+' . $trial_days . ' days')) : null;


                                    ORM::for_table($config['db']['pre'].'upgrades')
                                        ->where_equal('user_id', $user_id)
                                        ->delete_many();

                                    $upgrades_insert = ORM::for_table($config['db']['pre'].'upgrades')->create();
                                    $upgrades_insert->sub_id = $subcription_id;
                                    $upgrades_insert->user_id = $user_id;
                                    $upgrades_insert->upgrade_lasttime = $now;
                                    $upgrades_insert->upgrade_expires = $expires;
                                    $upgrades_insert->paypal_profile_id = $paypal_profile_id;
                                    $upgrades_insert->trial_days = $subscription_trial_days;
                                    $upgrades_insert->status = $subscription_status;
                                    $upgrades_insert->date_trial_ends = $subscription_date_trial_ends;
                                    $upgrades_insert->save();

                                    $person = ORM::for_table($config['db']['pre'].'user')->find_one($user_id);
                                    $person->group_id = $sub_group_id;
                                    $person->save();
                                }

                                //Update Amount in balance table
                                $balance = ORM::for_table($config['db']['pre'].'balance')->find_one(1);
                                $current_amount=$balance['current_balance'];
                                $total_earning=$balance['total_earning'];

                                $updated_amount=($sub_amount+$current_amount);
                                $total_earning=($sub_amount+$total_earning);

                                $balance->current_balance = $updated_amount;
                                $balance->total_earning = $total_earning;
                                $balance->save();

                                $ip = encode_ip($_SERVER, $_ENV);
                                $trans_insert = ORM::for_table($config['db']['pre'].'transaction')->create();
                                $trans_insert->product_name = $title;
                                $trans_insert->product_id = $subcription_id;
                                $trans_insert->seller_id = $user_id;
                                $trans_insert->status = 'success';
                                $trans_insert->amount = $amount;
                                $trans_insert->transaction_gatway = $folder;
                                $trans_insert->transaction_ip = $ip;
                                $trans_insert->transaction_time = $now;
                                $trans_insert->transaction_description = $trans_desc;
                                $trans_insert->transaction_method = 'Subscription';
                                $trans_insert->save();

                                renew_item_by_userid($user_id);
                                
                                unset($_SESSION['quickad'][$access_token]);
                                message($lang['SUCCESS'],$lang['PAYMENTSUCCESS'],$link['TRANSACTION']);
                                exit();
                            }
                            else{
                                unset($_SESSION['quickad'][$access_token]);
                                error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1,$lang,$config,$link);
                                exit();
                            }
                        }
                    }


                    // Send the request to PayPal.
                    $response = sendNvpRequest('GetExpressCheckoutDetails', array('TOKEN' => $token) ,$config);

                    if (strtoupper($response['ACK']) == 'SUCCESS') {
                        $data['PAYERID'] = $_REQUEST['PayerID'];
                        $data['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';

                        foreach (array('PAYMENTREQUEST_0_AMT', 'PAYMENTREQUEST_0_ITEMAMT', 'PAYMENTREQUEST_0_CURRENCYCODE', 'L_PAYMENTREQUEST_0') as $parameter) {
                            if (array_key_exists($parameter, $response)) {
                                $data[$parameter] = $response[$parameter];
                            }
                        }

                        /*Success*/
                        payment_success_save_detail($access_token);
                    }
                }else {
                    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
                    exit();
                }

            }
            catch (Exception $e) {
                $status = false;
                $message = $e->getMessage();
            }
            break;

    }
}


function sendNvpRequest($method, array $data,$config)
{
    $sandbox_url = 'https://api-3t.sandbox.paypal.com/nvp';
    $url = 'https://api-3t.paypal.com/nvp';
    $url = (get_option('paypal_sandbox_mode') == 'Yes') ?
        $sandbox_url :
        $url;

    $curl = new Curl();
    $curl->options['CURLOPT_SSL_VERIFYPEER'] = false;
    $curl->options['CURLOPT_SSL_VERIFYHOST'] = false;

    $paypal_api_username = get_option('paypal_api_username');
    $paypal_api_password = get_option('paypal_api_password');
    $paypal_api_signature = get_option('paypal_api_signature');

    $data['METHOD'] = $method;
    $data['VERSION'] = '76.0';
    $data['USER'] = $paypal_api_username;
    $data['PWD'] = $paypal_api_password;
    $data['SIGNATURE'] = $paypal_api_signature;

    $httpResponse = $curl->post($url, $data);
    if (!$httpResponse) {
        exit($curl->error());
    }

    // Extract the response details.
    parse_str($httpResponse, $PayPalResponse);

    if (!array_key_exists('ACK', $PayPalResponse)) {
        exit('Invalid HTTP Response for POST request to ' . $url);
    }

    return $PayPalResponse;
}


?>
<style type="text/css">
    .style1 {  font-size: 14px;  font-family: Verdana, Arial, Helvetica, sans-serif;  }
</style>
<body>
<div align="center" class="style1">Transfering you to the Paypal.com Secure payment system</div>
</body>