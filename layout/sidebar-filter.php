<div class="section" id="filter-product-wp">
    <div class="section-head">
        <h3 class="section-title">Bộ lọc</h3>
    </div>
    <div class="section-detail">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Giá</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="radio" name="price" min="0" max="500000"></td>
                    <td>Dưới 500.000đ</td>
                </tr>
                <tr>
                    <td><input type="radio" name="price" min="500000" max="1000000"></td>
                    <td>500.000đ - 1.000.000đ</td>
                </tr>
                <tr>
                    <td><input type="radio" name="price" min="1000000" max="5000000"></td>
                    <td>1.000.000đ - 5.000.000đ</td>
                </tr>
                <tr>
                    <td><input type="radio" name="price" min="5000000" max="10000000"></td>
                    <td>5.000.000đ - 10.000.000đ</td>
                </tr>
                <tr>
                    <td><input type="radio" name="price" min="10000000" max="1000000000"></td>
                    <td>Trên 10.000.000đ</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td colspan="2">Loại</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_product_cat_full as $cat) {
                ?>
                    <tr>
                        <td><input type="radio" name="category" value="<?php echo $cat['id'] ?>"></td>
                        <td><?php echo $cat['title'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td colspan="2">Sắp Xếp</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="radio" name="sort" value="0"></td>
                    <td>Từ A-Z</td>
                </tr>
                <tr>
                    <td><input type="radio" name="sort" value="1"></td>
                    <td>Từ Z-A</td>
                </tr>
                <tr>
                    <td><input type="radio" name="sort" value="2"></td>
                    <td>Giá cao xuống thấp</td>
                </tr>
                <tr>
                    <td><input type="radio" name="sort" value="3"></td>
                    <td>Giá thấp đến cao</td>
                </tr>
            </tbody>
        </table>
        <button onclick="submitFilter()" class="btn btn-info " style="padding:5px 15px"> Lọc </button>
    </div>
    <script>
        function submitFilter(){
            var price=document.querySelector('input[name="price"]:checked');
            var category=document.querySelector('input[name="category"]:checked');
            var sort=document.querySelector('input[name="sort"]:checked');
            if (price==null){
                var min=0;
                var max=100000000;
            }else{
                var min=parseInt(price.getAttribute('min'));
                var max=parseInt(price.getAttribute('max'));
            }
            if (category==null)
                var cat_id=-1;
            else
                var cat_id=parseInt(category.getAttribute('value'));
            if (sort==null)
                var sort_type=0;
            else
                var sort_type=parseInt(sort.getAttribute('value'));
            window.location.href="danh-muc-san-pham/"+cat_id+"/trang-1"+"/"+sort_type+"/"+min+"/"+max;
        }
    </script>
</div>