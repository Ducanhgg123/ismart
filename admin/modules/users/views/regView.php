<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/style-login.css">
</head>

<body>
    <div id="wrapper">
        <div id="register">
            <form action="" method="post">
                <h1>Đăng ký</h1>
                <p>
                    <input type="text" name="username" value="<?php show_value('username') ?>" placeholder="Tên đăng nhập">
                    <?php print_error('username') ?>
                </p>
                <p>
                    <input type="text" name="fullname" value="<?php show_value('fullname') ?>" placeholder="Họ và Tên">
                    <?php print_error('fullname') ?>
                </p>
                <p>
                    <input type="text" name="email" value="<?php show_value('email') ?>" placeholder="Email">
                    <?php print_error('email') ?>
                </p>
                <p>
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <?php print_error('password') ?>
                </p>
                <p>
                    <input type="text" name="phone_number" placeholder="Số điện thoại" value="<?php show_value('phone_number') ?>">
                    <?php print_error('phone_number') ?>
                </p>
                <p>
                    <input type="submit" value="Đăng ký" name="btnReg" id="btn-register">
                    <?php print_error('account') ?>
                </p>
                <a href="" style="font-size:14px; text-decoration:none;">Đăng nhập</a>
                <?php
                    show_value('regSuccess');
                ?>
            </form>
        </div>

    </div>
</body>

</html>