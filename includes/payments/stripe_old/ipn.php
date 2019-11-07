<?php

echo $_POST['ccData'];
exit();
if(!isset($_POST['action']))
{
    $response = array('success'=>false,'message'=>$lang['INVALID_PAYMENT_PROCESS']);
    echo json_encode($response);
    exit();
}else{
    if($_POST['action'] == "callSuccess")
    {
        quickad_stripe_payment($config,$mysqli,$lang,$link);
    }else{
        $response = array('success'=>false,'message'=>$lang['INVALID_PAYMENT_PROCESS']);
        echo json_encode($response);
        exit();
    }
}


function quickad_stripe_payment($config,$mysqli,$lang,$link) {
    $pmt_stripe_secret_key = get_option($config,'stripe_secret_key');
    $zero_decimal = array( 'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'VND', 'VUV', 'XAF', 'XOF', 'XPF', );

    try {
        include_once 'init.php';
        \Stripe\Stripe::setApiKey( $pmt_stripe_secret_key);
        \Stripe\Stripe::setApiVersion( '2015-08-19' );

        $result = $mysqli->query("SELECT * FROM `".$config['db']['pre']."transaction` WHERE `id` = '" . $_POST['trans_id'] . "' LIMIT 1");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $info = mysqli_fetch_assoc($result);
            $item_amount = $info['amount'];
            $trans_desc = $info['transaction_description'];
        }else{
            $response = array('success'=>false,'message'=>$lang['INVALID_PAYMENT_PROCESS']);
            echo json_encode($response);
            exit();
        }

        $total_price = $item_amount;
        $quickad_currency = $config['currency_code'];
        if ( in_array( $quickad_currency, $zero_decimal ) ) {
            // Zero-decimal currency
            $stripe_price = $total_price;
        } else {
            $stripe_price = $total_price * 100; // amount in cents
        }

        $charge = Stripe\Charge::create( array(
            'amount'      => (int) $stripe_price,
            'currency'    => $quickad_currency,
            'source'      => $_POST['ccData'], // contain card data
            'description' => $trans_desc
        ) );
        if ( $charge->paid ) {

            $result = $mysqli->query("SELECT * FROM `".$config['db']['pre']."transaction` WHERE `id` = '" . $_POST['trans_id'] . "' LIMIT 1");
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $info = mysqli_fetch_assoc($result);

                $item_pro_id = $info['product_id'];
                $item_amount = $info['amount'];
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

                $mysqli->query("UPDATE ". $config['db']['pre'] . "transaction set status = 'success' where id='".$_POST['trans_id']."' LIMIT 1");



                if(check_valid_resubmission($config,$item_pro_id)){
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

                $result2 = $mysqli->query("SELECT * FROM `".$config['db']['pre']."balance` WHERE id = '1' LIMIT 1");
                if (mysqli_num_rows($result2) > 0) {
                    $info2 = mysqli_fetch_assoc($result2);
                    $current_amount=$info2['current_balance'];
                    $total_earning=$info2['total_earning'];

                    $updated_amount=($item_amount+$current_amount);
                    $total_earning=($item_amount+$total_earning);

                    $mysqli->query("UPDATE ". $config['db']['pre'] . "balance set current_balance = '" . $updated_amount . "', total_earning = '" . $total_earning . "' where id='1' LIMIT 1");
                }
                $item_link = $config['site_url']."ad/".$item_pro_id;
                $response = array('success'=>true,'message'=>$lang['PAYMENTSUCCESS'],'redirect'=>$item_link);
                echo json_encode($response);
                exit;
            }
            else{
                $response = array('success'=>false,'message'=>$lang['INVALID_TRANSACTION']);
                echo json_encode($response);
                exit();
            }

        } else {
            $mysqli->query("UPDATE ". $config['db']['pre'] . "transaction set status = 'failed' where id='".$_POST['trans_id']."' LIMIT 1");
            mail($config['admin_email'],'Stripe error in '.$config['site_title'],'Stripe error in '.$config['site_title'].', status from Stripe');
            $response = array('success'=>false,'message'=>$lang['INVALID_TRANSACTION']);
            echo json_encode($response);
            exit();
        }
    } catch (Exception $e ) {
        echo $e->getMessage();
    }
}

?>