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
        <title>Gudang Kasur | Data Pesanan Keluar</title>
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
                <h2 class="section-title"><span class="fa fa-sign-out"> Data Pesanan Keluar</h2>
                <table id="tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal keluar</th>
                            <th>Kode Kasur</th>
                            <th>Jumlah Keluar</th>
                            <th>Nama Pembeli</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        include './../../config/koneksi.php';
                        $no= 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM gk_pesanan_keluar ORDER BY id DESC");
                        while($d = mysqli_fetch_array($data)){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['kode_transaksi']; ?></td>
                                <td><?php echo $d['tanggal_keluar']; ?></td>
                                <td><?php echo $d['kode_kasur']; ?></td>
                                <td><?php echo $d['jumlah_keluar']; ?></td>
                                <td><?php echo $d['nama_pembeli']; ?></td>
                                <td><?php echo $d['pembayaran']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="edit" href="pesanan-keluar-edit.php?id=<?php echo $d['id']; ?>"><span class="fa fa-pencil-square"></span></a>
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
                <div class="message-wrapper"></div>
                <h2 class="section-title"><span class="fa fa-sign-out"> Form Kasur Keluar</h2>
                <form action="pesanan-keluar-aksi.php" method="POST">
                    <?php
                        $query = mysqli_query($koneksi, "SELECT max(kode_transaksi) as kodeTerbesar FROM gk_pesanan_keluar");
                        $data = mysqli_fetch_array($query);
                        $kodeBarang = $data['kodeTerbesar'];
                    
                        $urutan = (int) substr($kodeBarang, 4, 4);
                    
                        $urutan++;
                        $huruf = "PK-";
                        $kodeBarang = $huruf . sprintf("%04s", $urutan);
                    ?>
                    <table width="530" border="0">
                        <tr>
                        <tr>
                            <td>Kode Transaksi</td>
                            <td><input type="text" name="kode_transaksi" value="<?php echo $kodeBarang ?>" readonly required /></td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td><input type="text" name="tanggal_keluar" value="<?php echo date("d-m-Y"); ?>" readonly required></td>
                        </tr>
                            <td>Pilih Barang</td>
                            <td>
                                <?php
                                $selBar	=mysqli_query($koneksi, "SELECT * FROM gk_pesanan ORDER BY kode_kasur");        
                                echo '<select name="kode_kasur" required class="select_value">';    
                                echo '<option value="">...</option>';    
                                while ($rowbar = mysqli_fetch_array($selBar)) {    
                                echo '<option value="'.$rowbar['kode_kasur'].'">'.$rowbar['kode_kasur'].' | '.$rowbar['nama_kasur'].'</option>';    
                                }    
                                echo '</select>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td><input type="text" name="jumlah_keluar" maxlength="11" required /></td>
                        </tr>
                        <td>Nama Pembeli</td>
                            <td>
                                <?php
                                $selBar	=mysqli_query($koneksi, "SELECT * FROM gk_pesanan ORDER BY nama_pembeli");        
                                echo '<select name="nama_pembeli" required class="select_value">';    
                                echo '<option value="">...</option>';    
                                while ($rowbar = mysqli_fetch_array($selBar)) {    
                                echo '<option value="'.$rowbar['nama_pembeli'].'">'.$rowbar['nama_pembeli'].'</option>';    
                                }    
                                echo '</select>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td><select name="pembayaran" id="pembayaran" class="select_value" data-placeholder="-- Pilih --" autocomplete="off" required>
                                <option>Lunas</option>
                                <option>Belum Lunas</option>
                                </optgroup></td>
                        </tr>
                        <tr height="36">
                            <td></td>
                            <td><input type="submit" name="Submit" value="Submit"/> <input type="reset" value="Reset"/></td>
                        </tr>
                    </table>
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