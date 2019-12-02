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

//This page requires a user to have a valid password reset key
// The user must also correctly answer the security questions before the new passwords will take imagelayereffect

include('inc/conn.php');
include('inc/validations.php');
include 'inc/php_to_html_functions.php';

?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/main.js"></script>
    <title>MJM</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
  <?php include 'inc/header.php'; ?>
  <div id="container">
    <h1>Password Reset</h1>
      <?php

      if (isset($_GET["errors"])) {
          $error = $_GET["errors"];
          if ($error == 1) {
              echo p("Registration Key has already been used. Please request another reset key.");
          }
      } elseif(isset($_GET['key'])) {
          $reset_key = $_GET['key'];
      } else {
          echo p("Registration Key Required.");
      }
      ?>
    <form action="db/update_user_pass.php?<?php if(isset($_GET['key'])) {
        include 'db/security_questions.php';
        echo "id=".$questionSet1.$questionSet2; }
        else {
            echo"id=0";
        } ?>" method="post" id="infoForm">

      <input type="text" name="key" placeholder="Registration Key" value="<?php if(isset($_GET['key'])) {
          echo $reset_key;
      } else {
          echo "No Registration Key";
    }?>" required><br>
      <?php
      if(isset($_GET['key'])) {
          echo(p($questions[0]));
      } else {
      }
      ?>
      <input type="text" name="securityQuestion1" placeholder="Security Question1" required><br>
      <?php

      if(isset($_GET['key'])) {
          echo(p($questions[1]));
      } else {

      }
      ?>
      <input type="text" name="securityQuestion2" placeholder="Security Question2" required><br><br><br>
      <input type="password" id="pass" name="pass" placeholder="Password" onkeyup="comparePassword()" required><br>
      <input type="password" id="passVerif" name="passVerif" placeholder="Retype Password" onkeyup="comparePassword()" required><br>
      <p>Password must contain: 1 lowercase, 1 uppercase, 1 number, one special character, must be 8 characters long</p><br>
      <label class="checkContainer">Show Password<input type="checkbox" onchange="showPass()" id="box"><span class="checkmark"></span></label><br><br>
      <input type="submit" id="submit" value="Reset">
    </form>
  </div>
  <div id="spacer"></div>
  <?php include 'inc/footer.php'; ?>
</body>
</html>
