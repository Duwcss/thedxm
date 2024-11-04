<?php
$tukhoa = '';
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%" . $tukhoa . "%'  ";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>
<div class="modal">

    <div>
        <input type="checkbox" class="check-timkiem-css" name="check-timkiem" id="check-timkiem">
        <label for="check-timkiem" class="search-them-modal "></label>
        <div class="search_modal ">

            <label for="check-timkiem" class="search_modal-icon-btn ti-close"></label>
            <div class="search_modal-header">
                <p>Tìm kiếm</p>

            </div>
            <form action="index.php?quanly=timkiem" method="POST">
                <input id="search" type="text" class="search_modal-input" placeholder="Nhập tên sản phẩm ..." name="tukhoa">

                <div id="searchResults"></div>


            </form>

        </div>
    </div>
</div>

</div>
<script>
    var products = <?php echo json_encode(mysqli_fetch_all($query_pro, MYSQLI_ASSOC)); ?>;

    function showSearchResults(keyword) {
        var resultsContainer = document.getElementById('searchResults');
        resultsContainer.innerHTML = '';

        if (keyword.trim() !== '') {
            var filteredProducts = products.filter(function(product) {
                return product.tensanpham.toLowerCase().includes(keyword.toLowerCase());
            });


            if (filteredProducts.length === 0) {
                resultsContainer.innerHTML = '<p class="no-results">Không có sản phẩm nào được tìm thấy.</p>';
                return;
            }


            var maxProductsToShow = 5;
            var totalProducts = filteredProducts.length;
            var productsToShow = Math.min(maxProductsToShow, totalProducts);


            for (var i = 0; i < productsToShow; i++) {
                resultsContainer.innerHTML +=
                    '<a href="index.php?quanly=chitiet&idsanpham=' + filteredProducts[i].id_sanpham + '" class="product-link">' +
                    '<div class="product-itemss">' +
                    '<img src="./admincp/modules/quanlysp/uploads/' + filteredProducts[i].hinhanh + '" alt="Product Image">' +
                    '<div class="product-detailss">' +
                    '<p class="product-name">' + filteredProducts[i].tensanpham + '</p>' +
                    '<p class="product-prices">' + (filteredProducts[i].km > 0 ? formatCurrency(filteredProducts[i].giasp - (filteredProducts[i].giasp * (filteredProducts[i].km / 100))) : formatCurrency(filteredProducts[i].giasp)) + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</a>';
            }


            if (totalProducts > maxProductsToShow) {
                resultsContainer.innerHTML +=
                    '<div class="view-more">' +
                    '<input class="search_modal_btns" type="submit" name="timkiem" value="Xem Thêm ' + (totalProducts - maxProductsToShow) + ' Sản Phẩm">' +
                    '</div>';
            }
        }
    }

    document.getElementById('search').addEventListener('input', function() {
        var keyword = this.value;
        showSearchResults(keyword);
    });

    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }
</script>