-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 08:41 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_topsis_mandala`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_batas_kontrak`
--

CREATE TABLE `tb_batas_kontrak` (
  `id_batas_kontrak` varchar(15) NOT NULL,
  `nilai_batas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_penilaian`
--

CREATE TABLE `tb_hasil_penilaian` (
  `id_hasil` varchar(15) NOT NULL,
  `id_karyawan` varchar(15) DEFAULT NULL,
  `id_batas_kontrak` varchar(15) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tgl_penilaian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan_kontrak`
--

CREATE TABLE `tb_karyawan_kontrak` (
  `id_karyawan` varchar(15) NOT NULL,
  `id_unit` varchar(6) DEFAULT NULL,
  `nm_karyawan` varchar(25) DEFAULT NULL,
  `alamat_karyawan` varchar(300) DEFAULT NULL,
  `no_karyawan` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('LAKI-LAKI','PEREMPUAN') DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_kontrak` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `nm_kriteria` varchar(25) DEFAULT NULL,
  `bobot_kriteria` int(11) DEFAULT NULL,
  `jenis_kriteria` enum('MAX','MIN') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian_karyawan`
--

CREATE TABLE `tb_penilaian_karyawan` (
  `id_penilaian_karyawan` varchar(15) NOT NULL,
  `id_karyawan` varchar(15) DEFAULT NULL,
  `id_kriteria` varchar(15) DEFAULT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` varchar(6) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `nm_unit` varchar(25) DEFAULT NULL,
  `kepala_unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `nm_pengguna` varchar(25) DEFAULT NULL,
  `level` enum('ADMIN','KARYAWAN','KEPALA UNIT') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_batas_kontrak`
--
ALTER TABLE `tb_batas_kontrak`
  ADD PRIMARY KEY (`id_batas_kontrak`);

--
-- Indexes for table `tb_hasil_penilaian`
--
ALTER TABLE `tb_hasil_penilaian`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_karyawan_kontrak`
--
ALTER TABLE `tb_karyawan_kontrak`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_penilaian_karyawan`
--
ALTER TABLE `tb_penilaian_karyawan`
  ADD PRIMARY KEY (`id_penilaian_karyawan`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
