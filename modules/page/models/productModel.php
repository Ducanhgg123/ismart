<?php
function get_list_product_cat()
{
    return format_list_cat(db_fetch_array('select * from `tbl_product_cat`'));
}
function get_list_featured_product($num)
{
    return db_fetch_array("select * from `tbl_product` where `status` = 1 order by `discount` DESC limit $num");
}
function get_list_best_selling_product($num)
{
    return db_fetch_array("select * from `tbl_product` where  `status` = 1 order by `sold` DESC limit $num");
}
function get_list_product($key = '')
{
    return db_fetch_array("select * from `tbl_product` where `name` like '%$key%' and `status` = 1 order by `cat_id` ASC  ");
}
function get_product_cat_by_id($id)
{
    return db_fetch_row("select * from `tbl_product_cat` where `id` = $id");
}
function get_list_product_by_cat_id($id)
{
    $arr = get_list_product();
    $list_product = array();
    foreach ($arr as $product)
        if (check_product_cat(get_product_cat_by_id($product['cat_id']), get_product_cat_by_id($id)))
            $list_product[] = $product;
    return $list_product;
}
function destroy_empty_product_cat($list_cat)
{
    $list_product = get_list_product();
    // show_array($list_product);
    $n = count($list_cat);
    for ($i = 0; $i < $n; $i++) {
        $exist = false;
        foreach ($list_product as $product)
            if ($product['cat_id'] == $list_cat[$i]['id']) {
                $exist = true;
                break;
            }
        if (!$exist)
            unset($list_cat[$i]);
    }
    return $list_cat;
}
function get_product_by_id($id)
{
    return db_fetch_row("select * from `tbl_product` where `id` = $id and `status` = 1");
}
function exist_product($list_product, $cat_id)
{
    foreach ($list_product as $product)
        if (check_product_cat(get_product_cat_by_id($product['cat_id']), get_product_cat_by_id($cat_id)))
            return true;
    return false;
}
function check_product_cat($product_cat, $cat)
{
    if ($cat['id'] == $product_cat['id'])
        return true;
    else if ($product_cat['parent_id'] == 0)
        return false;
    return check_product_cat(get_product_cat_by_id($product_cat['parent_id']), $cat);
}
function get_list_filter_product($sort_type)
{
    if ($sort_type == -1)
        return get_list_product();
    if ($sort_type == 0)
        return db_fetch_array("select * from `tbl_product` where `status` = 1 order by `name` ASC");
    if ($sort_type == 1)
        return db_fetch_array("select * from `tbl_product` where `status` = 1 order by `name` DESC");
    if ($sort_type == 2)
        return db_fetch_array("select * from `tbl_product` where `status` = 1 order by `price`*(100-`discount`)/100 DESC");
    if ($sort_type == 3)
        return db_fetch_array("select * from `tbl_product` where `status` = 1 order by `price`*(100-`discount`)/100 ASC");
}
function get_real_price($product){
    return (int)$product['price']*(100-$product['discount'])/100;
}
