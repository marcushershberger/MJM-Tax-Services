<?php

	// Destroy session variables.
	session_start();
	session_destroy();
	header("Location: index.php?logout=1");