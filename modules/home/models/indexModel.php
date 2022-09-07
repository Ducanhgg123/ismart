<?php
    // Get list users
    function get_list_users(){
        return db_fetch_array("select * from `tbl_users`");
    }
    // Get a user by id
    function get_user_by_id($id){
        return db_fetch_row("select * from `tbl_users` where user_id = $id");
    }
?>