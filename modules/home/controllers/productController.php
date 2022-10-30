<?php
function construct()
{
    load_model('index');
    load_model('product');
    load('helper', 'format');
    load('helper','page');
    // load('helper','url');
};
function detailAction()
{
    $id = $_GET['id'];
    $product = get_product_by_id($id);
    $list_best_selling_product = get_list_best_selling_product(4);
    $arr = get_list_product();
    $list_same_category=array();
    foreach ($arr as $p)
        if (check_product_cat(get_product_cat_by_id($p['cat_id']),get_product_cat_by_id($product['cat_id'])))
            $list_same_category[]=$p;
    $list_page=get_list_page();
    $data = array(
        'list_best_selling_product' => $list_best_selling_product,
        'product' => $product,
        'list_same_category_product' => $list_same_category,
        'list_page' => $list_page
    );
    load_view('detailProduct', $data);
}
function indexAction()
{
    global $config;
    if (isset($_GET['min']))
        $min = $_GET['min'];
    else
        $min = 0;
    if (isset($_GET['max']))
        $max = $_GET['max'];
    else
        $max = 100000000;
    if (isset($_GET['sort_type']))
        $sort_type = $_GET['sort_type'];
    else
        $sort_type = -1;
    if (isset($_GET['cat_id']))
        $cat_id = $_GET['cat_id'];
    else
        $cat_id = -1;
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;
    if (isset($_POST['key']))
        $key = $_POST['key'];
    else
        $key = '';


    $list_best_selling_product = get_list_best_selling_product(4);
    $arr = get_list_filter_product($sort_type);
    $list_page=get_list_page();
    $list_product = array();
    foreach ($arr as $product)
        if (get_real_price($product) >= $min && get_real_price($product) <= $max && ($cat_id == -1 || check_product_cat(get_product_cat_by_id($product['cat_id']), get_product_cat_by_id($cat_id))) && ($key == '' || str_contains($product['name'], $key)))
            $list_product[] = $product;
    if ($cat_id == -1)
        $list_cat_product = destroy_empty_product_cat(get_list_product_cat());
    else
        $list_cat_product = array(get_product_cat_by_id($cat_id));
    $list_product_cat_full = destroy_empty_product_cat(get_list_product_cat());

    $total_record = count($list_product);
    $total_page = ceil($total_record / $config['record_per_page']);
    $start = ($page - 1) * $config['record_per_page'];
    $list_product = array_slice($list_product, $start, $config['record_per_page']);
    // $url_format = "?controller=product";
    // if ($min > 0)
    //     $url_format .= "&min=" . $min;
    // if ($max != 100000000)
    //     $url_format .= "&max=" . $max;
    // if ($sort_type != -1)
    //     $url_format .= "&sort_type=" . $sort_type;
    // if ($cat_id != -1)
    //     $url_format .= "&cat_id=" . $cat_id;
    // if ($key != '')
    //     $url_format .= "&key=" . $key;
    $url_format="danh-muc-san-pham/$cat_id/trang-$page/$sort_type/$min/$max";
    $data = array(
        'list_best_selling_product' => $list_best_selling_product,
        'list_product' => $list_product,
        'list_cat_product' => $list_cat_product,
        'total_page' => $total_page,
        'page' => $page,
        'key' => $key,
        'list_product_cat_full' => $list_product_cat_full,
        'cat_id' => $cat_id,
        'min' => $min,
        'max' => $max,
        'sort_type' => $sort_type,
        'url_format' => $url_format,
        'list_page' => $list_page
    );
    load_view('indexProduct', $data);
}
