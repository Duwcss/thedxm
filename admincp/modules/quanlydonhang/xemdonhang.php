<div class="quanlymenu">
  <h3>Xem đơn hàng </h3>
  <?php
  $code = $_GET['code'];
  $sql_lietke_dh = "SELECT tbl_cart_details.*, tbl_sanpham.*, size.ten_size
  FROM tbl_cart_details
  INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham
  INNER JOIN size ON tbl_cart_details.size = size.id_size
  WHERE tbl_cart_details.code_cart = '" . $code . "'
  ORDER BY tbl_cart_details.id_cart_details DESC
  ";

  $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
  ?>
  <table class='lietkesp'>
    <tr class="header_lietke">
      <th>Id</th>
      <th>Mã đơn hàng</th>
      <th>Tên sản phẩm</th>
      <th>Ảnh</th>
      <th>Số lượng</th>
      <th>Giá gốc</th>
      <th>Đơn giá</th>
      <th>Kích thước</th>
      <th>Lãi</th>

    </tr>
    <?php
    $i = 0;
    $tongtien = 0;
    $tienlai = 0;
    $giaspkm = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
      if ($row['km'] > 0) {
        $giaspkm = $row['giasp'] - ($row['giasp'] * ($row['km'] / 100));
      } else {
        $giaspkm = $row['giasp'];
      }
      $i++;
      $thanhtien = $giaspkm * $row['soluongmua'];
      $tongtien += $thanhtien;
      $tienlaia = $row['giagockm'] * $row['soluongmua'];
      $tienlai += $tienlaia;
      $lai = $tongtien - $tienlai;
      $lais = $thanhtien - $tienlaia;
    ?>
      <tr>
        <th><?php echo $i ?></th>
        <th><?php echo $row['code_cart'] ?></th>
        <th><?php echo $row['tensanpham'] ?></th>
        <th><img style="width:50px;max-height:80px;" src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>"></th>
        <th><?php echo $row['soluongmua'] ?></th>
        <th><?php echo number_format($row['giagockm']) . 'đ' ?></th>
        <th><?php echo number_format($giaspkm) . 'đ' ?></th>
        <th><?php echo $row['ten_size'] ?></th>
        <th><?php echo number_format($lais) . 'đ' ?></th>

      </tr>
    <?php
    }
    ?>
    <tr>
      <th colspan="7">
        <p>Tổng tiền : <?php echo number_format($tongtien, 0, ',', '.') . 'vnđ' ?></p>
      </th>
      <th>
        <p>Tổng Lãi : <?php echo number_format($lais, 0, ',', '.') . 'vnđ' ?></p>
      </th>

    </tr>

    <tr>
      <th>
        <a class="inputdonhang" href="index.php?action=quanlydonhang&query=lietke">
          < Quay lại trang quản lý đơn hàng</a>
      </th>
    </tr>

  </table>
</div>