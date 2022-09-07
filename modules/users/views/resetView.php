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
            <h1>Reset password</h1>
            <p>
                <input type="text" name="email" value="<?php show_value('email')?>" placeholder="Email">
                <br>
                <?php
                    print_error('email');
                ?>
            </p>
            <p>
                <input type="submit" name="btnReset" value="Gửi email reset">
            </p>
            <a href="?mod=users&action=login">Đăng nhập</a> | <a href="?mod=users&action=reg">Đăng kí</a>
        </form>
    </div>
</body>

</html>