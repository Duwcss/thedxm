<?php

include('../../config/config.php');
$tenchinhsach = $_POST['tenchinhsach'];
$thutu = $_POST['thutu'];

if (isset($_POST['themtenchinhsach'])) {
    //them
    $sql_them = "INSERT INTO tbl_tenchinhsach(tenchinhsach,thutu) VALUE('" . $tenchinhsach . "','" . $thutu . "')";
    mysqli_query($mysqli, $sql_them);
    header('location:../../index.php?action=quanlytenchinhsach&query=them');
} elseif (isset($_POST['suatenchinhsach'])) {
    //sua
    $sql_update = "UPDATE tbl_tenchinhsach SET tenchinhsach='" . $tenchinhsach . "',thutu='" . $thutu . "' WHERE id_tenchinhsach='$_GET[idtenchinhsach]'";
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=quanlytenchinhsach&query=them');
} else {
    //xóa
    $id = $_GET['idtenchinhsach'];
    $sql_xoa = "DELETE FROM tbl_tenchinhsach WHERE id_tenchinhsach='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlytenchinhsach&query=them');
}
