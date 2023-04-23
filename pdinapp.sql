-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 08:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdinapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `status` enum('active','suspended','deleted') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabel user untuk login' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `biaya_sewa` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `tgl_input` date DEFAULT curdate(),
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `tgl_update` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama`, `deskripsi`, `biaya_sewa`, `id_admin_create`, `tgl_input`, `id_admin_update`, `tgl_update`) VALUES
(1, 'Printer 3D', 'Printer 3D', NULL, NULL, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) UNSIGNED NOT NULL,
  `judul_artikel` varchar(50) NOT NULL,
  `konten` text NOT NULL,
  `excerp` text NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '',
  `status` enum('draft','published') NOT NULL,
  `template_file` varchar(255) NOT NULL,
  `search_engine_index` enum('Y','N') NOT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `tgl_terbit` datetime DEFAULT NULL,
  `tgl_create` datetime DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `artikel_author`
--

CREATE TABLE `artikel_author` (
  `id_artikel` int(10) UNSIGNED NOT NULL,
  `id_author` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `artikel_kategori`
--

CREATE TABLE `artikel_kategori` (
  `id_artikel` int(10) UNSIGNED NOT NULL,
  `id_kategori` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id_author` smallint(6) UNSIGNED NOT NULL,
  `nama_author` varchar(50) NOT NULL,
  `id_admin_author` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `file_picker`
--

CREATE TABLE `file_picker` (
  `id_file_picker` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `description` text NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `tgl_upload` datetime NOT NULL DEFAULT current_timestamp(),
  `id_admin_upload` int(10) UNSIGNED NOT NULL,
  `meta_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) UNSIGNED NOT NULL,
  `id_kategori_galeri` int(11) UNSIGNED DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `urut` tinyint(1) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `tgl_input` date DEFAULT curdate(),
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `tgl_update` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` smallint(5) UNSIGNED NOT NULL,
  `judul_kategori` varchar(255) NOT NULL,
  `id_admin_author` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_galeri`
--

CREATE TABLE `kategori_galeri` (
  `id_kategori_galeri` smallint(5) UNSIGNED NOT NULL,
  `judul_kategori` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urut` smallint(5) UNSIGNED DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'Y',
  `layout` enum('grid','masonry') DEFAULT 'grid',
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `tgl_create` datetime DEFAULT current_timestamp(),
  `id_admin_update` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `tgl_input` date DEFAULT curdate(),
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `tgl_update` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `deskripsi`, `id_file_picker`, `tempat`, `tgl_mulai`, `tgl_selesai`, `id_admin_create`, `tgl_input`, `id_admin_update`, `tgl_update`) VALUES
(1, 'Pameran Seni', 'Pameran seni', NULL, 'alun-alun', '2023-04-24 16:34:44', '2023-04-25 14:34:44', NULL, '0000-00-00', NULL, NULL),
(2, 'Pameran Busana', 'Pameran Busana', NULL, 'Ruang bawah', '2023-04-27 10:31:50', '2023-04-28 10:31:50', NULL, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(10) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Riset Produk', 'Riset produk', 'riset produk.png', '2023-04-19 09:46:22', NULL),
(2, 'Pengembangan Prototype', 'Pengembangan prototype', 'pengembangan prototype.png', '2023-04-19 09:46:22', NULL),
(3, 'Sewa Ruangan', 'Sewa ruangan', 'sewa ruangan.png', '2023-04-19 09:46:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tipe` enum('indoor','outdoor') DEFAULT 'indoor',
  `kapasitas` int(10) UNSIGNED DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `biaya_sewa` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `tgl_input` date DEFAULT curdate(),
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `tgl_update` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `deskripsi`, `tipe`, `kapasitas`, `ukuran`, `fasilitas`, `biaya_sewa`, `id_admin_create`, `tgl_input`, `id_admin_update`, `tgl_update`) VALUES
(1, 'Ruang A', 'Ruang A', 'indoor', 100, '7m x 8m x 3m', NULL, NULL, NULL, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sewa_ruangan`
--

CREATE TABLE `sewa_ruangan` (
  `id_sewa_ruangan` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `no_invoice` char(13) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `tgl_mulai_sewa` datetime NOT NULL,
  `tgl_akhir_sewa` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('SUDAH DIBAYAR','BELUM DIBAYAR') NOT NULL,
  `status_transaksi` enum('SELESAI','TERTUNDA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabel user' ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`) USING BTREE;

--
-- Indexes for table `artikel_author`
--
ALTER TABLE `artikel_author`
  ADD PRIMARY KEY (`id_artikel`,`id_author`) USING BTREE;

--
-- Indexes for table `artikel_kategori`
--
ALTER TABLE `artikel_kategori`
  ADD PRIMARY KEY (`id_artikel`,`id_kategori`) USING BTREE;

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`) USING BTREE;

--
-- Indexes for table `file_picker`
--
ALTER TABLE `file_picker`
  ADD PRIMARY KEY (`id_file_picker`) USING BTREE;

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`) USING BTREE;

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`) USING BTREE;

--
-- Indexes for table `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  ADD PRIMARY KEY (`id_kategori_galeri`) USING BTREE;

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`) USING BTREE;

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sewa_ruangan`
--
ALTER TABLE `sewa_ruangan`
  ADD PRIMARY KEY (`id_sewa_ruangan`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_picker`
--
ALTER TABLE `file_picker`
  MODIFY `id_file_picker` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  MODIFY `id_kategori_galeri` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sewa_ruangan`
--
ALTER TABLE `sewa_ruangan`
  MODIFY `id_sewa_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
