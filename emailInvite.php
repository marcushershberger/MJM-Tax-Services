<?php
	require_once './vendor/autoload.php';
    include 'inc/validations.php'; // Needed for valid email check
    include 'inc/mail_vars.php';
    
    // Make sure the email and key variables have values, else return user
    if (!isset($_POST['key']) || !isset($_POST['email'])) {
		// Return to link generation page
        header("Location: invite.php?errorCode=1");
    }
    
    //Make sure email is valid, else return user
    if (!validEmail($_POST['email'])) {
        // Return to link generation page
        header("Location: invite.php?errorCode=2");
    }
    
    $email = $_POST['email'];
    $key = $_POST['key'];
    
    // Create new email message via SwiftMailer library
    $recipient = $email;
    $content = "Hi, you have been invited to join MJM consulting... etc. Your registration key is $key";
	$message = (new Swift_Message('MJM Tax Services Invitation'))->setFrom(['testing.mjm.services@gmail.com' => 'MJM Tax Services'])->setTo(["$recipient" => 'Guest'])->setBody("$content");
    $result = $mailer->send($message);
