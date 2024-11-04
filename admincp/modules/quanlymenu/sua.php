<?php
$sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
$query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);

?>

<div class="quanlymenu">
    <h3>Sửa menu</h3>
    <table class='them_menu'>
        <form method="POST" action="./modules/quanlymenu/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>">
            <?php
            while ($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
            ?>

                <tr>
                    <td class="them_menu1">Sửa tên MENU</td>
                    <td class="them_menu2"><input type="text" value="<?php echo $dong['tendanhmuc'] ?>" name="tendanhmuc"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Thứ tự</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
                </tr>
                <tr class="them_menu3">

                    <td colspan='2'><input type="submit" name='suadanhmuc' value='Sửa danh mục menu'></td>
                </tr>
            <?php
            }
            ?>
        </form>
    </table>
</div>