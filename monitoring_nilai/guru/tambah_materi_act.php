<?php
include '../koneksi.php';
$data_materi = mysqli_real_escape_string($koneksi, $_POST['data_materi']);
$id_guru = mysqli_real_escape_string($koneksi, $_POST['data_guru']);

var_dump($id_materi, $guru);

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "guru") {
        if (!(is_null($data_materi))) {
            $SQL = mysqli_query($koneksi, "INSERT INTO materi_pembelajaran VALUES (null, '$data_materi', '$id_guru')");
            if ($SQL) {
                header('location: tambah_materi.php?pesan=berhasil');
            } else {
                header('location: tambah_materi.php?pesan=gagal');
            }
        } else {
            header('location: tambah_materi.php?pesan=gagal');
        }
    } else {
        header('location: tambah_materi.php');
    }
} else {
    header('location: tambah_materi.php');
}
