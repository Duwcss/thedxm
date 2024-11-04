<?php
$sql_lietke_anhtrangbia = "SELECT * FROM tbl_anhtrangbia ORDER BY thutu ASC";
$query_lietke_anhtrangbia = mysqli_query($mysqli, $sql_lietke_anhtrangbia);

?>
<div class="quanlymenu">
    <h3>Liệt kê ảnh trang bìa </h3>

    <table class='lietke_menu' style="    margin-left: 25%;">
        <tr class="header_lietke">
            <td>ID</td>
            <td class="them_menu2" style="width: 300px;">Hình ảnh</td>
            <td>Tình trạng</td>
            <td class="them_menu4">Quản lý</td>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_anhtrangbia)) {
            $i++;

        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><img src="modules/anhtrangbia/uploads/<?php echo $row['hinhanh'] ?>" width=100px></td>
                <td><?php if ($row['tinhtrang'] == 1) {
                        echo 'Kích hoạt';
                    } else {
                        echo 'Ẩn';
                    }

                    ?>
                </td>
                <td>

                    <a href="./modules/anhtrangbia/xuly.php?idanhtrangbia=<?php echo $row['id_anhtrangbia'] ?>">Xóa</a> | <a href="index.php?action=anhtrangbia&query=sua&idanhtrangbia=<?php echo $row['id_anhtrangbia'] ?>">Sửa</a>

                </td>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>
</div>