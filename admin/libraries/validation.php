<?php
    // Check username
    function is_username($username){
        $pattern="/^[0-9a-zA-Z_-]{6,32}$/";
        if (preg_match($pattern,$username,$matches))
            return true;
        return false;
    }
    // Check password
    function is_password($password){
        $pattern="/^([A-Z]){1}([\w_\.!@#$%&*()]+){5,31}$/";
        if (preg_match($pattern,$password,$matches))
            return true;
        return false;
    }
    // Check email
    function is_email($email){
        $pattern="/^([A-Za-z0-9_-]){1,}@([\w_\.!@#$%&*()]+){1,}$/";
        
        if (preg_match($pattern,$email,$matches))
            return true;
        return false;
    }
    // Check phone number
    function is_phone_number($phone_numer){
        $pattern="/^[0-9]+$/";
        if (preg_match($pattern,$phone_numer,$matches))
            return true;
        return false;
    }
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
?>