-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 11:10 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uptfarmasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `gudangsatelit`
--

CREATE TABLE `gudangsatelit` (
  `IdGudangSatelit` int(16) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `IdObat` int(16) NOT NULL,
  `IdSatelit` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudangsatelit`
--

INSERT INTO `gudangsatelit` (`IdGudangSatelit`, `Jumlah`, `Tanggal`, `IdObat`, `IdSatelit`) VALUES
(1, 5, '2021-01-01', 1, 1),
(2, 5, '2021-01-01', 1, 2),
(3, 5, '2021-01-01', 1, 3),
(4, 5, '2021-01-01', 1, 4),
(5, 5, '2021-01-01', 1, 5),
(6, 5, '2021-01-01', 2, 1),
(7, 5, '2021-01-01', 2, 2),
(8, 5, '2021-01-01', 2, 3),
(9, 5, '2021-01-01', 2, 4),
(10, 5, '2021-01-01', 2, 5),
(11, 5, '2021-01-01', 3, 1),
(12, 5, '2021-01-01', 3, 2),
(13, 5, '2021-01-01', 3, 3),
(14, 5, '2021-01-01', 3, 4),
(15, 5, '2021-01-01', 3, 5),
(16, 5, '2021-01-02', 1, 1),
(17, 5, '2021-01-02', 1, 2),
(18, 5, '2021-01-02', 1, 3),
(19, 5, '2021-01-02', 1, 4),
(20, 5, '2021-01-02', 1, 5),
(21, 5, '2021-01-02', 2, 1),
(22, 5, '2021-01-02', 2, 2),
(23, 5, '2021-01-02', 2, 3),
(24, 5, '2021-01-02', 2, 4),
(25, 5, '2021-01-02', 2, 5),
(26, 5, '2021-01-02', 3, 1),
(27, 5, '2021-01-02', 3, 2),
(28, 5, '2021-01-02', 3, 3),
(29, 5, '2021-01-02', 3, 4),
(30, 5, '2021-01-01', 3, 5),
(31, 5, '2021-02-01', 1, 1),
(32, 5, '2021-02-01', 1, 2),
(33, 5, '2021-02-01', 1, 3),
(34, 5, '2021-02-01', 1, 4),
(35, 5, '2021-02-01', 1, 5),
(36, 5, '2021-02-01', 2, 1),
(37, 5, '2021-02-01', 2, 2),
(38, 5, '2021-02-01', 2, 3),
(39, 5, '2021-02-01', 2, 4),
(40, 5, '2021-02-01', 2, 5),
(41, 5, '2021-02-01', 3, 1),
(42, 5, '2021-02-01', 3, 2),
(43, 5, '2021-02-01', 3, 3),
(44, 5, '2021-02-01', 3, 4),
(45, 5, '2021-02-01', 3, 5),
(46, 5, '2021-02-01', 1, 1),
(47, 5, '2021-02-01', 1, 2),
(48, 5, '2021-02-01', 1, 3),
(49, 5, '2021-02-01', 1, 4),
(50, 5, '2021-02-01', 1, 5),
(51, 5, '2021-02-01', 2, 1),
(52, 5, '2021-02-01', 2, 2),
(53, 5, '2021-02-01', 2, 3),
(54, 5, '2021-02-01', 2, 4),
(55, 5, '2021-02-01', 2, 5),
(56, 5, '2021-02-01', 3, 1),
(57, 5, '2021-02-01', 3, 2),
(58, 5, '2021-02-01', 3, 3),
(59, 5, '2021-02-01', 3, 4),
(60, 5, '2021-02-01', 3, 5),
(65, 5, '2021-08-13', 2, 1),
(66, 5, '2020-12-29', 1, 1),
(67, 5, '2020-12-26', 1, 1),
(69, 5, '2021-02-27', 1, 1),
(70, 5, '2021-04-01', 1, 1),
(71, 5, '2021-08-14', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gudangsatelitrekap`
--

CREATE TABLE `gudangsatelitrekap` (
  `IdGudangSatelitRekap` int(16) NOT NULL,
  `StokAktif` int(11) NOT NULL,
  `Penerimaan` int(11) NOT NULL,
  `SisaStok` int(11) NOT NULL,
  `IdGudangSatelit` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gudangupt`
--

CREATE TABLE `gudangupt` (
  `IdGudangUpt` int(16) NOT NULL,
  `Dinkes` int(11) NOT NULL,
  `Blud` int(11) NOT NULL,
  `Tanggal` date DEFAULT NULL,
  `IdObat` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudangupt`
--

INSERT INTO `gudangupt` (`IdGudangUpt`, `Dinkes`, `Blud`, `Tanggal`, `IdObat`) VALUES
(1, 10, 20, '2020-12-26', 1),
(2, 20, 10, '2021-01-01', 2),
(3, 10, 10, '2021-01-01', 3),
(4, 10, 10, '2021-02-02', 1),
(5, 10, 10, '2021-02-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `IdObat` int(16) NOT NULL,
  `NamaObat` varchar(100) NOT NULL,
  `SatuanObat` varchar(11) NOT NULL,
  `HargaObat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`IdObat`, `NamaObat`, `SatuanObat`, `HargaObat`) VALUES
(1, 'Obat Penurun Panas', 'tube', 2000),
(2, 'Obat Nyeri Tulang', 'tablet', 5000),
(3, 'Obat Penurun Pusing', 'tablet', 2000),
(4, 'Obat Penurun Nyeri Kepala', 'tablet', 3000),
(5, 'Obat Sakit Kaki', 'botol', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `satelit`
--

CREATE TABLE `satelit` (
  `IdSatelit` int(16) NOT NULL,
  `NamaSatelit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satelit`
--

INSERT INTO `satelit` (`IdSatelit`, `NamaSatelit`) VALUES
(1, 'Satelit A'),
(2, 'Satelit B'),
(3, 'Satelit C'),
(4, 'Satelit D'),
(5, 'Satelit E');

-- --------------------------------------------------------

--
-- Table structure for table `satelitmutasi`
--

CREATE TABLE `satelitmutasi` (
  `IdTransaksiSatelit` int(16) NOT NULL,
  `MutasiKeluar` int(11) NOT NULL,
  `MutasiRusak` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `IdSatelit` int(16) NOT NULL,
  `IdObat` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satelitmutasi`
--

INSERT INTO `satelitmutasi` (`IdTransaksiSatelit`, `MutasiKeluar`, `MutasiRusak`, `Tanggal`, `IdSatelit`, `IdObat`) VALUES
(1, 2, 1, '2021-01-01', 1, 1),
(2, 1, 0, '2021-01-01', 1, 2),
(3, 2, 0, '2021-01-01', 1, 3),
(4, 2, 0, '2021-01-01', 2, 3),
(5, 2, 0, '2020-01-01', 1, 3),
(6, 2, 0, '2020-01-01', 1, 1),
(7, 2, 0, '2020-02-01', 1, 1),
(9, 2, 1, '2020-12-30', 1, 1),
(10, 2, 0, '2021-02-01', 1, 1),
(11, 2, 1, '2021-02-10', 1, 1),
(14, 5, 0, '2021-08-24', 1, 1),
(15, 5, 0, '2021-07-22', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gudangsatelit`
--
ALTER TABLE `gudangsatelit`
  ADD PRIMARY KEY (`IdGudangSatelit`),
  ADD KEY `IdObat` (`IdObat`,`IdSatelit`),
  ADD KEY `IdSatelit` (`IdSatelit`);

--
-- Indexes for table `gudangsatelitrekap`
--
ALTER TABLE `gudangsatelitrekap`
  ADD PRIMARY KEY (`IdGudangSatelitRekap`),
  ADD KEY `IdGudangSatelit` (`IdGudangSatelit`);

--
-- Indexes for table `gudangupt`
--
ALTER TABLE `gudangupt`
  ADD PRIMARY KEY (`IdGudangUpt`),
  ADD KEY `IdObat` (`IdObat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`IdObat`);

--
-- Indexes for table `satelit`
--
ALTER TABLE `satelit`
  ADD PRIMARY KEY (`IdSatelit`);

--
-- Indexes for table `satelitmutasi`
--
ALTER TABLE `satelitmutasi`
  ADD PRIMARY KEY (`IdTransaksiSatelit`),
  ADD KEY `IdSatelit` (`IdSatelit`,`IdObat`),
  ADD KEY `IdObat` (`IdObat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gudangsatelit`
--
ALTER TABLE `gudangsatelit`
  MODIFY `IdGudangSatelit` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `gudangsatelitrekap`
--
ALTER TABLE `gudangsatelitrekap`
  MODIFY `IdGudangSatelitRekap` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudangupt`
--
ALTER TABLE `gudangupt`
  MODIFY `IdGudangUpt` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `IdObat` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `satelit`
--
ALTER TABLE `satelit`
  MODIFY `IdSatelit` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satelitmutasi`
--
ALTER TABLE `satelitmutasi`
  MODIFY `IdTransaksiSatelit` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gudangsatelit`
--
ALTER TABLE `gudangsatelit`
  ADD CONSTRAINT `gudangsatelit_ibfk_1` FOREIGN KEY (`IdObat`) REFERENCES `obat` (`IdObat`),
  ADD CONSTRAINT `gudangsatelit_ibfk_2` FOREIGN KEY (`IdSatelit`) REFERENCES `satelit` (`IdSatelit`);

--
-- Constraints for table `gudangsatelitrekap`
--
ALTER TABLE `gudangsatelitrekap`
  ADD CONSTRAINT `gudangsatelitrekap_ibfk_1` FOREIGN KEY (`IdGudangSatelit`) REFERENCES `gudangsatelit` (`IdGudangSatelit`);

--
-- Constraints for table `gudangupt`
--
ALTER TABLE `gudangupt`
  ADD CONSTRAINT `gudangupt_ibfk_1` FOREIGN KEY (`IdObat`) REFERENCES `obat` (`IdObat`);

--
-- Constraints for table `satelitmutasi`
--
ALTER TABLE `satelitmutasi`
  ADD CONSTRAINT `satelitmutasi_ibfk_1` FOREIGN KEY (`IdObat`) REFERENCES `obat` (`IdObat`),
  ADD CONSTRAINT `satelitmutasi_ibfk_2` FOREIGN KEY (`IdSatelit`) REFERENCES `satelit` (`IdSatelit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
