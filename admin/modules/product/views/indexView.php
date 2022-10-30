<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">

            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=product">Tất cả <span class="count">(<?php echo $total_product ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=product&status=1">Đã duyệt <span class="count">(<?php echo $total_approved_product ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=product&status=0">Chờ xét duyệt<span class="count">(<?php echo $total_unapproved_product ?>)</span> |</a></li>
                        </ul>

                    </div>
                    <form action="?mod=product&action=action" method="POST">
                        <div class="actions">
                            <input type="submit" value="Xóa" name="btn_delete"  style="padding:0px 10px;"/>
                            <input type="submit" value="Duyệt" name="btn_approve" title="" style="margin-left:10px; padding:0px 10px" />
                            <input type="hidden" value="<?php if (isset($_GET['page'])) echo $page;
                                                        else echo 1 ?>" name="page">
                            <div class="fl-right">
                                <input type="text" name="key" id="s">
                                <input type="submit" name="btn_search" value="Tìm kiếm">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Giảm giá</span></td>
                                        <td><span class="thead-text">Đã bán</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_product as $product) {
                                    ?>

                                        <tr>
                                            <td><input type="checkbox" name="list_product[<?php echo $product['id'] ?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $product['code'] ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $product['thumb'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="<?php echo $config['base_url']?>?controller=product&action=detail&id=<?php echo $product['id']?>" title=""><?php echo $product['name'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=product&action=update&id=<?php echo $product['id'] ?>&page=<?php echo $page ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=product&action=delete&id=<?php echo $product['id'] ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=product&action=approve&id=<?php echo $product['id'] ?>&page=<?php echo $page ?>" title="Duyệt" class="approve" onclick="approve(<?php echo $id ?>)"><i class="fa-solid fa-circle-check"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo currency_format($product['price']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_cat_name_by_id($product['cat_id']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product['discount'].'%' ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product['sold'] ?></span></td>
                                            <td><span class="tbody-text"><?php if ($product['status'] == 0) echo "Chờ duyệt";
                                                                            else echo "Đã duyệt" ?></span></td>
                                            <td><span class="tbody-text"><?php echo $_SESSION['username'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $product['created_at']) ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                        <td><span class="tfoot-text">Giá</span></td>
                                        <td><span class="tfoot-text">Danh mục</span></td>
                                        <td><span class="thead-text">Giảm giá</span></td>
                                        <td><span class="thead-text">Đã bán</span></td>
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
                    <?php if ($total_page > 1) { ?>
                        <ul id="list-paging" class="fl-right">
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=product&page=<?php echo 1 ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=product&page=<?php echo $i ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=product&page=<?php echo $total_page ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination">></a>
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