<div class="sidebar1">
    <div class="sanpham">
        <a href="index.php">Thống kê</a>
    </div>
    <div class="sanpham">
        <a>Quản lý sản phẩm</a>
        <div class="sanpham1">
            <a href="index.php?action=quanlymenu&query=them">Thêm menu</a>
            <a href="index.php?action=quanlysp&query=them">Thêm sản phẩm</a>
            <a href="index.php?action=quanlysp&query=lieke">Danh sách sản phẩm</a>
        </div>
    </div>
    <a href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a>
    <a href="index.php?action=quanlyhoanhang&query=lietke">Đổi trả</a>
    <?php
    if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
        unset($_SESSION['dangnhap']);
        header('Location:../index.php');
    }
    ?>
    <?php

    if ($_SESSION['role_id'] == 1) {
        //admin
    ?>

        <div class="sanpham">
            <a>Quản lý chính sách</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlytenchinhsach&query=them">Quản lý tên chính sách</a>
                <a href="index.php?action=quanlychinhsach&query=them">Thêm chính sách</a>
                <a href="index.php?action=quanlychinhsach&query=lietke">Danh sách chính sách</a>
            </div>
        </div>
        <div class="sanpham">
            <a>Quản lý trang chủ</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlylienhe&query=them">Thêm liên hệ</a>
                <a href="index.php?action=quanlychinhanh&query=them">Thêm chi nhánh</a>
                <a href="index.php?action=anhtrangbia&query=them">Ảnh trang bìa</a>
            </div>
        </div>
        <div class="sanpham">
            <a>Quản lý bài báo</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlybaibao&query=them">Thêm bài báo</a>
                <a href="index.php?action=quanlybaibao&query=lietke">Liệt kê bài báo</a>
            </div>
        </div>
        <div class="sanpham">
            <a href="index.php?action=quanlythanhvien&query=lietke">Quản lý thành viên</a>
        </div>
        <div class="sanpham">
            <a href="index.php?action=quanlykho&query=lietke">Quản lý kho</a>
        </div>
    <?php
        // Quản lý
    } else {
    ?>

        <div class="sanpham">
            <a>Quản lý chính sách</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlytenchinhsach&query=them">Quản lý tên chính sách</a>
                <a href="index.php?action=quanlychinhsach&query=them">Thêm chính sách</a>
                <a href="index.php?action=quanlychinhsach&query=lietke">Danh sách chính sách</a>
            </div>
        </div>
        <div class="sanpham">
            <a>Quản lý trang chủ</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlylienhe&query=them">Thêm liên hệ</a>
                <a href="index.php?action=quanlychinhanh&query=them">Thêm chi nhánh</a>
                <a href="index.php?action=anhtrangbia&query=them">Ảnh trang bìa</a>
            </div>
        </div>
        <div class="sanpham">
            <a>Quản lý bài báo</a>
            <div class="sanpham1">
                <a href="index.php?action=quanlybaibao&query=them">Thêm bài báo</a>
                <a href="index.php?action=quanlybaibao&query=lietke">Liệt kê bài báo</a>
            </div>
        </div>
    <?php
        // Nhân viên
    }
    ?>



    <p><a href="index.php?dangxuat=1"><i class="bi bi-arrow-return-left"></i> Trang chủ <?php if (isset($_SESSION['dangnhap'])) {
                                                                                            echo $_SESSION['dangnhap'];
                                                                                        } ?></a></p>
</div>