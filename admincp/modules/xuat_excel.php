<?php
include "../config/config.php";


if (isset($_POST['subdays']) && isset($_POST['now'])) {

    $subdays = date("Y-m-d", strtotime($_POST['subdays']));
    $now = date("Y-m-d", strtotime($_POST['now']));
} else {

    $subdays = date("Y-m-d");
    $now = date("Y-m-d");
}

$sql_lietke_sp = "SELECT tbl_sanpham.*, tbl_danhmuc.*, SUM(tbl_cart_details.soluongmua) AS total_quantity
                  FROM tbl_sanpham
                  LEFT JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
                  LEFT JOIN tbl_cart_details ON tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
                  WHERE DATE(tbl_cart_details.ngaymua) BETWEEN '$subdays' AND '$now' 
                  GROUP BY tbl_sanpham.tensanpham
                  ORDER BY tbl_sanpham.id_sanpham DESC";

$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
$filename = 'thongke.csv';
$fp = fopen($filename, 'w');
fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

fputcsv($fp, array('STT', 'Thời Gian', 'Tên sản phẩm', 'Số lượng đã bán', 'Mã sản phẩm', 'Danh mục', 'Doanh thu', 'Giá gốc', 'Chênh lệch'));


$totalQuantity = 0;
$totalRevenue = 0;
$totalProfit = 0;


$i = 0;
while ($row = mysqli_fetch_array($query_lietke_sp)) {
    $i++;
    $soluongban = $row['total_quantity'];

    $soluongcon = $row['soluong'] - $row['total_quantity'];
    $giakhuyenmai = $row['km'];
    $giaban = $row['giasp'] - ($row['giasp'] * $giakhuyenmai / 100);
    $doanhthu = $row['total_quantity'] * $giaban;
    $lai = $doanhthu - ($row['total_quantity'] * $row['giagockm']);


    $totalQuantity += $row['total_quantity'];
    $totalRevenue += $doanhthu;
    $totalProfit += $lai;
    $gianhap = $row['giagockm'] * $row['total_quantity'];


    fputcsv($fp, array(
        $i,
        date("d - m - Y", strtotime($subdays)) . ' đến ngày ' . date("d - m - Y", strtotime($now)),
        $row['tensanpham'],
        $soluongban,
        $row['masp'],
        $row['tendanhmuc'],

        $doanhthu,
        $gianhap,
        $lai
    ));
}

fputcsv($fp, array('', 'Tổng số lượng đã bán:', $totalQuantity));
fputcsv($fp, array('', 'Tổng doanh thu:', $totalRevenue));
fputcsv($fp, array('', 'Tổng chênh lệch', $totalProfit));


fclose($fp);


header('Content-Encoding: UTF-8');
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');


readfile($filename);


unlink($filename);
