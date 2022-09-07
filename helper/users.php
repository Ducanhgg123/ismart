<?php
    // Show the previous value in form
    function show_value($field){
        global $$field;
        if (!empty($$field))
            echo $$field;
    }
    // Print validation error
    function print_error($field){
        global $error;
        if (!empty($error[$field]))
            echo "<p class='text-red'>".$error[$field]."</p>";
    }
    // check login
    function is_login(){
        if (!empty($_SESSION['is_login']))
            return true;
        return false;
    }
?>