<?php
    // Check to see if a page has set $conn_auth. If not, the user is redirected to 'index.php';
    if (!isset($conn_auth)) {
        header("Location: index.php");
    }

    // Database information
    $db_username = "mhershberger";
    $db_password = "2277927";
    $db_name = "SP_DB";
    $db_host = "levi.cis.indwes.edu";
