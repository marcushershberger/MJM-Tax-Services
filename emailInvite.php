<?php
/*
MJM Tax Services
This software is a management system for tax-related documents, used by tax consultants and their clients.
Copyright (C) 2019 Marcus Hershberger and Tyler Snodderly

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
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
	$message = (new Swift_Message('MJM Tax Services Invitation'))->setFrom(['testing.mjm.services@gmail.com' => 'MJM Tax Services'])->setTo(["$recipient" => 'Guest'])->setBody("$content");
    $result = $mailer->send($message);
