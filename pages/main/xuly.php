<?php
if (isset($_GET['code']) && isset($_GET['action'])) {
    $code = $_GET['code'];
    $action = $_GET['action'];


    if ($action == 'huy') {

        $sql_update = "UPDATE tbl_donhang SET cart_status = 4 WHERE code_cart = '$code'";
        $query_update = mysqli_query($mysqli, $sql_update);


        if ($query_update) {

            header('Location:index.php?quanly=donhang');
        } else {

            echo "Lỗi: " . mysqli_error($mysqli);
        }
    } elseif ($action == 'xuly') {

        $sql_update = "UPDATE tbl_donhang SET cart_status = 3 WHERE code_cart = '$code'";
        $query_update = mysqli_query($mysqli, $sql_update);


        if ($query_update) {

            header('Location:index.php?quanly=donhang');
        } else {

            echo "Lỗi: " . mysqli_error($mysqli);
        }
    }
} else {

    echo "Lỗi: Mã đơn hàng hoặc hành động không hợp lệ.";
}
