<?php
include('../../config/config.php');

if (isset($_GET['code']) && isset($_GET['status'])) {
    $code_cart = $_GET['code'];
    $status = $_GET['status'];


    if ($status == 'moi') {
        $new_status = 0; // Trạng thái "Mới"
    } elseif ($status == 'danggiao') {
        $new_status = 2; // Trạng thái "Đang giao"
    }

    $sql_update = "UPDATE tbl_hoanhang SET status_lh = ? WHERE code_cart = ?";


    $stmt = mysqli_prepare($mysqli, $sql_update);


    mysqli_stmt_bind_param($stmt, "ss", $new_status, $code_cart);


    if (mysqli_stmt_execute($stmt)) {

        header('Location: ../../index.php?action=quanlyhoanhang&query=lietke');
    } else {

        echo "Lỗi: " . mysqli_error($mysqli);
    }


    mysqli_stmt_close($stmt);
} else {
    $id = $_GET['idcart'];


    $sql_xoa = "DELETE FROM tbl_hoanhang WHERE code_cart = '" . $id . "'";


    mysqli_query($mysqli, $sql_xoa);

    header('Location: ../../index.php?action=quanlyhoanhang&query=lietke');
}
