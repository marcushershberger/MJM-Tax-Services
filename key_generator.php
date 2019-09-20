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
    
    $used = 0;
    $sql = "INSERT INTO registration_keys (reg_key, type, used) VALUES ('$randString', $type, $used);";
    $result = $connection->query($sql);
    
    if ($result) {
        echo $randString;
    }
    else {
        echo "NONE";
    }
