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
