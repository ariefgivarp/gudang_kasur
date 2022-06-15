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
        <title>Gudang Kasur | Tambah Data Pesanan</title>
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
                <h2 class="section-title">Tambah Data Pesanan</h2>
                <button class="dropbtn"><a href="pesanan.php" class="fa fa-undo"> Kembali</a></button>

                <form method="post" action="pesanan-tambah-aksi.php">
                    <?php  
                        include './../../config/koneksi.php';
                        require_once './../../config/fungsi_rupiah.php';

                        $query = mysqli_query($koneksi, "SELECT max(kode_kasur) as kodeTerbesar FROM gk_pesanan");
                        $data = mysqli_fetch_array($query);
                        $kodeBarang = $data['kodeTerbesar'];
                    
                        $urutan = (int) substr($kodeBarang, 4, 4);
                    
                        $urutan++;
                        $huruf = "PSN";
                        $kodeBarang = $huruf . sprintf("%04s", $urutan);
                        
                    ?>
                    <table>
                        <tr>
                            <td>Kode Barang</td>
                            <td><input type="text" name="kode_kasur" required="required" value="<?php echo $kodeBarang ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Nama Kasur</td>
                            <td><input type="text" name="nama_kasur"></td>
                        </tr>
                        <tr>
                            <td>Tipe Busa</td>
                            <td><select name="tipe_busa" id="tipe_busa" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>Gres</option>
                                <option>Tempel</option>
                                <option>Lipat 2</option>
                                <option>Lipat 4</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Ukuran Kasur</td>
                            <td><select name="ukuran_kasur" id="ukuran_kasur" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                            <option>Single: 90 x 200 cm</option>
                                <option>Double: 120 x 200 cm</option>
                                <option>Double XL: 140 x 200 cm</option>
                                <option>Queen: 160 x 200 cm</option>
                                <option>King: 180 x 200 cm</option>
                                <option>Super King: 200 x 200 cm</option>
                                <option disabled selected>Gres</option>
                                <option>G 190 x 140 x 18</option>
                                <option>G 190 x 140 x 15</option>
                                <option>G 190 x 140 x 24</option>
                                <option>G 190 x 140 x 28</option>
                                <option>G 200 x 140 x 18</option>
                                <option>G 200 x 140 x 15</option>
                                <option>G 200 x 140 x 24</option>
                                <option>G 200 x 140 x 28</option>
                                <option disabled selected>Tempel</option>
                                <option>T 190 x 140 x 18</option>
                                <option>T 190 x 140 x 15</option>
                                <option>T 190 x 140 x 24</option>
                                <option>T 190 x 140 x 28</option>
                                <option disabled selected>Lipat 2</option>
                                <option>L2 180 x 70 10</option>
                                <option>L2 180 x 80 10</option>
                                <option>L2 180 x 90 10</option>
                                <option>L2 180 x 110 10</option>
                                <option>L2 180 x 120 10</option>
                                <option>L2 180 x 140 10</option>
                                <option disabled selected>Lipat 4</option>
                                <option>L4 180 x 90 x 10</option>
                                <option>L4 180 x 90 x 10</option>
                                <option>L4 180 x 90 x 10</option>
                                <option>L4 180 x 90 x 10</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Density Kasur</td>
                            <td><select name="densiti_kasur" id="densiti_kasur" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>6</option>
                                <option>8</option>
                                <option>10</option>
                                <option>12</option>
                                <option>14</option>
                                <option>16</option>
                                <option>18</option>
                                <option>20</option>
                                <option>24</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Nama Pembeli</td>
                            <td><input type="text" name="nama_pembeli"></td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td><span class="input-group-addon">Rp.</span>
                                <input type="numeric" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required></td>
                        </tr>
                        <tr>
                            <td>Satuan</td>
                            <td><select name="satuan" id="satuan" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>Pcs</option>
                                <option>Lusin</option>
                                </optgroup></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><input type="number" name="stok"></td>
                        </tr>
                        <input type="hidden" name="tgl_input" value="<?php echo date("d-m-Y"); ?>">
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