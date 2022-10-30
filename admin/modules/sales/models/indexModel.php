<?php
    function get_list_sales($status,$key){
        if ($status == -1)
            return db_fetch_array("select * from `tbl_sales` where `code` like '%$key%'");
        else
            return db_fetch_array("select * from `tbl_sales` where `code` like '%$key%' and `status` = $status");
    }
    function get_num_sales_by_status($status){
        if ($status != -1)
            return db_num_rows("select `id` from `tbl_sales` where `status` = $status");
        else 
            return db_num_rows("select `id` from `tbl_sales`");
    }
    function get_sale_by_id($id){
        return db_fetch_row("select * from `tbl_sales` where `id` = $id");
    }
    function get_order_name_by_id($id){
        $arr=db_fetch_row("select `name` from `tbl_customer` where `id` = $id");
        return $arr['name'];
    }
    function count_product($sale_id){
        $list_cart=db_fetch_array("select * from `tbl_cart` where `sale_id` = $sale_id");
        $count=0;
        foreach ($list_cart as $cart)
            $count+=$cart['qty'];
        return $count;
    }
    function get_product_by_id($id){
        return db_fetch_row("select * from `tbl_product` where `id` = $id");
    }
    function cal_total($sale_id){
        $total=0;
        $list_cart=db_fetch_array("select `product_id`,`qty` from `tbl_cart` where `sale_id` = $sale_id ");
        foreach ($list_cart as $cart){
            $product=get_product_by_id($cart['product_id']);
            $total+=$product['price']*$cart['qty'];
        }
        return $total;
    }
    function update_status($id,$status){
        return db_update('`tbl_sales`',array('status' => $status),"`id` = $id");
    }
    function update_sale($data,$id){
        return db_update('`tbl_sales`',$data,$id);
    }
    function delete_sale($id){
        return db_delete('`tbl_sales`',"`id` = $id");
    }
    function approve_sale($id){
        return db_update('`tbl_sales`',array('status'=> 1),"`id` = $id");
    }
?>