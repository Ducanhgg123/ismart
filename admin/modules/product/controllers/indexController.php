<?php
function construct()
{
    load_model('product');
    load('helper', 'format');
    load('helper', 'string');
    load('lib', 'validation');
}

function indexAction()
{
    global $config;
    $record_per_page = $config['record_per_page'];

    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    if (isset($_GET['key'])) {
        $key = $_GET['key'];
    } else $key = '';

    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $total_record = db_num_rows("select `id` from `tbl_product` where `status` = $status and `name` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    } else {
        $status = -1;
        $total_record = db_num_rows("select `id` from `tbl_product` where `name` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    }

    $list_product = get_list_product($status, $key);
    $start = ($page - 1) * $record_per_page;
    $list_product = array_slice(get_list_product($status, $key), $start, $record_per_page);



    $data = array(
        'list_product' => $list_product,
        'total_product' => get_num_product_by_status(-1),
        'total_approved_product' => get_num_product_by_status(1),
        'total_unapproved_product' => get_num_product_by_status(0),
        'total_page' => $total_page,
        'start' => $start,
        'page' => $page,
        'status' => $status,
        'config' => $config
    );
    load_view('index', $data);
}
function addAction()
{
    global $error;
    $error = array();
    $success = "";
    if (isset($_POST['btn_add'])) {
        $name = $_POST['product_name'];
        $code = $_POST['product_code'];
        $price = $_POST['price'];
        $short_desc = $_POST['desc'];
        $content = $_POST['content'];
        $cat = $_POST['category'];
        $status = $_POST['status'];
        if (isset($_POST['discount']))
            $discount=$_POST['discount'];
        else
            $discount=0;

        if (empty($name))
            $error['name'] = 'Tên sản phẩm không được để trống';

        if (empty($code))
            $error['code'] = 'Mã sản phẩm không được để trống';

        if (empty($price))
            $error['price'] = 'Giá sản phẩm không được để trống';
        
        if ($discount>100)
            $error['discount']='Không thể giảm giá quá 100%';

        if (empty($_FILES['file']['name'])) {
            $error['file'] = 'Vui lòng chọn hình ảnh';
        }
        

        if ($cat == 0)
            $error['category'] = 'Vui lòng chọn danh mục';

        if (empty($error)) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $data = array(
                'name' => $name,
                'code' => $code,
                'price' => $price,
                'short_desc' => $short_desc,
                'content' => $content,
                'created_at' => time(),
                'creator' => $_SESSION['username'],
                'thumb' => $upload_file,
                'status' => $status,
                'cat_id' => $cat,
                'discount' => $discount
            );
            if ((file_exists($upload_file) || move_uploaded_file($_FILES['file']['tmp_name'], $upload_file))) {
                if (add_product($data))
                    $success = "<b class='text-success'>Thêm sản phẩm thành công!</b>";
                else
                    $success =  "<b class='text-red'>Thêm sản phẩm thất bại!</b>";
            } else {
                $success = "<b class='text-red'>Thêm sản phẩm thất bại!</b>";
            }
        } else
            $success = "<b class='text-red'>Thêm bài viết thất bại</b>";
    }
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    $data['success'] = $success;
    load_view('add', $data);
}
function updateAction()
{
    global $error;
    $id = $_GET['id'];
    $product = get_product_by_id($id);
    $list_cat = get_list_cat();
    $error = array();
    $success = "";
    if (isset($_POST['btn_update'])) {
        $product['name'] = $_POST['product_name'];
        $product['code'] = $_POST['product_code'];
        $product['price'] = $_POST['price'];
        $product['short_desc'] = $_POST['short_desc'];
        $product['content'] = $_POST['content'];
        $product['cat_id'] = $_POST['category'];
        $product['status'] = $_POST['status'];
        $product['discount'] = $_POST['discount'];
        if (empty($product['name']))
            $error['name'] = 'Tên sản phẩm không được để trống';

        if (empty($product['code']))
            $error['name'] = 'Mã sản phẩm không được để trống';

        if (empty($product['price']))
            $error['price'] = 'Giá sản phẩm không được để trống';

        if ($product['cat_id'] == 0)
            $error['category'] = 'Vui lòng chọn danh mục';
        
        if ($product['discount']>100)
            $error['discount']='Không thể giảm quá 100%';

        if (isset($_FILE['file'])) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $product['thumb'] = $upload_file;
        }

        if (empty($error)) {
            $data = array(
                'name' => $product['name'],
                'code' => $product['code'],
                'content' => $product['content'],
                'price' => $product['price'],
                'short_desc' => $product['short_desc'],
                'thumb' => $product['thumb'],
                'cat_id' => $product['cat_id'],
                'status' => $product['status'],
                'discount' => $product['discount']
            );
            if (update_product($data, $product['id'])) {
                if (isset($_FILE['file'])) {
                    if (!file_exists($upload_file))
                        move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
                }
                $success = "<b class='text-success'>Cập nhật sản phẩm thành công!</b>";
            } else {
                $success = "<b class='text-red'>Cập nhật sản phẩm thất bại</b>";
            }
        } else {
            $success = "<b class='text-red'>Cập nhật sản phẩm thất bại</b>";
        }
    }
    $data = array(
        'product' => $product,
        'list_cat' => $list_cat,
        'success' => $success
    );
    load_view('update', $data);
}
function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete_product($id);
    $record_per_page = $config['record_per_page'];
    $total_record = get_num_product_by_status(-1);
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=product&page=$page");
}
function approveAction()
{
    $id = $_GET['id'];
    $page = $_GET['page'];
    approve_product($id);
    redirect("?mod=product&page=$page");
}
function actionAction()
{
    global $config;
    $page = $_POST['page'];
    $list_product = array();
    if (isset($_POST['list_product']))
        $list_product = $_POST['list_product'];
    // $list_product = $_POST['list_product'];
    if (isset($_POST['btn_delete'])) {
        foreach ($list_product as $id => $v) {
            delete_product($id);
        }
        $record_per_page = $config['record_per_page'];
        $total_record = get_num_product_by_status(-1);
        $total_page = ceil($total_record / $record_per_page);
        $page = min($page, $total_page);
        $page = max(1, $page);
        redirect("?mod=product&page=$page");
    } else if (isset($_POST['btn_approve'])) {
        foreach ($list_product as $id => $v) {
            approve_product($id);
        }
        redirect("?mod=product&page=$page");
    } else if (isset($_POST['btn_search'])) {
        $key = $_POST['key'];
        redirect("?mod=product&key=$key");
    }
}
