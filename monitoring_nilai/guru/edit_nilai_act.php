<?php
include '../koneksi.php';

$id = $_POST['data_id_nilai'];
$id_materi = $_POST['data_id_materi'];
$nilai = $_POST['data_nilai'];

var_dump($id, $id_murid, $id_materi, $nilai);

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "guru") {
        if ($id) {

            $SQL = mysqli_query($koneksi, "UPDATE nilai_siswa SET `id_materi` = '$id_materi', `nilai` = '$nilai' WHERE `id` = $id");

            if ($SQL) {
                header('location: edit_nilai.php?id=' . $id . '&pesan=berhasil');
            } else {
                header('location: edit_nilai.php?id=' . $id . '&pesan=gagal' . mysqli_error($koneksi));
            }
        } else {
            header('location: master_index.php');
        }
    } else {
        header('location: edit_nilai.php');
    }
} else {
    header('location: edit_nilai.php');
}
