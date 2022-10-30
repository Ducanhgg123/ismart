<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=sales">Tất cả <span class="count">(<?php echo $total_order ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=sales&status=1">Đã đăng <span class="count">(<?php echo $total_approved_order ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=sales&status=0">Chờ xét duyệt<span class="count">(<?php echo $total_unapproved_order ?>)</span> |</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">

                        </form>
                    </div>
                    <form method="POST" action="?mod=sales&action=multi" class="form-actions">
                        <div class="actions">
                            <input type="submit" name="btn_delete" value="Xóa">
                            <input type="submit" name="btn_approve" value="Duyệt">
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
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số sản phẩm</span></td>
                                        <td><span class="thead-text">Tổng giá</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_order as $order) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_sales[<?php echo $order['id'] ?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $order['code'] ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo get_order_name_by_id($order['user_id']) ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sales&action=update&id=<?php echo $order['id'] ?>&page=<?php echo $page ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=sales&action=delete&id=<?php echo $order['id'] ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo count_product($order['id']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format(cal_total($order['id']), ' VNĐ') ?></span></td>
                                            <td><span class="tbody-text"><?php if ($order['status'] == 0) echo "Chờ duyệt";
                                                                            else if ($order['status'] == 1) echo "Đã duyệt";
                                                                            else echo "Giao thành công" ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $order['created_at']) ?></span></td>
                                            <td><a href="?mod=sales&action=detail&id=<?php echo $order['id'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                        <td><span class="tfoot-text">Họ và tên</span></td>
                                        <td><span class="tfoot-text">Số sản phẩm</span></td>
                                        <td><span class="tfoot-text">Tổng giá</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                        <td><span class="tfoot-text">Chi tiết</span></td>
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
                                    <a href="?mod=sales&page=<?php echo 1 ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" title="" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=sales&page=<?php echo $i ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" title="" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=sales&page=<?php echo $total_page ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination">></a>
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