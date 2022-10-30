<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item" id="list-item">
        </ul>
    </div>
</div>
<script>
    function format_menu(data, parent_id = 0) {
        var s = "";
        for (var i = 0; i < data.length; i++)
            if (data[i]['parent_id'] == parent_id) {
                var tmp = format_menu(data, data[i]['id']);
                s += "<li>";
                s += '<a href="danh-muc-san-pham/' + data[i]['id'] + '" title="">' + data[i]['title'] + '</a>';
                if (tmp.length != 0)
                    s += '<ul class="sub-menu">' + tmp + '</ul><i class="fa fa-angle-right arrow" aria-hidden="true"></i>';
                s += "</li>";
            }
        return s;
    }
    $(document).ready(function() {
        $.get("?action=getListProductCat", function(data, status) {
            var data=JSON.parse(data);
            var s = format_menu(data['list_product_cat']);
            document.getElementById("list-item").innerHTML=s;
        })
    });
</script>