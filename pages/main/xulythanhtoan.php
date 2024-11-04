<div class="shipping-info">

    <div class="cart_left">
        <form action="pages/main/thanhtoan.php" method="post" onsubmit="return validatePayment();">
            <?php
            $isLoggedIn = isset($_SESSION['dangky']);

            if ($isLoggedIn) {
                $provinceId = isset($_POST['province']) ? intval($_POST['province']) : null;
                $districtId = isset($_POST['district']) ? intval($_POST['district']) : null;
                $wardId = isset($_POST['ward']) ? intval($_POST['ward']) : null;


                $provinceResult = mysqli_query($mysqli, "SELECT name FROM province WHERE province_id ");
                $districtResult = mysqli_query($mysqli, "SELECT name FROM district WHERE district_id ");
                $wardResult = mysqli_query($mysqli, "SELECT name FROM wards WHERE wards_id ");

                if (isset($_POST['province'])) {
                    $provinceId = intval($_POST['province']);


                    if ($provinceId > 0) {

                        $provinceResult = mysqli_query($mysqli, "SELECT name FROM province WHERE province_id = $provinceId");


                        if ($provinceResult) {
                            $provinceRow = mysqli_fetch_assoc($provinceResult);
                            $provinceName = $provinceRow ? $provinceRow['name'] : null;
                        } else {
                            die('Lỗi truy vấn tỉnh: ' . mysqli_error($mysqli));
                        }


                        if (isset($_POST['ward'])) {
                            $wardId = intval($_POST['ward']);


                            if ($wardId > 0) {

                                $wardResult = mysqli_query($mysqli, "SELECT name FROM wards WHERE wards_id = $wardId");


                                if ($wardResult) {
                                    $wardRow = mysqli_fetch_assoc($wardResult);
                                    $wardName = $wardRow ? $wardRow['name'] : null;
                                } else {
                                    die('Lỗi truy vấn xã/phường: ' . mysqli_error($mysqli));
                                }
                            } else {
                                die('Giá trị $wardId không hợp lệ.');
                            }
                        }
                    } else {
                        die('Giá trị $provinceId không hợp lệ.');
                    }
                }



                $id = $_SESSION['id_khachhang'];
                $sql_pro = "SELECT * FROM tbl_khackhang WHERE tbl_khackhang.id_khachhang = '$id' LIMIT 1";
                $query_pro = mysqli_query($mysqli, $sql_pro);


                if (!$query_pro) {
                    die('Lỗi truy vấn: ' . mysqli_error($mysqli));
                }

                while ($row_taikhoan = mysqli_fetch_array($query_pro)) {



            ?>
                    <h2>Thông tin giao hàng</h2>

                    <label for="hoTen">Họ và tên</label>
                    <input type="text" id="hoTen" name="hoTen" required placeholder="Họ và tên" value="<?php echo $row_taikhoan['tenkhachhang']; ?>">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Email" value="<?php echo $row_taikhoan['email']; ?>">

                    <label for="soDienThoai">Số điện thoại</label>
                    <input type="tel" id="soDienThoai" name="soDienThoai" required placeholder="Số điện thoại" value="<?php echo $row_taikhoan['dienthoai']; ?>">

                    <label for="diaChi">Địa chỉ</label>
                    <input type="text" id="diaChi" name="diaChi" required placeholder="Địa chỉ" value="<?php echo $row_taikhoan['diachi']; ?>">
                    <div class="select-container">
                        <div id="error-message" style="color: red;"></div>

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
                <?php
                }
            } else {
                ?>

                <h2>Thông tin giao hàng</h2>
                <p>Bạn chưa có tài khoản? <a style="color:#0079ff;" href="index.php?quanly=dangnhap">Đăng nhập</a></p>

                <label for="hoTen">Họ và tên</label>
                <input type="text" id="hoTen" name="hoTen" required placeholder="Họ và tên">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Email">

                <label for="soDienThoai">Số điện thoại</label>
                <input type="tel" id="soDienThoai" name="soDienThoai" required placeholder="Số điện thoại">

                <label for="diaChi">Địa chỉ</label>
                <input type="text" id="diaChi" name="diaChi" required placeholder="Địa chỉ">


                <div class="select-container">
                    <div id="error-message" style="color: red;"></div>

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

            <?php
            }
            ?>

    </div>
    <div class="cart_right">
        <div class="spgiohang_carts">
            <div class="cart_info-sps">


                <?php
                if (isset($_SESSION['id_khachhang'])) {
                    $id_khachhang = $_SESSION['id_khachhang'];


                    $sql_giohang = "SELECT giohang.*, sanpham.tensanpham, sanpham.giasp, sanpham.hinhanh, size.ten_size
                    FROM tbl_giohang giohang
                    JOIN tbl_sanpham sanpham ON giohang.id_sanpham = sanpham.id_sanpham
                    JOIN size ON giohang.size = size.id_size
                    WHERE giohang.id_khachhang = $id_khachhang";

                    $query_giohang = mysqli_query($mysqli, $sql_giohang);

                    $i = 0;
                    $tongtien = 0;
                    $soluongsanpham = 0;


                    while ($cart_item = mysqli_fetch_assoc($query_giohang)) {
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                        $tongtien += $thanhtien;
                        $soluongsanpham += $cart_item['soluong'];
                        $i++;


                ?>

                        <div class="cart-itemss">
                            <div class="cart_spgiohang-img" name="hinhanh">
                                <img src="./admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="sp1" width="100%" height="auto">
                            </div>
                            <div class='spgiohang_oo'>
                                <h4><?php echo $cart_item['tensanpham']; ?></h4>
                                <p>Số lượng: <?php echo $cart_item['soluong']; ?></p>
                                <p>Kích thước: <?php echo $cart_item['ten_size']; ?></p>
                            </div>
                            <p class="color_red"><?php echo number_format($thanhtien) . 'đ' ?></p>
                        </div>
                    <?php
                    }
                } elseif (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                    $i = 0;
                    $tongtien = 0;
                    $soluongsanpham = 0;
                    ?>

                    <?php foreach ($_SESSION['cart'] as $cart_item) : ?>
                        <?php
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                        $tongtien += $thanhtien;
                        $soluongsanpham += $cart_item['soluong'];
                        $i++;
                        $sql = "SELECT ten_size FROM size WHERE id_size = " . $cart_item['size'];
                        $result = mysqli_query($mysqli, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $ten_size = $row['ten_size'];
                        } else {
                            $ten_size = "Kích thước không hợp lệ";
                        }
                        ?>
                        <div class="cart-itemss">
                            <div class="cart_spgiohang-img" name="hinhanh">
                                <img src="./admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="sp1" width="100%" height="auto">
                            </div>
                            <div class='spgiohang_oo'>
                                <h4><?php echo $cart_item['tensanpham']; ?></h4>
                                <p>Số lượng: <?php echo $cart_item['soluong']; ?></p>
                                <p>Kích thước: <?php echo $ten_size; ?></p>
                            </div>
                            <p class="color_red"><?php echo number_format($thanhtien) . 'đ' ?></p>
                        </div>
                    <?php endforeach; ?>

                <?php
                } else {

                    echo "<script>alert('Giỏ hàng của bạn trống.');</script>";
                    echo "<script>window.location.href='../../index.php?quanly=giohang';</script>";
                    exit();
                }
                ?>
            </div>
        </div>



        <div class="cart_ghichu">
            <p class="abcd" for="fnote">Ghi chú đơn hàng</p><br>
            <textarea type="text" id="fnote" name="fnote"></textarea>
        </div>

        <div class="payment-section">
            <p>Hình thức thanh toán</p>

            <label class="hinhthuctt">
                <input type="checkbox" class="payment-checkbox" name="payment_method[]" value="Tiền mặt"> Thanh toán tiền mặt
            </label>
            <label class="hinhthuctt">
                <input type="checkbox" class="payment-checkbox" name="payment_method[]" value="Thanh toán qua Momo Atm"> Thanh toán MOMO
            </label>

        </div>

        <div class="cart-summary">
            <h2>Tổng cộng</h2>
            <p>Tạm tính:
                <?php echo number_format($tongtien) . '₫'; ?>
            </p>
            <?php

            $phiVanChuyen = 40000;
            $tongtien += $phiVanChuyen;

            echo '<p>Phí vận chuyển: ' . number_format($phiVanChuyen) . '₫</p>';
            ?>

            <p style="color:red;">Tổng cộng:
                <?php echo number_format($tongtien) . '₫'; ?>
            </p>

        </div>

        <input class="login-button" type="submit" name="thanhtoan" value="HOÀN THÀNH THANH TOÁN">
        </form>
        <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="pages/main/xulythanhtoan_atmmomo.php">
            <input type="submit" name="momo" value="Thanh toán qua Momo Atm" id="" class="login-button">
        </form>
    </div>

