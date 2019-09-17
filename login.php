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
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="main.js"></script>
    <title>MJM</title>
</head>
<body>
    <form action="db/auth_user.php" method="post">
        <input type="text" name="user" placeholder="Username"><br>
        <input type="password" name="pass" placeholder="Password"><br>
        <input type="submit" id="submit" value="Log In">
    </form>
    <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            include('inc/php_to_html_functions.php');
            if ($error == 1) {
                echo p("Password is incorrect");
            }
            elseif ($error == 2) {
                echo p("That user does not exist");
            }
            elseif ($error = 99) {
                echo p("Username or password incorrect");
            }
        }
    ?>
</body>
</html>
