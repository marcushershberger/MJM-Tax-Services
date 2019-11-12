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

    include("./vendor/autoload.php");
    include 'conn.php';
    include 'mail_vars.php';

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }

    // Indicate where the uploaded file should be stored.
    $storage = new \Upload\Storage\FileSystem('docs');
    // Create the upload object using the name of the input and the storage location
    $file = new \Upload\File('document', $storage);


    // Change the name of the uploaded file to the user id and the datetime of upload. Keep the extension.
    $dateTime = date("Y-m-d H:i:s");

    // Check that the uploaded file is the right mimetype and size.
    $file->addValidations(array(
        new \Upload\Validation\Mimetype('application/pdf', 'image/jpg', 'image/jpeg')
    ));

    // Store the file on the server and create a database entry of the uploaded file.
    try {
        $file->upload();
        $type = $file->getExtension();
        $fullFilename = $file->getNameWithExtension();
        $sqlUpload = $conn->prepare("INSERT INTO file_uploads (user, file_type, date_time, file_name) VALUES (?,?,?,?)");
        $sqlUpload->bind_param("isss", $_SESSION['USER'], $type, $dateTime, $fullFilename);
        $sqlUpload->execute();
        $sqlUpload->close();

        $sqlActivityType = $conn->prepare("SELECT id FROM activity_types WHERE name = 'File Upload'");
        $sqlActivityType->execute();
        $sqlActivityType->bind_result($activityType);
        $sqlActivityType->fetch();
        $sqlActivityType->close();

        $sqlActivity = $conn->prepare("INSERT INTO activities (user_id, activity_type, date_time) VALUES (?,?,?)");
        $sqlActivity->bind_param("iis", $_SESSION['USER'], $activityType, $dateTime);
        $sqlActivity->execute();
        $sqlActivity->close();
        $conn->close();

        $recipient = 'testing.mjm.services@gmail.com';
        $content = "User has successfully uploaded a file";
        $message = (new Swift_Message('User has uploaded file to MJM'))->setFrom(['testing.mjm.services@gmail.com' => 'MJM Tax Services'])->setTo(["$recipient" => 'Guest'])->setBody("$content");
        $result = $mailer->send($message);
        // Send mail
        header("Location: home.php");
    } catch (\Exception $e) {
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }
