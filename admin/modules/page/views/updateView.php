<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <?php echo $success ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $info['title'] ?>">
                        <?php
                        print_error('title');
                        ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $info['slug'] ?>">
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $info['content'] ?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload_file">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb" onclick="uploadFile()"> -->
                            <img src="<?php echo $info['thumb']?>" id="upload_thumb">
                        </div>
                        <?php
                            print_error('file'); 
                        ?>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    upload_file.onchange=evt=>{
        var file=upload_file.files[0];
        if (file){
            upload_thumb.src=URL.createObjectURL(file);
        }
    }
</script>
<?php get_footer() ?>