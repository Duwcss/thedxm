<?php
$tukhoa = '';
$items_per_page = 12;

if (isset($_POST['tukhoa'])) {
    $tukhoa = $_POST['tukhoa'];
}


$current_page = isset($_GET['page']) ? $_GET['page'] : 1;


$start_from = ($current_page - 1) * $items_per_page;

$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%" . $tukhoa . "%' LIMIT $start_from, $items_per_page";
$query_pro = mysqli_query($mysqli, $sql_pro);


$num_results = mysqli_num_rows($query_pro);


$total_pages = ceil($num_results / $items_per_page);
?>

<div class="headline">
    <h3>Tìm kiếm </h3>
    <h4>Có <?php echo $num_results; ?> sản phẩm cho tìm kiếm</h4>
</div>
<p style="margin-left: 40px;">Kết quả tìm kiếm cho: "<?php if (isset($_POST['tukhoa'])) {
                                                            echo $_POST['tukhoa'];
                                                        } else {
                                                        }  ?>"</p>



<div class="maincontent">
    <?php
    $giaspkm = 0;
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        if ($row_pro['km'] > 0) {
            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
        }
    ?>
        <ul>
            <div class="maincontent-item">
                <div class="maincontent-top">

                    <?php
                    if ($row_pro['km'] == 0) {
                    } else {
                    ?>
                        <div class="khuyenmai"><?php echo number_format($row_pro['km']) . '%' ?></div>
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
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-gia"><?php if ($row_pro['km'] > 0) {
                                                                                                                                    echo number_format($giaspkm) . 'đ';
                                                                                                                                } else {
                                                                                                                                    echo number_format($row_pro['giasp']) . 'đ';
                                                                                                                                } ?>
                        <span class="pro-price-del">
                            <?php
                            if ($row_pro['km'] > 0) {
                                echo '<span class="original-pric" style="text-decoration-line:line-through;color:#ab2121;">' . number_format($row_pro['giasp']) . 'đ</span>';
                            }
                            ?>
                        </span></a>
                </div>
            </div>
        </ul>
    <?php
    }
    ?>
</div>


<div class="pagination">
    <?php
    for ($page = 1; $page <= $total_pages; $page++) {
        echo '<a class="page-link" href="index.php?quanly=timkiem&page=' . $page . '&tukhoa=' . $_POST['tukhoa'] . '">' . $page . '</a>';
    }

    ?>
</div>