<?php
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" readonly="readonly" placeholder="<?php echo $username?>" class="form-readonly">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="old_pass" id="pass-old">
                        <?php
                        print_error('old_pass')
                        ?>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="new_pass" id="pass-new">
                        <?php
                        print_error('new_pass')
                        ?>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_pass" id="confirm-pass">
                        <?php
                        print_error('confirm_pass')
                        ?>
                        <button type="submit" name="btnReset" id="btn-submit">Cập nhật</button>
                    </form>
                    <?php if (!empty($success)) echo $success; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>