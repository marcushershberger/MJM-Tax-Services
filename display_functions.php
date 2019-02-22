<?php
    // This page contains functions for returning pages to users. To use these functions, the 'include(...)' function call must be after the declaration and assignment of $sec_auth to true.
    
    $elem_auth = true;
    include('php_to_html_functions.php');
    
    // Function that returns a page for regular users.
    function userPage() {
        return p("You are a regular user");
    }

    // Function that returns a page for the administrator.
    function adminPage() {
        return p("You are an admin");
    }

    // Uses a control variable to redirect the user if the user tries to access this page directly.
    if (!isset($sec_auth)) {
        header("Location: index.php");
    }
