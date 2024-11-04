<?php
    include("config/config.php")  ;                       
    $sqli = "SELECT * FROM tbl_khackhang,tbl_role where tbl_role.id_role  = tbl_khackhang.role_id order by `id_khachhang` ";
    $query = mysqli_query($mysqli, $sqli); 
     
?>
<div class="quanlymenu">
<h2>Liệt kê thành viên</h2>
<?php

if( $_SESSION['role_id'] == 1 ){
 ?>
<a href="index.php?action=quanlythanhvien&query=them"><button class="btn btn-success">Thêm Thành Viên</button></a>
<?php 
}else{
}
  ?>
<table class="table table-bordered table-hover" style="margin-top: 20px;">

  <tr>
    <th>STT</th>
    <th>Họ và tên</th>
    <th>Địa chỉ</th>
    <th>Số điện thoại</th>
    <th>Email</th>
    <th>Quyền</th>
    <th colspan="2">Quản lý</th>
  </tr>
   
<?php 
  $i = 0;
  while($row = mysqli_fetch_array($query)){
   
    $i++;
  
    if($row['role_id']  != 1 && $row['role_id'] != 4){
?>
    <th><?php echo $i ?></th>
    <th><?php echo $row['tenkhachhang'] ?></th>
    <th><?php echo $row['diachi'] ?></th>
    <th><?php echo $row['dienthoai'] ?></th>
    <th><?php echo $row['email'] ?></th>
    <th><?php echo $row['name'] ?></th>  
    <?php

if( $_SESSION['role_id'] == 1 ){
 ?>
    <th>
      <a href="modules/quanlythanhvien/xuly.php?idkhachhang=<?php  echo $row['id_khachhang']; ?>"><button  class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></a> </th>
 
      <?php 
}else{

  ?>
  <th width = "80px">Ẩn</th>
  <?php } ?>
  


   
  <?php

if( $_SESSION['role_id'] == 1 ){
 ?>

      <th>
      <a href="?action=quanlythanhvien&query=sua&idkhachhang=<?php echo $row['id_khachhang']?> "><button class="btn btn-warning">Sửa</button></a>
    </th>

    <?php 
}else{

  ?>
  <th width = "80px">Ẩn</th>
  <?php } ?>
  

  </tr>

  <?php } ?>
  <?php
  }
  ?>

</table>
  </div>
