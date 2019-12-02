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
require_once '../vendor/autoload.php';
include 'validations.php'; // Needed for valid email check
include 'mail_vars.php';


$key = $randString;

// Create new email message via SwiftMailer library
$recipient = $user_email;
$url = "http://10.178.40.12/branch/MJM-Tax-Services/reset_pass.php?key=$key";

//$content = "Here is the link to you reset link 10.178.40.12/branch/MJM-Tax-Services/reset_pass.php?key=$key";
$message = (new Swift_Message('MJM Tax Services Reset Password'))->setFrom(['testing.mjm.services@gmail.com' => 'MJM Tax Services'])->setTo(["$recipient" => 'Guest'])->setBody(
    '<html>' .
    ' <body>' .
    '  Click ' .
    '<a href="'.$url.'">here</a>' .
    ' here to reset your password.' .
    ' </body>' .
    '</html>',
    'text/html');
$result = $mailer->send($message);
