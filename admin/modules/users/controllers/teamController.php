<?php
function construct()
{
    load_model("user");
    load('lib', 'validation');
};
function indexAction()
{
    $data['list_users'] = get_list_users();
    load_view('team', $data);
}
function addUserAction()
{
    global $error, $username, $password, $confirm_password, $fullname, $email, $phone_number, $address,$success;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $fullname = $_POST['display_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['tel'];
        $address = $_POST['address'];
        // check username
        if (empty($username))
            $error['username'] = 'Tên đăng nhập không được để trống';
        else if (!is_username($username))
            $error['username'] = 'Tên đăng nhập không đúng định dạng';
        else if (check_username_exists($username))
            $error['username'] = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác';

        // Check password
        if (empty($password))
            $error['password'] = 'Mật khẩu không được để trống';
        else if (!is_password($password))
            $error['password'] = 'Mật khẩu không đúng định dạng';

        // Check confirm password
        if (empty($confirm_password))
            $error['confirm_password'] = 'Mật khẩu không được để trống';
        else if (!is_password($confirm_password))
            $error['confirm_password'] = 'Mật khẩu không đúng định dạng';
        else if ($password!=$confirm_password)
            $error['confirm_password']='Xác nhận mật khẩu sai, vui lòng kiểm tra lại!';
        
        //check fullname
        if (empty($fullname))
            $error['fullname']='Tên hiển thị không được để trống';
        
        // check email
        if (empty($email))
            $error['email']='Email không được để trống';
        else if (!is_email($email))
            $error['email']='Email không đúng định dạng';
        else if (check_email_exists($email))
            $error['email']='Email đã được sử dung, vui lòng chọn một email khác';
        
        // check phone number
        if (empty($phone_number))
            $error['phone_number']='Số điện thoại không được để trống';
        else if (!is_phone_number($phone_number))
            $error['phone_number']='Số điện thoại không đúng định dạng';
        
        //check address
        if (empty($address))
            $error['address']='Địa chỉ không được để trống';
        
        if (empty($error)){
            $info=array(
                'username' => $username,
                'password' => md5($password),
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address
            );
            add_user($info);
            $success="<b class='text-success'>Thêm quản trị viên thành công</b>";
        }else{
            $success="<b class='text-red'>Thêm quản trị viên thất bại</b>";
        }
        
    }
    load_view('addUser');
}
function updateAction(){
    global $error;
    $id=$_GET['id'];
    $info_user=get_user_by_id($id);
    $error=array();
    if (isset($_POST['btn_update'])){
        
        $fullname=$_POST['display_name'];
        $email=$_POST['email'];
        $phone_number=$_POST['tel'];
        $address=$_POST['address'];

        $info_user['fullname']=$fullname;
        $info_user['email']=$email;
        $info_user['phone_number']=$phone_number;
        $info_user['address']=$address;

        if (empty($fullname))
            $error['fullname']='Tên hiển thị không được để trống';
        
        if (empty($email))
            $error['email']='Email không được để trống';
        else if (!is_email($email))
            $error['email']='Email không đúng định dạng';
        
        if (empty($phone_number))
            $error['phone_number']='Số điện thoại không được để trống';
        else if (!is_phone_number($phone_number))
            $error['phone_number']='Số điện thoại không đúng định dạng';
        
        if (empty($address))
            $error['address']='Địa chỉ không được để trống';
        
        if (empty($error)){
            $data_update=array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address
            );
            db_update('`tbl_users`',$data_update,"`id` = '$id'");
            $success="<b class='text-success'> Cập nhật thông tin thành công </b>";
        }else{
            $success="<b class='text-red'> Cập nhật thông tin không thành công </b>";
        }
        $data['success']=$success;
    }
    $data['info_user']=$info_user;
    load_view('update',$data);
}
function deleteAction(){
    $id=$_GET['id'];
    delete_user_by_id($id);
    redirect('?mod=users&controller=team');
}
function searchAction(){
    $key=$_POST['search'];
    $list_users=db_fetch_array("select * from `tbl_users` where `fullname` like '%$key%'");
    $data['list_users']=$list_users;
    load_view('team',$data);
}
function resetAction(){
    global $error;
    $success='';
    $id=$_GET['id'];
    $user=get_user_by_id($id);
    if (isset($_POST['btnReset'])) {
        $error = array();
        $new_pass=$_POST['new_pass'];
        $old_pass=$_POST['old_pass'];
        $confirm_pass=$_POST['confirm_pass'];

        // Check old password
        if (empty($old_pass))
            $error['old_pass'] = 'Mật khẩu không được để trống';
        else if (!is_password($old_pass))
            $error['old_pass'] = 'Mật khẩu không đúng định dạng';
        else if (md5($old_pass)!=$user['password'])
            $error['old_pass']='Mật khẩu chưa chính xác';
        
        // Check new password
        if (empty($new_pass))
            $error['new_pass'] = 'Mật khẩu không được để trống';
        else if (!is_password($new_pass))
            $error['new_pass'] = 'Mật khẩu không đúng định dạng';
        
        // Check confirm pass
        if (empty($confirm_pass))
            $error['confirm_pass'] = 'Mật khẩu không được để trống';
        else if (!is_password($confirm_pass))
            $error['confirm_pass'] = 'Mật khẩu không đúng định dạng';
        else if ($new_pass!=$confirm_pass)
            $error['confirm_pass']='Mật khẩu mới khác mật khẩu xác nhận';

        if (empty($error)) {
            update_new_password($id,$new_pass);
            $success="<b class='text-success'>Cập nhật mật khẩu thành công</b>";
        }
    }
    $data['success']=$success;
    $data['username']=$user['username'];
    load_view('resetTeam',$data);
}
function deleteUsersAction(){
    $list_id=$_POST['list_id'];
    foreach($list_id as $id=>$v){
        delete_user_by_id($id);
    }
    redirect('?mod=users&controller=team');
}
