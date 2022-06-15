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
			width: 25%;
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
		$query = "SELECT * FROM gk_data_keuangan";

		$label = "Semua Data Transaksi";
	}else{ // Jika terisi
		// Buat query untuk menampilkan data transaksi sesuai periode tanggal
		$query = "SELECT * FROM gk_data_keuangan WHERE (tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";

		$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
	}
	?>
	<h4 style="margin-bottom: 5px;">Data Keuangan</h4>
	<?php echo $label ?>

	<table class="table" border="1" width="100%" style="margin-top: 10px;">
	<tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Keterangan</th>
                                <th>Jumlah Nominal</th>
                            </tr>

		<?php
        require_once './../../config/fungsi_rupiah.php';
		$sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
		$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

		if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
			while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
				$tgl = date('d-m-Y', strtotime($data['tanggal'])); // Ubah format tanggal jadi dd-mm-yyyy

				$nominal = format_rupiah($data['nominal']);

                echo "<tr>";
                echo "<td>".$tgl."</td>";
                echo "<td>".$data['kode_uang']."</td>";
                echo "<td>".$data['keterangan']."</td>";
                echo "<td>".$nominal."</td>";
                echo "</tr>";
			}
		}else{ // Jika data tidak ada
			echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
		}
		?>
	</table>
    <table>
                                <tr>
                                    <th>Total</th>
                                    <?php
                                    // Load file koneksi.php
                                    include './../../config/koneksi.php';

                                    $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                                    $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

                                    if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
                                        // Buat query untuk menampilkan semua data transaksi
                                        $query = "SELECT sum(nominal) as total FROM gk_data_keuangan order by tanggal desc";
                                        $url_cetak = "cetak.php";
                                        $label = "Semua Data Transaksi";
                                    }else{ // Jika terisi
                                        // Buat query untuk menampilkan data transaksi sesuai periode tanggal
                                        $query = "SELECT sum(nominal) as total FROM gk_data_keuangan WHERE (tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
                                        $url_cetak = "cetak.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
                                        $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
                                        $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
                                        $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
                                    }
                                    ?>
                                    <?php
                            
                                    require_once './../../config/fungsi_rupiah.php';
                                    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
                                    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

                                    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            $total = format_rupiah($data['total']);

                                    
                                            echo "<th><label>Rp. </label>".$total."</th>";
                                    
                                }
                            }else{ // Jika data tidak ada
                                echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                            }
                            ?>
                                </tr>
                            </table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require './../../libraries/libraries/html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en', true, 'UTF-8', 0);
$pdf->WriteHTML($html);
$pdf->Output('Data Keuangan.pdf', 'D');
?>
