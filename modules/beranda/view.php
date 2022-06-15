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
        <title>Gudang Kasur | Beranda</title>
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
                <h2 class="section-title"><span class="fa fa-home"> Beranda</span></h2><span align="right">Selamat Datang <?php echo $_SESSION['nama_user']; ?>!
            </div>
        </div>
        
        <div class="lesson-wrapper">
            <div class="container">
                <div class="lessons">
                    <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#5F7161;color:#fff" class="small-box">
                                    <img src="./../../assets/img/folder(1).png" width="100" height="100">
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_kasur) as jumlah FROM gk_kasur");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Kasur</p>
                                            <?php 
                                        }
                                        ?>
                                                
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#6D8B74;color:#fff" class="small-box">
                                    <img src="./../../assets/img/file(1).png" width="100" height="100">
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_transaksi) as jumlah FROM gk_kasur_masuk");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Kasur Masuk</p>
                                            <?php 
                                        }
                                        ?>
                                                
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                            </div>
                    </div>
                </div>
                <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#EFEAD8;color:#fff" class="small-box">
                                    <img src="./../../assets/img/file(2).png" width="100" height="100">
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_transaksi) as jumlah FROM gk_kasur_keluar");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Kasur Keluar</p>
                                            <?php 
                                        }
                                        ?>
                                               
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
                </div>
                <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#D0C9C0;color:#fff" class="small-box">
                                    <img src="./../../assets/img/file(3).png" width="100" height="100">
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_kasur) as jumlah FROM gk_pesanan");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Pesanan Khusus</p>
                                            <?php 
                                        }
                                        ?>
                                                
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Cetak Data" data-toggle="tooltip"><i class="fa fa-print"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
                </div>
                <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#BB9981;color:#fff" class="small-box">
                                    <img src="./../../assets/img/delivery-truck.png" width="100" height="100">
                                    
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_supplier) as jumlah FROM gk_supplier");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Supplier</p>
                                            <?php 
                                        }
                                        ?>
                                               
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Cetak Data" data-toggle="tooltip"><i class="fa fa-print"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                                    </div>
                            </div>
                        </div>
                        <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#534340;color:#fff" class="small-box">
                                    <img src="./../../assets/img/user.png" width="100" height="100">
                                    
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_pegawai) as jumlah FROM gk_pegawai");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Pegawai</p>
                                            <?php 
                                        }
                                        ?>
                                               
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Cetak Data" data-toggle="tooltip"><i class="fa fa-print"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                                    </div>
                            </div>
                        </div>
                        <div class="lesson">
                        <div class="lesson-icon">
                            <div style="background-color:#9D5353;color:#fff" class="small-box">
                                    <img src="./../../assets/img/dollar.png" width="100" height="100">
                                    
                                    <?php 
                                        include './../../config/koneksi.php';
                                        $data = mysqli_query($koneksi,"SELECT COUNT(kode_uang) as jumlah FROM gk_data_keuangan");
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                                <h1><?php echo $d['jumlah']; ?></h1>
                                                <p>Data Keuangan</p>
                                            <?php 
                                        }
                                        ?>
                                               
                                <?php  
                                    if ($_SESSION['hak_akses']!='Manajer') { ?>
                                        <a href="?module=form_helm&form=add" class="small-box-footer" title="Cetak Data" data-toggle="tooltip"><i class="fa fa-print"></i></a>
                                    <?php
                                    } else { ?>
                                        <a class="small-box-footer"><i class="fa"></i></a>
                                    <?php
                                    }
                                    ?>
                                    </div>
                            </div>
                        </div>
                </div>
                <div class="clear"></div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <img src="./../../assets/img/logo.png">
                <p>Copyright® 2022</p>
            </div>
        </footer> 
    </body>
</html>        