<?php
    get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar()?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="?mod=sales&controller=customer&action=update&id=<?php echo $_GET['id']?>">
                        <?php echo $success?>
                        <label for="display-name">Tên</label>
                        <input type="text" name="name" id="display-name" value="<?php echo $customer['name']?>">
                        <?php
                            print_error('name'); 
                        ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $customer['email']?>">
                        <?php
                            print_error('email'); 
                        ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="phone_number" id="tel" value="<?php echo $customer['phone_number']?>">
                        <?php
                            print_error('phone_number'); 
                        ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" ><?php echo $customer['address']?></textarea>
                        <?php
                            print_error('address'); 
                        ?>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer();
?>