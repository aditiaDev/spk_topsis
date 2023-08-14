-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 10:08 AM
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
-- Database: `spk_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_batas_kontrak`
--

CREATE TABLE `tb_batas_kontrak` (
  `id_batas_kontrak` varchar(15) NOT NULL,
  `nilai_batas` float NOT NULL,
  `kebutuhan_karyawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_batas_kontrak`
--

INSERT INTO `tb_batas_kontrak` (`id_batas_kontrak`, `nilai_batas`, `kebutuhan_karyawan`) VALUES
('B00001', 0.4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_penilaian`
--

CREATE TABLE `tb_hasil_penilaian` (
  `id_hasil` varchar(15) NOT NULL,
  `id_karyawan` varchar(15) DEFAULT NULL,
  `id_batas_kontrak` varchar(15) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil_penilaian`
--

INSERT INTO `tb_hasil_penilaian` (`id_hasil`, `id_karyawan`, `id_batas_kontrak`, `nilai`, `tgl_penilaian`, `rank`, `keterangan`) VALUES
('H230800001', 'T2300001', 'B00001', 0.436636, '2022-08-14', 2, 'Lanjut Kerja'),
('H230800002', 'T2300002', 'B00001', 0.572207, '2022-08-14', 1, 'Lanjut Kerja'),
('H230800003', 'T2300003', 'B00001', 0.390019, '2022-08-14', 3, 'Dirumahkan'),
('H230800004', 'T2300004', 'B00001', 0.187587, '2022-08-14', 4, 'Dirumahkan'),
('H230800005', 'T2300001', 'B00001', 0.436636, '2023-08-14', 2, 'Lanjut Kerja'),
('H230800006', 'T2300002', 'B00001', 0.572207, '2023-08-14', 1, 'Lanjut Kerja'),
('H230800007', 'T2300003', 'B00001', 0.390019, '2023-08-14', 3, 'Dirumahkan'),
('H230800008', 'T2300004', 'B00001', 0.187587, '2023-08-14', 4, 'Dirumahkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan_kontrak`
--

CREATE TABLE `tb_karyawan_kontrak` (
  `id_karyawan` varchar(15) NOT NULL,
  `id_unit` varchar(6) DEFAULT NULL,
  `id_user` varchar(15) NOT NULL,
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

INSERT INTO `tb_karyawan_kontrak` (`id_karyawan`, `id_unit`, `id_user`, `nm_karyawan`, `alamat_karyawan`, `no_karyawan`, `jenis_kelamin`, `tgl_masuk`, `tgl_kontrak`) VALUES
('T2300001', 'A00001', 'U2300005', 'Aditya', 'Kudus', '085643520576', 'LAKI-LAKI', '2022-08-01', '2025-08-01'),
('T2300002', 'A00001', 'U2300006', 'Fathur', 'Kudus', '085643520576', 'LAKI-LAKI', '2023-08-01', '2025-08-01'),
('T2300003', 'A00002', 'U2300007', 'Dzulfikar', 'Pati', '085643520576', 'LAKI-LAKI', '2022-08-01', '2023-08-01'),
('T2300004', 'A00003', 'U2300008', 'Nurul', 'Kudus', '085643520576', 'PEREMPUAN', '2022-08-01', '2023-08-01');

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
('K00002', 'Pengalaman Kerja Sebelumnya', 5, 'BENEFIT'),
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

--
-- Dumping data for table `tb_penilaian_karyawan`
--

INSERT INTO `tb_penilaian_karyawan` (`id_penilaian_karyawan`, `id_karyawan`, `id_kriteria`, `nilai_kriteria`) VALUES
('N2306000001', 'T2300001', 'K00001', 10),
('N2306000002', 'T2300002', 'K00001', 8),
('N2306000003', 'T2300003', 'K00001', 4),
('N2306000004', 'T2300004', 'K00001', 10),
('N2306000055', 'T2300001', 'K00002', 10),
('N2306000056', 'T2300002', 'K00002', 7),
('N2306000057', 'T2300003', 'K00002', 5),
('N2306000058', 'T2300004', 'K00002', 5),
('N2306000109', 'T2300001', 'K00003', 10),
('N2306000110', 'T2300002', 'K00003', 3),
('N2306000111', 'T2300003', 'K00003', 9),
('N2306000112', 'T2300004', 'K00003', 8),
('N2306000163', 'T2300001', 'K00004', 86),
('N2306000164', 'T2300002', 'K00004', 80),
('N2306000165', 'T2300003', 'K00004', 96),
('N2306000166', 'T2300004', 'K00004', 75),
('N2306000217', 'T2300001', 'K00005', 8),
('N2306000218', 'T2300002', 'K00005', 9),
('N2306000219', 'T2300003', 'K00005', 8),
('N2306000220', 'T2300004', 'K00005', 10);

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
('A00001', 'U2300003', 'Unit Produksi 1', 'Adib'),
('A00002', 'U2300004', 'Unit Produksi 2', 'Farel'),
('A00003', 'U2300002', 'Unit Produksi 3', 'Sofyan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `nm_pengguna` varchar(25) DEFAULT NULL,
  `level` enum('ADMIN','KARYAWAN','KEPALA UNIT') DEFAULT NULL,
  `status_password` enum('BELUM RESET','SUDAH RESET') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`, `status_password`) VALUES
('U2300001', 'admin', 'admin', 'Kevin', 'ADMIN', 'SUDAH RESET'),
('U2300002', 'U2300002', 'U2300002', 'Sofyan', 'KEPALA UNIT', 'SUDAH RESET'),
('U2300003', 'U2300003', 'U2300003', 'U2300003', 'KEPALA UNIT', 'SUDAH RESET'),
('U2300004', 'U2300004', 'U2300004', 'U2300004', 'KEPALA UNIT', 'SUDAH RESET'),
('U2300005', 'U2300005', 'U2300005', 'Aditya', 'KARYAWAN', 'BELUM RESET'),
('U2300006', 'U2300006', 'U2300006', 'Fathur', 'KARYAWAN', 'BELUM RESET'),
('U2300007', 'U2300007', 'U2300007', 'Dzulfikar', 'KARYAWAN', 'BELUM RESET'),
('U2300008', 'U2300008', 'U2300008', 'Nurul', 'KARYAWAN', 'BELUM RESET');

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
