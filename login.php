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

// This page is a login page for existing users

  session_start();
  // If user is logged in, redirect to the home page
  if (isset($_SESSION['USER']) || isset($_SESSION['ACCT_TYPE'])) {
    header("Location: home.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="main.js"></script>
    <title>MJM</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <div id="container">
        <form action="db/auth_user.php" method="post">
            <input type="text" id="username" name="user" placeholder="Username"><br>
            <input type="password" id="pass" name="pass" placeholder="Password"><br>
            <input type="submit" id="submit" value="Log In">
        </form>
        <?php
            // Handle error messages
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == 1) {
                    echo p("Invalid login");
                }
                elseif ($error == 2) {
                    echo p("That user does not exist");
                }
                elseif ($error == 3) {
                    echo p("You have to many failed login attempts.", 'failedLogin', 'failedLogin');
                }

            }
        ?>
        <br>
        <a href="generate_reset_key.php" id="pass_reset">Reset Password</a>
      </div>
      <div id="spacer"></div>
      <?php include 'inc/footer.php'; ?>
</body>
</html>
