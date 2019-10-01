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
    include("../vendor/autoload.php");
    include 'conn.php';
    include 'php_to_html_functions.php';
    
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    
    // Indicate where the uploaded file should be stored.
    $storage = new \Upload\Storage\FileSystem('../../../../docs');
    // Create the upload object using the name of the input and the storage location
    $file = new \Upload\File('document', $storage);

    // Start the session for cross-page variables.
    session_start();
    // Change the name of the uploaded file to the user id and the datetime of upload. Keep the extension.
    $dateTime = date("Y-m-d H:i:s");
    $newFilename = $_SESSION['USER']." $dateTime";
    $file->setName($newFilename);
    
    // Check that the uploaded file is the right mimetype and size.
    $file->addValidations(array(
        new \Upload\Validation\Mimetype('application/pdf'),
        new \Upload\Validation\Size('1M')
    ));
    
    // Store the file on the server and create a database entry of the uploaded file.
    try {
        $file->upload();
        $pdf = "pdf";
        $fullFilename = $newFilename.".pdf";
        $sqlUpload = $conn->prepare("INSERT INTO file_uploads (user, file_type, date_time, file_name) VALUES (?,?,?,?)");
        $sqlUpload->bind_param("isss", $_SESSION['USER'], $pdf, $dateTime, $fullFilename);
        $sqlUpload->execute();
        $sqlUpload->close();
        $conn->close();
        header("Location: ../home.php");
    } catch (\Exception $e) {
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }

