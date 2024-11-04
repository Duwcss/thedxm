<?php

include('../../config/config.php');
$chinhanh = $_POST['chinhanh'];
$thutu = $_POST['thutu'];

if (isset($_POST['themchinhanh'])) {
    //them
    $sql_them = "INSERT INTO tbl_chinhanh(chinhanh,thutu) VALUE('" . $chinhanh . "','" . $thutu . "')";
    mysqli_query($mysqli, $sql_them);
    header('location:../../index.php?action=quanlychinhanh&query=them');
} elseif (isset($_POST['suachinhanh'])) {
    //sua
    $sql_update = "UPDATE tbl_chinhanh SET chinhanh='" . $chinhanh . "',thutu='" . $thutu . "' WHERE id_chinhanh='$_GET[idchinhanh]'";
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=quanlychinhanh&query=them');
} else {
    //xóa
    $id = $_GET['idchinhanh'];
    $sql_xoa = "DELETE FROM tbl_chinhanh WHERE id_chinhanh='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlychinhanh&query=them');
}
