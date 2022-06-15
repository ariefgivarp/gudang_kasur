<?php
session_start();
if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='../../index.php'>Klik disini</a>";
	exit;
}

$id_user=$_SESSION["id_users"];
$username=$_SESSION["username"];
?>
<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
	<style>
		.table {
			border-collapse:collapse;
			table-layout:fixed;width: 630px;
		}
		.table th {
			padding: 5px;
		}
		.table td {
			word-wrap:break-word;
			width: 20%;
			padding: 5px;
		}
	</style>
</head>
<body>
	<?php
	// Load file koneksi.php
	include "./../../config/koneksi.php";

	$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
	$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

	if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
		// Buat query untuk menampilkan semua data transaksi
		$query = "SELECT * FROM gk_kasur_keluar";

		$label = "Semua Data Transaksi";
	}else{ // Jika terisi
		// Buat query untuk menampilkan data transaksi sesuai periode tanggal
		$query = "SELECT * FROM gk_kasur_keluar WHERE (tanggal_keluar BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";

		$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
	}
	?>
	<h4 style="margin-bottom: 5px;">Data Transaksi Keluar</h4>
	<?php echo $label ?>

	<table class="table" border="1" width="100%" style="margin-top: 10px;">
		<tr>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Kode Kasur</th>
            <th>Jumlah Keluar</th>
			<th>Status Pembayaran</th>
		</tr>

		<?php
		$sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
		$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

		if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
			while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
				$tgl = date('d-m-Y', strtotime($data['tanggal_keluar'])); // Ubah format tanggal jadi dd-mm-yyyy

				echo "<tr>";
				echo "<td>".$tgl."</td>";
				echo "<td>".$data['kode_transaksi']."</td>";
				echo "<td>".$data['kode_kasur']."</td>";
				echo "<td>".$data['jumlah_keluar']."</td>";
				echo "<td>".$data['pembayaran']."</td>";
				echo "</tr>";
			}
		}else{ // Jika data tidak ada
			echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
		}
		?>
	</table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require './../../libraries/libraries/html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en', true, 'UTF-8', 0);
$pdf->WriteHTML($html);
$pdf->Output('Data Kasur Keluar.pdf', 'D');
?>
