-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 06:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkedon`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `_email` varchar(50) DEFAULT NULL,
  `_password` varchar(50) DEFAULT NULL,
  `_namadepan` varchar(50) DEFAULT NULL,
  `_namabelakang` varchar(50) DEFAULT NULL,
  `_tanggallahir` varchar(50) DEFAULT NULL,
  `_alamat` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_user_type` enum('company','client') CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `_email` varchar(50) DEFAULT NULL,
  `_password` varchar(50) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_tanggalBerdiri` varchar(50) DEFAULT NULL,
  `_alamat` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_user_type` enum('Company','Employee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`_email`, `_password`, `_namaPerusahaan`, `_tanggalBerdiri`, `_alamat`, `_pictpath`, `_user_type`) VALUES
('m@gmail.com', '123', 'LLos', '2025-06-03', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images/1748964530.webp', 'Company');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `_nama` varchar(50) DEFAULT NULL,
  `_alamat` varchar(100) DEFAULT NULL,
  `_noTelp` varchar(15) DEFAULT NULL,
  `_tanggalLahir` varchar(15) DEFAULT NULL,
  `_email` varchar(50) DEFAULT NULL,
  `_gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `_cv` varchar(100) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_job` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`_nama`, `_alamat`, `_noTelp`, `_tanggalLahir`, `_email`, `_gender`, `_cv`, `_namaPerusahaan`, `_job`) VALUES
('ANJAY mabar', '1', '1', '2025-06-11', 'k@gmail.com', 'Laki-laki', 'pdf/1748964605.pdf', 'LLos', '1'),
('ANJAY mabar', '1', '088226843164', '2025-06-03', 'k@gmail.com', 'Laki-laki', 'pdf/1749610462.pdf', 'LLos', '12'),
('ANJAY mabar', '1', '1', '2025-06-25', 'k@gmail.com', 'Laki-laki', 'pdf/1749612159.pdf', 'LLos', '2');

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `_deskripsi` varchar(500) DEFAULT NULL,
  `_kualifikasi` varchar(500) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_gaji` int(11) DEFAULT NULL,
  `_gajiPer` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_deadline` varchar(50) DEFAULT NULL,
  `_alamat` varchar(100) DEFAULT NULL,
  `_tipe` enum('Full Time','Part Time') DEFAULT NULL,
  `_job` varchar(100) DEFAULT NULL,
  `_jobKategori` varchar(50) DEFAULT NULL,
  `_keuntungan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`_deskripsi`, `_kualifikasi`, `_namaPerusahaan`, `_gaji`, `_gajiPer`, `_pictpath`, `_deadline`, `_alamat`, `_tipe`, `_job`, `_jobKategori`, `_keuntungan`) VALUES
('1', '1', 'LLos', 1, 'Hari', '../Images/1748964569.png', '2025-07-01', '1', 'Full Time', '1', '1', '1'),
('123', '1', 'LLos', 1, 'Hari', '../Images/1749611448.jpg', '2025-06-25', '1', 'Full Time', '12', '12', '1'),
('2', '2', 'LLos', 2, 'Minggu', '../Images/1749612137.jpg', '2025-07-02', '2', 'Full Time', '2', '2', '2'),
('23', '23', 'LLos', 23, 'Hari', '../Images/1749612860.png', '2025-07-02', '2', 'Full Time', '23', '23', '23'),
('1234', '1234', 'LLos', 1234, 'Minggu', '../Images/1749613849.jpg', '2025-06-24', '1234', 'Full Time', '1234', '1234', '1234'),
('123', '', 'LLos', 12345, 'Hari', '../Images/1749614023.jpeg', '2025-06-12', '12345', 'Full Time', '12345', '12345', '123'),
('6', '6', 'LLos', 1235, 'Hari', '../Images/1749614237.jpg', '2025-06-23', 'new mexico', 'Full Time', '6', '6', '6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
