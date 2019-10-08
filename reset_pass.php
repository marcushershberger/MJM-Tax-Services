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
include('inc/conn.php');
include('inc/php_to_html_functions.php');
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);



if ($connection->connect_error) {
    die("Connection failed.");
}

$registration_key = isset($_GET["key"]) ? $_GET["key"] : "";

$sql = "SELECT id, question FROM security_questions";
$result = $connection->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = array("id"=>$row["id"], "question"=>$row["question"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="main.js"></script>
    <title>MJM</title>
</head>

<form action="db/store_user.php" method="post" id="infoForm">
    <input type="text" name="key" placeholder="Registration Key" value="<?php echo $registration_key ?>" required><br>
    <input type="password" id="pass" name="pass" placeholder="Password" onkeyup="comparePassword()" required><br>
    <input type="password" id="passVerif" name="passVerif" placeholder="Retype Password" onkeyup="comparePassword()" required><br>
    <p>Password must contain: 1 lowercase, 1 uppercase, 1 number, one special character, must be 8 characters long</p><br>
    <input type="checkbox" onchange="showPass()" id="box"> Show Password<br>

    <input type="submit" id="submit" value="Sign Up">
</form>
</body>
</html>
