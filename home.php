<?php
    $sec_auth = true; // Control variable that prevents users from accessing 'display_functions.php' directly.
    $conn_auth = true; // Control variable that prevents users from accessing 'conn.php' directly;

    include('conn.php'); // Includes database connection info.
    include('display_functions.php'); // Includes functions that return HTML content for display.

    $username = $_POST["user"]; // Information from the form on 'login.php'
    $pass = $_POST["pass"];

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    $sql = "SELECT pass, admin FROM users_test WHERE username = '$username';"; // SQL query to execute.
    $result = $conn->query($sql); // Execute SQL query.
    if (!(mysqli_num_rows($result) == 0)) {
        // If user exists
        $row = $result->fetch_assoc();
        $DB_admin = $row["admin"];
        $DB_pass = $row["pass"];
        if ($DB_admin == 1 && $DB_pass == $pass) {
            // If user is admin and password is correct.
            echo adminPage();
        }
        else if ($DB_pass == $pass) {
            // If user is normal user and password is incorrect.
            echo userPage();
        }
        else {
            // If user password is incorrect.
            header("Location: login.php?error=1");
        }
    }
    else {
        // If user does not exist.
        header("Location: login.php?error=2");
    }
?>