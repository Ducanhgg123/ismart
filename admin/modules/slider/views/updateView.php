<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật slider</h3>
                    
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo $success?>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" value="<?php echo $slider['name']?>">
                        <?php print_error('name')?>
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" value="<?php echo $slider['link']?>">
                        <?php print_error('link')?>
                        <label for="order">Thứ tự</label>
                        <input type="number" name="order" id="order" value="<?php echo $slider['order']?>" min="0">
                        <?php print_error('order')?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload_file">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <img src="<?php echo $slider['image']?>" id="upload_thumb">
                        </div>
                        <?php print_error('file')?>
                        <label>Tình trạng</label>
                        <select name="status">
                            <option value="0" <?php if ($slider['status']==0) echo "selected"?>>Chờ duyệt</option>
                            <option value="1" <?php if ($slider['status']==1) echo "selected"?>>Công khai</option>
                        </select>
                        <button type="submit" name="btn_update" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    upload_file.onchange = evt => {
        var file = upload_file.files[0];
        if (file) {
            upload_thumb.src = URL.createObjectURL(file);
        }
    }
</script>
<?php get_footer() ?>