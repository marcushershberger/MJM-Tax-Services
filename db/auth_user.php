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

	$authUser = $connection->prepare("SELECT id, password_hash, account_type FROM users WHERE username = ?");
	$authUser->bind_param('s', $username);
	$authUser->execute();
	$authUser->bind_result($id,$hash,$account_type);
	$authUser->fetch();
    $loggedin = password_verify($password, $hash);
    session_start();
    session_regenerate_id();
    if ($loggedin) {
        $_SESSION['USER'] = $id;
        $_SESSION['ACCT_TYPE'] = $account_type;
    }
    else {
        session_unset();
    }
	header("Location: ../". ($loggedin ? "home.php" : "login.php"));
