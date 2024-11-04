<?php
$sql_sua_chinhanh = "SELECT * FROM tbl_chinhanh WHERE id_chinhanh='$_GET[idchinhanh]' LIMIT 1";
$query_sua_chinhanh = mysqli_query($mysqli, $sql_sua_chinhanh);

?>

<div class="quanlymenu">
    <h3>Sửa chi nhánh</h3>
    <table class='them_menu'>
        <form method="POST" action="./modules/quanlychinhanh/xuly.php?idchinhanh=<?php echo $_GET['idchinhanh'] ?>">
            <?php
            while ($dong = mysqli_fetch_array($query_sua_chinhanh)) {
            ?>

                <tr>
                    <td class="them_menu1">Sửa chi nhánh</td>
                    <td class="them_menu2"><input type="text" value="<?php echo $dong['chinhanh'] ?>" name="chinhanh"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Thứ tự</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
                </tr>
                <tr class="them_menu3">

                    <td colspan='2'><input type="submit" name='suachinhanh' value='sửa chi nhánh'></td>
                </tr>
            <?php
            }
            ?>
        </form>
    </table>
</div>