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
    include('inc/conn.php'); // Includes database connection info.
    include('inc/display_functions.php'); // Includes functions that return HTML content for display.

    //$username = $_POST["user"]; // Information from the form on 'login.php'
    //$pass = $_POST["pass"];

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    /*$sql = "SELECT pass, admin FROM users_test WHERE username = '$username';"; // SQL query to execute.
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
