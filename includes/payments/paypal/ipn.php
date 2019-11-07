<?php
namespace Listener;
require('renew.php');
use PaypalIPN;
$ipn = new PaypalIPN();

// Use the sandbox endpoint during testing.
$ipn->useSandbox();
$verified = $ipn->verifyIPN();

if ($verified) {
    $data_text = "";
    foreach ($_POST as $key => $value) {
        $data_text .= $key . " = " . $value . "\r\n";
    }
    $test_text = "";
    if ($_POST["payment_status"] == "Completed") {
        $paypal_payer_id = $_POST['payer_id'];
        $txn_id = $_POST['txn_id'];
        $amount = $_POST['mc_gross'];

        $num_rows = ORM::for_table($config['db']['pre'].'upgrades')
            ->where('paypal_profile_id', $paypal_payer_id)
            ->where_raw('DATE(`date_created`) != CURDATE()')
            ->count();
        if($num_rows){
            $info = ORM::for_table($config['db']['pre'].'upgrades')
                ->where('paypal_profile_id', $paypal_payer_id)
                ->find_one();

            $upgrade_id = $info['upgrade_id'];
            $subcription_id = $info['sub_id'];
            $paypal_payer_id = $info['paypal_profile_id'];
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
                $folder = "paypal";
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
            echo "$paypal_payer_id Not exist";
        }
    }


    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */
}
// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");