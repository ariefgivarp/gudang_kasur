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
	$jumlah_masuk		=$_POST['jumlah_masuk'];
	
	include './../../config/koneksi.php';	
	$selSto =mysqli_query($koneksi, "SELECT * FROM gk_kasur WHERE kode_kasur='$kode_kasur'");
	$sto    =mysqli_fetch_array($selSto);
	$stok	=$sto['stok'];
	//menghitung sisa stok
	$sisa	=$stok+$jumlah_masuk;
	
	if ($stok == $jumlah_masuk) {
		?>
		<script language="JavaScript">
			alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
			document.location='kasur-masuk.php';
		</script>
		<?php
	}
	//proses	
	else{
		$insert =mysqli_query($koneksi, "INSERT INTO gk_kasur_masuk (kode_transaksi, tanggal_masuk, kode_kasur, jumlah_masuk) VALUES ('$kode_transaksi', now(), '$kode_kasur', '$jumlah_masuk')");
			if($insert){
				//update stok
				$upstok= mysqli_query($koneksi, "UPDATE gk_kasur SET stok='$sisa' WHERE kode_kasur='$kode_kasur'");
				?>
				<script language="JavaScript">
					alert('Good! Input Kasur Masuk berhasil ...');
					document.location='kasur-masuk.php';
				</script>
				<?php
			}
			else {
				echo "<div><b>Oops!</b> 404 Error Server.</div>";
			}
	}
	}
?>