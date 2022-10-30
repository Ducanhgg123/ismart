<?php
function add_cat($data)
{
    return db_insert('tbl_post_cat', $data);
}
function get_list_cat()
{
    $data = db_fetch_array('select * from `tbl_post_cat`');
    // show_array($data);
    // die();
    $data = format_list_cat($data);
    return $data;
}
function update_cat($data,$id){
    return db_update('`tbl_post_cat`',$data,"`id` = $id");
}
function delete_cat($id){
    return db_delete('`tbl_post_cat`',"`id` = $id");
}
