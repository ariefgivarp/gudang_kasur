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
        <title>Gudang Kasur | Pesanan</title>
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
                <h2 class="section-title"><span class="fa fa-folder"> Data Pesanan Kasur</h2>
                <button class="dropbtn"><a href="pesanan-tambah.php" class="fa fa-plus"> Tambah Data</a></button>
                <table id="tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama kasur</th>
                            <th>Tipe Busa</th>
                            <th>Ukuran</th>
                            <th>Density</th>
                            <th>Nama Pembeli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include './../../config/koneksi.php';
                        require_once './../../config/fungsi_rupiah.php';
                        $no= 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM gk_pesanan ORDER BY id_kasur DESC");
                        while($d = mysqli_fetch_array($data)){
                            $harga_jual = format_rupiah($d['harga_jual']);
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['kode_kasur']; ?></td>
                                <td><?php echo $d['nama_kasur']; ?></td>
                                <td><?php echo $d['tipe_busa']; ?></td>
                                <td><?php echo $d['ukuran_kasur']; ?></td>
                                <td><?php echo $d['densiti_kasur']; ?></td>
                                <td><?php echo $d['nama_pembeli']; ?></td>
                                <td><label>Rp. </label><?php echo $harga_jual; ?></td>
                                <td><?php echo $d['satuan']; ?></td>
                                <td><?php echo $d['stok']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="edit" href="pesanan-edit.php?id_kasur=<?php echo $d['id_kasur']; ?>"><span class="fa fa-pencil-square"></span></a>
                                    
                                    <a data-toggle="tooltip" data-placement="top" title="Hapus" href="pesanan-hapus.php?id_kasur=<?php echo $d['id_kasur']; ?>"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                            <?php 
                        }
                        ?>
                    </tbody>

                    <script>
                        $(document).ready(function(){
                            $('#tabel-data').DataTable();
                        });
                    </script>

                </table>
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