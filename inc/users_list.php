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
    echo h1("Users");
    
    // Query the database for a list of users and their count of uploaded documents.
    $usersTableContents = tr(td("User").td("Uploads"));
    $sqlUsers = $conn->prepare("SELECT id, first_name, last_name FROM users");
    $sqlUsers->execute();
    $sqlUsers->bind_result($id, $firstname, $lastname);
    $sqlUsers->store_result(); // Needed to make sure that calls are not out of sync.
    while ($sqlUsers->fetch()) {
        // Select the count of uploades for each user.
        $sqlDocs = $conn->prepare("SELECT COUNT(*) FROM file_uploads WHERE user = ?");
        $sqlDocs->bind_param("i", $id);
        $sqlDocs->execute();
        $sqlDocs->bind_result($count);
        $sqlDocs->fetch();
        $sqlDocs->close();
        $conn->next_result();
        $nameCell = td("$firstname $lastname");
        $uploadsCell = td($count);
        $row = tr($nameCell.$uploadsCell);
        $usersTableContents .= $row;
    }
    
    // Echo the table of upload counts.
    echo table($usersTableContents);
    
