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
    $kode_pegawai  = mysqli_real_escape_string($mysqli, trim($_POST['kode_pegawai']));
    $nama  = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
    $gaji = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['gaji'])));
    // ambil data dari formulir
    $kode_pegawai = $_POST['kode_pegawai'];
    $nama = $_POST['nama'];
    $ttl = $_POST['ttl'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $posisi = $_POST['posisi'];
    $gaji = $_POST['gaji'];
    $tgl_masuk = $_POST['tgl_masuk'];

    // buat query
    $sql = "insert into gk_pegawai values('', '$kode_pegawai', '$nama', '$ttl', '$jk', '$agama', '$alamat','$no_telp','$posisi','$gaji','$tgl_masuk')";
    $query = mysqli_query($koneksi, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: users.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: users-tambah.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>