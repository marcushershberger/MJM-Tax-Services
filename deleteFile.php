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

// This file is called to delete a specified file.
// The file id will be passed as a POST variable (obj).

  session_start();
  // Check that the user is authorized to delete a file.
  if (!isset($_SESSION['USER']) || $_SESSION['ACCT_TYPE'] != 2) {
    echo "You are not authorized for this action.";
  }
  else {
    // Get the file id from the post variable.
    $deleteFileId = (int)$_POST['obj'];
    // Include database connection information.
    include 'inc/conn.php';
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  	if ($conn->connect_error) {
  		die("Connection Error".$conn->connect_error);
  	}

    // SQL query to retrieve the filename that belongs to the file id.
    $sqlFileData = $conn->prepare("SELECT file_name, directory FROM file_uploads WHERE id = ?");
    $sqlFileData->bind_param('i', $deleteFileId);
	  $sqlFileData->execute();
    $sqlFileData->bind_result($fileName, $directory);
    $sqlFileData->fetch();
    $sqlFileData->close();

    // SQL query to delete the database entry that recorded the upload.
    $sqlDelFiles = $conn->prepare("DELETE FROM file_uploads WHERE id = ?");
    $sqlDelFiles->bind_param('i', $deleteFileId);
	  $sqlDelFiles->execute();
    $sqlDelFiles->close();

    // Delete the actual file from the server.
    unlink("docs$directory/$fileName");
  }
