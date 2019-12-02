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

// This script takes an uploaded file from the user and handles it appropriately.
// Valid uploads will be written to the server

    include("./vendor/autoload.php");
    include 'conn.php';
    include 'mail_vars.php';

    // Used for querying emails that belong to admins (account type 2)
    $adminAccountType = 2;

    // Database connection
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }

    // Get current full datetime and year only
    $dateTime = date("Y-m-d H:i:s");
    $year = date("Y");

    // Store the file on the server and create a database entry of the uploaded file.
    try {
        // Query the username of the uploader
        $sqlGetUser = $conn->prepare("SELECT username FROM users WHERE id = ?");
        $sqlGetUser->bind_param("i", $_SESSION['USER']);
        $sqlGetUser->execute();
        $sqlGetUser->bind_result($user);
        $sqlGetUser->fetch();
        $sqlGetUser->close();

        // If the directories exists, skip to the userDir assignment.
        // Otherwise, create the needed directories (user and year)
        if (!file_exists("docs/$user")) {
          mkdir("docs/$user/");
          mkdir("docs/$user/$year");
        }
        else if (!file_exists("docs/$user/$year")) {
          mkdir("docs/$user/$year");
        }
        $userDir = "/$user/$year";

        // Indicate where the uploaded file should be stored.
        $storage = new \Upload\Storage\FileSystem('docs'.$userDir);
        // Create the upload object using the name of the input and the storage location
        $file = new \Upload\File('document', $storage);

        // Check that the uploaded file fits one of the specified mimetypes
        $file->addValidations(array(
            new \Upload\Validation\Mimetype(array('application/pdf', 'image/jpeg'))
        ));

        //Upload the file
        $file->upload();
        $type = $file->getExtension();
        $fullFilename = $file->getNameWithExtension();

        // Insert record of the upload to the database
        $sqlUpload = $conn->prepare("INSERT INTO file_uploads (user, file_type, date_time, file_name, directory) VALUES (?,?,?,?,?)");
        $sqlUpload->bind_param("issss", $_SESSION['USER'], $type, $dateTime, $fullFilename, $userDir);
        $sqlUpload->execute();
        $sqlUpload->close();

        // Retrieve activity id of an upload activity.
        $sqlActivityType = $conn->prepare("SELECT id FROM activity_types WHERE name = 'File Upload'");
        $sqlActivityType->execute();
        $sqlActivityType->bind_result($activityType);
        $sqlActivityType->fetch();
        $sqlActivityType->close();

        // Insert record of the upload as an activity.
        $sqlActivity = $conn->prepare("INSERT INTO activities (user_id, activity_type, date_time) VALUES (?,?,?)");
        $sqlActivity->bind_param("iis", $_SESSION['USER'], $activityType, $dateTime);
        $sqlActivity->execute();
        $sqlActivity->close();

        // Retrieve email of admin user
        $sqlGetAdmin = $conn->prepare("SELECT email_addr FROM users WHERE account_type = ?");
        $sqlGetAdmin->bind_param("i", $adminAccountType);
        $sqlGetAdmin->execute();
        $sqlGetAdmin->bind_result($admins);
        $sqlGetAdmin->fetch();
        $sqlGetAdmin->close();
        $conn->close();

        // Set variables for outgoing mail
        $recipient = 'testing.mjm.services@gmail.com';
        $content = $user." has successfully uploaded file name: ".$fullFilename.".";
        $message = (new Swift_Message($user. ' has uploaded file to MJM'))->setFrom([$admins => 'MJM Tax Services'])->setTo(["$recipient" => 'Guest'])->setBody("$content");
        $result = $mailer->send($message);
        // Send mail
        header("Location: home.php");
    } catch (\Exception $e) {
        // If something goes wrong, output the error message
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }
