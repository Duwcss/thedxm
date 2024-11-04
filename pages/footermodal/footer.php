<div class="line">
    <footer class="main-footer">
        <div class="line">

            <div class="one">

                <div class="one-1">
                    <h4>HỆ THỐNG CỬA HÀNG THE DxM </h4><br>
                    <div class="one12">
                        <?php
                        $sql_chinhanh = "SELECT * FROM tbl_chinhanh ORDER BY id_chinhanh ASC";
                        $query_chinhanh = mysqli_query($mysqli, $sql_chinhanh);
                        while ($row_chinhanh = mysqli_fetch_array($query_chinhanh)) {
                        ?>
                            <p>
                                <?php echo $row_chinhanh['chinhanh'] ?> <br>

                            </p>
                        <?php } ?>
                    </div>
                </div>
                <?php
                $sql_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY id_tenchinhsach ASC";
                $query_tenchinhsach = mysqli_query($mysqli, $sql_tenchinhsach);

                ?>
                <div class="one-1">
                    <H4>CHÍNH SÁCH</H4><br><br>
                    <div class="one12">
                        <ul class="one13">
                            <?php
                            while ($row_tenchinhsach = mysqli_fetch_array($query_tenchinhsach)) {
                            ?>
                                <li><a href="./index.php?quanly=chinhsach&id=<?php echo $row_tenchinhsach['id_tenchinhsach'] ?>"><?php echo $row_tenchinhsach['tenchinhsach'] ?></a></li><br>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="one-1">
                    <H4>THÔNG TIN LIÊN HỆ </H4><br><br>
                    <div>
                        <?php
                        $sql_lienhe = "SELECT * FROM tbl_lienhe ORDER BY id_lienhe ASC";
                        $query_lienhe = mysqli_query($mysqli, $sql_lienhe);
                        while ($row_lienhe = mysqli_fetch_array($query_lienhe)) {
                        ?>
                            <ul class="one12">
                                <li><?php echo $row_lienhe['lienhe'] ?></li>

                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="one-1">
                    <div class="one-footer">
                        <H4>FOLLOW US ON SOCIAL MEDIA</H4><br><br>
                        <a href="https://www.facebook.com">
                            <img src="https://cdn.icon-icons.com/icons2/2108/PNG/512/facebook_icon_130940.png" alt="Facebook">
                        </a>
                        <div>
                        <a href="https://www.instagram.com/accounts/login/">
                            <img src="https://cdn.icon-icons.com/icons2/1211/PNG/512/1491579583-yumminkysocialmedia02_83111.png " alt="Instagram">
                        </a>
                        </div>
                        <div>
                        <a href="https://www.instagram.com/accounts/login/">
                            <img src="https://cdn.icon-icons.com/icons2/1753/PNG/512/iconfinder-social-media-applications-3instagram-4102579_113804.png" alt="Twitter">
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</footer>
