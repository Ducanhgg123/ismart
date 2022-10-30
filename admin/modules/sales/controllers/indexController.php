<?php
function construct()
{
    load_model('index');
    load('helper', 'format');
    load('helper', 'string');
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

    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $total_record = db_num_rows("select `id` from `tbl_sales` where `status` = $status and `code` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    } else {
        $status = -1;
        $total_record = db_num_rows("select `id` from `tbl_sales` where `code` like '%$key%'");
        $total_page = ceil($total_record / $record_per_page);
    }

    $list_sales = get_list_sales($status, $key);
    $start = ($page - 1) * $record_per_page;
    $list_sales = array_slice($list_sales, $start, $record_per_page);

    $data = array(
        'list_order' => $list_sales,
        'total_order' => get_num_sales_by_status(-1),
        'total_approved_order' => get_num_sales_by_status(1),
        'total_unapproved_order' => get_num_sales_by_status(0),
        'total_page' => $total_page,
        'start' => $start,
        'page' => $page,
        'status' => $status
    );
    load_view('index', $data);
}
function detailAction()
{
    $id = $_GET['id'];
    $list_cart = db_fetch_array("select * from `tbl_cart` where `sale_id` = $id");
    $sale = get_sale_by_id($id);

    $list_product = array();
    foreach ($list_cart as $cart) {
        $product = get_product_by_id($cart['product_id']);
        $product['qty'] = $cart['qty'];
        $list_product[$product['id']] = $product;
    }

    if ($sale['delivery_info'] == 0)
        $delivery_info = "Thanh toán tại nhà";
    else
        $delivery_info = "Thanh toán online";
    $data = array(
        'id' => $id,
        'code' => $sale['code'],
        'address' => $sale['address'],
        'delivery_info' => $delivery_info,
        'status' => $sale['status'],
        'list_product' => $list_product,
        'note' => $sale['note'],
        'num_product' => count_product($sale['id']),
        'total' => cal_total($sale['id'])
    );
    load_view('detailOrder', $data);
}
function updateStatusAction()
{
    if (isset($_POST['btn_update_status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        update_status($id, $status);
        redirect("?mod=sales&action=detail&id=$id");
    }
}
function updateAction()
{
    global $error;
    $id = $_GET['id'];
    $sale = get_sale_by_id($id);
    $success = "";
    $error = array();
    if (isset($_POST['btn_update'])) {
        $sale['address'] = $_POST['address'];
        $sale['delivery_info'] = $_POST['delivery_info'];
        $sale['status'] = $_POST['status'];

        if (empty($_POST['address']))
            $error['address'] = "Địa chỉ không được để trống";
        if (empty($error)) {
            $data = array(
                "address" => $sale['address'],
                "delivery_info" => $sale['delivery_info'],
                "status" => $sale['status']
            );
            if (update_sale($data, $id))
                $success = "<b class='text-success'>Cập nhật thành công!</b>";
            else
                $success = "<b class='text-red'>Cập nhật thất bại!</b>";
        } else
            $success = "<b class='text-red'>Cập nhật thất bại!</b>";
    }
    $data = array(
        "sale" => $sale,
        "success" => $success
    );
    load_view('update', $data);
}
function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete_sale($id);
    $record_per_page = $config['record_per_page'];
    $total_record = get_num_sales_by_status(-1);
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=sales&page=$page");
}
function multiAction()
{
    global $config;
    $page = $_POST['page'];
    $list_sales = array();
    if (isset($_POST['list_sales']))
        $list_sales = $_POST['list_sales'];
    if (isset($_POST['btn_delete'])) {
        foreach ($list_sales as $id => $v) {
            delete_sale($id);
        }
        $record_per_page = $config['record_per_page'];
        $total_record = get_num_sales_by_status(-1);
        $total_page = ceil($total_record / $record_per_page);
        $page = min($page, $total_page);
        $page = max(1, $page);
        redirect("?mod=sales&page=$page");
    } else if (isset($_POST['btn_approve'])) {
        foreach ($list_sales as $id => $v) {
            approve_sale($id);
        }
        redirect("?mod=sales&page=$page");
    } else if (isset($_POST['btn_search'])) {
        $key = $_POST['key'];
        redirect("?mod=sales&key=$key");
    }
}
