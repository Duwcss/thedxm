<div>
    <?php
    if (isset($_GET['trang'])) {
        $page = $_GET['trang'];
    } else {
        $page = 1;
    }
    if ($page == '' || $page == 1) {
        $begin = 0;
    } else {
        $begin = ($page * 8) - 8;
    }


    $sql_pro = "SELECT * FROM tbl_sanpham WHERE km>0 ORDER BY km DESC LIMIT $begin,8";
    $query_pro = mysqli_query($mysqli, $sql_pro);



    ?>

    <div class="headline">
        <h3>Khuyến Mãi</h3>
    </div>
    <div class="home-sort">
        <span class="filter-sort">Trang: <?php echo $page ?></span>


    </div>
</div>
<div class="maincontent">

    <?php
    $giaspkm = 0;
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        if ($row_pro['km'] > 0) {
            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
        };
    ?>

        <ul>
            <div class="maincontent-item">
                <div class="maincontent-top">

                    <?php
                    if ($row_pro['km'] == 0) {
                    } else {
                    ?>
                        <div class="khuyenmai"><?php echo "-" . number_format($row_pro['km']) . '%' ?></div>
                    <?php
                    }
                    ?>
                    <div class="maiconten-top1">

                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-img">
                            <img src="./admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>">
                        </a>
                        <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Xem ngay</a></button>

                    </div>
                </div>
                <div class="maincontent-info">
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-gia"><?php if ($row_pro['km'] > 0) {
                                                                                                                            echo number_format($giaspkm) . 'đ';
                                                                                                                        } else {
                                                                                                                            echo number_format($row_pro['giasp']) . 'đ';
                                                                                                                        } ?>
                        <span class="pro-price-del">
                            <?php
                            if ($row_pro['km'] > 0) {
                                echo '<span class="original-price">' . number_format($row_pro['giasp']) . 'đ</span>';
                            }
                            ?>
                        </span>
                    </a>
                </div>
            </div>
        </ul>
    <?php
    }
    ?>

</div>
<div class="content-paging">
    <?php
    $sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham WHERE km>0");
    $row_count = mysqli_num_rows($sql_trang);
    $trang = ceil($row_count / 8);

    ?>
    <div class="filter-page">

        <?php
        for ($i = 1; $i <= $trang; $i++) {
        ?>
            <a <?php if ($i == $page) {
                    echo 'style="color: red;background-color: #ccc;"';
                } else {
                    '';
                } ?> href="index.php?quanly=sale&trang=<?php echo $i ?>" class="filter-page-number"><?php echo $i ?></a>

        <?php
        }
        ?>

    </div>
</div>