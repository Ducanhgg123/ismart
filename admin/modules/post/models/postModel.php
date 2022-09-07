<?php
function add_post($data){
    return db_insert('`tbl_post`',$data);
}