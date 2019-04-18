<?php
    $data = json_decode($_POST["obj"]);

    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randString = "";
    const STR_LEN = 8;
    for ($i = 0; $i < STR_LEN; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $randString .= $chars[$index];
    }
    
    $type = (int)($data->_type);
    
    include('inc/conn.php');
    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($connection->connect_error) {
        die("Connection failed.");
    }
    
    $sql = "INSERT INTO registration_keys (reg_key, type, used) VALUES ('$randString', $type, 0);";
    $result = $connection->query($sql);
    
    if ($result) {
        echo $randString;
    }
    else {
        echo "NONE";
    }
