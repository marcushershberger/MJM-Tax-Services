<?php
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

    // <span> tag
    function span($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<span id='$id' class='$class' style='$style'>$contents</span>";
    }

    // <button> tag
    function button($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<button id='$id' class='$class' style='$style'>$contents</button>";
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
    function input($type, $name, $accept = ' ', $class = ' ', $id = ' ', $style = ' ') {
        return "<input type='$type' name='$name' accept='$accept' class='$class' id='$id' style='$style' />";
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

    // <form> tag
    // Submit button within form will have class of submitButton'
    function form($contents, $action, $method = "POST", $class = ' ', $id = ' ', $style = ' ') {
        return "<form action='$action' method='$method' id='$id' class='$class' style='$style'  enctype='multipart/form-data' >$contents".input("submit", "submit", " ", "submitButton")."</form>";
    }
