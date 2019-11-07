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
if(isset($access_token)){
    if (empty($action) && isset($_SESSION['quickad'][$access_token]['payment_type'])) {
        $action = 'stripe_payment_process';
    }
}

$pmt_stripe_secret_key = get_option('stripe_secret_key');

if ( !empty($action) ) {

    switch ($action) {

/***********************************************************************************************************************/

        case 'stripe_payment_process':

            // make sure we hve hte payment token first
            if ( !isset($_POST['stripeToken']) ) {
                $error_msg = $lang['INVALID_TRANSACTION'];
                payment_error("error","",$access_token);
                exit();
            }

            $stripeToken = $_POST['stripeToken'];
            $title = $_SESSION['quickad'][$access_token]['name'];
            $amount = $_SESSION['quickad'][$access_token]['amount'];
            $pmt_stripe_secret_key = get_option('stripe_secret_key');
            $zero_decimal = array( 'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'VND', 'VUV', 'XAF', 'XOF', 'XPF', );
            $plan_interval = $_SESSION['quickad'][$access_token]['plan_interval'];
            $payment_mode = $_SESSION['quickad'][$access_token]['payment_mode'];
            $plan_interval_count = 1;
            $enable_trial = 0;
            $trial_days = 7;

            try {
                include_once 'init.php';
                \Stripe\Stripe::setApiKey( $pmt_stripe_secret_key);
                \Stripe\Stripe::setApiVersion( '2015-08-19' );

                $cdata = array();
                $cdata['number'] = $_POST['stripeCardNumber'];
                $cdata['cvc'] = $_POST['stripeCardCVC'];
                $cdata['exp_month'] = $_POST['exp_month'];
                $cdata['exp_year'] = $_POST['exp_year'];

                $total_price = $amount;
                $quickad_currency = $config['currency_code'];
                if ( in_array( $quickad_currency, $zero_decimal ) ) {
                    // Zero-decimal currency
                    $stripe_price = $total_price;
                } else {
                    $stripe_price = $total_price * 100; // amount in cents
                }

                if ( $payment_mode == 'recurring' ) {

                    // grab list of all plans
                    $plans = Stripe\Plan::all();
                    // get existing plan if it fits
                    $create_plan = true;
                    $plan_id = '';
                    if ( isset($plans->data) && !empty($plans->data) ) {
                        foreach ( $plans->data as $plan ) {
                            if ( $plan->interval == $plan_interval && $plan->amount / 100 == $amount && $plan->interval_count == $plan_interval_count ) {
                                // don't match the plan if the trial values don't line up
                                if ( ($enable_trial && $plan->trial_period_days != $trial_days) || (!$enable_trial && $plan->trial_period_days) ) {
                                    continue;
                                }
                                $plan_id = $plan->id;
                                $create_plan = false;
                                break;
                            }
                        }
                    }

                    //create the plan if necessary
                    if ( $create_plan ) {
                        $plan_arr = array(
                            'amount' => (int) $stripe_price,
                            'interval_count' => $plan_interval_count,
                            'interval' => $plan_interval,
                            'name' => $title,
                            'id' => uniqid(),
                            'currency' => $quickad_currency
                        );
                        if ( $enable_trial && $trial_days > 0 ) {
                            $plan_arr['trial_period_days'] = $trial_days;
                            $plan_arr['name'] = $plan_arr['name'] . ' (' . $trial_days . ' day free trial)';
                        }
                        $plan = Stripe\Plan::create($plan_arr);
                        $plan_id = $plan->id;
                    }

                    // create the customer
                    $customer = Stripe\Customer::create(array(
                        'description' => $_SESSION['user']['username'],
                    ));



                    /*Success*/


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
                                    ->select('stripe_subscription_id')
                                    ->where('user_id', $user_id)
                                    ->find_one();

                                $id = $info['stripe_subscription_id'];
                                // Update Subscription

                                $subscription_s = \Stripe\Subscription::retrieve($id);
                                \Stripe\Subscription::update($id, [
                                    'cancel_at_period_end' => false,
                                    'items' => [
                                        [
                                            'id' => $subscription_s->items->data[0]->id,
                                            'plan' => $plan_id,
                                        ],
                                    ],
                                ]);

                                $subscription_billing_day = date('j', $subscription_s->start);;
                                $subscription_date_trial_ends = $enable_trial ? date('Y-m-d', strtotime('+' . $trial_days . ' days')) : null;


                                $query = "UPDATE `".$config['db']['pre']."upgrades` SET
                        `sub_id` = '".validate_input($subcription_id)."',
                        `upgrade_expires` = '".validate_input($expires)."' WHERE `user_id` = '".validate_input($user_id)."' LIMIT 1 ";
                                $pdo->query($query);

                                $person = ORM::for_table($config['db']['pre'].'user')->find_one($user_id);
                                $person->group_id = $sub_group_id;
                                $person->save();

                            }
                            elseif($txn_type == 'subscr_signup')
                            {
                                // create the subscription
                                $subscription_s = $customer->subscriptions->create(array(
                                    'plan' => $plan_id,
                                    'card' => $stripeToken
                                ));

                                $unique_subscription_id = uniqid();
                                $subscription_status = 'Active';
                                $subscription_stripe_customer_id = $subscription_s->customer;
                                $subscription_stripe_subscription_id = $subscription_s->id;
                                $subscription_billing_day = date('j', $subscription_s->start);
                                $subscription_length = 0;
                                $subscription_interval = $subscription_s->plan->interval_count;
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
                                $upgrades_insert->unique_id = $unique_subscription_id;
                                $upgrades_insert->stripe_customer_id = $subscription_stripe_customer_id;
                                $upgrades_insert->stripe_subscription_id = $subscription_stripe_subscription_id;
                                $upgrades_insert->billing_day = $subscription_billing_day;
                                $upgrades_insert->length = $subscription_length;
                                $upgrades_insert->interval = $subscription_interval;
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
                            error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
                            exit();
                        }
                    }

                }
                else{

                    $charge = Stripe\Charge::create( array(
                        'amount'      => (int) $stripe_price,
                        'currency'    => $quickad_currency,
                        'card' => $stripeToken,
                        'description' => $title
                    ) );

                    if ( $charge->paid ) {
                        /*Success*/
                        payment_success_save_detail($access_token);

                    }
                    else {
                        payment_fail_save_detail($access_token);
                        mail($config['admin_email'],'Stripe error in '.$config['site_title'],'Stripe error in '.$config['site_title'].', status from Stripe');

                        $error_msg = $lang['INVALID_TRANSACTION'];
                        payment_error("error","",$access_token);
                        exit();
                    }
                }


            }
            catch (Exception $e ) {
                $error = $e->getMessage();
                payment_error("error",$error,$access_token);
                exit();
            }

            exit;

/***********************************************************************************************************************/

        case 'cancel_auto_renew':
            try{
                include_once 'init.php';
                \Stripe\Stripe::setApiKey( $pmt_stripe_secret_key);
                \Stripe\Stripe::setApiVersion( '2015-08-19' );

                $customer = Stripe\Customer::retrieve($subscription->stripe_customer_id);
                $subscription_s = $customer->subscriptions->retrieve($subscription->stripe_subscription_id);
                $subscription_s->cancel();

                $subscription_stripe_customer_id = $subscription->stripe_customer_id;
                $subscription_stripe_subscription_id = $subscription->stripe_subscription_id;

                $num_rows = ORM::for_table($config['db']['pre'].'upgrades')
                    ->where('stripe_subscription_id', $subscription_stripe_subscription_id)
                    ->count();
                if($num_rows) {
                    $info = ORM::for_table($config['db']['pre'] . 'upgrades')
                        ->where('stripe_subscription_id', $subscription_stripe_subscription_id)
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
                $message = $e->getMessage();
                error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
                exit();
            }
        break;


        /***********************************************************************************************************************/

        case 'webhook':
            try{
                // Retrieve the request's body and parse it as JSON:
                $input = @file_get_contents('php://input');
                $event_json = json_decode($input);

                // Do something with $event_json
                $myfile = fopen("ipnlog.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $event_json);
                fclose($myfile);

                // Return a response to acknowledge receipt of the event
                http_response_code(200); // PHP 5.4 or greater
                exit();
            }
            catch (Exception $e) {
                $message = $e->getMessage();

                // Do something with $event_json
                $myfile = fopen("ipnlog.txt", "w") or die("Unable to open file!");
                fwrite($myfile, "error");
                fclose($myfile);

                // Return a response to acknowledge receipt of the event
                http_response_code(200); // PHP 5.4 or greater
                exit();
            }
            break;
    }
}


?>