<div class="quanlymenu">
            <h3>Ảnh trang  bìa</h3>
            <table class='them_menu'>
                <form method="POST" action="./modules/anhtrangbia/xuly.php" enctype="multipart/form-data" >
                    <tr>
                        <td  class="them_menu1">Hình ảnh</td>
                        <td class="them_menu2"><input type="file" name="hinhanh"></td>
                    </tr>
                    <tr>
                        <td class="them_menu1">Thứ tự</td>
                        <td class="them_menu2"><input type="number" name="thutu" value="Thứ Tự"></td>
                    </tr>
                    <tr>
                        <td  class="them_menu1">Tình trạng</td>
                        <td class="them_menu2">
                            <select name="tinhtrang">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="them_menu3">
                        
                        <td colspan ='2' ><input type="submit" name='themanhtrangbia' value='Thêm ảnh trang bìa'></td>
                    </tr>
                </form>
            </table>
</div>