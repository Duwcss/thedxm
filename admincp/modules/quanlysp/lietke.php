<?php
$sql_lietke_sp = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);

?>
<div class="quanlymenu">
    <h3>Thống kê sản phẩm </h3>

    <table class='lietkesp'>
        <tr class="header_lietke">
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá sp</th>
            <th>Khuyến Mãi %</th>
            <th>Giá gốc</th>
            <th>Số lượng</th>
            <th>Danh muc</th>
            <th>Mã Sp</th>
            <th>Tóm tắt</th>
            <th>Tình trạng</th>

            <th class="them_menu4">Quản lý</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
            $i++;
        ?>

            <tr>
                <th><?php echo $i ?></th>
                <th><?php echo $row['tensanpham'] ?></th>
                <th><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width=100px></th>
                <th><?php echo $row['giasp'] ?></th>
                <th><?php echo $row['km'] ?></th>
                <th><?php echo $row['giagockm'] ?></th>
                <th><?php echo $row['soluong'] ?></th>
                <th><?php echo $row['tendanhmuc'] ?></th>
                <th><?php echo $row['masp'] ?></th>
                <th><?php echo $row['tomtat'] ?></th>
                <th><?php if ($row['tinhtrang'] == 1) {
                        echo 'Còn hàng';
                    } else {
                        echo 'Hết';
                    }

                    ?>
                </th>

                <th>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id_sanpham']; ?>)"><i class="bi bi-trash-fill"></i></a>
                    | <a href="index.php?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>"><i class="bi bi-pencil-square"></i></a>
                </th>
            </tr>
        <?php
        }
        ?>
        </form>
    </table>

</div>
<script>
    function confirmDelete(idSanPham) {
        var confirmDelete = confirm("Bạn có chắc muốn xóa sản phẩm này?");
        if (confirmDelete) {

            window.location.href = 'modules/quanlysp/xuly.php?idsanpham=' + idSanPham;
        } else {

        }
    }
</script>