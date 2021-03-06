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


    session_start();
    // Check that user is authorized to call this script
    if (!isset($_SESSION['USER'])) header("Location: login.php");
    if (isset($_SESSION['USER'])) {
        if ($_SESSION['ACCT_TYPE'] == 1) header("Location: home.php");
        else if ($_SESSION['ACCT_TYPE'] == 2) include 'inc/emailInvite.php';
    }
?>
