

<?php
include('../../config/config.php');
$email = $_POST['email'];
$matkhau = md5($_POST['matkhau']);
$tenkhachhang = $_POST['hoten'];

$id_role = $_POST['role_id'];
$dienthoai = $_POST['dienthoai'];
$diachi = $_POST['diachi'];
if(isset($_POST['suathanhvien'])){

       
        $sql_update = "UPDATE tbl_khackhang SET tenkhachhang = '".$tenkhachhang."',email = '".$email."',diachi = '".$diachi."', matkhau = '".$matkhau."',dienthoai = '".$dienthoai."' ,role_id = '".$id_role."' WHERE id_khachhang='$_GET[idkhachhang]' ";
       //xoa hinh anh cu
        $sql = "SELECT * FROM tbl_khackhang WHERE id_khachhang = '$_GET[idkhachhang]' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
	
		
          
    mysqli_query($mysqli,$sql_update);
    header('Location:../../index.php?action=quanlythanhvien&query=lietke');
}  else{
    $id = $_GET['idkhachhang'];
    $sql_xoa = "DELETE FROM tbl_khackhang WHERE id_khachhang = '".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    
    
    header('Location:../../index.php?action=quanlythanhvien&query=lietke');
    }   
    
        ?>











