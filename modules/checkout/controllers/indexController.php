<?php
function construct()
{
    load_model("index");
    load_model("product");
    load('helper','format');
    load('helper','page');
};
function indexAction(){
    $list_page=get_list_page();
    if (isset($_GET['id'])){
        $id=$_GET['id'];
        if (isset($_GET['qty']))
            $qty=$_GET['qty'];
        else
            $qty=0;
        add_to_cart($id,$qty);
        redirect('thanh-toan.html');
    }
    $data=array(
        'list_page' => $list_page
    );
    load_view('index',$data);
}
function checkoutAction(){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $phone_number=$_POST['phone_number'];
    $note=$_POST['note'];
    $delivery_info=$_POST['delivery_info'];
    // Customer
    $data=array(
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone_number' => $phone_number,
        'created_at' => time()
    );
    if (check_exist_customer($email,$phone_number)==false){
        add_customer($data);
    }
    $customer=check_exist_customer($email,$phone_number);
    $customer_id=$customer['id'];
    //sale
    $current_code=get_current_code();
    $current_code=(int)substr($current_code,3)+1;
    $code="WEB".strval($current_code);
    $data=array(
        'code' => $code,
        'user_id' => $customer_id,
        'created_at' => time(),
        'address' => $address,
        'delivery_info' => $delivery_info,
        'note' => $note
    );
    add_sale($data);
    $sale=get_sale_by_code($code);
    $sale_id=$sale['id'];
    foreach ($_SESSION['cart'] as $id=>$info){
        $data=array(
            'sale_id' => $sale_id,
            'product_id' => $id,
            'qty' => $info['qty']
        );
        add_cart($data);
    }
    echo "OK";
}
function successAction(){
    $list_page=get_list_page();
    deleteCart();
    $data=array(
        'list_page' => $list_page
    );
    load_view('orderSuccess',$data);
}
