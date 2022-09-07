<?php get_header() ?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Quản trị viên</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="POST" action="?mod=users&controller=team&action=search" class="form-s fl-right">
                            <input type="text" name="search" id="s">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=users&controller=team&action=deleteUsers" class="form-actions">
                            <input type="submit" name="btn_delete" value="Xóa tài khoản">

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên người quản trị</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($list_users as $user) {
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="list_id[<?php echo $user['id']?>]" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo ++$count; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $user['fullname']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="?mod=users&controller=team&action=reset&id=<?php echo $user['id'] ?>" title="Đổi mật khẩu" class="edit"><i class="fa-solid fa-key"></i></a></li>
                                                <li><a href="?mod=users&controller=team&action=update&id=<?php echo $user['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="?mod=users&controller=team&action=delete&id=<?php echo $user['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $user['email'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo date('d/m/Y', $user['created_date']) ?></span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <?php if (count($list_users) > 10) { ?>

                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Tên người quản trị</span></td>
                                        <td><span class="tfoot-text">Thời gian tạo</span></td>
                                    </tr>
                                </tfoot>
                            <?php } ?>
                        </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>