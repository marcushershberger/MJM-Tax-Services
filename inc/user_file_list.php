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

// HTML content for listing all uploads of a specified user.
// User is specified by a session variable (USER)
    include 'doc_file_path.php';
    // Create table to hold the list
    $tableContents = tr(th("Files"));
    $sqlUploads = $conn->prepare("SELECT id, file_name FROM file_uploads WHERE user = ?");
    $sqlUploads->bind_param('i', $_SESSION['USER']);
	  $sqlUploads->execute();
	  $sqlUploads->bind_result($id, $filename);
    // For each file that the user has uploaded...
  	while ($sqlUploads->fetch()) {
        // Create a row
        $cell = td(a($filename, "deliverFile.php?id=$id"));
        $row = tr($cell);
        // Append the current row to the table
        $tableContents .= $row;
	  }
    // Output the table
	  echo table($tableContents);
?>
