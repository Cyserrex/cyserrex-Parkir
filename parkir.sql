-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Mei 2017 pada 16.50
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_user` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Adny Nizomi', 'adny', '123456', 1),
(2, 'Admin', 'admin', 'admin', 0),
(3, 'Agus', 'agus', '123456', 1),
(4, 'Dani', 'dani', '123456', 2),
(6, 'Arrahman', 'rahman', 'rahman', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_parkir`
--

CREATE TABLE `data_parkir` (
  `id_parkir` varchar(16) NOT NULL,
  `id_user_m` int(2) NOT NULL,
  `id_user_k` int(2) NOT NULL,
  `plat` varchar(12) NOT NULL,
  `tipe` char(15) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time NOT NULL,
  `keluar` time NOT NULL,
  `tarif` int(6) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_parkir`
--

INSERT INTO `data_parkir` (`id_parkir`, `id_user_m`, `id_user_k`, `plat`, `tipe`, `tanggal`, `masuk`, `keluar`, `tarif`, `gambar`) VALUES
('M01052017160352', 2, 2, 'AS 123 AS', 'Mobil', '2017-04-01', '16:03:52', '16:04:07', 2000, ''),
('M01052017160450', 2, 2, 'AD 1212 CVB', 'Mobil', '2017-04-02', '16:04:50', '16:05:09', 2000, ''),
('M30042017110357', 2, 0, 'UI 345 UI', 'Mobil', '2017-04-01', '11:03:57', '00:00:00', 5000, ''),
('S01052017154213', 2, 2, 'DA 1212 AB', 'Sepeda Motor', '2017-04-01', '15:42:13', '15:42:30', 1000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_plat`
--

CREATE TABLE `data_plat` (
  `id` int(2) NOT NULL,
  `plat_depan` char(3) NOT NULL,
  `daerah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_plat`
--

INSERT INTO `data_plat` (`id`, `plat_depan`, `daerah`) VALUES
(1, 'DA', 'Banjarmasin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_jabatan`
--

CREATE TABLE `level_jabatan` (
  `level` int(2) NOT NULL,
  `nama_jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level_jabatan`
--

INSERT INTO `level_jabatan` (`level`, `nama_jabatan`) VALUES
(0, 'Admin'),
(1, 'Parkir Masuk'),
(2, 'Parkir Keluar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `data_parkir`
--
ALTER TABLE `data_parkir`
  ADD PRIMARY KEY (`id_parkir`);

--
-- Indexes for table `data_plat`
--
ALTER TABLE `data_plat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  ADD PRIMARY KEY (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
