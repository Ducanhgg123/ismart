<?php
function construct()
{
    load_model("index");
    load_model("product");
    load('helper','format');
    load('helper','page');
};
function indexAction(){
    $id=$_GET['id'];
    $page=get_page_by_id($id);
    $list_page=get_list_page();
    // best selling product
    $list_best_selling_product=get_list_best_selling_product(5);
    // load view
    $data=array(
        'list_best_selling_product' => $list_best_selling_product,
        'page' => $page,
        'list_page' => $list_page
    );
    load_view('index',$data);
}