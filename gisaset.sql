-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 04:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gisaset`
--

-- --------------------------------------------------------

--
-- Table structure for table `asets`
--

CREATE TABLE `asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT 0,
  `letak` varchar(255) DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `penemu` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `dokumen_aset` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kecamatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_guide` varchar(255) DEFAULT NULL,
  `harga_instansi` int(11) DEFAULT 0,
  `foto1` varchar(255) DEFAULT NULL,
  `foto2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asets`
--

INSERT INTO `asets` (`id`, `user_id`, `nama`, `harga`, `letak`, `asal`, `penemu`, `status`, `kondisi`, `dokumen_aset`, `latitude`, `longitude`, `created_at`, `updated_at`, `kecamatan_id`, `nama_guide`, `harga_instansi`, `foto1`, `foto2`) VALUES
(7, 13, 'Gunung Singkil', 5000, 'ciawijapura', 'Cirebon', 'Mulyono', 'CG', 'Baik', 'public/dokumen_aset/FgaGRADSMtLRxF9hmLH2cxwwg1gAMqI8.jpeg', '-6.872184670633125', '108.62254142948841', '2023-08-30 20:26:08', '2023-08-30 20:51:17', 8, 'H Dedi', 10000, 'public/foto1/E71HfXN3HKRTYtDevjCzcuzJ3jlwZsKs.jpeg', 'public/foto2/BQ4VUuHHyhvemG7RXJ6BDqffmwT1LvTK.jpeg'),
(9, 14, 'Situs Makam Mbah Kuwu Sangkan', 3000, 'Talun', 'Cirebon', 'Bapak Triyul', 'Situs', 'Baik', 'public/dokumen_aset/uQqB1pZf6bEMgU62dz6bAblGCgfnYPjr.jpeg', '-6.77128766115115', '108.52176096829564', '2023-09-17 00:44:44', '2023-09-17 00:51:49', NULL, 'KH Deni', 5000, 'public/foto1/9JliSSnAM6LCELtVqCzst96D6mH58zSR.jpeg', 'public/foto2/e24JLH0drj0JNHRc64oXBdY6gtqJfGVj.jpg'),
(10, 15, 'Pabrik Gula Karangsuwung', 5000, 'Karangsuwung', 'Karangsuwung', 'Toto Sugiarto', 'CG', 'Baik', 'public/dokumen_aset/hQDwx2aEvl8WbljgFj2MelCET2Af9tX3.jpeg', '-6.849079925328306', '108.64103492694352', '2023-09-17 22:09:54', '2023-09-17 22:09:54', 6, 'H. Benny', 10000, 'public/foto1/GqcTSoVBDKoXxr7UOeARTK1C99mYnshL.jpg', 'public/foto2/nUTbuJ8zsuAxY6fKjLflyy0uxE6BXkdS.jpeg'),
(11, 16, 'Stasiun Cangkring', 2000, 'Plered', 'Cirebon', 'H. Wendi', 'CG', 'Baik', 'public/dokumen_aset/TacHxMm9zvutwBank0ZHi0yjFtKzAKDe.jpg', '-6.692063276067585', '108.5103792369936', '2023-09-17 22:15:39', '2023-09-17 22:15:39', 36, 'KH. Kholil', 3000, 'public/foto1/3eS1bIeJZU52JNefDF3oL1mLmR4XYlv0.jpeg', 'public/foto2/ugtlON6eo27t5j7rkVA1jos4a4xEDXSB.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_tiket` varchar(255) DEFAULT NULL,
  `jml_orang` int(11) DEFAULT 1,
  `komplen` text DEFAULT NULL COMMENT 'hanya terisi jika memang ada komplen',
  `status` varchar(255) DEFAULT 'pending' COMMENT 'pending, approved, rejected, completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `asset_id`, `jadwal_asset_id`, `no_tiket`, `jml_orang`, `komplen`, `status`, `created_at`, `updated_at`, `bukti_bayar`) VALUES
