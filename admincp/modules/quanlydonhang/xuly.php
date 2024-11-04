<?php
include('../../config/config.php');
$timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
$nowDateString = new DateTime('now', $timezone);
$now = $nowDateString->format('Y-m-d');

if (isset($_GET['code']) && isset($_GET['status'])) {
    $code_cart = $_GET['code'];
    $status = $_GET['status'];


    if ($status == 'moi') {
        $sql_update = "UPDATE tbl_donhang SET cart_status = 1 WHERE code_cart = '$code_cart'";
    } elseif ($status == 'chuanbi') {
        $sql_update = "UPDATE tbl_donhang SET cart_status = 2 WHERE code_cart = '$code_cart'";
    } elseif ($status == 'danggiao') {
        $sql_update = "UPDATE tbl_donhang SET cart_status = 3 WHERE code_cart = '$code_cart'";
    }
    $query = mysqli_query($mysqli, $sql_update);


    $sql_lietke_dh = "SELECT * FROM tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham AND tbl_cart_details.code_cart = '$code_cart' ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);


    $soluongmua = 0;
    $doanhthu = 0;
    $gianhap = 0;


    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $soluongmua += $row['soluongmua'];
        $giaspkm = $row['giasp'] - ($row['giasp'] * ($row['km'] / 100));
        $doanhthu += $soluongmua * $giaspkm;
        $gianhap += $soluongmua * $row['giagockm'];
    }


    $now = date('Y-m-d');


    $sql_donhang = "SELECT * FROM tbl_donhang WHERE code_cart = '$code_cart'";
    $query_donhang = mysqli_query($mysqli, $sql_donhang);
    $row_donhang = mysqli_fetch_array($query_donhang);

    $sql_thongke = "SELECT * FROM tbl_thongke WHERE ngaydat = '$now'";
    $query_thongke = mysqli_query($mysqli, $sql_thongke);

    if (mysqli_num_rows($query_thongke) == 0) {

        $soluongban = $soluongmua;
        $loinhuan = $doanhthu - $gianhap;
        $donhang = 1;

        $sql_insert_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, gianhap, donhang, loinhuan) VALUES ('$now', '$soluongban', '$doanhthu', '$gianhap', '$donhang', '$loinhuan')";
        mysqli_query($mysqli, $sql_insert_thongke);
    } else {

        $row_tk = mysqli_fetch_array($query_thongke);
        $soluongban = $row_tk['soluongban'] + $soluongmua;
        $doanhthuss = $row_tk['doanhthu'] + $doanhthu;
        $gianhaps = $row_tk['gianhap'] + $gianhap;
        $loinhuan = $doanhthuss - $gianhaps;
        $donhang = $row_tk['donhang'] + 1;

        $sql_update_thongke = "UPDATE tbl_thongke SET soluongban='$soluongban', doanhthu='$doanhthuss', gianhap='$gianhaps', loinhuan='$loinhuan', donhang='$donhang' WHERE ngaydat='$now'";
        mysqli_query($mysqli, $sql_update_thongke);
    }


    header('Location:../../index.php?action=quanlydonhang&query=lietke');
} else {
    $id = $_GET['idcart'];


    $sql_xoa = "DELETE tbl_giohang, tbl_cart_details, tbl_donhang
        FROM tbl_giohang
        LEFT JOIN tbl_cart_details ON tbl_donhang.code_cart = tbl_cart_details.code_cart
        LEFT JOIN tbl_donhang ON tbl_donhang.code_cart = tbl_donhang.code_cart
        WHERE tbl_donhang.code_cart = '" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);

    header('Location:../../index.php?action=quanlydonhang&query=lietke');
}
