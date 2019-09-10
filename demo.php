<?php
    include("inc/php_to_html_functions.php");
    
    $p = p("This is a paragraph element instide a div.");
    echo div($p, "div", "one", "width:200px; height:200px; background-color:green; color:white;");
    
    echo h1("This is a heading element", "h1", "two", "font-family:sans-serif; color:navy");

    $span = span("emphasis", "span", "three", "font-weight:bold");
    echo p("This sentence has ".$span.".");
