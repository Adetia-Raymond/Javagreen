-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2024 pada 16.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `javagreen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token arduino` varchar(255) NOT NULL,
  `suhu` decimal(8,2) NOT NULL,
  `kelembaban` decimal(8,2) NOT NULL,
  `soil` int(11) NOT NULL,
  `relay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id`, `created_at`, `updated_at`, `token arduino`, `suhu`, `kelembaban`, `soil`, `relay`) VALUES
(57, '2024-08-01 09:30:10', '2024-08-01 09:30:10', '1ww121', 12.00, 0.00, 0, 'off'),
(58, '2024-08-01 09:31:50', '2024-08-01 09:31:50', '2112', 51.00, 0.00, 0, 'off');

-- --------------------------------------------------------

--
-- Struktur dari tabel `autos`
--

CREATE TABLE `autos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_alat` varchar(255) NOT NULL,
  `kelembaban_tanah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `autos`
--

INSERT INTO `autos` (`id`, `token_alat`, `kelembaban_tanah`, `created_at`, `updated_at`) VALUES
(26, '1ww121', 0, '2024-08-01 09:30:10', '2024-08-01 09:30:10'),
(27, '2112', 0, '2024-08-01 09:31:50', '2024-08-01 09:31:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_alat` varchar(255) NOT NULL,
  `hari` int(11) NOT NULL,
  `jam` int(11) NOT NULL,
  `menit` int(11) NOT NULL,
  `delay` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `manuals`
--

CREATE TABLE `manuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_alat` varchar(255) NOT NULL,
  `tombol` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `manuals`
--

INSERT INTO `manuals` (`id`, `token_alat`, `tombol`, `created_at`, `updated_at`) VALUES
(26, '1ww121', 'off', '2024-08-01 09:30:10', '2024-08-20 06:12:13'),
(27, '2112', 'off', '2024-08-01 09:31:50', '2024-08-01 09:31:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_07_03_185214_create_arduinos_table', 1),
(6, '0001_01_01_000000_create_users_table', 6),
(7, '0001_01_01_000001_create_cache_table', 7),
(9, '2024_07_04_142408_create_tokens_table', 8),
(10, '2024_07_07_122735_create_modes_table', 9),
(11, '2024_07_08_055529_create_manuals_table', 10),
(12, '2024_07_08_155807_create_autos_table', 11),
(13, '2024_07_09_065452_create_jadwals_table', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modes`
--

CREATE TABLE `modes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_alat` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `modes`
--

INSERT INTO `modes` (`id`, `token_alat`, `mode`, `created_at`, `updated_at`) VALUES
(28, '1ww121', 'manual', '2024-08-01 09:30:10', '2024-08-20 06:13:40'),
(29, '2112', 'manual', '2024-08-01 09:31:50', '2024-08-01 09:31:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `token` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `nama_alat`, `token`, `created_at`, `updated_at`) VALUES
(155, 1, 'Nama Pot', '1ww121', '2024-08-01 09:30:10', '2024-08-01 09:30:10'),
(156, 1, 'Nama Pot', '2112', '2024-08-01 09:31:50', '2024-08-01 09:31:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'qweq', 'user', 'user3@example.com', NULL, '$2y$12$LsyLSWD3dox/4Ynk0QAZT.o4q7n5pDy6ixGWDftjKMFvoFkmmSE8u', NULL, '2024-07-25 23:39:51', '2024-07-25 23:39:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manuals`
--
ALTER TABLE `manuals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modes`
--
ALTER TABLE `modes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `autos`
--
ALTER TABLE `autos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `manuals`
--
ALTER TABLE `manuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `modes`
--
ALTER TABLE `modes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
