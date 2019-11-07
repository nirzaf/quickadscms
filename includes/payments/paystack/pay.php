<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!checkloggedin()){
    header("Location: ".$link['LOGIN']);
    exit();
}

if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {
    $currency = $config['currency_code'];
    $title = $_SESSION['quickad'][$access_token]['name'];
    $amount = $_SESSION['quickad'][$access_token]['amount'];

    $_SESSION['quickad'][$access_token]['merchantOrderId'] = $access_token;

    $reference = $_POST['paystackReference'];
    $paystack_secret_key = get_option('paystack_secret_key');

    $result = array();
    //The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/'.$reference;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$paystack_secret_key]
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $request = curl_exec($ch);
    curl_close($ch);

    if ($request) {
        $result = json_decode($request, true);
        if($result){
            if($result['data']){
                //something came in
                if($result['data']['status'] == 'success'){
                    // the transaction was successful, you can deliver value
                    /*
                    @ also remember that if this was a card transaction, you can store the
                    @ card authorization to enable you charge the customer subsequently.
                    @ The card authorization is in:
                    @ $result['data']['authorization']['authorization_code'];
                    @ PS: Store the authorization with this email address used for this transaction.
                    @ The authorization will only work with this particular email.
                    @ If the user changes his email on your system, it will be unusable
                    */
                    //echo "Transaction was successful";

                    payment_success_save_detail($access_token);

                }else{
                    // the transaction was not successful, do not deliver value'
                    // print_r($result);  //uncomment this line to inspect the result, to check why it failed.

                    payment_fail_save_detail($access_token);
                    mail($config['admin_email'],'Paystack error in '.$config['site_title'],'Paystack error in '.$config['site_title'].', status from Paystack');

                    $error_msg = "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
                    payment_error("error",$error_msg,$access_token);
                    exit();
                }
            }else{
                $error_msg = $result['message'];
                payment_error("error",$error_msg,$access_token);
                exit();
            }

        }else{
            //print_r($result);
            $error_msg = "Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.";
            payment_error("error",$error_msg,$access_token);
            exit();
        }
    }else{
        //var_dump($request);
        $error_msg = "Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok";

        payment_error("error",$error_msg,$access_token);
        exit();
    }
}
else {
    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
    exit();
}

?>


<?php





?>