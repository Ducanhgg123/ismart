<!DOCTYPE html>
<html>
    <head>
        <title>ISMART STORE</title>
        <meta charset="UTF-8">
        <base href="http://localhost/UNITOP/Back_End/PHP%20Matser/project/ismart/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="trang-chu.html" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="danh-muc-san-pham.html" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="blog.html" title="">Blog</a>
                                    </li>
                                    <?php
                                        foreach ($list_page as $page){ 
                                    ?>
                                    <li>
                                        <a href="thong-tin/<?php echo $page['id']?>/<?php echo $page['slug']?>" title=""><?php echo $page['title']?></a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="trang-chu.html" title="" id="logo" class="fl-left"><img src="public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="danh-muc-san-pham.html">
                                    <input type="text" name="key" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num"><?php if (!empty($_SESSION['cart_info']['qty'])) echo $_SESSION['cart_info']['qty']?></span>
                                    </div>
                                    <div id="dropdown">
                                        <p class="desc">Có <span><?php if (!empty($_SESSION['cart_info']['qty'])) echo $_SESSION['cart_info']['qty']; else echo 0?> sản phẩm</span> trong giỏ hàng</p>
                                        <?php if (!empty($_SESSION['cart_info']['qty'])){?>
                                        <ul class="list-cart">
                                            <?php foreach($_SESSION['cart'] as $id=>$info){
                                                $product=get_product_by_id($id);
                                            ?>
                                            <li class="clearfix">
                                                <a href="?controller=product&action=detail&id=<?php echo $id?>" title="" class="thumb fl-left">
                                                    <img src="admin/<?php echo $product['thumb']?>" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="?controller=product&action=detail&id=<?php echo $id?>" title="" class="product-name"><?php echo $product['name']?></a>
                                                    <p class="price"><?php echo currency_format($info['total'])?></p>
                                                    <p class="qty">Số lượng: <span><?php echo $info['qty']?></span></p>
                                                </div>
                                            </li>
                                            <?php }?>
                                        </ul>
                                        <?php }?>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php if (!empty($_SESSION['cart_info']['total'])) echo currency_format($_SESSION['cart_info']['total']); else echo currency_format(0)?></p>
                                        </div>
                                        <dic class="action-cart clearfix">
                                            <a href="?mod=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="?mod=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>