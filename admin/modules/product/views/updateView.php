<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo $success?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $product['name']?>">
                        <?php print_error('name')?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo $product['code']?>">
                        <?php print_error('code')?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $product['price']?>">
                        <?php print_error('price')?>
                        <label for="price">Giảm giá (%)</label>
                        <input type="number" name="discount" id="discount" value="<?php echo $product['discount']?>" min="0" max="100">
                        <?php print_error('discount')?>
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="short_desc" id="desc"><?php echo $product['short_desc']?></textarea>
                        <label for="desc">Chi tiết</label>
                        <textarea name="content" id="desc" class="ckeditor"><?php echo $product['content']?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload_file">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <img src="<?php echo $product['thumb']?>" id="upload_thumb">
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="category">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($list_cat as $cat) { ?>
                                <option value="<?php echo $cat['id']?>" <?php if ($product['cat_id']==$cat['id']) echo 'selected'?>><?php echo print_char('-',$cat['level']*2).$cat['title']?></option>
                            <?php } ?>
                        </select>
                        <?php print_error('category')?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="0" <?php if ($product['status']==0) echo 'selected'?>>Chờ duyệt</option>
                            <option value="1" <?php if ($product['status']==1) echo 'selected'?>>Đã đăng</option>
                        </select>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
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