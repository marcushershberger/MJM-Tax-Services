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
    echo h1("Registration Links");
    $linkTableContents = tr(th("Links").th("Type").th("Status"));

    // Query the database for a list of registration keys that have been generated. This includes the key, the type, and its status.
    $sqlLinks = $conn->prepare("SELECT reg_key, type, used FROM registration_keys ORDER BY id ASC");
    $sqlLinks->execute();
    $sqlLinks->bind_result($regKey, $type, $used);
    // For each registration key...
    while ($sqlLinks->fetch()) {
        $keyCell = td($regKey);
        $typeCell = td($type == 0 ? "Client" : "Admin");
        $usedCell = td($used == 1 ? "Used" : "Valid");
        // Append cells to row
        $row = tr($keyCell.$typeCell.$usedCell);
        // Append row to table
        $linkTableContents .= $row;
    }

    // Echo the table.
    echo table($linkTableContents);
