<?php
if (isset($_POST['timKiem'])) {
  $timKiem = $_POST['timKiem'];



  $sql_lietke_dh = "SELECT * FROM tbl_donhang, tbl_khackhang 
    WHERE tbl_donhang.id_khachhang_temp = tbl_khackhang.id_khachhang 
    AND (tbl_donhang.code_cart LIKE '%$timKiem%' OR tbl_khackhang.tenkhachhang LIKE '%$timKiem%')
    ORDER BY tbl_donhang.id_donhang DESC ";
  $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
} else {

  echo "Không có dữ liệu tìm kiếm được gửi đi.";
}
?>
<div class="quanlymenu">
  <h3>Tìm kiếm : <?php echo $timKiem; ?> </h3>
  <table class='lietkesp'>

    <tr class="header_lietke">
      <th>Id</th>
      <th>Mã đơn</th>
      <th>Tên khách hàng</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <th>Thời gian</th>
      <th>Thanh toán</th>
      <th>Tình trạng</th>
      <th>Chi tiết đơn</th>
      <th>Thao tác</th>


    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
      $i++;
    ?>
      <tr>
        <th><?php echo $i ?></th>
        <th><?php echo $row['code_cart'] ?></th>
        <th><?php echo $row['tenkhachhang'] ?></th>
        <th><?php echo $row['diachi'] ?></th>
        <th><?php echo $row['dienthoai'] ?></th>
        <th><?php echo $row['ngaymua'] ?></th>
        <th><?php echo $row['payment_method'] ?></th>

        <th>
          <?php if ($row['cart_status'] == 0) {
            echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=moi">Đơn hàng mới</a>';
          } elseif ($row['cart_status'] == 1) {
            echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=chuanbi">Chuẩn bị hàng</a>';
          } elseif ($row['cart_status'] == 2) {
            echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=danggiao">Giao hàng</a>';
          } else {
            echo "Đã xác nhận";
          } // nếu ấn vào 
          ?>
        </th>

        </td>

        <th>
          <a href="index.php?action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
        </th>
        <th>
          <a href="modules/quanlydonhang/xuly.php?idcart=<?php echo $row['code_cart']; ?>">Xóa</a>
        </th>


      </tr>
    <?php
    }
    ?>

  </table>

</div>