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
            <h1>Đăng kí</h1>
            <p>
                <input type="text" name="username" value="<?php show_value('username')?>" placeholder="Username">
                <?php print_error('username')?>
            </p>
            <p>
                <input type="text" name="fullname" value="<?php show_value('fullname')?>" placeholder="Fullname">
                <?php print_error('fullname')?>
            </p>
            <p>
                <input type="text" name="email" value="<?php show_value('email')?>" placeholder="Email">
                <?php print_error('email')?>
            </p>
            <p>
                <input type="password" name="password" placeholder="Password">
                <?php print_error('password')?>
            </p>
            <p>
                <input type="submit" value="Đăng kí" name="btnReg">
                <?php print_error('account')?>
            </p>
            <a href="">Đăng nhập</a>
        </form>
    </div>
</body>

</html>