<?php

if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];
    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']);
    $id_role = $_POST['role_id'];


    $provinceId = isset($_POST['province']) ? intval($_POST['province']) : null;
    $districtId = isset($_POST['district']) ? intval($_POST['district']) : null;
    $wardId = isset($_POST['ward']) ? intval($_POST['ward']) : null;


    $provinceResult = mysqli_query($mysqli, "SELECT name FROM province WHERE province_id = $provinceId");
    $districtResult = mysqli_query($mysqli, "SELECT name FROM district WHERE district_id =  $districtId");
    $wardResult = mysqli_query($mysqli, "SELECT name FROM wards WHERE wards_id = $wardId");

    $provinceName = ($provinceRow = mysqli_fetch_assoc($provinceResult)) ? $provinceRow['name'] : null;
    $districtName = ($districtRow = mysqli_fetch_assoc($districtResult)) ? $districtRow['name'] : null;
    $wardName = ($wardRow = mysqli_fetch_assoc($wardResult)) ? $wardRow['name'] : null;

    if (!$provinceName || !$districtName || !$wardName) {
        echo 'Dữ liệu tỉnh, huyện, xã không hợp lệ.';
        exit;
    }


    $fullAddress = "$wardName, $districtName, $provinceName";

    $sql_dangky = mysqli_query(
        $mysqli,
        "INSERT INTO tbl_khackhang(tenkhachhang, diachi, dienthoai, email, matkhau, role_id) 
        VALUES ('$tenkhachhang','$fullAddress','$dienthoai','$email','$matkhau',4)"
    );

    if ($sql_dangky) {
        echo '<h3>Bạn đã đăng ký thành công</h3>';
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
        header('Location:index.php?quanly=giohang');
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $id_khachhang = $_SESSION['id_khachhang'];


            foreach ($_SESSION['cart'] as $cart_item) {
                $cart_id = $cart_item['id'];
                $cart_size = $cart_item['size'];
                $cart_quantity = $cart_item['soluong'];


                $sql_check_giohang = "SELECT * FROM tbl_giohang WHERE id_khachhang = '$id_khachhang' AND id_sanpham = '$cart_id' AND size = '$cart_size'";
                $query_check_giohang = mysqli_query($mysqli, $sql_check_giohang);
                $num_rows = mysqli_num_rows($query_check_giohang);

                if ($num_rows > 0) {

                    $sql_update_giohang = "UPDATE tbl_giohang SET soluong = soluong + $cart_quantity WHERE id_khachhang = '$id_khachhang' AND id_sanpham = '$cart_id' AND size = '$cart_size'";
                    mysqli_query($mysqli, $sql_update_giohang);
                } else {

                    $sql_insert_giohang = "INSERT INTO tbl_giohang (id_khachhang, id_sanpham, soluong, size) VALUES ('$id_khachhang', '$cart_id', '$cart_quantity', '$cart_size')";
                    mysqli_query($mysqli, $sql_insert_giohang);
                }
            }
            unset($_SESSION['cart']);
        }
    } else {
        echo 'Có lỗi xảy ra: ' . mysqli_error($mysqli);
    }
}

?>

