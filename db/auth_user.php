<?php
	include('../inc/conn.php');
	include('../inc/php_to_html_functions.php');
	include('../inc/validations.php');

	$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

	if ($connection->connect_error) {
		die("Connection Error".$connection->connect_error);
	}
	
	$username = $_POST["user"];
	$password = $_POST["pass"];

	$authUser = $connection->prepare("SELECT password_hash FROM users WHERE username = ?");
	$authUser->bind_param('s', $username);
	$authUser->execute();
	$authUser->bind_result($hash);
	$authUser->fetch();
	
	header("Location: ../". (password_verify($password, $hash) ? "home.php" : "login.php"));
