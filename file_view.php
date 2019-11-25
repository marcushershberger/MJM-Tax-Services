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
    $connection = "";
    if (isset($_POST['obj'])) {
      include 'inc/php_to_html_functions.php';
      include 'inc/conn.php';

      $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
      if (mysqli_connect_errno()) {
          echo p("Failed to connect: " . mysqli_connect_errno());
      }
      $user = (int)$_POST['obj'];
      $sqlUserFiles = $connection->prepare("SELECT file_type, date_time, file_name FROM file_uploads WHERE user = ?");
      $sqlUserFiles->bind_param("i", $user);
      $sqlUserFiles->execute();
      $sqlUserFiles->bind_result($file_type, $date_time, $file_name);
      $column = 0;
      $COLUMNS = 4;
      $tableContents = tr(th(button("Back", "getYearFolders($user)")));
      $rowContents = "";
      while ($sqlUserFiles->fetch()) {
        $img = img("pdf.png", " ", " ", "width:100%");
        $div = div($img, " ", " ", "height:100px;width:100px");
        $a = a($div.$file_name,"deliverFile.php?file=$file_name");
        $rowContents .= td($a);
        if ($column + 1 == $COLUMNS) {
          $column = 0;
          $tableContents .= tr($rowContents);
          $rowContents = "";
        }
        else {
          $column++;
        }
      }
      if ($rowContents != "") {
        $tableContents .= tr($rowContents);
      }
      $sqlUserFiles->close();
      echo table($tableContents);


    }
    else {
      echo p("No Files");
    }
