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

// This script outputs a table of folders represent users.
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
    }
    else {
      $connection = $conn;
    }

    // SQL query to retrieve information about users
    $sqlUserList = $connection->prepare("SELECT id, username, first_name, last_name FROM users");
    $sqlUserList->execute();
    $sqlUserList->bind_result($id, $username, $first_name, $last_name);

    // Current column of table
    $column = 0;

    // Number of columns the table should hold
    $COLUMNS = 4;

    // Create a table to hold each user folder
    $tableContents = "";
    $rowContents = "";

    // For each user...
    while ($sqlUserList->fetch()) {
      // Create a table cell
      $func = "getYearFolders($id)";
      // Append the current cell to the current row
      $rowContents .= tdClickable(div(img("folder.png", " ", " ", "width:100%"), " ", " ", "height:100px;width:100px").$first_name." ".$last_name, "folder", " ", " ", $func);
      if ($column + 1 == $COLUMNS) {
        // Append the current row to the table
        $column = 0;
        $tableContents .= tr($rowContents);
        $rowContents = "";
      }
      else {
        $column++;
      }
    }
    if ($rowContents != "") {
      // Append any leftover cells to the table
      $tableContents .= tr($rowContents);
    }
    $sqlUserList->close();

    // Output the table of folders
    echo isset($_POST['obj']) ? table($tableContents, "view") : div(table($tableContents, "view"), " ", "files");
