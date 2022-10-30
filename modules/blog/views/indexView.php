<?php get_header() ?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="blog.html" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_post as $post) {
                        ?>
                            <li class="clearfix">
                                <a href="blog/<?php echo $post['id']?>/<?php echo $post['slug']?>.html" title="" class="thumb fl-left">
                                    <img src="admin/<?php echo $post['thumb'] ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="blog/<?php echo $post['id']?>/<?php echo $post['slug']?>.html" title="" class="title"><?php echo $post['title'] ?></a>
                                    <span class="create-date"><?php echo date('d/m/Y', $post['created_at']) ?></span>
                                    <p class="desc"><?php echo $post['short_desc'] ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php if ($total_page > 2) { ?>
                            <li>
                                <a href="blog/trang-<?php echo 1 ?>" class="pagination">
                                    << </a>
                            </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li>
                                <a href="blog/trang-<?php echo $i ?>" class="pagination"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($total_page > 2) { ?>
                            <li>
                                <a href="blog/trang-<?php echo $total_page ?>" class="pagination">>></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('best-selling-product') ?>
            <?php get_sidebar('ad') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>