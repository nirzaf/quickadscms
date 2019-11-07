<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
$mysqli = db_connect();
$currency = $config['currency_code'];

if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {
    if(!checkloggedin()){
        header("Location: ".$link['LOGIN']);
        exit();
    }else{

        $title = $_SESSION['quickad'][$access_token]['name'];
        $amount = $_SESSION['quickad'][$access_token]['amount'];
        $folder = $_SESSION['quickad'][$access_token]['folder'];
        $payment_type = $_SESSION['quickad'][$access_token]['payment_type'];
        $user_id = $_SESSION['user']['id'];

        if($payment_type == "subscr") {
            $trans_desc = $title;
            $subcription_id = $_SESSION['quickad'][$access_token]['sub_id'];
            $query = "INSERT INTO " . $config['db']['pre'] . "transaction set
                product_name = '".validate_input($title)."',
                product_id = '$subcription_id',
                seller_id = '" . $_SESSION['user']['id'] . "',
                status = 'pending',
                amount = '$amount',
                transaction_gatway = '".validate_input($folder)."',
                transaction_ip = '" . encode_ip($_SERVER, $_ENV) . "',
                transaction_time = '" . time() . "',
                transaction_description = '".validate_input($trans_desc)."',
                transaction_method = 'Subscription'
                ";
        }else{
            $item_pro_id = $_SESSION['quickad'][$access_token]['product_id'];
            $item_featured = $_SESSION['quickad'][$access_token]['featured'];
            $item_urgent = $_SESSION['quickad'][$access_token]['urgent'];
            $item_highlight = $_SESSION['quickad'][$access_token]['highlight'];
            $trans_desc = $_SESSION['quickad'][$access_token]['trans_desc'];

            $query = "INSERT INTO " . $config['db']['pre'] . "transaction set
                    product_name = '".validate_input($title)."',
                    product_id = '$item_pro_id',
                    seller_id = '" . $user_id . "',
                    status = 'pending',
                    amount = '$amount',
                    featured = '$item_featured',
                    urgent = '$item_urgent',
                    highlight = '$item_highlight',
                    transaction_gatway = '".validate_input($folder)."',
                    transaction_ip = '" . encode_ip($_SERVER, $_ENV) . "',
                    transaction_time = '" . time() . "',
                    transaction_description = '".validate_input($trans_desc)."',
                    transaction_method = 'Premium Ad'
                    ";
        }


        $mysqli->query($query) OR error(mysqli_error($mysqli));

        $transaction_id = $mysqli->insert_id;



        // assign posted variables to local variables
        $bank_information = nl2br(get_option('company_bank_info'));
        $item_name = $trans_desc;
        unset($_SESSION['quickad'][$access_token]);
        $page = new HtmlTemplate ("includes/payments/wire_transfer/pay.tpl");
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['PAYMENT']));
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->SetParameter ('BANK_INFO', $bank_information);
        $page->SetParameter ('TRANSACTION_ID', $transaction_id);
        $page->SetParameter ('ORDER_TITLE', $item_name);
        $page->SetParameter ('AMOUNT', $amount);
        $page->CreatePageEcho();

    }
}else{
    exit('Invalid Process');
    headerRedirect($link['LOGIN']);
}
?>