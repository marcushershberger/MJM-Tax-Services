<?php
    include 'conn.php';
    include 'php_to_html_functions.php';
    
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    
    if (isset($_FILES['document'])) echo p("Works");
    else echo p("Does not work");
