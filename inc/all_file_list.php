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
    // Start a table that will contain a list of uploaded files.

    echo h1("Uploaded Files");
    $fileTableContents = tr(th("Files"));

    // Query the database for a list of files that have been uploaded by users.
    $sqlUploads = $conn->prepare("SELECT file_name FROM file_uploads");
    $sqlUploads->execute();
    $sqlUploads->bind_result($filename);
    // For each file that exists...
    while ($sqlUploads->fetch()) {
        // Each table cell will contain a link to a file
        $cell = td(a($filename, "inc/deliverFile.php?file=$filename"));
        // Each table row will contain one cell
        $row = tr($cell);
        // Append the row to the table
        $fileTableContents .= $row;
    }

    // Echo the table.
    echo table($fileTableContents);
