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
    echo h1("Recent User Activity");

    $sqlActivityTypes = $conn->prepare("SELECT name FROM activity_types ORDER BY id ASC");
    $sqlActivityTypes->execute();
    $sqlActivityTypes->bind_result($name);
    $types = array();
    while ($sqlActivityTypes->fetch()) {
      $types[] = $name;
    }
    $sqlActivityTypes->close();

    $sqlRecent = $conn->prepare("SELECT user_id, activity_type, date_time FROM activities ORDER BY date_time DESC LIMIT 10");
    $sqlRecent->execute();
    $sqlRecent->bind_result($userId, $activityType, $dateTime);
    $rows = array();
    while ($sqlRecent->fetch()) {
      $rows[] = array($userId, $activityType, $dateTime);
    }
    $sqlRecent->close();

    $tableContents = "";
    foreach ($rows as $key => $value) {
      $sqlUsername = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
      $sqlUsername->bind_param("i", $value[0]);
      $sqlUsername->execute();
      $sqlUsername->bind_result($fname, $lname);
      $sqlUsername->fetch();
      $activity = $types[$value[1] - 1];
      $rowContents = td($fname." ".$lname).td($activity).td($value[2]);
      $tableContents .= tr($rowContents);
      $sqlUsername->close();
    }
    echo div(table($tableContents), " ", "activity");