</div>

</div>


<script>
    function validatePayment() {

        var result = confirm("Xác nhận thanh toán?");


        var checked = document.querySelectorAll('input[name="payment_method[]"]:checked').length > 0;


        if (!checked) {
            alert('Xin vui lòng chọn hình thức thanh toán.');
        }


        return result && checked;
    }


    var checkboxes = document.querySelectorAll('.payment-checkbox');


    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {

            if (this.checked) {
                checkboxes.forEach(function(otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {

        var checkbox = document.querySelector('.payment-checkbox');


        if (checkbox) {

            checkbox.checked = true;
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var provinceSelect = document.getElementById('province');
        var districtSelect = document.getElementById('district');
        var wardSelect = document.getElementById('ward');
        var diachiInput = document.getElementById('diaChi');
        var errorMessage = document.getElementById('error-message');

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

            if (!provinceId) {
                districtSelect.innerHTML = '<option value="" selected disabled>Chọn quận/huyện</option>';
                wardSelect.innerHTML = '<option value="" selected disabled>Chọn xã/phường</option>';
                districtSelect.disabled = true;
                wardSelect.disabled = true;
                checkAddressSelection();
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
                        checkAddressSelection();
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
                checkAddressSelection();
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
                        checkAddressSelection();
                    } else {
                        console.error('Lỗi khi lấy danh sách xã/phường');
                    }
                }
            };

            xhr.open('GET', './pages/main/get_locations.php?district_id=' + districtId, true);
            xhr.send();
        });

        wardSelect.addEventListener('change', function() {
            updateDiachiInput();
            checkAddressSelection();
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

        function checkAddressSelection() {
            var selectedProvince = provinceSelect.options[provinceSelect.selectedIndex]?.text || '';
            var selectedDistrict = districtSelect.options[districtSelect.selectedIndex]?.text || '';
            var selectedWard = wardSelect.options[wardSelect.selectedIndex]?.text || '';

            if (!selectedProvince || !selectedDistrict || !selectedWard) {
                errorMessage.innerHTML = 'Vui lòng chọn đủ thông tin địa chỉ.';
            } else {
                errorMessage.innerHTML = '';
            }
        }
    });
</script>