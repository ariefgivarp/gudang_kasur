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
        $kode_kasur  = mysqli_real_escape_string($koneksi, trim($_POST['kode_kasur']));
        $nama_kasur  = mysqli_real_escape_string($koneksi, trim($_POST['nama_kasur']));
        $tipe_busa  = mysqli_real_escape_string($koneksi, trim($_POST['tipe_busa']));
        $ukuran_kasur  = mysqli_real_escape_string($koneksi, trim($_POST['ukuran_kasur']));
        $densiti_kasur  = mysqli_real_escape_string($koneksi, trim($_POST['densiti_kasur']));
        $nama_pembeli = mysqli_real_escape_string($koneksi, trim($_POST['nama_pembeli']));
        $harga_jual = str_replace('.', '', mysqli_real_escape_string($koneksi, trim($_POST['harga_jual'])));
        $satuan     = mysqli_real_escape_string($koneksi, trim($_POST['satuan']));
        $stok     = mysqli_real_escape_string($koneksi, trim($_POST['stok']));

        // buat query update
        $sql = "UPDATE gk_pesanan SET nama_kasur='$nama_kasur', tipe_busa='$tipe_busa', ukuran_kasur='$ukuran_kasur', densiti_kasur='$densiti_kasur', nama_pembeli='$nama_pembeli', harga_jual='$harga_jual', satuan='$satuan', stok='$stok' WHERE kode_kasur = '$kode_kasur'";
        $query = mysqli_query($koneksi, $sql);

        // apakah query update berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman list-siswa.php
            header('Location: pesanan.php');
        } else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }


    } else {
        die("Akses dilarang...");
    }

?>