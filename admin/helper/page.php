<?php
    function get_total_page(){
        return db_num_rows('select `id` from `tbl_page`');
    }
    function get_total_approved_page(){
        return db_num_rows('select `id` from `tbl_page` where `approved` = 1');
    }
    function get_total_not_approved_page(){
        return db_num_rows('select `id` from `tbl_page` where `approved` = 0');
    }
?>