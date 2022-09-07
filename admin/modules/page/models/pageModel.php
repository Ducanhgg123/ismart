<?php 
    function add_page($data){
        return db_insert('`tbl_page`',$data);
    }
    function update_page($data,$id){
        return db_update('`tbl_page`',$data,"`id` = $id");
    }
    function delete_page($id){
        return db_delete('`tbl_page`',"`id` = $id");
    }
    function approve_page($id){
        $data=array(
            'approved' => 1
        );
        return db_update('`tbl_page`',$data,"`id` = $id");
    }
?>