<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>The DxM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/csssanpham.css">
    <link rel="stylesheet" href="./assets/css/bao.css">
    <link rel="stylesheet" href="./assets/css/dk dang nhap.css">
    <link rel="stylesheet" href="./assets/css/hior hàng .css">
    <link rel="stylesheet" href="./assets/css/xemngay.css">
    <link rel="stylesheet" href="./assets/css/chitietsp.css">
    <link rel="stylesheet" href="./assets/css/thongtin.css">
    <link rel="stylesheet" href="./assets/icon/themify-icons/themify-icons.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/LogoTheDxM.png">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="wappter">
        <?php
        session_start();
        include('./admincp/config/config.php');
        include('./pages/header.php');

        include('./pages/main.php');
        ?>
    </div>

    </div>
    <div class="clear"></div>


</body>

</html>