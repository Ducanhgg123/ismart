<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php foreach ($list_slider as $slider) { ?>
                        <div class="item">
                            <img src="admin/<?php echo $slider['image'] ?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_featured_product as $product) {
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
                                    <a href="?mod=cart&action=addToCart&qty=1&id=<?php echo $product['id']?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=checkout&id=<?php echo $product['id']?>&qty=1" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
            foreach ($list_product_cat as $cat) {
            ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $cat['title'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $product) {
                                if ($product['cat_id'] == $cat['id']) {
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
                                            <a href="?mod=cart&action=addToCart&qty=1&id=<?php echo $product['id']?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=checkout&id=<?php echo $product['id']?>&qty=1" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('category') ?>
            <?php get_sidebar('best-selling-product') ?>
            <?php get_sidebar('ad') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>