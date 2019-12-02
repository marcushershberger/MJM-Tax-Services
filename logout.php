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

//This script will log out the current user. If there is no current login, the user will be redirected

	// Include database connection information
	include 'inc/conn.php';
	$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

	if ($conn->connect_error) {
		die("Connection Error".$conn->connect_error);
	}

	session_start();
	// If user is not logged in, redirect
	if (!isset($_SESSION['USER'])) header ("Location: ./index.php");

	//SQL query to get id of activity type 'logout'
	$sqlActivityType = $conn->prepare("SELECT id FROM activity_types WHERE name = 'Logout'");
	$sqlActivityType->execute();
	$sqlActivityType->bind_result($activityType);
	$sqlActivityType->fetch();
	$sqlActivityType->close();

	// Get current datetime
	$dateTime = date("Y-m-d H:i:s");

	// SQL query to log an instance of the user logging out.
	$sqlActivity = $conn->prepare("INSERT INTO activities (user_id, activity_type, date_time) VALUES (?,?,?)");
	$sqlActivity->bind_param("iis", $_SESSION['USER'], $activityType, $dateTime);
	$sqlActivity->execute();
	$sqlActivity->close();

	// Destroy session variables.
	session_destroy();
	header("Location: index.php?logout=1");
