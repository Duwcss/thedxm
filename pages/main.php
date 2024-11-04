<div class="main1" style="margin-top: 85px;">
    <div>
        <?php

        if (isset($_GET['quanly'])) {
            $tam = $_GET['quanly'];
        } else {
            $tam = '';
        }
        if ($tam == 'danhmuc') {
            include('./pages/main/danhmuc.php');
        } elseif ($tam == 'sanpham') {
            include('./pages/main/sanpham.php');
        } elseif ($tam == 'giohang') {
            include('./pages/main/giohang.php');
        } elseif ($tam == 'dangky') {
            include('./pages/main/dangky.php');
        } elseif ($tam == 'thanhtoan') {
            include('./pages/main/thanhtoan.php');
        } elseif ($tam == 'dangnhap') {
            include('./pages/main/dangnhap.php');
        } elseif ($tam == 'timkiem') {
            include('./pages/main/timkiem.php');
        } elseif ($tam == 'ketqua') {
            include('./pages/main/ketquathanhtoan.php');
        } elseif ($tam == 'shopall') {
            include('./pages/main/all.php');
        } elseif ($tam == 'sale') {
            include('./pages/main/sale.php');
        } elseif ($tam == 'chinhsach') {
            include('./pages/footermodal/chinhsach.php');
        } elseif ($tam == 'baibao') {
            include('./pages/main/baibao.php');
        } elseif ($tam == 'chitiet') {
            include('./pages/main/chitietsp.php');
        } elseif ($tam == 'thongtintaikhoann') {
            include('./pages/main/thongtintaikhoan.php');
        } elseif ($tam == 'suathongtintaikhoann') {
            include('./pages/main/suataikhoan.php');
        } elseif ($tam == 'donhang') {
            include('./pages/main/donhang.php');
        } elseif ($tam == 'xemdonhang') {
            include('./pages/main/xemdonhang.php');
        } elseif ($tam == 'xuly') {
            include('./pages/main/xuly.php');
        } elseif ($tam == 'hoanhang') {
            include('./pages/main/hoanhang.php');
        } elseif ($tam == 'xulythanhtoan') {
            include('./pages/main/xulythanhtoan.php');
        } else {
            include('./pages/main/index.php');
        }
        ?>

        <?php
        include('./pages/footermodal/footer.php');
        ?>
        <?php
        include('./pages/footermodal/cart.php');
        ?>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php
    include('./pages/footermodal/modal.php');
    ?>