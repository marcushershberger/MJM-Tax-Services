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

//This file will delete a user from the system
// The user id will be passed in a POST variable (obj)
  session_start();
  // Check that the user is authorized to delete a file.
  if (!isset($_SESSION['USER']) || $_SESSION['ACCT_TYPE'] != 2) {
    echo "You are not authorized for this action.";
  }
  else {
    // Get the user id from the post variable.
    $deleteUserId = (int)$_POST['obj'];
    // Include database connection information.
    include 'inc/conn.php';
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  	if ($conn->connect_error) {
  		die("Connection Error".$conn->connect_error);
  	}

    // SQL query to delete the user's file upload records
    $sqlDelFiles = $conn->prepare("DELETE FROM file_uploads WHERE user = ?");
    $sqlDelFiles->bind_param('i', $deleteUserId);
	  $sqlDelFiles->execute();
    $sqlDelFiles->close();

    // // SQL query to delete the user's activity log
    $sqlDelActivities = $conn->prepare("DELETE FROM activities WHERE user_id = ?");
    $sqlDelActivities->bind_param('i', $deleteUserId);
	  $sqlDelActivities->execute();
    $sqlDelActivities->close();

    // SQL query to delete the user's password reset keys
    $sqlDelKeys = $conn->prepare("DELETE FROM pw_reset_keys WHERE account_id = ?");
    $sqlDelKeys->bind_param('i', $deleteUserId);
	  $sqlDelKeys->execute();
    $sqlDelKeys->close();

    // SQL query to delete the user's login attempts log
    $sqlDelAttempts = $conn->prepare("DELETE FROM login_attempts WHERE account_id = ?");
    $sqlDelAttempts->bind_param('i', $deleteUserId);
	  $sqlDelAttempts->execute();
    $sqlDelAttempts->close();

    // SQL query to delete the user's security question set
    $sqlDelQuestions = $conn->prepare("DELETE FROM security_question_sets WHERE account_id = ?");
    $sqlDelQuestions->bind_param('i', $deleteUserId);
	  $sqlDelQuestions->execute();
    $sqlDelQuestions->close();

    // SQL query to delete the user from the system
    $sqlDelUser = $conn->prepare("DELETE FROM users WHERE id = ?");
    $sqlDelUser->bind_param('i', $deleteUserId);
	  $sqlDelUser->execute();
    $sqlDelUser->close();
  }
