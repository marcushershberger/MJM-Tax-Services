<?php

    include 'inc/validations.php'; // Needed for valid email check
    
    // Make sure the email and key variables have values, else return user
    if (!isset($_POST['key']) || !isset($_POST['email'])) {
        // Return to link generation page
    }
    
    //Make sure email is valid, else return user
    if (!validEmail($email)) {
        // Return to link generation page
    }
    
    $email = $_POST['email'];
    $key = $_POST['key'];
    
    // Create new email message via SwiftMailer library
    $recipient = $email;
    $message = "Hi, you have been invited to join MJM consulting... etc. Your registration key is $key";
