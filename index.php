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

// Landing page


  session_start();
  // If the user is already logged in, redirect to the home page
  if (isset($_SESSION['USER']) || isset($_SESSION['ACCT_TYPE'])) {
    header("Location: home.php");
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>MJM</title>
    </head>
    <body>
	      <?php include 'inc/header.php'; if (isset($_GET['logout']) && $_GET['logout']) echo p("You have been logged out."); ?>
      <div id="container">
        <h1>Welcome to the tax services of Matthew J. Mize</h1>
        <a href="signup.php">
          <button class="mainLinkBtn">Sign Up</button>
        </a><br>
        <a href="login.php">
          <button class="mainLinkBtn">Log In</button>
        </a>
      </div>
      <div id="spacer"></div>
      <?php include 'inc/footer.php'; ?>
    </body>
</html>
