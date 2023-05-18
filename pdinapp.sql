-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 11:51 AM
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
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `biaya_sewa` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama`, `slug`, `deskripsi`, `biaya_sewa`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(3, 'Gergaji mesin 2', 'gergaji-mesin-2', 'asdfasdf', 20000, NULL, '2023-05-10', NULL, '2023-05-10'),
(4, 'Gergaji mesin 3', 'gergaji-mesin-3', 'a', 20000, NULL, '2023-05-10', NULL, '2023-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `excerp` text NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '',
  `kategori` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL,
  `template_file` varchar(255) NOT NULL,
  `search_engine_index` enum('Y','N') NOT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `tgl_terbit` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `konten`, `excerp`, `meta_description`, `slug`, `kategori`, `status`, `template_file`, `search_engine_index`, `id_file_picker`, `tgl_terbit`, `created_at`, `id_admin_create`, `updated_at`, `id_admin_update`, `featured_image`) VALUES
(1, 'Soft Launching', '<h3>Coba</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate vero obcaecati natus adipisci necessitatibus eius, enim vel sit ad reiciendis. consectetur adipisicing elit. Voluptate vero obcaecati natus adipisci necessitatibus eius, enim vel sit ad reiciendasdni reiciendis.</p>', 'abc', 'abc', 'soft-launching', 'Kegiatan', '', '', '', NULL, '2023-05-17 15:00:49', NULL, 0, NULL, 0, 'Logo-PDIN.png'),
(2, 'Soft Launching 2', '<h3>Coba</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate vero obcaecati natus adipisci necessitatibus eius, enim vel sit ad reiciendis. consectetur adipisicing elit. Voluptate vero obcaecati natus adipisci necessitatibus eius, enim vel sit ad reiciendasdni reiciendis.</p>', 'abc', 'abc', 'soft-launching-2', 'Kegiatan', '', '', '', NULL, '2023-05-17 15:00:49', NULL, 0, NULL, 0, 'Logo-PDIN.png');

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
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2023-05-15 12:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'flaminggooo50@gmail.com', '$2y$10$pKADotXOGD2RARj2BKdyQu4eHcJZNHRsD5cGza4prdYSQF369VOku', NULL, NULL, 0, '2023-05-15 12:40:12', '2023-05-15 12:29:42', '2023-05-15 12:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-15 12:40:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `id` int(11) UNSIGNED NOT NULL,
  `id_kategori_galeri` int(11) UNSIGNED DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_alat`
--

CREATE TABLE `galeri_alat` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_alat` int(11) UNSIGNED DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri_alat`
--

INSERT INTO `galeri_alat` (`id`, `id_alat`, `id_file_picker`, `nama_file`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, 4, NULL, '1.png', NULL, '2023-05-10 14:51:44', NULL, '2023-05-10 14:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_ruangan`
--

CREATE TABLE `galeri_ruangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_ruangan` int(11) UNSIGNED DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri_ruangan`
--

INSERT INTO `galeri_ruangan` (`id`, `id_ruangan`, `id_file_picker`, `nama_file`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, 6, NULL, '2.png', NULL, '2023-05-10 06:08:00', NULL, '2023-05-10 06:08:00'),
(2, 6, NULL, '5ea50f43831c2_1.png', NULL, '2023-05-10 06:08:00', NULL, '2023-05-10 06:08:00');

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
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `deskripsi`, `id_file_picker`, `tempat`, `tgl_mulai`, `tgl_selesai`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, 'Pameran Seni', 'Pameran seni', NULL, 'alun-alun', '2023-04-24 16:34:44', '2023-04-25 14:34:44', NULL, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Pameran Busana', 'Pameran Busana', NULL, 'Ruang bawah', '2023-04-27 10:31:50', '2023-04-28 10:31:50', NULL, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(10) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `deskripsi`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Riset Produk', 'Riset produk', 'riset produk.png', '2023-04-19 09:46:22', NULL),
(2, 'Pengembangan Prototype', 'Pengembangan prototype', 'pengembangan prototype.png', '2023-04-19 09:46:22', NULL),
(3, 'Sewa Ruangan', 'Sewa ruangan', 'sewa ruangan.png', '2023-04-19 09:46:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1684129818, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1684129818, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1684129818, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tipe` enum('Pameran','Kantor','Meeting','Lainnya') DEFAULT NULL,
  `lantai` int(1) DEFAULT NULL,
  `kapasitas` int(10) UNSIGNED DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `luas` int(3) NOT NULL,
  `fasilitas` text DEFAULT NULL,
  `biaya_sewa` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `slug`, `deskripsi`, `tipe`, `lantai`, `kapasitas`, `ukuran`, `luas`, `fasilitas`, `biaya_sewa`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, 'Ruang A', 'ruang-a', 'Ruang A', 'Pameran', 1, 100, '7m x 8m x 3m', 56, NULL, 100000, NULL, '2023-04-24', NULL, NULL),
