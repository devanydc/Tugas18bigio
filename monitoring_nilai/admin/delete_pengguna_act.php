<?php
include '../koneksi.php';

$id = $_GET['id'];

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    if (($_SESSION['level']) == "admin") {
        if ($id) {
            $SQL = mysqli_query($koneksi, "DELETE FROM user WHERE id =$id");
            if ($SQL) {
                header('location: halaman_index.php?pesan=berhasil delete');
            } else {
                header('location: halaman_index.php?pesan=gagal delete');
            }
        } else {
            header('location: halaman_index.php?');
        }
    } else {
        header('location: halaman_index.php');
    }
} else {
    header('location: halaman_index.php');
}
