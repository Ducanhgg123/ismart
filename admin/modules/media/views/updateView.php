<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật file</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo $success ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="name" id="product-name" value="<?php echo $name ?>">
                        <?php print_error('name') ?>
                        <label>Hình ảnh</label>
                        <img src="public/uploads/<?php echo $name ?>" id="upload_thumb" style="margin-bottom: 10px">
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>