<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style-main.css">
    <base href="<?php echo base_url();?>">
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/js/app.js"></script>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <p>Xin chào <?php echo $_SESSION['username']?> (<a href="?mod=users&action=logout">Thoát</a>)</p>
            <ul id="main-menu">
                <li><a href="?mod=home&action=index">Home</a></li>
                <li><a href="gioi-thieu-1.html">Giới thiệu</a></li>
                <li><a href="?mod=users&controller=index&action=index">Thành viên</a></li>
                <li><a href="?mod=order">Đơn hàng</a></li>
            </ul>
        </div>