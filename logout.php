<?php
	include 'inc/conn.php';
	$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

	if ($conn->connect_error) {
		die("Connection Error".$conn->connect_error);
	}

	session_start();
	$sqlActivityType = $conn->prepare("SELECT id FROM activity_types WHERE name = 'Logout'");
	$sqlActivityType->execute();
	$sqlActivityType->bind_result($activityType);
	$sqlActivityType->fetch();
	$sqlActivityType->close();

	$dateTime = date("Y-m-d H:i:s");

	$sqlActivity = $conn->prepare("INSERT INTO activities (user_id, activity_type, date_time) VALUES (?,?,?)");
	$sqlActivity->bind_param("iis", $_SESSION['USER'], $activityType, $dateTime);
	$sqlActivity->execute();
	$sqlActivity->close();

	// Destroy session variables.
	session_destroy();
	header("Location: index.php?logout=1");
