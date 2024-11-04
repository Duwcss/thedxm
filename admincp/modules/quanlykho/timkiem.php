<?php
if (isset($_POST['timkiem'])) {
  $tukhoa = $_POST['tukhoa'];
}
$sql_lietke_sp = "SELECT tbl_sanpham.*, tbl_danhmuc.*, tbl_cart_details.*, SUM(tbl_cart_details.soluongmua) AS total_quantity
  FROM tbl_sanpham
  LEFT JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
  LEFT JOIN tbl_cart_details ON tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
  WHERE tbl_sanpham.tensanpham LIKE '%$tukhoa%'
  GROUP BY tbl_sanpham.id_sanpham
  ORDER BY tbl_sanpham.id_sanpham;
  ";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<h2>Tìm Kiếm : <?php echo $tukhoa; ?></h2>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12 table-responsive">
    <h3 class="the_h">Quản Lý Kho</h3>
    <table class="table table-bordered table-hover" style="margin-top: 20px;">
      <thead>
        <tr style="text-align: center;">
          <th>STT</th>
          <th>Tên</th>
          <th>Hình ảnh</th>
          <th>Số lượng đang có</th>
          <th>Số lượng đã bán</th>
          <th>Danh mục</th>
          <th>Mã sản phẩm</th>

      </thead>
      <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
          $i++;
        ?>
          <tr style="text-align: center;">
            <td><?php echo $i ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><img style="width:100px;max-height:100px" src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>"></td>
            <td><?php echo $row['soluong'] ?></td>
            <td><?php echo $row['total_quantity'] ?></td>
            <td><?php echo $row['tendanhmuc'] ?></td>


            <td><?php echo $row['masp'] ?></td>

          </tr>

          </tr>
        <?php
        }
        ?>