(5, 5, 2, 4, '00005-2023', 20, NULL, 'used', '2023-07-27 02:30:41', '2023-07-29 21:36:58', NULL),
(6, 5, 2, 4, '00006-2023', 20, NULL, 'pending', '2023-07-30 06:11:54', '2023-07-30 06:11:54', NULL),
(7, 3, 2, 4, '00007-2023', 10, NULL, 'pending', '2023-07-31 20:10:54', '2023-07-31 20:10:54', NULL),
(8, 9, 2, 4, '00008-2023', 2, 'Tidak ramah, bintang 1', 'used', '2023-07-31 20:42:29', '2023-07-31 21:48:50', NULL),
(9, 5, 1, 2, '00009-2023', 10, NULL, 'pending', '2023-07-31 22:28:58', '2023-07-31 22:28:58', NULL),
(10, 3, 1, 2, '00010-2023', 10, 'tempatnya kotor tlong perbaiki', 'used', '2023-08-01 07:28:30', '2023-08-02 11:43:57', 'public/bukti_bayar/P49wymiNKkceoioFPyGwonJLh9vS6MkC.png'),
(12, 5, 2, 4, '00012-2023', 2, NULL, 'pending', '2023-08-29 20:25:20', '2023-08-29 20:25:20', NULL),
(13, 12, 2, 4, '00013-2023', 10, NULL, 'pending', '2023-08-30 20:06:28', '2023-08-30 20:06:28', NULL),
(14, 12, 7, 8, '00014-2023', 20, NULL, 'used', '2023-08-30 20:53:44', '2023-08-30 23:54:12', 'public/bukti_bayar/t5FbJYwA1qik2FjcGg0kyetvSvV8uG0n.jpg'),
(15, 12, 7, 8, '00015-2023', 20, NULL, 'pending', '2023-08-30 23:52:33', '2023-08-30 23:52:33', NULL),
(16, 12, 9, 9, '00016-2023', 10, NULL, 'used', '2023-09-17 00:46:59', '2023-09-17 00:50:56', 'public/bukti_bayar/QFEKEhIM9rsUGuRDXQztDU0jT8YLdDYV.jpeg'),
(17, 12, 7, 13, '00017-2023', 10, NULL, 'used', '2023-09-17 23:38:43', '2023-09-17 23:42:14', 'public/bukti_bayar/fuLuXwbZK3WJPHhI2Lczh8X1fzyNl0A9.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_asets`
--

CREATE TABLE `jadwal_asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aset_id` bigint(20) UNSIGNED NOT NULL COMMENT 'aset yang akan dijadwalkan',
  `tgl_jam` datetime DEFAULT NULL,
  `max_pengunjung` int(11) NOT NULL DEFAULT 30,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_asets`
--

INSERT INTO `jadwal_asets` (`id`, `aset_id`, `tgl_jam`, `max_pengunjung`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-07-27 13:02:00', 10, '2023-07-26 23:02:39', '2023-07-26 23:02:39'),
(2, 1, '2023-07-29 15:31:00', 20, '2023-07-26 23:02:47', '2023-07-26 23:04:20'),
(3, 1, '2023-07-27 20:55:00', 53, '2023-07-26 23:02:56', '2023-07-26 23:04:01'),
(4, 2, '2023-07-27 15:46:00', 30, '2023-07-27 01:46:33', '2023-07-27 01:46:33'),
(5, 1, '2023-08-01 21:33:00', 20, '2023-08-01 07:33:33', '2023-08-01 07:33:33'),
(6, 1, '2023-08-01 23:35:00', 10, '2023-08-01 07:34:01', '2023-08-01 07:34:01'),
(7, 4, '1990-01-18 01:58:00', 21, '2023-08-02 11:28:23', '2023-08-02 11:28:23'),
(8, 7, '2023-08-31 10:51:00', 30, '2023-08-30 20:51:59', '2023-08-30 20:51:59'),
(9, 9, '2023-09-17 15:45:00', 15, '2023-09-17 00:45:22', '2023-09-17 00:45:22'),
(10, 9, '2023-09-18 13:00:00', 15, '2023-09-17 20:35:18', '2023-09-17 20:35:18'),
(11, 9, '2023-09-18 14:00:00', 15, '2023-09-17 20:35:55', '2023-09-17 20:35:55'),
(12, 7, '2023-09-18 13:01:00', 20, '2023-09-17 20:36:48', '2023-09-17 20:36:48'),
(13, 7, '2023-09-18 14:00:00', 20, '2023-09-17 20:37:37', '2023-09-17 20:37:37'),
(14, 10, '2023-09-18 14:00:00', 10, '2023-09-17 22:10:35', '2023-09-17 22:10:35'),
(15, 10, '2023-09-18 15:00:00', 10, '2023-09-17 22:11:01', '2023-09-17 22:11:01'),
(16, 11, '2023-09-18 14:15:00', 20, '2023-09-17 22:16:11', '2023-09-17 22:16:11'),
(17, 11, '2023-09-18 15:16:00', 20, '2023-09-17 22:16:30', '2023-09-17 22:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kabupaten_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `kabupaten_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 3209, 'Waled', NULL, NULL),
(2, 3209, 'Ciledug', NULL, NULL),
(3, 3209, 'Losari', NULL, NULL),
(4, 3209, 'Pabedilan', NULL, NULL),
(5, 3209, 'Babakan', NULL, NULL),
(6, 3209, 'Karangsembung', NULL, NULL),
(7, 3209, 'Lemahabang', NULL, NULL),
(8, 3209, 'Susukan Lebak', NULL, NULL),
(9, 3209, 'Sedong', NULL, NULL),
(10, 3209, 'Astanajapura', NULL, NULL),
(11, 3209, 'Pangenan', NULL, NULL),
(12, 3209, 'Mundu', NULL, NULL),
(13, 3209, 'Beber', NULL, NULL),
(14, 3209, 'Talun', NULL, NULL),
(15, 3209, 'Sumber', NULL, NULL),
(16, 3209, 'Dukupuntang', NULL, NULL),
(17, 3209, 'Palimanan', NULL, NULL),
(18, 3209, 'Plumbon', NULL, NULL),
(19, 3209, 'Weru', NULL, NULL),
(20, 3209, 'Kedawung', NULL, NULL),
(21, 3209, 'Gunung Jati', NULL, NULL),
(22, 3209, 'Kapetakan', NULL, NULL),
(23, 3209, 'Klangenan', NULL, NULL),
(24, 3209, 'Arjawinangun', NULL, NULL),
(25, 3209, 'Panguragan', NULL, NULL),
(26, 3209, 'Ciwaringin', NULL, NULL),
(27, 3209, 'Susukan', NULL, NULL),
(28, 3209, 'Gegesik', NULL, NULL),
(29, 3209, 'Kaliwedi', NULL, NULL),
(30, 3209, 'Gebang', NULL, NULL),
(31, 3209, 'Depok', NULL, NULL),
(32, 3209, 'Pasaleman', NULL, NULL),
(33, 3209, 'Pabuaran', NULL, NULL),
(34, 3209, 'Karangwareng', NULL, NULL),
(35, 3209, 'Tengah Tani', NULL, NULL),
(36, 3209, 'Plered', NULL, NULL),
(37, 3209, 'Gempol', NULL, NULL),
(38, 3209, 'Greged', NULL, NULL),
(39, 3209, 'Suranenggala', NULL, NULL),
(40, 3209, 'Jamblang', NULL, NULL),
(41, 3274, 'Kejaksan', NULL, NULL),
(42, 3274, 'Lemah Wungkuk', NULL, NULL),
(43, 3274, 'Harjamukti', NULL, NULL),
(44, 3274, 'Pekalipan', NULL, NULL),
(45, 3274, 'Kesambi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_09_165838_create_asets_table', 1),
(6, '2023_07_09_165956_create_jadwal_asets_table', 1),
(7, '2023_07_09_170040_create_bookings_table', 1),
(8, '2023_08_01_024535_add_is_aktif_to_users', 2),
(9, '2023_08_01_032650_add_more_columns_to_users', 3),
(10, '2023_08_01_042733_create_kecamatans_table', 4),
(11, '2023_08_01_043106_add_kecamatan_id_to_asets', 5),
(12, '2023_08_02_183707_add_bukti_bayar_to_bookings', 6),
(13, '2023_08_30_030335_add_nama_guide_to_asets', 7),
(14, '2023_08_30_031030_add_harga_instansi_to_asets', 8),
(15, '2023_08_30_040600_add_fotofoto_to_asets', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status_pengunjung` varchar(255) DEFAULT NULL COMMENT 'mahasiswa, pekerja, dosen, umum',
  `alamat` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL COMMENT 'admin, pengelola, pengunjung',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_aktif` tinyint(1) DEFAULT 1,
  `dokumen` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status_pengunjung`, `alamat`, `role`, `remember_token`, `created_at`, `updated_at`, `is_aktif`, `dokumen`, `instansi`, `asal`, `penanggung_jawab`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$V8EN3PYSVAUkpQlxrI68heFHAw.dsr4IzAM0aUm213nrsN9CW/hSG', 'umum', NULL, 'admin', NULL, NULL, '2023-07-31 20:18:06', 1, 'public/dokumen/51DPVFwtbQO1auD2YEI0KLb0kJRY6QMP.pdf', NULL, NULL, NULL),
(3, 'Pengunjung A', 'pengunjung@gmail.com', NULL, '$2y$10$uJ18F8pAMrEOgH.wdXoR5OGMqQyx6DJ.KbnR6f8IuwULTtwfudfiO', 'Lembaga', 'Cirebon', 'pengunjung', NULL, NULL, '2023-08-29 20:31:53', 1, NULL, NULL, NULL, NULL),
(5, 'Pengunjung B', 'pengunjung2@gmail.com', NULL, '$2y$10$InbVuxkNoMPnl/.9./LgzOz4Spo.jQbgy5MCPc9ukegvZrUs0yEmu', 'Lembaga', 'cirebon', 'pengunjung', NULL, '2023-07-27 02:10:53', '2023-08-29 20:19:35', 1, NULL, NULL, NULL, NULL),
(9, 'InggitX', 'inggit@gmail.com', NULL, '$2y$10$q.lQTK3ewuwRwk4fo9zNmuiiDWwgw5heqX/V8gvh64iuXE2QeklQW', 'Mahasiswa', 'malengka', 'pengunjung', NULL, '2023-07-31 20:41:45', '2023-07-31 21:09:38', 1, NULL, 'UMC', 'majalengka', NULL),
(10, 'Orli Guzman', 'gucuheqeb@mailinator.com', NULL, '$2y$10$bvp4o4yIwqJzGBJWYYg75uzzExvdcB8gHfmEu/cHS8VbsK5XZos1y', 'Mahasiswa', 'mjalengkaX', 'pengunjung', NULL, '2023-07-31 21:03:35', '2023-08-01 07:32:09', 1, 'public/dokumen/rT4z8dHTLklYHLqAcpmskd706VFEmDUC.jpg', 'UMC', 'univ', 'okeoke'),
(12, 'diky', 'diky@gmail.com', NULL, '$2y$10$cpwNB3ecg9cFvrH/6SWCz.E2CesO0eFLdkDPxg.TyaHjfTZTue/fu', 'Mahasiswa', 'indramayu', 'pengunjung', NULL, '2023-08-30 20:04:34', '2023-08-30 20:04:34', 1, '', 'UMC', 'Indramayu', NULL),
(13, 'Susukan Lebak', 'susukanlebak@gmail.com', NULL, '$2y$10$0y4uOiT3BAb/254wcw1jCeOQSlDNM6YU/04Ln91ao9vPRyRUIIocG', 'Mahasiswa', NULL, 'pengelola', NULL, '2023-08-30 20:09:29', '2023-08-30 20:11:01', 1, 'public/dokumen/dhlqP8zJdtlKUPk5zARrMTbdB0Oa2xX1.jpg', NULL, NULL, 'Saefudin'),
(14, 'Situs Mbah Kuwu Sangkan', 'situsmbahkuwusangkan@gmail.com', NULL, '$2y$10$Gb4GO00kUgQ7xcYqaQ6L2.llWLPcNeugCOEpYH8c.LgD7o9Cv466i', 'Mahasiswa', NULL, 'pengelola', NULL, '2023-09-17 00:39:50', '2023-09-17 20:08:05', 1, 'public/dokumen/0IU69axxsKNIgAHpJfr8HEo1KWz5nogY.docx', NULL, NULL, 'KH Masroni'),
(15, 'Pabrik Gula Karangsuwung', 'pabrikgulakarangsuwung@gmail.com', NULL, '$2y$10$tqZB.4Siuz3CAYCPJL2GTOHFyaHh/bo7HaX/QOGbxGjfXdatsVWvy', 'Mahasiswa', NULL, 'pengelola', NULL, '2023-09-17 20:41:09', '2023-09-17 21:59:48', 1, NULL, NULL, NULL, 'H. Toto'),
(16, 'Stasiun Cangkring', 'stasiuncangkring@gmail.com', NULL, '$2y$10$WLUdPll/v5GgB3s8MpyuJuAXmiGr1QgWSkUz8M6TlMyxuzpdHTM0i', 'Mahasiswa', NULL, 'pengelola', NULL, '2023-09-17 22:02:50', '2023-09-17 22:12:34', 1, NULL, NULL, NULL, 'H. Deddi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_asets`
--
ALTER TABLE `jadwal_asets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asets`
--
ALTER TABLE `asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_asets`
--
ALTER TABLE `jadwal_asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
