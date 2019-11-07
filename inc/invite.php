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

    $clientOpt = option("Client", 1);
    $adminOpt = option("Admin", 2);
    echo select($client_opt.$admin_opt, $id = 'accountSelection');
    echo button("Generate", "generateKeyRequest()", $id = 'generateKeyBtn');
    $inputKey = input("text", "key", "regKey", "key");
    $inputEmail = input("text", "email", $id = "email", $placeholder = "Email");
    $textArea = textArea("message", "10", "30", $id = "message");
    $p = p($errorMsg, $id = "error");
    $inputSubmit = input("submit", $value = "Email Key", $id = "emailBtn");
    echo form($inputKey.$inputEmail.$textArea.$p.$inputSubmit, "emailInvite.php");
?>
