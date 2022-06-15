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

if( isset($_GET['id_kasur']) ){

    // ambil id dari query string
    $id = $_GET['id_kasur'];

    // buat query hapus
    $sql = "DELETE FROM gk_kasur WHERE id_kasur=$id";
    $query = mysqli_query($koneksi, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: kasur.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>