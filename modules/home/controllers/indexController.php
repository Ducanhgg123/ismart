<?php 
    function construct(){
        load_model('index');
        load_model('product');
        load('helper','format');
        load('helper','page');
        // load('helper','url');
    };
    function indexAction(){
        $list_best_selling_product=get_list_best_selling_product(4);
        $list_featured_product=get_list_featured_product(8);
        $list_slider=get_list_slider(3);
        $list_product=get_list_product();
        $list_product_cat=destroy_empty_product_cat(get_list_product_cat());
        $list_page=get_list_page();
        // show_array($list_product_cat);
        $data=array(
            'list_featured_product' => $list_featured_product,
            'list_best_selling_product' => $list_best_selling_product,
            'list_slider' => $list_slider,
            'list_product' => $list_product,
            'list_product_cat' => $list_product_cat,
            'list_page' => $list_page
        );
        load_view('index',$data);
    }
    function getListProductCatAction(){
        $list_product_cat=get_list_product_cat();
        echo json_encode(array('list_product_cat' => $list_product_cat));
    }
?>