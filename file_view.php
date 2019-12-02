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
Marcus
You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

// This script outputs a table of files that belong to a given user.
// The user is specified by passing a POST varible (obj)
    $connection = "";
    if (isset($_POST['obj'])) {
      session_start();
      // Make sure user is authorized to view files
      if (!isset($_SESSION['USER'])) header("Location: ./index.php");
      if ($_SESSION['ACCT_TYPE'] != 2) header("Location: ./index.php");

      // Include functions for HTML output.
      include 'inc/php_to_html_functions.php';

      // Include database connection information.
      include 'inc/conn.php';

      $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
      if (mysqli_connect_errno()) {
          echo p("Failed to connect: " . mysqli_connect_errno());
      }

      // Store the user id from the POST variable.
      $user = (int)$_POST['obj'];

      // SQL query to get file information for each file that belongs to the user.
      $sqlUserFiles = $connection->prepare("SELECT id, file_type, date_time, file_name FROM file_uploads WHERE user = ?");
      $sqlUserFiles->bind_param("i", $user);
      $sqlUserFiles->execute();
      $sqlUserFiles->bind_result($fileId, $file_type, $date_time, $file_name);

      // Current column of table
      $column = 0;

      // Number of columns the table should hold
      $COLUMNS = 4;

      // Create a table with a heading row containing a button to go back one view.
      $tableContents = tr(th(button("Back", "getYearFolders($user)")));
      $rowContents = "";

      // For each file that belongs to the user...
      while ($sqlUserFiles->fetch()) {
        // Create a table cell with a link to deliver the current file
        $imgSrc = $file_type == "pdf" ? "pdf.png" : "jpg.png";
        $img = img($imgSrc, " ", " ", "width:100%");
        $div = div($img, " ", " ", "height:100px;width:100px");
        $a = a($div.$file_name,"deliverFile.php?id=$fileId");
        // Append the cell to the current table row
        $rowContents .= td(button("X", "startDeleteFile(this, $fileId)").$a, "folder", " ");
        if ($column + 1 == $COLUMNS) {
          // Append the current table row to the table
          $column = 0;
          $tableContents .= tr($rowContents);
          $rowContents = "";
        }
        else {
          $column++;
        }
      }
      if ($rowContents != "") {
        // Append leftover cells to the table
        $tableContents .= tr($rowContents);
      }
      $sqlUserFiles->close();
      echo table($tableContents, "view");


    }
    // No files belong to the user.
    else {
      echo p("No Files");
    }
