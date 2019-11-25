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

$reset_key = $_GET['key'];

?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/key_gen.js"></script>
    <title>MJM</title>
</head>

<form action="db/update_user_pass.php" method="post" id="infoForm">
    <input type="text" name="key" placeholder="Registration Key" value="<?php echo $reset_key ?>" required><br>
    <input type="password" id="pass" name="pass" placeholder="Password" onkeyup="comparePassword()" required><br>
    <input type="password" id="passVerif" name="passVerif" placeholder="Retype Password" onkeyup="comparePassword()" required><br>
    <p>Password must contain: 1 lowercase, 1 uppercase, 1 number, one special character, must be 8 characters long</p><br>
    <input type="checkbox" onchange="showPass()" id="box"> Show Password<br>

    <input type="submit" id="submit" value="Reset">
</form>
</body>
</html>
