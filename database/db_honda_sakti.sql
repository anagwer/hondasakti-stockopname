-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 07:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_honda_sakti`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `hrg_beli` int(20) NOT NULL,
  `hrg_jual` int(20) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `stok`, `hrg_beli`, `hrg_jual`, `tgl`) VALUES
(1, 'Beras 5 kg', 25, 67000, 70000, '2024-05-21 08:42:57'),
(2, 'Minyak 1 Liter', 9, 80000, 40000, '2024-05-29 20:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `detailbeli`
--

CREATE TABLE `detailbeli` (
  `id_detailbeli` int(11) NOT NULL,
  `no_nota` varchar(11) NOT NULL,
  `id_beli` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL,
  `hrg_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailbeli`
--

INSERT INTO `detailbeli` (`id_detailbeli`, `no_nota`, `id_beli`, `id_barang`, `jml_beli`, `hrg_beli`) VALUES
(6, '1', 1, 1, 2, 65000),
(7, '1', 1, 2, 3, 38000),
(12, 'A23', 2, 2, 2, 80000),
(20, '-', 3, 2, 6, 56000),
(22, '-', 3, 1, 5, 56000),
(23, '-', 5, 2, 1, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `detailjual`
--

CREATE TABLE `detailjual` (
  `id_detailjual` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_nota_jual` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailjual`
--

INSERT INTO `detailjual` (`id_detailjual`, `id_barang`, `hrg_jual`, `jml_beli`, `diskon`, `id_user`, `no_nota_jual`) VALUES
(6, 1, 0, 2, 0, 1, '1'),
(15, 1, 70000, 5, 35000, 1, '4'),
(16, 1, 70000, 3, 0, 1, '5'),
(17, 2, 40000, 3, 0, 1, '5'),
(18, 1, 70000, 2, 0, 1, '6');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_beli` int(11) NOT NULL,
  `no_nota` varchar(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_beli`, `no_nota`, `tgl`, `total`) VALUES
(1, 'N1', '2024-06-03 00:35:39', 244000),
(2, 'A23', '2024-06-26 00:19:06', 160000),
(3, '-', '2024-06-27 13:49:13', 0),
(4, '-', '2025-07-10 16:41:27', 0),
(5, '-', '2025-07-10 16:44:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `nota` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('-','Member','Non-Member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nota`, `total`, `tgl`, `status`) VALUES
(4, 315000, '2024-06-26 16:15:24', 'Member'),
(5, 330000, '2024-06-27 12:32:40', 'Non-Member'),
(6, 0, '2025-07-10 16:41:05', '-');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `foto`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'images.jpg'),
(2, 'pemilik', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'Pemilik', 'images.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detailbeli`
--
ALTER TABLE `detailbeli`
  ADD PRIMARY KEY (`id_detailbeli`);

--
-- Indexes for table `detailjual`
--
ALTER TABLE `detailjual`
  ADD PRIMARY KEY (`id_detailjual`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detailbeli`
--
ALTER TABLE `detailbeli`
  MODIFY `id_detailbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detailjual`
--
ALTER TABLE `detailjual`
  MODIFY `id_detailjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
