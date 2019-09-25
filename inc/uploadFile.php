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

    $new_filename = date("D M d, Y G:i:s");
    $file->setName($new_filename);
    
    $file->addValidations(array(
        //new \Upload\Validation\Mimetype('image/png'),
        new \Upload\Validation\Mimetype('text/plain'),
        new \Upload\Validation\Size('1M')
    ));
    
    try {
        $file->upload();
    } catch (\Exception $e) {
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }

