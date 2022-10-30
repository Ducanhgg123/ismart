<?php
    function get_list_slider($num){
        return db_fetch_array("select * from `tbl_slider` where `status` = 1 limit $num");
    }
?>