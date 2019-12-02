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
  session_start();
  // Make sure user is logged in and admin
  if (!isset($_SESSION['USER']) || $_SESSION['ACCT_TYPE'] != 2) {
    echo "You are not authorized for this action.";
  }
  else {
    include 'inc/php_to_html_functions.php';
    // Store GET variable user id
    $userId = (int)$_POST['obj'];

    // Include database connection information
    include 'inc/conn.php';
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  	if ($conn->connect_error) {
  		die("Connection Error".$conn->connect_error);
  	}

    // SQL query to retrieve user information for the given user id
    $sqlUserInfo = $conn->prepare("SELECT first_name, last_name, username, email_addr, street_addr, street_addr_2, city, state, zip, phone_num FROM users WHERE id = ?");
    $sqlUserInfo->bind_param('i', $userId);
	  $sqlUserInfo->execute();
    $sqlUserInfo->bind_result($firstName, $lastName, $userName, $email, $street1, $street2, $city, $state, $zip, $phone);
    $sqlUserInfo->fetch();
    $sqlUserInfo->close();

    // Create a table of the user's information
    $tableContents = "";

    $tableContents .= tr(td("Name").td("$firstName $lastName"));
    $tableContents .= tr(td("Username").td($userName));
    $tableContents .= tr(td("Email").td($email));
    $tableContents .= tr(td("Address").td($street1.br().$street2.br()."$city, $state $zip"));
    $tableContents .= tr(td("Phone").td($phone));

    // Output table and an "X" button for closing the popup.
    $divContents = button("X", "removeInfo()").table($tableContents, "userInfo");
    echo $divContents;
  }
