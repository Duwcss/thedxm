<?php
session_start();
include('../../admincp/config/config.php');


if (isset($_SESSION['id_khachhang'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
} else {

    $id_khachhang_temp = rand(100000, 999999);
    $_SESSION['id_khachhang'] = $id_khachhang_temp;
    $id_khachhang = $id_khachhang_temp;
}

$code_order = rand(0, 9999);

date_default_timezone_set('Asia/Ho_Chi_Minh');


$update_time = date('Y-m-d H:i:s');

if (isset($_POST['payment_method']) && is_array($_POST['payment_method']) && count($_POST['payment_method']) > 0) {
    $payment_method = implode(", ", $_POST['payment_method']);
} else {

    echo "Vui lòng chọn hình thức thanh toán.";
    exit();
}


$hoTen = mysqli_real_escape_string($mysqli, $_POST['hoTen']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$soDienThoai = mysqli_real_escape_string($mysqli, $_POST['soDienThoai']);
$diaChi = mysqli_real_escape_string($mysqli, $_POST['diaChi']);
$ghichu = mysqli_real_escape_string($mysqli, $_POST['fnote']);

if (isset($_SESSION['id_khachhang'])) {
    $id_khachhang = $_SESSION['id_khachhang'];


    $sql_check_giohang = "SELECT * FROM tbl_giohang WHERE id_khachhang = '$id_khachhang'";
    $result_check_giohang = mysqli_query($mysqli, $sql_check_giohang);

    if ($result_check_giohang) {

        while ($row = mysqli_fetch_assoc($result_check_giohang)) {
            $id_sanpham = $row['id_sanpham'];
            $soluong = $row['soluong'];
            $size = $row['size'];


            $check_soluong_query = "SELECT (soluongsize - soluongdaban) AS soluongconlai 
                                    FROM size_soluong 
                                    WHERE id_sanpham = '$id_sanpham' AND id_size = '$size'";
            $check_soluong_result = mysqli_query($mysqli, $check_soluong_query);

            if ($check_soluong_result) {
                $row = mysqli_fetch_assoc($check_soluong_result);
                $soluongconlai = $row['soluongconlai'];

                if ($soluongconlai >= $soluong) {

                    $insert_order_details = "INSERT INTO tbl_cart_details (id_sanpham, code_cart, soluongmua, size, ngaymua) 
                                            VALUES ('$id_sanpham', '$code_order', '$soluong', '$size', '$update_time')";
                    mysqli_query($mysqli, $insert_order_details);


                    $update_soluongdaban_query = "UPDATE size_soluong 
                                                SET soluongdaban = soluongdaban + $soluong 
                                                WHERE id_sanpham = '$id_sanpham' AND id_size = '$size'";
                    mysqli_query($mysqli, $update_soluongdaban_query);
                } else {

                    echo "<script>alert('Không đủ số lượng cho sản phẩm.');</script>";
                    echo "<script>window.location.href='../../index.php?quanly=giohang';</script>";
                    exit();
                }
            } else {

                echo "Đã xảy ra lỗi khi kiểm tra số lượng còn lại. Vui lòng thử lại sau.";
                exit();
            }
        }
    }

    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $size = $value['size'];


        $check_soluong_query = "SELECT (soluongsize - soluongdaban) AS soluongconlai 
                                FROM size_soluong 
                                WHERE id_sanpham = '$id_sanpham' AND id_size = '$size'";
        $check_soluong_result = mysqli_query($mysqli, $check_soluong_query);

        if ($check_soluong_result) {
            $row = mysqli_fetch_assoc($check_soluong_result);
            $soluongconlai = $row['soluongconlai'];

            if ($soluongconlai >= $soluong) {

                $insert_order_details = "INSERT INTO tbl_cart_details (id_sanpham, code_cart, soluongmua, size, ngaymua) 
                                        VALUES ('$id_sanpham', '$code_order', '$soluong', '$size', '$update_time')";
                $result_insert_order = mysqli_query($mysqli, $insert_order_details);

                if (!$result_insert_order) {

                    echo "Đã xảy ra lỗi khi thêm chi tiết đơn hàng. Vui lòng thử lại sau.";
                }


                $update_soluongdaban_query = "UPDATE size_soluong 
                                            SET soluongdaban = soluongdaban + $soluong 
                                            WHERE id_sanpham = '$id_sanpham' AND id_size = '$size'";
                mysqli_query($mysqli, $update_soluongdaban_query);
            } else {

                echo "<script>alert('Không đủ số lượng cho sản phẩm.');</script>";
                echo "<script>window.location.href='../../index.php?quanly=giohang';</script>";
            }
        } else {

            echo "Đã xảy ra lỗi khi kiểm tra số lượng còn lại. Vui lòng thử lại sau.";
        }
        unset($_SESSION['id_khachhang']);
    }


    $insert_order = "INSERT INTO tbl_donhang ( id_khachhang_temp, code_cart, email, tenkhachhang, dienthoai, diachi, payment_method,ghichu, ngaymua,cart_status)
                    VALUES ('" . $id_khachhang . "','" . $code_order . "','" . $email . "','" . $hoTen . "','" . $soDienThoai . "','" . $diaChi . "','" . $payment_method . "','" . $ghichu . "','" . $update_time . "',0)";
    mysqli_query($mysqli, $insert_order);

    if (isset($_SESSION['id_khachhang'])) {
        $id_khachhang = $_SESSION['id_khachhang'];


        $delete_giohang_query = "DELETE FROM tbl_giohang WHERE id_khachhang = '$id_khachhang'";
        mysqli_query($mysqli, $delete_giohang_query);
    }

    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=ketqua');
}
