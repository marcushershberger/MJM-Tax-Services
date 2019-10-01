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
    echo p("Welcome Admin");
    echo h1("Uploaded Files");
    
    // Create a database connection.
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    
    // Start a table that will contain a list of uploaded files.
    $fileTableContents = tr(th("Files"));
    
    // Query the database for a list of files that have been uploaded by users.
    $sqlUploads = $conn->prepare("SELECT file_name FROM file_uploads");
    $sqlUploads->execute();
    $sqlUploads->bind_result($filename);
    while ($sqlUploads->fetch()) {
        $cell = td($filename);
        $row = tr($cell);
        $fileTableContents .= $row;
    }
    
    // Echo the table.
    echo table($fileTableContents);
    echo h1("Registration Links");
    $linkTableContents = tr(th("Links").th("Type").th("Status"));
    
    // Query the database for a list of registration keys that have been generated. This includes the key, the type, and its status.
    $sqlLinks = $conn->prepare("SELECT reg_key, type, used FROM registration_keys ORDER BY id ASC");
    $sqlLinks->execute();
    $sqlLinks->bind_result($regKey, $type, $used);
    while ($sqlLinks->fetch()) {
        $keyCell = td($regKey);
        $typeCell = td($type == 0 ? "Client" : "Admin");
        $usedCell = td($used == 1 ? "Used" : "Valid");
        $row = tr($keyCell.$typeCell.$usedCell);
        $linkTableContents .= $row;
    }
    
    // Echo the table.
    echo table($linkTableContents);
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
    
