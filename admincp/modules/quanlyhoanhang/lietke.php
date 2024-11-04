
<?php
// Phân trang
if(isset($_GET['trang'])){
    $page = $_GET['trang'];
}else{
    $page = '';
}
if($page == '' || $page == 1){
    $begin = 0;
}else{
    $begin = ($page*10)-10;
}
?>
<?php
	$sql_lietke_dh = "SELECT * FROM tbl_hoanhang,tbl_khackhang WHERE tbl_hoanhang.id_khachhang=tbl_khackhang.id_khachhang ORDER BY `tbl_hoanhang`.`ngay_gui` DESC LIMIT $begin,10";
	$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
?>
 <div class="quanlymenu">
	<div class="col-md-12 table-responsive">
		<h3 class="the_h">Liệt Kê Đơn Đổi Trả</h3>

  <form class="form-inline mt-3" action="index.php?action=quanlyhoanhang&query=loc" method="POST">
                            <div class="form-group mr-2">
                                <label for="ngayBatDau" class="mr-2">Lọc theo ngày:</label>
                                <input type="date" class="form-control" name="ngayBatDau" required>
                            </div>
                        
                            <div class="form-group mr-2">
                                <label for="ngayKetThuc" class="mr-2">Đến ngày:</label>
                                <input type="date" class="form-control" name="ngayKetThuc" required>
                            </div>
                        
                            <button type="submit" class="btn btn-success">Lọc</button>
                        </form>
                        <form class="form-inline mt-3" action="index.php?action=quanlyhoanhang&query=timkiem" method="POST">
    <div class="form-group mr-2">
        <label for="ngayBatDau" class="mr-2">Tìm kiếm :</label>
        <input type="text" class="form-control" name="timKiem" placeholder="Nhập tên hoặc mã đơn">
    </div>
    
    <button type="submit" class="btn btn-success">Tìm kiếm</button>
</form>

		<table class="table table-bordered table-hover" style="margin-top: 20px;">
    <thead>
  <tr>
  	<th>STT</th>
    <th>Mã đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Số điện thoại</th>
    <th>Ngày gửi</th>
    <th>Nội dung</th>
    <th>Tình trạng</th>
  	<th>Quản lý</th>
    <th>Thao tác</th>

  </tr>
  <?php
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
  	$i++;
  ?>
  <tr>
  	<td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td>
    <td><?php echo $row['dienthoai'] ?></td>
    <td><?php echo $row['ngay_gui'] ?></td>
    <td><?php echo $row['noidung'] ?></td>

    
    <td>
    <?php if($row['status_lh']==0){
                    echo '<a class="inputdonhang" href="modules/quanlyhoanhang/xuly.php?code='.$row['code_cart'].'&status=moi">Đơn hàng mới</a>';
                } elseif($row['status_lh'] ==1){
                    echo '<a class="inputdonhang" href="modules/quanlyhoanhang/xuly.php?code=' . $row['code_cart'] . '&status=chuanbi">Chuẩn bị hàng</a>';
                } elseif($row['status_lh'] == 2){
                    echo '<a class="inputdonhang" href="modules/quanlyhoanhang/xuly.php?code=' . $row['code_cart'] . '&status=danggiao">Giao hàng</a>';
                }  else {
                    echo "Đã xác nhận";
                }
                ?>
    </td>
   	<td>
   		<a href="index.php? action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
   	</td>
     <td>
      <a href="modules/quanlyhoanhang/xuly.php?idcart=<?php  echo $row['code_cart']; ?>"><button  class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></a>
     </td>
  </tr>
  <?php
  } 
  ?>
   </tr>
  </thead>
  
</table>
<?php
// phân trang
     $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
     $row_count = mysqli_num_rows($sql_trang);
     $trang = ceil($row_count/20);
     ?>
   <nav style="  width: 0%; margin: auto;margin-top: 70px;" aria-label="Page navigation example">
  <ul class="pagination">
      <a class="page-link" href="#" aria-label="Previous">    
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php              
                for($i=1;$i<=$trang;$i++){
                ?>
    <span class="page-item"><a class="page-link" <?php if($i == $page){echo 'style="background: #bfbfbf;"';}else{ echo ''; } ?> href="index.php?action=quanlyhoanhang&query=lietke&trang=<?php echo $i ?>"><?php echo $i ?></a></span>        
    <?php
             }
             ?>
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>   