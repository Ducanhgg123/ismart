<?php get_header() ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <?php if ($cat_id == -1) { ?>
                        <li>
                            <a href="danh-muc-san-pham.html" title="">Sản phẩm</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="danh-muc-san-pham/<?php echo $cat_id?>" title=""><?php echo get_product_cat_by_id($cat_id)['title'] ?></a>
                        <li>
                        <?php } ?>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <?php
                if ($key == '' && $sort_type==-1) {
                ?>
                    <div class="section-detail">
                        <?php
                        foreach ($list_cat_product as $cat) {
                        ?>
                            <?php if (exist_product($list_product, $cat['id'])) { ?>
                                <h3 class="section-title fl-left" style="margin:15px 0px"><?php echo $cat['title'] ?></h3>
                                <ul class="list-item clearfix">
                                    <?php
                                    foreach ($list_product as $product) {
                                        if (check_product_cat(get_product_cat_by_id($product['cat_id']), $cat)) {
                                    ?>
                                            <li>
                                                <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="thumb">
                                                    <img src="admin/<?php echo $product['thumb'] ?>">
                                                </a>
                                                <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="product-name"><?php echo $product['name'] ?></a>
                                                <div class="price">
                                                    <span class="new"><?php echo currency_format(get_real_price($product), 'đ') ?></span>
                                                    <?php if ($product['discount'] > 0) { ?>
                                                        <span class="old"><?php echo currency_format($product['price'], 'đ') ?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="action clearfix">
                                                    <a href="?mod=cart&action=addToCart&id=<?php echo $product['id']?>&qty=1" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                    <a href="?mod=checkout&id=<?php echo $product['id']?>&qty=1" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                                </div>
                                            </li>
                                <?php }
                                    }
                                } ?>
                                </ul>
                            <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $product) {
                            ?>
                                <li>
                                    <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="thumb">
                                        <img src="admin/<?php echo $product['thumb'] ?>">
                                    </a>
                                    <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="product-name"><?php echo $product['name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format((int) $product['price'] * (100 - $product['discount']) / 100, 'đ') ?></span>
                                        <?php if ($product['discount'] > 0) { ?>
                                            <span class="old"><?php echo currency_format($product['price'], 'đ') ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=checkout&id=<?php echo $product['id']?>&qty=1" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php if ($total_page > 1) { ?>
                        <ul class="list-item clearfix">
                            <?php if ($total_page > 2) { ?>
                                <li>
                                    <a href="<?php echo $url_format ?>" class="pagination">
                                        Đầu </a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 1) { ?>
                                <li>
                                    <a href="<?php echo $url_format ?>" class="pagination">
                                        < </a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <li>
                                    <a href="<?php echo $url_format ?>" class="pagination"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 1) { ?>
                                <li>
                                    <a href="<?php echo $url_format ?>" class="pagination">></a>
                                </li>
                            <?php } ?>
                            <?php if ($total_page > 2) { ?>

                                <li>
                                    <a href="<?php echo $url_format ?>" class="pagination">Cuối</a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('category') ?>
            <?php get_sidebar('filter') ?>
            <?php get_sidebar('ad') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>