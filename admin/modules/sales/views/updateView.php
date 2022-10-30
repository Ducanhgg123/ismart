<?php get_header()?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo $success?>
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="<?php echo $sale['address']?>">
                        <?php print_error('address')?>
                        <label>Trạng thái đơn hàng</label>
                        <select name="status">
                            <option value="0" <?php if ($sale['status']==0) echo "selected"?>>Chờ duyệt</option>
                            <option value="1" <?php if ($sale['status']==1) echo "selected"?>>Đã duyệt</option>
                            <option value="2" <?php if ($sale['status']==2) echo "selected"?>>Giao thành công</option>
                        </select>
                        <label>Hình thức giao hàng</label>
                        <select name="delivery_info">
                            <option value="0" >-- Chọn hình thức --</option>
                            <option value="0" <?php if ($sale['delivery_info']==0) echo "selected"?>>Giao hàng tại nhà</option>
                            <option value="1" <?php if ($sale['delivery_info']==1) echo "selected"?>>Giao hàng online</option>
                        </select>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>