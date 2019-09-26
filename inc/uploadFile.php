<?php
    include("../vendor/autoload.php");
    include 'conn.php';
    include 'php_to_html_functions.php';
    
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    
    $storage = new \Upload\Storage\FileSystem('../../../../docs');
    $file = new \Upload\File('document', $storage);

    session_start();
    $dateTime = date("Y-m-d H:i:s");
    $newFilename = $_SESSION['USER']." $dateTime";
    $file->setName($newFilename);
    
    $file->addValidations(array(
        new \Upload\Validation\Mimetype('application/pdf'),
        new \Upload\Validation\Size('1M')
    ));
    
    try {
        $file->upload();
        $pdf = "pdf";
        $fullFilename = $newFilename.".pdf";
        $sqlUpload = $conn->prepare("INSERT INTO file_uploads (user, file_type, date_time, file_name) VALUES (?,?,?,?)");
        $sqlUpload->bind_param("isss", $_SESSION['USER'], $pdf, $dateTime, $fullFilename);
        $sqlUpload->execute();
        $sqlUpload->close();
        $conn->close();
    } catch (\Exception $e) {
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }

