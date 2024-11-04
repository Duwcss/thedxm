<?php
include('../../config/config.php');

$tensize = $_POST['tenkichthuoc'];
$thutu = $_POST['thutu'];

if (isset($_POST['themkichthuoc'])) {
    //them
    $sql_them = "INSERT INTO size(ten_size,thutu) VALUE('" . $tensize . "','" . $thutu . "')";
    mysqli_query($mysqli, $sql_them);
    header('location:../../index.php?action=quanlysp&query=kichthuoc');
} else {
    //xóa
    $id = $_GET['idsize'];
    $sql_xoa = "DELETE FROM size WHERE id_size='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlysp&query=kichthuoc');
}

?>
<?php

if (isset($_POST['themsanpham'])) {
    $tensanpham = $_POST['tensanpham'];
    $masp = $_POST['masp'];
    $giasp = $_POST['giasp'];
    $km = $_POST['km'];
    $giagockm = $_POST['giagockm'];
    $tomtat = $_POST['tomtat'];
    $tinhtrang = $_POST['tinhtrang'];
    $danhmuc = $_POST['danhmuc'];
    $kichthuoc = $_POST['kichthuoc'];
    $soluongTotal = $_POST['tongsoluong'];
    $soluongsize = $_POST['soluong'];


    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $hinhanh = time() . '_' . $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    } else {
        $hinhanh = '';
    }


    $sql_them_sanpham = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, km, giagockm,soluong, hinhanh, tomtat, tinhtrang, id_danhmuc) VALUES('$tensanpham', '$masp', '$giasp', '$km', '$giagockm','$soluongTotal' ,'$hinhanh', '$tomtat', '$tinhtrang', '$danhmuc')";
    $result_them_sanpham = $mysqli->query($sql_them_sanpham);


    $idSanPham = $mysqli->insert_id;


    for ($i = 0; $i < count($kichthuoc); $i++) {
        $size = $kichthuoc[$i];
        $soLuong = $soluongsize[$i];


        $tyLeSoLuong = $soLuong / $soluongTotal;
        $soLuongPerSize = round($tyLeSoLuong * $soluongTotal);

        $sql_them_size_soluong = "INSERT INTO size_soluong(id_sanpham, id_size, soluongsize) VALUES('$idSanPham', '$size', '$soLuongPerSize')";
        $result_them_size_soluong = $mysqli->query($sql_them_size_soluong);
    }




    header('location:../../index.php?action=quanlysp&query=lieke');
} elseif (isset($_POST['suasanpham'])) {

    $idSanPham = $_GET['idsanpham'];
    $tensanpham = $_POST['tensanpham'];
    $masp = $_POST['masp'];
    $giasp = $_POST['giasp'];
    $km = $_POST['km'];
    $giagockm = $_POST['giagockm'];

    $tomtat = $_POST['tomtat'];
    $tinhtrang = $_POST['tinhtrang'];
    $danhmuc = $_POST['danhmuc'];
    $kichthuoc = $_POST['kichthuoc'];
    $soluongTotal = $_POST['tongsoluong'];
    $soluongsize = $_POST['soluong'];

    var_dump($_POST['soluong']);
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh = time() . '_' . $_FILES['hinhanh']['name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);


        $sql_get_old_image = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham = $idSanPham";
        $result_old_image = $mysqli->query($sql_get_old_image);
        if ($result_old_image->num_rows > 0) {
            $row_old_image = $result_old_image->fetch_assoc();
            $oldImage = $row_old_image['hinhanh'];
            if (!empty($oldImage)) {
                unlink('./uploads/' . $oldImage);
            }
        }
    } else {

        $sql_get_old_image = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham = $idSanPham";
        $result_old_image = $mysqli->query($sql_get_old_image);
        if ($result_old_image->num_rows > 0) {
            $row_old_image = $result_old_image->fetch_assoc();
            $hinhanh = $row_old_image['hinhanh'];
        }
    }


    $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "', masp='" . $masp . "', giasp='" . $giasp . "', km='" . $km . "', giagockm='" . $giagockm . "', soluong='" . $soluongTotal . "', hinhanh='" . $hinhanh . "', tomtat='" . $tomtat . "', tinhtrang='" . $tinhtrang . "', id_danhmuc='" . $danhmuc . "' WHERE id_sanpham='$idSanPham'";
    mysqli_query($mysqli, $sql_update);
    $sql_xoa_size_soluong = "DELETE FROM size_soluong WHERE id_sanpham = $idSanPham";
    mysqli_query($mysqli, $sql_xoa_size_soluong);


    $soluongTotal = $_POST['tongsoluong'];


    $sql_xoa_size_soluong = "DELETE FROM size_soluong WHERE id_sanpham = $idSanPham";
    $mysqli->query($sql_xoa_size_soluong);


    $soluongsize = $_POST['soluong'];


    foreach ($soluongsize as $id_size => $soluong) {

        $sql_them_size_soluong = "INSERT INTO size_soluong(id_sanpham, id_size, soluongsize) VALUES('$idSanPham', '$id_size', '$soluong')";
        $result_them_size_soluong = $mysqli->query($sql_them_size_soluong);
    }



    header('location:../../index.php?action=quanlysp&query=lieke');
} else {
    //xoa
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $sql_xoa_size_soluong = "DELETE FROM size_soluong WHERE id_sanpham='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa_size_soluong);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlysp&query=lieke');
}







?>