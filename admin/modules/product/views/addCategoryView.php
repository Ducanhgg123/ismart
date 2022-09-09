<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php show_value('title') ?>">
                        <?php print_error('title') ?>
                        <label>Danh mục cha</label>
                        <select name="parent-cat">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="0">Danh mục gốc (không có danh mục cha)</option>
                            <?php foreach ($list_cat as $cat) { ?>
                                <option value="<?php echo $cat['id']?>"><?php echo print_char('-',$cat['level']*2).' '.$cat['title']?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                        <?php show_value('success')?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>