<?php
function get_list_post(){
    return db_fetch_array("select * from `tbl_post` where `status` = 1");
}
function get_post_by_id($id){
    return db_fetch_row("select * from `tbl_post` where `id` = $id and `status` = 1");
}