<form action="#" method="POST">
    <div class="login-form" style="padding: 50px 40px 40px 40px;">
        <div class="login-container">

            <h2> Đăng kí </h2>
            <input type="text" placeholder="Họ tên" name="hoten"><br>

            <input type="text" placeholder="Số điện thoại" name="dienthoai"><br>
            <input type="text" placeholder="Email" name="email"><br>
            <input type="text" placeholder="Địa chỉ nhận hàng" name="diachi"><br>

            <div class="select-container">
                <select name="province" id="province">
                    <option value="" selected disabled>Chọn tỉnh/thành phố</option>

                </select>

                <select name="district" id="district" disabled>
                    <option value="" selected disabled>Chọn quận/huyện</option>
                </select>

                <select name="ward" id="ward" disabled>
                    <option value="" selected disabled>Chọn xã/phường</option>
                </select>
            </div>
            <input type="password" placeholder="Mật Khẩu" name="matkhau"><br>
            <input type="password" placeholder="Nhập lại mật khẩu" name="nhaplaimatkhau"><br>



            <div id="password-error" style="color: red;"></div>

            <button type="submit" name="dangky">Đăng kí</button>

            <div class="links">
                <a href="./index.php?quanly=dangnhap">
                    <p>← Quay lại đăng nhập</p>
                </a>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var provinceSelect = document.getElementById('province');
        var districtSelect = document.getElementById('district');
        var wardSelect = document.getElementById('ward');
        var diachiInput = document.getElementsByName('diachi')[0];


        var xhrProvince = new XMLHttpRequest();
        xhrProvince.onreadystatechange = function() {
            if (xhrProvince.readyState === XMLHttpRequest.DONE) {
                if (xhrProvince.status === 200) {
                    var provinces = JSON.parse(xhrProvince.responseText);
                    updateSelect(provinceSelect, provinces);
                    provinceSelect.disabled = false;
                } else {
                    console.error('Lỗi khi lấy danh sách tỉnh');
                }
            }
        };

        xhrProvince.open('GET', './pages/main/get_locations.php', true);
        xhrProvince.send();

        provinceSelect.addEventListener('change', function(event) {
            var provinceId = event.target.value;
            console.log('Selected Province ID:', provinceId);

            if (!provinceId) {
                districtSelect.innerHTML = '<option value="" selected disabled>Chọn quận/huyện</option>';
                wardSelect.innerHTML = '<option value="" selected disabled>Chọn xã/phường</option>';
                districtSelect.disabled = true;
                wardSelect.disabled = true;
                return;
            }


            var xhrDistrict = new XMLHttpRequest();
            xhrDistrict.onreadystatechange = function() {
                if (xhrDistrict.readyState === XMLHttpRequest.DONE) {
                    if (xhrDistrict.status === 200) {
                        var districts = JSON.parse(xhrDistrict.responseText);
                        updateSelect(districtSelect, districts);
                        districtSelect.disabled = false;

                        updateDiachiInput();
                    } else {
                        console.error('Lỗi khi lấy danh sách quận/huyện:', xhrDistrict.status, xhrDistrict.statusText);
                    }
                }
            };

            xhrDistrict.open('GET', './pages/main/get_locations.php?province_id=' + provinceId, true);
            xhrDistrict.send();
        });


        districtSelect.addEventListener('change', function() {
            var districtId = this.value;

            if (!districtId) {
                wardSelect.innerHTML = '<option value="" selected disabled>Chọn xã/phường</option>';
                wardSelect.disabled = true;
                return;
            }


            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var wards = JSON.parse(xhr.responseText);
                        updateSelect(wardSelect, wards);
                        wardSelect.disabled = false;

                        updateDiachiInput();
                    } else {
                        console.error('Lỗi khi lấy danh sách xã/phường');
                    }
                }
            };

            xhr.open('GET', 'pages/main/get_locations.php?district_id=' + districtId, true);
            xhr.send();
        });


        wardSelect.addEventListener('change', function() {
            updateDiachiInput();
        });


        function updateSelect(selectElement, options) {
            selectElement.innerHTML = '<option value="" selected disabled>Chọn</option>';

            if (Array.isArray(options)) {
                options.forEach(function(option) {
                    var optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.name;
                    selectElement.appendChild(optionElement);
                });
            } else if (options instanceof Object) {

                var optionElement = document.createElement('option');
                optionElement.value = options.id;
                optionElement.textContent = options.name;
                selectElement.appendChild(optionElement);
            } else {
                console.error('Dữ liệu không hợp lệ');
            }
        }


        function updateDiachiInput() {
            var selectedProvince = provinceSelect.options[provinceSelect.selectedIndex]?.text || '';
            var selectedDistrict = districtSelect.options[districtSelect.selectedIndex]?.text || '';
            var selectedWard = wardSelect.options[wardSelect.selectedIndex]?.text || '';

            var fullAddress = selectedWard + ', ' + selectedDistrict + ', ' + selectedProvince;

            diachiInput.value = fullAddress;
        }
    });
</script>