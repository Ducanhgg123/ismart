<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            <?php
            foreach ($list_best_selling_product as $product) {
            ?>

                <li class="clearfix">
                    <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="thumb fl-left">
                        <img src="admin/<?php echo $product['thumb']?>" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="san-pham/<?php echo $product['id']?>/<?php echo makeURL($product['name'])?>.html" title="" class="product-name"><?php echo $product['name']?></a>
                        <div class="price">
                            <span class="new"><?php echo currency_format(get_real_price($product),'đ')?></span>
                            <?php if ($product['discount']>0){?>
                                 <span class="old"><?php echo currency_format($product['price'],'đ')?></span>
                            <?php }?>
                        </div>
                        <a href="?mod=cart&action=addToCart&qty=1&id=<?php echo $product['id']?>" title="" class="buy-now">Thêm vào giỏ</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>