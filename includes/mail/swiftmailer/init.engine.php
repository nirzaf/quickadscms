<?php
/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       2.0                                                      | */
/*  | Last modified 17.04.2015                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */
@set_time_limit(0);
require_once dirname(__FILE__).'/swift_required.php';

$config['smtp_debug'] = false;

if($config['email_type'] == 'smtp'){ # SMTP

	$transport = Swift_SmtpTransport::newInstance();
	$transport->setHost($config['smtp_host']);
	$transport->setPort($config['smtp_port']);
	$transport->setUsername($config['smtp_username']);
	$transport->setPassword($config['smtp_password']);
	if($config['smtp_secure']==1){# SSL
		$transport->setEncryption('ssl');
	}else if($config['smtp_secure']==2){# TLS
		$transport->setEncryption('tls');
	}
	
	# Create Mailer
	$mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();
	

	# Create a message
	$message->setEncoder(Swift_Encoding::getBase64Encoding());
    if($email_reply_to != null){
        $message->setReplyTo(array($email_reply_to => $email_reply_to_name));
    }
	$message->setCharset('utf-8');
	$message->setPriority(1);
	$message->setFrom(array($config['admin_email'] => $config['site_title']));

	# Receivers
    $message->setTo(array($email_to => $email_to_name));
    $message->setSubject($email_subject);

    if($config['email_template']==0){
        $ContentType = "text/html";
    }
    else{
        $ContentType = "text/plain";
    }

    $message->setBody($email_body,$ContentType);

    # Send Message
    if(!$mailer->send($message)){
        $sendingErrors = 'Messages could not be sent!';
        $sendPos = false;
    }else{
        $sendingErrors = 'Sent successfully';
        $sendPos = true;
    }
    return $sendPos;

}
# ********************************************************************************************************************************
else if($config['email_type'] == 'mail'){ # PHPMail

	$transport = Swift_MailTransport::newInstance();
	
	# Create Mailer
	$mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();

	# Create a message
	$message->setEncoder(Swift_Encoding::getBase64Encoding());
    if($email_reply_to != null){
        $message->setReplyTo(array($email_reply_to => $email_reply_to_name));
    }
	$message->setCharset('utf-8');
	$message->setPriority(1);
    $message->setFrom(array($config['admin_email'] => $config['site_title']));

    # Receivers
    $message->setTo(array($email_to => $email_to_name));
    $message->setSubject($email_subject);

    if($config['email_template']==0){
        $ContentType = "text/html";
    }
    else{
        $ContentType = "text/plain";
    }

    $message->setBody($email_body,$ContentType);

    # Send Message
    if(!$mailer->send($message)){
        $sendingErrors = 'Messages could not be sent!';
        $sendPos = false;
    }else{
        $sendingErrors = 'Sent successfully';
        $sendPos = true;
    }

}
# ********************************************************************************************************************************
else if($config['email_type'] == 'aws'){ # Amazon SES

	$transport = Swift_SmtpTransport::newInstance();
	$transport->setHost($config['aws_host']);
	$transport->setPort(465);
	$transport->setUsername($config['aws_access_key']);
	$transport->setPassword($config['aws_secret_key']);
	$transport->setEncryption('tls');
	
	# Create Mailer
	$mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();


    # Create a message
    $message->setEncoder(Swift_Encoding::getBase64Encoding());
    if($email_reply_to != null){
        $message->setReplyTo(array($email_reply_to => $email_reply_to_name));
    }
    $message->setCharset('utf-8');
    $message->setPriority(1);
    $message->setFrom(array($config['admin_email'] => $config['site_title']));

    # Receivers
    $message->setTo(array($email_to => $email_to_name));
    $message->setSubject($email_subject);

    if($config['email_template']==0){
        $ContentType = "text/html";
    }
    else{
        $ContentType = "text/plain";
    }

    $message->setBody($email_body,$ContentType);

    # Send Message
    if(!$mailer->send($message)){
        $sendingErrors = 'Messages could not be sent!';
        $sendPos = false;
    }else{
        $sendingErrors = 'Sent successfully';
        $sendPos = true;
    }

}
# ********************************************************************************************************************************
else if($config['email_type'] == 'mandrill'){ # Mandrill

	$transport = Swift_SmtpTransport::newInstance();
	$transport->setHost('smtp.mandrillapp.com');
	$transport->setPort(587);
	$transport->setUsername($config['mandrill_user']);
	$transport->setPassword($config['mandrill_key']);
	$transport->setEncryption('tls');
	
	# Create Mailer
	$mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();


    # Create a message
    $message->setEncoder(Swift_Encoding::getBase64Encoding());
    if($email_reply_to != null){
        $message->setReplyTo(array($email_reply_to => $email_reply_to_name));
    }
    $message->setCharset('utf-8');
    $message->setPriority(1);
    $message->setFrom(array($config['admin_email'] => $config['site_title']));

    # Receivers
    $message->setTo(array($email_to => $email_to_name));
    $message->setSubject($email_subject);

    if($config['email_template']==0){
        $ContentType = "text/html";
    }
    else{
        $ContentType = "text/plain";
    }

    $message->setBody($email_body,$ContentType);

    # Send Message
    if(!$mailer->send($message)){
        $sendingErrors = 'Messages could not be sent!';
        $sendPos = false;
    }else{
        $sendingErrors = 'Sent successfully';
        $sendPos = true;
    }

}

# ********************************************************************************************************************************
else if($config['email_type'] == 'sendgrid'){ # SendGrid

	$transport = Swift_SmtpTransport::newInstance();
	$transport->setHost('smtp.sendgrid.net');
	$transport->setPort(587);
	$transport->setUsername($config['sendgrid_user']);
	$transport->setPassword($config['sendgrid_pass']);
	$transport->setEncryption('tls');
	
	# Create Mailer
	$mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();

    # Create a message
    $message->setEncoder(Swift_Encoding::getBase64Encoding());
    if($email_reply_to != null){
        $message->setReplyTo(array($email_reply_to => $email_reply_to_name));
    }
    $message->setCharset('utf-8');
    $message->setPriority(1);
    $message->setFrom(array($config['admin_email'] => $config['site_title']));

    # Receivers
    $message->setTo(array($email_to => $email_to_name));
    $message->setSubject($email_subject);

    if($config['email_template']==0){
        $ContentType = "text/html";
    }
    else{
        $ContentType = "text/plain";
    }

    $message->setBody($email_body,$ContentType);

    # Send Message
    if(!$mailer->send($message)){
        $sendingErrors = 'Messages could not be sent!';
        $sendPos = false;
    }else{
        $sendingErrors = 'Sent successfully';
        $sendPos = true;
    }

}
?>