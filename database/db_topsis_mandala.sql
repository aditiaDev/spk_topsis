-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jun 2023 pada 16.04
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `tb_batas_kontrak`
--

CREATE TABLE `tb_batas_kontrak` (
  `id_batas_kontrak` varchar(15) NOT NULL,
  `nilai_batas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil_penilaian`
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
-- Struktur dari tabel `tb_karyawan_kontrak`
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
-- Dumping data untuk tabel `tb_karyawan_kontrak`
--

INSERT INTO `tb_karyawan_kontrak` (`id_karyawan`, `id_unit`, `nm_karyawan`, `alamat_karyawan`, `no_karyawan`, `jenis_kelamin`, `tgl_masuk`, `tgl_kontrak`) VALUES
('T2300001', 'A00001', 'Karyawan 1', 'Kudus', '085324786789', 'LAKI-LAKI', '2020-11-18', '2020-11-18'),
('T2323001', 'A00001', 'Karyawan 2', 'Jepara', '089879879823', 'PEREMPUAN', '2023-06-01', '2023-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `nm_kriteria` varchar(25) DEFAULT NULL,
  `bobot_kriteria` int(11) DEFAULT NULL,
  `jenis_kriteria` enum('MAX','MIN') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nm_kriteria`, `bobot_kriteria`, `jenis_kriteria`) VALUES
('K00001', 'Attitude', 30, 'MAX'),
('K00002', 'Nilai Kehadiran', 25, 'MAX'),
('K00003', 'Kemampuan', 25, 'MAX'),
('K00004', 'Aktif/ Loyalitas', 15, 'MAX'),
('K00005', 'Umur', 10, 'MIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian_karyawan`
--

CREATE TABLE `tb_penilaian_karyawan` (
  `id_penilaian_karyawan` varchar(15) NOT NULL,
  `id_karyawan` varchar(15) DEFAULT NULL,
  `id_kriteria` varchar(15) DEFAULT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` varchar(6) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `nm_unit` varchar(25) DEFAULT NULL,
  `kepala_unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `id_user`, `nm_unit`, `kepala_unit`) VALUES
('A00001', 'U2300004', 'Unit 1', 'Kepala Unit 1'),
('A00002', 'U2300006', 'Unit 2', 'Kepala Unit 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `nm_pengguna` varchar(25) DEFAULT NULL,
  `level` enum('ADMIN','KARYAWAN','KEPALA UNIT') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
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
-- Indeks untuk tabel `tb_batas_kontrak`
--
ALTER TABLE `tb_batas_kontrak`
  ADD PRIMARY KEY (`id_batas_kontrak`);

--
-- Indeks untuk tabel `tb_hasil_penilaian`
--
ALTER TABLE `tb_hasil_penilaian`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `tb_karyawan_kontrak`
--
ALTER TABLE `tb_karyawan_kontrak`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_penilaian_karyawan`
--
ALTER TABLE `tb_penilaian_karyawan`
  ADD PRIMARY KEY (`id_penilaian_karyawan`);

--
-- Indeks untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
