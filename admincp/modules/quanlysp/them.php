<div class="quanlymenu">
    <h3>Thêm Sản Phẩm</h3>

    <form method="POST" action="./modules/quanlysp/xuly.php" enctype="multipart/form-data">
        <table class='them_menu'>
            <tr>
                <td class="them_menu1">Tên Sản Phẩm</td>
                <td class="them_menu2"><input type="text" name="tensanpham" required></td>
            </tr>
            <tr>
                <td class="them_menu1">Mã sp</td>
                <td class="them_menu2"><input type="text" name="masp" required></td>
            </tr>
            <tr>
                <td class="them_menu1">Khuyến mãi %</td>
                <td class="them_menu2"><input type="number" name="km" required></td>
            </tr>
            <tr>
                <td class="them_menu1">Giá sp</td>
                <td class="them_menu2"><input type="number" name="giasp" required></td>
            </tr>
            <tr>
                <td class="them_menu1">Giá gốc Khuyến mãi</td>
                <td class="them_menu2"><input type="number" name="giagockm" required></td>
            </tr>

            <tr>
                <td class="them_menu1">Kích Thước</td>
                <td class="them_menu2">
                    <?php
                    $sql_kichthuoc = "SELECT * FROM size";
                    $query_kichthuoc = mysqli_query($mysqli, $sql_kichthuoc);
                    if ($query_kichthuoc) {
                        while ($row_kichthuoc = mysqli_fetch_assoc($query_kichthuoc)) {
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input kichthuoc-checkbox" type="checkbox" name="kichthuoc[]" value="' . $row_kichthuoc['id_size'] . '">';
                            echo '<label class="form-check-label">' . $row_kichthuoc['ten_size'] . '</label>';
                            echo '</div>';
                        }
                    } else {
                        die("Không thể lấy dữ liệu từ cơ sở dữ liệu.");
                    }
                    ?>
                    <a href="index.php?action=quanlysp&query=kichthuoc">Thêm </a>

                </td>

            </tr>

            <tr class="soluong-inputs">
                <td class="them_menu1">Số Lượng (theo kích thước)</td>
                <td class="them_menu2" id="soluong-inputs">

                </td>
            </tr>

            <tr>
                <td class="them_menu1">Tổng số lượng</td>
                <td class="them_menu2">
                    <input type="number" id="tong-soluong" name="tongsoluong" value="0" readonly>
                </td>
            </tr>


            <script>
                $(document).ready(function() {
                    $('.kichthuoc-checkbox').change(function() {
                        $('#soluong-inputs').empty();

                        $('.kichthuoc-checkbox:checked').each(function() {
                            var kichthuocId = $(this).val();
                            var kichthuocName = $(this).siblings('label').text();
                            var inputHtml = '<label>' + kichthuocName + '</label><input type="number" class="soluong-input" name="soluong[]" required>';
                            $('#soluong-inputs').append(inputHtml);
                        });
                    });


                    $(document).on('input', '.soluong-input', function() {
                        updateTotalQuantity();
                    });

                    function updateTotalQuantity() {
                        var totalQuantity = 0;

                        $('.soluong-input').each(function() {
                            var soluong = parseInt($(this).val()) || 0;
                            totalQuantity += soluong;
                        });

                        $('#tong-soluong').val(totalQuantity);
                    }
                });
            </script>

            <tr>
                <td class="them_menu1">Hình ảnh</td>
                <td class="them_menu2"><input type="file" name="hinhanh" required></td>
            </tr>
            <tr>
                <td class="them_menu1">Tóm tắt</td>
                <td class="them_menu2"><textarea rows="5" name="tomtat" required></textarea></td>
            </tr>
            <tr>
                <td class="them_menu1">Danh mục sản phẩm</td>
                <td class="them_menu2">
                    <select name="danhmuc" required>
                        <?php
                        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>
                            <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="them_menu1">Tình trạng</td>
                <td class="them_menu2">
                    <select name="tinhtrang" required>
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>
                </td>
            </tr>
            <tr class="them_menu3">
                <td colspan="2"><input type="submit" name='themsanpham' value='Thêm sản phẩm'></td>
            </tr>
        </table>