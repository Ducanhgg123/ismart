<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div id="wrapper">
        <form action="" method="post">
            <h1>Mật khẩu mới</h1>
            <p>
                <input type="password" name="password" value="" placeholder="Password">
                <br>
                <?php
                    print_error('password');
                ?>
            </p>
            <input type="hidden" name="reset_token" value=<?php echo $_GET['reset_token']?>>
            <p>
                <input type="submit" name="btnNewPass" value="Lưu mật khẩu mới">
                <?php
                    print_error('reset'); 
                ?>
            </p>
            <a href="?mod=users&action=login">Đăng nhập</a> | <a href="?mod=users&action=reg">Đăng kí</a>
        </form>
    </div>
</body>

</html>