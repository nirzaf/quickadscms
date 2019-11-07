<?php
$error_message = '';

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




if (isset($_REQUEST['token']) && isset($_REQUEST['PayerID'])) {
    $access_token = $_GET['id'];
    $token = $_REQUEST['token'];
    $data = array('TOKEN' => $token);
    // Send the request to PayPal.
    $response = sendNvpRequest('GetExpressCheckoutDetails', $data,$config);

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
} else {
    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
    exit();
}
?>