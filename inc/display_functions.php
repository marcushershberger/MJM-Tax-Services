<?php
    // This page contains functions for returning pages to users.
    
    include('inc/php_to_html_functions.php');
    
    // Function that returns a page for regular users.
    function userPage() {
        return p("You are a regular user");
    }

    // Function that returns a page for the administrator.
    function adminPage() {
        return p("You are an admin");
    }
?>
