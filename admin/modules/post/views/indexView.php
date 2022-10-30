<?php get_header() ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=post">Tất cả <span class="count">(<?php echo get_num_post() ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=post&status=1">Đã đăng (<span class="count"><span id="approved"><?php echo get_num_post_by_status(1) ?></span>)</span></a> |</li>
                            <li class="pending"><a href="?mod=post&status=0">Chờ xét duyệt (<span class="count"><span id="not-approved"><?php echo get_num_post_by_status(0) ?></span></span>)</a></li>
                        </ul>
                    </div>
                    <form method="POST" action="?mod=post&action=multi" class="form-actions">
                        <div class="actions">
                            <input type="submit" name="btn_delete_posts" value="Xóa bài viết">
                            <input type="submit" name="btn_approve_posts" value="Duyệt">
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
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody id="table-content">
                                    <?php
                                    $count = $start;
                                    foreach ($list_post as $post) {
                                        $id = $post['id'];
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_id[<?php echo $id?>]" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo ++$count ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="<?php echo $config['base_url']?>?mod=blog&action=detail&id=<?php echo $post['id']?>" title=""><?php echo $post['title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=post&action=update&id=<?php echo $id ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=post&action=delete&id=<?php echo $id ?>&page=<?php echo $page ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    <li><a href="javascript:void(0);" title="Duyệt" class="approve" onclick="approve(<?php echo $id ?>)"><i class="fa-solid fa-circle-check"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo get_cat_name_by_id($post['cat_id']) ?></span></td>
                                            <td><span class="tbody-text" id="approve-status-<?php echo $id?>"><?php echo get_status($post['status']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo $post['creator'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $post['created_at']) ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Tiêu đề</span></td>
                                        <td><span class="tfoot-text">Danh mục</span></td>
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
                                    <a href="?mod=post&page=<?php echo 1 ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="?mod=post&page=<?php echo $i ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="?mod=post&page=<?php echo $total_page ?><?php if (isset($_GET['key'])) echo "&key=".$_GET['key']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?><?php if (isset($_GET['status'])) echo "&status=".$_GET['status']?>" class="pagination">></a>
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
    function approve(id){
        var numApproved=$("#approved").text();
        var numNotApproved=$("#not-approved").text();
        $.ajax({
            url: '?mod=post&action=approve',
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
</script>
<?php get_footer() ?>