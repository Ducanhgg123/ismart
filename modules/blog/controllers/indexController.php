<?php
function construct()
{
    load_model("index");
    load_model("product");
    load('helper','format');
    load('helper','page');
};
function indexAction(){
    global $config;
    if (isset($_GET['page']))
        $page=$_GET['page'];
    else
        $page=1;
    $list_page=get_list_page();
    // best selling product
    $list_best_selling_product=get_list_best_selling_product(5);
    // List post
    $list_post=get_list_post();
    // pagination
    $record_per_page=5;
    $total_record=count($list_post);
    $start=($page-1)*$record_per_page;
    $total_page=ceil($total_record/$record_per_page);
    $list_post=array_slice($list_post,$start,$record_per_page);
    // load view
    $data=array(
        'list_best_selling_product' => $list_best_selling_product,
        'list_post' => $list_post,
        'total_page' => $total_page,
        'start' => $start,
        'page' => $page,
        'list_page' => $list_page
    );
    load_view('index',$data);
}
function detailAction(){
    $id=$_GET['id'];
    $post=get_post_by_id($id);
    $list_best_selling_product=get_list_best_selling_product(5);
    $list_page=get_list_page();
    
    $data=array(
        'list_best_selling_product' => $list_best_selling_product,
        'post' => $post,
        'list_page' => $list_page
    );
    load_view('detail',$data);
}