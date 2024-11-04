                    <?php
                    $sql_pro = "SELECT * FROM tbl_baibao WHERE tbl_baibao.id_baibao = '$_GET[id]' AND tinhtrang=1 ORDER BY id_baibao LIMIT 1"; //lấy tất cả sản phẩm dựa vào id 
                    $query_pro = mysqli_query($mysqli, $sql_pro);
                    ?>

                    <?php
                    while ($row_baibao = mysqli_fetch_array($query_pro)) {
                    ?>
                        <div class="blog">
                            <a href="./index.php" class="blog_header">
                                <div class="blog_header--icon ti-angle-left"></div>
                                <div>BACK</div>
                            </a>
                            <h1 class="blog_main"><?php echo $row_baibao['tenbaibao'] ?></h1>
                            <img class="img_center" src="./admincp/modules/quanlybaibao/uploads/<?php echo $row_baibao['hinhanh'] ?>" alt="blog1" width="900px" height="auto">
                            <p class="text_center"><?php echo $row_baibao['thoigian'] ?></p>
                            <p><?php echo $row_baibao['noidung'] ?></p>
                        </div>
                    <?php } ?>