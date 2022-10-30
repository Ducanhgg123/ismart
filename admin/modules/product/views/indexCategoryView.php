<?php get_header() ?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <form action="?mod=product&controller=category&action=deleteCats" method="POST">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                        <a href="?mod=product&controller=category&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                        <button title="" id="add-new" class="fl-left" style="cursor:pointer; border:none">Xóa</button>
                        <input type="hidden" value="<?php if (isset($_GET['page'])) echo $page; else echo 1?>" >

                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = $start;
                                    foreach ($list_cat as $cat) {
                                        $id = $cat['id'];
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_cat[<?php echo $id?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo print_char('-', $cat['level'] * 3) . ' ' . $cat['title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=product&controller=category&action=update&id=<?php echo $id ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=product&controller=category&action=delete&id=<?php echo $id ?>&page=<?php if (isset($_GET['page'])) echo $_GET['page'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $cat['creator'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $cat['created_at']) ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php if ($total_page > 1) { ?>
                        <ul id="list-paging" class="fl-right">
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=product&controller=category&page=<?php echo 1 ?>" title="" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=product&controller=category&page=<?php echo $i ?>" title="" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=product&controller=category&page=<?php echo $total_page ?>" class="pagination">></a>
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