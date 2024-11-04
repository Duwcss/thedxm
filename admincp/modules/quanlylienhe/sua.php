<?php
$sql_sua_lienhe = "SELECT * FROM tbl_lienhe WHERE id_lienhe='$_GET[idlienhe]' LIMIT 1";
$query_sua_lienhe = mysqli_query($mysqli, $sql_sua_lienhe);

?>

<div class="quanlymenu">
    <h3>Sửa Liên hệ</h3>
    <table class='them_menu'>
        <form method="POST" action="./modules/quanlylienhe/xuly.php?idlienhe=<?php echo $_GET['idlienhe'] ?>">
            <?php
            while ($dong = mysqli_fetch_array($query_sua_lienhe)) {
            ?>

                <tr>
                    <td class="them_menu1">Sửa liên hệ</td>
                    <td class="them_menu2"><input type="text" value="<?php echo $dong['lienhe'] ?>" name="lienhe"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Thứ tự</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
                </tr>
                <tr class="them_menu3">

                    <td colspan='2'><input type="submit" name='sualienhe' value='sửa liên hệ'></td>
                </tr>
            <?php
            }
            ?>
        </form>
    </table>
</div>