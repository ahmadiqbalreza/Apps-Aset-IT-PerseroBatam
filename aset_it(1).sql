-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 03:54 AM
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
-- Database: `aset_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `asets`
--

CREATE TABLE `asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_urut` int(11) NOT NULL,
  `slug_aset` varchar(255) NOT NULL,
  `nomor_inventaris` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `processor` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `hdd` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asets`
--

INSERT INTO `asets` (`id`, `nomor_urut`, `slug_aset`, `nomor_inventaris`, `bulan`, `tahun`, `jenis_id`, `merek`, `processor`, `ram`, `hdd`, `user`, `unit_id`, `lokasi_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '0001-LTP-II-2024', '0001/LTP/II/2024', 'II', 2024, 2, 'l', 'l', 'l', 'l', 'l', 1, 1, 'Baik', '2024-02-05 20:33:53', '2024-02-05 20:33:53'),
(2, 2, '0002-LTP-II-2024', '0002/LTP/II/2024', 'III', 2021, 1, 'k', 'k', 'k', 'k', 'k', 2, 1, 'Baik', '2024-02-05 20:35:23', '2024-02-14 20:18:39'),
(3, 3, '0003-CPU-II-2024', '0003/CPU/II/2024', 'II', 2024, 1, NULL, NULL, NULL, NULL, 'a', 2, 2, 'Baik', '2024-02-05 20:37:26', '2024-02-05 20:37:26'),
(4, 44, '0044/LTP/VI/2022', '0044/LTP/VI/2022', 'VI', 2022, 2, 'kkkk', NULL, NULL, NULL, 'keuangannnn', 1, 2, 'Lambat', '2024-02-07 01:50:28', '2024-02-18 19:32:47'),
(5, 5, '0005/CPU/II/2024', '0005/CPU/II/2011', 'II', 2020, 1, 'a', 'a', 'a', 'a', 'a', 1, 1, 'Baik', '2024-02-07 02:32:17', '2024-02-14 20:19:10'),
(6, 36, '0006-LTP-II-2024', '0036/LTP/II/2024', 'II', 2020, 2, 's', NULL, NULL, NULL, 's', 1, 2, 'Lambat', '2024-02-18 19:18:22', '2024-02-18 19:18:52'),
(7, 45, '0045-CPU-V-2021', '0045/CPU/V/2021', 'V', 2021, 1, 'a', NULL, NULL, NULL, 'a', 1, 1, 'Rusak', '2024-02-18 19:37:14', '2024-02-18 19:40:06'),
(8, 96, '0096/CPU/VIII/2020', '0096/CPU/VIII/2020', 'VIII', 2020, 1, 'a', NULL, NULL, NULL, 'ss', 1, 2, 'Rusak', '2024-02-18 19:41:31', '2024-02-18 19:41:31');

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
-- Table structure for table `jenis_asets`
--

CREATE TABLE `jenis_asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `kode_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_asets`
--

INSERT INTO `jenis_asets` (`id`, `nama_jenis`, `kode_jenis`, `created_at`, `updated_at`) VALUES
(1, 'CPU', 'CPU', '2024-02-05 20:25:14', '2024-02-05 20:25:14'),
(2, 'Laptop', 'LTP', '2024-02-05 20:25:20', '2024-02-05 20:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_asets`
--

CREATE TABLE `lokasi_asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_asets`
--

INSERT INTO `lokasi_asets` (`id`, `nama_lokasi`, `created_at`, `updated_at`) VALUES
(1, 'POOL', '2024-02-05 20:25:27', '2024-02-05 20:25:27'),
(2, 'Kantor Pusat', '2024-02-05 20:25:31', '2024-02-05 20:25:31');

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
(4, '2024_01_19_084713_create_asets_table', 1),
(5, '2024_01_23_063806_create_jenis_asets_table', 1),
(6, '2024_01_23_074011_create_lokasi_asets_table', 1),
(7, '2024_01_26_083334_create_units_table', 1);

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
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `created_at`, `updated_at`) VALUES
(1, 'Gudang Laut', '2024-02-05 20:25:36', '2024-02-05 20:25:36'),
(2, 'Customer Service', '2024-02-05 20:25:40', '2024-02-05 20:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Iqbal', 'ahmadiqbalreza@gmail.com', NULL, '$2y$10$F3cINIwiWio3JDrAgiVwaewS3nvsclVWVXoQfSDxUpnjKv/La/pFe', NULL, '2024-02-05 20:25:00', '2024-02-05 20:25:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asets`
--
ALTER TABLE `asets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_asets`
--
ALTER TABLE `jenis_asets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_asets`
--
ALTER TABLE `lokasi_asets`
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
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_asets`
--
ALTER TABLE `jenis_asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lokasi_asets`
--
ALTER TABLE `lokasi_asets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
