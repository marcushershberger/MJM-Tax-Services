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

$key = $_POST['key'];

$sql_id = $connection->prepare("SELECT account_id FROM pw_reset_keys WHERE reset_key = ?");
$sql_id->bind_param("s", $key);
$sql_id->execute();
$sql_id->bind_result($id);
$sql_id->fetch();
$sql_id->close();


$pass = $_POST['pass'];
$hash = password_hash($pass, PASSWORD_BCRYPT);

$sql_pass = $connection->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
$sql_pass->bind_param("si", $hash, $id);
$sql_pass->execute();
$sql_pass->close();

header("Location: ../login.php");