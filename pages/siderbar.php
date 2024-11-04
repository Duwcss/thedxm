<?php
ob_start();
$sql_danhmuc = "SELECT * FROM `tbl_danhmuc` ORDER BY `tbl_danhmuc`.`thutu` ASC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>
<div class="sidebar-ul" style="background-color: #feefd1;border-bottom:1px solid #ccc;">

    <ul style="display: flex;
    text-decoration: none;
    list-style: none;
    justify-content: space-between;
    padding: 5px 200px;
    font-size: 20px;
    margin: 0;
    background-color: #feefd1;
    ">
        <li><a href="index.php"></i>Trang chủ</a></li>
        <li><a href="index.php?quanly=shopall"></i>Tất cả sản phẩm</a></li>
        <li>
            <a href="index.php?quanly=sale">
                <span>Sale</span>
            </a>
        </li>

        <?php
        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
        ?>
            <li><a href="index.php?quanly=danhmuc&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
        <?php
        }
        ?>
        <li><a href="index.php?quanly=donhang"><i class="bi bi-bag"></i> Đơn hàng</a></li>
        <?php

        if (isset($_SESSION['role_id']) && $_SESSION['role_id'] != 4) {
            echo '<li><a href="admincp/index.php"><i class="bi bi-person-circle"></i> ADMIN</a></li>';
        }
        ?>

    </ul>
</div>