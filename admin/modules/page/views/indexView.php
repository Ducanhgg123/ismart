<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?mod=page&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=page">Tất cả <span class="count">(<?php echo get_total_page(); ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=page&action=approvedPage">Đã duyệt (<span class="count" id="approved"><?php echo get_total_approved_page() ?></span>)</a> |</li>
                            <li class="pending"><a href="?mod=page&action=notApprovedPage">Chờ xét duyệt (<span class="count" id="not-approved"><?php echo get_total_not_approved_page() ?></span>) |</a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right" action="?mod=page&action=search">
                            <input type="text" name="key" id="s">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=page&action=deletePages" class="form-actions">
                            <input type="submit" name="btn_delete_pages" value="Xóa các trang">
                            <div class="table-responsive">
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Ngày tạo</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                        </tr>
                                    </thead>
                                    <tbody id="table-content">
                                        <?php
                                        $count = 0;
                                        foreach ($list_page as $page) {
                                            $id = $page['id'];
                                            $count++;
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="list_id[<?php echo $id?>]" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $count ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="<?php echo $config['base_url'] . "?mod=page&id=$id" ?>" title=""><?php echo $page['title'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=page&action=update&id=<?php echo $id ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=page&action=delete&id=<?php echo $id ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        <li><a href="javascript:void(0);" title="Duyệt" class="approve" onclick="approve(<?php echo $id?>)"><i class="fa-solid fa-circle-check"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $_SESSION['username'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo date('d/m/Y', $page['created_at']) ?></span></td>
                                                <td id="approve-status-<?php echo $id?>"><?php if ($page['approved']) echo "Đã duyệt"; else echo "Chờ kiểm duyệt"?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <?php if ($total_page > 1) { ?>
                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <ul id="list-paging" class="fl-right">
                            <li>
                                <span class="pagination" onclick="loadData(1)">
                                    < </span>
                            </li>
                            <?php
                            for ($i = 1; $i <= $total_page; $i++) {
                            ?>
                                <li>
                                    <span class="pagination" onclick="loadData(<?php echo $i ?>)"><?php echo $i ?></span>
                                </li>
                            <?php } ?>
                            <li>
                                <span class="pagination" onclick="loadData(<?php echo $total_page ?>)">></span>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function loadData(page) {
        $.ajax({
            url: "?mod=page&action=paginationAjax",
            method: 'POST',
            data: {
                'page': page
            },
            dataType: 'text',
            success: function(data) {
                document.getElementById("table-content").innerHTML = data;
            }
        });
    };
    function approve(id){
        var numApproved=$("#approved").text();
        var numNotApproved=$("#not-approved").text();
        $.ajax({
            url: '?mod=page&action=approve',
            method: 'POST',
            data: {'id':id, 'numApproved' : numApproved,'numNotApproved':numNotApproved},
            dataType: 'json',
            success: function(data){
                if (data['status']!="0"){
                    $("#approve-status-"+id).html(data['status']);
                    $("#approved").html(data['numApproved']);
                    $("#not-approved").html(data['numNotApproved']);
                }
            }
        });
    }
    $(document).ready(function() {

    });
</script>
<?php get_footer() ?>