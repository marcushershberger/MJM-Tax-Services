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
include('../inc/php_to_html_functions.php');
include('../inc/validations.php');

$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection Error".$connection->connect_error);
}
if (!isset($_POST)) header("Location: ./index.php");

$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$username = $_POST["user"];
$email = $_POST["email"];
$password = $_POST["pass"];
$passwordVerif = $_POST["passVerif"];
$street = $_POST["street"];
$street2 = $_POST["street2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$key = $_POST["key"];
$phone = $_POST["phoneNum"];

session_start();

$sec_quest1 = $_POST["quest1"];
$sec_ans1 = $_POST["sec_ans_1"];
$sec_quest2 = $_POST["quest2"];
$sec_ans2 = $_POST["sec_ans_2"];
$sec_quest3 = $_POST["quest3"];
$sec_ans3 = $_POST["sec_ans_3"];
//print_r($_POST);

$errors = array();

if (!validUsername($username)) $errors[] = 2;
if (!validEmail($email)) $errors[] = 3;
if (!passwordMatch($password, $passwordVerif)) $errors[] = 4;
if (!validPassword($password)) $errors[] = 5;

if (count($errors) > 0) {
    $errs = json_encode($errors);
    header("Location: ../signup.php?errors=$errs");
    exit();
}




    $sqlValidKey = $connection->prepare("SELECT COUNT(reg_key) as c FROM registration_keys WHERE reg_key = ?");
    $sqlValidKey->bind_param('s', $key);
    $sqlValidKey->execute();
    $sqlValidKey->bind_result($count);
    $sqlValidKey->fetch();
    $count = (int)$count;
    $sqlValidKey->close();
    if ($count == 0) {
        $errors[] = 20;
        $errs = json_encode($errors);
        header("Location: ../signup.php?errors=$errs");
        exit();
    }

    $account_type = 1;
    $security_set = 1000;

    $sqlKeyUsed = $connection->prepare("SELECT used, type FROM registration_keys WHERE reg_key = ?");
    $sqlKeyUsed->bind_param('s', $key);
    $sqlKeyUsed->execute();
    $sqlKeyUsed->bind_result($used, $type);
    $sqlKeyUsed->fetch();
    $sqlKeyUsed->close();
    $used = (int)$used;

    if ($used) {
        $errors[] = 30;
        $errs = json_encode($errors);
        header("Location: ../signup.php?errors=$errs");
        exit();
    }

    //Compare users

    $sqlComp = $connection->prepare("SELECT COUNT(*) as c FROM users WHERE username = ? OR email_addr = ?");
    $sqlComp->bind_param('ss', $username, $email);
    $sqlComp->execute();
    $sqlComp->bind_result($userCount);
    $sqlComp->fetch();
    $sqlComp->close();

    if((int)$userCount > 0) {
        $errorUserNameTaken = "UsernameTaken";
        header("Location: ../signup.php?errors=$errorUserNameTaken");
    } else {
    //End compare users

    $pwh = password_hash($password, PASSWORD_BCRYPT);

    // Store user in database
    $sqlCreateUser = $connection->prepare("INSERT INTO users (first_name, last_name, username, password_hash, email_addr, street_addr, street_addr_2, city, state, zip, phone_num, account_type, security_set) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sqlCreateUser->bind_param('sssssssssssii', $firstname, $lastname, $username, $pwh, $email, $street, $street2, $city, $state, $zip, $phone, $account_type, $security_set);
    $sqlCreateUser->execute();
    $sqlCreateUser->close();

    // Get user id
    $accountID = $connection->prepare("SELECT id FROM users WHERE username = ?");
    $accountID->bind_param('s', $username);
    $accountID->execute();
    $accountID->bind_result($account_id);
    $accountID->fetch();
    $accountID->close();

    // Store the security questions and answers
    $sqlStoreUserQuestions = $connection->prepare("INSERT INTO security_question_sets (account_id, sec_question_1, sec_answer_1, sec_question_2, sec_answer_2, sec_question_3, sec_answer_3) VALUES (?,?,?,?,?,?,?)");
    $sqlStoreUserQuestions->bind_param('iisisis', $account_id, $sec_quest1, $sec_ans1, $sec_quest2, $sec_ans2, $sec_quest3, $sec_ans3);
    $sqlStoreUserQuestions->execute();
    $sqlStoreUserQuestions->close();

    // Mark registration key as used
    $sqlMarkUsed = $connection->prepare("UPDATE registration_keys SET used = 1 WHERE reg_key = ?");
    $sqlMarkUsed->bind_param("s", $key);
    $sqlMarkUsed->execute();
    $sqlMarkUsed->close();
    $connection->close();

    $_SESSION['USER'] = $account_id;
    $_SESSION['ACCT_TYPE'] = $account_type;
    header("Location: ../home.php");

}
