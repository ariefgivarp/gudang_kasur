<?php
session_start();
if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='../../index.php'>Klik disini</a>";
	exit;
}

$id_user=$_SESSION["id_users"];
$username=$_SESSION["username"];
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./../../assets/img/logo.png">
        <title>Gudang Kasur | Tambah Data Pegawai</title>
        <link rel="stylesheet" href="./../../assets/css/style1.css">
        <link rel="stylesheet" href="./../../assets/responsive/responsive.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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
                <h2 class="section-title">Tambah Data Pegawai</h2>
                <button class="dropbtn"><a href="users.php" class="fa fa-undo"> Kembali</a></button>

                <form method="post" action="users-tambah-aksi.php">
                <?php  
                        include './../../config/koneksi.php';
                        require_once './../../config/fungsi_rupiah.php';

                        $query = mysqli_query($koneksi, "SELECT max(kode_pegawai) as kodeTerbesar FROM gk_pegawai");
                        $data = mysqli_fetch_array($query);
                        $kodeBarang = $data['kodeTerbesar'];
                    
                        $urutan = (int) substr($kodeBarang, 4, 4);
                    
                        $urutan++;
                        $huruf = "PGW";
                        $kodeBarang = $huruf . sprintf("%04s", $urutan);
                        
                    ?>
                    <table>
                        <tr>
                            <td>Kode Pegawai</td>
                            <td><input type="text" name="kode_pegawai" required="required" value="<?php echo $kodeBarang ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><input type="text" name="nama"></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td><input type="text" name="ttl"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><select name="jk" id="jk" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td><select name="agama" id="agama" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>Islam</option>
                                <option>Kristen Katolik</option>
                                <option>Kristen Protestan</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                                <option>Khonghucu</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="textarea" name="alamat"></td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td><input type="text" name="no_telp"></td>
                        </tr>
                        <tr>
                            <td>Posisi</td>
                            <td><input type="text" name="posisi"></td>
                        </tr>
                        <tr>
                            <td>Gaji</td>
                            <td><span class="input-group-addon">Rp.</span>
                                <input type="numeric" class="form-control" id="gaji" name="gaji" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required></td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td><input type="date" name="tgl_masuk"></td>
                        </tr>
                    </table>
                        <button class="btn cancel" type="reset">Cancel</button>
                        <button type="submit" class="btn success" name="submit">Submit</button>
                </form>
            </div>
        </div>
        
        <div class="message-wrapper"></div>
        
        <footer>
        <div class="container">
                <img src="./../../assets/img/logo.png">
                <p>Copyright® 2022</p>
            </div>
        </footer> 
    </body>
</html>        