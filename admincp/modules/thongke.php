<?php

include('../config/config.php');

$timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
$now = new DateTime('now', $timezone);
$nowDateString = $now->format('Y-m-d');

if (isset($_POST['thoigian'])) {
    $thoigian = $_POST['thoigian'];
} else {
    $thoigian = '';
    $subdays = date('Y-m-d', strtotime('-365 days'));
}

if ($thoigian == '7ngay') {
    $subdays = date('Y-m-d', strtotime('-7 days'));
} elseif ($thoigian == '28ngay') {
    $subdays = date('Y-m-d', strtotime('-28 days'));
} elseif ($thoigian == '90ngay') {
    $subdays = date('Y-m-d', strtotime('-90 days'));
} elseif ($thoigian == '365ngay') {
    $subdays = date('Y-m-d', strtotime('-365 days'));
}

$now = new DateTime('now', $timezone);
$nowDateString = $now->format('Y-m-d');
$sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN '$subdays' AND '$nowDateString' ORDER BY ngaydat ASC";
$sql_query = mysqli_query($mysqli, $sql);

while ($val = mysqli_fetch_array($sql_query)) {
    $chart_data[] = array(
        'date' => $val['ngaydat'],
        'donhang' => $val['donhang'],
        'doanhthu' => $val['doanhthu'],
        'gianhap' => $val['gianhap'],
        'soluong' => $val['soluongban'],
        'loinhuan' => $val['loinhuan'],
    );
}

echo $data = json_encode($chart_data);
?>
