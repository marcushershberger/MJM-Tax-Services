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
        return "<h1 id='$id' class='$class' style='$style'>=$contents</h1>";
    }

    // <span> tag
    function span($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<span id='$id' class='$class' style='$style'>$contents</span>";
    }

    // <button> tag
    function button($contents, $class = ' ', $id = ' ', $style = ' ') {
        return "<button id='$id' class='$class' style='$style'>$contents</button>";
    }

    function a($contents, $link, $class = ' ', $id = ' ', $style = ' ') {
        return "<a href='$link' id='$id' class='$class' style='$style'>$contents</a>";
    }
    
    function option($contents, $value, $class = ' ', $id = ' ', $style = ' ') {
        return "<option id='$id' class='$class' style='$style' value='$value'>$contents</option>";
    }
