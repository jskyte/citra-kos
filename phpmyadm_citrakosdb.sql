-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 01:49 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmyadm_citrakosdb`
--
CREATE DATABASE IF NOT EXISTS `phpmyadm_citrakosdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpmyadm_citrakosdb`;

-- --------------------------------------------------------

--
-- Table structure for table `data_print_kuitansi`
--

CREATE TABLE `data_print_kuitansi` (
  `No_Kamar` varchar(255) NOT NULL,
  `Nama` text NOT NULL,
  `Harga` int(12) NOT NULL,
  `idPembayaran` int(12) NOT NULL,
  `Tgl_Kui` date NOT NULL,
  `Category_Tempat` varchar(255) NOT NULL,
  `Tgl_Byr` date NOT NULL,
  `Tgl_Approve` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_print_kuitansi`
--

INSERT INTO `data_print_kuitansi` (`No_Kamar`, `Nama`, `Harga`, `idPembayaran`, `Tgl_Kui`, `Category_Tempat`, `Tgl_Byr`, `Tgl_Approve`) VALUES
('B Extra', 'Jamal', 425000, 1, '2020-12-16', 'Pinggir Kali', '2020-11-29', '2020-11-29'),
('B11', 'Sodara Wahyu', 500000, 2, '2020-11-27', 'Pinggir Kali', '2020-11-30', '2020-11-30'),
('B4', 'PENDI', 600000, 3, '2020-12-16', 'Pinggir Kali', '2020-11-30', '2020-11-30'),
('GHH01', 'Tommy', 4250000, 4, '2020-12-19', 'Karina Sayang', '2020-11-30', '2020-11-30'),
('GHY01', 'Frederick', 225000, 1, '2020-12-18', 'Pinggir Kali', '2020-11-29', '2020-11-29'),
('ITY78', 'Try Sutrisno', 725000, 2, '2020-11-27', 'Borobudur', '2020-11-30', '2020-11-30'),
('JKR998', 'Hendrawan', 730000, 3, '2020-12-10', 'Karina Sayang', '2020-11-30', '2020-11-30'),
('KJC1', 'Firdaus', 3500000, 3, '2020-12-25', 'Widara', '2020-11-30', '2020-11-30'),
('L87', 'Gugun', 1780000, 4, '2020-12-12', 'Widara', '0000-00-00', '0000-00-00'),
('LYT665', 'Susiana', 669000, 1, '2020-12-17', 'Pinggir Kali', '0000-00-00', '0000-00-00'),
('OHJ8822', 'Roberto', 385000, 1, '2020-12-25', 'Karina Sayang', '0000-00-00', '0000-00-00'),
('OPP889', 'Gesang', 475000, 2, '2020-12-15', 'Widara', '0000-00-00', '0000-00-00'),
('P02', 'Juneha', 2250000, 2, '2020-12-18', 'Sinar Budi', '0000-00-00', '0000-00-00'),
('P77', 'Juliana', 845000, 2, '2020-12-09', 'Jelambar Baru', '0000-00-00', '0000-00-00'),
('PH01', 'Rosalina', 665000, 3, '2020-12-30', 'Pinggir Kali', '0000-00-00', '0000-00-00'),
('PK01', 'Gunawan', 1345000, 3, '2020-12-15', 'Sinar Budi', '0000-00-00', '0000-00-00'),
('RRW01', 'Buntoro', 1785000, 4, '2020-12-30', 'Widara', '0000-00-00', '0000-00-00'),
('TYS88', 'Yono', 227450, 4, '2020-12-24', 'Borobudur', '0000-00-00', '0000-00-00'),
('X01', 'Alfonso', 1250000, 4, '2020-12-18', 'Karina Sayang', '0000-00-00', '0000-00-00'),
('YYT778', 'Husein', 480000, 4, '2020-12-18', 'Karina Sayang', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hstry_data_print_kuitansi`
--

CREATE TABLE `hstry_data_print_kuitansi` (
  `No_Kamar` varchar(255) NOT NULL,
  `Nama` text NOT NULL,
  `Pembayaran` text NOT NULL,
  `Harga` int(12) NOT NULL,
  `Tgl_Kui` date NOT NULL,
  `Category_Tempat` text NOT NULL,
  `Tgl_Byr` date NOT NULL,
  `Tgl_otorisasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hstry_data_print_kuitansi`
--

INSERT INTO `hstry_data_print_kuitansi` (`No_Kamar`, `Nama`, `Pembayaran`, `Harga`, `Tgl_Kui`, `Category_Tempat`, `Tgl_Byr`, `Tgl_otorisasi`) VALUES
('B Extra', 'Jamal', '1', 425000, '2020-12-16', 'Pinggir Kali', '2020-11-29', '2020-11-29'),
('B11', 'Sodara Wahyu', '2', 500000, '2020-11-27', 'Pinggir Kali', '2020-11-30', '2020-11-30'),
('B4', 'PENDI', '3', 600000, '2020-12-16', 'Pinggir Kali', '2020-11-30', '2020-11-30'),
('GHH01', 'Tommy', '4', 4250000, '2020-12-19', 'Karina Sayang', '2020-11-30', '2020-11-30'),
('GHY01', 'Frederick', '1', 225000, '2020-12-18', 'Pinggir Kali', '2020-11-29', '2020-11-29'),
('ITY78', 'Try Sutrisno', '2', 725000, '2020-11-27', 'Borobudur', '2020-11-30', '2020-11-30'),
('JKR998', 'Hendrawan', '3', 730000, '2020-12-10', 'Karina Sayang', '2020-11-30', '2020-11-30'),
('KJC1', 'Firdaus', '3', 3500000, '2020-12-25', 'Widara', '2020-11-30', '2020-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `jenispembayaran`
--

CREATE TABLE `jenispembayaran` (
  `idPembayaran` int(12) NOT NULL,
  `jenisPemb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenispembayaran`
--

INSERT INTO `jenispembayaran` (`idPembayaran`, `jenisPemb`) VALUES
(1, 'Kamar Kos'),
(2, 'Kamar Kos + AC'),
(3, 'Kamar Kos + Kulkas'),
(4, 'Kamar Kos + Kulkas + AC');

-- --------------------------------------------------------

--
-- Table structure for table `lokasikerjauser`
--

CREATE TABLE `lokasikerjauser` (
  `idUser` varchar(12) NOT NULL DEFAULT '',
  `lokasiKos` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasikerjauser`
--

INSERT INTO `lokasikerjauser` (`idUser`, `lokasiKos`) VALUES
('user02', 'Borobudur'),
('user02', 'Jelambar Baru'),
('user03', 'Karina Sayang'),
('user03', 'Pinggir Kali');

-- --------------------------------------------------------

--
-- Table structure for table `lokasiproperti`
--

CREATE TABLE `lokasiproperti` (
  `lokasiKos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasiproperti`
--

INSERT INTO `lokasiproperti` (`lokasiKos`) VALUES
('Borobudur'),
('Jelambar Baru'),
('Karina Sayang'),
('Pinggir Kali'),
('Sinar Budi'),
('Widara');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` varchar(12) NOT NULL,
  `namaUser` text NOT NULL,
  `pinUser` int(11) NOT NULL,
  `roleUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `namaUser`, `pinUser`, `roleUser`) VALUES
('user01', 'Andre', 1234, 'Owner'),
('user02', 'Andini', 1234, 'Kasir'),
('user03', 'Agus', 1234, 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_print_kuitansi`
--
ALTER TABLE `data_print_kuitansi`
  ADD PRIMARY KEY (`No_Kamar`),
  ADD KEY `idPembayaran` (`idPembayaran`),
  ADD KEY `Category_Tempat` (`Category_Tempat`);

--
-- Indexes for table `hstry_data_print_kuitansi`
--
ALTER TABLE `hstry_data_print_kuitansi`
  ADD PRIMARY KEY (`No_Kamar`);

--
-- Indexes for table `jenispembayaran`
--
ALTER TABLE `jenispembayaran`
  ADD PRIMARY KEY (`idPembayaran`);

--
-- Indexes for table `lokasikerjauser`
--
ALTER TABLE `lokasikerjauser`
  ADD PRIMARY KEY (`idUser`,`lokasiKos`),
  ADD KEY `lokasiKos` (`lokasiKos`);

--
-- Indexes for table `lokasiproperti`
--
ALTER TABLE `lokasiproperti`
  ADD PRIMARY KEY (`lokasiKos`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenispembayaran`
--
ALTER TABLE `jenispembayaran`
  MODIFY `idPembayaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_print_kuitansi`
--
ALTER TABLE `data_print_kuitansi`
  ADD CONSTRAINT `data_print_kuitansi_ibfk_1` FOREIGN KEY (`idPembayaran`) REFERENCES `jenispembayaran` (`idPembayaran`),
  ADD CONSTRAINT `data_print_kuitansi_ibfk_2` FOREIGN KEY (`Category_Tempat`) REFERENCES `lokasiproperti` (`lokasiKos`);

--
-- Constraints for table `lokasikerjauser`
--
ALTER TABLE `lokasikerjauser`
  ADD CONSTRAINT `lokasikerjauser_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `lokasikerjauser_ibfk_2` FOREIGN KEY (`lokasiKos`) REFERENCES `lokasiproperti` (`lokasiKos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
