<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $code ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $address ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?php echo $delivery_info ?></span>
                    </li>
                    <form method="POST" action="?mod=sales&action=updateStatus">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option value='0' <?php if ($status == 0) echo 'selected' ?>>Chờ duyệt</option>
                                <option <?php if ($status == 1) echo 'selected' ?> value='1'>Đang vận chuyển</option>
                                <option <?php if ($status == 2) echo 'selected' ?> value='2'>Thành công</option>
                            </select>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="btn_update_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            foreach ($list_product as $product) {
                            ?>

                                <tr>
                                    <td class="thead-text"><?php echo ++$count ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="<?php echo $product['thumb'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?php echo $product['name'] ?></td>
                                    <td class="thead-text"><?php echo currency_format($product['price'], " VNĐ") ?></td>
                                    <td class="thead-text"><?php echo $product['qty'] ?></td>
                                    <td class="thead-text"><?php echo currency_format($product['qty'] * $product['price'], " VNĐ") ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Chú thích</h3>
                <textarea name="" id="note" cols="100" rows="10" class="form-control"><?php echo $note ?></textarea>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $num_product ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($total, " VNĐ") ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>