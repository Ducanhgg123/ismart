<?php get_header() ?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <form action="?mod=post&controller=category&action=deleteCats" method="POST">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                        <a href="?mod=post&controller=category&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                        <button title="" id="add-new" class="fl-left" style="cursor:pointer; border:none">Xóa</button>
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
                                <tbody id="table-content">
                                    <?php
                                    $count = $start;
                                    foreach ($list_cat as $cat) {
                                        $id = $cat['id'];
                                    ?>

                                        <tr>
                                            <td><input type="checkbox" name="list_id[<?php echo $id?>]" class="checkItem"></td>
                                            <input type="hidden" name="page" value="<?php echo $page?>">
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="javascript:void(0)" title=""><?php echo print_char('-', $cat['level'] * 3) . ' ' . $cat['title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=post&controller=category&action=update&id=<?php echo $id ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=post&controller=category&action=delete&id=<?php echo $id ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
                                    <span title="" class="pagination" onclick="loadData(<?php echo 1 ?>)">
                                        < </span>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <span title="" class="pagination" onclick="loadData(<?php echo $i ?>)"><?php echo $i ?></span>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <span class="pagination" onclick="loadData(<?php echo $total_page ?>)">></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadData(page) {
        $.ajax({
            url: "?mod=post&controller=category&action=showCatAjax",
            method: 'POST',
            data: {
                'page': page
            },
            dataType: 'text',
            success: function(data) {
                $("#table-content").html(data);
            }
        });
    }
</script>
<?php get_footer() ?>