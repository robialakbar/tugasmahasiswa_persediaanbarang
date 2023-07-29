-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2023 pada 12.18
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kd_barang` char(50) NOT NULL,
  `nama_kd` char(4) NOT NULL,
  `kondisi_kd` char(4) NOT NULL,
  `ruang_kd` char(4) NOT NULL,
  `sumber_kd` char(10) NOT NULL,
  `jenis_kd` char(20) NOT NULL,
  `tahun_kd` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_kd` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_kd`, `kondisi_kd`, `ruang_kd`, `sumber_kd`, `jenis_kd`, `tahun_kd`, `status`, `user_kd`) VALUES
('01.B.UNU.2021.1', '07', 'D001', '01', 'UNU', 'B', 2021, 'Tersedia', 'P0000'),
('02.A.UNU.2019.1', '05', 'D001', '02', 'UNU', 'A', 2019, 'Tersedia', 'P0000'),
('02.B.UNU.2021.1', '08', 'D001', '02', 'UNU', 'B', 2021, 'Tersedia', 'P0000'),
('02.B.UNU.2021.2', '08', 'D001', '02', 'UNU', 'B', 2021, 'Tersedia', 'P0000'),
('03.A.UNU.2019.1', '05', 'D001', '03', 'UNU', 'A', 2019, 'Tersedia', 'P0000'),
('04.A.UNU.2019.1', '05', 'D001', '04', 'UNU', 'A', 2019, 'Tersedia', 'P0000'),
('04.B.UNU.2021.1', '06', 'D001', '04', 'UNU', 'B', 2021, 'Tersedia', 'P0000'),
('04.B.UNU.2021.2', '06', 'D001', '04', 'UNU', 'B', 2021, 'Tersedia', 'P0000'),
('A1.A.UNU.2020.1', '01', 'D001', 'A1', 'UNU', 'A', 2020, 'Tersedia', 'P0000'),
('A1.A.UNU.2020.2', '01', 'D001', 'A1', 'UNU', 'A', 2020, 'Tersedia', 'P0000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `kd_jenis` char(4) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `inisial` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`kd_jenis`, `jenis`, `inisial`) VALUES
('01', 'ELEKTRONIK', 'B'),
('02', 'FURNITURE', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `kd_kondisi` char(4) NOT NULL,
  `kondisi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`kd_kondisi`, `kondisi`) VALUES
('D001', 'Baik'),
('D002', 'Rusak Ringan'),
('D003', 'Rusak Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_barang`
--

CREATE TABLE `nama_barang` (
  `kd_nama` char(4) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `harga_perolehan` int(20) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_barang`
--

INSERT INTO `nama_barang` (`kd_nama`, `nama`, `harga_perolehan`, `stok`) VALUES
('01', 'Komputer', 7000000, 2),
('02', 'Meja Wakil Rektor', 3500000, 0),
('03', 'Dispenser Mito', 3000000, 0),
('04', 'Jam Dinding', 100000, 0),
('05', 'Meja Kepala Biro', 5000000, 3),
('06', 'Kipas Angin Maspion', 750000, 2),
('07', 'AC', 3500000, 1),
('08', 'Printer', 2500000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `kd_role` char(4) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`kd_role`, `role`) VALUES
('R001', 'Petugas'),
('R002', 'Pengawas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `kd_ruang` char(4) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `no_ruang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`kd_ruang`, `ruang`, `no_ruang`) VALUES
('01', 'Rektor', 'A1'),
('02', 'Wakil Rektor', '01'),
('03', 'BPK3', '03'),
('04', 'BAK', '02'),
('05', 'BUKRTSI', '04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber`
--

CREATE TABLE `sumber` (
  `kd_sumber` char(4) NOT NULL,
  `sumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sumber`
--

INSERT INTO `sumber` (`kd_sumber`, `sumber`) VALUES
('01', 'UNU'),
('02', 'DIKTI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `kd_tahun` char(4) NOT NULL,
  `tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`kd_tahun`, `tahun`) VALUES
('01', '2020'),
('02', '2019'),
('03', '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `kd_user` char(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `aktif` int(1) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL,
  `role` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `kd_user`, `username`, `image`, `password`, `nama`, `email`, `alamat`, `aktif`, `tgl_dibuat`, `role`) VALUES
(1, 'P0000', 'petugas', 'petugas.png', '$2y$10$4C6jPQCcj4Av94BQj9G9C.FvwwiNccIlx3LARsh2.ywV5zlhZgace', 'ADMIN UNU LAMPUNG', 'petugas@petugas.com', 'UNU LAMPUNG', 1, 1552120289, 'R001'),
(7, 'U0001', 'wili', 'default.jpg', '$2y$10$1iGoyWopnsXhF/N2W2PSOeN4HIhdsYE1mfnkUQDUohyii8s6OcNdi', 'wili', 'wili@gmail.com', 'unuula', 1, 1689931840, 'R002');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`kd_jenis`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`kd_kondisi`);

--
-- Indeks untuk tabel `nama_barang`
--
ALTER TABLE `nama_barang`
  ADD PRIMARY KEY (`kd_nama`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`kd_role`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`kd_ruang`);

--
-- Indeks untuk tabel `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`kd_sumber`);

--
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`kd_tahun`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
