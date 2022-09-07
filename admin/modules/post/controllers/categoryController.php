<?php
function construct()
{
    load_model("category");
    load('lib', 'upload-file');
    load('lib', 'validation');
};
function indexAction()
{
    global $config;
    $record_per_page = 2;
    $total_record = db_num_rows("select `id` from `tbl_post_cat`");
    $total_page = ceil($total_record / $record_per_page);
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;
    $start = ($page - 1) * $record_per_page;
    $list_cat = array_slice(get_list_cat(), $start, $record_per_page);
    $data = array(
        'list_cat' => $list_cat,
        'total_page' => $total_page,
        'config' => $config,
        'start' => $start,
        'page' => $page
    );
    load_view('indexCat', $data);
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
    load_view('addCat', $data);
}
function showCatAjaxAction()
{
    $page = (int) $_POST['page'];

    // Set page 
    $record_per_page = 2;
    $start = ($page - 1) * $record_per_page;
    $list_cat = array_slice(get_list_cat(), $start, $record_per_page);
    $start = ($page - 1) * $record_per_page;

    $count = $start;
    $content = "";
    foreach ($list_cat as $cat) {
        $id = $cat['id'];
        $content .= '<tr>
        <td><input type="checkbox" name="list_id[' . $id . ']" class="checkItem"></td>
        <input type="hidden" name="page" value="' . $page . '">
        <td><span class="tbody-text">' . ++$count . '</h3></span>
        <td class="clearfix">
            <div class="tb-title fl-left">
                <a href="javascript:void(0)" title="">' . print_char('-', $cat['level'] * 3) . ' ' . $cat['title'] . '</a>
            </div> 
            <ul class="list-operation fl-right">
                <li><a href="?mod=post&controller=category&action=update&id=' . $id . '" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                <li><a href="?mod=post&controller=category&action=delete&id=' . $id . '&page=' . $page . '" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
            </ul>
        </td>
        <td><span class="tbody-text">' . $cat['creator'] . '</span></td>
        <td><span class="tbody-text">' . date('d/m/Y', $cat['created_at']) . '</span></td>
    </tr>';
    }
    echo $content;
}
function updateAction()
{
    global $success;
    $id = $_GET['id'];
    $item = db_fetch_row("select * from `tbl_post_cat` where `id` = $id");
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
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete_cat($id);
    redirect("?mod=post&controller=category&page=$page");
}
function deleteCatsAction()
{
    $list_id = $_POST['list_id'];
    $page = $_POST['page'];

    foreach ($list_id as $id => $value)
        delete_cat((int)$id);

    $record_per_page = 2;
    $total_record = db_num_rows("select `id` from `tbl_post_cat`");
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    redirect("?mod=post&controller=category&page=$page");
}
