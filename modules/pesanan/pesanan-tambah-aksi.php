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

    $kode_kasur  = mysqli_real_escape_string($mysqli, trim($_POST['kode_kasur']));
    $nama_kasur  = mysqli_real_escape_string($mysqli, trim($_POST['nama_kasur']));
    $harga_jual = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga_jual'])));
    $satuan     = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));
    // ambil data dari formulir
    $kode_kasur = $_POST['kode_kasur'];
    $nama_kasur = $_POST['nama_kasur'];
    $tipe_busa = $_POST['tipe_busa'];
    $ukuran_kasur = $_POST['ukuran_kasur'];
    $densiti_kasur = $_POST['densiti_kasur'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $harga_jual = $_POST['harga_jual'];
    $satuan = $_POST['satuan'];
    $stok = $_POST['stok'];

    // buat query
    $sql = "insert into gk_pesanan values('', NOW(), '$kode_kasur', '$nama_kasur', '$tipe_busa', '$ukuran_kasur', '$densiti_kasur', '$nama_pembeli', '$harga_jual', '$satuan', '$stok')";
    $query = mysqli_query($koneksi, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: pesanan.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: pesanan-tambah.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>