<?php


$ordersPerPage = 10;


$category = isset($_GET['category']) ? $_GET['category'] : 'all';

if (isset($_SESSION['id_khachhang'])) {
    $userid_khachhang = $_SESSION['id_khachhang'];

    $totalOrdersQuery = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM tbl_donhang, tbl_khackhang WHERE tbl_donhang.id_khachhang_temp = tbl_khackhang.id_khachhang AND tbl_khackhang.id_khachhang = '$userid_khachhang' AND ('$category' = 'all' OR tbl_donhang.cart_status = '$category')");
    $totalOrdersResult = mysqli_fetch_assoc($totalOrdersQuery);
    $totalOrders = $totalOrdersResult['total'];


    $totalPages = ceil($totalOrders / $ordersPerPage);


    if (isset($_GET['trang'])) {
        $currentPage = $_GET['trang'];
    } else {
        $currentPage = 1;
    }


    $begin = ($currentPage - 1) * $ordersPerPage;

    $sql_lietke_dh = "SELECT * FROM tbl_donhang, tbl_khackhang
    WHERE tbl_donhang.id_khachhang_temp = tbl_khackhang.id_khachhang
    AND tbl_khackhang.id_khachhang = '$userid_khachhang'
    AND ('$category' = 'all' OR tbl_donhang.cart_status = '$category')
    ORDER BY tbl_donhang.ngaymua DESC
    LIMIT $begin, $ordersPerPage";


    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

    $countPending = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as count FROM tbl_donhang WHERE cart_status = 0 AND id_khachhang_temp IN (SELECT id_khachhang FROM tbl_khackhang WHERE id_khachhang = '$userid_khachhang')"))['count'];
    $countWaiting = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as count FROM tbl_donhang WHERE cart_status = 1 AND id_khachhang_temp IN (SELECT id_khachhang FROM tbl_khackhang WHERE id_khachhang = '$userid_khachhang')"))['count'];
    $countDelivering = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as count FROM tbl_donhang WHERE cart_status = 2 AND id_khachhang_temp IN (SELECT id_khachhang FROM tbl_khackhang WHERE id_khachhang = '$userid_khachhang')"))['count'];
    $huy = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as count FROM tbl_donhang WHERE cart_status = 4 AND id_khachhang_temp IN (SELECT id_khachhang FROM tbl_khackhang WHERE id_khachhang = '$userid_khachhang')"))['count'];
    $hoantra = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as count FROM tbl_hoanhang WHERE status_lh = 1 AND id_khachhang IN (SELECT id_khachhang FROM tbl_khackhang WHERE id_khachhang = '$userid_khachhang')"))['count'];


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Page Title</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <h2 class="phuonganhheader">Đơn hàng của bạn</h2>
        <ul class="nav nav-underline">

            <li class="nav-item">
                <a class="nav-link category-button" data-category="0" href="#">Chờ xác nhận (<?php echo $countPending; ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link category-button" data-category="1" href="#">Chờ lấy hàng (<?php echo $countWaiting; ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link category-button" data-category="2" href="#">Đang giao hàng (<?php echo $countDelivering; ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link category-button" data-category="3" href="#">Hoàn thành</a>
            </li>
            <li class="nav-item">
                <a class="nav-link category-button" data-category="4" href="#">Đã hủy (<?php echo $huy; ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active category-button" data-category="all" aria-current="page">Tất cả</a>
            </li>
        </ul>



        <div class="table-container">
            <div class="order-history">
                <table class="table">
                    <table class="table">

                        <div class="row" style="margin-top: 20px;">



                            <tbody>
                                <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($query_lietke_dh)) {
                                    $currentDate = date('Y-m-d');
                                    $deliveryDate = $row['ngaymua'];
                                    $cartStatus = $row['cart_status'];
                                    $dataCategory = $row['cart_status'];

                                    if ($cartStatus == 2 && strtotime($currentDate) > strtotime($deliveryDate . ' +7 days')) {

                                        $sql_update_status = "UPDATE tbl_donhang SET cart_status = 3 WHERE code_cart = '" . $row['code_cart'] . "'";
                                        $query_update_status = mysqli_query($mysqli, $sql_update_status);


                                        if ($query_update_status) {
                                        } else {
                                        }
                                    }
                                    $code = $row['code_cart'];


                                    $sql_product_info = "SELECT tbl_cart_details.*, tbl_sanpham.*, size.ten_size
        FROM tbl_cart_details
        INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham
        INNER JOIN size ON tbl_cart_details.size = size.id_size
        WHERE tbl_cart_details.code_cart = '" . $code . "'
        ORDER BY tbl_cart_details.id_cart_details DESC";
                                    $query_product_info = mysqli_query($mysqli, $sql_product_info);


                                    $orderItems = [];
                                    $totalOrderPrice = 0;

                                    while ($product_info = mysqli_fetch_array($query_product_info)) {
                                        $sql = "SELECT ten_size FROM size WHERE id_size = " . $product_info['size'];
                                        $result = mysqli_query($mysqli, $sql);
                                        $rows = mysqli_fetch_assoc($result);

                                        $ten_size = $rows['ten_size'];


                                        $key = $product_info['masp'] . '-' . $product_info['size'];


                                        if (array_key_exists($key, $orderItems)) {
                                            if ($product_info['km'] > 0) {
                                                $giasp = $product_info['giasp'] - ($product_info['giasp'] * ($product_info['km'] / 100));
                                            } else {
                                                $giasp = $product_info['giasp'];
                                            }

                                            $orderItems[$key]['quantity'] += $product_info['soluongmua'];
                                            $orderItems[$key]['total_price'] += $giasp * $product_info['soluongmua'];
                                        } else {

                                            $giasp = ($product_info['km'] > 0) ? $product_info['giasp'] - ($product_info['giasp'] * ($product_info['km'] / 100)) : $product_info['giasp'];

                                            $orderItems[$key] = [
                                                'product_name' => $product_info['tensanpham'],
                                                'size' => $ten_size,
                                                'quantity' => $product_info['soluongmua'],
                                                'product_code' => $product_info['masp'],
                                                'price' => $giasp,
                                                'total_price' => $giasp * $product_info['soluongmua'],
                                                'hinhanh' => $product_info['hinhanh'],
                                                'ngaymua' => $row['ngaymua'],
                                                'payment_method' => $row['payment_method']
                                            ];


                                            $totalOrderPrice += $giasp * $product_info['soluongmua'];
                                        }
                                    }


                                    foreach ($orderItems as $item) {
                                    }

                                ?>

                                    <div class="order-container" data-category="<?php echo $dataCategory; ?>">

                                        <div class="order-info">
                                            <div class="order-number">Mã đơn hàng: <?php echo $row['code_cart']; ?></div>
                                            <div class="product-price"> <?php echo ($row['ngaymua']); ?></div>

                                            <div class="order-status">
                                                Trạng thái:
                                                <?php
                                                if ($row['cart_status'] == 0) {
                                                    echo '<span class="status-pending">Chờ xác nhận</span>';
                                                } elseif ($row['cart_status'] == 1) {
                                                    echo '<span class="status-processing">Chờ lấy hàng</span>';
                                                } elseif ($row['cart_status'] == 2) {
                                                    echo '<span class="status-shipping">Đang giao hàng</span>';
                                                } elseif ($row['cart_status'] == 3) {
                                                    echo '<span class="status-success">Đã giao hàng thành công</span>';
                                                } elseif ($row['cart_status'] == 4) {
                                                    echo '<span class="status-successs">Đã hủy</span>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <?php foreach ($orderItems as $item) : ?>
                                            <div class="order-item">
                                                <div class="product-image">
                                                    <img src="admincp/modules/quanlysp/uploads/<?php echo $item['hinhanh']; ?>" alt="Product Image">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name"> <?php echo $item['product_name']; ?></div>
                                                    <div class="product-size">Size: <?php echo $item['size']; ?></div>
                                                    <div class="product-quantity">Số lượng: <?php echo $item['quantity']; ?></div>
                                                    <div class="product-quantity"> <?php echo ($row['payment_method']); ?></div>

                                                    <div class="product-price"><?php echo number_format($item['price']) . 'đ'; ?></div>

                                                </div>

                                            </div>

                                        <?php endforeach; ?>
                                        <h4><?php if ($row['ghichu'] != "") {
                                                echo "Ghi chú : " . $row['ghichu'];
                                            } else {
                                            } ?></h4>
                                        <div class="total-price">Thành tiền: <?php echo number_format($totalOrderPrice) . 'đ'; ?></div>

                                        <div class="order-actions">
                                            <div class="action-button">
                                                <?php
                                                if ($cartStatus == 0) {
                                                    echo '<a href="index.php?quanly=xemdonhang&query=xemdonhang&code=' . $row['code_cart'] . '" class="receive-buttonss">Xem đơn hàng</a>';
                                                    echo '<button class="btn btn-cancel" onclick="confirmDelete(\'' . $row['code_cart'] . '\')">Hủy</button>';
                                                } elseif ($cartStatus == 1) {
                                                    echo '<a href="index.php?quanly=xemdonhang&query=xemdonhang&code=' . $row['code_cart'] . '" class="btn btn-view">Xem đơn hàng</a>';
                                                } elseif ($cartStatus == 2) {
                                                    echo '<a href="index.php?quanly=xemdonhang&query=xemdonhang&code=' . $row['code_cart'] . '" class="receive-buttonss">Xem đơn hàng</a>';

                                                    echo '<a href="index.php?quanly=xuly&query=xuly&code=' . $row['code_cart'] . '&action=xuly" class="receive-button">Đã nhận hàng</a>';
                                                    echo '<a href="index.php?quanly=hoanhang&query=hoanhang&code=' . $row['code_cart'] . '" class="return-button">Đổi trả</a>';
                                                } elseif ($cartStatus == 3) {
                                                    echo '<a href="index.php?quanly=xemdonhang&query=xemdonhang&code=' . $row['code_cart'] . '" class="btn btn-view">Xem đơn hàng</a>';
                                                } elseif ($cartStatus == 4) {
                                                    echo '<a href="index.php?quanly=xemdonhang&query=xemdonhang&code=' . $row['code_cart'] . '" class="btn btn-view">Xem đơn hàng</a>';
                                                    echo '<button class="btn btn-cancell" onclick="reorder(\'' . $row['code_cart'] . '\')">Mua Lại</button>';
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>


                                <?php

                                }
                                ?>

                            </tbody>


                        </div>

            </div>

        </div>
        <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {

            $activeClass = ($currentPage == $i) ? 'active' : '';


            $categoryParam = (isset($_GET['category'])) ? '&category=' . $_GET['category'] : '';

            echo '<a href="index.php?quanly=donhang&trang=' . $i . $categoryParam . '" class="page-link ' . $activeClass . '">' . $i . '</a>';
        }
    } else {
        echo '<p class="no-orders">Không có đơn hàng nào</p>';
    }
        ?>
        </div>


        <div class="clear"></div>

    </body>
    <script>
        function reorder(code) {

            window.location.href = './pages/main/themgiohang.php?reorder=' + code;
        }
        document.addEventListener("DOMContentLoaded", function() {
            const categoryButtons = document.querySelectorAll(".category-button");
            const orderContainers = document.querySelectorAll(".order-container");


            const savedCategory = sessionStorage.getItem('selectedCategory');
            if (savedCategory) {

                categoryButtons.forEach(button => {
                    if (button.getAttribute('data-category') === savedCategory) {
                        button.classList.add('active');
                        orderContainers.forEach(container => {
                            if (container.getAttribute('data-category') === savedCategory || savedCategory === 'all') {
                                container.style.display = "block";
                            } else {
                                container.style.display = "none";
                            }
                        });
                    }
                });
            }

            categoryButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const selectedCategory = this.getAttribute("data-category");


                    sessionStorage.setItem('selectedCategory', selectedCategory);


                    categoryButtons.forEach(btn => {
                        btn.classList.remove("active");
                    });


                    this.classList.add("active");


                    orderContainers.forEach(container => {
                        if (container.getAttribute('data-category') === selectedCategory || selectedCategory === 'all') {
                            container.style.display = "block";
                        } else {
                            container.style.display = "none";
                        }
                    });

                    n
                    const newUrl = window.location.origin + window.location.pathname + '?category=' + selectedCategory;
                    window.history.pushState({
                        path: newUrl
                    }, '', newUrl);
                });
            });
        });
    </script>
    <script>
        function confirmDelete(code) {

            var result = confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');


            if (result) {
                window.location.href = 'index.php?quanly=xuly&query=xuly&code=' + code + '&action=huy';
            }
        }
    </script>