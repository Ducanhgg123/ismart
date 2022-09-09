<?php  
    function construct(){
        load_model('product');
    }

    function indexAction(){
        load_view('index');
    }
    function addAction(){
        load_view('add');
    }
?>