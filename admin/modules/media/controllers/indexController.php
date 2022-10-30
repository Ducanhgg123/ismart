<?php
function construct()
{
    load_model("index");
    load('lib', 'upload-file');
    load('helper', 'page');
    load('lib', 'validation');
};
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

    $tmp = scandir("public/uploads");
    $tmp = array_slice($tmp, 2, count($tmp) - 2);
    $list_file = array();
    foreach ($tmp as $file)
        if (($key == '' || str_contains($file, $key))) {
            // echo $file;
            $list_file[] = array('name' => $file);
        }
    $total_record = count($list_file);
    $total_page = ceil($total_record / $record_per_page);
    $start = ($page - 1) * $record_per_page;
    $list_file = array_slice($list_file, $start, $record_per_page);

    $data = array(
        'total' => $total_record,
        'list_file' => $list_file,
        'start' => $start,
        'total_page' => $total_page,
        'page' => $page
    );
    load_view('index', $data);
}
function updateAction()
{
    global $error;
    $name = $_GET['name'];
    $success = "";
    if (isset($_POST['btn_update'])) {
        if (empty($_POST['name']))
            $error['name'] = 'Tên file không được để trống';
        if (empty($error)) {
            rename("public/uploads/" . $name, "public/uploads/" . $_POST['name']);
            $name = $_POST['name'];
            $success = "<b class='text-success'>Cập nhật thành công</b>";
        } else $success = "<b class='text-red'>Cập nhật thất bại</b>";
    }
    $data = array(
        'success' => $success,
        'name' => $name
    );
    load_view("update", $data);
}
function deleteAction()
{
    global $config;
    $name = $_GET['name'];
    $page = $_GET['page'];
    unlink("public/uploads/$name");
    
    $record_per_page=$config['record_per_page'];
    $total_record = get_num_file();
    $total_page = ceil($total_record / $record_per_page);
    $page=min($page,$total_page);
    $page=max(1,$page);
    redirect("?mod=media&page=$page");
}
function multiAction(){
    $page = $_POST['page'];
    if (isset($_POST['btn_delete'])) {
        $list_file = $_POST['list_file'];
        foreach ($list_file as $name => $v) {
            unlink("public/uploads/$name");
        }
        $record_per_page = 6;
        $total_record = get_num_file();
        $total_page = ceil($total_record / $record_per_page);
        $page = min($page, $total_page);
        $page=max(1,$page);
        redirect("?mod=media&page=$page");
    } else
    if (isset($_POST['btn_search'])) {
        $key = $_POST['key'];
        redirect("?mod=media&page=$page&key=$key");
    }
}