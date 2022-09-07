<?php
    
    // check login
    function is_login(){
        if (!empty($_SESSION['is_login']))
            return true;
        return false;
    }
    // get fullname by username
    function get_fullname_by_username($username){
        $data=db_fetch_row("select `fullname` from `tbl_users` where `username` = '$username'");
        return $data['fullname'];
    }
?>