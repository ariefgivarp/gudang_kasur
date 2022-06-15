<?php
session_start();
if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='../../index.php'>Klik disini</a>";
	exit;
}

$id_user=$_SESSION["id_users"];
$username=$_SESSION["username"];
?>
<?php

include("./../../config/koneksi.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit'])){

    $kode  = mysqli_real_escape_string($mysqli, trim($_POST['kode_uang']));
    $keterangan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_kasur']));
    $nominal = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga_awal'])));
    // ambil data dari formulir
    $kode_uang = $_POST['kode_uang'];
    $keterangan = $_POST['keterangan'];
    $nominal = $_POST['nominal'];

    // buat query
    $sql = "insert into gk_data_keuangan values('', NOW(), '$kode_uang', '$keterangan', '$nominal')";
    $query = mysqli_query($koneksi, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: data-keuangan.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: data-keuangan-tambah.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>