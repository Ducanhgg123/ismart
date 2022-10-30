<?php
function get_list_page(){
    return db_fetch_array('select * from `tbl_page`');
}
function get_page_by_id($id){
    return db_fetch_row("select * from `tbl_page` where `id`=$id");
}
?>