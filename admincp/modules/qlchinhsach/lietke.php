<?php
    $sql_lietke_cs = "SELECT * FROM tbl_chinhsach,tbl_tenchinhsach WHERE tbl_chinhsach.id_tenchinhsach=tbl_tenchinhsach.id_tenchinhsach ORDER BY id_chinhsach ASC";
    $query_lietke_cs = mysqli_query($mysqli,$sql_lietke_cs);

?>
<div class="quanlymenu">
            <h3>Liệt kê chính sách </h3>

            <table class='lietkesp' >
                    <tr class="header_lietke">
                        <th>ID</th>
                      
                        <th>Danh muc</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        
                        <th class="them_menu4">Quản lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row = mysqli_fetch_array($query_lietke_cs)){
                            $i++;
                    ?>
                    
                    <tr>
                        <th><?php echo $i ?></th>
                        
                        <th><?php echo $row['tenchinhsach'] ?></th>
                        <th class="noidungchinhsach" ><?php echo $row['noidung'] ?></th>
                        <th><?php  if($row['tinhtrang']==1){
                                    echo 'Kích hoạt';
                                    }else{
                                        echo 'Ẩn';
                                    }
            
                            ?>
                        </th>
                        
                        <th>
                            <a href="modules/qlchinhsach/xuly.php?idchinhsach=<?php echo $row['id_chinhsach']?>">Xóa</a>  |  <a href="index.php?action=quanlychinhsach&query=sua&idchinhsach=<?php echo $row['id_chinhsach']?>">Sửa</a> 
                        </th>
                    </tr>
                    <?php
                        }
                    ?>
                </form>
            </table>

        </div>