-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 08:21 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tb_barang`
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
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kd_barang`, `nama_b`, `harga_awal_b`, `harga_jual_b`, `stok_min_b`, `stok_b`, `unit_b`) VALUES
(42, 'A001', 'Baju Gamis', 12000, 40000, 7, 28, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
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
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama_p`, `jekel_p`, `tempat_lahir_p`, `tgl_lahir_p`, `alamat_p`, `no_telp_p`, `foto_p`) VALUES
(2, 'ana', 'p', 'kudus', '2018-11-13', 'kudus, undaan', '0856787697', 'ana.jpg'),
(3, 'Maula', 'l', 'kudus', '2018-12-12', 'aa', '546536464', 'Untitled-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
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
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `harga_awal_b`, `harga_jual_b`, `id_barang`, `tgl_penjualan`, `jumlah`, `sub_total`) VALUES
('TRS-1603298513', 8, 12000, 40000, 42, '2020-10-21', 2, 80000);

--
-- Triggers `tb_transaksi`
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
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(7, 'admin', '12345', 'Maula', 'admin'),
(8, 'ichl', 'ichl', 'Ichl Amal', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
