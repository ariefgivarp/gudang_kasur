-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2022 pada 06.22
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_kasur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_data_keuangan`
--

CREATE TABLE `gk_data_keuangan` (
  `id` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_uang` varchar(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nominal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_data_keuangan`
--

INSERT INTO `gk_data_keuangan` (`id`, `tanggal`, `kode_uang`, `keterangan`, `nominal`) VALUES
(1, '2022-05-14', 'DKU0001', 'Lem kasur', 500000),
(2, '2022-05-14', 'DKU0002', 'Busa', 50000000),
(3, '2022-05-14', 'DKU0003', 'Kayu', 4000000),
(4, '2022-05-15', 'DKU0004', 'Gaji', 30000000),
(5, '2022-05-15', 'DKU0005', 'Transportasi', 500000),
(6, '2022-05-16', 'DKU0006', 'kimia', 30000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_kasur`
--

CREATE TABLE `gk_kasur` (
  `id_kasur` int(5) NOT NULL,
  `tgl_input` date NOT NULL,
  `kode_kasur` varchar(10) NOT NULL,
  `nama_kasur` varchar(20) NOT NULL,
  `tipe_busa` varchar(20) NOT NULL,
  `ukuran_kasur` varchar(50) NOT NULL,
  `densiti_kasur` varchar(10) NOT NULL,
  `harga_awal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_kasur`
--

INSERT INTO `gk_kasur` (`id_kasur`, `tgl_input`, `kode_kasur`, `nama_kasur`, `tipe_busa`, `ukuran_kasur`, `densiti_kasur`, `harga_awal`, `harga_jual`, `satuan`, `stok`) VALUES
(20, '2022-05-16', 'KSR0001', 'Busa D8', 'Gres', 'G 190 x 140 x 28', '8', 300000, 310000, 'Pcs', 180),
(21, '2022-05-16', 'KSR0002', 'Busa D24', 'Gres', 'G 190 x 140 x 24', '24', 400000, 450000, 'Pcs', 180);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_kasur_keluar`
--

CREATE TABLE `gk_kasur_keluar` (
  `id` int(5) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_kasur` varchar(10) NOT NULL,
  `jumlah_keluar` varchar(10) NOT NULL,
  `pembayaran` varchar(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_kasur_keluar`
--

INSERT INTO `gk_kasur_keluar` (`id`, `kode_transaksi`, `tanggal_keluar`, `kode_kasur`, `jumlah_keluar`, `pembayaran`, `nama_pembeli`) VALUES
(9, 'TK-0001', '2022-05-16', 'KSR0001', '20', 'Lunas', 'Dodo'),
(10, 'TK-0002', '2022-05-16', 'KSR0002', '20', 'Belum Lunas', 'Arief');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_kasur_masuk`
--

CREATE TABLE `gk_kasur_masuk` (
  `id` int(5) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `kode_kasur` varchar(10) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_kasur_masuk`
--

INSERT INTO `gk_kasur_masuk` (`id`, `kode_transaksi`, `kode_kasur`, `tanggal_masuk`, `jumlah_masuk`) VALUES
(30, 'TM-0001', 'KSR0001', '2022-05-16', '200'),
(31, 'TM-0002', 'KSR0002', '2022-05-16', '200');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_pegawai`
--

CREATE TABLE `gk_pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `kode_pegawai` varchar(10) NOT NULL,
  `nama` char(30) NOT NULL,
  `ttl` varchar(20) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `posisi` char(20) NOT NULL,
  `gaji` int(10) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_pegawai`
--

INSERT INTO `gk_pegawai` (`id_pegawai`, `kode_pegawai`, `nama`, `ttl`, `jk`, `agama`, `alamat`, `no_telp`, `posisi`, `gaji`, `tgl_masuk`) VALUES
(4, 'PGW001', 'Insani', 'Purbalingga, 21 Mei', 'Laki-laki', 'Islam', 'Selabaya RT1 RW01, Kecamatan Kalimanah, Kabupaten Purbalingga', '089228447591', 'Kurir', 1600000, '2021-12-04'),
(5, 'PGW002', 'Arief Givar Prasetya', 'Purbalingga, 21 Mei ', 'Laki-laki', 'Islam', 'Selabaya RT1 RW01, Kecamatan Kalimanah, Kabupaten Purbalingga', '089228447591', 'Kurir', 1900000, '2020-02-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_pesanan`
--

CREATE TABLE `gk_pesanan` (
  `id_kasur` int(5) NOT NULL,
  `tgl_input` date NOT NULL,
  `kode_kasur` varchar(10) NOT NULL,
  `nama_kasur` varchar(20) NOT NULL,
  `tipe_busa` varchar(20) NOT NULL,
  `ukuran_kasur` varchar(50) NOT NULL,
  `densiti_kasur` varchar(10) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_pesanan`
--

INSERT INTO `gk_pesanan` (`id_kasur`, `tgl_input`, `kode_kasur`, `nama_kasur`, `tipe_busa`, `ukuran_kasur`, `densiti_kasur`, `nama_pembeli`, `harga_jual`, `satuan`, `stok`) VALUES
(6, '2022-05-16', 'PSN0001', 'Busa D8', 'Gres', 'T 190 x 140 x 18', '8', 'Dodo', 30000000, 'Pcs', 800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_pesanan_keluar`
--

CREATE TABLE `gk_pesanan_keluar` (
  `id` int(5) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_kasur` varchar(10) NOT NULL,
  `jumlah_keluar` int(10) NOT NULL,
  `pembayaran` varchar(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_pesanan_keluar`
--

INSERT INTO `gk_pesanan_keluar` (`id`, `kode_transaksi`, `tanggal_keluar`, `kode_kasur`, `jumlah_keluar`, `pembayaran`, `nama_pembeli`) VALUES
(4, 'PK-0001', '2022-05-16', 'PSN0001', 100, 'Lunas', 'Dodo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_supplier`
--

CREATE TABLE `gk_supplier` (
  `id_supplier` int(5) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `alamat_supplier` varchar(100) NOT NULL,
  `cp_supplier` varchar(13) NOT NULL,
  `harga_supplier` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_supplier`
--

INSERT INTO `gk_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `nama_barang`, `alamat_supplier`, `cp_supplier`, `harga_supplier`) VALUES
(1, 'SPR001', 'cv. bekoh tbk', 'Busa Memory Foam', 'Selabaya, RT1 RW1', '089777123423', '1500000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gk_users`
--

CREATE TABLE `gk_users` (
  `id_users` int(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `hak_akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gk_users`
--

INSERT INTO `gk_users` (`id_users`, `username`, `nama_user`, `password`, `telepon`, `hak_akses`) VALUES
(1, 'admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '082326139996', 'Manajer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gk_data_keuangan`
--
ALTER TABLE `gk_data_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gk_kasur`
--
ALTER TABLE `gk_kasur`
  ADD PRIMARY KEY (`id_kasur`);

--
-- Indeks untuk tabel `gk_kasur_keluar`
--
ALTER TABLE `gk_kasur_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gk_kasur_masuk`
--
ALTER TABLE `gk_kasur_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gk_pegawai`
--
ALTER TABLE `gk_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `gk_pesanan`
--
ALTER TABLE `gk_pesanan`
  ADD PRIMARY KEY (`id_kasur`);

--
-- Indeks untuk tabel `gk_pesanan_keluar`
--
ALTER TABLE `gk_pesanan_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gk_supplier`
--
ALTER TABLE `gk_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `gk_users`
--
ALTER TABLE `gk_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gk_data_keuangan`
--
ALTER TABLE `gk_data_keuangan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `gk_kasur`
--
ALTER TABLE `gk_kasur`
  MODIFY `id_kasur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `gk_kasur_keluar`
--
ALTER TABLE `gk_kasur_keluar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `gk_kasur_masuk`
--
ALTER TABLE `gk_kasur_masuk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `gk_pegawai`
--
ALTER TABLE `gk_pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gk_pesanan`
--
ALTER TABLE `gk_pesanan`
  MODIFY `id_kasur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `gk_pesanan_keluar`
--
ALTER TABLE `gk_pesanan_keluar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `gk_supplier`
--
ALTER TABLE `gk_supplier`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gk_users`
--
ALTER TABLE `gk_users`
  MODIFY `id_users` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
