<?php

if (isset($_POST['ngayBatDau']) && isset($_POST['ngayKetThuc'])) {

    $ngayBatDau = date("d - m - Y", strtotime($_POST['ngayBatDau']));
    $ngayKetThuc = date("d - m - Y", strtotime($_POST['ngayKetThuc']));
} else {

    echo "Vui lòng nhập ngày bắt đầu và ngày kết thúc.";
}
?>


<?php


$ngayBatDau = $_POST['ngayBatDau'];
$ngayKetThuc = $_POST['ngayKetThuc'];


$sql_lietke_sp = "SELECT tbl_hoanhang.*, tbl_khackhang.* 
                  FROM tbl_hoanhang
                  LEFT JOIN tbl_khackhang ON tbl_hoanhang.id_khachhang = tbl_khackhang.id_khachhang
                  WHERE DATE(tbl_hoanhang.ngay_gui) BETWEEN '$ngayBatDau' AND '$ngayKetThuc'
                  ORDER BY tbl_hoanhang.code_cart DESC";


$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>

<div class="quanlymenu">

    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12 table-responsive">
            <h3 class="the_h">Quản Lý Hoàn Hàng</h3>

            <h3>Liệt kê sản phẩm đã bán từ ngày <?php echo date("d - m - Y", strtotime($ngayBatDau)); ?> đến ngày <?php echo date("d - m - Y", strtotime($ngayKetThuc)); ?></h3>

            <form class="form-inline mt-3" action="" method="POST">
                <div class="form-group mr-2">
                    <label for="ngayBatDau" class="mr-2">Ngày bắt đầu:</label>
                    <input type="date" class="form-control" name="ngayBatDau" required value="<?php echo date("Y-m-d", strtotime($ngayBatDau)); ?>">
                </div>

                <div class="form-group mr-2">
                    <label for="ngayKetThuc" class="mr-2">Ngày kết thúc:</label>
                    <input type="date" class="form-control" name="ngayKetThuc" required value="<?php echo date("Y-m-d", strtotime($ngayKetThuc)); ?>">
                </div>

                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </form>


            <table class="table table-bordered table-hover" style="margin-top: 20px;">
                <thead>

                    <tr style="text-align: center;">
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày gửi</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        <th>Quản lý</th>
                        <th>Thao tác</th>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($query_lietke_sp)) {
                        $i++
                    ?>
                        <tr style="text-align: center;">
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['code_cart'] ?></td>
                            <td><?php echo $row['tenkhachhang'] ?></td>
                            <td><?php echo $row['diachi'] ?></td>
                            <td><?php echo $row['dienthoai'] ?></td>
                            <td><?php echo $row['stime'] ?></td>
                            <td><?php echo $row['payment_method'] ?></td>
                            <td>
                                <?php if ($row['cart_status'] == 0) {
                                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=moi">Đơn hàng mới</a>';
                                } elseif ($row['cart_status'] == 1) {
                                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=chuanbi">Chuẩn bị hàng</a>';
                                } elseif ($row['cart_status'] == 2) {
                                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=danggiao">Giao hàng</a>';
                                } elseif ($row['cart_status'] == 4) {
                                    echo 'Đã hủy';
                                } else {
                                    echo "Đã xác nhận";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="index.php?action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
                            </td>
                            <td>
                                <a href="modules/quanlydonhang/xuly.php?idcart=<?php echo $row['code_cart']; ?>">Xóa</a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
            </table>