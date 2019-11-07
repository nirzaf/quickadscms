<?php
// Retrieve the request's body and parse it as JSON:
$input = file_get_contents('php://input');

$plans = json_decode($input);
// get existing plan if it fits

if ( isset($plans->data) && !empty($plans->data) ) {
    foreach ( $plans->data as $plan ) {
        //print_r($plan);

        $subscription_stripe_customer_id = $plan->customer;
        $subscription_stripe_subscription_id = $plan->subscription;
        $amount = $plan->total/100;
        if($plan->paid){
            $num_rows = ORM::for_table($config['db']['pre'].'upgrades')
                ->where('stripe_subscription_id', $subscription_stripe_subscription_id)
                ->where_raw('DATE(`date_created`) != CURDATE()')
                ->count();
            if($num_rows){
                $info = ORM::for_table($config['db']['pre'].'upgrades')
                    ->where('stripe_subscription_id', $subscription_stripe_subscription_id)
                    ->find_one();

                $upgrade_id = $info['upgrade_id'];
                $subcription_id = $info['sub_id'];
                $stripe_subscription_id = $info['stripe_subscription_id'];
                $user_id = $info['user_id'];

                // Check that the payment is valid
                $subsc_details = ORM::for_table($config['db']['pre'].'subscriptions')
                    ->select_many('sub_term','sub_amount')
                    ->where('sub_id', $subcription_id)
                    ->find_one();
                if (!empty($subsc_details)) {
                    $sub_amount = $subsc_details['sub_amount'];
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
                    // Add time to their subscription
                    $expires = (time()+$term);
                    $pdo = ORM::get_db();
                    $query = "UPDATE `".$config['db']['pre']."upgrades` SET `upgrade_expires` = '".validate_input($expires)."' WHERE `upgrade_id` = '".validate_input($upgrade_id)."' LIMIT 1 ";
                    $pdo->query($query);

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
                    $now = time();
                    $folder = "stripe";
                    $trans_desc = "Renew Membership Plan";
                    $title = $trans_desc;
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
                    echo "Success: ".$trans_desc;
                }
            }else{
                echo "$subscription_stripe_subscription_id Not exist";
            }
        }
    }
}
// Return a response to acknowledge receipt of the event
http_response_code(200); // PHP 5.4 or greater