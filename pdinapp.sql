-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 08:56 AM
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
(6, 'Printer 3D', 'Printer-3D', 'Printer 3D', 0, NULL, '2023-05-30', NULL, '2023-05-30'),
(7, 'Pemotong Logam', 'pemotong-logam', 'Pemotong Logam', 0, NULL, '2023-05-30', NULL, '2023-05-30'),
(8, 'Pemotong Kayu', 'pemotong-kayu', 'Pemotong kayu', 0, NULL, '2023-05-30', NULL, '2023-05-30');

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
(3, 'Jogja Design Merch#1', '<p><b>Yogyakarta</b> - Jogja Design Merch#1 merupakan salah satu gebrakan dari PDIN untuk memberikan apresiasi terhadap designer yang berkompeten melalui lomba mendesain produk cinderamata. Lomba Jogja Merch#1 akan dibuka pendaftarannya pada tang 6 Maret sampai dengan tanggal 17 Maret 2023. Sebelum dibukanya pendaftaran, Dinas Perindustrian Koperasi Usaha Kecil dan Menengah Kota Yogyakarta melakukan Konferensi Pers di Gedung PDIN dan ditayangkan langsung melalui kanal youtub Pemkot Jogja pada tanggal 6 Maret 2023 pada pukul 14.00 WIB. Konferensi Pers ini dihadiri oleh berbagai macam awak media terkait. </p>\r\n<p>Adapun syarat-syarat untuk dapat mendaftar di Lomba desain tersebut, diantaranya ialah memiliki volume yang mudah dibawa kemana-mana, menggunakan material yang aman untuk keselamatan orang lain, memiliki khas tradisi Yogyakarta, dan lain-lain. Peserta pendaftar lomba akan melalui tahap kurasi dan diambil 20 desain terbaik yang nantinya akan dilanjutkan untuk proses pembuatan prototype sampai produk jadi yang akan dibiayai oleh panitia sebesar 1 Juta setiap peserta (individual tau kelompok). Pemenang lomba desain akan mendapatkan hadia sebesar 10 Juta untuk 3 Karya terbaik. </p>\r\n', 'abc', 'Jogja Design Merch#1 merupakan salah satu gebrakan dari PDIN untuk memberikan apresiasi terhadap designer yang berkompeten melalui lomba mendesain produk cinderamata.', 'Jogja-Design-Merch-1', 'Pameran', 'published', '', '', NULL, '2023-03-06 13:13:17', NULL, 0, NULL, 0, 'gambar-artikel-jdm.jpg'),
(4, 'Pameran Kaca: Glass Beyond Borders', '<p><b>Yogyakarta</b> - Glass Beyond Borders/Kaca Melampaui Batas-Batas merupakan sebuah proyek kolaborasi antar dua seniman kaca, yakni Ivan Bestari (Indonesia) dan Hannah Gibson (Inggris). Ivan dan Hannah dikenal sebagai seniman kaca yang menggunakan limbah kaca sebagai bahan utama mereka. Namun, masing-masing menggunakan metode olah kaca yang sangat berbeda secara teknis. Proyek kolaborasi ini bertujuan untuk menemukan peluang perpaduan dari dua metode olah kaca yang dikuasai oleh masing- masing seniman. Dalam proyek ini kedua seniman melakukan kolaborasi, baik dalam penciptaan karya bersama maupun dalam menyusun perencanaan dan materi lokakarya yang diikuti oleh mahasiswa Program Studi Desain Produk Universitas Kristen Duta Wacana (UKDW) dan juga peserta lokakarya umum.</p>\r\n<p>Perihal \"melampaui batas-batas\" yang dimaksudkan dalam judul proyek tersebut bisa dijabarkan dari beberapa sudut pandang. Batasan yang ingin coba dilampaui bisa berupa berbagai hal, misalkan batasan negara, batasan teknologi, batasan bahasa, bahkan juga batasan ranah lingkup kerja. Proyek ini tidak hanya bertumpu pada target pencapaian kolaborasi dari dua seniman dan hanya berhenti di ranah seni rupa, tetapi proyek ini diharapkan menjadi sarana untuk memperkenalkan metode olah limbah kaca kepada masyarakat luas melalui sisi akademis dan juga stakeholders! pemangku kepentingan yang mendukung jalannya proyek ini. Bahwa olah limbah kaca itu memungkinkan dilakukan di dalam skala studio seniman berarti mempunyai peluang untuk direplikasi menjadi skala usaha rumahan tanpa kebutuhan infrastruktur yang berskala industri besar. Atas pertimbangan tersebut maka Glass Beyond Borders juga mencoba untuk berbagi wawasan mengenai olah kaca terhadap berbagai pihak dengan melaksanakan lokakarya, paparan dalam bentuk temu wicara, serta presentasi metode olah kaca dalam bentuk pameran.\r\n</p>', 'abc', 'Glass Beyond Borders/Kaca Melampaui Batas-Batas merupakan sebuah proyek kolaborasi antar dua seniman kaca, yakni Ivan Bestari (Indonesia) dan Hannah Gibson (Inggris).', 'Pameran-Kaca-Glass-Beyond-Borders', 'Pameran', 'published', '', '', NULL, '2023-03-06 15:13:17', NULL, 0, NULL, 0, 'gambar-artikel-pameran-kaca.jpg'),
(5, 'Kunjungan Sri Sultan Hamengku Buwono X ke Pusat Desain Industri Nasional', '<p><b>Yogyakarta</b> - Pusat Desain Industri Nasional (PDIN) dikunjungi oleh Gubernur Daerah Istimewa Yogyakarta, Sri Sultan Hamengku Buwono X didampingi beberapa struktural Pemerintah Daerah DIY. Kunjungan ini diterima oleh Pj Walikota Yogyakarta Bapak Sumadi, S.H., M.H., Asisten Perekonomian dan Pembangunan Bapak Drs. Kadri Renggono, M.Si., Kepala Dinas Perindustrian Koperasi UKM Bapak Drs. Tri Karyadi Riyanto Raharjo, S.H., M.Si., serta beberapa Kepala OPD di lingkungan Pemerintah Kota Yogyakarta.</p>\r\n<p>Kegiatan ini dalam rangka kunjungan kerja Gubernur DIY untuk melihat program kerja yang akan dilaksanakan di Pusat Desain Industri Nasional (PDIN) yang sudah diselesaikan pembangunannya pada akhir tahun 2022 lalu. </p>\r\n<p>Pusat Desain Industri Nasional (PDIN) merupakan hasil dari rencana kerja yang disepakati oleh Ditjen IKMA Kementerian Perindustrian, Pemda DIY dan Pemerintah Kota Yogyakarta dengan tujuan untuk menjadi pusat pengembangan desain guna meningkatkan daya saing industri kecil dan menengah nasional. PDIN akan dijadikan sebagai wadah dalam mempertemukan antara desainer, pelaku industri, akademisi, penyedia bahan baku, eksportir, dan berbagai pemangku kepentingan lainnya dalam pengembangan bisnis berbasis desain dan karakter industri. </p>\r\n<p>Kepala Dinas Perindustrian Koperasi UKM Kota Yogyakarta, Drs. Tri Karyadi Riyanto R, S.H. M.Si menyampaikan bahwa Kota Yogyakarta dipilih sebagai lokasi berdirinya PDIN oleh Kementerian Perindustrian dengan pertimbangan bahwa Yogyakarta dikenal sebagai pusat kerajinan dan produk kreatif di Indonesia, kekuatan dari sumber daya manusia dan pendidikan tersedia di Yogyakarta, Yogyakarta juga sebagai pusat perkembangan seni sebagai acuan tren dan kecenderungan masyarakat dunia serta potensi industri fashion Yogyakarta menuju kota pusat fashion dunia. Dalam jangka pendek, PDIN akan berfokus mendorong pengembangan desain pada 3 komoditas yaitu fesyen, logam, dan kayu. </p>\r\n<p>Gubernur DIY, Sri Sultan Hamengku Buwono X mengunjungi fasilitas yang ada di PDIN seperti ruang workshop kayu dan logam, ruang pameran, area plaza, area co-working, ruang rapat, rooftop, dan berbagai fasilitas lainnya, serta berkesempatan mendengar pemaparan program PDIN dari Kepala Dinas Perindustrian Koperasi UKM Kota Yogyakarta, Drs Tri Karyadi Riyanto Raharjo S.H., M.Si., serta mendengarkan laporan dari Kepala Dinas Perindustrian dan Perdagangan DIY Ibu Ir. Syam Arjanti, MPA. </p>\r\n<p>Sri Sultan Hamengku Buwono X memberikan beberapa arahan, yaitu agar pemerintah Kota Yogyakarta memperhatikan aspek kelembagaan dan manajemen pengelolaan PDIN terlebih dahulu agar segala program dapat dijalankan dengan profesional, PDIN harus dapat menjamin adanya standarisasi, kualitas, dan mutu produknya. serta agar PDIN dapat memberikan manfaat yang sebesar-besarnya dan memberikan kontribusi kepada masyarakat. Pihaknya juga berpesan untuk melibatkan anak muda jurusan desain dan grafis untuk menciptakan desain-desain eksklusif untuk menaikan harga dan daya saing produk fesyen di Jogja. </p>', 'abc', 'Pusat Desain Industri Nasional (PDIN) dikunjungi oleh Gubernur Daerah Istimewa Yogyakarta, Sri Sultan Hamengku Buwono X didampingi beberapa struktural Pemerintah Daerah DIY. Kunjungan ini diterima oleh Pj Walikota Yogyakarta Bapak Sumadi, S.H., M.H., Asisten Perekonomian dan Pembangunan Bapak Drs. Kadri Renggono, M.Si., Kepala Dinas Perindustrian Koperasi UKM Bapak Drs. Tri Karyadi Riyanto Raharjo, S.H., M.Si., serta beberapa Kepala OPD di lingkungan Pemerintah Kota Yogyakarta.', 'Kunjungan-Sri-Sultan-Hamengku-Buwono-X-ke-Pusat-Desain-Industri-Nasional', 'Pameran', 'published', '', '', NULL, '2023-03-06 16:43:50', NULL, 0, NULL, 0, 'gambar-artikel-kunjungan-sri-sultan.jpg'),
(6, 'Pelatihan Batik di Pusat Desain Industri Nasional', '<p><b>Yogyakarta</b> —Dinas Perindustrian, Koperasi, dan UKM (Disperinkop UKM) Jogja mengadakan pelatihan batik yang diikuti 40 peserta selama Senin-Rabu (15-17/5/2023). Pelatihan tersebut dibagi dalam dua jenis, pelatihan batik cap dan pelatihan batik kontemporer yang semuanya digelar di Pusat Desain Industri Nasional (PDIN). </p>\r\n<p>Disperinkop UKM membuka pendaftaran peserta pelatihan secara terbuka dan umum dan diperoleh 120 pendaftar. “Lalu kami seleksi, kami pilih peserta pelatihan ini yang sudah punya usaha batik saja agar mereka bisa mengembangkan usahanya lebih inovatif lagi,” jelas Kepala Disperinkop UKM Jogja, Tri Karyadi Riyanto Raharjo, Senin (15/5/2023).\r\nTotok sapaan akrab Kepala Disperinkop UKM Jogja menjelaskan akan mengadakan pelatihan batik lagi semester depan. “Karena anggarannya dari APBN 2023, maka akan kami fasilitasi lagi nanti calon peserta pada semester depan setelah perubahan anggaran. Sangat baik sekali animonya ternyata,” katanya.\r\nPeserta pelatihan, jelas Totok, juga akan memamerkan hasil karya dari pelatihan ini lewat fashion show yang akan digelar  Senin (22/5/2023) mendatang. “Tujuan kami bikin pelatihan ini agar pembatik Jogja makin berkembang inovasinya dan bisa menyesuaikan permintaan pasar dengan baik,” ujarnya.\r\nSubkoordinator Kelompok Substansi Pembinaan Standarisasi Industri Disperinkop UKM Jogja Heri Karuniawan menyebut pelatihan tersebut diselenggarakan gratis dan intensif dari pagi pukul 08.00 sampai sore 15.00. “Pelatihan ini sangat intensif jadi ada target yang harus dicapai peserta, harapannya makin inovatif peserta ini dan bisa mengembangkan produk batiknya,” jelasnya, Senin siang.\r\nHeri menyebut pelatihan batik tersebut dilatih oleh praktisi ahli. “Pelatihan ini sangat membantu pelaku usaha batik karena dibimbing langsung oleh ahli, jadi dipastikan nanti hasil karya peserta juga sangat layak diapresiasi dalam fashion show,” terangnya.\r\nPelatih pelatihan batik Disperinkop UKM Jogja, Iwan Setiawan menjelaskan peserta sangat antusias dalam mengikuti pelatihan tersebut. “Saya mengisi materi batik kontemporer dimana mediumnya kaos, ini terutama untuk mengambil peluang pasar dari wisatawan yang berkunjung ke Jogja, karena masih sedikit yang berinovasi dengan batik kaos,” ucapnya.\r\nIwan berharap lewat pelatihan batik tersebut peserta dapat memaksimalkan materi dan mengembangkan karya sesuai inovasi dan kebutuhan pasar. “Saya juga aktif usaha di kaos batik peminatnya luar biasa, sehingga lewat pelatihan ini sama-sama berinovasi agar pasar batik kontemporer dapat terus diisi oleh pelaku usaha Jogja,” katanya. </p>', 'abc', 'Dinas Perindustrian, Koperasi, dan UKM (Disperinkop UKM) Jogja mengadakan pelatihan batik yang diikuti 40 peserta selama Senin-Rabu (15-17/5/2023). Pelatihan tersebut dibagi dalam dua jenis, pelatihan batik cap dan pelatihan batik kontemporer yang semuanya digelar di Pusat Desain Industri Nasional (PDIN).', 'Pelatihan-Batik-di-Pusat-Desain-Industri-Nasional', 'Pameran', 'published', '', '', NULL, '2023-03-06 19:43:50', NULL, 0, NULL, 0, 'gambar-artikel-pelatihan-batik.jpg'),
(7, 'Pameran Kulit: Leather Innofashion Expo 2023', '<p>YOGYAKARTA (Simpony) – Setelah rampung dibangun pada Desember 2022, Pusat Desain Industri Nasional (PDIN) per Januari 2023 sudah mulai digunakan untuk kegiatan Industri Kecil Menengah (IKM). Salah satunya adalah Leather Innofashion Expo 2023, yang merupakan kerja sama antara Politeknik ATK Yogyakarta dengan Pemerintah Kota Yogyakarta melalui Dinas Perindustrian Koperasi dan UKM. </p>\r\n<p>Asisten Bidang Perekonomian dan Pembangunan Setda Kota Yogyakarta, Kadri Renggono mengatakan, setelah bangunan PDIN sudah selesai dikerjakan, strategi yang penting untuk dilakukan adalah membangun awareness. Dengan mengkomunikasikan kehadiran PDIN kepada seluruh masyarakat terutama stakeholder kunci.\r\n“Saat ini kami sedang menyusun dan memperkuat pada aspek manajemen, legalitas, dasar hukum untuk pengelolaan PDIN. Tentu harapan kita semua sebagaimana tujuan awal PDIN ini adalah menjadi sebuah sub sistem dari Industri Kecil Menengah dalam skala nasional dan secara keseluruhan agar semakin berkembang. Menjembatani serta memperkuat produk IKM yang berbasis desain,” jelasnya pada saat pembukaan Leather Innofashion Expo 2023, pada Jumat (13/1/2023).\r\nSelain itu, lanjut Kadri Renggono, PDIN ini tujuannya juga untuk mendorong IKM supaya mempunyai daya saing yang lebih baik dalam skala nasional sampai internasional. Sebab dari sisi Sumber Daya Manusia (SDM), Jogja punya banyak desainer, dan lembaga pendidikan yang menciptakan desainer berkualitas.\r\n“Manajemen dan sistem pemeliharaan operasional PDIN tengah disusun untuk meningkatkan kapasitas SDM serta pelaku IKM, agar lebih berkembang dalam melihat pasar dan memajukan daya saing produk. Kira-kira pada Juni nanti kami akan Grand Opening, dengan harapan semakin banyak pihak yang beraktivitas dan melihat peluang PDIN sebagai tempat untuk mengembangkan IKM,” imbuhnya.\r\nDirektur Politeknik ATK Yogyakarta, Sugiyanto menyampaikan, Leather Innofashion Expo 2023 merupakan wujud kerja sama dengan Pemerintah Kota Yogyakarta dalam memperkenalkan sebuah lembaga pengembangan desain yaitu PDIN, yang bertujuan untuk meningkatkan daya saing IKM nasional, termasuk bagi para 100 mahasiswa jurusan teknologi pengolahan produk kulit Politeknik ATK Yogyakarta dalam menampilkan hasil karyanya.\r\n“Berdasarkan dengan tujuannya, kami berharap PDIN bisa menjadi communal space yang berfungsi sebagai pusat informasi dan referensi desain berdasarkan jenis industri dan pasar dalam skala nasioal hingga global. Sebab Jogja merupakan kota yang potensial menjadi pasar global untuk produk inovatif dan kreatif yang dihasilkan oleh para pelaku IKM,” terangnya.\r\n\r\nSugiyanto juga mengungkapkan, dengan kehadiran PDIN sebagai tempat yang berskala nasional maka stakeholder yang terlibat sangat luas dan beragam. Sehingga inspirasi yang akan hadir tentunya bisa menciptakan kolaborasi dalam menghasilkan desain produk yang berdaya saing tinggi.\r\n\r\nLeather Innofashion Expo 2023 berlangsung hingga Juni mendatang. Dengan rangkaian kegiatan Leather Product Exibition pada 13 dan 14 Januari, Talkshow Entrepreneur 25 Februari, Worksop Ecodesign 18 Maret, National Footwear Design Competition 14 April, Workshop Tenan Corner 14 dan 15 Mei, dan Fashion Show 24 Juni 2023. </p>', 'abc', 'Setelah rampung dibangun pada Desember 2022, Pusat Desain Industri Nasional (PDIN) per Januari 2023 sudah mulai digunakan untuk kegiatan Industri Kecil Menengah (IKM). Salah satunya adalah Leather Innofashion Expo 2023, yang merupakan kerja sama antara Politeknik ATK Yogyakarta dengan Pemerintah Kota Yogyakarta melalui Dinas Perindustrian Koperasi dan UKM.\r\n', 'Pameran-Kulit-Leather-Innofashion-Expo-2023', 'Pameran', 'published', '', '', NULL, NULL, '2023-03-06 20:51:29', 0, NULL, 0, 'gambar-artikel-pameran-kulit.jpg'),
(8, 'KUNJUNGAN GUBERNUR DAERAH ISTIMEWA YOGYAKARTA DI PUSAT DESAIN INDUSTRI NASIONAL', '<p>Pada Senin, 6 Februari 2023, Pusat Desain Industri Nasional (PDIN) dikunjungi oleh Gubernur Daerah Istimewa Yogyakarta, Sri Sultan Hamengku Buwono X didampingi beberapa struktural Pemerintah Daerah DIY. Kunjungan ini diterima oleh Pj Walikota Yogyakarta Bapak&nbsp;<em>Sumadi</em>,&nbsp;<em>S.H., M.H.</em><em>, Asisten Perekonomian dan Pembangunan Bapak</em>&nbsp;Drs.&nbsp;<em>Kadri Renggono</em>, M.Si., Kepala Dinas Perindustrian Koperasi UKM Bapak&nbsp;Drs.&nbsp;<em>Tri Karyadi Riyanto</em>&nbsp;Raharjo, S.H., M.Si., serta&nbsp;beberapa&nbsp;Kepala&nbsp;OPD di&nbsp;lingkungan Pemerintah Kota Yogyakarta.</p>\r\n<p>Kegiatan ini dalam rangka kunjungan kerja Gubernur DIY untuk melihat program kerja yang akan dilaksanakan di Pusat Desain Industri Nasional&nbsp;(PDIN)&nbsp;yang sudah diselesaikan pembangunannya pada akhir tahun 2022 lalu.</p>\r\n<p>Pusat Desain Industri Nasional (PDIN) merupakan hasil dari&nbsp;rencana&nbsp;kerja yang disepakati oleh&nbsp;Ditjen&nbsp;IKMA&nbsp;Kementerian Perindustrian, Pemda DIY dan Pemerintah Kota Yogyakarta&nbsp;dengan tujuan untuk menjadi pusat pengembangan desain guna meningkatkan daya saing industri kecil dan menengah nasional. PDIN akan dijadikan sebagai wadah dalam mempertemukan antara desainer, pelaku industri, akademisi, penyedia bahan baku, eksportir, dan berbagai pemangku kepentingan lainnya dalam pengembangan bisnis berbasis desain dan karakter industri.</p>\r\n<p>&nbsp;Kepala Dinas Perindustrian Koperasi UKM Kota Yogyakarta, Drs. Tri Karyadi Riyanto R, S.H. M.Si menyampaikan bahwa Kota Yogyakarta dipilih sebagai lokasi berdirinya PDIN oleh&nbsp;Kementerian Perindustrian&nbsp;dengan pertimbangan bahwa&nbsp;Yogyakarta dikenal sebagai pusat kerajinan dan produk kreatif di Indonesia, kekuatan dari sumber daya manusia dan pendidikan tersedia di Yogyakarta, Yogyakarta&nbsp;juga sebagai pusat perkembangan seni sebagai acuan tren dan kecenderungan masyarakat dunia serta potensi industri fashion Yogyakarta menuju kota pusat fashion dunia.&nbsp;Dalam jangka pendek, PDIN akan berfokus mendorong pengembangan desain pada 3 komoditas yaitu fesyen, logam, dan kayu.</p>\r\n<p>Gubernur DIY, Sri Sultan Hamengku Buwono X mengunjungi fasilitas yang ada di PDIN seperti ruang workshop kayu dan logam, ruang pameran, area plaza, area co-working, ruang rapat, rooftop, dan berbagai fasilitas lainnya, serta berkesempatan mendengar pemaparan program PDIN dari Kepala Dinas Perindustrian Koperasi UKM Kota Yogyakarta, Drs Tri Karyadi Riyanto Raharjo S.H., M.Si., serta mendengarkan laporan dari Kepala Dinas Perindustrian dan Perdagangan DIY Ibu Ir. Syam Arjanti, MPA.</p>\r\n<p>Sri Sultan Hamengku Buwono X memberikan beberapa arahan, yaitu agar pemerintah Kota Yogyakarta memperhatikan aspek kelembagaan dan manajemen pengelolaan PDIN terlebih dahulu agar segala program dapat dijalankan dengan profesional, PDIN harus dapat menjamin adanya standarisasi, kualitas, dan mutu produknya. serta agar PDIN dapat memberikan manfaat yang sebesar-besarnya dan memberikan kontribusi kepada masyarakat.&nbsp;Pihaknya juga berpesan untuk melibatkan anak muda jurusan desain dan grafis untuk menciptakan desain-desain eksklusif untuk menaikan harga&nbsp;dan daya saing produk <em>fashion</em> di Jogja.</p>', 'abc', 'Pada Senin, 6 Februari 2023, Pusat Desain Industri Nasional (PDIN) dikunjungi oleh Gubernur Daerah Istimewa Yogyakarta, Sri Sultan Hamengku Buwono X didampingi beberapa struktural Pemerintah Daerah DIY. Kunjungan ini diterima oleh Pj Walikota Yogyakarta Bapak Sumadi, S.H., M.H., Asisten Perekonomian dan Pembangunan Bapak Drs. Kadri Renggono, M.Si., Kepala Dinas Perindustrian Koperasi UKM Bapak Drs. Tri Karyadi Riyanto Raharjo, S.H., M.Si., serta beberapa Kepala OPD di lingkungan Pemerintah Kota Yogyakarta.', 'KUNJUNGAN-GUBERNUR-DAERAH-ISTIMEWA-YOGYAKARTA-DI-PUSAT-DESAIN-INDUSTRI-NASIONAL', 'PDIN', 'published', '', 'Y', NULL, '2023-02-07 20:55:00', '2023-06-03 13:56:39', 0, '2023-06-03 14:33:28', 0, '20230207121202.jpg');

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
(1, 1, 'admin', '2023-05-15 12:29:42'),
(2, 2, 'user', '2023-08-11 04:42:37');

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
(1, 1, 'email_password', NULL, 'flaminggooo50@gmail.com', '$2y$10$pKADotXOGD2RARj2BKdyQu4eHcJZNHRsD5cGza4prdYSQF369VOku', NULL, NULL, 0, '2023-08-02 08:06:24', '2023-05-15 12:29:42', '2023-08-02 08:06:24'),
(2, 2, 'email_password', NULL, 'ibn.damr@gmail.com', '$2y$10$hjxZGMHF5oKhwStaC50CuOPptIZSo4eB8oJ9aj7AOUIoqpOeG9N3a', NULL, NULL, 0, '2023-08-17 03:44:36', '2023-08-11 04:42:37', '2023-08-17 03:44:36');

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
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-15 12:40:12', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-22 07:02:00', 1),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-22 11:33:46', 1),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36 Edg/113.0.1774.42', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-22 12:34:31', 1),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'email_password', 'flaminggooo50@gmail.com', NULL, '2023-05-23 09:15:40', 0),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'email_password', 'flaminggooo50@gmail.com', NULL, '2023-05-23 09:15:49', 0),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'email_password', 'flaminggooo50@gmail.com', NULL, '2023-05-23 09:15:57', 0),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'email_password', 'flaminggooo50@gmail.com', NULL, '2023-05-23 09:16:25', 0),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-23 09:16:59', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-23 09:17:51', 1),
(11, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-26 06:37:17', 1),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-27 14:11:37', 1),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-05-31 12:35:19', 1),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-06-01 11:19:53', 1),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-06-02 08:09:29', 1),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-08-02 07:56:36', 1),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'email_password', 'flaminggooo50@gmail.com', 1, '2023-08-02 08:06:24', 1),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.203', 'email_password', 'ibn.damr@gmail.com', 2, '2023-08-17 03:44:36', 1);

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

