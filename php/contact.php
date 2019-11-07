<?php
$recaptcha_error = '';
if(isset($_POST['Submit']))
{
    if($config['recaptcha_mode'] == 1){
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            //your site secret key
            $secret = $config['recaptcha_private_key'];
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $recaptcha_responce = true;
            }else{
                $recaptcha_responce = false;
                $recaptcha_error = $lang['RECAPTCHA_ERROR'];
            }
        }else{
            $recaptcha_responce = false;
            $recaptcha_error = $lang['RECAPTCHA_CLICK'];
        }
    }else{
        $recaptcha_responce = true;
    }

    if($recaptcha_responce){

        /*SEND REPORT EMAIL TO ADMIN*/
        email_template("contact");

        message($lang['THANKS'],$lang['CONTACTTHANKS']);
    }

}


// Output to template
$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/contact.tpl');
$page->SetParameter ('OVERALL_HEADER', create_header($lang['CONTACT_US']));

$page->SetParameter('PHONE', get_option("contact_phone"));
$page->SetParameter('ADDRESS', get_option("contact_address"));
$page->SetParameter('EMAIL', get_option("contact_email"));
$page->SetParameter('LATITUDE', get_option("contact_latitude"));
$page->SetParameter('LONGITUDE', get_option("contact_longitude"));
$page->SetParameter('MAP_COLOR', get_option("map_color"));
$page->SetParameter('RECAPTCH_ERROR', $recaptcha_error);
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->CreatePageEcho();

?>