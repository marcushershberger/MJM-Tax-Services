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
    if (!isset($_SESSION['USER'])) header("Location: login.php");
    
?>
<html>
<head>
    <title>Home</title>
</head>
<body>
<?php if ($_SESSION['ACCT_TYPE'] == 1) {
        include 'inc/client_page.php';
    }
    else {
        include 'inc/admin_page.php';
    }

    
/* SESSION INFORMATION WILL RESIDE HERE */

?>
</body>
</html>
