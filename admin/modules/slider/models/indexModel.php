<?php
function add_slider($data){
    // $name=$data['name'];
    // $link=$data['link'];
    // $order=$data['order'];
    // $image=$data['image'];
    // $status=$data['status'];
    // $creator=$data['creator'];
    // $created_at=$data['created_at'];
    // return db_query("INSERT INTO `tbl_slider`(`name`, `link`, `order`, `image`, `status`, `creator`, `created_at`) VALUES ('$name','$link',$order,'$image',$status,'$creator',$created_at)");
    return db_insert('`tbl_slider`',$data);
}
function get_num_slider_by_status($status){
    if ($status==-1){
        return db_num_rows("select `id` from `tbl_slider`");
    }
    return db_num_rows("select `id` from `tbl_slider` where `status` = $status");
}
function get_list_slider_by_status($status,$key){
    if ($status==-1){
        return db_fetch_array("select * from `tbl_slider` where `name` like '%$key%'");
    }
    return db_fetch_array("select * from `tbl_slider` where `status` = $status and where `name` like '%$key%'");
}
function get_slider_by_id($id){
    return db_fetch_row("select * from `tbl_slider` where `id` = $id");
}
function update_slider($data,$id){
    return db_update('`tbl_slider`',$data,"id = $id");
}
function delete_slider($id){
    return db_delete('`tbl_slider`',"`id` = $id");
}
function approve_slider($id){
    return db_update('`tbl_slider`',array('status'=>1),"`id` = $id");
}
?>