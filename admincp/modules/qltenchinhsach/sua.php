<?php
$sql_sua_tenchinhsach = "SELECT * FROM tbl_tenchinhsach WHERE id_tenchinhsach='$_GET[idtenchinhsach]' LIMIT 1";
$query_sua_tenchinhsach = mysqli_query($mysqli, $sql_sua_tenchinhsach);

?>

<div class="quanlymenu">
    <h3>Sửa tên chính sách</h3>
    <table class='them_menu'>
        <form method="POST" action="./modules/qltenchinhsach/xuly.php?idtenchinhsach=<?php echo $_GET['idtenchinhsach'] ?>">
            <?php
            while ($dong = mysqli_fetch_array($query_sua_tenchinhsach)) {
            ?>

                <tr>
                    <td class="them_menu1">Sửa tên chính sách</td>
                    <td class="them_menu2"><input type="text" value="<?php echo $dong['tenchinhsach'] ?>" name="tenchinhsach"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Thứ tự</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
                </tr>
                <tr class="them_menu3">

                    <td colspan='2'><input type="submit" name='suatenchinhsach' value='sua tên chính sách'></td>
                </tr>
            <?php
            }
            ?>
        </form>
    </table>
</div>