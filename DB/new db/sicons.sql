-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2022 pada 14.19
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sicons`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'ZANURA', 'JL. Rawabali', '0812-9936-9059', 'SICONS', 'SICONS', 'AdminLTELogo1.png', 'Copy Right &copy;', '1.0.0.0', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspek`
--

CREATE TABLE `aspek` (
  `id_aspek` int(11) NOT NULL,
  `nama_aspek` varchar(200) NOT NULL,
  `typeaspek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `nama_aspek`, `typeaspek`) VALUES
(1, 'Kuesioner', 'akademik'),
(2, 'Career test', 'akademik'),
(3, 'Personality Test', 'akademik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `career`
--

CREATE TABLE `career` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `jawaban` enum('Y','N','TS') NOT NULL,
  `date_created` date NOT NULL,
  `is_active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `career`
--

INSERT INTO `career` (`id`, `pertanyaan`, `jawaban`, `date_created`, `is_active`) VALUES
(9, 'ascaasc', 'Y', '2022-05-05', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konseling`
--

CREATE TABLE `konseling` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `jawaban` varchar(500) NOT NULL,
  `is_active` enum('IK','GK') NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konseling`
--

INSERT INTO `konseling` (`id`, `nis`, `id_user`, `id_level`, `subject`, `pesan`, `jawaban`, `is_active`, `date_created`) VALUES
(783, 23123123, 100, 2, 'asdas', 'asad', '', 'GK', '2022-05-09'),
(969, 23123123, 100, 2, 'sadasda', 'asdasdasd', '', 'IK', '2022-05-09'),
(1267, 23123123, 40, 2, 'asasdasd', 'asdssdas', '', 'IK', '2022-05-09'),
(2796, 31231222, 39, 2, 'sadasd', 'asasd', '', 'IK', '2022-05-09'),
(4479, 31231222, 40, 2, 'hayyyy', 'ssdsdsd', '', 'IK', '2022-05-09'),
(6780, 23123123, 39, 2, 'hayyyy', 'asd', '', 'GK', '2022-05-09'),
(7446, 23123123, 40, 2, 'asasdsa', 'asdasd', '', 'GK', '2022-05-09'),
(7676, 31231222, 40, 2, 'sdsdasd', 'asasd', '', 'GK', '2022-05-09'),
(8789, 31231222, 100, 2, 'asadasd', 'aasdasdas', '', 'GK', '2022-05-09'),
(7052022, 0, 0, 2, 'pemalsuan', 'haiiiii', '', 'IK', '2022-05-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `pertanyaan` varchar(525) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kuesioner`
--

INSERT INTO `kuesioner` (`id_kuesioner`, `pertanyaan`, `id_aspek`, `id_level`) VALUES
(1, 'Saya sering merasakan sakit ketika mengikuti perkuliahan.', 1, 3),
(2, 'Jantung sering berdebar - debar ketika mengikuti perkuliahan.', 1, 3),
(3, 'Sering keluar keringat dingin ketika mengikuti perkuliahan', 1, 3),
(4, 'Saya pernah dioperasi karena menderita penyakit maupun kecelakaan', 1, 3),
(5, 'Saya merasa terlalu gemuk', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `file` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `title`, `tanggal`, `deskripsi`, `file`, `is_active`) VALUES
(177, 'www', '2022-05-13', 'rrrr', 'www.pdf', 'Y'),
(514, 'dani', '2022-05-13', 'qqqq', 'dani.docx', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_akademik` varchar(30) NOT NULL,
  `keterangan` varchar(400) NOT NULL,
  `isaktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `semester`, `tahun_akademik`, `keterangan`, `isaktif`) VALUES
(1, 'Genap', '2019/2020', 'Pengisian Kuesioner Layanan Manajemen Universitas Catur Insan Cendekia', 'false'),
(2, 'Ganjil', '2020/2021', 'Pengisian Kuesioner Layanan Manajemen Universitas Catur Insan Cendekia', 'false'),
(3, 'Genap', '2022/2023', 'asd', 'true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personality`
--

CREATE TABLE `personality` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `jawaban` enum('Y','N','TS') NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `personality`
--

INSERT INTO `personality` (`id`, `pertanyaan`, `jawaban`, `is_active`, `date_created`) VALUES
(536, 'asdasdsa', 'TS', 'N', '2022-05-05'),
(706, 'hakim', 'Y', 'Y', '2022-05-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `respon`
--

CREATE TABLE `respon` (
  `id_respon` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `typeaspek` enum('akademik','kelola') NOT NULL,
  `nis` varchar(30) NOT NULL,
  `jawabanHarapan` varchar(2) NOT NULL,
  `harapanK` int(11) NOT NULL,
  `harapanC` int(11) NOT NULL,
  `jawabanKenyataan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `respon`
--

INSERT INTO `respon` (`id_respon`, `id_periode`, `id_kuesioner`, `id_aspek`, `typeaspek`, `nis`, `jawabanHarapan`, `harapanK`, `harapanC`, `jawabanKenyataan`) VALUES
(396, 1, 1, 1, 'akademik', '23123123', '1', 1, 0, ''),
(397, 1, 2, 1, 'akademik', '23123123', '1', 1, 0, ''),
(398, 1, 3, 1, 'akademik', '23123123', '1', 1, 0, ''),
(399, 1, 4, 1, 'akademik', '23123123', '0', 1, 0, ''),
(400, 1, 5, 1, 'akademik', '23123123', '0', 1, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses_menu`
--

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akses_menu`
--

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES
(1, 1, 1, 'Y'),
(2, 1, 2, 'Y'),
(43, 4, 1, 'Y'),
(44, 4, 2, 'N'),
(62, 5, 1, 'N'),
(63, 5, 2, 'N'),
(64, 1, 52, 'Y'),
(65, 4, 52, 'N'),
(66, 5, 52, 'N'),
(67, 1, 53, 'N'),
(68, 2, 53, 'N'),
(69, 3, 53, 'Y'),
(70, 1, 54, 'N'),
(71, 2, 54, 'N'),
(72, 3, 54, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses_submenu`
--

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akses_submenu`
--

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(7, 1, 8, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(13, 1, 14, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(26, 1, 15, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(30, 1, 17, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(32, 1, 18, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(34, 1, 19, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(36, 1, 20, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(59, 4, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(60, 4, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(61, 4, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(62, 4, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(63, 4, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(64, 4, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(65, 4, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(66, 4, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(67, 4, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(68, 4, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(72, 5, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(73, 5, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(74, 5, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(75, 5, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(76, 5, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(77, 5, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(78, 5, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(79, 5, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(80, 5, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(81, 5, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(82, 1, 23, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(83, 4, 23, 'N', 'N', 'N', 'N', 'N', 'N'),
(84, 5, 23, 'N', 'N', 'N', 'N', 'N', 'N'),
(85, 1, 24, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(86, 4, 24, 'N', 'N', 'N', 'N', 'N', 'N'),
(87, 5, 24, 'N', 'N', 'N', 'N', 'N', 'N'),
(88, 1, 25, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(89, 2, 25, 'N', 'N', 'N', 'N', 'N', 'N'),
(90, 3, 25, 'N', 'N', 'N', 'N', 'N', 'N'),
(91, 1, 26, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(92, 2, 26, 'N', 'N', 'N', 'N', 'N', 'N'),
(93, 3, 26, 'N', 'N', 'N', 'N', 'N', 'N'),
(94, 1, 27, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(95, 2, 27, 'N', 'N', 'N', 'N', 'N', 'N'),
(96, 3, 27, 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, 'Y', 'Y'),
(2, 'System', '#', 'fas fa-cogs', 4, 'Y', 'Y'),
(52, 'Master Data', 'master', 'fas fa-hand-point-down', 2, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) UNSIGNED NOT NULL,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES
(1, 'Menu', 'menu', 'far fa-circle', 2, 'Y'),
(2, 'SubMenu', 'submenu', 'far fa-circle', 2, 'Y'),
(7, 'Aplikasi', 'aplikasi', 'far fa-circle', 2, 'Y'),
(8, 'User', 'user', 'far fa-circle', 2, 'Y'),
(10, 'User Level', 'userlevel', 'far fa-circle', 2, 'Y'),
(15, 'Barang', 'barang', 'far fa-circle', 32, 'Y'),
(17, 'Kategori', 'kategori', 'far fa-circle', 32, 'Y'),
(18, 'Satuan', 'satuan', 'far fa-circle', 32, 'Y'),
(19, 'Pembelian', 'pembelian', 'far fa-circle', 41, 'Y'),
(20, 'Penjualan', 'penjualan', 'far fa-circle', 41, 'Y'),
(23, 'Materi Session', 'materi', 'fas fa-bible', 52, 'Y'),
(24, 'Siswa', 'siswa', 'fas fa-user-astronaut', 52, 'Y'),
(25, 'kuesioner', 'kuesioner', 'fas fa-question', 52, 'Y'),
(26, 'Personality Test', 'personality', 'fab fa-product-hunt', 52, 'Y'),
(27, 'Career', 'career', 'fas fa-user-md', 52, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nis` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nis`, `username`, `full_name`, `password`, `email`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_level`, `image`, `is_active`) VALUES
(1, 0, 'admin', 'Administrator', '$2y$10$sjPrxBpeFs438dZD3F67MOgd3Ub0dNvYhobdIUok1HFmkIC61BnMG', '', '', '0000-00-00', '', 1, 'admin1.jpg', 'Y'),
(34, 23123123, 'dani', 'Danilh', '$2y$05$6B/ZJMEmRP.FFgCaJtfVsuS3/.RKKwK/gDUxuhOQCRxiraT8KnxBi', 'danilukman2206@gmail.com', 'Banyumas', '2022-05-05', 'Banyumas', 3, 'dani.png', 'Y'),
(37, 31231222, 'lukimannnn', 'Dani Lukman', '$2y$05$3Q6K6OnUuUHDVkq2ZqImx.boC21q2BBfkIuf1S3TcyALxNtnNKyFW', 'dhanispeed90@yahoo.co.id', 'Banyumas', '2022-05-05', 'Banyumas', 3, 'lukiman.jpg', 'Y'),
(39, 0, 'agus', 'agus ibad', '$2y$05$DmqQ.5fkMkULCi9od00WiO7FKJNamiMNVU34qRuc7XGFxyxgsGgsm', '', '', '0000-00-00', '', 2, 'agus.png', 'Y'),
(40, 0, 'ade', 'aderohmat', '$2y$05$Dg3qmcRgV4XUfRDUYiP5J.F4Evx28dLrJMrq36W6ZkGx1lHtYFZvC', '', '', '0000-00-00', '', 2, 'ade.jpg', 'Y'),
(100, 0, 'hakim', 'hakim', '$2y$05$aQgZ.K0c9a1cZwTf5LERu.NxWVIqhDZn7KpxWDGBm.G4/bH1E/hJa', '', '', '0000-00-00', '', 2, NULL, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'Guru'),
(3, 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aspek`
--
ALTER TABLE `aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indeks untuk tabel `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `personality`
--
ALTER TABLE `personality`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `respon`
--
ALTER TABLE `respon`
  ADD PRIMARY KEY (`id_respon`);

--
-- Indeks untuk tabel `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9052023;

--
-- AUTO_INCREMENT untuk tabel `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `respon`
--
ALTER TABLE `respon`
  MODIFY `id_respon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT untuk tabel `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
