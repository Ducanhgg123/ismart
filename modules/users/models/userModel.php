<?php
    function user_exist($username,$email){
        $num_users=db_num_rows("select * from `tbl_users` where `username` = '$username' and `email` = '$email'");
        if ($num_users>0)
            return true;
        return false;
    }
    function add_user($data){
        db_insert('tbl_users',$data);
    }
    function activeAccount($active_token){
        return db_update('`tbl_users`',array("is_active" => 1),"`active_token` = '$active_token'");
    }
    function check_active_account($active_token){
        if (db_num_rows("select * from `tbl_users` where `active_token` = '$active_token' and `is_active` = '0'")>0)
            return true;
        return false;
    }
    function check_login($username,$password){
        $password=md5($password);
        if (db_num_rows("select * from `tbl_users` where `username` = '$username' and `password` = '$password'")>0)
            return true;
        return false;
    }
    function logout(){
        if (isset($_SESSION['is_login'])){
            unset($_SESSION['is_login']);
            unset($_SESSION['username']);
        }
    }
    function check_email_exists($email){
        if (db_num_rows("select * from `tbl_users` where `email` = '$email'")>0)
            return true;
        else
            return false;
    }
    function update_reset_token($email,$reset_token){
        return db_update('`tbl_users`',array("reset_token" => $reset_token),"`email` = '$email'");
    }
    function check_reset_token($reset_token){
        if (db_num_rows("select * from `tbl_users` where `reset_token` = '$reset_token'")>0)
            return true;
        return false;
    }
    function update_password($password,$reset_token){
        return db_update('`tbl_users`',array("password" => md5($password)),"`reset_token` = '$reset_token'");
    }
?>