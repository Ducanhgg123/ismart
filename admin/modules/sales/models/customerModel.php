<?php
function get_list_customer($key = '')
{
    $arr = db_fetch_array("select * from `tbl_customer` where `name` like '%$key%'");
    // show_array($arr);
    $list_customer = array();
    foreach ($arr as $customer) {
        $customer['qty'] = 0;
        $list_customer[$customer['id']] = $customer;
    }
    return $list_customer;
}
function count_product($sale_id){
    $list_cart=db_fetch_array("select * from `tbl_cart` where `sale_id` = $sale_id");
    $count=0;
    foreach ($list_cart as $cart)
        $count+=$cart['qty'];
    return $count;
}
function count_sales_for_customer($list_customer)
{
    $list_sales = db_fetch_array("select `id`,`user_id` from `tbl_sales`");
    foreach ($list_sales as $sale)
        if (array_key_exists($sale['user_id'], $list_customer)) {
            $list_customer[$sale['user_id']]['qty'] += count_product($sale['id']);
        }
    return $list_customer;
}
function delete_customer($id)
{
    return db_delete('`tbl_customer`', "`id` = $id");
}
function get_customer_by_id($id)
{
    return db_fetch_row("select * from `tbl_customer` where `id` = $id");
}
function update_customer($data, $id)
{
    return db_update('`tbl_customer`', $data, "`id` = $id");
}
