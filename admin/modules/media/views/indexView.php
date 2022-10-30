<?php get_header() ?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                </div>
            </div>

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=media">Tất cả <span class="count">(<?php echo $total ?>)</span></a></li>
                        </ul>
                    </div>
                    <form method="POST" action="?mod=media&action=multi">
                        <div class="actions">
                            <input type="submit" name="btn_delete" value="Xóa" style="padding:0px 15px">
                            <div class="fl-right">
                                <input type="text" name="key" id="s">
                                <input type="submit" name="btn_search" value="Tìm kiếm">
                            </div>
                            <input type="hidden" name="page" value="<?php echo $page ?>">
                        </div>

                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <!-- <td><span class="thead-text">Thời gian</span></td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_file as $file) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_file[<?php echo $file['name'] ?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="public/uploads/<?php echo $file['name'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <?php echo $file['name'] ?>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=media&action=update&name=<?php echo $file['name'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=media&action=delete&name=<?php echo $file['name'] ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <!-- <td><span class="tbody-text"><?php echo $file['created_at'] ?></span></td> -->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên file</span></td>
                                        <!-- <td><span class="tfoot-text">Thời gian</span></td> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php if ($total_page > 1) { ?>
                        <ul id="list-paging" class="fl-right">
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=media&page=<?php echo 1 ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?>" title="" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=media&page=<?php echo $i ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?>" title="" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=media&page=<?php echo $total_page ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?>" class="pagination">></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>