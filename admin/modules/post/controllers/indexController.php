<?php
function construct()
{
    load_model("post");
    load_model('category');
    load('helper','string');
    load('lib', 'upload-file');
    load('lib', 'validation');
};
function indexAction()
{
    load_view('index');
}
function addAction()
{
    global $error, $title, $slug, $desc,$success;
    $error = array();
    $success="";
    if (isset($_POST['btn_add'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $cat=$_POST['category'];

        if (empty($title))
            $error['title'] = 'Tiêu đề không được để trống';

        if (!isset($_FILES['file'])){
            echo "asdsa";
            $error['file'] = 'Vui lòng chọn hình ảnh';
        }
        
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
                'thumb' => $upload_file,
                'status' => 0,
                'cat_id' => $cat
            );
            if (( file_exists($upload_file)|| move_uploaded_file($_FILES['file']['tmp_name'], $upload_file))) {
                add_post($data);
                $success = "<b class='text-success'>Thêm bài viết thành công!</b>";
            } else{
                $success = "<b class='text-red'>Thêm bài viết thất bại!</b>";
            }
        } else
            $success = "<b class='text-red'>Thêm bài viết thất bại</b>";
    }
    $list_cat=get_list_cat();
    foreach ($list_cat as &$cat){
        $cat['title']=print_char('-',$cat['level']*3).' '.$cat['title'];
    }
    $data=array(
        'list_cat' => $list_cat
    );
    load_view('addPost',$data);
}
