<?php

if (isset($_POST['subdays']) && isset($_POST['now'])) {

    $subdays = date("Y-m-d", strtotime($_POST['subdays']));
    $now = date("Y-m-d", strtotime($_POST['now']));
} else {

    $subdays = date("Y-m-d");
    $now = date("Y-m-d");
}


$subdaysHienThi = date("d - m - Y", strtotime($subdays));
$nowHienThi = date("d - m - Y", strtotime($now));
?>




<div class="quanlymenu">
    <p>Thống kê đơn hàng theo : <span id="text-date"></span></p>
    <p>
        <select class="select-date">
            <option value="">Thống kê chi tiết</option>

            <option value="7ngay">7 ngày qua</option>
            <option value="28ngay">28 ngày qua</option>
            <option value="90ngay">90 ngày qua</option>
            <option value="365ngay">365 ngày qua</option>
        </select>
    </p>
    <div id="chart" style="height: 250px;"></div>
    <?php
    include('config/config.php');


    $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
    $now = new DateTime('now', $timezone);
    $nowDateString = $now->format('Y-m-d');

    if (isset($_POST['thoigian'])) {
        $thoigian = $_POST['thoigian'];
    } else {
        $thoigian = '';
        $subdays = (new DateTime('now', $timezone))->sub(new DateInterval('P365D'))->format('Y-m-d');
    }

    if ($thoigian == '7ngay') {
        $subdays = (new DateTime('now', $timezone))->sub(new DateInterval('P7D'))->format('Y-m-d');
    } elseif ($thoigian == '28ngay') {
        $subdays = (new DateTime('now', $timezone))->sub(new DateInterval('P28D'))->format('Y-m-d');
    } elseif ($thoigian == '90ngay') {
        $subdays = (new DateTime('now', $timezone))->sub(new DateInterval('P90D'))->format('Y-m-d');
    } elseif ($thoigian == '365ngay') {
        $subdays = (new DateTime('now', $timezone))->sub(new DateInterval('P365D'))->format('Y-m-d');
    }

    $now = (new DateTime('now', $timezone))->format('Y-m-d');

    $sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN '$subdays' AND '$now' ORDER BY ngaydat ASC";
    $sql_query = mysqli_query($mysqli, $sql);

    while ($val = mysqli_fetch_array($sql_query)) {

        $chart_data[] = array(
            'date' => $val['ngaydat'],
            'order' => $val['donhang'],
            'sales' => $val['doanhthu'],
            'quantity' => $val['soluongban']



        );
    }


    ?>
</div>

<?php include "thongkechitiet.php"; ?>