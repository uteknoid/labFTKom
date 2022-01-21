-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 03:49 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama_alat`, `jumlah`, `jenis`) VALUES
(4, 'Projector', 10, 'Tidak Habis'),
(6, 'Konektor RJ45', 100, 'Habis');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_lab`
--

CREATE TABLE `jadwal_lab` (
  `id` int(11) NOT NULL,
  `npm` int(10) NOT NULL,
  `nama_matkul` varchar(50) DEFAULT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_awal` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `ruang` varchar(100) NOT NULL,
  `dosen_pengampu` varchar(30) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `nama`, `deskripsi`, `logo`, `icon`, `alamat`, `telp`, `email`) VALUES
(1, 'LAB FTKOM UNCP', 'Website ini merupakan aplikasi yang dapat digunakan untuk mengelola peminjaman alat pada LAB FTKOM UNCP. Aplikasi ini merupakan aplikasi berbasis web yang di kelola langsung oleh pihak FTKOM UNCP', 'logo.png', 'icon.png', 'Jl. Latamacelling, Tompotika, Wara, Kota Palopo, Sulawesi Selatan 91911', '+6247122111', 'staf@ftkom-uncp.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `option_laporan`
--

CREATE TABLE `option_laporan` (
  `id` int(1) NOT NULL,
  `header1` varchar(255) NOT NULL,
  `header2` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `situs` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kota` varchar(255) NOT NULL,
  `an` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option_laporan`
--

INSERT INTO `option_laporan` (`id`, `header1`, `header2`, `alamat`, `telp`, `situs`, `email`, `kota`, `an`, `nama`, `nip`) VALUES
(1, 'Fakultas Teknik Komputer ', 'Universitas Cokroaminoto Palopo', 'Jl. Latammacelling NO.9B Palopo', '(0471) 3200907', 'https://ftkom-uncp.ac.id', 'staf@ftkom-uncp.ac.id', 'Palopo', 'Kepala Laboratorium', 'Safwan Kasma, S.Kom., M.Pd', '0910068705');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `jumlah_alat` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `jaminan` varchar(255) NOT NULL,
  `proses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_lab`
--

CREATE TABLE `ruang_lab` (
  `id_lab` int(5) NOT NULL,
  `nama_lab` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='merupakan table ruangan lab';

--
-- Dumping data for table `ruang_lab`
--

INSERT INTO `ruang_lab` (`id_lab`, `nama_lab`, `status`) VALUES
(1, 'Laboratorium 1', 'Kosong'),
(2, 'Laboratorium 2', 'Kosong'),
(3, 'Laboratorium 3', 'Kosong'),
(4, 'Laboratorium 4', 'Kosong'),
(5, 'Laboratorium 5', 'Kosong'),
(6, 'Laboratorium 6', 'Kosong'),
(7, 'Laboratorium 7', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `npm` int(10) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `qrlog` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `npm`, `name`, `email`, `password`, `hp`, `qrlog`, `role_id`, `is_active`) VALUES
(9, 1234567891, 'Nama Dosen', 'mail@gmail.com', '$2y$10$yrWWQl7U8fpkChkAFvq7hegf8nozbjyQuVCNNtkZiq2tQVzCfC5wy', '085123456789', 'A4OPkis338', 2, 1),
(10, 123, 'Admin', 'admin@uncp.ac.id', '$2y$10$2OQ0DvgPbTOA0pCW.yunuOjbM5rCSx3YWIVqFKwnZn5zrJJvnv8oS', '081234567890', 'ivFH5jiPFl', 1, 1),
(12, 111, 'uteknoid', 'mail@mail.com', '$2y$10$3X9yq7KmT86SE7OD5uQqkO4i0uMxx2GXfuhUm1NVem1t0JLuAXyM.', '081287367646', 'f5sw09yM7U', 1, 1),
(13, 12345, 'Dosen 2', 'email@mail.com', '$2y$10$RouRNY/m0SVaPLHZCwl50OJTh.GLx/FYnt0mNLd5jeZ7NL.QzS69S', '087654321123', 'L6SuqoKyB5', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_lab`
--
ALTER TABLE `jadwal_lab`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jam_awal` (`jam_awal`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_laporan`
--
ALTER TABLE `option_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang_lab`
--
ALTER TABLE `ruang_lab`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_lab`
--
ALTER TABLE `jadwal_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `option_laporan`
--
ALTER TABLE `option_laporan`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ruang_lab`
--
ALTER TABLE `ruang_lab`
  MODIFY `id_lab` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
