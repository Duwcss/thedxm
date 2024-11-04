<?php
    $sql_sua_cs = "SELECT * FROM tbl_chinhsach WHERE id_chinhsach='$_GET[idchinhsach]' LIMIT 1";
    $query_sua_cs = mysqli_query($mysqli,$sql_sua_cs);

?>
<div class="quanlymenu">
            <h3>Sửa chính sách</h3>
<table class='qlchinhsach'>
<?php
    while($row = mysqli_fetch_array($query_sua_cs)){
?>  
<form method="POST" action="./modules/qlchinhsach/xuly.php?idchinhsach=<?php echo $_GET['idchinhsach']?>" enctype="multipart/form-data"> <!-- muon gui hinh anh qua post pha them enctype -->  
        <tr>
            <td class="qlchinhsach1">Tên chính sách</td>
            <td ><input type="text" name="tenchinhsach" class="qlchinhsach2" value="<?php echo $row['tenchinhsach'] ?>"></td>
        </tr>
        
        <tr>
            <td  class="qlchinhsach1">Nội dung</td>
            <td  ><textarea rows="5" name="noidung" class="qlchinhsach2"><?php echo $row['noidung'] ?></textarea></td>
        </tr>
        <tr>
            <td class="qlchinhsach1">Danh muc san pham</td>
            <td >
                <select name="id_tenchinhsach" class="qlchinhsach2">
                    <?php
                        $sql_danhmuc = "SELECT * FROM tbl_tenchinhsach ORDER BY id_tenchinhsach DESC";
                        $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
                        while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                            if ($row_danhmuc['id_tenchinhsach']==$row['id_tenchinhsach']){
                    ?>
                    <option selected value="<?php echo $row_danhmuc['id_tenchinhsach'] ?>"><?php echo $row_danhmuc['tenchinhsach'] ?></option>
                    <?php
                        }else{
                    ?>
                    <option  value="<?php echo $row_danhmuc['id_tenchinhsach'] ?>"><?php echo $row_danhmuc['tenchinhsach'] ?></option>

                    <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="them_menu1">Tình trạng</td>
            <td class="them_menu1">
                <select name="tinhtrang">
                    <?php
                        if($row['tinhtrang']==1){
                    ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                        }else{
                    ?>
                    <option value="1" >Kích hoạt</option>
                    <option value="0" selected>Ẩn</option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr  class="qlchinhsach3">
            
            <td colspan ='2'><input type="submit" name='suachinhsach' value='Sửa chính sách'></td>
        </tr>
    </form>
<?php
    }
?>
</table></div>