(2, 'Ruang B', 'ruang-b', 'asd', 'Kantor', 1, 50, '10m x 7m x 3m', 70, NULL, 100000, NULL, NULL, NULL, NULL),
(3, 'ruang C', 'ruang-c', 'ruang c', 'Meeting', 3, 50, '7m x 7m x 7m', 343, 'AC', NULL, NULL, NULL, NULL, NULL),
(4, 'ruang z', 'ruang-z', 'ruang penuh dengan fitur berkualitas', 'Pameran', 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'asdfasdfasdfasd', 'asdfasdfasdfasd', 'asdfasdf', 'Meeting', 1, 20, '5m x 5m x 3', 25, 'ac', 10000, NULL, '2023-05-10', NULL, '2023-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sewa_alat`
--

CREATE TABLE `sewa_alat` (
  `id` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_invoice` char(13) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT 'tanggal transaksi',
  `updated_at` datetime DEFAULT NULL,
  `tgl_mulai_sewa` datetime NOT NULL,
  `tgl_akhir_sewa` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('SUDAH DIBAYAR','BELUM DIBAYAR') NOT NULL,
  `status_transaksi` enum('SELESAI','TERTUNDA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sewa_alat`
--

INSERT INTO `sewa_alat` (`id`, `id_alat`, `nama_kegiatan`, `deskripsi`, `no_invoice`, `id_user`, `created_at`, `updated_at`, `tgl_mulai_sewa`, `tgl_akhir_sewa`, `total_biaya`, `tgl_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `status_transaksi`) VALUES
(1, 1, 'Print action figure', 'Print action figure', 'abc', 1, '2023-04-25 16:54:30', NULL, '2023-04-25 16:54:30', '2023-04-27 21:54:31', 100, '2023-04-25 16:54:30', '', 'SUDAH DIBAYAR', 'SELESAI');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_ruangan`
--

CREATE TABLE `sewa_ruangan` (
  `id` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_invoice` char(13) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT 'tanggal transaksi',
  `updated_at` datetime DEFAULT NULL,
  `tgl_mulai_sewa` datetime NOT NULL,
  `tgl_akhir_sewa` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('SUDAH DIBAYAR','BELUM DIBAYAR') DEFAULT NULL,
  `status_transaksi` enum('SELESAI','TERTUNDA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sewa_ruangan`
--

INSERT INTO `sewa_ruangan` (`id`, `id_ruangan`, `nama_kegiatan`, `deskripsi`, `no_invoice`, `id_user`, `created_at`, `updated_at`, `tgl_mulai_sewa`, `tgl_akhir_sewa`, `total_biaya`, `tgl_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `status_transaksi`) VALUES
(1, 1, 'Products Showcase', 'Products showcase', 'abc', 1, '2023-04-25 16:54:30', NULL, '2023-04-25 16:54:30', '2023-04-27 21:54:31', 100, '2023-04-25 16:54:30', '', 'SUDAH DIBAYAR', 'SELESAI'),
(14, 1, 'asdfasdf', 'asdfasdf', '', 6, '2023-05-05 12:30:07', '2023-05-05 12:30:07', '2023-05-13 00:00:00', '2023-05-18 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(15, 1, 'asdfasdf', 'a', '', 7, '2023-05-05 13:11:24', '2023-05-05 13:11:24', '2023-05-06 00:00:00', '2023-05-04 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(16, 1, 'kjnkhk', 'iiijiij', '', 13, '2023-05-11 06:00:26', '2023-05-11 06:00:26', '2023-05-19 00:00:00', '2023-05-25 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'fikwkwk', NULL, NULL, 1, '2023-05-15 13:15:24', '2023-05-15 12:29:42', '2023-05-15 12:29:42', NULL);

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
  ADD PRIMARY KEY (`id`) USING BTREE;

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
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `file_picker`
--
ALTER TABLE `file_picker`
  ADD PRIMARY KEY (`id_file_picker`) USING BTREE;

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `galeri_alat`
--
ALTER TABLE `galeri_alat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `galeri_ruangan`
--
ALTER TABLE `galeri_ruangan`
  ADD PRIMARY KEY (`id`) USING BTREE;

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
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa_alat`
--
ALTER TABLE `sewa_alat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sewa_ruangan`
--
ALTER TABLE `sewa_ruangan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_picker`
--
ALTER TABLE `file_picker`
  MODIFY `id_file_picker` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri_alat`
--
ALTER TABLE `galeri_alat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galeri_ruangan`
--
ALTER TABLE `galeri_ruangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa_alat`
--
ALTER TABLE `sewa_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sewa_ruangan`
--
ALTER TABLE `sewa_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
