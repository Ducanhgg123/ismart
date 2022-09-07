<?php
function construct()
{
    load_model("category");
    load('lib', 'upload-file');
    load('lib', 'validation');
};
function indexAction()
{
    load_view('index');
}
function addAction()
{
    global $error, $title, $success, $slug, $desc;
    $error = array();
    if (isset($_POST['btn_add'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $cat=$_POST['category'];

        if (empty($title))
            $error['title'] = 'Tiêu đề không được để trống';

        if (!isset($_FILES['file']))
            $error['file'] = 'Vui lòng chọn hình ảnh';
        
        if ($cat==0)
            $error['category']='Vui lòng chọn danh mục';

        if (empty($error)) {
            $upload_dir = 'public/uploads/';
            $upload_file = $upload_dir . $_FILES['file']['name'];
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $desc,
                'created_at' => time(),
                'creator' => $_SESSION['username'],
                'thumb' => $upload_file
            );

            if (add_post($data) > 0 && move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                $success = "<b class='text-success'>Thêm bài viết thành công!</b>";
            } else
                $success = "<b class='text-red'>Thêm bài viết thất bại!</b>";
        } else
            $success = "<b class='text-red'>Thêm bài viết thất bại</b>";
    }
    $data=array(
        'list_cat' => get_list_cat()
    );
    load_view('addPost',$data);
}
