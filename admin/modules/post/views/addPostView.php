<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php show_value('title')?>">
                        <?php print_error('title')?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php show_value('slug')?>">
                        <?php print_error('slug')?>
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"value="<?php show_value('desc')?>"><?php show_value('content')?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload_file">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <img src="public/images/img-thumb.png" id="upload_thumb">
                        </div>
                        <?php print_error('file')?>
                        <label>Danh mục</label>
                        <select name="category">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php foreach ($list_cat as $cat) { ?>
                                <option value="<?php echo print_char('-',$cat['level']*2).' '.$cat['id']?>"><?php echo $cat['title']?></option>
                            <?php } ?>
                        </select>
                        <?php print_error('category')?>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                        <?php show_value('success')?>
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