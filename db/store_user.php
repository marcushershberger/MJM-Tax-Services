<?php
include('../inc/conn.php');
include('../inc/php_to_html_functions.php');
include('../inc/validations.php');

$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection Error".$connection->connect_error);
}

$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$username = $_POST["user"];
$email = $_POST["email"];
$password = $_POST["pass"];
$passwordVerif = $_POST["passVerif"];
$street = $_POST["street"];
$street2 = $_POST["street2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$key = $_POST["key"];
$phone = "1111111111";
//$sec_quest1 = $_POST["quest1"];
$sec_ans1 = $_POST["sec_ans_1"];
//$sec_quest2 = $_POST["quest2"];
$sec_ans2 = $_POST["sec_ans_2"];
//$sec_quest3 = $_POST["quest3"];
$sec_ans3 = $_POST["sec_ans_3"];

$errors = array();

if (!validUsername($username)) $errors[] = 2;
if (!validEmail($email)) $errors[] = 3;
if (!passwordMatch($password, $passwordVerif)) $errors[] = 4;
if (!validPassword($password)) $errors[] = 5;

if (count($errors) > 0) {
    $errs = json_encode($errors);
    header("Location: ../signup.php?errors=$errs");
    exit();
}




    $sqlValidKey = $connection->prepare("SELECT COUNT(reg_key) as c FROM registration_keys WHERE reg_key = ?");
    $sqlValidKey->bind_param('s', $key);
    $sqlValidKey->execute();
    $sqlValidKey->bind_result($count);
    $sqlValidKey->fetch();
    $count = (int)$count;
    $sqlValidKey->close();
    if ($count == 0) {
        $errors[] = 20;
        $errs = json_encode($errors);
        header("Location: ../signup.php?errors=$errs");
        exit();
    }

    $account_type = 1;
    $security_set = 1000;

    $sqlKeyUsed = $connection->prepare("SELECT used, type FROM registration_keys WHERE reg_key = ?");
    $sqlKeyUsed->bind_param('s', $key);
    $sqlKeyUsed->execute();
    $sqlKeyUsed->bind_result($used, $type);
    $sqlKeyUsed->fetch();
    $sqlKeyUsed->close();
    $used = (int)$used;

    if ($used) {
        $errors[] = 30;
        $errs = json_encode($errors);
        header("Location: ../signup.php?errors=$errs");
        exit();
    }

    //Compare users

    // Warning: mysqli_num_rows() expects parameter 1 to be mysqli_result

    $sqlComp = $connection->prepare("SELECT username FROM users WHERE username = ? OR email_addr = ?");
    $sqlComp->bind_param('s', $username, $username);
    $sqlComp->execute();
    $sqlComp->fetch();

    if(mysqli_num_rows($sqlComp) > 0) {
        echo "Username is alreay taken";
    } else {
        echo "ok";
    //End compare users

    $pwh = password_hash($password, PASSWORD_BCRYPT);

    $sqlCreateUser = $connection->prepare("INSERT INTO users (first_name, last_name, username, password_hash, email_addr, street_addr, street_addr_2, city, state, zip, phone_num, account_type, security_set) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sqlCreateUser->bind_param('sssssssssssii', $firstname, $lastname, $username, $pwh, $email, $street, $street2, $city, $state, $zip, $phone, $account_type, $security_set);
    $sqlCreateUser->execute();
    $sqlCreateUser->close();

    $sqlMarkUsed = $connection->prepare("UPDATE registration_keys SET used = 1 WHERE reg_key = ?");
    $sqlMarkUsed->bind_param("s", $key);
    $sqlMarkUsed->execute();
    $sqlMarkUsed->close();
    $connection->close();

    echo p("You have successfully created an account");


}
	
