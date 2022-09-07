
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
        <div id="login">
            <form action="" method="post">
                <h1>Đăng nhập</h1>
                <p>
                    <input type="text" name="username" value="<?php show_value('username') ?>" placeholder="Username">
                    <br>
                    <?php
                    print_error('username');
                    ?>
                </p>
                <p>
                    <input type="password" name="password" placeholder="Password">
                    <br>
                    <?php
                    if (!empty($error['password']))
                        echo $error['password'];
                    print_error('password');
                    ?>
                </p>
                <p>
                    <input type="submit" value="Đăng nhập" name="btnLogin" id="btn-login">
                    <?php
                    print_error('login');
                    ?>
                </p>
            </form>
        </div>

    </div>
</body>

</html>