--
-- Dumping data for table `auth_remember_tokens`
--

INSERT INTO `auth_remember_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`, `created_at`, `updated_at`) VALUES
(9, 'db5b5bdf0a33e9eb9f974fb5', '43e86d35050a14b18d10695655b8ee9c1f919be9c4fe33975c9d748c1c19d752', 1, '2023-09-08 06:57:06', '2023-08-02 08:06:24', '2023-08-09 06:57:06');

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
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `id_file_picker`, `nama_file`, `judul`, `kategori`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, NULL, 'Logo-PDIN.png', 'Logo PDIN', NULL, NULL, '2023-05-22 12:18:30', NULL, '2023-05-22 12:18:30'),
(3, NULL, 'foto-ruang-woodworking-2.jpg', 'Ruang Woodworking', NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(4, NULL, 'foto-ruang-woodworking-3.jpg', 'Ruang Woodworking', NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(5, NULL, 'foto-ruang-woodworking-4.jpg', 'Ruang Woodworking', NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(6, NULL, 'foto-ruang-steelworking-1.jpg', NULL, NULL, NULL, '2023-05-22 07:31:55', NULL, '2023-05-22 07:31:55'),
(7, NULL, 'foto-ruang-steelworking-2.jpg', NULL, NULL, NULL, '2023-05-22 07:31:55', NULL, '2023-05-22 07:31:55'),
(8, NULL, 'foto-ruang-pameran-1-1.jpg', NULL, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(9, NULL, 'foto-ruang-pameran-1-2.jpg', NULL, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(10, NULL, 'foto-ruang-pameran-1-3.jpg', NULL, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(11, NULL, 'foto-ruang-pameran-2-1.jpg', NULL, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(12, NULL, 'foto-ruang-pameran-2-2.jpg', NULL, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(13, NULL, 'foto-ruang-pameran-2-3.jpg', NULL, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(14, NULL, 'foto-ruang-pameran-3-1.jpg', NULL, NULL, NULL, '2023-05-22 07:38:59', NULL, '2023-05-22 07:38:59'),
(15, NULL, 'foto-ruang-pameran-3-2.jpg', NULL, NULL, NULL, '2023-05-22 07:38:59', NULL, '2023-05-22 07:38:59'),
(16, NULL, 'foto-alun-alun-1.jpg', NULL, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(17, NULL, 'foto-alun-alun-2.jpg', NULL, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(18, NULL, 'foto-alun-alun-3.jpg', NULL, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(19, NULL, 'foto-ruang-shopping-arcade-1.jpg', NULL, NULL, NULL, '2023-05-22 07:44:38', NULL, '2023-05-22 07:44:38'),
(20, NULL, 'foto-ruang-shopping-arcade-2.jpg', NULL, NULL, NULL, '2023-05-22 07:44:38', NULL, '2023-05-22 07:44:38'),
(23, NULL, 'foto-ruang-rapat-1.jpg', NULL, NULL, NULL, '2023-05-22 07:56:59', NULL, '2023-05-22 07:56:59'),
(24, NULL, 'foto-ruang-rapat-2.jpg', NULL, NULL, NULL, '2023-05-22 07:56:59', NULL, '2023-05-22 07:56:59'),
(28, NULL, 'foto-ruang-rapat-2_2.jpg', NULL, NULL, NULL, '2023-05-22 07:58:38', NULL, '2023-05-22 07:58:38'),
(29, NULL, 'foto-ruang-rapat-1_3.jpg', NULL, NULL, NULL, '2023-05-22 07:58:57', NULL, '2023-05-22 07:58:57'),
(30, NULL, 'foto-ruang-rapat-2_3.jpg', NULL, NULL, NULL, '2023-05-22 07:58:57', NULL, '2023-05-22 07:58:57'),
(31, NULL, 'foto-roof-garden-1.jpg', NULL, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(32, NULL, 'foto-roof-garden-2.jpg', NULL, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(33, NULL, 'foto-roof-garden-3.jpg', NULL, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(34, NULL, 'foto-roof-garden-4.jpg', NULL, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(37, NULL, 'foto-ruang-foto-produk-1.jpg', NULL, NULL, NULL, '2023-05-22 12:22:36', NULL, '2023-05-22 12:22:36'),
(38, NULL, 'foto-ruang-foto-produk-2.jpg', NULL, NULL, NULL, '2023-05-22 12:22:36', NULL, '2023-05-22 12:22:36'),
(39, NULL, 'foto-ruang-cetak-produk-1.jpg', NULL, NULL, NULL, '2023-05-22 12:24:44', NULL, '2023-05-22 12:24:44'),
(40, NULL, 'foto-ruang-cetak-produk-2.jpg', NULL, NULL, NULL, '2023-05-22 12:24:44', NULL, '2023-05-22 12:24:44'),
(41, NULL, 'foto-ruang-desainer-1.jpg', NULL, NULL, NULL, '2023-05-22 12:25:41', NULL, '2023-05-22 12:25:41'),
(42, NULL, 'foto-ruang-desainer-2.jpg', NULL, NULL, NULL, '2023-05-22 12:25:41', NULL, '2023-05-22 12:25:41'),
(88, NULL, 'foto-ruang-audio-visual-1.jpg', NULL, NULL, NULL, '2023-05-30 15:45:25', NULL, '2023-05-30 15:45:25'),
(89, NULL, 'foto-ruang-audio-visual-2.jpg', NULL, NULL, NULL, '2023-05-30 15:45:25', NULL, '2023-05-30 15:45:25'),
(90, NULL, 'galeri-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(91, NULL, 'galeri-2.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(92, NULL, 'galeri-3.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, 'galeri-4.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, 'galeri-5.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, 'galeri-6.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, 'galeri-7.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, 'galeri-8.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, 'galeri-9.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(99, NULL, 'galeri-10.jpg', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_alat`
--

CREATE TABLE `galeri_alat` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_alat` int(11) UNSIGNED NOT NULL,
  `id_galeri` int(11) UNSIGNED NOT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_kegiatan`
--

CREATE TABLE `galeri_kegiatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_kegiatan` int(11) UNSIGNED DEFAULT NULL,
  `id_galeri` int(11) UNSIGNED NOT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri_kegiatan`
--

INSERT INTO `galeri_kegiatan` (`id`, `id_kegiatan`, `id_galeri`, `id_file_picker`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, NULL, 90, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 91, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 92, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 93, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 94, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 95, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 96, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 97, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 98, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 99, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_ruangan`
--

CREATE TABLE `galeri_ruangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_ruangan` int(11) UNSIGNED NOT NULL,
  `id_galeri` int(11) UNSIGNED NOT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri_ruangan`
--

INSERT INTO `galeri_ruangan` (`id`, `id_ruangan`, `id_galeri`, `id_file_picker`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(3, 7, 3, NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(4, 7, 4, NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(5, 7, 5, NULL, NULL, '2023-05-22 07:17:06', NULL, '2023-05-22 07:17:06'),
(6, 8, 6, NULL, NULL, '2023-05-22 07:31:55', NULL, '2023-05-22 07:31:55'),
(7, 8, 7, NULL, NULL, '2023-05-22 07:31:55', NULL, '2023-05-22 07:31:55'),
(8, 9, 8, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(9, 9, 9, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(10, 9, 10, NULL, NULL, '2023-05-22 07:35:07', NULL, '2023-05-22 07:35:07'),
(11, 10, 11, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(12, 10, 12, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(13, 10, 13, NULL, NULL, '2023-05-22 07:37:21', NULL, '2023-05-22 07:37:21'),
(14, 11, 14, NULL, NULL, '2023-05-22 07:38:59', NULL, '2023-05-22 07:38:59'),
(15, 11, 15, NULL, NULL, '2023-05-22 07:38:59', NULL, '2023-05-22 07:38:59'),
(16, 12, 16, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(17, 12, 17, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(18, 12, 18, NULL, NULL, '2023-05-22 07:40:29', NULL, '2023-05-22 07:40:29'),
(19, 13, 19, NULL, NULL, '2023-05-22 07:44:38', NULL, '2023-05-22 07:44:38'),
(20, 13, 20, NULL, NULL, '2023-05-22 07:44:38', NULL, '2023-05-22 07:44:38'),
(23, 16, 23, NULL, NULL, '2023-05-22 07:56:59', NULL, '2023-05-22 07:56:59'),
(24, 16, 24, NULL, NULL, '2023-05-22 07:56:59', NULL, '2023-05-22 07:56:59'),
(31, 25, 31, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(32, 25, 32, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(33, 25, 33, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(34, 25, 34, NULL, NULL, '2023-05-22 11:52:22', NULL, '2023-05-22 11:52:22'),
(37, 28, 37, NULL, NULL, '2023-05-22 12:22:36', NULL, '2023-05-22 12:22:36'),
(38, 28, 38, NULL, NULL, '2023-05-22 12:22:36', NULL, '2023-05-22 12:22:36'),
(39, 29, 39, NULL, NULL, '2023-05-22 12:24:44', NULL, '2023-05-22 12:24:44'),
(40, 29, 40, NULL, NULL, '2023-05-22 12:24:44', NULL, '2023-05-22 12:24:44'),
(41, 30, 41, NULL, NULL, '2023-05-22 12:25:41', NULL, '2023-05-22 12:25:41'),
(42, 30, 42, NULL, NULL, '2023-05-22 12:25:41', NULL, '2023-05-22 12:25:41'),
(73, 14, 88, NULL, NULL, '2023-05-30 15:45:25', NULL, '2023-05-30 15:45:25'),
(74, 14, 89, NULL, NULL, '2023-05-30 15:45:25', NULL, '2023-05-30 15:45:25');

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
  `slug` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) DEFAULT NULL,
  `tipe_kegiatan` enum('Online','Offline','Online dan Offline') DEFAULT NULL,
  `id_file_picker` int(10) UNSIGNED DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `link_pendaftaran` varchar(255) DEFAULT NULL,
  `link_virtual` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `id_admin_create` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_admin_update` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `slug`, `jenis_kegiatan`, `tipe_kegiatan`, `id_file_picker`, `tempat`, `tgl_mulai`, `tgl_selesai`, `link_pendaftaran`, `link_virtual`, `poster`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(1, 'Pameran Seni', 'Pameran-Seni', 'Pameran seni', 'Offline', NULL, 'alun-alun', '2023-04-24 16:34:44', '2023-04-25 14:34:44', '', '', NULL, NULL, '0000-00-00 00:00:00', NULL, '2023-06-03 09:02:40'),
(2, 'Pameran Busana', 'Pameran-Busana', 'Pameran Busana', NULL, NULL, 'Ruang bawah', '2023-04-27 10:31:50', '2023-04-28 10:31:50', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, NULL),
(3, 'Pameran Kaca: Glass Beyond Borders', 'Pameran-Kaca-Glass-Beyond-Borders', 'Pameran', 'Offline', NULL, 'Gedung Pusat Desain Industri Nasional', '2023-05-23 08:00:00', '2023-05-23 16:00:00', 'https://bit.ly/PendaftaranPameranKriyaKayu', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Pameran Busana Batik', 'Pameran-Busana-Batik', 'Pameran', 'Offline', NULL, 'Gedung Pusat Desain Industri Nasional', '2023-05-24 08:00:00', '2023-05-24 16:00:00', 'https://bit.ly/PendaftaranPameranBusanaBatik', NULL, 'jogja membatik.JPG', NULL, NULL, NULL, NULL),
(6, 'Grand Launching Pusat Desain Industri Nasional', 'Grand-Launching-Pusat-Desain-Industri-Nasional', 'Pameran', 'Offline', NULL, 'Pusat Desain Industri Nasional', '2023-06-07 07:30:00', '2023-06-07 15:00:00', '', '', NULL, NULL, '2023-05-31 14:19:10', NULL, '2023-06-01 06:21:22');

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
  `tipe` enum('Pameran','Kantor','Meeting','Pengembangan','Lainnya') DEFAULT NULL,
  `kegunaan` varchar(255) DEFAULT NULL,
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

INSERT INTO `ruangan` (`id`, `nama`, `slug`, `deskripsi`, `tipe`, `kegunaan`, `lantai`, `kapasitas`, `ukuran`, `luas`, `fasilitas`, `biaya_sewa`, `id_admin_create`, `created_at`, `id_admin_update`, `updated_at`) VALUES
(7, 'Ruang Woodworking', 'Ruang-Woodworking', 'Ruang Woodworking adalah ruang yang berisi alat-alat untuk membuat produk dengan bahan dasar kayu. Ruangan ini terletak di lantai dasar (ground floor) gedung Pusat Desain Industri Nasional.   \r\n\r\nRuangan ini memiliki beberapa alat yang bisa digunakan untuk mengembangkan produk berbahan dasar kayu, seperti table saw, planner, jointer, mesin bubut kayu, drum sander, mesin CNC router, mesin CNC laser, dan lain-lain.\r\n', 'Pengembangan', 'Pengembangan Prototipe, Pelatihan, Workshop, ', 0, 3, '0m x 0m x 0m', 0, NULL, 0, NULL, NULL, NULL, '2023-05-26'),
(8, 'Ruang Steelworking', 'Ruang-Steelworking', 'Ruang Steelworking adalah ruang yang berisi alat-alat untuk membuat produk dengan bahan dasar besi. Ruangan ini terletak di lantai dasar (ground floor) gedung Pusat Desain Industri Nasional.   \r\n\r\nRuangan ini memiliki beberapa alat yang bisa digunakan untuk mengembangkan produk berbahan dasar kayu, seperti mesin bubut besi, compressor, mesin CNC laser fiber, dan lain-lain.', 'Pengembangan', NULL, 0, 0, '0m x 0m x 0m', 0, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(9, 'Ruang Pameran 1', 'Ruang-Pameran-1', 'Ruang Pameran 1 merupakan sebuah aula luas yang terletak di bagian depan gedung Pusat Desain Industri Nasional.  Lokasi dari Ruang Pameran 1 adalah di lantai satu sayap utara Gedung, tepatnya di samping pintu masuk utama. \r\n\r\nKegunaan utama dari ruang ini adalah untuk menampilkan produk, barang, atau berbagai karya yang ingin Anda perlihatkan kepada audiens masyarakat luas. Namun, ruang ini juga dapat digunakan untuk pelbagai acara, seperti Pelatihan, Workshop, Meeting Point, dan lain-lain\r\n\r\nRuangan Pameran ini dikelilingi oleh kaca di setiap sudutnya, sehingga menambah kesan luas pada ruangan. Plafon dengan cat warna putih beserta ornament visual lain juga menambah estetika dari Ruang Pameran ini. \r\n\r\nRuangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Pameran', NULL, 1, 50, '20m x 7m x 5m', 140, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(10, 'Ruang Pameran 2', 'Ruang-Pameran-2', 'Ruang Pameran 2 merupakan sebuah aula luas yang terletak di bagian depan gedung Pusat Desain Industri Nasional.  Lokasi dari Ruang Pameran 2 adalah di lantai satu sayap selatan Gedung, tepatnya di samping pintu masuk utama. \r\n\r\nKegunaan utama dari ruang ini adalah untuk menampilkan produk, barang, atau berbagai karya yang ingin Anda perlihatkan kepada audiens masyarakat luas. Namun, ruang ini juga dapat digunakan untuk pelbagai acara, seperti Pelatihan, Workshop, Meeting Point, dan lain-lain\r\n\r\nRuangan Pameran ini dikelilingi oleh kaca di setiap sudutnya, sehingga menambah kesan luas pada ruangan. Plafon dengan cat warna putih beserta ornament visual lain juga menambah estetika dari Ruang Pameran ini. \r\n\r\nRuangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Pameran', NULL, 1, 50, '16m x 9m x 5m', 144, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(11, 'Ruang Pameran 3/Seminar', 'Ruang-Pameran-3Seminar', 'Ruang Pameran 3 merupakan sebuah aula luas yang terletak di bagian belakang gedung Pusat Desain Industri Nasional.  Lokasi dari Ruang Pameran 3 adalah di lantai satu sebelah barat, tepatnya di samping lift dan tangga naik. \r\n\r\nKegunaan utama dari ruang ini adalah untuk menampilkan produk, barang, atau berbagai karya yang ingin Anda perlihatkan kepada audiens masyarakat luas. Namun, ruang ini juga dapat digunakan untuk pelbagai acara, seperti Pelatihan, Workshop, Meeting Point, dan lain-lain\r\n\r\nRuangan Pameran ini dikelilingi oleh kaca di setiap sudutnya, sehingga menambah kesan luas pada ruangan. Plafon dengan cat warna putih beserta ornament visual lain juga menambah estetika dari Ruang Pameran ini. \r\n\r\nRuangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Pameran', NULL, 1, 50, '16m x 9m x 5m', 144, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(12, 'Ruang Pameran Outdoor / Alun-alun', 'Ruang-Pameran-Outdoor-Alun-alun', 'Ruang Pameran Outdoor atau Alun-alun merupakan sebuah area terbuka yang terletak di bagian tengah gedung Pusat Desain Industri Nasional.  \r\n\r\nAlun-alun ini biasanya digunakan untuk mengobrol santai dan bertukar ide terkait pengembangan produk. Namun, alun-alun ini juga dapat digunakan untuk menggelar pameran, konser, dan lain-lain.', 'Pameran', NULL, 1, 90, '17m x 6m x 10m', 102, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(13, 'Ruang Shopping Arcade', 'Ruang-Shopping-Arcade', 'Ruang Shopping Arcade adalah ruangan yang digunakan sebagai tempat display dari produk produk yang telah dikembangkan dan dipamerkan. Jenis produk yang ada di ruang ini memiliki beragam jenis, seperti produk kayu, kulit, kain, kaca, dan besi. Jika terpesona dengan produk yang ada di shopping arcade, pengunjung dapat membeli produk-produk tersebut secara langsung.', 'Pameran', NULL, 1, 30, '8m x 6m x 5m', 48, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(14, 'Food Court', 'Food-Court', 'Food court merupakan sebuah tempat istirahat makan yang terdiri dari beberapa gerai makanan. Menu yang disediakan di food court sangat variatif. Terdapat menu makanan ringan hingga makanan berat. Selain itu, harganya masih terjangkau dan tidak membuat kantong jebol.', 'Lainnya', NULL, 1, 20, '6m x 4m x 5m', 24, NULL, 0, NULL, '2023-05-22', NULL, '2023-05-30'),
(15, 'Ruang Audio Visual', 'Ruang-Audio-Visual', 'Ruang Audio Visual merupakan sebuah ruang serbaguna yang luas. Ruang ini terletak di lantai 2 gedung Pusat Desain Industri Nasional.  Ruang ini dapat digunakan untuk pelbagai acara, seperti Rapat, Pelatihan, Workshop, Meeting Point, dan lain-lain. Ruangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Meeting', NULL, 2, 100, '21m x 16m x 4m', 336, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(16, 'Ruang Rapat Total', 'Ruang-Rapat-Total', 'Ruang Rapat merupakan ruang yang biasa digunakan untuk pertemuan formal. Ruang ini terletak di lantai 2 gedung Pusat Desain Industri Nasional. Ruangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Meeting', 'Ruang Pertemuan, Rapat, Konferensi Pers', 2, 140, '16m x 9m x 4m', 144, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(17, 'Ruang Rapat 1', 'Ruang-Rapat-1', 'Ruang Rapat merupakan ruang yang biasa digunakan untuk pertemuan formal. Ruang ini terletak di lantai 2 gedung Pusat Desain Industri Nasional. Ruangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Meeting', 'Ruang Pertemuan, Rapat, Konferensi Pers', 2, 20, '6m x 9m x 4m', 54, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(18, 'Ruang Rapat 2', 'Ruang-Rapat-2', 'Ruang Rapat merupakan ruang yang biasa digunakan untuk pertemuan formal. Ruang ini terletak di lantai 2 gedung Pusat Desain Industri Nasional. Ruangan ini memiliki beberapa sarana pendukung untuk menjamin kelancaran acara Anda, seperti Sound System, Lampu, Meja, Kursi, Air Conditioner, Kipas Angin.', 'Meeting', 'Ruang Pertemuan, Rapat, Konferensi Pers', 2, 20, '6m x 9m x 4m', 54, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(20, 'Ruang Kantor 1', 'Ruang-Kantor-1', '-', 'Kantor', 'Kantor', 2, 20, '6m x 8m x 4m', 48, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(21, 'Ruang Kantor 2', 'Ruang-Kantor-2', '-', 'Kantor', 'Kantor', 2, 20, '6m x 8m x 4m', 48, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(25, 'Roof Garden', 'Roof-Garden', '-', 'Lainnya', 'Bersantai', 2, 25, '14m x 10m x 10m', 140, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(26, 'Ruang Kantor Sewa', 'Ruang-Kantor-Sewa', '-', 'Kantor', 'Ruangan untuk disewakan sebagai kantor.', 3, 25, '10m x 10m x 5m', 100, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(27, 'Ruang Co-Working Space', 'Ruang-Co-Working-Space', '-', 'Kantor', '-', 3, 30, '12m x 7m x 5m', 84, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(28, 'Ruang Foto Produk', 'Ruang-Foto-Produk', '-', 'Pengembangan', '-', 3, 0, '4m x 6m x 3m', 24, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(29, 'Ruang Cetak Produk', 'Ruang-Cetak-Produk', '-', 'Pengembangan', '-', 3, 30, '5m x 5m x 3m', 25, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(30, 'Ruang Desainer', 'Ruang-Desainer', '-', 'Pengembangan', '-', 3, 30, '14m x 6m x 3m', 84, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(31, 'Ruang Kontemplasi', 'Ruang-Kontemplasi', 'Ruang untuk melakukan kontemplasi ', 'Lainnya', '-', 4, 30, '10m x 9m x 3m', 90, NULL, 0, NULL, '2023-05-22', NULL, '2023-05-30'),
(32, 'Ruang Cafe Rooftop', 'Ruang-Cafe-Rooftop', '-', 'Lainnya', '-', 4, 30, '18m x 15m x 3m', 270, '', 0, NULL, '2023-05-22', NULL, '2023-05-22'),
(33, 'Ruang Mitra PDIN', 'Ruang-Mitra-PDIN', '-', 'Kantor', '-', 4, 40, '18m x 10m x 3m', 180, NULL, 0, NULL, '2023-05-22', NULL, '2023-05-30');

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
(16, 1, 'kjnkhk', 'iiijiij', '', 13, '2023-05-11 06:00:26', '2023-05-11 06:00:26', '2023-05-19 00:00:00', '2023-05-25 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(17, 9, 'asdfasdf', 'bbb', '', 1, '2023-08-03 07:01:39', '2023-08-03 07:01:39', '2023-08-07 00:00:00', '2023-08-10 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(18, 9, 'kjnkhk', 'bbb', '', 2, '2023-08-03 07:06:35', '2023-08-03 07:06:35', '2023-08-06 00:00:00', '2023-08-12 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(19, 9, 'asdfasdf', 'iiijiij', '', 3, '2023-08-03 07:08:03', '2023-08-03 12:59:54', '2023-08-17 00:00:00', '2023-08-25 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(20, 9, 'kjnkhk', 'bbb', '', 4, '2023-08-03 07:11:51', '2023-08-08 12:58:17', '2023-09-01 00:00:00', '2023-09-01 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(22, 9, 'ahdksfklajskdfacj jenaunsdkncklansdifa fkajskdmckaj sdjfuaioejwf dfhgdfhdfghdfghdgfh', 'aksjefji  asdkfjakdf ', '', 21, '2023-08-08 10:31:36', '2023-08-08 10:53:02', '2023-08-08 00:00:00', '2023-08-11 00:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(23, 29, 'foto produk', 'memfoto produk', '', 22, '2023-08-08 13:16:54', '2023-08-08 20:57:38', '2023-08-11 08:00:00', '2023-08-11 15:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL),
(24, 29, 'apa ya', 'memfoto produk', '', 23, '2023-08-08 21:03:48', '2023-08-08 21:03:48', '2023-08-10 11:00:00', '2023-08-10 15:00:00', 0, '0000-00-00 00:00:00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kontak` varchar(15) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `kontak`, `nama_instansi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'flaminggooo50@gmail.com', 'adsfasdf', '123412341234', 'adsf', '2023-08-03 07:01:39', '2023-08-03 07:01:39', NULL),
(2, 'flaminggooo50@gmail.com', 'asd', '13241234', 'a', '2023-08-03 07:06:35', '2023-08-03 07:06:35', NULL),
(3, 'flaminggooo50@gmail.com', 'h', '13241234978', 'jghjkj', '2023-08-03 07:08:03', '2023-08-03 12:59:54', NULL),
(4, 'flaminggooo50@gmail.com', 'asd', '13241234', 'adsf', '2023-08-03 07:11:51', '2023-08-08 12:58:17', NULL),
(5, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:10:38', '2023-08-08 10:10:38', NULL),
(6, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:15:39', '2023-08-08 10:15:39', NULL),
(7, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:16:49', '2023-08-08 10:16:49', NULL),
(8, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:16:53', '2023-08-08 10:16:53', NULL),
(9, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:18:18', '2023-08-08 10:18:18', NULL),
(10, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:18:26', '2023-08-08 10:18:26', NULL),
(11, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:18:48', '2023-08-08 10:18:48', NULL),
(12, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:19:28', '2023-08-08 10:19:28', NULL),
(13, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:20:30', '2023-08-08 10:20:30', NULL),
(14, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:21:51', '2023-08-08 10:21:51', NULL),
(15, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:22:30', '2023-08-08 10:22:30', NULL),
(16, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:23:04', '2023-08-08 10:23:04', NULL),
(17, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:23:10', '2023-08-08 10:23:10', NULL),
(18, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:25:00', '2023-08-08 10:25:00', NULL),
(19, 'flaminggooo50@gmail.com', 'asdfasdfas', '13241234', 'asdfasdfa', '2023-08-08 10:25:34', '2023-08-08 10:27:31', NULL),
(20, 'flaminggooo50@gmail.com', 'asd', '13241234', 'adsf', '2023-08-08 10:29:13', '2023-08-08 10:29:13', NULL),
(21, 'flaminggooo50@gmail.com', 'asd', '13241234', 'adsf', '2023-08-08 10:31:36', '2023-08-08 10:53:02', NULL),
(22, 'flaminggooo50@gmail.com', 'Joko', '13241234', 'Joko corp', '2023-08-08 13:16:54', '2023-08-08 20:57:38', NULL),
(23, 'flaminggooo50@gmail.com', 'Muhammad Fikri Hizbullah', '7657656585675', 'Joko corp', '2023-08-08 21:03:48', '2023-08-08 21:03:48', NULL);

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
(1, 'fikwkwk', NULL, NULL, 1, '2023-08-09 07:03:18', '2023-05-15 12:29:42', '2023-05-15 12:29:42', NULL),
(2, 'damarbob', NULL, NULL, 1, '2023-08-17 04:42:40', '2023-08-11 04:42:37', '2023-08-11 04:42:37', NULL);

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
-- Indexes for table `galeri_kegiatan`
--
ALTER TABLE `galeri_kegiatan`
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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `galeri_alat`
--
ALTER TABLE `galeri_alat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `galeri_kegiatan`
--
ALTER TABLE `galeri_kegiatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `galeri_ruangan`
--
ALTER TABLE `galeri_ruangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
