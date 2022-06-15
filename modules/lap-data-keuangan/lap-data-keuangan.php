<?php
session_start();
if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='../../index.php'>Klik disini</a>";
	exit;
}

$id_user=$_SESSION["id_users"];
$username=$_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./../../assets/img/logo.png">
        <title>Gudang Kasur | Cetak Laporan</title>
        <link rel="stylesheet" href="./../../assets/css/style1.css">
        <link rel="stylesheet" href="./../../assets/responsive/responsive.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    
    
    
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Include file CSS Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Include library Bootstrap Datepicker -->
    <link href="./../../libraries/libraries/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Include File jQuery -->
    <script src="../../../libraries/js/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header>
            <div class="container">
                <div class="header-left">
                    <img class="logo" src="./../../assets/img/logo.png">
                    <button class="dropbtn"><a href="./../../modules/beranda/view.php" class="fa fa-home"> Beranda</a></button>
                    <div class="dropdown">
                        <button class="dropbtn"><span class="fa fa-file"> Input Data</span></button>
                            <div class="dropdown-content">
                                <a href="./../../modules/kasur/kasur.php">Data Kasur</a>
                                <a href="./../../modules/kasur-masuk/kasur-masuk.php">Data Kasur Masuk</a>
                                <a href="./../../modules/kasur-keluar/kasur-keluar.php">Data Kasur keluar</a>
                            </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"><span class="fa fa-print"> Laporan</span></button>
                        <div class="dropdown-content">
                                <a href="./../../modules/lap-kasur/lap-kasur.php">Laporan Kasur</a>
                                <a href="./../../modules/lap-kasur-masuk/lap-masuk.php">Laporan Kasur Masuk</a>
                                <a href="./../../modules/lap-kasur-keluar/lap-keluar.php">Laporan Kasur Keluar</a>
                            </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"><span class="fa fa-truck"> Pesanan</span></button>
                        <div class="dropdown-content">
                                <a href="./../../modules/pesanan/pesanan.php">Pesanan</a>
                                <a href="./../../modules/pesanan-keluar/pesanan-keluar.php">Pesanan Keluar</a>
                                <a href="./../../modules/lap-pesanan/lap-pesanan.php">Laporan Pesanan</a>
                            </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"><span class="fa fa-users"> Data</span></button>
                        <div class="dropdown-content">
                                <a href="./../../modules/supplier/supplier.php">Supplier</a>
                                <a href="./../../modules/users/users.php">Pegawai</a>
                            </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"><span class="fa fa-copy"> Lain-lain</span></button>
                        <div class="dropdown-content">
                                <a href="./../../modules/data-keuangan/data-keuangan.php">Data Keuangan</a>
                                <a href="./../../modules/lap-data-keuangan/lap-data-keuangan.php">Laporan Keuangan</a>
                            </div>
                    </div>
                </div>
                <div class="header-right">
                    <a href="./../../logout.php" class="fa fa-sign-out"> Log Out</a>
                </div>
            </div>
        </header>
        
        <div class="contact-form">
            <div class="container">
                <h2 class="section-title"><span class="fa fa-clone"> Laporan Kasur</h2>

                <form method="get" action="lap-data-keuangan.php">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>"  placeholder="Tanggal Awal" autocomplete="off">
                                    <span class="input-group-addon">s/d</span>
                                    <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>"  placeholder="Tanggal Akhir" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

                    <?php
                    if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                        echo '<a href="lap-data-keuangan.php" class="btn btn-default">RESET</a>';
                    ?>
                </form>

                <?php
                // Load file koneksi.php
                include './../../config/koneksi.php';

                $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

                if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
                    // Buat query untuk menampilkan semua data transaksi
                    $query = "SELECT * FROM gk_data_keuangan order by tanggal desc";
                    $url_cetak = "cetak.php";
                    $label = "Semua Data Transaksi";
                }else{ // Jika terisi
                    // Buat query untuk menampilkan data transaksi sesuai periode tanggal
                    $query = "SELECT * FROM gk_data_keuangan WHERE (tanggal BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
                    $url_cetak = "cetak.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
                    $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
                    $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
                    $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
                }
                ?>
                <hr />
                <h4 style="margin-bottom: 5px;"><b>Data Transaksi</b></h4>
                <?php echo $label ?><br />

                <div style="margin-top: 5px;">
                    <a href="<?php echo $url_cetak ?>">CETAK PDF</a>
                </div>

                <div class="table-responsive" style="margin-top: 10px;">
                    <table class="table table-bordered" id="tabel-data">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    echo "<td><label>Rp. </label>".$nominal."</td>";
                                    echo "</tr>";
                                }
                            }else{ // Jika data tidak ada
                                echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                            }
                            ?>
                        </tbody>
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

                                    
                                            echo "<th><label>Rp. </label>".$total."</t>";
                                    
                                }
                            }else{ // Jika data tidak ada
                                echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                            }
                            ?>
                                </tr>
                            </table>
                            
                </div>
            </div>

            <!-- Include File JS Bootstrap -->
            <script src="./../../libraries/js/bootstrap.min.js"></script>

            <!-- Include library Bootstrap Datepicker -->
            <script src="./../../libraries/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

            <!-- Include File JS Custom (untuk fungsi Datepicker) -->
            <script src="./../../libraries/js/custom.js"></script>

            <script>
            $(document).ready(function(){
                setDateRangePicker(".tgl_awal", ".tgl_akhir")
            })
            </script>
            <script>
                        $(document).ready(function(){
                            $('#tabel-data').DataTable();
                        });
                    </script>
</body>
</html>
