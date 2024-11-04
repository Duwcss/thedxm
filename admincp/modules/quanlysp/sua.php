<?php
$sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);

?>
<div class="quanlymenu">
    <h3>Sửa sản phẩm</h3>
    <form method="POST" action="./modules/quanlysp/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" enctype="multipart/form-data"> <!-- muon gui hinh anh qua post pha them enctype -->

        <table class='them_menu'>



            <?php
            while ($row = mysqli_fetch_array($query_sua_sp)) {
            ?>
                <tr>
                    <td class="them_menu1">Tên Sản Phẩm</td>
                    <td class="them_menu2"><input type="text" value="<?php


                                                                        echo $row['tensanpham'] ?>" name="tensanpham"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Mã sp</td>
                    <td class="them_menu2"><input type="text" value="<?php
                                                                        echo $row['masp'] ?>" name="masp"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Khuyến mãi %</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $row['km'] ?>" name="km"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Giá sp</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $row['giasp'] ?>" name="giasp"></td>
                </tr>
                <tr>
                    <td class="them_menu1">Giá gốc Khuyến mãi</td>
                    <td class="them_menu2"><input type="number" value="<?php echo $row['giagockm'] ?>" name="giagockm"></td>

                </tr>
                <tr>
                    <td class="them_menu1">Kích Thước</td>
                    <td class="them_menu2">
                        <?php
                        $sql_kichthuoc = "SELECT size.id_size, size.ten_size, size_soluong.soluongsize FROM size LEFT JOIN size_soluong ON size.id_size = size_soluong.id_size AND size_soluong.id_sanpham = '" . $_GET['idsanpham'] . "'";
                        $query_kichthuoc = mysqli_query($mysqli, $sql_kichthuoc);

                        // Mảng để theo dõi các kích thước đã được hiển thị
                        $displayedSizes = [];

                        if ($query_kichthuoc) {
                            while ($row_kichthuoc = mysqli_fetch_assoc($query_kichthuoc)) {
                                $idSize = $row_kichthuoc['id_size'];
                                $tenSize = $row_kichthuoc['ten_size'];
                                $soluongsize = $row_kichthuoc['soluongsize'];


                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input kichthuoc-checkbox" type="checkbox" name="kichthuoc[]" value="' . $idSize . '" data-initial-quantity="' . $soluongsize . '"';
                                if ($soluongsize > 0) {
                                    echo ' checked';
                                }
                                echo '>';
                                echo '<label class="form-check-label">' . $tenSize . ' (Số lượng: ' . ($soluongsize ? $soluongsize : 0) . ')</label>';
                                echo '</div>';
                            }
                        } else {
                            die("Không thể lấy dữ liệu từ cơ sở dữ liệu.");
                        }
                        ?>
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
                        var initialQuantities = {};


                        $('.soluong-input').hide();


                        $('.kichthuoc-checkbox').each(function() {
                            var kichthuocId = $(this).val();
                            var kichthuocName = $(this).siblings('label').text();
                            var initialQuantity = parseInt($(this).data('initial-quantity')) || 0;
                            console.log('kichthuocId:', kichthuocId);
                            console.log('kichthuocName:', kichthuocName);

                            initialQuantities[kichthuocId] = initialQuantity;


                            $(this).change(function() {
                                if ($(this).prop('checked')) {
                                    var inputHtml = '<div class="form-group">';
                                    inputHtml += '<label for="soluong-' + kichthuocId + '">Số lượng cho size ' + kichthuocName + ':</label>';
                                    inputHtml += '<input type="number" class="form-control soluong-input" id="soluong-' + kichthuocId + '" name="soluong[' + kichthuocId + ']" value="' + initialQuantities[kichthuocId] + '" required>';
                                    inputHtml += '</div>';
                                    $('#soluong-inputs').append(inputHtml);

                                } else {

                                    $('#soluong-' + kichthuocId).parent().remove();
                                }
                            });


                            if ($(this).prop('checked')) {
                                $(this).trigger('change');
                            }
                        });




                        $(document).on('change', '.kichthuoc-checkbox', function() {
                            var kichthuocId = $(this).val();
                            var isChecked = $(this).prop('checked');
                            var inputField = $('#soluong-' + kichthuocId);

                            if (isChecked) {

                                inputField.val(initialQuantities[kichthuocId]);
                                inputField.closest('.form-group').show();
                            } else {

                                inputField.val(0);
                                inputField.closest('.form-group').hide();
                            }


                            updateTotalQuantity();
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


                        updateTotalQuantity();
                    });
                </script>


                <tr>
                    <td class="them_menu1">Hình ảnh</td>
                    <td class="them_menu2">
                        <input type="file" name="hinhanh">
                        <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width=100px>
                    </td>
                </tr>

                <tr>
                    <td class="them_menu1">Tóm tắt</td>
                    <td class="them_menu2"><textarea rows="5" name="tomtat"><?php echo $row['tomtat'] ?> </textarea></td>
                </tr>

                <tr>
                    <td class="them_menu1">Danh muc san pham</td>
                    <td class="them_menu2">
                        <select name="danhmuc">
                            <?php
                            $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                                if ($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) {
                            ?>
                                    <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="them_menu1">Tình trạng</td>
                    <td class="them_menu1">
                        <select name="tinhtrang">
                            <?php
                            if ($row['tinhtrang'] == 1) {
                            ?>
                                <option value="1" selected>Còn hàng</option>
                                <option value="0">Hết</option>
                            <?php
                            } else {
                            ?>
                                <option value="1">Còn hàng</option>
                                <option value="0" selected>Hết</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr class="them_menu3">

                <td colspan='2'><input type="submit" name='suasanpham' value='Sửa sản phẩm'></td>
            </tr>


        </table>
</div>