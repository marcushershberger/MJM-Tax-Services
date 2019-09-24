<?php
    
    echo p("Welcome Client");
    echo p("Upload a Document");
    $input = input("file", "document", "application/pdf");
    $uploadFile = "inc/uploadFile.php";
    echo form($input, $uploadFile, "POST");
    $tableContents = tr(th("Files"));
    
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name); // Create a connection to the database.

    // Make sure the database connection was successful.
    if (mysqli_connect_errno()) {
        echo p("Failed to connect: " . mysqli_connect_errno());
    }
    
    $sqlUploads = $conn->prepare("SELECT file_name FROM file_uploads WHERE user = ?");
    $sqlUploads->bind_param('i', $_SESSION['USER']);
	$sqlUploads->execute();
	$sqlUploads->bind_result($filename);
	while ($sqlUploads->fetch()) {
        $cell = td($filename);
        $row = tr($cell);
        $tableContents .= $row;
	}
	echo (table($tableContents));
