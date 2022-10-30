<?php
function construct()
{
    load_model('customer');
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

    $total_record = db_num_rows("select `id` from `tbl_customer` where `name` like '%$key%'");
    $total_page = ceil($total_record / $record_per_page);

    $start = ($page - 1) * $record_per_page;
    $list_customer = get_list_customer($key);
    $list_customer = count_sales_for_customer($list_customer);
    $list_customer = array_slice($list_customer, $start, $record_per_page);


    $data = array(
        'list_customer' => $list_customer,
        'total_customer' => $total_record,
        'total_page' => $total_page,
        'start' => $start,
        'page' => $page,
    );
    load_view('indexCustomer', $data);
}
function updateAction()
{
    global $error;
    $id = $_GET['id'];
    $customer = get_customer_by_id($id);
    $error = array();
    $success = "";
    if (isset($_POST['btn_update'])) {
        $customer['name'] = $_POST['name'];
        $customer['phone_number'] = $_POST['phone_number'];
        $customer['email'] = $_POST['email'];
        $customer['address'] = $_POST['address'];

        if (empty($_POST['name']))
            $error['name'] = 'Tên không được để trống';

        if (empty($_POST['phone_number']))
            $error['name'] = 'Số điện thoại không được để trống';

        if (empty($_POST['email']))
            $error['email'] = 'Email không được để trống';

        if (empty($_POST['address']))
            $error['address'] = 'Địa chỉ không được để trống';

        if (empty($error)) {
            $data = array(
                'name' => $customer['name'],
                'phone_number' => $customer['phone_number'],
                'email' => $customer['email'],
                'address' => $customer['address'],
            );
            if (update_customer($data, $id) > 0) {
                $success = "<b class='text-success'>Cập nhật khách hàng thành công!</b>";
            } else
                $success = "<b class='text-red'>Cập nhật khách hàng thất bại!</b>";
        } else
            $success = "<b class='text-red'>Cập nhật khách hàng thất bại!</b>";
    }
    $data = array(
        'customer' => $customer,
        'success' => $success
    );
    load_view('updateCustomer', $data);
}
function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete_customer($id);
    $record_per_page = $config['record_per_page'];
    $total_record = db_num_rows("select `id` from `tbl_customer`");
    $total_page = ceil($total_record / $record_per_page);
    $page = min($page, $total_page);
    $page = max(1, $page);
    redirect("?mod=sales&controller=customer&page=$page");
}
function multiAction()
{
    global $config;
    if (isset($_POST['btn_delete'])) {
        $page = $_POST['page'];
        $list_customer = $_POST['list_customer'];
        foreach ($list_customer as $id => $v)
            delete_customer($id);
        $record_per_page = $config['record_per_page'];
        $total_record = db_num_rows("select `id` from `tbl_customer`");
        $total_page = ceil($total_record / $record_per_page);
        $page = min($page, $total_page);
        $page = max(1, $page);
        redirect("?mod=sales&controller=customer&page=$page");
    }else if (isset($_POST['btn_search'])){
        $key=$_POST['key'];
        redirect("?mod=sales&controller=customer&key=$key");
    }
}
