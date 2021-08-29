<?php
include '../koneksi.php';
$name = mysqli_real_escape_string($koneksi, $_POST['data_name']);
$username = mysqli_real_escape_string($koneksi, $_POST['data_username']);
$password = mysqli_real_escape_string($koneksi, $_POST['data_password']);
$level = mysqli_real_escape_string($koneksi, $_POST['data_level']);

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "admin") {
        if (!(empty($name))) {
            $SQL = mysqli_query($koneksi, "INSERT INTO user VALUES (null, '$name', '$username', '$password','$level')");
            if ($SQL) {
                header('location: tambah_pengguna.php?pesan=berhasil');
            } else {
                header('location: tambah_pengguna.php?pesan=gagal');
            }
        } else {
            header('location: tambah_pengguna.php?pesan=gagal');
        }
    } else {
        header('location: tambah_pengguna.php');
    }
} else {
    header('location: tambah_pengguna.php');
}
