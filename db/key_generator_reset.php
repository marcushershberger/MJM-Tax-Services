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

//if (!isset($_POST['email'])) header("Location: index.php");
include "key_generator.php";

include('../inc/conn.php');
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection failed.");
}

$user_email = $_POST['email'];

$sql_userid = $connection->prepare("SELECT id FROM users WHERE email_addr = ?");
$sql_userid->bind_param("s", $user_email);
$sql_userid->execute();
$sql_userid->bind_result($id);

if ($sql_userid->fetch()) {
    $sql_userid->close();
    $used = 0;
    $sql = "INSERT INTO pw_reset_keys (reset_key, account_id, used) VALUES (?, ?, ?)";
    $sql_insert = $connection->prepare($sql);
    $sql_insert->bind_param("sii", $randString, $id, $used);
    $sql_insert->execute();

    include "../inc/emailKeyReset.php";
    header("Location: reset_message.php");

} else {
    header("Location: generate_reset_key.php?errorCode=2");
}
