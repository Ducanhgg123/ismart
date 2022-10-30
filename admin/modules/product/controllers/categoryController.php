<?php
function construct()
{
    load_model('category');
    load('helper', 'format');
    load('helper', 'string');
    load('lib', 'validation');
}
function indexAction()
{
    global $config;
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    $record_per_page = $config['record_per_page'];
    $total_record = get_num_cat();
    
    $total_page = ceil($total_record / $record_per_page);
    $start = ($page - 1) * $record_per_page;
    $data = array(
        'list_cat' => get_list_cat_with_limit($start, $record_per_page),
        'page' => $page,
        'start' => $start,
        'total_page' => $total_page
    );
    load_view('indexCategory', $data);
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
function updateAction()
{
    global $success;
    $id = $_GET['id'];
    $item = get_product_cat_by_id($id);
    $error = array();
    if (isset($_POST['btn_update'])) {
        $item['title'] = $_POST['title'];

        $item['parent_id'] = (int) $_POST['parent-cat'];
        if (empty($_POST['title']))
            $error['title'] = 'Tiêu đề không được để trống';
        if (empty($error)) {
            $data = array(
                'title' => $item['title'],
                'parent_id' => $item['parent_id']
            );
            if (update_cat($data, $id) > 0) {
                $success = "<b class='text-success'>Cập nhật danh mục thành công!</b>";
            } else
                $success = "<b class='text-red'>Cập nhật danh mục thất bại!</b>";
        } else
            $success = "<b class='text-red'>Cập nhật danh mục thất bại!</b>";
    }
    $data = array(
        'item' => $item,
        'list_cat' => get_list_cat()
    );
    load_view('updateCat', $data);
}
function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;
    delete_cat($id);
    $record_per_page = $config['record_per_page'];
    $total_record = get_num_cat();
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=product&controller=category&page=$page");
}
function deleteCatsAction()
{
    global $config;
    $list_cat = $_POST['list_cat'];
    $page = $_POST['page'];
    foreach ($list_cat as $id => $v)
        delete_cat($id);
    $record_per_page = $config['record_per_page'];
    $total_record = get_num_cat();
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=product&controller=category&page=$page");
}
