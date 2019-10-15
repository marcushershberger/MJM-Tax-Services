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
	<?php include 'inc/php_to_html_functions.php'; if (isset($_GET['logout']) && $_GET['logout']) echo p("You have been logged out."); ?>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Log In</a>
        <a href="request.php">Request</a>
    </body>
</html>
