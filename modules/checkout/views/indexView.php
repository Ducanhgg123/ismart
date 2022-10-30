<?php get_header() ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=checkout" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="name" id="name">
                            <b class="text-danger" id="name-error"></b>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                            <b class="text-danger" id="email-error"></b>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                            <b class="text-danger" id="address-error"></b>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone_number" id="phone-number">
                            <b class="text-danger" id="phone-number-error"></b>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" id="note"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($_SESSION['cart'])) { ?>
                            <?php
                            foreach ($_SESSION['cart'] as $id => $info) {
                                $product = get_product_by_id($id);
                            ?>
                                <tr class="cart-item">
                                    <td class="product-name"><?php echo $product['name'] ?><strong class="product-quantity">x <?php echo $info['qty'] ?></strong></td>
                                    <td class="product-total"><?php echo currency_format($_SESSION['cart'][$id]['total']) ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price"><?php if (!empty($_SESSION['cart_info']['total'])) echo currency_format($_SESSION['cart_info']['total']) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="0">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                        <li>
                            <input type="radio" id="direct-payment" name="payment-method" value="1">
                            <label for="direct-payment">Thanh toán online</label>
                        </li>
                    </ul>
                    <b class="text-danger" id="payment-error"></b>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" value="Đặt hàng" onclick="checkSubmit()">
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
<!-- Modal -->
<div class="modal fade" id="check-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận mua hàng?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="buy" onclick="buy()">Mua</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="get_value" value="">
<script>
    var customer_id;

    function checkPhone(str) {
        return /^[0-9]+$/.test(str);
    }

    function checkSubmit() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('address').value;
        var phone_number = document.getElementById('phone-number').value;
        var note = document.getElementById('note').value;
        var payment_method = document.querySelector('input[name="payment-method"]:checked');

        var error = new Object();
        if (name == '')
            error['name'] = "Tên không được để trống";

        if (email == '')
            error['email'] = 'Email không được để trống';
        else if (!email.includes('@'))
            error['email'] = 'Vui lòng nhập vào một email';

        if (address == '')
            error['address'] = "Địa chỉ không được để trống";

        if (phone_number == '')
            error['phone_number'] = "Số điện thoại không được để trống";
        else if (!checkPhone(phone_number))
            error['phone_number'] = 'Vui lòng nhập một số điện thoại';

        if (payment_method === null)
            error['payment-method'] = 'Vui lòng chọn phương thức thanh toán';
        else
            payment_method = payment_method.value;
        if (error && Object.keys(error).length === 0 && Object.getPrototypeOf(error) === Object.prototype) {

            $("#check-modal").modal('toggle');
            document.getElementById('name-error').innerHTML = "";
            document.getElementById('email-error').innerHTML = "";
            document.getElementById('address-error').innerHTML = "";
            document.getElementById('phone-number-error').innerHTML = "";
            document.getElementById('payment-error').innerHTML = "";

        } else {
            if (error.hasOwnProperty('name')) document.getElementById('name-error').innerHTML = error['name'];
            if (error.hasOwnProperty('email')) document.getElementById('email-error').innerHTML = error['email'];
            if (error.hasOwnProperty('address')) document.getElementById('address-error').innerHTML = error['address'];
            if (error.hasOwnProperty('phone_number')) document.getElementById('phone-number-error').innerHTML = error['phone_number'];
            if (error.hasOwnProperty('payment-method')) document.getElementById('payment-error').innerHTML = error['payment-method'];
        }
    }

    function buy() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('address').value;
        var phone_number = document.getElementById('phone-number').value;
        var note = document.getElementById('note').value;
        var payment_method = document.querySelector('input[name="payment-method"]:checked').value;

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "?mod=checkout&action=checkout");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("name="+name+"&email="+email+"&address="+address+"&phone_number="+phone_number+"&note="+note+"&delivery_info="+payment_method);
        xhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                if (this.responseText=="OK")
                    window.location.href="?mod=checkout&action=success";
            }
        }
    }
</script>