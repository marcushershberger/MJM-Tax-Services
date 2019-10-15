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


    include 'doc_file_path.php';
    $tableContents = tr(th("Files"));
    $sqlUploads = $conn->prepare("SELECT file_name FROM file_uploads WHERE user = ?");
    $sqlUploads->bind_param('i', $_SESSION['USER']);
	$sqlUploads->execute();
	$sqlUploads->bind_result($filename);
	while ($sqlUploads->fetch()) {
        $cell = td(a($filename, "inc/deliverFile.php?file=$filename"));
        $row = tr($cell);
        $tableContents .= $row;
	}
	echo table($tableContents);
?>