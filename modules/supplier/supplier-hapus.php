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

if( isset($_GET['id_supplier']) ){

    // ambil id dari query string
    $id = $_GET['id_supplier'];

    // buat query hapus
    $sql = "DELETE FROM gk_supplier WHERE id_supplier=$id";
    $query = mysqli_query($koneksi, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: supplier.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>