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
        $kode_uang  = mysqli_real_escape_string($koneksi, trim($_POST['kode_uang']));
        $keterangan  = mysqli_real_escape_string($koneksi, trim($_POST['keterangan']));
        $nominal = str_replace('.', '', mysqli_real_escape_string($koneksi, trim($_POST['nominal'])));

        // buat query update
        $sql = "UPDATE gk_data_keuangan SET keterangan='$keterangan', nominal='$nominal' WHERE kode_uang = '$kode_uang'";
        $query = mysqli_query($koneksi, $sql);

        // apakah query update berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman list-siswa.php
            header('Location: data-keuangan.php');
        } else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }


    } else {
        die("Akses dilarang...");
    }

?>