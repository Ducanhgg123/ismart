<?php
function construct()
{
    load_model("index");
    load_model("product");
    load('helper','format');
    load('helper','page');
};
function addToCartAction(){
    $product_id=$_GET['id'];
    if (isset($_GET['qty']))
        $qty=$_GET['qty'];
    else
        $qty=1;
    add_to_cart($product_id,$qty);
    redirect("gio-hang.html");
}
function indexAction(){
    $list_page=get_list_page();
    $data=array(
        'list_page' => $list_page
    );
    load_view("index",$data);
}
function deleteAction(){
    $id=$_GET['id'];
    deleteProduct($id);
    echo currency_format($_SESSION['cart_info']['total']);
}
function updateAction(){
    $id=$_POST['id'];
    $qty=$_POST['qty'];
    updateCart($id,$qty);
    $data=array(
        "sub_total" => currency_format($_SESSION['cart'][$id]['total']),
        'total' => currency_format($_SESSION['cart_info']['total'])
    );
    echo json_encode($data);
}
function deleteCartAction(){
    unset($_SESSION['cart']);
    unset($_SESSION['cart_info']);
    redirect("?mod=cart");
}