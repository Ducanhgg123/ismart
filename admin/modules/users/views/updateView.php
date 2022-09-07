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
        <?php get_sidebar("users")?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="?mod=users&action=update">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display_name" id="display-name" value="<?php echo $info_user['fullname']?>">
                        <?php
                            print_error('fullname'); 
                        ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php echo $info_user['username']?>" readonly="readonly" style="cursor: not-allowed;background: #f3f3f3;">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email']?>">
                        <?php
                            print_error('email'); 
                        ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo $info_user['phone_number']?>">
                        <?php
                            print_error('phone_number'); 
                        ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" ><?php echo $info_user['address']?></textarea>
                        <?php
                            print_error('address'); 
                        ?>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                        <?php if (!empty($success)) echo $success;?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer();
?>