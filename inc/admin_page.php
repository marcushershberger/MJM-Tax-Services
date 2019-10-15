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
    include 'conn.php';
    include 'logout_button.php';
    
    echo p("Welcome Admin");
    
    // Create a database connection.
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    // Admin information included here
    include 'all_file_list.php';
    include 'keys_list.php';
    include 'users_list.php';
