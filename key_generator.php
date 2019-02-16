<?php
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randString = "";
    const STR_LEN = 8;
    for ($i = 0; $i < STR_LEN; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $randString .= $chars[$index];
    }
    echo $randString;
?>