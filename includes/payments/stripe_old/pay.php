<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if(!checkloggedin($config)){
    header("Location: ".$link['LOGIN']);
    exit();
}

if (isset($_SESSION['quickad'][$access_token]['payment_type'])) {
    $title = $_SESSION['quickad'][$access_token]['name'];
    $amount = $_SESSION['quickad'][$access_token]['amount'];
    $pmt_stripe_secret_key = get_option($config,'stripe_secret_key');
    $zero_decimal = array( 'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'VND', 'VUV', 'XAF', 'XOF', 'XPF', );

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

        $charge = Stripe\Charge::create( array(
            'amount'      => (int) $stripe_price,
            'currency'    => $quickad_currency,
            'source'      => $cdata, // contain card data
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
    } catch (Exception $e ) {
        $error = $e->getMessage();
        //$error_msg = create_slug($error);
        payment_error("error",$error,$access_token);
        exit();
    }

    exit;
}
else {
    error($lang['INVALID_TRANSACTION'], __LINE__, __FILE__, 1);
    exit();
}

?>