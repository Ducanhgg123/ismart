<?php
function construct()
{
    load_model("user");
    load('lib', 'validation');
};
function indexAction(){
    global $error, $username, $password;
    if (isset($_POST['btnLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $error = array();
        //Check username
        if (empty($username))
            $error['username'] = 'Tên đăng nhập không được để trống';
        else if (strlen($username) < 6 || strlen($username) > 32)
            $error['username'] = 'Tên đăng nhập chỉ dài từ 6 đến 32 kí tự ';
        else  if (!is_username($username))
            $error['username'] = 'Tên đăng nhập không đúng định dạng';

        // Check password
        if (empty($password))
            $error['password'] = 'Mật khẩu không được để trống';
        else if (strlen($password) < 6 || strlen($password) > 32)
            $error['password'] = 'Mật khẩu có ít nhất 6 kí tự và tối đa 32 kí tự';
        else if (!is_password($password))
            $error['password'] = 'Mật khẩu không đúng định dạng';

        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['username'] = $username;
                redirect('?');
            } else
                $error['login'] = 'Đăng nhập thất bại';
        }
    }
    load_view('login');
}
function logoutAction(){
    logout();
}
function updateAction(){
    global $error;
    $info_user=get_user_by_username($_SESSION['username']);
    $error=array();
    if (isset($_POST['btn_update'])){
        
        $fullname=$_POST['display_name'];
        $email=$_POST['email'];
        $phone_number=$_POST['tel'];
        $address=$_POST['address'];
        $username=$_SESSION['username'];

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
            db_update('`tbl_users`',$data_update,"`username` = '$username'");
            $success="<b class='text-success'> Cập nhật thông tin thành công </b>";
        }else{
            $success="<b class='text-red'> Cập nhật thông tin không thành công </b>";
        }
        $data['success']=$success;
    }
    $data['info_user']=$info_user;
    load_view('update',$data);
}
function resetPasswordAction()
{
    global $error;
    $success='';
    if (isset($_POST['btnReset'])) {
        $error = array();
        $new_pass=$_POST['new_pass'];
        $old_pass=$_POST['old_pass'];
        $confirm_pass=$_POST['confirm_pass'];
        $user=get_user_by_username($_SESSION['username']);

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
            update_new_password($user['id'],$new_pass);
            $success="<b class='text-success'>Cập nhật mật khẩu thành công</b>";
        }
    }
    $data['success']=$success;
    load_view('reset',$data);
}
