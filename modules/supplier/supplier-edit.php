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
        <title>Gudang Kasur | Ubah Data Supplier</title>
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
                <h2 class="section-title">Ubah Data Supplier</h2>
                <button class="dropbtn"><a href="supplier.php" class="fa fa-undo"> Kembali</a></button>
                <form action="supplier-edit-aksi.php" method="POST">
                    <?php
                    include './../../config/koneksi.php';
                    require_once './../../config/fungsi_rupiah.php';

                    if (isset($_GET['id_supplier'])) {
                        $query = mysqli_query($koneksi,"select * from gk_supplier where id_supplier='$_GET[id_supplier]'") 
                                                        or die('Ada kesalahan pada query tampil Data  : '.mysqli_error($mysqli));
                        $d  = mysqli_fetch_assoc($query);
                      }
                        ?>
                        <form method="post" action="supplier-edit-aksi.php">
                        <table>
                        <tr>
                            <td>Kode Supplier</td>
                            <td><input type="text" name="kode_supplier" required="required" value="<?php echo $d['kode_supplier']; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Nama Supplier</td>
                            <td><input type="text" name="nama_supplier" value="<?php echo $d['nama_supplier']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="textarea" name="alamat_supplier" rows="4" cols="50" value="<?php echo $d['alamat_supplier']; ?>"></td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td><input type="text" name="cp_supplier" value="<?php echo $d['cp_supplier']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Harga Barang</td>
                            <td><span class="input-group-addon">Rp.</span>
                            <input type="numeric" class="form-control" id="harga_supplier" name="harga_supplier" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($d['harga_supplier']); ?>" required></td>
                        </tr>
                    </table>
                        <button type="submit" class="btn success" name="simpan">Submit</button>
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