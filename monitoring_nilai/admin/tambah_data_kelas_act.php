<?php
include '../koneksi.php';
$id_siswa = mysqli_real_escape_string($koneksi, $_POST['data_siswa']);
$id_guru = mysqli_real_escape_string($koneksi, $_POST['data_guru']);

var_dump($id_siswa, $id_guru);

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "admin") {
        if (!(empty($id_siswa))) {
            $SQL = mysqli_query($koneksi, "INSERT INTO group_kelas VALUES (null, '$id_guru', '$id_siswa')");
            if ($SQL) {
                header('location: tambah_data_kelas.php?pesan=berhasil');
            } else {
                header('location: tambah_data_kelas.php?pesan=gagal');
            }
        } else {
            header('location: tambah_data_kelas.php?pesan=gagal');
        }
    } else {
        header('location: tambah_data_kelas.php');
    }
} else {
    header('location: tambah_data_kelas.php');
}
