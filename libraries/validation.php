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
?>