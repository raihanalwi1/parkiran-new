-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2022 pada 17.16
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parkiran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kendaraan`
--

CREATE TABLE `jenis_kendaraan` (
  `id_jenis_kendaraan` varchar(5) NOT NULL,
  `nama_kendaraan` varchar(11) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_kendaraan`
--

INSERT INTO `jenis_kendaraan` (`id_jenis_kendaraan`, `nama_kendaraan`, `tarif`) VALUES
('J001', 'Motor', 1000),
('J002', 'Mobil', 3000),
('J003', 'Truk', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir`
--

CREATE TABLE `parkir` (
  `id_parkir` int(6) NOT NULL,
  `no_plat` varchar(10) NOT NULL,
  `id_jenis_kendaraan` varchar(10) NOT NULL,
  `id_transaksi_parkir` varchar(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parkir`
--

INSERT INTO `parkir` (`id_parkir`, `no_plat`, `id_jenis_kendaraan`, `id_transaksi_parkir`, `id_user`) VALUES
(1, 'D 980 k', 'J001', 'T001', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat`
--

CREATE TABLE `tingkat` (
  `id_level` int(2) NOT NULL,
  `nama_level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tingkat`
--

INSERT INTO `tingkat` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_parkir`
--

CREATE TABLE `transaksi_parkir` (
  `id_transaksi_parkir` varchar(7) NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime NOT NULL,
  `status_parkir` int(2) NOT NULL,
  `id_jenis_kendaraan` varchar(5) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_parkir`
--

INSERT INTO `transaksi_parkir` (`id_transaksi_parkir`, `waktu_masuk`, `waktu_keluar`, `status_parkir`, `id_jenis_kendaraan`, `total_bayar`) VALUES
('T001', '2022-08-18 08:53:40', '0000-00-00 00:00:00', 1, 'J001', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `id_level` int(3) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status_user` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `id_level`, `username`, `password`, `status_user`, `image`) VALUES
(1, 'Petugas Lobi Timur', 2, 'plt01', '1', 1, '20210221170025_IMG_8066.jpg'),
(3, 'Alwi', 1, 'alwi', '1', 0, 'DSC_0028.JPG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  ADD PRIMARY KEY (`id_jenis_kendaraan`);

--
-- Indeks untuk tabel `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`id_parkir`);

--
-- Indeks untuk tabel `tingkat`
--
ALTER TABLE `tingkat`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `transaksi_parkir`
--
ALTER TABLE `transaksi_parkir`
  ADD PRIMARY KEY (`id_transaksi_parkir`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id_parkir` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tingkat`
--
ALTER TABLE `tingkat`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
