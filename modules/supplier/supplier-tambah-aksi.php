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

    $kode_supplier  = mysqli_real_escape_string($mysqli, trim($_POST['kode_supplier']));
    $nama_supplier  = mysqli_real_escape_string($mysqli, trim($_POST['nama_supplier']));
    $harga_supplier = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga_supplier'])));
    // ambil data dari formulir
    $kode_supplier = $_POST['kode_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $nama_barang = $_POST['nama_barang'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $cp_supplier = $_POST['cp_supplier'];
    $harga_supplier = $_POST['harga_supplier'];

    // buat query
    $sql = "insert into gk_supplier values('', '$kode_supplier', '$nama_supplier', '$nama_barang', '$alamat_supplier', '$cp_supplier', '$harga_supplier')";
    $query = mysqli_query($koneksi, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: supplier.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: supplier-tambah.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>