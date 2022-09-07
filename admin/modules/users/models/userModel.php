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
    function check_login($username,$password){
        $password=md5($password);
        if (db_num_rows("select * from `tbl_users` where `username` = '$username' and `password` = '$password'")>0)
            return true;
        return false;
    }
    function logout(){
        if (is_login()){
            setcookie('is_login',true,time()-3600);
            setcookie('username',$_SESSION['username'],time()-3600);
            unset($_SESSION['is_login']);
            unset($_SESSION['username']);
            redirect('?mod=users');
        }
    }
    function get_user_by_username($username){
        return db_fetch_row("select * from `tbl_users` where `username` = '$username'");
    }
    function update_new_password($id,$new_pass){
        $data=array(
            'password' => md5($new_pass)
        );
        db_update('`tbl_users`',$data,"`id` = $id");
    }
    function get_list_users(){
        return db_fetch_array("select * from `tbl_users`");
    }
    function check_username_exists($username){
        if (db_num_rows("select * from `tbl_users` where `username` = '$username'")==0)
            return false;
        return true;
    }
    function check_email_exists($email){
        if (db_num_rows("select * from `tbl_users` where `email` = '$email'")>0)
            return true;
        else
            return false;
    }
    function get_user_by_id($id){
        return db_fetch_row("select * from `tbl_users` where `id` = $id");
    }
    function delete_user_by_id($id){
        return db_delete('`tbl_users`',"`id` = $id");
    }
?>