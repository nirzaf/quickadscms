<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!checkloggedin($config)){
    header("Location: ".$link['LOGIN']);
    exit();
}

$currency = $config['currency_code'];

if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {

    $data = array(
        'SOLUTIONTYPE' => 'Sole',
        'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
        'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,
        'NOSHIPPING' => 1,
        'RETURNURL' => $link['IPN']."/paypal/".$access_token,
        'CANCELURL' => $link['PAYMENT']."/".$access_token."/cancel"
    );

    $total = $_SESSION['quickad'][$access_token]['amount'];

    $data['L_PAYMENTREQUEST_0_NAME0'] = $_SESSION['quickad'][$access_token]['name'];
    $data['L_PAYMENTREQUEST_0_AMT0'] = $total;
    $data['L_PAYMENTREQUEST_0_QTY0'] = 1;
    $data['PAYMENTREQUEST_0_AMT'] = $total;
    $data['PAYMENTREQUEST_0_ITEMAMT'] = $total;

    $response = sendNvpRequest('SetExpressCheckout', $data,$config);

    // Respond according to message we receive from PayPal
    $ack = strtoupper($response['ACK']);
    if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
        // Redirect to PayPal.
        $paypal_url = sprintf(
            'https://www%s.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=%s',
            (get_option($config,'paypal_sandbox_mode') == 'Yes')?
                '.sandbox':
                '' ,
            urlencode($response['TOKEN'])
        );
        header('Location: ' . $paypal_url);
    } else {
        payment_fail_save_detail($access_token);

        $error = isset($response['L_SHORTMESSAGE0']) ? $response['L_SHORTMESSAGE0'] : 0;
        $error_msg = isset($response['L_LONGMESSAGE0']) ? $response['L_LONGMESSAGE0'] : 0;
        $error = create_slug($error);
        $error_msg = create_slug($error_msg);
        header('Location: '.$link['PAYMENT']."/".$access_token."/error/".$error_msg );
    }

    exit;
}

function sendNvpRequest($method, array $data,$config)
{
    $sandbox_url = 'https://api-3t.sandbox.paypal.com/nvp';
    $url = 'https://api-3t.paypal.com/nvp';
    $url = (get_option($config,'paypal_sandbox_mode') == 'Yes') ?
        $sandbox_url :
        $url;

    $curl = new Curl();
    $curl->options['CURLOPT_SSL_VERIFYPEER'] = false;
    $curl->options['CURLOPT_SSL_VERIFYHOST'] = false;

    $paypal_api_username = get_option($config,'paypal_api_username');
    $paypal_api_password = get_option($config,'paypal_api_password');
    $paypal_api_signature = get_option($config,'paypal_api_signature');

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