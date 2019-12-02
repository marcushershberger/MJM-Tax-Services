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
    // Check that the user is logged in.
    if (!isset($_SESSION['USER'])) header ("Location: ./index.php");
    if (!isset($_GET['id'])) header ("Location: ./index.php");

    // Create fileId so it can be used later. This is the id of the file that is being requested.
    $fileId = 0;

    // If GET variable is not an integer, redirect
    try {
      $fileId = (int)$_GET['id'];
    }
    catch (Exception $e){
      header ("Location: ./index.php");
    }

    // Include database connection information.
    include 'inc/conn.php';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  	if ($conn->connect_error) {
  		die("Connection Error".$conn->connect_error);
  	}

    // SQL query to retrieve information about a file upload
    $sqlUploads = $conn->prepare("SELECT user, file_type, file_name, directory FROM file_uploads WHERE id = ?");
    $sqlUploads->bind_param('i', $fileId);
	  $sqlUploads->execute();
	  $sqlUploads->bind_result($user, $fileType, $fileName, $directory);
    $sqlUploads->fetch();
    $sqlUploads->close();

    // Make sure the requester is either the owner of the file or an admin user.
    if (!($_SESSION['ACCT_TYPE'] == 2 || $_SESSION['USER'] == $user)) {
      header("Location: ./index.php");
    }
    // Set appropriate mimetype
    $mimetype = $fileType == "pdf" ? "application/pdf" : "image/jpg";
    header("Content-Type: $mimetype");
    $file = "docs$directory/$fileName";
    // Deliver file
    readFile($file);
