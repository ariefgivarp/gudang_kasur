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
include './../../config/koneksi.php';
require_once './../../config/fungsi_rupiah.php';
       
if(isset($_POST['simpan'])){
    // ambil data dari formulir
        $kode_supplier  = mysqli_real_escape_string($koneksi, trim($_POST['kode_supplier']));
        $nama_supplier  = mysqli_real_escape_string($koneksi, trim($_POST['nama_supplier']));
        $nama_barang  = mysqli_real_escape_string($koneksi, trim($_POST['nama_barang']));
        $alamat_supplier  = mysqli_real_escape_string($koneksi, trim($_POST['alamat_supplier']));
        $cp_supplier  = mysqli_real_escape_string($koneksi, trim($_POST['cp_supplier']));
        $harga_supplier = str_replace('.', '', mysqli_real_escape_string($koneksi, trim($_POST['harga_supplier'])));

        // buat query update
        $sql = "UPDATE gk_supplier SET nama_supplier='$nama_supplier', nama_barang='$nama_barang', alamat_supplier='$alamat_supplier', cp_supplier='$cp_supplier', harga_supplier='$harga_supplier' WHERE kode_supplier = '$kode_supplier'";
        $query = mysqli_query($koneksi, $sql);

        // apakah query update berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman list-siswa.php
            header('Location: supplier.php');
        } else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }


    } else {
        die("Akses dilarang...");
    }

?>