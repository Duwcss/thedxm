<?php
include('../../admincp/config/config.php');

if (isset($_GET['province_id'])) {
    $provinceId = intval($_GET['province_id']);


    $districtQuery = "SELECT district_id as id, name FROM district WHERE province_id = $provinceId";
    $districtResult = mysqli_query($mysqli, $districtQuery);


    if ($districtResult) {
        $districts = [];


        while ($districtRow = mysqli_fetch_assoc($districtResult)) {
            $districts[] = $districtRow;
        }

        echo json_encode($districts);
    } else {

        http_response_code(500);
        echo json_encode(['error' => 'Lỗi khi truy vấn dữ liệu quận/huyện.']);
    }
} elseif (isset($_GET['district_id'])) {
    $districtId = intval($_GET['district_id']);


    $wardQuery = "SELECT wards_id as id, name FROM wards WHERE district_id = $districtId";
    $wardResult = mysqli_query($mysqli, $wardQuery);


    if ($wardResult) {
        $wards = [];


        while ($wardRow = mysqli_fetch_assoc($wardResult)) {
            $wards[] = $wardRow;
        }


        echo json_encode($wards);
    } else {

        http_response_code(500);
        echo json_encode(['error' => 'Lỗi khi truy vấn dữ liệu xã/phường.']);
    }
} else {

    $provinceQuery = "SELECT province_id as id, name FROM province";
    $provinceResult = mysqli_query($mysqli, $provinceQuery);


    if ($provinceResult) {
        $provinces = [];


        while ($provinceRow = mysqli_fetch_assoc($provinceResult)) {
            $provinces[] = $provinceRow;
        }


        echo json_encode($provinces);
    } else {

        http_response_code(500);
        echo json_encode(['error' => 'Lỗi khi truy vấn dữ liệu tỉnh/thành phố.']);
    }
}


mysqli_close($mysqli);
