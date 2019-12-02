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
    session_start();
    // If the user is not logged in, redirect
    if (!isset($_SESSION['USER'])) header("Location: login.php");

?>
<html>
  <head>
    <title>Home</title>
    <script src="js/folder_view.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <?php include 'inc/header.php'; ?>
    <div id="container">
    <?php
      // If the user is a client, include the client elements
      // If the user is an admin, include the admin elements
      if ($_SESSION['ACCT_TYPE'] == 1) {
          include 'inc/client_page.php';
      }
      else if ($_SESSION['ACCT_TYPE'] == 2){
          include 'inc/admin_page.php';
      }
      ?>
    </div>
    <div id="spacer"></div>
    <?php include 'inc/footer.php'; ?>
  </body>
</html>
