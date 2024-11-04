                   <?php
                    $sql_pro = "SELECT * FROM tbl_chinhsach WHERE tbl_chinhsach.id_tenchinhsach = '$_GET[id]' ORDER BY id_chinhsach DESC LIMIT 1"; //lấy tất cả sản phẩm dựa vào id 
                    $query_pro = mysqli_query($mysqli, $sql_pro);
                    ?>
                   <div class="blog blog_chinhsach">
                       <?php
                        while ($row_pro = mysqli_fetch_array($query_pro)) {
                        ?>
                           <h2><?php echo $row_pro['tenchinhsach'] ?></h2>

                           <p class="blog_chinhsach">
                               <?php echo $row_pro['noidung'] ?>
                           </p>
                       <?php
                        }
                        ?>
                   </div>