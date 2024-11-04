<?php
if (isset($_POST['sua'])) {

    $sql_sua_cs = "SELECT * FROM tbl_khackhang WHERE tbl_khackhang.id_khachhang = '$_GET[id]'  LIMIT 1";
    $query_sua_cs = mysqli_query($mysqli, $sql_sua_cs);
    $row = mysqli_fetch_array($query_sua_cs);


    $tenkhachhang = !empty($_POST['hoten']) ? $_POST['hoten'] : $row['tenkhachhang'];
    $diachi = !empty($_POST['diachi']) ? $_POST['diachi'] : $row['diachi'];
    $dienthoai = !empty($_POST['dienthoai']) ? $_POST['dienthoai'] : $row['dienthoai'];


    $sql_update = "UPDATE tbl_khackhang SET tenkhachhang='" . $tenkhachhang . "', diachi='" . $diachi . "', dienthoai='" . $dienthoai . "' WHERE id_khachhang='$_GET[id]'";
    mysqli_query($mysqli, $sql_update);
    header('location:./index.php');
}
?>

<?php
$sql_sua_cs = "SELECT * FROM tbl_khackhang WHERE tbl_khackhang.id_khachhang = '$_GET[id]'  LIMIT 1";
$query_sua_cs = mysqli_query($mysqli, $sql_sua_cs);
while ($row = mysqli_fetch_array($query_sua_cs)) {
?>
    <form action="#" method="POST">
        <div class="login-form">
            <div class="login-container">

                <h2>Sửa thông tin tài khoản </h2>
                <a>Tên <span style="color:red">*</span></a><br>
                <input type="text" placeholder="<?php echo $row['tenkhachhang'] ?>" name="hoten"><br>
                <a>Địa chỉ<span style="color:red">*</span></a><br>
                <input type="text" placeholder="<?php echo $row['diachi'] ?>" name="diachi"><br>
                <a>Điện thoại <span style="color:red">*</span></a><br>

                <input type="text" placeholder="<?php echo $row['dienthoai'] ?>" name="dienthoai"><br>


                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                <input type="hidden" name="matkhau" value="<?php echo $row['matkhau']; ?>">
                <button name="sua">Sửa</button>
                <div><a href="./index.php">
                        <p>← Quay lại trang chủ</p>
                    </a></div>
            </div>
        </div>
    </form>
    <div class="clear"></div>
<?php } ?>