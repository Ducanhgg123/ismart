<?php get_header() ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?controller=product&action=detail&id=<?php echo $product['id']?>" title=""><?php echo $product['name']?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img src="admin/<?php echo $product['thumb'] ?>" data-zoom-image="admin/<?php echo $product['thumb'] ?>" id="zoom" style="height:356px;width:356px;" />
                        </a>
                        <!-- <div id="list-thumb">
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                        </div> -->
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="admin/<?php echo $product['thumb'] ?>" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['name'] ?></h3>
                        <div class="desc">
                            <p><?php echo $product['short_desc'] ?></p>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price">
                            <span class="new"><?php echo currency_format($product['price'] * (100 - $product['discount']) / 100, 'đ') ?></span>
                            <?php
                            if ($product['discount'] > 0) {
                            ?>
                                <small class="old" style="text-decoration:line-through; color: #999;margin-left:15px;"><?php echo currency_format($product['price'], 'đ') ?></small>
                            <?php } ?>
                        </p>
                        <div id="num-order-wp">
                            <form onsubmit="addToCart()" method="GET" action="javascript:void(0)">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="qty" value="1" id="num-order" min="1">
                                <input type="hidden" value="<?php echo $product['id']?>" name="id" id="product-id-hidden">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                <br>
                                <input  type="submit"  value="Thêm vào giỏ hàng"class="add-cart" style="margin-top:30px;"/>
                            </form>
                            <script>
                                function addToCart(){
                                    var qty=document.getElementById('num-order').value;
                                    var id=document.getElementById('product-id-hidden').value;
                                    window.location.href="?mod=cart&action=addToCart&qty="+qty+"&id="+id;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $product['content'] ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_same_category_product as $product) { ?>
                            <li>
                                <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="thumb">
                                    <img src="admin/<?php echo $product['thumb'] ?>">
                                </a>
                                <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="product-name"><?php echo $product['name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product['price'] * (100 - $product['discount']) / 100, 'đ') ?></span>
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
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('best-selling-product') ?>
            <?php get_sidebar('ad') ?>
        </div>
    </div>
</div>
<?php get_footer() ?>