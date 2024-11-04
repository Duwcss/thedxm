<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin The DxM</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="shortcut icon" type="image/png" href="../assets/img/LogoTheDxM.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<?php
session_start();

?>

<body>
    <?php
    if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])) {

        if ($_SESSION['role_id'] == 4) {

            echo '<h1 style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; color: red;">Bạn không có quyền truy cập! <br><a href="../index.php">Trở lại</a></h1>';
        } else {

            include('./modules/header.php');
            echo '<div class="main">';
            echo '<div class="sidebar">';
            include('./modules/menu.php');
            echo '</div>';
            include('./config/config.php');
            include('./modules/main.php');
            echo '</div>';
        }
    } else {
        echo '<h1 style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; color: red;">Vui lòng đăng nhập! <br><a href="../index.php">Trở lại</a></h1>';
    }
    ?>

    </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        CKEDITOR.replace('thongtinlienhe');
        CKEDITOR.replace('tomtat');
        CKEDITOR.replace('noidung');
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            thongke();
            var char = new Morris.Area({

                element: 'chart',

                xkey: 'date',

                ykeys: ['date', 'donhang', 'doanhthu', 'gianhap', 'soluong', 'loinhuan'],

                labels: ['time', 'Đơn hàng', 'doanh thu', 'Giá nhập', 'Số lượng đã bán', 'Lợi Nhuận']
            });

            $('.select-date').change(function() {
                var thoigian = $(this).val();
                if (thoigian == '7ngay') {
                    var text = '7 ngày qua';
                } else if (thoigian == '28ngay') {
                    var text = '28 ngày qua';
                } else if (thoigian == '90ngay') {
                    var text = '90 ngày qua';
                } else {
                    var text = '365 ngày qua';
                }

                $.ajax({
                    url: "modules/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        thoigian: thoigian
                    },
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                });
            })

            function thongke() {
                var text = '365 ngày qua';
                $('#text-date').text(text);
                $.ajax({
                    url: "modules/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                });
            }
        });
    </script>
    <?php
    include('./modules/footer.php');
    ?>

</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('tomtat');
    CKEDITOR.replace('noidung');
</script>

</html>