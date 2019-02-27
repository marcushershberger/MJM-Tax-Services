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
        <input type="submit" value="Sign Up">
    </form>
    <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            $elem_auth = true;
            include('php_to_html_functions.php');
        }
    ?>
</body>
</html>
