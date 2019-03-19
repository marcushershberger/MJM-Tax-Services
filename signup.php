<?php
    include('inc/conn.php');
    include('inc/php_to_html_functions.php');
    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($connection->connect_error) {
        die("Connection failed.");
    }
    
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
    <body onload="populateStateDropdown()">
        <form action="store_user.php" method="post" id="infoForm">
            <input type="text" name="fname" placeholder="First Name"><br>
            <input type="text" name="lname" placeholder="Last Name"><br>
            <input type="text" name="user" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email Address"><br>
            <input type="password" name="pass" placeholder="Password"><br>
            <input type="password" name="passVerif" placeholder="Retype Password"><br>
            <input type="text" name="street" placeholder="Street"><br>
            <input type="text" name="street2" placeholder="Street2 "><br>
            <input type="text" name="city" placeholder="City"><br>
            <select id="state" name="state" form="infoForm">
                <option value="" disabled selected>State</option>
            </select><br>
            <input type="number" name="zip" placeholder="ZIP"><br>
            <input type="text" name="key" placeholder="Registration Key"><br>
        <p>Answer 3 security questions (answers are not case sensitive)</p><br>
        <?php
            echo "<select  id='1' onchange='removeSelections(this.value, this.id)'>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_1" placeholder="Answer"><br>
        <?php
            echo "<select  id='2' onchange='removeSelections(this.value, this.id)'>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_2" placeholder="Answer"><br>
        <?php
            echo "<select  id='3' onchange='removeSelections(this.value, this.id)'>";
            echo "<option value='' disabled selected>Select a security question...</option>";
            for ($i = 0; $i < count($questions); $i++) {
                echo option($questions[$i]["question"], $questions[$i]["id"]);
            }
            echo "</select><br>";
        ?>
        <input type="text" name="sec_ans_3" placeholder="Answer"><br>
            <input type="submit" value="Sign Up">
        </form>
    </body>
</html>
