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
    $id = $_POST['obj'];
    include 'inc/php_to_html_functions.php';
    include 'inc/conn.php';
    $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }

    $sqlUserList = $connection->prepare("SELECT DISTINCT SUBSTRING(date_time, 1, 4) FROM file_uploads WHERE user = ?");
    $sqlUserList->bind_param("i", $id);
    $sqlUserList->execute();
    $sqlUserList->bind_result($year);
    $column = 0;
    $COLUMNS = 4;
    $tableContents = tr(th(button("Back", "getFiles(0)")));
    $rowContents = "";
    while ($sqlUserList->fetch()) {
      $func = "getFiles($id, $year)";
      $rowContents .= tdClickable(div(img("folder.png", " ", " ", "width:100%"), " ", " ", "height:100px;width:100px").$year, " ", " ", " ", $func);
      if ($column + 1 == $COLUMNS) {
        $column = 0;
        $tableContents .= tr($rowContents);
        $rowContents = "";
      }
      else {
        $column++;
      }
    }
    if ($column < $COLUMNS) $tableContents .= tr($rowContents);
    $sqlUserList->close();
    echo table($tableContents);
