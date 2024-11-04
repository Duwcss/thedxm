<div class="quanlymenu">
    <h3>Thêm chính sách</h3>

    <table class='qlchinhsach'>
        <form method="POST" action="./modules/qlchinhsach/xuly.php" enctype="multipart/form-data">
            <tr>
                <td class="qlchinhsach1">Tên chính sách</td>
                <td><input type="text" name="tenchinhsach" class="qlchinhsach2"></td>
            </tr>

            <tr>
                <td class="qlchinhsach1">Nội dung</td>
                <td><textarea rows="5" name="noidung" class="qlchinhsach2"></textarea></td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Danh muc chính sách</td>
                <td>
                    <select name="id_tenchinhsach" class="qlchinhsach2">
                        <?php
                        $sql_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY id_tenchinhsach DESC";
                        $query_tenchinhsach = mysqli_query($mysqli, $sql_tenchinhsach);
                        while ($row_tenchinhsach = mysqli_fetch_array($query_tenchinhsach)) {
                        ?>
                            <option value="<?php echo $row_tenchinhsach['id_tenchinhsach'] ?>"><?php echo $row_tenchinhsach['tenchinhsach'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Tình trạng</td>
                <td>
                    <select name="tinhtrang" class="qlchinhsach2">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Ẩn</option>
                    </select>
                </td>
            </tr>
            <tr class="qlchinhsach3">
                <td colspan='2'><input type="submit" name='themchinhsach' value='Thêm chính sách'></td>
            </tr>
        </form>
    </table>

</div>