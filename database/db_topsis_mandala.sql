-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 05:58 AM
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

--
-- Dumping data for table `tb_batas_kontrak`
--

INSERT INTO `tb_batas_kontrak` (`id_batas_kontrak`, `nilai_batas`) VALUES
('B00001', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bobot`
--

CREATE TABLE `tb_bobot` (
  `nilai_bobot` int(11) NOT NULL,
  `keterangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bobot`
--

INSERT INTO `tb_bobot` (`nilai_bobot`, `keterangan`) VALUES
(1, 'Sangat Rendah'),
(2, 'Rendah'),
(3, 'Cukup'),
(4, 'Tinggi'),
(5, 'Sangat Tinggi');

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

--
-- Dumping data for table `tb_karyawan_kontrak`
--

INSERT INTO `tb_karyawan_kontrak` (`id_karyawan`, `id_unit`, `nm_karyawan`, `alamat_karyawan`, `no_karyawan`, `jenis_kelamin`, `tgl_masuk`, `tgl_kontrak`) VALUES
('T2300001', 'A00001', 'Karyawan 1', 'Kudus', '085324786789', 'LAKI-LAKI', '2020-11-18', '2020-11-01'),
('T2323001', 'A00001', 'Karyawan 2', 'Jepara', '089879879823', 'PEREMPUAN', '2023-06-01', '2023-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `nm_kriteria` varchar(50) DEFAULT NULL,
  `bobot_kriteria` int(11) DEFAULT NULL,
  `jenis_kriteria` enum('BENEFIT','COST') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nm_kriteria`, `bobot_kriteria`, `jenis_kriteria`) VALUES
('K00001', 'Lokasi Jarak Rumah (Km)', 4, 'COST'),
('K00002', 'Pengalaman Kerja Sebelumn', 5, 'BENEFIT'),
('K00003', 'Total Izin Selama Kerja (Hari)', 4, 'COST'),
('K00004', 'Nilai Akhir Sekolah', 3, 'BENEFIT'),
('K00005', 'Penilaian Kinerja (Skor: 1-10)', 3, 'BENEFIT');

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

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `id_user`, `nm_unit`, `kepala_unit`) VALUES
('A00001', 'U2300004', 'Unit 1', 'Kepala Unit 1'),
('A00002', 'U2300006', 'Unit 2', 'Kepala Unit 2');

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
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`) VALUES
('U2300001', 'admin', 'admin', 'Admin HRD', 'ADMIN'),
('U2300002', 'admin2', 'admin2', 'ADMIN 2', 'ADMIN'),
('U2300003', 'karyawan1', 'karyawan1', 'Karyawan 1', 'KARYAWAN'),
('U2300004', 'kepala', 'kepala', 'Kepala Unit 1', 'KEPALA UNIT'),
('U2300005', 'karyawan2', 'karyawan2', 'Karaywan 2', 'KARYAWAN'),
('U2300006', 'kepala2', 'kepala2', 'Kepala Unit 2', 'KEPALA UNIT');

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
