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
    $data = format_list_cat($data);
    $data=array_slice($data,$start,$num);
    return $data;
}