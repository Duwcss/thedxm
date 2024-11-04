<div class="cart">
    <div id="backtoshop">
        <a href="./index.php" class="phuonganhheader">
            < BACK TO NEW ARRIVALS</a>
    </div>

    <div class="cart_main">
        <div class="cart_main--sp">
            <h3 class="phuonganhheader">GIỎ HÀNG CỦA BẠN</h3>
            <div class="cart_main--sp_ul">
                <div class="sanphamgh">
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


                    ?>
                            <div class="spgiohang_cart">
                                <div class="cart_spgiohang-img" name="hinhanh">
                                    <img src="./admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="sp1" width="100%" height="auto">
                                </div>
                                <div class="cart_info-sp">
                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $cart_item['id_sanpham']; ?>">
                                        <p name="tensanpham">
                                            <?php echo $cart_item['tensanpham']; ?>
                                        </p>
                                    </a>
                                    <p class="abcd">Kích Thước:
                                        <?php echo $cart_item['ten_size']; ?>
                                    </p>
                                </div>

                                <div class="cart_spgiohang-sl">
                                    <a href="./pages/main/themgiohang.php?tru=<?php echo $cart_item['id_sanpham']; ?>&size=<?php echo $cart_item['size']; ?>"><i class="bi bi-dash-lg"></i></a>
                                    <span name="soluong" class="cart_spgiohang-sl_stt">
                                        <?php echo $cart_item['soluong']; ?>
                                    </span>
                                    <a href="./pages/main/themgiohang.php?cong=<?php echo $cart_item['id_sanpham']; ?>&size=<?php echo $cart_item['size']; ?>"><i class="bi bi-plus-lg"></i></a>
                                </div>

                                <div name="giasp" class="cart_spgiohang-monney">
                                    <?php echo number_format($cart_item['giasp']) . 'đ'; ?>
                                </div>
                                <div class="cart_spgiohang-thanhtien">
                                    <p>Thành tiền</p>
                                    <p class="color_red">
                                        <?php echo number_format($thanhtien) . 'đ'; ?>
                                    </p>
                                    <a href="#" onclick="confirmDelete('<?php echo $cart_item['id_sanpham']; ?>')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } elseif (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $cart_item) {
                            $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                            $tongtien += $thanhtien;
                            $soluongsanpham += $cart_item['soluong'];
                            $sql = "SELECT ten_size FROM size WHERE id_size = " . $cart_item['size'];
                            $result = mysqli_query($mysqli, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $ten_size = $row['ten_size'];
                            } else {

                                $ten_size = "Kích thước không hợp lệ";
                            }

                        ?>
                            <div class="spgiohang_cart">

                                <div class="cart_spgiohang-img" name="hinhanh">
                                    <img src="./admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="sp1" width="100%" height="auto">
                                </div>
                                <div class="cart_info-sp">



                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $cart_item['id'] ?>">
                                        <p name="tensanpham">
                                            <?php echo $cart_item['tensanpham'] ?>
                                        </p>
                                    </a>
                                    <p class="abcd">Kích Thước:
                                        <?php echo $ten_size; ?>
                                    </p>
                                </div>


                                <div class="cart_spgiohang-sl">
                                    <a href="./pages/main/themgiohang.php?tru=<?php echo $cart_item['id']; ?>&size=<?php echo $cart_item['size']; ?>"><i class="bi bi-dash-lg"></i></a>
                                    <span name="soluong" class="cart_spgiohang-sl_stt">
                                        <?php echo $cart_item['soluong'] ?>
                                    </span>
                                    <a href="./pages/main/themgiohang.php?cong=<?php echo $cart_item['id']; ?>&size=<?php echo $cart_item['size']; ?>"><i class="bi bi-plus-lg"></i></a>

                                </div>

                                <div name="giasp" class="cart_spgiohang-monney">
                                    <?php echo number_format($cart_item['giasp']) . 'đ' ?>
                                </div>
                                <div class="cart_spgiohang-thanhtien">
                                    <p>Thành tiền</p>
                                    <p class="color_red">
                                        <?php echo number_format($thanhtien) . 'đ' ?>
                                    </p>
                                    <a href="./pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="cart_main--sp_ul--heading">Giỏ hàng không có sản phẩm nào</div>
                        <div id="backtoshops">
                            <a href="./index.php" class="phuonganhheader"><i class="bi bi-layer-backward"></i>TIẾP TỤC MUA
                                HÀNG</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="cart_main--sp_ul--heading">Bạn đang có
                    <?php echo $soluongsanpham; ?> sản phẩm trong giỏ hàng
                </div>

                <div class="cart_main-footer">


                </div>
            </div>
        </div>
        <div class="cart_main--sidebar">
            <div class="cart_main--sidebar_main">
                <p class="cart_main--sidebar_main-1">Thông tin đơn hàng</p>
                <p class="cart_main--sidebar_main-2">Tổng tiền:
                    <?php
                    echo number_format($tongtien) . '₫';
                    ?>
                </p>
                <?php

                if (isset($_SESSION['id_khachhang']) || (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart']))) {
                    if (isset($_SESSION['id_khachhang'])) {

                        $id_khachhang = $_SESSION['id_khachhang'];
                        $sql_check_giohang = "SELECT COUNT(*) AS total_items FROM tbl_giohang WHERE id_khachhang = '$id_khachhang'";
                        $result_check_giohang = mysqli_query($mysqli, $sql_check_giohang);

                        if ($result_check_giohang) {
                            $row_check_giohang = mysqli_fetch_assoc($result_check_giohang);
                            $total_items = $row_check_giohang['total_items'];

                            if ($total_items > 0) {
                ?>
                                <a href="index.php?quanly=xulythanhtoan">
                                    <input class="login-button" type="submit" name="thanhtoan" value="THANH TOÁN"></a>
                            <?php
                            } else {

                                echo "Giỏ hàng trống";
                            }
                        }
                    } else {

                        if (count($_SESSION['cart']) > 0) {
                            ?>
                            <a href="index.php?quanly=xulythanhtoan">
                                <input class="login-button" type="submit" name="thanhtoan" value="THANH TOÁN"></a>
                <?php
                        } else {

                            echo "Giỏ hàng trống";
                        }
                    }
                } else {

                    echo "Giỏ hàng trống";
                }
                ?>
            </div>
        </div>

    </div>
</div>


<div class="cart_thamkhaao">
    <div class="cart_thamkhaao-1">
        <h2 class="phuonganhheader">Có thể bạn sẽ thích</h2>
        <p><a href="index.php?quanly=shopall">Xem thêm</a></p>
    </div>
    <div class="maincontent">

        <?php
        $sql_pro = "SELECT * FROM tbl_sanpham order by RAND() LIMIT 4 ";
        $query_pro = mysqli_query($mysqli, $sql_pro);
        $giaspkm = 0;
        while ($row_pro = mysqli_fetch_array($query_pro)) {
            if ($row_pro['km'] > 0) {
                $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
            };
        ?>

            <ul>
                <div class="maincontent-item">
                    <div class="maincontent-top">

                        <div class="maiconten-top1">

                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-img">
                                <img src="./admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>">
                            </a>
                            <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Xem
                                    ngay</a></button>

                        </div>
                    </div>
                    <div class="maincontent-info">
                        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-name">
                            <?php echo $row_pro['tensanpham'] ?>
                        </a>
                        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-gia">
                            <?php if ($row_pro['km'] > 0) {
                                echo '<div class="khuyenmais">' . -number_format($row_pro['km']) . '%' . '</div>';
                                echo number_format($giaspkm) . 'đ';
                            } else {
                                echo number_format($row_pro['giasp']) . 'đ';
                            } ?>
                            <span class="pro-price-del">
                                <?php
                                if ($row_pro['km'] > 0) {
                                    echo '<span class="original-price">' . number_format($row_pro['giasp']) . 'đ</span>';
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
            </ul>
        <?php
        }
        ?>

    </div>
</div>
</div>
<script>
    var productNames = document.querySelectorAll('.maincontent-name');


    productNames.forEach(function(productName) {
        var originalText = productName.textContent.trim();
        if (originalText.length > 13) {
            var truncatedText = originalText.slice(0, 13) + '...';
            productName.textContent = truncatedText;
        }
    });

    function confirmDelete(id_sanpham) {
        var result = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");

        if (result) {

            window.location.href = "./pages/main/themgiohang.php?xoa=" + id_sanpham;
        } else {

        }
    }
</script>