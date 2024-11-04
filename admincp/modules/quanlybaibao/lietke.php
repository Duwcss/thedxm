<?php
$sql_lietke_baibao = "SELECT * FROM tbl_baibao ORDER BY thutu ASC";
$query_lietke_baibao = mysqli_query($mysqli, $sql_lietke_baibao);
?>
<div class="quanlymenu">
    <h3>Liệt kê bài báo </h3>

    <table class='lietkesp'>
        <tr class="header_lietke">
            <th>ID</th>
            <th>Tên bài báo</th>
            <th>Hình ảnh</th>
            <th>Thời gian</th>
            <th>Tóm tắt</th>
            <th>Tình trạng</th>
            <th>Tác giả</th>
            <th class="them_menu4">Quản lý</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_baibao)) {
            $i++;
        ?>

            <tr>
                <th><?php echo $i ?></th>
                <th><?php echo $row['tenbaibao'] ?></th>
                <th><img src="modules/quanlybaibao/uploads/<?php echo $row['hinhanh'] ?>" width=100px></th>
                <th><?php echo $row['thoigian'] ?></th>
                <th class="noidungchinhsach"><?php echo $row['tomtat'] ?></th>

                <th><?php if ($row['tinhtrang'] == 1) {
                        echo 'Kích hoạt';
                    } else {
                        echo 'Ẩn';
                    }

                    ?>
                </th>
                <th><?php echo $row['tacgia'] ?></th>
                <th>
                    <a href="modules/quanlybaibao/xuly.php?idbaibao=<?php echo $row['id_baibao'] ?>"><i class="bi bi-trash-fill"></i></a> | <a href="index.php?action=quanlybaibao&query=sua&idbaibao=<?php echo $row['id_baibao'] ?>">Sửa</a>
                </th>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>

</div>