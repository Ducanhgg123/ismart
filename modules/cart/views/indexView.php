<?php get_header() ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix" style="min-height:200px">
        <?php if (!empty($_SESSION['cart'])) { ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $info) {
                                $product = get_product_by_id($info['id']);
                            ?>
                                <tr id="product-<?php echo $info['id'] ?>">
                                    <td><?php echo $product['code'] ?></td>
                                    <td>
                                        <a href="?controller=product&action=detail&id=<?php echo $info['id'] ?>" title="" class="thumb">
                                            <img src="admin/<?php echo $product['thumb'] ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?controller=product&action=detail&id=<?php echo $info['id'] ?>" title="" class="name-product"><?php echo $product['name'] ?></a>
                                    </td>
                                    <td><?php echo currency_format(get_real_price($product), 'đ') ?></td>
                                    <td>
                                        <input type="number" name="num-order" value="<?php echo $info['qty'] ?>" class="num-order" min="1" id="<?php echo $info['id'] ?>" onchange="updateCart(<?php echo $info['id'] ?>)" ?>
                                    </td>
                                    <td id="product-total-<?php echo $info['id'] ?>"><?php echo currency_format($info['total'], 'đ') ?></td>
                                    <td>
                                        <a href="javascript:void(0)" title="" class="del-product" onclick="deleteProduct(<?php echo $info['id'] ?>)"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span id="total-price-value"><?php echo currency_format($_SESSION['cart_info']['total']) ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="?mod=cart&action=deleteCart" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        <?php } else { ?>
            <p>Hiện không có sản phẩm trong giỏ hàng. Bấm <a href="?">vào đây</a> để trở lại trang mua sắm</p>
        <?php } ?>
    </div>
</div>
<?php get_footer() ?>
<script>
    function deleteProduct(id) {
        $.get("?mod=cart&action=delete&id=" + id, function(data) {
            document.getElementById("total-price-value").innerHTML = data;
        });
        document.getElementById("product-" + id).outerHTML = "";
        // console.log("product-"+id);
    }

    function updateCart(id) {
        var qty = document.getElementById(id).value;
        $.ajax({
            url: "?mod=cart&action=update&id" + id,
            type: "POST",
            dataType: "json",
            data: {
                'id': id,
                'qty': qty
            },
            success: function(data) {
                document.getElementById('total-price-value').innerHTML = data['total'];
                document.getElementById('product-total-' + id).innerHTML = data['sub_total'];
            }
        });
    }
    console.log(sessionStorage.getItem('cart'));
</script>