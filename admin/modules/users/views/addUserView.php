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
        <?php get_sidebar("users") ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value="<?php show_value('username')?>">
                        <?php
                        print_error('username');
                        ?>

                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <?php
                        print_error('password');
                        ?>

                        <label for="password">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password" id="password">
                        <?php
                        print_error('confirm_password');
                        ?>

                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display_name" id="display-name" value="<?php show_value('fullname')?>">
                        <?php
                        print_error('fullname');
                        ?>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php show_value('email')?>">
                        <?php
                        print_error('email');
                        ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php show_value('phone_number')?>">
                        <?php
                        print_error('phone_number');
                        ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php show_value('address')?></textarea>
                        <?php
                        print_error('address');
                        ?>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                    <?php show_value('success')?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>