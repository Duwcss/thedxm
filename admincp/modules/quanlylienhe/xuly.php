<?php

include('../../config/config.php');


$lienhe = $_POST['lienhe'];
$thutu = $_POST['thutu'];

if (isset($_POST['themlienhe'])) {

    $sql_them = "INSERT INTO tbl_lienhe(lienhe,thutu) VALUE('" . $lienhe . "','" . $thutu . "')";
    mysqli_query($mysqli, $sql_them);
    header('location:../../index.php?action=quanlylienhe&query=them');
} elseif (isset($_POST['sualienhe'])) {
    //sua
    $sql_update = "UPDATE tbl_lienhe SET lienhe='" . $lienhe . "',thutu='" . $thutu . "' WHERE id_lienhe='$_GET[idlienhe]'";
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=quanlylienhe&query=them');
} else {
    //xóa
    $id = $_GET['idlienhe'];
    $sql_xoa = "DELETE FROM tbl_lienhe WHERE id_lienhe='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlylienhe&query=them');
}
