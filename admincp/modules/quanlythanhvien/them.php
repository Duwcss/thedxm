<?php

if (isset($_POST['khachhang'])) {
    $email = $_POST['email'];
    $tenkhachhang = $_POST['hoten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);
    $diachi = $_POST['diachi'];
    $id_role = $_POST['role_id'];


    if (empty($email) ||  empty($matkhau)  || empty($tenkhachhang) || empty($dienthoai) || empty($diachi) || strlen($matkhau) < 6) {
    } else {

        $userExist = "SELECT * FROM tbl_khackhang where email = '$email'";
        $row_pro = mysqli_query($mysqli, $userExist);

        $result = mysqli_fetch_array($row_pro, true);

        if ($result != null) {

            echo '<script>alert("Email đã được đăng ký trên hệ thống,vui lòng kiểm tra lại.");</script>';
        } else {

            $sql_khachhang = mysqli_query($mysqli, "INSERT INTO tbl_khackhang(tenkhachhang,email,dienthoai,matkhau,diachi,role_id) VALUE ('" . $tenkhachhang . "','" . $email . "', '" . $dienthoai . "', '" . $matkhau . "', '" . $diachi . "','" . $id_role . "' )");

            echo '<script>alert("Đăng ký thành công");</script>';


            $_SESSION['khachhang'] = $email;

            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng Ký</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body">
    <div class="quanlymenu">
        <h3>Thêm Tài Khoản Người Dùng</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">
            </div>
            <div class="panel-body">

                <form action="" method="POST" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label>Họ & Tên:</label>
                        <input type="text" class="form-control" id="usr" name="hoten" placeholder="Nhập Họ & Tên">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" id="usr" placeholder="Nhập địa chỉ" name="diachi">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="dienthoai" minlength="6" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                    </div>


                    <div class="form-group">
                        <label for="usr">Quyền:</label>
                        <select class="form-control" name="role_id" id="role_id" required="true">
                            <option value="">-- Chọn --</option>

                            <?php
                            $role = "SELECT * FROM `tbl_role` ";
                            $sql_role = mysqli_query($mysqli, $role);



                            while ($row = mysqli_fetch_array($sql_role)) {
                                echo '<option value="' . $row['id_role'] . '">' . $row['name'] . '</option> ';
                            }


                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="pwd">Mật Khẩu:</label>
                        <input required="true" type="password" class="form-control" id="pwd" name="matkhau" minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="confirmation_pwd">Xác Minh Mật Khẩu:</label>
                        <input required="true" type="password" class="form-control" id="confirmation_pwd" minlength="6">
                    </div>
                    <div class="form-group" style="text-align: center; ">
                        <input type="submit" name="khachhang" class="btn btn-success" value="Đăng ký" style="margin-bottom: 15px;"></input>
                        <br>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function validateForm() {
            $pwd = $('#pwd').val();
            $confirmPwd = $('#confirmation_pwd').val();
            if ($pwd != $confirmPwd) {
                alert("Mật khẩu không khớp, vui lòng kiểm tra lại")
                return false
            }
            return true
        }
    </script>

    </body>

</html>