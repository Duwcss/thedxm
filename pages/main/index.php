<div class="main-slider1" style="margin:0px">
    <?php
    $sql_anhtrangbia = "SELECT * FROM tbl_anhtrangbia WHERE tinhtrang=1";
    $query_anhtrangbia = mysqli_query($mysqli, $sql_anhtrangbia);
    while ($row_anhtrangbia = mysqli_fetch_array($query_anhtrangbia)) {
    ?>
        <a href="#"><img class="mySlider" src="./admincp/modules/anhtrangbia/uploads/<?php echo $row_anhtrangbia['hinhanh'] ?>" height=auto width=100%></a>

    <?php } ?>
</div>
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlider");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 2000);
    }
</script>
<div class="main-content">

    <div class="content-section">
        <h2 class="phuonganhheader">New Arrivals</h2>

        <div class="maincontent">
            <?php
            $sql_pro = "SELECT * FROM tbl_sanpham WHERE tinhtrang=1 LIMIT 12 ";
            $query_pro = mysqli_query($mysqli, $sql_pro);
            $giaspkm = 0;
            while ($row_pro = mysqli_fetch_array($query_pro)) {
                if ($row_pro['km'] > 0) {
                    $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
                };
            ?>

                <ul>
                    <div class="maincontent-item">
                        <div class="maincontent-top">

                            <div class="maiconten-top1">

                                <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-img">
                                    <img src="./admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>">
                                </a>
                                <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Xem ngay</a></button>

                            </div>
                        </div>
                        <div class="maincontent-info">
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-name">
                                <?php echo $row_pro['tensanpham'] ?>
                            </a>
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-gia">
                                <?php if ($row_pro['km'] > 0) {
                                    echo '<div class="khuyenmais" style="background-color: red;border-radius:10px">' . -number_format($row_pro['km']) . '%' . '</div>';
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
                                </span>

                            </a>
                        </div>
                    </div>
                </ul>

            <?php
            }
            ?>

        </div>

    </div>
</div>

<div id="phuonganh">
    <h2 class="phuonganhheader">The Journal</h2>
    <div class="journal">
        <?php
        $sql_baibao = "SELECT * FROM tbl_baibao WHERE tinhtrang=1";
        $query_baibao = mysqli_query($mysqli, $sql_baibao);
        while ($row_baibao = mysqli_fetch_array($query_baibao)) {
        ?>
            <div class="journal-item">
                <img class="cangiua" src="./admincp/modules/quanlybaibao/uploads/<?php echo $row_baibao['hinhanh'] ?>" alt="" height=auto width=97%>
                <div class="journal-body">
                    <p>
                        <?php echo $row_baibao['thoigian'] ?>
                    </p>
                    <h4 class="journal-heading">
                        <?php echo $row_baibao['tenbaibao'] ?>
                    </h4>
                    <p>
                        <?php echo $row_baibao['tomtat'] ?>
                    </p>
                    <a href="./index.php?quanly=baibao&id=<?php echo $row_baibao['id_baibao'] ?>">Xem thêm</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    var productNames = document.querySelectorAll('.maincontent-name');


    productNames.forEach(function(productName) {
        var originalText = productName.textContent.trim();
        if (originalText.length > 30) {
            var truncatedText = originalText.slice(0, 30) + '...';
            productName.textContent = truncatedText;
        }
    });
</script>