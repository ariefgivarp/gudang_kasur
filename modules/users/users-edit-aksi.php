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
       
if(isset($_POST['submit'])){
    // ambil data dari formulir
        $kode_pegawai  = mysqli_real_escape_string($koneksi, trim($_POST['kode_pegawai']));
        $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
        $ttl  = mysqli_real_escape_string($koneksi, trim($_POST['ttl']));
        $jk  = mysqli_real_escape_string($koneksi, trim($_POST['jk']));
        $agama  = mysqli_real_escape_string($koneksi, trim($_POST['agama']));
        $alamat  = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));
        $no_telp  = mysqli_real_escape_string($koneksi, trim($_POST['no_telp']));
        $posisi  = mysqli_real_escape_string($koneksi, trim($_POST['posisi']));
        $gaji = str_replace('.', '', mysqli_real_escape_string($koneksi, trim($_POST['gaji'])));

        // buat query update
        $sql = "UPDATE gk_pegawai SET nama='$nama', ttl='$ttl', jk='$jk', agama='$agama', alamat='$alamat', no_telp='$no_telp', posisi='$posisi', gaji='$gaji' WHERE kode_pegawai = '$kode_pegawai'";
        $query = mysqli_query($koneksi, $sql);

        // apakah query update berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman list-siswa.php
            header('Location: users.php');
        } else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }


    } else {
        die("Akses dilarang...");
    }

?>