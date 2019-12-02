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

// These functions are used to validate user information input

    const USERNAME_MIN = 6;
    const USERNAME_MAX = 20;
    const EMAIL_MIN = 5;
    const EMAIL_MAX = 50;
    const PASS_MIN = 8;
    const PASS_MAX = 25;
    const ZIP_MIN = 5;
    const ZIP_MAX = 10;
    const PHONE_MIN = 10;
    const PHONE_MAX = 17;
    const CITY_MIN = 2;
    const CITY_MAX = 30;
    const STATE_LENGTH = 2;
    const NAME_MIN = 1;
    const NAME_MAX = 20;
    const ADDRESS_MIN = 1;
    const ADDRESS_MAX = 50;
    const INVALID_PASS_CHARS = array('"', "'","=", ";");

    // Make sure all characters are valid
    function noInvalidChars($str) {
        foreach (INVALID_PASS_CHARS as $char) {
            if (substr_count($char, $str) > 0) {
                return false;
            }
        }
        return true;
    }

    // Make sure username fits the requirements
    function validUsername($username_) {
        $length = strlen($username_);
        return $length >= USERNAME_MIN && $length <= USERNAME_MAX && noInvalidChars($username_);
    }

    // Make sure email is in a valid format
    function validEmail($email_) {
        $length = strlen($email_);
        $validLength = $length >= EMAIL_MIN && $length <= EMAIL_MAX; //
        $amperstat = substr_count($email_, "@") == 1;  //
        if ($amperstat) {
            list($user, $domain) = explode("@", $email_);
        }
        else {
            return false;
        }
        $validUserLength = strlen($user) > 0; //
        $period = substr_count($domain, ".") > 0; //
        $domainList = explode(".", $domain);
        $tlDomain = strlen($domainList[count($domainList) - 1]) > 0; //
        return $validLength && $validUserLength && $amperstat && $period && $tlDomain && noInvalidChars($email_);
    }

    // Make sure the password fits the format
    function validPassword($password_) {
        $length = strlen($password_);
        $validLength = $length >= PASS_MIN && $length <= PASS_MAX;
        return $validLength && noInvalidChars($password_);
    }

    // Make sure phone number is in a valid format
    function validPhone($phone_) {
 	     $length = strlen($phone_);
	     $validLength = $length >= PHONE_MIN && $length <= PHONE_MAX;
	     return $validLength && noInvalidChars($phone_);
    }

    // Make sure street address is in a valid format
    function validAddress($address_) {
	     $length = strlen($address_);
	     $validLength = $length >= ADRESS_MIN && $length <= ADDRESS_MAX;
	     return $validLength && noInvalidChars($address_);
    }

    // Make sure both supplied passwords are the same
    function passwordMatch($pass1, $pass2) {
        return $pass1 == $pass2;
    }
