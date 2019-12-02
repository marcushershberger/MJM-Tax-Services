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

//include('inc/conn.php');
//include('inc/validations.php');
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection failed.");
}

$regKey = $_GET['key'];



$getAccountID = $connection->prepare("SELECT account_id FROM pw_reset_keys WHERE reset_key = ?");
$getAccountID->bind_param("s", $regKey);
$getAccountID->execute();
$getAccountID->bind_result($accountID);
$getAccountID->fetch();
$getAccountID->close();

$getSecSet = $connection->prepare("SELECT sec_question_1, sec_question_2, sec_question_3 FROM security_question_sets WHERE account_id = ?");
$getSecSet->bind_param("i", $accountID);
$getSecSet->execute();
$getSecSet->bind_result($sec_question_1, $sec_question_2, $sec_question_3);
$getSecSet->fetch();
$getSecSet->close();

$questionSet = array($sec_question_1, $sec_question_2, $sec_question_3);

$ques1 = rand(1,3) -1;
$ques2 = rand(1,3) -1;
while ($ques2 == $ques1) {
    $ques2 = rand(1,3) -1;
}

$questionSet1 = $questionSet[$ques1];
$questionSet2 = $questionSet[$ques2];

$getSecQuestions = $connection->prepare("SELECT question FROM security_questions WHERE id = ? OR id = ?");
$getSecQuestions->bind_param("ii", $questionSet1, $questionSet2);
$getSecQuestions->execute();
$getSecQuestions->bind_result($question_);
$questions = array();
while ($getSecQuestions->fetch()){
    $questions[] = $question_;
}
$getSecQuestions->close();
