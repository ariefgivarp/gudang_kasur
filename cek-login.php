<?php
// panggil file untuk koneksi ke database
require_once "./config/koneksi.php";

// ambil data hasil submit dari form
$username = mysqli_real_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {
	// ambil data dari tabel user untuk pengecekan berdasarkan inputan username dan passrword
	$query = mysqli_query($koneksi, "SELECT * FROM gk_users WHERE username='$username' AND password='$password'")
									or die('Ada kesalahan pada query user: '.mysqli_error($koneksi));
	$rows  = mysqli_num_rows($query);

	// jika data ada, jalankan perintah untuk membuat session
	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();
		$_SESSION['id_users']   = $data['id_users'];
		$_SESSION['username']  = $data['username'];
		$_SESSION['password']  = $data['password'];
		$_SESSION['nama_user'] = $data['nama_user'];
		$_SESSION['hak_akses'] = $data['hak_akses'];
		$_SESSION['status'] = "login";
		
		// lalu alihkan ke halaman user
		header("Location: ./modules/beranda/view.php");
	}

	// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
	else {
		header("Location: index.php?alert=1");
	}
}
?>