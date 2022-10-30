<?php
function add_to_cart($id, $qty)
{
    $product = get_product_by_id($id);
    if (isset($_SESSION['cart'][$id]['qty']))
        $qty += $_SESSION['cart'][$id]['qty'];
    $_SESSION['cart'][$id]['id'] = $id;
    if (!empty($_SESSION['cart'][$id]['qty']))
        $_SESSION['cart'][$id]['qty'] += $qty;
    else
        $_SESSION['cart'][$id]['qty'] = $qty;
    $_SESSION['cart'][$id]['total'] = get_real_price($product) * $qty;
    update_cart_info();
    return true;
}
function update_cart_info()
{
    $total = 0;
    $total_product = 0;
    if (isset($_SESSION['cart']))
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['total'];
            $total_product += $product['qty'];
        }
    $_SESSION['cart_info']['total'] = $total;
    $_SESSION['cart_info']['qty'] = $total_product;
    return true;
}
function deleteProduct($id)
{

    unset($_SESSION['cart'][$id]);
    update_cart_info();
}
function deleteCart()
{
    unset($_SESSION['cart']);
    update_cart_info();
}
function updateCart($id, $qty)
{
    $product = get_product_by_id($id);
    $_SESSION['cart'][$id]['qty'] = $qty;
    $_SESSION['cart'][$id]['total'] = get_real_price($product) * $qty;
    update_cart_info();
    return true;
}
function check_exist_customer($email, $phone_number)
{
    return db_fetch_row("select * from `tbl_customer` where `email` = '$email' and `phone_number` = '$phone_number'");
}
function add_customer($data)
{
    return db_insert('`tbl_customer`', $data);
}
function get_current_code()
{
    $data = db_fetch_row("select `code` from `tbl_sales` order by `code` DESC limit 1");
    return $data['code'];
}
function add_sale($data)
{
    return db_insert('`tbl_sales`', $data);
}
function get_sale_by_code($code)
{
    return db_fetch_row("select * from `tbl_sales` where `code` = '$code'");
}
function add_cart($data)
{
    return db_insert('`tbl_cart`', $data);
}
