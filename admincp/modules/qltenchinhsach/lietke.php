<?php
$sql_lietke_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY thutu ASC";
$query_lietke_tenchinhsach = mysqli_query($mysqli, $sql_lietke_tenchinhsach);

?>
<div class="quanlymenu">
    <h3>Liệt kê tên chính sách </h3>

    <table class='lietke_menu'>
        <tr class="header_lietke">
            <td>ID</td>
            <td class="them_menu2" style="width: 300px;">Tên chính sách</td>
            <td class="them_menu4">Quản lý</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_tenchinhsach)) {
            $i++;

        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tenchinhsach'] ?></td>
                <td>

                    <a href="./modules/qltenchinhsach/xuly.php?idtenchinhsach=<?php echo $row['id_tenchinhsach'] ?>"><i class="bi bi-trash-fill"></i></a> | <a href="index.php?action=quanlytenchinhsach&query=sua&idtenchinhsach=<?php echo $row['id_tenchinhsach'] ?>">Sửa</a>

                </td>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>
</div>