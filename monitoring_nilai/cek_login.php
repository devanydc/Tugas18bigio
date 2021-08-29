<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// var_dump($cek);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if ($data['level'] == "admin") {
		// buat session login dan username
		$_SESSION['id'] = $data['id'];
		$_SESSION['name'] = $data['name'];
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin/halaman_index.php");

		// cek jika user login sebagai guru
	} else if ($data['level'] == "guru") {
		// buat session login dan username
		$_SESSION['id'] = $data['id'];
		$_SESSION['name'] = $data['name'];
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "guru";
		// alihkan ke halaman dashboard guru
		header("location:guru/halaman_index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "siswa") {
		// buat session login dan siswa
		$_SESSION['id'] = $data['id'];
		$_SESSION['name'] = $data['name'];
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "siswa";
		// alihkan ke halaman dashboard siswa
		header("location:siswa/halaman_index.php");
	} else {

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}
} else {
	header("location:index.php?pesan=gagal");
}
