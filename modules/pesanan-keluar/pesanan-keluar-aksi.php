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
if ($_POST['Submit'] == "Submit") {
	$kode_kasur			=$_POST['kode_kasur'];
	$kode_transaksi		=$_POST['kode_transaksi'];
	$nama_pembeli		=$_POST['nama_pembeli'];
	$pembayaran		=$_POST['pembayaran'];
	$jumlah_keluar		=$_POST['jumlah_keluar'];
	
	include './../../config/koneksi.php';	
	$selSto =mysqli_query($koneksi, "SELECT * FROM gk_pesanan WHERE kode_kasur='$kode_kasur'");
	$sto    =mysqli_fetch_array($selSto);
	$stok	=$sto['stok'];
	//menghitung sisa stok
	$sisa	=$stok-$jumlah_keluar;
	
	if ($stok < $jumlah_keluar) {
		?>
		<script language="JavaScript">
			alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
			document.location='pesanan-keluar.php';
		</script>
		<?php
	}
	//proses	
	else{
		$insert =mysqli_query($koneksi, "INSERT INTO gk_pesanan_keluar (kode_transaksi, tanggal_keluar, kode_kasur, jumlah_keluar, pembayaran, nama_pembeli) VALUES ('$kode_transaksi', now(), '$kode_kasur', '$jumlah_keluar', '$pembayaran', '$nama_pembeli')");
			if($insert){
				//update stok
				$upstok= mysqli_query($koneksi, "UPDATE gk_pesanan SET stok='$sisa' WHERE kode_kasur='$kode_kasur'");
				?>
				<script language="JavaScript">
					alert('Good! Input transaksi pengeluaran barang berhasil ...');
					document.location='pesanan-keluar.php';
				</script>
				<?php
			}
			else {
				echo "<div><b>Oops!</b> 404 Error Server.</div>";
			}
	}
	}
?>