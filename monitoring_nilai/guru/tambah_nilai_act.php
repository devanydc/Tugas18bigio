<?php
include '../koneksi.php';
$id_siswa = mysqli_real_escape_string($koneksi, $_POST['data_id_siswa']);
$id_materi = mysqli_real_escape_string($koneksi, $_POST['data_id_materi']);
$nilai = mysqli_real_escape_string($koneksi, $_POST['data_nilai']);

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "guru") {
        if ($id_siswa > 0 || $id_materi > 0) {
            $SQL = mysqli_query($koneksi, "INSERT INTO nilai_siswa VALUES (null, '$id_siswa', '$id_materi', '$nilai')");
            if ($SQL) {
                header('location: tambah_nilai.php?pesan=berhasil');
            } else {
                header('location: tambah_nilai.php?pesan=gagal');
            }
        } else {
            header('location: tambah_nilai.php?pesan=gagal');
        }
    } else {
        header('location: tambah_nilai.php');
    }
} else {
    header('location: tambah_nilai.php');
}
