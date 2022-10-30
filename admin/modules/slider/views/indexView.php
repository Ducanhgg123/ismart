<?php get_header() ?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=slider&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=slider&status=-1">Tất cả <span class="count">(<?php echo $total ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=slider&status=1">Công khai <span class="count">(<?php echo $num_approved ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=slider&status=0">Chờ duyệt<span class="count">(<?php echo $num_unapproved ?>)</span></a></li>
                        </ul>


                    </div>
                    <form method="POST" action="?mod=slider&action=multi">
                        <div class="actions">
                            <input type="submit" name="btn_delete" value="Xóa" style="padding:0px 10px">
                            <input type="submit" name="btn_approve" value="Duyệt" style="padding:0px 10px">
                            <div class="fl-right">
                                <input type="text" name="key" id="s">
                                <input type="submit" name="btn_search" value="Tìm kiếm">
                            </div>
                            <input type="hidden" name="page" value="<?php echo $page?>">
                            <input type="hidden" name="status" value="<?php echo $status?>">
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên</span></td>
                                        <td><span class="thead-text">Link</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_slider as $slider) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_slider[<?php echo $slider['id'] ?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $slider['image'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $slider['name'] ?></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $slider['link'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=slider&action=update&id=<?php echo $slider['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=slider&action=delete&id=<?php echo $slider['id'] ?>&page=<?php echo $page ?>&status=<?php echo $status?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=slider&action=approve&id=<?php echo $slider['id'] ?>&page=<?php echo $page ?>&status=<?php echo $status?>" title="Duyệt" class="approve"><i class="fa-solid fa-circle-check"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $slider['order'] ?></span></td>
                                            <td><span class="tbody-text"><?php if ($slider['status'] == 0) echo "Chờ duyệt";
                                                                            else echo "Công khai" ?></span></td>
                                            <td><span class="tbody-text"><?php echo $slider['creator'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $slider['created_at']) ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên</span></td>
                                        <td><span class="tfoot-text">Link</span></td>
                                        <td><span class="tfoot-text">Thứ tự</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
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
                                    <a href="?mod=slider&page=<?php echo 1 ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?><?php if (isset($_GET['status'])) echo "&status=" . $_GET['status'] ?>" title="" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=slider&page=<?php echo $i ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?><?php if (isset($_GET['status'])) echo "&status=" . $_GET['status'] ?>" title="" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=slider&page=<?php echo $total_page ?><?php if (isset($_GET['key'])) echo "&key=" . $_GET['key'] ?><?php if (isset($_GET['status'])) echo "&status=" . $_GET['status'] ?>" class="pagination">></a>
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