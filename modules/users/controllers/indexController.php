
<?php
function construct()
{
    load_model("user");
    load('lib', 'validation');
    load('lib', 'email');
};
function regAction()
{
    global $error, $username, $fullname, $password, $email;
    if (isset($_POST['btnReg'])) {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $error = array();
        // Check username
        if (empty($username))
            $error['username'] = 'Tên đăng nhập không được để trống';
        else if (strlen($username) < 6 || strlen($username) > 32)
            $error['username'] = 'Tên đăng nhập có ít nhất 6 kí tự và tối đa 32 kí tự';
        else if (!is_username($username))
            $error['username'] = 'Tên đăng nhập không đúng định dạng';

        // Check fullname
        if (empty($fullname))
            $error['fullname'] = 'Tên người dùng không được để trống';

        // Check password
        if (empty($password))
            $error['password'] = 'Mật khẩu không được để trống';
        else if (strlen($password) < 6 || strlen($password) > 32)
            $error['password'] = 'Mật khẩu có ít nhất 6 kí tự và tối đa 32 kí tự';
        else if (!is_password($password))
            $error['password'] = 'Mật khẩu không đúng định dạng';

        // Check email
        if (empty($email))
            $error['email'] = 'Email không được để trống';
        else if (!is_email($email))
            $error['email'] = 'Email không đúng định dạng';

        if (empty($error)) {
            if (user_exist($username, $email))
                $error['account'] = 'Tên đăng nhập hay email đã tồn tại';
            else {
                $active_token = md5($username . time());
                $data = array(
                    'username' => $username,
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => md5($password),
                    'active_token' => $active_token
                );
                $active_link = base_url("?mod=users&action=activeAccount&active_token=$active_token");
                $content = "<p>Chào bạn $fullname</p>
                    <p>Chúc mừng bạn đã đăng kí thành công, vui lòng nhấn vào link này để kích hoạt tài khoản: $active_link</p>
                    <p>Thân!</p>";
                send_mail($email, $fullname, "Kích hoạt tài khoản của bạn", $content);
                add_user($data);
            }
        }
    }
    load_view('reg');
}
function loginAction()
{
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
                redirect();
            } else
                $error['login'] = 'Đăng nhập thất bại';
        }
    }
    load_view('login');
}
function activeAccountAction()
{
    $login_url = base_url("?mod=users&action=login");
    $active_token = $_GET['active_token'];
    if (check_active_account($active_token) > 0) {
        activeAccount($active_token);
        echo "Bạn đã kích hoạt tài khoản thành công, bấm <a href='$login_url'>vào đây</a> để quay trở về trang đăng nhập";
    } else
        echo "Kích hoạt thất bại hoặc tài khoản đả được kích hoạt, bấm <a href='$login_url'>vào đây</a> để quay trở về trang đăng nhập";
}
function logoutAction()
{
    logout();
    redirect("?mod=users&action=login");
}
function resetAction()
{
    global $error, $email;
    if (isset($_POST['btnReset'])) {
        $email = $_POST['email'];
        // Check email
        $error = array();
        if (empty($email))
            $error['email'] = 'Email không được để trống';
        else if (!is_email($email))
            $error['email'] = 'Email không đúng định dạng';

        if (empty($error)) {
            if (check_email_exists($email)) {
                $reset_token = md5($email . time());
                $reset_link = base_url("?mod=users&action=newPass&reset_token=$reset_token");
                update_reset_token($email, $reset_token);

                $content = "<p>Chào bạn,</p>
                <p>Vui lòng nhấn vào link sau để đặt lại mật khẩu: $reset_link</p>
                <p>Thân</p>";
                send_mail($email, '', 'Đặt lại mật khẩu', $content);
            } else {
                $error['email'] = 'Email không tồn tại';
            }
        }
    }
    load_view('reset');
}
function newPassAction()
{
    global $error, $password;
    if (isset($_POST['btnNewPass'])) {
        $password = $_POST['password'];
        $reset_token = $_POST['reset_token'];

        // Check password
        if (empty($password))
            $error['password'] = 'Mật khẩu không được để trống';
        else if (strlen($password) < 6 || strlen($password) > 32)
            $error['password'] = 'Mật khẩu có ít nhất 6 kí tự và tối đa 32 kí tự';
        else if (!is_password($password))
            $error['password'] = 'Mật khẩu không đúng định dạng';

        if (empty($error)) {
            if (check_reset_token($reset_token)) {
                update_password($password, $reset_token);
                load_view('resetSuccess');
            } else {
                $error['reset'] = 'Mã reset không tồn tại';
                load_view('newPass');
            }
        }
    } else
        load_view('newPass');
}
