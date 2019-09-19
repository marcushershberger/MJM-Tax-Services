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
    include("inc/php_to_html_functions.php");
    
    $p = p("This is a paragraph element instide a div.");
    echo div($p, "div", "one", "width:200px; height:200px; background-color:green; color:white;");
    
    echo h1("This is a heading element", "h1", "two", "font-family:sans-serif; color:navy");

    $span = span("emphasis", "span", "three", "font-weight:bold");
    echo p("This sentence has ".$span.".");
