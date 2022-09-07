<?php
function add_cat($data)
{
    return db_insert('tbl_post_cat', $data);
}
function get_list_cat()
{
    $data = db_fetch_array('select * from `tbl_post_cat`');
    $data = format_list_cat($data);
    return $data;
}
function format_list_cat($data, $parent_id = 0, $level = 0)
{
    $list_cat = array();
    foreach ($data as $cat)
        if ($cat['parent_id'] == $parent_id) {
            $cat['level'] = $level;
            $list_cat[] = $cat;
            $sub_cat = format_list_cat($data, $cat['id'], $level + 1);
            $list_cat = array_merge($list_cat, $sub_cat);
        }
    return $list_cat;
}
function update_cat($data,$id){
    return db_update('`tbl_post_cat`',$data,"`id` = $id");
}
function delete_cat($id){
    return db_delete('`tbl_post_cat`',"`id` = $id");
}
