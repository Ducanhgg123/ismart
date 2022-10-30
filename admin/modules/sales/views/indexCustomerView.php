<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total_customer ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">

                        </form>
                    </div>
                    <form method="POST" action="?mod=sales&controller=customer&action=multi" class="form-actions">
                        <div class="actions">
                            <input type="submit" name="btn_delete" value="Xóa">
                            <div class="fl-right">
                                <input type="text" name="key" id="s">
                                <input type="submit" name="btn_search" value="Tìm kiếm">
                            </div>
                            <input type="hidden" name="page" value="<?php if (isset($_GET['page'])) echo $_GET['page']; else echo 1?>">


                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Đơn hàng</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_customer as $customer) { ?>

                                        <tr>
                                            <td><input type="checkbox" name="list_customer[<?php echo $customer['id'] ?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $customer['name'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sales&controller=customer&action=update&id=<?php echo $customer['id'] ?>&page=<?php echo $page ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=sales&controller=customer&action=delete&id=<?php echo $customer['id'] ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $customer['phone_number'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $customer['email'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $customer['address'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $customer['qty'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $customer['created_at'] ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-body">STT</span></td>
                                        <td><span class="tfoot-body">Họ và tên</span></td>
                                        <td><span class="tfoot-body">Số điện thoại</span></td>
                                        <td><span class="tfoot-body">Email</span></td>
                                        <td><span class="tfoot-body">Địa chỉ</span></td>
                                        <td><span class="tfoot-body">Đơn hàng</span></td>
                                        <td><span class="tfoot-body">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                    </form>
                </div>

            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail clearfix">
                <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                <?php if ($total_page > 1) { ?>
                    <ul id="list-paging" class="fl-right">
                        <?php if ($total_page > 2) { ?>
                            <li>
                                <a href="?mod=sales&controller=customer&page=<?php echo 1 ?>" title="" class="pagination">
                                    < </a>
                            </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li>
                                <a href="?mod=sales&controller=customer&page=<?php echo $i ?>" title="" class="pagination"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($total_page > 2) { ?>
                            <li>
                                <a href="?mod=sales&controller=customer&page=<?php echo $total_page ?>" class="pagination">></a>
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