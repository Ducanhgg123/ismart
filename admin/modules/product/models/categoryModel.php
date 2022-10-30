<?php
function get_list_cat()
{
    $data = db_fetch_array('select * from `tbl_product_cat`');
    $data = format_list_cat($data);
    return $data;
}
function add_cat($data)
{
    return db_insert('tbl_product_cat', $data);
}
function get_num_cat(){
    return db_num_rows('select `id` from `tbl_product_cat`');
}
function get_list_cat_with_limit($start,$num){
    $data = get_list_cat();
    $data=array_slice($data,$start,$num);
    return $data;
}
function get_product_cat_by_id($id){
    return db_fetch_row("select * from `tbl_product_cat` where `id` = ".$id);
}
function update_cat($data,$id){
    return db_update('tbl_product_cat',$data,"`id` = $id");
}
function delete_cat($id){
    return db_delete('`tbl_product_cat`',"`id` = $id");
}