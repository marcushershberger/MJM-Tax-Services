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

	$username = $_POST["user"];
	$password = $_POST["pass"];

	$checkUser = $connection->prepare("SELECT id FROM users WHERE username = ? or email_addr = ?");
	$checkUser->bind_param("ss", $username, $username);
	$checkUser->execute();
	$checkUser->bind_result($userID);
	$checkUser->fetch();
	$checkUser->close();

    $attemptsIndex = $connection->prepare("SELECT attempts, last_attempt FROM login_attempts WHERE account_id = ?");
    $attemptsIndex->bind_param("i", $userID);
    $attemptsIndex->execute();
    $attemptsIndex->bind_result($numOfAttempts, $lastTime);
    $attemptsIndex->fetch();
    $attemptsIndex->close();

    if ($numOfAttempts >= 5) {

        $nowTime = date("Y-m-d H:i:s");

        $unixTime = strtotime($lastTime)+'1800';
        $newTime = date("Y-m-d H:i:s", $unixTime);

        if($nowTime >= $newTime) {
            $newAttemptLogin = '0';
            $updateTime = $connection->prepare("UPDATE login_attempts SET attempts = ? WHERE account_id = ?");
            $updateTime->bind_param('ii', $newAttemptLogin, $userID);
            $updateTime->execute();
            $updateTime->close();
        } else {
           header("Location: ../". ("login.php?error=3"));
        }

    } elseif ($numOfAttempts < 5) {

        $authUser = $connection->prepare("SELECT id, password_hash, account_type FROM users WHERE username = ? OR email_addr = ?");
        $authUser->bind_param('ss', $username, $username);
        $authUser->execute();
        $authUser->bind_result($id, $hash, $account_type);
        $authUser->fetch();
        $authUser->close();
        $loggedin = password_verify($password, $hash);
        session_start();
        session_regenerate_id();
        if ($loggedin) {
            $_SESSION['USER'] = $id;
            $_SESSION['ACCT_TYPE'] = $account_type;
						$sqlActivityType = $connection->prepare("SELECT id FROM activity_types WHERE name = 'Login'");
		        $sqlActivityType->execute();
		        $sqlActivityType->bind_result($activityType);
		        $sqlActivityType->fetch();
		        $sqlActivityType->close();

						$dateTime = date("Y-m-d H:i:s");

		        $sqlActivity = $connection->prepare("INSERT INTO activities (user_id, activity_type, date_time) VALUES (?,?,?)");
		        $sqlActivity->bind_param("iis", $_SESSION['USER'], $activityType, $dateTime);
		        $sqlActivity->execute();
		        $sqlActivity->close();
        } else {

            $loginNumAttempt = '1';
            $lastAttempt = date("Y-m-d H:i:s");

            $checkForRow = $connection->prepare("SELECT COUNT(*) as c FROM login_attempts WHERE account_id = ?");
            $checkForRow->bind_param('i', $userID);
            $checkForRow->execute();
            $checkForRow->bind_result($userAttempts);
            $checkForRow->fetch();
            $checkForRow->close();

            if ($userAttempts == 0) {

                $loginAttempts = $connection->prepare("INSERT INTO login_attempts (account_id, attempts, last_attempt) VALUES (?,?,?)");
                $loginAttempts->bind_param('iis', $userID, $loginNumAttempt, $lastAttempt);
                $loginAttempts->execute();
                $loginAttempts->close();

            } elseif ($userAttempts > 0) {

                $newAttempts = $numOfAttempts + 1;

                $attempts = $connection->prepare("UPDATE login_attempts  SET attempts = ? WHERE account_id = ?");
                $attempts->bind_param('ii', $newAttempts, $userID);
                $attempts->execute();
                $attempts->close();

                $attemptsLogin = $connection->prepare("UPDATE login_attempts  SET last_attempt = ? WHERE account_id = ?");
                $attemptsLogin->bind_param('si', $lastAttempt, $userID);
                $attemptsLogin->execute();
                $attemptsLogin->close();

            }


            session_unset();
        }
        header("Location: ../". ($loggedin ? "home.php" : "login.php"));
    }
