-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2021 at 03:31 PM
-- Server version: 8.0.25
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_nilai`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_kelas`
--

CREATE TABLE `group_kelas` (
  `id` int NOT NULL,
  `id_guru` varchar(3) NOT NULL,
  `id_siswa` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `group_kelas`
--

INSERT INTO `group_kelas` (`id`, `id_guru`, `id_siswa`) VALUES
(3, '2', '5'),
(4, '4', '5'),
(5, '2', '10'),
(6, '4', '10');

-- --------------------------------------------------------

--
-- Table structure for table `materi_pembelajaran`
--

CREATE TABLE `materi_pembelajaran` (
  `id` int NOT NULL,
  `nama_materi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_guru` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi_pembelajaran`
--

INSERT INTO `materi_pembelajaran` (`id`, `nama_materi`, `id_guru`) VALUES
(1, 'Dasar pemrograman Java', '2'),
(2, 'Pembuatan activity (minggu 2) ', '2'),
(4, 'Talk about Daily Activities', '4'),
(5, 'Entertainment and Invitation ', '4'),
(6, 'Tell Me About Your Family', '4'),
(7, 'LAST ACTIVITY (exercise)', '4');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswa`
--

CREATE TABLE `nilai_siswa` (
  `id` int NOT NULL,
  `id_user` varchar(3) NOT NULL,
  `id_materi` varchar(3) NOT NULL,
  `nilai` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`id`, `id_user`, `id_materi`, `nilai`) VALUES
(1, '5', '2', '80'),
(2, '10', '1', '90'),
(4, '10', '2', '87'),
(6, '5', '4', '86'),
(7, '5', '5', '70');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `level`) VALUES
(1, 'Navthul Hilma', 'admin', 'admin', 'admin'),
(2, 'Bu Dwi Ariyoo', 'guru1', 'guru1', 'guru'),
(4, 'Pak Noga', 'guru2', 'guru2', 'guru'),
(5, 'Tovan Gofar', 'siswa1', 'siswa1', 'siswa'),
(10, 'Aldi Navasa', 'siswa2', 'siswa2', 'siswa'),
(11, 'umaya ninci', 'siswa3', 'siswa3', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_kelas`
--
ALTER TABLE `group_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi_pembelajaran`
--
ALTER TABLE `materi_pembelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_kelas`
--
ALTER TABLE `group_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materi_pembelajaran`
--
ALTER TABLE `materi_pembelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
