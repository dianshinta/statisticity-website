-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 02:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statisticity`
--

-- --------------------------------------------------------

--
-- Table structure for table `flashcards`
--

CREATE TABLE `flashcards` (
  `id` int(11) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flashcards`
--

INSERT INTO `flashcards` (`id`, `email_user`, `major`, `semester`, `subject`, `question`, `answer`) VALUES
(79, '212212825@stis.ac.id', 'DIII Statistika', '1', 'Pendidikan Agama', 'punya akun sastunya', 'eko'),
(80, '212212825@stis.ac.id', 'DIV Komputasi Statistik', '1', 'Pendidikan Agama', 'akun satunya', 'agama'),
(83, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '3', 'Struktur Data', 'in-order traversal', 'left -> root -> right'),
(84, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '3', 'Struktur Data', 'post-order traversal', 'left -> right -> root'),
(85, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '3', 'Metode Penarikan Sampel', 'Pengertian Deft (Design Factor)', 'perbandingan standard error suatu desain sampling dgn standard error sampel acak sederhana.'),
(86, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '4', 'Pemrograman Berbasis Web', 'Fungsi HTML', 'menentukan struktur halaman web'),
(87, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '3', 'Basis Data', 'apa itu DDL?', 'Data Definition Language -> define struktur database dan mengatur akses data'),
(88, '222212822@stis.ac.id', 'DIV Komputasi Statistik', '3', 'Basis Data', 'apa itu DML?', 'Data Manipulation Language -> mendapatkan dan melakukan pembaharuan data');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `content`, `author`, `date`, `subject`, `comments`) VALUES
(11, 'guyss adakah disini yang punya video tutorial binary search tree? sender masih bingung :\")', 'anak ks1', '2024-06-01 16:19:48', 'Struktur Data', '[{\"author\":\"222212822@stis.ac.id\",\"content\":\"aku kemarin baru aja belajar itu nder, videonya yang inii cukup membantu: https:\\/\\/youtu.be\\/pYT9F8_LFTM?si=6Xdb1bkFedBLA57y\",\"date\":\"2024-06-01 23:20:46\"}]'),
(12, 'mau nanya dong, kapan harus pake for loop dan kapan harus pake while loop?', 'ada deh', '2024-06-01 16:23:00', 'Algoritma dan Pemrograman', '[{\"author\":\"222212822@stis.ac.id\",\"content\":\"for loop itu dipake kalo kita mau iterasiin sesuatu kyk array lalu melakukan sesuatu untuk tiap array tsb, jadi jumlah iterasinya bisa kita tentukan misal sebanyak array tersebut. kalo while loop itu kalo kita mau melakukan suatu hal berulang kali sampai suatu kondisi terpenuhi. \",\"date\":\"2024-06-01 23:26:36\"},{\"author\":null,\"content\":\"kurang tau juga nder\",\"date\":\"2024-06-06 20:49:37\"},{\"author\":\"222212822@stis.ac.id\",\"content\":\"coba tanya google\",\"date\":\"2024-06-06 20:51:18\"}]'),
(13, 'gess tolong jelasin bedanya regresi dan korelasi dong', 'nak st5', '2024-06-01 16:28:30', 'Analisis Regresi', '[{\"author\":\"222212822@stis.ac.id\",\"content\":\"regresi: menganalisis hub antarvariabel dan bisa menyimpulkan hubungan sebab akibat. meanwhile korelasi: juga menganalisis hub antarvariabel tapi gabisa menyimpulkan hubungan sebab akibat.\",\"date\":\"2024-06-01 23:30:44\"}]'),
(14, 'apa itu metode survei?', 'anak 2ks1', '2024-06-06 13:48:12', 'Metode Survei', '[{\"author\":\"222212822@stis.ac.id\",\"content\":\"tes\",\"date\":\"2024-06-10 15:24:57\"},{\"author\":null,\"content\":\"tes\",\"date\":\"2024-06-10 15:25:14\"},{\"author\":null,\"content\":\"tes\",\"date\":\"2024-06-10 15:28:30\"},{\"author\":null,\"content\":\"tes\",\"date\":\"2024-06-10 15:28:44\"}]'),
(15, 'he', 'lo', '2024-06-10 08:31:05', 'Pendidikan Agama', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`) VALUES
('212212825@stis.ac.id', '1234'),
('222212822@stis.ac.id', '1234'),
('test@stis.ac.id', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flashcards`
--
ALTER TABLE `flashcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flashcards`
--
ALTER TABLE `flashcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
