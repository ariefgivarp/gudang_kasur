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
			width: 13%;
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
		$query = "SELECT * FROM gk_kasur";

		$label = "Semua Data Transaksi";
	}else{ // Jika terisi
		// Buat query untuk menampilkan data transaksi sesuai periode tanggal
		$query = "SELECT * FROM gk_kasur WHERE (tgl_input BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";

		$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
	}
	?>
	<h4 style="margin-bottom: 5px;">Data Kasur</h4>
	<?php echo $label ?>

	<table class="table" border="1" width="100%" style="margin-top: 10px;">
	<tr>
                                <th>Tanggal</th>
                                <th>Kode Kasur</th>
                                <th>Nama kasur</th>
                                <th>Tipe Busa</th>
								<th>Ukuran</th>
								<th>Density</th>
                                <th>Harga Awal</th>
                                <th>Harga Jual</th>
                            </tr>

		<?php
        require_once './../../config/fungsi_rupiah.php';
		$sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
		$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

		if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
			while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
				$tgl = date('d-m-Y', strtotime($data['tgl_input'])); // Ubah format tanggal jadi dd-mm-yyyy

				$harga_beli = format_rupiah($data['harga_awal']);
                $harga_jual = format_rupiah($data['harga_jual']);

                echo "<tr>";
                echo "<td>".$tgl."</td>";
                echo "<td>".$data['kode_kasur']."</td>";
                echo "<td>".$data['nama_kasur']."</td>";
                echo "<td>".$data['tipe_busa']."</td>";
				echo "<td>".$data['ukuran_kasur']."</td>";
				echo "<td>".$data['densiti_kasur']."</td>";
                echo "<td>".$harga_beli."</td>";
                echo "<td>".$harga_jual."</td>";
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
$pdf->Output('Data Kasur.pdf', 'D');
?>
