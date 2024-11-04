<?php
// phân trang
if (isset($_GET['trang'])) {
  $page = $_GET['trang'];
} else {
  $page = '';
}
if ($page == '' || $page == 1) {
  $begin = 0;
} else {
  $begin = ($page * 20) - 20;
}
?>
<?php

$sql_lietke_sp = "SELECT tbl_sanpham.*, tbl_danhmuc.*, SUM(tbl_cart_details.soluongmua) AS total_quantity
                             FROM tbl_sanpham
                             LEFT JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
                             LEFT JOIN tbl_cart_details ON tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
                             GROUP BY tbl_sanpham.id_sanpham
                             ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin, 20";

$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);

?>
<div class="quanlymenu">
  <h3>Quản lý kho </h3>

  <table class='lietkesp'>
    <tr class="header_lietke">
      <th>STT</th>
      <th>Tên</th>
      <th>Hình ảnh</th>
      <th>Số lượng nhập</th>
      <th>Số lượng đã bán</th>
      <th>Số lượng còn lại</th>
      <th>Danh mục</th>
      <th>Mã sản phẩm</th>

      </thead>
      <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
          $soluongcon = 0;
          $soluongcon = $row['soluong'] - $row['total_quantity'];
          $i++;
        ?>
          <tr style="text-align: center;">
            <th><?php echo $i ?></th>
            <th><?php echo $row['tensanpham'] ?></th>
            <th><img style="width:100px;max-height:100px" src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>"></th>
            <th><?php echo $row['soluong'] ?></th>

            <th><?php if ($row['total_quantity'] == 0) {
                  echo "0";
                } else {
                  echo $row['total_quantity'];
                } ?></th>
            <th><?php echo $soluongcon ?></th>

            <th><?php echo $row['tendanhmuc'] ?></th>


            <th><?php echo $row['masp'] ?></th>

          </tr>

        <?php
        }
        ?>
  </table>
  <?php
  // phân trang
  $sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham");
  $row_count = mysqli_num_rows($sql_trang);
  $trang = ceil($row_count / 20);
  ?>
  <nav style="  margin: auto;margin-top: 70px;" aria-label="Page navigation example">
    <ul class="pagination">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
      </li>
      <?php
      for ($i = 1; $i <= $trang; $i++) {
      ?>
        <span class="page-item"><a class="page-link" <?php if ($i == $page) {
                                                        echo 'style="background: #bfbfbf;"';
                                                      } else {
                                                        echo '';
                                                      } ?> href="index.php?action=quanlykho&query=lietke&trang=<?php echo $i ?>"><?php echo $i ?></a></span>
      <?php
      }
      ?>
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
      </li>
    </ul>
  </nav>