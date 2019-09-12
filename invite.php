<?php
    $errorMsg = "";
    if (isset($_GET['errorCode'])) {
        $err = $_GET['errorCode'];
        if ($err == 1) {
            $errorMsg = "Key is not valid";
        }
        else if ($err == 2) {
            $errorMsg = "Email is not valid";
        }
        else {
            $errorMsg = "Key and Email are not valid";
        }
        $errorMsg = $err;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="key_gen.js"></script>
        <title>MJM</title>
    </head>
    <body>
        <select id="accountSelection">
            <option value="1">User</option>
            <!--<option value="2">Admin</option>-->
        </select>
        <button onclick="generateKeyRequest()" id="generateKeyBtn">Generate</button>
        <form action="emailInvite.php" method="post">
            <input type="text" id="key" name="key" class="regKey"><br>
            <input type="text" id="email" name="email" placeholder="Email"><br>
            <p id='error'><?php echo $errorMsg; ?></p>
            <input type="submit" value="Email Key">
        </form>
    </body>
</html>
