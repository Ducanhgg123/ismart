<?php 
function add_product($data){
    return db_insert('`tbl_product`',$data);
}
function get_list_cat(){
    return format_list_cat(db_fetch_array('select * from `tbl_product_cat`'));
}
function get_cat_name_by_id($id){
    $arr=db_fetch_row("select `title` from `tbl_product_cat` where `id` = $id");
    return $arr['title'];
}
function get_list_product($status,$key){
    if ($status == -1)
        return db_fetch_array("select * from `tbl_product` where `name` like '%$key%'");
    else
        return db_fetch_array("select * from `tbl_product` where `name` like '%$key%' and `status` = $status");
}
function get_num_product_by_status($status){
    if ($status != -1)
        return db_num_rows("select `id` from `tbl_product` where `status` = $status");
    else 
        return db_num_rows("select `id` from `tbl_product`");
}
function get_product_by_id($id){
    return db_fetch_row("select * from `tbl_product` where `id` = $id");
}
function update_product($data,$id){
    return db_update('`tbl_product`',$data,"`id` = $id");
}
function delete_product($id){
    return db_delete('`tbl_product`',"`id` = $id");
}
function approve_product($id){
    return db_update('`tbl_product`',array('status' => 1),"`id` = $id");
}