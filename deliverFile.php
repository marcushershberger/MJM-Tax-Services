<?php

    header("Content-Type: application/pdf");
    $file = "docs/".$_GET['file'];
    readFile($file);
