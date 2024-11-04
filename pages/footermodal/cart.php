<?php
$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham ";
$query_pro = mysqli_query($mysqli, $sql_pro);

$sql = "SELECT ten_size FROM size WHERE id_size = ?";
$result = mysqli_prepare($mysqli, $sql);
?>

<div class="modals">
    <div>
        <input type="checkbox" class="check-timkiem-css" name="check-giohang" id="check-giohang">
        <label for="check-giohang" class="search-them-modal "></label>
        <div class="search_modal">
            <label for="check-giohang" class="search_modal-icon-btn ti-close"></label>
            <div class="search_modal-header">
                <p>Giỏ hàng</p>
            </div>

            <div class="cart-items">
                <?php

                $tongtien = 0;
                $soluongsanpham = 0;


                if (isset($_SESSION['id_khachhang'])) {
                    $id_khachhang = $_SESSION['id_khachhang'];


                    $sql_giohang = "SELECT giohang.*, sanpham.tensanpham, sanpham.giasp, sanpham.hinhanh, size.ten_size
                        FROM tbl_giohang giohang
                        JOIN tbl_sanpham sanpham ON giohang.id_sanpham = sanpham.id_sanpham
                        JOIN size ON giohang.size = size.id_size
                        WHERE giohang.id_khachhang = $id_khachhang";

                    $query_giohang = mysqli_query($mysqli, $sql_giohang);


                    while ($cart_item = mysqli_fetch_assoc($query_giohang)) {
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                        $tongtien += $thanhtien;
                        $soluongsanpham += $cart_item['soluong'];


                        $product_id = $cart_item['id_sanpham'];
                        $product_name = $cart_item['tensanpham'];
                        $product_price = $cart_item['giasp'];
                        $product_image = './admincp/modules/quanlysp/uploads/' . $cart_item['hinhanh'];


                        $product_size = $cart_item['ten_size'];


                ?>
                        <div id="product_<?php echo $product_id; ?>" class="cart-item">
                            <div class="cart-item-image">
                                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                            </div>
                            <div class="item-details">
                                <p class="item-name">
                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $product_id; ?>">
                                        <?php echo $product_name; ?>
                                    </a>
                                </p>
                                <p class="item-size">Kích thước:
                                    <?php echo $product_size; ?>
                                </p>
                                <div class="item-quantity">Số lượng:
                                    <span class="item-quantity-value">
                                        <?php echo $cart_item['soluong']; ?>
                                    </span>
                                </div>
                                <p class="item-price">Giá:
                                    <?php echo number_format($product_price) . '₫'; ?>
                                </p>
                                <div class="item-details clearfix">
                                    <p class="color_reds">
                                        <a href="#" onclick="deleteProduct(<?php echo $product_id; ?>)">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } elseif (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                    foreach ($_SESSION['cart'] as $cart_item) {
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                        $tongtien += $thanhtien;
                        $soluongsanpham += $cart_item['soluong'];


                        $product_id = $cart_item['id'];
                        $product_name = $cart_item['tensanpham'];
                        $product_price = $cart_item['giasp'];
                        $product_image = './admincp/modules/quanlysp/uploads/' . $cart_item['hinhanh'];


                        mysqli_stmt_bind_param($result, "i", $cart_item['size']);
                        mysqli_stmt_execute($result);
                        $size_result = mysqli_stmt_get_result($result);


                        if ($size_result && mysqli_num_rows($size_result) > 0) {
                            $row = mysqli_fetch_assoc($size_result);
                            $product_size = $row['ten_size'];
                        } else {
                            $product_size = "Kích thước không hợp lệ";
                        }


                    ?>
                        <div id="product_<?php echo $product_id; ?>" class="cart-item">
                            <div class="cart-item-image">
                                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                            </div>
                            <div class="item-details">
                                <p class="item-name">
                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $product_id; ?>">
                                        <?php echo $product_name; ?>
                                    </a>
                                </p>
                                <p class="item-size">Kích thước:
                                    <?php echo $product_size; ?>
                                </p>
                                <div class="item-quantity">Số lượng:
                                    <span class="item-quantity-value">
                                        <?php echo $cart_item['soluong']; ?>
                                    </span>
                                </div>
                                <p class="item-price">Giá:
                                    <?php echo number_format($product_price) . '₫'; ?>
                                </p>
                                <div class="item-details clearfix">
                                    <p class="color_reds">
                                        <a href="#" onclick="deleteProduct(<?php echo $product_id; ?>)">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "Giỏ hàng trống";
                }
                ?>
            </div>
            <div class="line">
                <p class="tongtien_a">Tổng tiền: <span id="tongtien_c">
                        <?php echo number_format($tongtien); ?>₫
                    </span></p>
            </div>


            <div class="button-row">
                <a href="index.php?quanly=giohang">
                    <button class="view-cart-button">Xem giỏ hàng</button>
                </a>
                <?php

                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                ?>


                    <a href="index.php?quanly=xulythanhtoan">
                        <button class="checkout-button">Thanh toán</button>
                    </a>
                <?php
                } else { ?>
                    <a href="index.php?quanly=giohang">
                        <button class="checkout-button">Thanh toán</button>
                    </a>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
<script>
    function deleteProduct(productId) {

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './pages/main/themgiohang.php?xoa=' + productId, true);
        xhr.send();


        xhr.onload = function() {
            if (xhr.status == 200) {

                updateUIAfterDelete(productId);

                updateTotalPrice();
            } else {
                console.error('Lỗi khi xóa sản phẩm.');

                alert('Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại hoặc liên hệ hỗ trợ.');
            }
        };
    }

    function updateUIAfterDelete(productId) {

        var deletedProduct = document.getElementById('product_' + productId);
        if (deletedProduct) {
            deletedProduct.style.display = 'none';
        }
    }


    function updateTotalPrice() {
        var totalElement = document.getElementById('tongtien_c');
        if (totalElement) {
            var newTotal = calculateNewTotal();
            totalElement.innerHTML = numberFormat(newTotal) + '₫';
        }
    }


    function calculateNewTotal() {
        var total = 0;
        var items = document.querySelectorAll('.cart-item');
        items.forEach(function(item) {
            var priceElement = item.querySelector('.item-price');
            var priceText = priceElement.textContent.trim().replace('Giá: ', '').replace('₫', '').replace(',', '');
            var quantityElement = item.querySelector('.item-quantity-value');
            var quantity = parseInt(quantityElement.textContent.trim());
            var subtotal = parseFloat(priceText) * quantity;


            subtotal = isNaN(subtotal) ? 0 : subtotal;

            total += subtotal;
        });
        return total;
    }


    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>