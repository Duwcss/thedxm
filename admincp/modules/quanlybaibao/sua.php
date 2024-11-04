<?php
    $sql_sua_baibao = "SELECT * FROM tbl_baibao WHERE id_baibao='$_GET[idbaibao]' LIMIT 1";
    $query_sua_baibao = mysqli_query($mysqli,$sql_sua_baibao);

?>
<div class="quanlymenu">
            <h3>Sửa bài báo</h3>
<table class='qlchinhsach'>
<?php
    while($row = mysqli_fetch_array($query_sua_baibao)){
?>  
<form method="POST" action="./modules/quanlybaibao/xuly.php?idbaibao=<?php echo $_GET['idbaibao']?>" enctype="multipart/form-data"> <!-- muon gui hinh anh qua post pha them enctype -->  
        <tr>
            <td class="qlchinhsach1">Tên bài báo</td>
            <td ><input type="text" name="tenbaibao" class="qlchinhsach2" value="<?php echo $row['tenbaibao'] ?>"></td>
        </tr>
        <tr>
            <td class="qlchinhsach1">Hình ảnh</td>
            <td class="qlchinhsach2">
                <input type="file"  name="hinhanh">
                <img src="modules/quanlybaibao/uploads/<?php echo $row['hinhanh']?>" width=100px >
            </td>
        </tr>
        <tr>
            <td class="qlchinhsach1">Thời gian</td>
            <td ><input type="text" name="thoigian" class="qlchinhsach2" value="<?php echo $row['thoigian'] ?>"></td>
        </tr>
        <tr>
            <td  class="qlchinhsach1">Tóm tắt</td>
            <td  ><textarea rows="5" name="tomtat" class="qlchinhsach2"><?php echo $row['tomtat'] ?></textarea></td>
        </tr>
        <tr>
            <td  class="qlchinhsach1">Nội dung</td>
            <td  ><textarea rows="5" name="noidung" class="qlchinhsach2"><?php echo $row['noidung'] ?></textarea></td>
        </tr>
        <tr>
            <td class="qlchinhsach1">Thứ tự</td>
            <td ><input type="text" name="thutu" class="qlchinhsach2" value="<?php echo $row['thutu'] ?>"></td>
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
        <tr>
            <td class="qlchinhsach1">Tác giả</td>
            <td ><input type="text" name="tacgia" class="qlchinhsach2" value="<?php echo $row['tacgia'] ?>"></td>
        </tr>
        <tr  class="qlchinhsach3">
            
            <td colspan ='2'><input type="submit" name='suabaibao' value='Sửa bài báo'></td>
        </tr>
    </form>
<?php
    }
?>
</table></div>