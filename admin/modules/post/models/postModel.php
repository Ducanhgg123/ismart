<?php
function add_post($data){
    return db_insert('`tbl_post`',$data);
}
function get_list_post(){
    return db_fetch_array('select * from `tbl_post`');
}
function get_cat_name_by_id($id){
    $cat=db_fetch_row("select `title` from `tbl_post_cat` where `id` = $id");
    return $cat['title'];
}
function get_num_post(){
    return db_num_rows('select `id` from `tbl_post`');
}
// function get_num_approved_post(){
//     return db_num_rows("select `id` from `tbl_post` where `status` = 1");
// }
// function get_num_not_approved_post(){
//     return db_num_rows("select `id` from `tbl_post` where `status` = 0");
// }
function get_num_post_by_status($status){
    if ($status==-1)
        return get_num_post();
    return db_num_rows("select * from `tbl_post` where `status` = $status");
}
function get_num_in_bin_post(){
    return db_num_rows("select `id` from `tbl_post` where `status` = 2");
}
function get_status($status){
    if ($status==0)
        return "Chờ xét duyệt";
    else if ($status==1)
        return "Đã đăng";
    return "Thùng rác";
}
function get_list_post_by_status($status,$key){
    if ($status==-1)  // Get all
        return db_fetch_array("select * from `tbl_post` where `title` like '%$key%'");
    return db_fetch_array("select * from `tbl_post` where `status` = $status and `title` like '%$key%'");
}
function get_post_by_id($id){
    return db_fetch_row("select * from `tbl_post` where `id` = $id");
}
function update_post($data,$id){
    return db_update('`tbl_post`',$data,"`id` = $id");
}
function delete_post($id){
    return db_delete('`tbl_post`',"`id` = $id");
}
function approve_post($id){
    $data=array('status' => 1);
    return db_update('`tbl_post`',$data,"`id` = $id");
}
