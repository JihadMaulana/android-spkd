-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mar 2017 pada 05.59
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `sistemkendaraan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `id`
--

CREATE TABLE `id` (
  `Id` int(2) NOT NULL,
  `Keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `id`
--

INSERT INTO `id` (`Id`, `Keterangan`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` varchar(22) NOT NULL,
  `nama_kendaraan` varchar(50) NOT NULL,
  `merk_kendaraan` varchar(20) NOT NULL,
  `tahun_produksi` varchar(4) NOT NULL,
  `bpkb_kendaraan` varchar(15) NOT NULL,
  `nomor_polisi_merah` varchar(12) NOT NULL,
  `nomor_polisi_hitam` varchar(12) NOT NULL,
  `nomor_mesin` varchar(20) NOT NULL,
  `ket` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_peminjam` varchar(40) NOT NULL,
  `tujuan_peminjaman` varchar(20) NOT NULL,
  `jumlah_kendaraan` int(2) NOT NULL,
  `waktu_pinjam` datetime NOT NULL,
  `waktu_kembali` datetime NOT NULL,
  `keterangan_peminjaman` varchar(255) NOT NULL,
  `status_peminjaman` enum('Pending','Accepted','Rejected','Canceled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `plot_kendaraan`
--

CREATE TABLE `plot_kendaraan` (
  `id_plot` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_kendaraan` varchar(22) NOT NULL,
  `id_supir` varchar(20) NOT NULL,
  `ket` enum('ready','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `servis_kendaraan`
--

CREATE TABLE `servis_kendaraan` (
  `id_servis` int(20) NOT NULL,
  `id_kendaraan` varchar(22) NOT NULL,
  `tanggal_servis` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `ket` enum('active','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supir`
--

CREATE TABLE `supir` (
  `id_supir` varchar(30) NOT NULL,
  `nama_supir` varchar(40) NOT NULL,
  `no_telepon_supir` varchar(15) NOT NULL,
  `alamat_supir` text NOT NULL,
  `ket` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_pengguna` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `id` int(2) NOT NULL,
  `ket` enum('active','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_pengguna`, `nama`, `password`, `email`, `no_telepon`, `id`, `ket`) VALUES
('123', 'SuperAdmin', '123', 'SuperAdmin', '08123', 1, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `id`
--
ALTER TABLE `id`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_peminjam` (`id_peminjam`);

--
-- Indexes for table `plot_kendaraan`
--
ALTER TABLE `plot_kendaraan`
  ADD PRIMARY KEY (`id_plot`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_sopir` (`id_supir`);

--
-- Indexes for table `servis_kendaraan`
--
ALTER TABLE `servis_kendaraan`
  ADD PRIMARY KEY (`id_servis`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_kendaraan_2` (`id_kendaraan`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `Id` (`id`),
  ADD KEY `Id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `plot_kendaraan`
--
ALTER TABLE `plot_kendaraan`
  MODIFY `id_plot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `servis_kendaraan`
--
ALTER TABLE `servis_kendaraan`
  MODIFY `id_servis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `user` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `plot_kendaraan`
--
ALTER TABLE `plot_kendaraan`
  ADD CONSTRAINT `plot_kendaraan_ibfk_1` FOREIGN KEY (`id_supir`) REFERENCES `supir` (`id_supir`),
  ADD CONSTRAINT `plot_kendaraan_ibfk_2` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  ADD CONSTRAINT `plot_kendaraan_ibfk_3` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`);

--
-- Ketidakleluasaan untuk tabel `servis_kendaraan`
--
ALTER TABLE `servis_kendaraan`
  ADD CONSTRAINT `servis_kendaraan_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id`) REFERENCES `id` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
