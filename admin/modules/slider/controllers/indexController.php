<?php
function construct()
{
    load_model("index");
    load('helper', 'string');
    load('helper', 'format');
    load('lib', 'upload-file');
    load('lib', 'validation');
};
function indexAction()
{
    $record_per_page = 6;

    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    if (isset($_GET['key'])) {
        $key = $_GET['key'];
    } else $key = '';

    if (isset($_GET['status']) && $_GET['status'] != -1) {
        $status = $_GET['status'];
        $total_record = db_num_rows("select `id` from `tbl_slider` where `status` = $status and `name` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    } else {
        $status = -1;
        $total_record = db_num_rows("select `id` from `tbl_slider` where `name` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    }

    $list_slider = get_list_slider_by_status($status, $key);
    $start = ($page - 1) * $record_per_page;
    $list_slider = array_slice(get_list_slider_by_status($status, $key), $start, $record_per_page);

    $data = array(
        'list_slider' => $list_slider,
        'total' => $total_record,
        'num_unapproved' => get_num_slider_by_status(0),
        'num_approved' => get_num_slider_by_status(1),
        'total_page' => $total_page,
        'start' => $start,
        'page' => $page,
        'status' => $status
    );
    load_view('index', $data);
}
function addAction()
{
    global $error;
    $error = array();
    $success = "";
    if (isset($_POST['btn_add'])) {
        $name = $_POST['name'];
        $link = $_POST['link'];
        $order = (int)$_POST['order'];
        $status = $_POST['status'];

        if (empty($name))
            $error['name'] = 'Tên không được để trống';

        if (empty($order))
            $error['order'] = 'Thứ tự không được để trống';

        if (empty($_FILES['file']['name'])) {
            $error['file'] = 'Vui lòng chọn hình ảnh';
        }

        if (empty($error)) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $data = array(
                'name' => $name,
                'link' => $link,
                'order' => $order,
                'image' => $upload_file,
                'status' => $status,
                'creator' => $_SESSION['username'],
                'created_at' => time()
            );
            if ((file_exists($upload_file) || move_uploaded_file($_FILES['file']['tmp_name'], $upload_file))) {
                add_slider($data);
                $success = "<b class='text-success'>Thêm slider thành công!</b>";
            } else {
                $success = "<b class='text-red'>Thêm slider thất bại!</b>";
            }
        } else
            $success = "<b class='text-red'>Thêm slider thất bại</b>";
    }
    $data['success'] = $success;
    load_view('add', $data);
}
function updateAction()
{
    global $error;
    $id = $_GET['id'];
    $slider = get_slider_by_id($id);
    $error = array();
    $success = "";
    if (isset($_POST['btn_update'])) {
        $slider['name'] = $_POST['name'];
        $slider['link'] = $_POST['link'];
        $slider['order'] = (int) $_POST['order'];
        $slider['status'] = $_POST['status'];
        if (empty($slider['name']))
            $error['name'] = 'Tên không được để trống';

        if ($slider['order'] == 0)
            $error['category'] = 'Vui lòng chọn thứ tự lớn hơn 0';

        if (isset($_FILE['file'])) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $slider['image'] = $upload_file;
            if (!file_exists($upload_file))
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
        }

        if (empty($error)) {
            $data = array(
                'name' => $slider['name'],
                'link' => $slider['link'],
                'order' => (int) $slider['order'],
                'image' => $slider['image'],
                'status' => $slider['status']
            );
            update_slider($data, $slider['id']);
            $success = "<b class='text-success'>Cập nhật slider thành công!</b>";
        } else {
            $success = "<b class='text-red'>Cập nhật slider thất bại</b>";
        }
    }
    $data = array(
        'slider' => $slider,
        "success" => $success
    );
    load_view('update', $data);
}
function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete_slider($id);
    $record_per_page = $config['record_per_page'];
    $total_record = get_num_slider_by_status(-1);
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=slider&page=$page");
}
function approveAction(){
    $page=$_GET['page'];
    $id=$_GET['id'];
    $status=$_GET['status'];
    approve_slider($id);
    redirect("?mod=slider&page=$page&status=$status");
}
function multiAction()
{
    $page = $_POST['page'];
    $status = $_POST['status'];
    if (isset($_POST['btn_delete'])) {
        $list_slider = $_POST['list_slider'];
        foreach ($list_slider as $id => $v) {
            delete_slider($id);
        }
        $record_per_page = 6;
        $total_record = db_num_rows("select `id` from `tbl_post`");
        $total_page = ceil($total_record / $record_per_page);
        $page = min($page, $total_page);
        redirect("?mod=slider&page=$page&status=$status");
    }else
    if (isset($_POST['btn_approve'])) {
        $list_slider = $_POST['list_slider'];
        foreach ($list_slider as $id => $v) {
            approve_slider($id);
        }
        redirect("?mod=slider&page=$page&status=$status");
    }else
    if (isset($_POST['btn_search'])) {
        $key = $_POST['key'];
        redirect("?mod=slider&page=$page&status=$status&key=$key");
    }
}
// function approveAction()
// {
//     $id = $_POST['id'];
//     $num_approve = $_POST['numApproved'];
//     $num_not_approve = $_POST['numNotApproved'];
//     if (approve_post($id)) {
//         $data = array(
//             'status' => 'Đã duyệt',
//             'numApproved' => $num_approve + 1,
//             'numNotApproved' => $num_not_approve - 1
//         );
//     } else {
//         $data = array(
//             'status' => '0',
//         );
//     }
//     echo json_encode($data);
// }
