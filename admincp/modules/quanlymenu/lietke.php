<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

?>
<div class="quanlymenu">
    <h3>Liệt kê danh mục sản phẩm </h3>

    <table class='lietke_menu'>
        <tr class="header_lietke">
            <td>ID</td>
            <td class="them_menu2">Tên Menu</td>
            <td class="them_menu4">Quản lý</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tendanhmuc'] ?></td>
                <td>

                    <a href="./modules/quanlymenu/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>"><i class="bi bi-trash-fill"></i></a> | <a href="index.php?action=quanlymenu&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Sửa</a>

                </td>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>
</div>


