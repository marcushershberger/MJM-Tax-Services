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
    include 'php_to_html_functions.php';
    include('inc/conn.php');
    include 'logout_button.php';
    
    echo p("Welcome Client");
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    include 'file_upload_input.php';
    include 'user_file_list.php';
