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

        /*SEND FEEDBACK EMAIL TO ADMIN*/
        email_template("feedback");

        message($lang['THANKS'],$lang['FEEDBACKTHANKS']);
    }
}


$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/feedback.tpl');
$page->SetParameter ('OVERALL_HEADER', create_header($lang['FEEDBACK']));
$page->SetParameter ('OVERALL_FOOTER', create_footer());
$page->SetParameter('RECAPTCH_ERROR', $recaptcha_error);
$page->CreatePageEcho();
?>