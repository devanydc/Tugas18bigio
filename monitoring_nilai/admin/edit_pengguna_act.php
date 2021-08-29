<?php
include '../koneksi.php';

$id = $_POST['data_id'];
$keyword = $_POST['data_keyword'];
$response = $_POST['data_response'];
$tema = $_POST['data_tema'];

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['status']) == "logged_in") {
        if ($id) {

            $SQL = mysqli_query($koneksi, "UPDATE tb_keyword SET `keyword` = '$keyword', `response` = '" . mysqli_real_escape_string($koneksi, $response) . "', `tema_id` = $tema WHERE id = '$id'");

            if ($SQL) {
                header('location: master_edit.php?id=' . $id . '&pesan=berhasil');
            } else {
                header('location: master_edit.php?id=' . $id . '&pesan=gagal' . mysqli_error($koneksi));
            }
        } else {
            header('location: master_index.php');
        }
    } else {
        header('location: master_edit.php');
    }
} else {
    header('location: master_edit.php');
}
