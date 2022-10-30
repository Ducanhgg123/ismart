<?php 
function add_to_cart($id,$qty){
    $product=get_product_by_id($id);
    if (isset($_SESSION['cart'][$id]['qty']))
        $qty+=$_SESSION['cart'][$id]['qty'];
    $_SESSION['cart'][$id]['id']=$id;
    $_SESSION['cart'][$id]['qty']+=$qty;
    $_SESSION['cart'][$id]['total']=get_real_price($product)*$qty;
    update_cart_info();
    return true;
}
function update_cart_info(){
    $total=0;
    $total_product=0;
    foreach ($_SESSION['cart'] as $product){
        $total+=$product['total'];
        $total_product+=$product['qty'];
    }
    $_SESSION['cart_info']['total']=$total;
    $_SESSION['cart_info']['qty']=$total_product;
    return true;
}
function deleteProduct($id){
    
    unset($_SESSION['cart'][$id]);
    update_cart_info();
}
function updateCart($id,$qty){
    $product=get_product_by_id($id);
    $_SESSION['cart'][$id]['qty']=$qty;
    $_SESSION['cart'][$id]['total']=get_real_price($product)*$qty;
    update_cart_info();
    return true;
}