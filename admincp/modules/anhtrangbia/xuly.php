<?php

include('../../config/config.php');

$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;

$thutu = $_POST['thutu'];

$tinhtrang = $_POST['tinhtrang'];


if (isset($_POST['themanhtrangbia'])) {
    //them
    $sql_them = "INSERT INTO tbl_anhtrangbia(hinhanh,thutu,tinhtrang) VALUE('" . $hinhanh . "','" . $thutu . "','" . $tinhtrang . "')";
    mysqli_query($mysqli, $sql_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    header('location:../../index.php?action=anhtrangbia&query=them');
} elseif (isset($_POST['suaanhtrangbia'])) {
    //sua
    if (!empty($_FILES['hinhanh']['name'])) {
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

        $sql_update = "UPDATE tbl_anhtrangbia SET hinhanh='" . $hinhanh . "',thutu='" . $thutu . "',tinhtrang='" . $tinhtrang . "' WHERE id_anhtrangbia='$_GET[idanhtrangbia]'";
        // update xong mowis sua hinh anh
        $sql = "SELECT * FROM tbl_anhtrangbia WHERE id_anhtrangbia = '$_GET[idanhtrangbia]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('./uploads/' . $row['hinhanh']);
        }
    } else {
        $sql_update = "UPDATE tbl_anhtrangbia SET thutu='" . $thutu . "',tinhtrang='" . $tinhtrang . "' WHERE id_anhtrangbia='$_GET[idanhtrangbia]'";
    }
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=anhtrangbia&query=them');
} else {
    //xoa
    $id = $_GET['idanhtrangbia'];
    $sql = "SELECT * FROM tbl_anhtrangbia WHERE id_anhtrangbia = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_anhtrangbia WHERE id_anhtrangbia='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=anhtrangbia&query=them');
}
