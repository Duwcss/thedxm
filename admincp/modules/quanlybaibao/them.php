<div class="quanlymenu">
    <h3>Thêm bài báo</h3>
    <table class='qlchinhsach'>
        <form method="POST" action="./modules/quanlybaibao/xuly.php" enctype="multipart/form-data" >
            <tr>
                <td class="qlchinhsach1">Tên bài báo</td>
                <td> <textarea rows="5" name="tenbaibao" class="qlchinhsach2"></textarea></td>
            </tr>
            <tr>
                <td  class="qlchinhsach1">Hình ảnh</td>
                <td class="qlchinhsach2"><input type="file" name="hinhanh"></td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Thời gian</td>
                <td ><input type="text" name="thoigian" value="Thời gian" class="qlchinhsach2"></td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Tóm tắt</td>
                <td> <textarea rows="5" name="tomtat" class="qlchinhsach2"></textarea></td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Nội dung</td>
                <td> <textarea rows="5" name="noidung" class="qlchinhsach2"></textarea></td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Thứ tự</td>
                <td ><input type="text" name="thutu"  class="qlchinhsach2"></td>
            </tr>
            <tr>
                <td  class="qlchinhsach1">Tình trạng</td>
                <td class="qlchinhsach2">
                    <select name="tinhtrang">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Ẩn</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="qlchinhsach1">Tác giả</td>
                <td> <textarea rows="5" name="tacgia" class="qlchinhsach2"></textarea></td>
            </tr>
            <tr class="qlchinhsach3">
                
                <td colspan ='2' ><input type="submit" name='thembaibao' value='Thêm bài báo'></td>
            </tr>
        </form>
    </table>
</div>