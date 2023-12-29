-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2018 pada 13.01
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_poskonter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `kd_barang` varchar(50) NOT NULL,
  `nama_b` varchar(200) NOT NULL,
  `harga_awal_b` int(15) NOT NULL,
  `harga_jual_b` int(15) NOT NULL,
  `stok_min_b` int(10) NOT NULL,
  `stok_b` int(5) NOT NULL,
  `unit_b` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kd_barang`, `nama_b`, `harga_awal_b`, `harga_jual_b`, `stok_min_b`, `stok_b`, `unit_b`) VALUES
(1, '001', 'CAS NOKIA N95 KW', 445500, 674500, 7, 498, 'PCS'),
(3, '003', 'CAS ROMANCE RM-CHR-R07', 130000, 130000, 7, 500, 'PCS'),
(4, '005', 'CAS SAMSUNG EDGE', 488500, 488500, 7, 499, 'PCS'),
(5, '002', 'CAS ROBOT RT-C04S DUAL USB', 435, 565000, 7, 2, 'PCS'),
(6, '004', 'CAS ROMANCE RM-CHR-R11', 99000, 2120000, 7, 500, 'PCS'),
(7, '006', 'CAS SAMSUNG I9000 DUS', 356400, 1670000, 7, 500, 'PCS'),
(8, '007', 'CAS SAMSUNG TRAVEL ADAPTER ORI', 1204000, 310000, 7, 500, 'PCS'),
(9, '008', 'CAS VIVAN DD01', 220000, 390000, 7, 500, 'PCS'),
(10, '009', 'CAS XIAOMI MI4C', 260250, 1722500, 7, 498, 'PCS'),
(11, '010', 'CAS XIOMI MI4C BESI ORI', 1424000, 350000, 7, 500, 'PCS'),
(12, '011', 'CHASING KARAKTER IPHONE ALL TIPE', 206500, 960000, 7, 500, 'PCS'),
(13, '012', 'CHASING KARAKTER OPPO ALL TIPE', 708000, 2743000, 7, 500, 'PCS'),
(14, '013', 'CHASING KARAKTER REDMI ALL TIPE', 2222500, 3738000, 5, 4, 'PCS'),
(15, '014', 'CHASING KARAKTER SAMSUNG ALL TIPE', 3009000, 799000, 7, 500, 'PCS'),
(16, '015', 'DESKTOP ADSS', 57000, 202500, 7, 500, 'PCS'),
(17, '016', 'DESKTOP HK', 148000, 4366500, 7, 500, 'PCS'),
(18, '017', 'FD SANDISK 8 GB', 4119750, 19322000, 7, 500, 'PCS'),
(19, '018', 'FD TOSHIBA 16 GB', 18038000, 3270000, 7, 7, 'PCS'),
(20, '019', 'FD TOSHIBA 32GB', 3144000, 21398000, 7, 500, 'PCS'),
(21, '020', 'FD TOSHIBA 8 GB', 19755500, 1627000, 7, 500, 'PCS'),
(22, '021', 'FD VANDISK 16 GB', 1364000, 2906000, 7, 500, 'PCS'),
(23, '022', 'FD VANDISK 4 GB', 1414000, 2756000, 7, 500, 'PCS'),
(24, '023', 'FD VANDISK 8GB V50', 72000, 84000, 7, 5, 'PCS'),
(25, '024', 'FISH EYE SUPER WIDE U004', 253000, 345000, 7, 500, 'PCS'),
(26, '025', 'HF ADIDAS AD-623', 25000, 40000, 7, 499, 'PCS'),
(27, '026', 'HF ADIDAS AD-621', 195000, 325000, 7, 500, 'PCS'),
(28, '027', 'HF ALL BRAND GJ 188', 465000, 606000, 7, 500, 'PCS'),
(29, '028', 'HF ANGEL', 180000, 204000, 7, 500, 'PCS'),
(30, '029', 'HF BANDO HD30 SOUND INTONE', 168000, 200000, 7, 500, 'PCS'),
(31, '030', 'HF BEATS BANDO', 760000, 952000, 7, 500, 'PCS'),
(32, '031', 'HF BLUETOOTH BRAND', 515000, 625000, 7, 500, 'PCS'),
(33, '032', 'HF BLUETOOTH VIVAN BT100', 135000, 225000, 7, 6, 'PCS'),
(34, '033', 'HF BRAND AT.028', 532000, 643000, 7, 6, 'PCS'),
(35, '034', 'HF BRAND CONVERSION', 23000, 30000, 7, 500, 'PCS'),
(36, '035', 'HF BRAND GJ 183', 270000, 450000, 7, 500, 'PCS'),
(37, '036', 'HF BRAND ORIHF BT KEONG', 912000, 980000, 7, 500, 'PCS'),
(38, '037', 'HF BT STN 16', 110000, 138000, 7, 500, 'PCS'),
(39, '038', 'HF BT STN 17', 115000, 148000, 7, 500, 'PCS'),
(40, '039', 'HF HIPPO', 73200, 108000, 7, 495, 'PCS'),
(41, '040', 'HF JBL BANDO', 144000, 195000, 7, 500, 'PCS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_p` varchar(100) NOT NULL,
  `jekel_p` enum('l','p') NOT NULL,
  `tempat_lahir_p` varchar(100) NOT NULL,
  `tgl_lahir_p` date NOT NULL,
  `alamat_p` text NOT NULL,
  `no_telp_p` varchar(20) NOT NULL,
  `foto_p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama_p`, `jekel_p`, `tempat_lahir_p`, `tgl_lahir_p`, `alamat_p`, `no_telp_p`, `foto_p`) VALUES
(2, 'ana', 'p', 'kudus', '2018-11-13', 'kudus, undaan', '0856787697', 'ana.jpg'),
(3, 'Maula', 'l', 'kudus', '2018-12-12', 'aa', '546536464', 'Untitled-2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `harga_awal_b` int(15) NOT NULL,
  `harga_jual_b` int(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jumlah` int(15) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `harga_awal_b`, `harga_jual_b`, `id_barang`, `tgl_penjualan`, `jumlah`, `sub_total`) VALUES
('TRS-1542895086', 0, 260250, 1722500, 10, '2018-09-13', 2, 3445000),
('TRS-1542895142', 0, 25000, 40000, 26, '2018-09-12', 1, 40000),
('TRS-1542895277', 0, 73200, 108000, 40, '2018-11-22', 3, 324000),
('TRS-1542895279', 0, 73200, 108000, 40, '2018-11-26', 2, 216000),
('TRS-1543246316', 0, 72000, 84000, 24, '2018-11-26', 2, 168000),
('TRS-1543390541', 8, 445500, 674500, 1, '2018-11-28', 2, 1349000),
('TRS-1543392386', 8, 488500, 488500, 4, '2018-11-28', 1, 488500);

--
-- Trigger `tb_transaksi`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `tb_transaksi` FOR EACH ROW BEGIN
	UPDATE tb_barang set stok_b = stok_b + OLD.jumlah WHERE
    id_barang=OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaki` AFTER INSERT ON `tb_transaksi` FOR EACH ROW BEGIN
	update tb_barang set stok_b = stok_b - NEW.jumlah
    where id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(7, 'admin', '12345', 'Maula', 'admin'),
(8, 'ichl', 'ichl', 'Ichl Amal', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
