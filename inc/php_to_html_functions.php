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


    // PHP to HTML
    // These functions return HTML elements for an easier way to build HTML elements with PHP.
    // Each function can take 4 arguments (except a, which has a second mandatory argument, $link).
    // element($type, $contents, $class, $id, $style)
    // $class, $id, and $style are optional arguments.

    // <p> tag
    function p($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<p id='$id' class='$class' style='$style'>$contents</p>";
    }

    // <div> tag
    function div($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<div id='$id' class='$class' style='$style'>$contents</div>";
    }

    // <h1> tag
    function h1($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<h1 id='$id' class='$class' style='$style'>$contents</h1>";
    }

    // <h2> tag
    function h2($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<h2 id='$id' class='$class' style='$style'>$contents</h1>";
    }

    // <h3> tag
    function h3($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<h3 id='$id' class='$class' style='$style'>$contents</h1>";
    }

    // <span> tag
    function span($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<span id='$id' class='$class' style='$style'>$contents</span>";
    }

    // <button> tag
    function button($contents, $onclick = ' ', $class = ' ', $id = ' ', $style = ' ') {
        return "<button onclick='$onclick' id='$id' class='$class' style='$style'>$contents</button>";
    }

    // <a> tag
    function a($contents, $link, $class = ' ', $id = ' ', $style = ' ') {
        return "<a href='$link' id='$id' class='$class' style='$style'>$contents</a>";
    }

    // <option>
    function option($contents, $value, $class = ' ', $id = ' ', $style = ' ') {
        return "<option id='$id' class='$class' style='$style' value='$value'>$contents</option>";
    }

    // <input> tag
    function input($type, $name, $accept = ' ', $placeholder = ' ',  $value = ' ', $class = ' ', $id = ' ', $style = ' ') {
        return "<input type='$type' name='$name' accept='$accept' class='$class' id='$id' style='$style' placeholder='$placeholder' />";
    }

    // <table> tag
    function table($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<table id='$id' class='$class' style='$style'>$contents</table>";
    }

    // <tr> tag
    function tr($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<tr id='$id' class='$class' style='$style'>$contents</tr>";
    }

    // <th> tag
    function th($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<th id='$id' class='$class' style='$style'>$contents</th>";
    }

    // <td> tag
    function td($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<td id='$id' class='$class' style='$style'>$contents</td>";
    }

    // Clickable <td> tag
    function tdClickable($contents, $class = ' ', $id = ' ', $style = ' ', $onclick = ' ') {
        return "<td id='$id' class='$class' style='$style' onclick='$onclick'>$contents</td>";
    }

    // <form> tag
    // Submit button within form will have class of submitButton'
    function form($contents, $action, $method = "POST", $class = ' ', $id = ' ', $style = ' ') {
        return "<form action='$action' method='$method' id='$id' class='$class' style='$style'  enctype='multipart/form-data' >$contents".input("submit", "submit", " ", " ", " ", " ", "submit", "submitButton")."</form>";
    }

    // <form> that only has a submit button
    function button_form($contents, $action, $method = "POST", $class = ' ', $id = ' ', $style = ' ') {
        return "<form action='$action' method='$method' id='$id' class='$class' style='$style'  enctype='multipart/form-data' ><input type='submit' name='submit' value='$contents' /></form>";
    }

    // <select> tag
    function select($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<select id='$id' class='$class' style='$style'>$contents</select>";
    }

    // <textarea> tag
    function textArea($name, $rows, $columns, $class = ' ', $id = ' ', $style = ' ') {
        return "<textarea name='$name' rows='$rows' cols='$columns' name='$name' id='$id' class='$class'></textarea>";
    }

    // <script> tag for including .js files
    function script($src) {
        return "<script src='$src'></script>";
    }

    // <br> tag
    function br() {
        return "<br>";
    }

    // <img> tag
    function img($src, $class = ' ', $id = ' ', $style = ' ') {
      return "<img src='$src' class='$class' id='$id' style='$style' />";
    }

    // <link> tag for including .css files
    function cssLink($src) {
      return "<link rel='stylesheet' type='text/css' href='$src'>";
    }
