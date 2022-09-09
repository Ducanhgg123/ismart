<?php
function construct()
{
    load_model('category');
    load('helper', 'format');
    load('helper','string');
    load('lib', 'validation');
}
function indexAction()
{
    global $config;
    if (isset($_GET['page']))
        $page=$_GET['page'];
    else
        $page=1;
    
    $record_per_page=$config['record_per_page'];
    $total_record=get_num_cat();
    $total_page=ceil($total_record/$record_per_page);

    $start=($page-1)*$record_per_page;
    $data=array(
        'list_cat' => get_list_cat_with_limit($start,$record_per_page),
        'page' => $page,
        'start' =>$start,
        'total_page' => $total_page
    );
    load_view('indexCategory',$data);
}
function addAction()
{
    global $error, $title, $success;
    $error = array();
    if (isset($_POST['btn_add'])) {
        $title = $_POST['title'];
        $parent_id = (int)$_POST['parent-cat'];

        if (empty($title))
            $error['title'] = 'Tiêu đề không được để trống';

        if (empty($error)) {
            $data = array(
                'title' => $title,
                'parent_id' => $parent_id,
                'created_at' => time(),
                'creator' => $_SESSION['username']
            );

            if (add_cat($data) > 0) {
                $success = "<b class='text-success'>Thêm danh mục thành công!</b>";
            } else
                $success = "<b class='text-red'>Thêm danh mục thất bại!</b>";
        } else
            $success = "<b class='text-red'>Thêm danh mục thất bại</b>";
    }

    $data = array(
        'list_cat' => get_list_cat()
    );
    load_view('addCategory', $data);
}
