<?php
/**
 * Mailing System
 * @author Bylancer
 * @Copyright (c) 2015-18 Devendra Katariya (bylancer.com)
 */

include_once('class.phpmailer.php');
include_once('class.smtp.php');
include_once('PHPMailerAutoload.php');

$config['smtp_debug'] = false;



# SMTP***********************************
if($config['email_type'] == 'smtp'){

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->Host     = $config['smtp_host'];
    $mail->SMTPAuth = $config['smtp_auth'];
    $mail->SMTPDebug = $config['smtp_debug'];
    $mail->Debugoutput = 'html';
    $mail->SMTPKeepAlive = true;
    if($config['smtp_secure']==1){# SSL
        $mail->SMTPSecure = 'ssl';
    }else if($config['smtp_secure']==2){# TLS
        $mail->SMTPSecure = 'tls';
    }
    $mail->Username = $config['smtp_username'];
    $mail->Password = $config['smtp_password'];
    $mail->Port = $config['smtp_port'];
    $mail->Priority = 1;
    $mail->Encoding = 'base64';
    $mail->CharSet = "utf-8";
    if($config['email_template']==0){
        $mail->IsHTML(true);
        $mail->ContentType = "text/html";
    }
    else{
        $mail->ContentType = "text/plain";
    }
    $mail->SetFrom($config['admin_email'], $name = $config['site_title']);
    if($email_reply_to != null){
        $mail->AddReplyTo($email_reply_to, $email_reply_to_name);
    }

    /* Clear Mails */
    $mail->clearAddresses();
    $mail->clearCustomHeaders();
    $mail->clearAllRecipients();
    $mail->AddAddress($email_to, $email_to_name);
    $mail->Subject  =  $email_subject;
    $mail->Body = $email_body;

    /* Send Error */
    if(!$mail->Send()){
        return false;
        //echo $mail->ErrorInfo;
    }else{
        return true;
        //echo $mail->ErrorInfo;
    }
}

# PHPMail*******************************************************************************
else if($config['email_type'] == 'mail'){

    $mail = new PHPMailer(true);
    $mail->Debugoutput = 'html';
    $mail->Priority = 1;
    $mail->Encoding = 'base64';
    $mail->CharSet = "utf-8";
    if($config['email_template']==0){
        $mail->IsHTML(true);
        $mail->ContentType = "text/html";
    }else{
        $mail->IsHTML(false);
    }
    $mail->SetFrom($config['admin_email'], $name = $config['site_title']);
    if($email_reply_to != null){
        $mail->AddReplyTo($email_reply_to, $email_reply_to_name);
    }

    /* Clear Mails */
    $mail->clearAddresses();
    $mail->clearCustomHeaders();
    $mail->clearAllRecipients();
    $mail->AddAddress($email_to, $email_to_name);
    $mail->Subject  =  $email_subject;
    $mail->Body = $email_body;

    /* Send Error */
    if(!$mail->Send()){
        //echo $mail->ErrorInfo;
    }else{
        //echo $mail->ErrorInfo;
    }
}
# Amazon SES*******************************************************************************
else if($config['email_type'] == 'aws'){

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->Host     = $config['aws_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = $config['smtp_debug'];
    $mail->Debugoutput = 'html';
    $mail->SMTPKeepAlive = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $config['aws_access_key'];
    $mail->Password = $config['aws_secret_key'];
    $mail->Port = 465;

    $mail->Priority = 1;
    $mail->Encoding = 'base64';
    $mail->CharSet = "utf-8";
    if($config['email_template']==0){
        $mail->IsHTML(true);
        $mail->ContentType = "text/html";
    }
    else{
        $mail->ContentType = "text/plain";
    }
    $mail->SetFrom($config['admin_email'], $name = $config['site_title']);
    if($email_reply_to != null){
        $mail->AddReplyTo($email_reply_to, $email_reply_to_name);
    }

    /* Clear Mails */
    $mail->clearAddresses();
    $mail->clearCustomHeaders();
    $mail->clearAllRecipients();
    $mail->AddAddress($email_to, $email_to_name);
    $mail->Subject  =  $email_subject;
    $mail->Body = $email_body;

    /* Send Error */
    if(!$mail->Send()){
        //echo $mail->ErrorInfo;
    }else{
        //echo $mail->ErrorInfo;
    }

}
# # Mandrill*******************************************************************************
else if($config['email_type'] == 'mandrill'){

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->Host     = 'smtp.mandrillapp.com';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = $config['smtp_debug'];
    $mail->Debugoutput = 'html';
    $mail->SMTPKeepAlive = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $config['mandrill_user'];
    $mail->Password = $config['mandrill_key'];
    $mail->Port = 587;

    $mail->Priority = 1;
    $mail->Encoding = 'base64';
    $mail->CharSet = "utf-8";
    if($config['email_template']==0){
        $mail->IsHTML(true);
        $mail->ContentType = "text/html";
    }else{
        $mail->ContentType = "text/plain";
    }
    $mail->SetFrom($config['admin_email'], $name = $config['site_title']);
    if($email_reply_to != null){
        $mail->AddReplyTo($email_reply_to, $email_reply_to_name);
    }

    # *************************************************************************
    /* Clear Mails */
    $mail->clearAddresses();
    $mail->clearCustomHeaders();
    $mail->clearAllRecipients();
    $mail->AddAddress($email_to, $email_to_name);
    $mail->Subject  =  $email_subject;
    $mail->Body = $email_body;

    /* Send Error */
    if(!$mail->Send()){
        //echo $mail->ErrorInfo;
    }else{
        //echo $mail->ErrorInfo;
    }
    # *************************************************************************
}
# ********************************************************************************************************************************
else if($config['email_type'] == 'sendgrid'){ # SendGrid
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->Host     = 'smtp.sendgrid.net';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = $config['smtp_debug'];
    $mail->Debugoutput = 'html';
    $mail->SMTPKeepAlive = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $config['sendgrid_user'];
    $mail->Password = $config['sendgrid_pass'];
    $mail->Port = 587;

    $mail->Priority = 1;
    $mail->Encoding = 'base64';
    $mail->CharSet = "utf-8";
    if($config['email_template']==0){
        $mail->IsHTML(true);
        $mail->ContentType = "text/html";
    }
    else{
        $mail->ContentType = "text/plain";
    }
    $mail->SetFrom($config['admin_email'], $name = $config['site_title']);
    if($email_reply_to != null){
        $mail->AddReplyTo($email_reply_to, $email_reply_to_name);
    }

    /* Clear Mails */
    $mail->clearAddresses();
    $mail->clearCustomHeaders();
    $mail->clearAllRecipients();
    $mail->AddAddress($email_to, $email_to_name);
    $mail->Subject  =  $email_subject;
    $mail->Body = $email_body;

    /* Send Error */
    if(!$mail->Send()){
        //echo $mail->ErrorInfo;
    }else{
        //echo $mail->ErrorInfo;
    }
}
?>