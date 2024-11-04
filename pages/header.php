<?php
ob_start();
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    // Xóa toàn bộ session
    session_unset();
    session_destroy();
}

?>
<div class="v-headeer" style="position: fixed;z-index: 1;width: 100%;top:0">
    <div class="v-headeer--top" style="background-color: #000;display:flex;justify-content: space-between;height:50px;align-items: center;padding:0px 70px;">
        <a href="index.php">
            <div class="logo-v" style="color:#fff;">The DxM</div>
        </a>
        <div style="display: flex;">
            <div style="display: flex; color:#fff;">
                <?php
                if (isset($_SESSION['dangky'])) {
                ?>
                    <a style="color:#fff;" href="./index.php?quanly=thongtintaikhoann&id=<?php echo $_SESSION['id_khachhang'] ?>" id="login"><?php echo $_SESSION['dangky']; ?></a>
                    &nbsp;/&nbsp;
                    <a style="color:#fff;" href="#" id="logout">Đăng xuất</a>

                    <script>
                        document.getElementById('logout').addEventListener('click', function() {
                            var confirmLogout = confirm('Bạn muốn đăng xuất không?');
                            if (confirmLogout) {
                                window.location.href = "index.php?dangxuat=1";
                            }
                        });
                    </script>
                <?php
                } else {
                ?>
                    <a href="./index.php?quanly=dangnhap" id="login" style="color:#fff">Đăng nhập</a>
                    &nbsp;/&nbsp;
                    <a href="./index.php?quanly=dangky" id="regist" style="color:#fff">Đăng ký</a>
                <?php
                }
                ?>
            </div>
            <label for="check-timkiem" style="color:#fff">
                <span class="ti-search icon-header"></span>
            </label>
            <label for="check-giohang" class="shopping-cart" style="color:#fff;cursor: pointer;">
                Giỏ Hàng
                <i class="ti-shopping-cart"> <span class="search-box"></span>
                    <?php
                    if (isset($_SESSION['id_khachhang'])) {

                        $id_khachhang = $_SESSION['id_khachhang'];
                        $total_quantity = 0;

                        $sql_count_giohang = "SELECT SUM(soluong) AS total_quantity FROM tbl_giohang WHERE id_khachhang = '$id_khachhang'";
                        $result_count_giohang = mysqli_query($mysqli, $sql_count_giohang);
                        if ($result_count_giohang) {
                            $row_count_giohang = mysqli_fetch_assoc($result_count_giohang);
                            $total_quantity = $row_count_giohang['total_quantity'];

                            echo $total_quantity !== null ? "($total_quantity)" : "";
                        }
                    } elseif (isset($_SESSION['cart'])) {

                        $soluongsanpham = 0;
                        foreach ($_SESSION['cart'] as $cart_item) {
                            $soluongsanpham += $cart_item['soluong'];
                        }
                        echo "($soluongsanpham)";
                    }
                    ?>
                </i>
            </label>
        </div>

    </div>
    <div class="menu" style="background-color: #fff;">
        <?php
        include('./pages/siderbar.php');
        ?>
    </div>

</div>