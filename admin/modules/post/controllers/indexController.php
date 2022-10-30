<?php
function construct()
{
    load_model("post");
    load_model('category');
    load('helper', 'string');
    load('helper','format');
    load('lib', 'upload-file');
    load('lib', 'validation');
};
function indexAction()
{
    global $config;
    $record_per_page = 6;
    
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    if (isset($_GET['key'])){
        $key=$_GET['key'];
    }else $key='';

    if (isset($_GET['status'])){
        $status = $_GET['status'];
        $total_record = db_num_rows("select `id` from `tbl_post` where `status` = $status and `title` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    }
    else{
        $status = -1;
        $total_record = db_num_rows("select `id` from `tbl_post` where `title` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    }

    $list_post = get_list_post_by_status($status,$key);
    $start = ($page - 1) * $record_per_page;
    $list_post = array_slice(get_list_post_by_status($status,$key), $start, $record_per_page);

    $data = array(
        'list_post' => $list_post,
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
    global $error, $title, $slug, $desc;
    $error = array();
    $success = "";
    if (isset($_POST['btn_add'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $cat = $_POST['category'];
        $short_desc=$_POST['short_desc'];
        if (empty($title))
            $error['title'] = 'Tiêu đề không được để trống';

        if (empty($_FILES['file']['name'])) {
            $error['file'] = 'Vui lòng chọn hình ảnh';
        }
        
        if ($cat == 0)
            $error['category'] = 'Vui lòng chọn danh mục';

        if (empty($error)) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $desc,
                'created_at' => time(),
                'creator' => $_SESSION['username'],
                'thumb' => $upload_file,
                'status' => 0,
                'cat_id' => $cat,
                'short_desc' => $short_desc
            );
            if ((file_exists($upload_file) || move_uploaded_file($_FILES['file']['tmp_name'], $upload_file))) {
                add_post($data);
                $success = "<b class='text-success'>Thêm bài viết thành công!</b>";
            } else {
                $success = "<b class='text-red'>Thêm bài viết thất bại!</b>";
            }
        } else
            $success = "<b class='text-red'>Thêm bài viết thất bại</b>";
    }
    $list_cat = get_list_cat();
    $data['list_cat']=$list_cat;
    $data['success']=$success;
    load_view('addPost', $data);
}
function updateAction()
{
    global $error;
    $id = $_GET['id'];
    $post = get_post_by_id($id);
    $list_cat = get_list_cat();
    $error = array();
    $success="";
    if (isset($_POST['btn_update'])) {
        $post['title'] = $_POST['title'];
        $post['slug'] = $_POST['slug'];
        $post['content'] = $_POST['desc'];
        $post['cat_id'] = $_POST['category'];
        $post['short_desc']=$_POST['short_desc'];
        if (empty($post['title']))
            $error['title'] = 'Tiêu đề không được để trống';

        if ($post['cat_id'] == 0)
            $error['category'] = 'Vui lòng chọn danh mục';

        if (isset($_FILE['file'])) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $post['thumb'] = $upload_file;
            if (!file_exists($upload_file))
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
        }

        if (empty($error)) {
            $data = array(
                'title' => $post['title'],
                'slug' => $post['slug'],
                'content' => $post['content'],
                'thumb' => $post['thumb'],
                'cat_id' => $post['cat_id'],
                'short_desc' => $post['short_desc']
            );
            update_post($data, $post['id']);
            $success = "<b class='text-success'>Cập nhật bài viết thành công!</b>";
        } else {
            $success = "<b class='text-red'>Cập nhật bài viết thất bại</b>";
        }
    }
    $data = array(
        'post' => $post,
        'list_cat' => $list_cat,
        'success' => $success
    );
    load_view('update', $data);
}
function deleteAction()
{
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;
    $id = $_GET['id'];
    delete_post($id);
    $record_per_page = 6;
    $total_record = db_num_rows("select `id` from `tbl_post`");
    $total_page = ceil($total_record / $record_per_page);

    $page = min($page, $total_page);
    redirect("?mod=post&page=$page");
}
function multiAction()
{
    $page = $_POST['page'];
    $status=$_POST['status'];
    if (isset($_POST['btn_delete_posts'])) {
        $list_id = $_POST['list_id'];
        foreach ($list_id as $id => $v){
            delete_post($id);
        }
        $record_per_page = 6;
        $total_record = db_num_rows("select `id` from `tbl_post`");
        $total_page = ceil($total_record / $record_per_page);
        $page=min($page,$total_page);
        redirect("?mod=post&page=$page&status=$status");
    }
    if (isset($_POST['btn_approve_posts'])){
        $list_id=$_POST['list_id'];
        foreach ($list_id as $id => $v){
            approve_post($id);
        }
        redirect("?mod=post&page=$page&status=$status");
    }
    if (isset($_POST['btn_search'])){
        $key=$_POST['key'];
        redirect("?mod=post&page=$page&status=$status&key=$key");
    }
}
function approveAction(){
    $id=$_POST['id'];
    $num_approve=$_POST['numApproved'];
    $num_not_approve=$_POST['numNotApproved'];
    if (approve_post($id)){
        $data=array(
            'status' => 'Đã duyệt',
            'numApproved' => $num_approve+1,
            'numNotApproved' => $num_not_approve-1
        );
    }
    else{ 
        $data=array(
            'status' => '0',
        );
    }
    echo json_encode($data);
}

