<?php

include('../../config/config.php');
$tenbaibao = $_POST['tenbaibao'];

$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;

$thoigian = $_POST['thoigian'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$thutu = $_POST['thutu'];
$tacgia = $_POST['tacgia'];


if (isset($_POST['thembaibao'])) {
    //them
    $sql_them = "INSERT INTO tbl_baibao(tenbaibao,hinhanh,thoigian,tomtat,noidung,tinhtrang,thutu,tacgia) VALUE('" . $tenbaibao . "','" . $hinhanh . "','" . $thoigian . "','" . $tomtat . "','" . $noidung . "','" . $tinhtrang . "','" . $thutu . "','" . $tacgia . "')";
    mysqli_query($mysqli, $sql_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    header('location:../../index.php?action=quanlybaibao&query=them');
} elseif (isset($_POST['suabaibao'])) {
    //sua
    if (!empty($_FILES['hinhanh']['name'])) {
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        $sql_update = "UPDATE tbl_baibao SET tenbaibao='" . $tenbaibao . "',hinhanh='" . $hinhanh . "',thoigian='" . $thoigian . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',thutu='" . $thutu . "' WHERE id_baibao='$_GET[idbaibao]'";

        $sql = "SELECT * FROM tbl_baibao WHERE id_baibao = '$_GET[idbaibao]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('./uploads/' . $row['hinhanh']);
        }
    } else {
        $sql_update = "UPDATE tbl_baibao SET tenbaibao='" . $tenbaibao . "',thoigian='" . $thoigian . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',tinhtrang='" . $tinhtrang . "',thutu='" . $thutu . "' WHERE id_baibao='$_GET[idbaibao]'";
    }
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=quanlybaibao&query=lietke');
} else {
    //xoa
    $id = $_GET['idbaibao'];
    $sql = "SELECT * FROM tbl_baibao WHERE id_baibao = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_baibao WHERE id_baibao='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlybaibao&query=lietke');
}
