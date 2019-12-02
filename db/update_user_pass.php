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

include('../inc/conn.php');
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection failed.");
}

$userAns1 = $_POST["securityQuestion1"];
$userAns2 = $_POST["securityQuestion2"];

$key = $_POST['key'];
$id = $_GET['id'];

$num = str_split($id);

$quesSet1 = $num[0];
$quesSet2 = $num[1];

$userAns1 = strtolower($userAns1);
$userAns2 = strtolower($userAns2);

$checkRegKey = $connection->prepare("SELECT used FROM pw_reset_keys WHERE reset_key = ?");
$checkRegKey->bind_param("s", $key);
$checkRegKey->execute();
$checkRegKey->bind_result($used);
$checkRegKey->fetch();
$checkRegKey->close();
$used = (int)$used;

if ($used) {
    $errors = 1;
    header("Location: ../reset_pass.php?errors=$errors");
} else {


    $getAccountID = $connection->prepare("SELECT account_id FROM pw_reset_keys WHERE reset_key = ?");
    $getAccountID->bind_param("s", $key);
    $getAccountID->execute();
    $getAccountID->bind_result($accountID);
    $getAccountID->fetch();
    $getAccountID->close();


    $sql_id = $connection->prepare("SELECT account_id FROM pw_reset_keys WHERE reset_key = ?");
    $sql_id->bind_param("s", $key);
    $sql_id->execute();
    $sql_id->bind_result($id);
    $sql_id->fetch();
    $sql_id->close();

    $getUserAns1 = $connection->prepare("SELECT sec_question_1, sec_answer_1 FROM security_question_sets WHERE account_id = ?");
    $getUserAns1->bind_param("i", $accountID);
    $getUserAns1->execute();
    $getUserAns1->bind_result($secQuestion1, $secAnswer1);
    $getUserAns1->fetch();
    $getUserAns1->close();


    $getUserAns2 = $connection->prepare("SELECT sec_question_2, sec_answer_2 FROM security_question_sets WHERE account_id = ?");
    $getUserAns2->bind_param("i", $accountID);
    $getUserAns2->execute();
    $getUserAns2->bind_result($secQuestion2, $secAnswer2);
    $getUserAns2->fetch();
    $getUserAns2->close();

    $getUserAns3 = $connection->prepare("SELECT sec_question_3, sec_answer_3 FROM security_question_sets WHERE account_id = ?");
    $getUserAns3->bind_param("i", $accountID);
    $getUserAns3->execute();
    $getUserAns3->bind_result($secQuestion3, $secAnswer3);
    $getUserAns3->fetch();
    $getUserAns3->close();

    $secAnswer1 = strtolower($secAnswer1);
    $secAnswer2 = strtolower($secAnswer2);
    $secAnswer3 = strtolower($secAnswer3);


    $pass = $_POST['pass'];
    $hash = password_hash($pass, PASSWORD_BCRYPT);

    $sql_pass = $connection->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $sql_pass->bind_param("si", $hash, $id);
    $sql_pass->execute();
    $sql_pass->close();

    if ($quesSet1 == $secQuestion1 or $quesSet1 == $secQuestion2 or $quesSet1 == $secQuestion3) {
        if ($userAns1 == $secAnswer1 or $userAns1 == $secAnswer2 or $userAns1 == $secAnswer3) {

        } else {
            header("Location: ../" . ("reset_pass.php?key=" . $key));
        }
    }

    if ($quesSet2 == $secQuestion1 or $quesSet2 == $secQuestion2 or $quesSet2 == $secQuestion3) {
        if ($userAns2 == $secAnswer1 or $userAns2 == $secAnswer2 or $userAns2 == $secAnswer3) {
            $sqlMarkUsed = $connection->prepare("UPDATE pw_reset_keys SET used = 1 WHERE reset_key = ?");
            $sqlMarkUsed->bind_param("s", $key);
            $sqlMarkUsed->execute();
            $sqlMarkUsed->close();
            $connection->close();
            header("Location: ../login.php");
        } else {
            header("Location: ../" . ("reset_pass.php?key=" . $key));
        }
    }
}
