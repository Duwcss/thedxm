<?php
    $sql_sua_anhtrangbia = "SELECT * FROM tbl_anhtrangbia WHERE id_anhtrangbia='$_GET[idanhtrangbia]' LIMIT 1";
    $query_sua_anhtrangbia = mysqli_query($mysqli,$sql_sua_anhtrangbia);

?>
<div class="quanlymenu">
            <h3>Sửa ảnh trang bìa</h3>
<table class='them_menu'>
<?php
    while($row = mysqli_fetch_array($query_sua_anhtrangbia)){
?>  
<form method="POST" action="./modules/anhtrangbia/xuly.php?idanhtrangbia=<?php echo $_GET['idanhtrangbia']?>" enctype="multipart/form-data"> <!-- muon gui hinh anh qua post pha them enctype -->
        
        <tr>
            <td class="them_menu1">Hình ảnh</td>
            <td class="them_menu2">
                <input type="file"  name="hinhanh">
                <img src="modules/anhtrangbia/uploads/<?php echo $row['hinhanh']?>" width=100px >
            </td>
        </tr>

        <tr>
            <td class="them_menu1">thứ tự</td>
            <td class="them_menu2"><textarea rows="5" name="thutu"><?php echo $row['thutu'] ?> </textarea></td>
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
        
        <tr class="them_menu3">
            
            <td colspan ='2'><input type="submit" name='suaanhtrangbia' value='Sửa ảnh trang bìa'></td>
        </tr>
    </form>
<?php
    }
?>
</table></div>