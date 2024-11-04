<div class="quanlymenu">
    <a href="index.php?action=quanlysp&query=them"><-- Quay lại trang</a>

            <h3>Thêm kích thước</h3>
            <table class='them_menu'>
                <form method="POST" action="./modules/quanlysp/xuly.php">
                    <tr>
                        <td class="them_menu1">Thêm kích thước</td>
                        <td class="them_menu2"><input type="text" name="tenkichthuoc" value=""></td>
                    </tr>
                    <tr>
                        <td class="them_menu1">Thứ tự</td>
                        <td class="them_menu2"><input type="number" name="thutu" value="Thứ Tự"></td>
                    </tr>
                    <tr class="them_menu3">

                        <td colspan='2'><input type="submit" name='themkichthuoc' value='Thêm danh mục menu'></td>
                    </tr>
                </form>
            </table>
</div>
<?php
$sql_lietke_size = "SELECT * FROM size ORDER BY thutu ASC";
$query_lietke_size = mysqli_query($mysqli, $sql_lietke_size);

?>
<div class="quanlymenu">
    <h3>Liệt kê danh mục sản phẩm </h3>

    <table class='lietke_menu'>
        <tr class="header_lietke">
            <td>ID</td>
            <td class="them_menu2">Tên Size</td>
            <td class="them_menu4">Quản lý</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_size)) {
            $i++;

        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['ten_size'] ?></td>
                <td>

                    <a href="./modules/quanlysp/xuly.php?idsize=<?php echo $row['id_size'] ?>">Xóa</a> |

                </td>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>
</div>