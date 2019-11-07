<?php
$curl = curl_init();
 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
    'USER' => 'usuario_da_api',
    'PWD' => '1234123424',
    'SIGNATURE' => 'assinatura.da.api',
 
    'METHOD' => 'CreateRecurringPaymentsProfile',
    'VERSION' => '108',
    'LOCALECODE' => 'pt_BR',
 
    'TOKEN' => 'EC-0A9774676H705661Y',
    'PayerID' => '5KWXTCEDXPFQS',
 
    'PROFILESTARTDATE' => '2012-10-08T16:00:00Z',
    'DESC' => 'Exemplo',
    'BILLINGPERIOD' => 'Month',
    'BILLINGFREQUENCY' => '1',
    'AMT' => 100,
    'CURRENCYCODE' => 'BRL',
    'COUNTRYCODE' => 'BR',
    'MAXFAILEDPAYMENTS' => 3
)));
 
$response =    curl_exec($curl);
 
curl_close($curl);
 
$nvp = array();
 
if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
    foreach ($matches['name'] as $offset => $name) {
        $nvp[$name] = urldecode($matches['value'][$offset]);
    }
}
 
print_r($nvp);
