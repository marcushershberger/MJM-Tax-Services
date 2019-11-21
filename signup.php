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
    if (isset($_SESSION['USER']) || isset($_SESSION['ACCT_TYPE'])) {
      header("Location: home.php");
    }
    include('inc/conn.php');
    include('inc/php_to_html_functions.php');


    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);



    if ($connection->connect_error) {
        die("Connection failed.");
    }

    $registration_key = isset($_GET["key"]) ? $_GET["key"] : "";

    $sql = "SELECT id, question FROM security_questions ORDER BY id ASC";
    $result = $connection->query($sql);

    $questions = [];
    $serverq = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = array("id"=>$row["id"], "question"=>$row["question"]);
        $serverq[] = $row["question"];
    }
    $_SESSION['questions'] = $serverq;
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="js/main.js"></script>
        <title>MJM</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
    </head>
    <body onload="populateStateDropdown()">
      <div id="container">
        <form action="db/store_user.php" method="post" id="infoForm">
            <input type="text" name="fname" placeholder="First Name" required><br>
            <input type="text" name="lname" placeholder="Last Name" required><br>
            <input type="text" name="user" placeholder="Username" required><br>
            <p>Username must be within 6 - 20 characters.</p>
            <input type="text" id="email" name="email" placeholder="Email Address" onkeyup="valEmail()" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required><br>
            <input type="password" id="pass" name="pass" placeholder="Password" onkeyup="comparePassword()" required><br>
            <input type="password" id="passVerif" name="passVerif" placeholder="Retype Password" onkeyup="comparePassword()" required><br>
            <p>Password must contain: 1 lowercase, 1 uppercase, 1 number, one special character, must be 8 characters long</p><br>
            <input type="checkbox" onchange="showPass()" id="box"> Show Password<br>
            <input type="number" name="phoneNum" placeholder="Phone Number" pattern="\d{3}\d{3}\d{4}" required><br>
            <input type="text" name="street" placeholder="Street" required><br>
            <input type="text" name="street2" placeholder="Street2 "><br>
            <input type="text" name="city" placeholder="City" required><br>
            <select id="state" name="state" form="infoForm" required>
                <option value="" disabled selected>State</option>
            </select><br>
            <input type="number" name="zip" placeholder="ZIP" required><br>
            <input type="text" name="key" placeholder="Registration Key" value="<?php echo $registration_key ?>" required><br>
        <p>Answer 3 security questions (answers are not case sensitive)</p><br>
        <?php
            echo "<select  id='1' name='quest1' <!--onchange='removeSelections(this.value, this.id)'-->>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_1" placeholder="Answer" required><br>
        <?php
            echo "<select  id='2' name='quest2' <!--onchange='removeSelections(this.value, this.id)'-->>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_2" placeholder="Answer" required><br>
        <?php
            echo "<select  id='3' name='quest3' <!--onchange='removeSelections(this.value, this.id)'-->>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_3" placeholder="Answer" required><br>
            <input type="submit" id="submit" value="Sign Up">
        </form>
      </div>
    </body>
</html>
