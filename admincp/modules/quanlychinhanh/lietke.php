<?php
$sql_lietke_chinhanh = "SELECT * FROM tbl_chinhanh ORDER BY thutu ASC";
$query_lietke_chinhanh = mysqli_query($mysqli, $sql_lietke_chinhanh);

?>
<div class="quanlymenu">
    <h3>Liệt kê chi nhánh </h3>

    <table class='lietke_menu'>
        <tr class="header_lietke">
            <td>ID</td>
            <td class="them_menu2" style="width: 300px;">Chi nhánh</td>
            <td class="them_menu4">Quản lý</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_chinhanh)) {
            $i++;

        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['chinhanh'] ?></td>
                <td>

                    <a href="./modules/quanlychinhanh/xuly.php?idchinhanh=<?php echo $row['id_chinhanh'] ?>">Xóa</a> | <a href="index.php?action=quanlychinhanh&query=sua&idchinhanh=<?php echo $row['id_chinhanh'] ?>">Sửa</a>

                </td>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>
</div>