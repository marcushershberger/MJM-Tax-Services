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

// This script retrieves the security questions of the user that is attempting to reset their passwords

// Include database connection information
include('../inc/conn.php');


$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection Error".$connection->connect_error);
}

// SQL query to select security questions of user
$getSecQues = $connection->prepare("SELECT sec_question_1, sec_question_2, sec_question_3 FROM security_question_sets WHERE account_id = ?");
$getSecQues->bind_param("i", $acount_id);
$getSecQues->execute();
$getSecQues->bind_result($ques1, $ques2, $ques3);
$getSecQues->fetch();
$getSecQues->close();

$getSecSets = $connection->prepare("SELECT ?, ? FROM security_questions");
$getSecSets->bind_param("ii", $ques1, $ques2);
$getSecSets->execute();
$getSecSets->bind_result($set1, $set2);
$getSecSets->fetch();
$getSecSets->close();
