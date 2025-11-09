-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2025 pada 03.41
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webqual_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jawaban`
--

CREATE TABLE `detail_jawaban` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_jawaban` bigint(20) UNSIGNED NOT NULL,
  `id_pertanyaan` bigint(20) UNSIGNED NOT NULL,
  `harapan` tinyint(3) UNSIGNED NOT NULL,
  `jawaban` tinyint(3) UNSIGNED NOT NULL
) ;

--
-- Dumping data untuk tabel `detail_jawaban`
--

INSERT INTO `detail_jawaban` (`id_detail`, `id_jawaban`, `id_pertanyaan`, `harapan`, `jawaban`) VALUES
(28, 4, 11, 5, 4),
(29, 5, 11, 4, 3),
(30, 6, 11, 5, 5),
(31, 4, 12, 5, 5),
(32, 5, 12, 4, 4),
(33, 6, 12, 5, 4),
(34, 4, 13, 5, 3),
(35, 5, 13, 4, 3),
(36, 6, 13, 5, 4),
(37, 4, 14, 5, 4),
(38, 5, 14, 4, 3),
(39, 6, 14, 5, 5),
(40, 4, 15, 5, 5),
(41, 5, 15, 4, 4),
(42, 6, 15, 5, 4),
(43, 4, 16, 5, 3),
(44, 5, 16, 4, 3),
(45, 6, 16, 5, 4),
(46, 4, 17, 5, 4),
(47, 5, 17, 4, 3),
(48, 6, 17, 5, 5),
(49, 4, 18, 5, 5),
(50, 5, 18, 4, 4),
(51, 6, 18, 5, 4),
(52, 4, 19, 5, 4),
(53, 5, 19, 4, 3),
(54, 6, 19, 5, 5),
(55, 4, 20, 5, 3),
(56, 5, 20, 4, 3),
(57, 6, 20, 5, 4),
(58, 4, 21, 5, 4),
(59, 5, 21, 4, 3),
(60, 6, 21, 5, 5),
(61, 4, 22, 5, 5),
(62, 5, 22, 4, 4),
(63, 6, 22, 5, 4),
(64, 4, 23, 5, 4),
(65, 5, 23, 4, 3),
(66, 6, 23, 5, 5),
(67, 4, 24, 5, 3),
(68, 5, 24, 4, 3),
(69, 6, 24, 5, 4),
(70, 4, 25, 5, 4),
(71, 5, 25, 4, 3),
(72, 6, 25, 5, 5),
(73, 4, 26, 5, 3),
(74, 5, 26, 4, 3),
(75, 6, 26, 5, 4),
(76, 4, 27, 5, 4),
(77, 5, 27, 4, 3),
(78, 6, 27, 5, 5),
(79, 4, 28, 5, 5),
(80, 5, 28, 4, 4),
(81, 6, 28, 5, 4),
(82, 4, 29, 5, 4),
(83, 5, 29, 4, 3),
(84, 6, 29, 5, 5),
(85, 4, 30, 5, 3),
(86, 5, 30, 4, 3),
(87, 6, 30, 5, 4),
(88, 4, 31, 5, 4),
(89, 5, 31, 4, 3),
(90, 6, 31, 5, 5),
(91, 4, 32, 5, 5),
(92, 5, 32, 4, 4),
(93, 6, 32, 5, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dimensi`
--

CREATE TABLE `dimensi` (
  `id_dimensi` tinyint(3) UNSIGNED NOT NULL,
  `kode_dimensi` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dimensi` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dimensi`
--

INSERT INTO `dimensi` (`id_dimensi`, `kode_dimensi`, `nama_dimensi`, `keterangan`) VALUES
(1, 'USABILITY', 'Kualitas Kegunaan', NULL),
(2, 'INFO_QUALITY', 'Kualitas Informasi', NULL),
(3, 'INTERACTION_QUALITY', 'Interaksi Pelayanan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_wqi`
--

CREATE TABLE `hasil_wqi` (
  `id_hasil` bigint(20) UNSIGNED NOT NULL,
  `id_survei` bigint(20) UNSIGNED NOT NULL,
  `id_dimensi` tinyint(3) UNSIGNED DEFAULT NULL,
  `rata_harapan` decimal(6,4) NOT NULL,
  `rata_jawaban` decimal(6,4) NOT NULL,
  `skor_maksimal` decimal(10,4) NOT NULL,
  `skor_tertimbang` decimal(12,4) NOT NULL,
  `wqi` decimal(6,4) NOT NULL,
  `interpretasi` enum('Sangat Baik','Baik','Cukup','Kurang','Sangat Kurang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hasil_wqi`
--

INSERT INTO `hasil_wqi` (`id_hasil`, `id_survei`, `id_dimensi`, `rata_harapan`, `rata_jawaban`, `skor_maksimal`, `skor_tertimbang`, `wqi`, `interpretasi`, `dibuat_pada`) VALUES
(2, 4, NULL, '4.6667', '3.9091', '513.3370', '401.3343', '0.7818', 'Baik', '2025-10-26 07:30:43'),
(3, 4, 1, '4.6670', '3.9580', '186.6680', '147.7780', '0.7917', 'Baik', '2025-10-26 07:38:48'),
(4, 4, 2, '4.6670', '3.8570', '163.3350', '126.0000', '0.7714', 'Baik', '2025-10-26 07:38:48'),
(5, 4, 3, '4.6670', '3.9050', '163.3350', '127.5560', '0.7809', 'Baik', '2025-10-26 07:38:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` bigint(20) UNSIGNED NOT NULL,
  `id_survei` bigint(20) UNSIGNED NOT NULL,
  `id_responden` bigint(20) UNSIGNED NOT NULL,
  `waktu_kirim` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_survei`, `id_responden`, `waktu_kirim`) VALUES
(4, 4, 3, '2025-10-26 07:38:19'),
(5, 4, 4, '2025-10-26 07:38:19'),
(6, 4, 5, '2025-10-26 07:38:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` bigint(20) UNSIGNED NOT NULL,
  `id_dimensi` tinyint(3) UNSIGNED NOT NULL,
  `kode_pertanyaan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teks_pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_dimensi`, `kode_pertanyaan`, `teks_pertanyaan`, `aktif`, `dibuat_pada`, `diperbarui_pada`) VALUES
(11, 1, 'K1', 'Seberapa mudah menurut anda memahami cara menggunakan website MPP Kab Sidoarjo?', 1, '2025-10-25 09:01:42', '2025-10-25 09:02:11'),
(12, 1, 'K2', 'Menurut anda, seberapa jelas dan mudah dipahami penggunaan website MPP Kab Sidoarjo?', 1, '2025-10-25 09:02:03', '2025-10-25 09:02:03'),
(13, 1, 'K3', 'Bagaimana tingkat kemudahan navigasi anda di dalam website MPP Kab Sidoarjo?', 1, '2025-10-25 09:02:44', '2025-10-25 09:02:44'),
(14, 1, 'K4', 'Apakah menurut anda website MPP Kab Sidoarjo mudah digunakan?', 1, '2025-10-25 09:24:30', '2025-10-25 09:24:30'),
(15, 1, 'K5', 'Bagaimana pendapat anda tentang tampilan visual website MPP Kab Sidoarjo?', 1, '2025-10-25 09:24:49', '2025-10-25 09:24:49'),
(16, 1, 'K6', 'Apakah menurut anda desain website MPP Kab Sidoarjo sesuai dengan standar desain sistem berbasis web?', 1, '2025-10-25 09:25:09', '2025-10-25 09:25:09'),
(17, 1, 'K7', 'Menurut anda, apakah website MPP Kab Sidoarjo memiliki kemampuan yang sesuai dengan kebutuhan anda?', 1, '2025-10-25 09:25:32', '2025-10-25 09:25:32'),
(18, 1, 'K8', 'Bagaimana pengalaman anda saat menggunakan website MPP Kab Sidoarjo secara keseluruhan?', 1, '2025-10-25 09:25:50', '2025-10-25 09:25:50'),
(19, 2, 'KI 1', 'Seberapa relevan menurut anda informasi yang disediakan oleh website MPP Kab Sidoarjo?', 1, '2025-10-25 09:26:45', '2025-10-25 09:26:57'),
(20, 2, 'KI 2', 'Seberapa akurat menurut Anda informasi yang disediakan oleh website MPP Kab Sidoarjo?', 1, '2025-10-25 09:27:20', '2025-10-25 09:27:20'),
(21, 2, 'KI 3', 'Seberapa dipercayai menurut anda informasi yang disediakan oleh website MPP Kab Sidoarjo?', 1, '2025-10-25 09:27:43', '2025-10-25 09:27:43'),
(22, 2, 'KI 4', 'Seberapa mudah dipahami menurut anda informasi pada website MPP Kab Sidoarjo?', 1, '2025-10-25 09:28:04', '2025-10-25 09:28:04'),
(23, 2, 'KI 5', 'Apakah menurut anda website website MPP Kab Sidoarjo memberikan informasi tepat waktu?', 1, '2025-10-25 09:28:25', '2025-10-25 09:28:25'),
(24, 2, 'KI 6', 'Apakah menurut anda format informasi yang disajikan oleh website website MPP Kab Sidoarjo sesuai?', 1, '2025-10-25 09:28:46', '2025-10-25 09:28:46'),
(25, 2, 'KI 7', 'Seberapa rinci menurut Anda informasi yang diberikan oleh website MPP Kab Sidoarjo pada tingkat yang sesuai?', 1, '2025-10-25 09:29:05', '2025-10-25 09:29:05'),
(26, 3, 'IP1', 'Bagaimana pendapat anda tentang tampilan dan isi website MPP Kab Sidoarjo?', 1, '2025-10-25 09:30:32', '2025-10-25 09:30:32'),
(27, 3, 'IP2', 'Seberapa aman menurut anda untuk melakukan aktivitas (melalui web) dengan website MPP Kab Sidoarjo?', 1, '2025-10-25 09:30:56', '2025-10-25 09:30:56'),
(28, 3, 'IP3', 'Seberapa aman menurut anda terhadap penyimpanan informasi pribadi dalam website MPP Kab Sidoarjo?', 1, '2025-10-25 09:31:18', '2025-10-25 09:31:18'),
(29, 3, 'IP4', 'Apakah anda bisa masuk ke akun pribadi di website MPP Sidoarjo untuk melihat layanan yang pernah anda gunakan atau melacak pengurusan dokumen?', 1, '2025-10-25 09:31:41', '2025-10-25 09:31:41'),
(30, 3, 'IP5', 'Sejauh mana menurut anda, website MPP Kabupaten Sidoarjo memfasilitasi interaksi dua arah antara warga dan penyedia layanan?', 1, '2025-10-25 09:32:04', '2025-10-25 09:32:04'),
(31, 3, 'IP6', 'Menurut anda, apakah mudah untuk bertanya atau menyampaikan keluhan lewat website MPP Sidoarjo, (misalnya soal syarat dokumen, jam buka, atau jika ada masalah saat mengurus layanan?)', 1, '2025-10-25 09:32:30', '2025-10-25 09:32:30'),
(32, 3, 'IP7', 'Apakah Anda yakin bahwa layanan yang Anda gunakan melalui website MPP Sidoarjo akan diproses dengan benar oleh petugas?', 1, '2025-10-25 09:32:53', '2025-10-25 09:32:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `responden`
--

CREATE TABLE `responden` (
  `id_responden` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `umur` tinyint(3) UNSIGNED DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','Lainnya') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `responden`
--

INSERT INTO `responden` (`id_responden`, `email`, `nama`, `jurusan`, `umur`, `jenis_kelamin`, `pendidikan`, `pekerjaan`, `dibuat_pada`, `diperbarui_pada`) VALUES
(3, 'lyduz@mailinator.com', 'Ab eius amet est i', 'Quis in iusto est co', 78, 'Lainnya', 'Repellendus Qui bea', 'Odit qui quis ad mag', '2025-10-21 10:43:41', '2025-10-21 10:43:41'),
(4, 'somasufyw@mailinator.com', 'Magna enim nisi veli', 'Reiciendis omnis est', 29, 'Perempuan', 'Lorem optio deserun', 'Animi amet sint in', '2025-10-21 10:45:30', '2025-10-21 10:45:30'),
(5, 'tebulanako@mailinator.com', 'Sed ratione nostrud', 'Dolor in illum iust', 19, 'Lainnya', 'Sit laboris dolore', 'Mollit iste officiis', '2025-10-24 02:42:28', '2025-10-24 02:42:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `situs`
--

CREATE TABLE `situs` (
  `id_situs` bigint(20) UNSIGNED NOT NULL,
  `nama_situs` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_situs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `situs`
--

INSERT INTO `situs` (`id_situs`, `nama_situs`, `url_situs`, `keterangan`, `aktif`, `dibuat_pada`, `diperbarui_pada`) VALUES
(1, 'Mall Pelayanan Publik Kabupaten Sidoarjo', 'http://plavon.sidoarjokab.go.id', NULL, 1, '2025-10-13 01:36:05', '2025-10-13 01:36:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survei`
--

CREATE TABLE `survei` (
  `id_survei` bigint(20) UNSIGNED NOT NULL,
  `id_situs` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `judul_survei` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `status` enum('draf','berjalan','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draf',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data untuk tabel `survei`
--

INSERT INTO `survei` (`id_survei`, `id_situs`, `judul_survei`, `tanggal_mulai`, `tanggal_selesai`, `status`, `dibuat_pada`, `diperbarui_pada`) VALUES
(4, 1, 'Survei WebQual MPP Sidoarjo - 2025', '2025-10-24 20:53:00', '2025-10-31 20:54:00', 'berjalan', '2025-10-25 08:54:06', '2025-10-26 02:03:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survei_pertanyaan`
--

CREATE TABLE `survei_pertanyaan` (
  `id_survei` bigint(20) UNSIGNED NOT NULL,
  `id_pertanyaan` bigint(20) UNSIGNED NOT NULL,
  `urutan_tampil` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `survei_pertanyaan`
--

INSERT INTO `survei_pertanyaan` (`id_survei`, `id_pertanyaan`, `urutan_tampil`) VALUES
(4, 11, 1),
(4, 12, 2),
(4, 13, 3),
(4, 14, 4),
(4, 15, 5),
(4, 16, 6),
(4, 17, 7),
(4, 18, 8),
(4, 19, 9),
(4, 20, 10),
(4, 21, 11),
(4, 22, 12),
(4, 23, 13),
(4, 24, 14),
(4, 25, 15),
(4, 26, 16),
(4, 27, 17),
(4, 28, 18),
(4, 29, 19),
(4, 30, 20),
(4, 31, 21),
(4, 32, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `dibuat_pada`, `diperbarui_pada`) VALUES
(2, 'admin', '$2y$10$dg0GNvRXs2xIl2by2FOTMOqtHrmFqxX.hzzCC92u5sIr3HN9NGihC', '2025-10-21 05:30:22', '2025-10-21 05:30:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_jawaban`
--
ALTER TABLE `detail_jawaban`
  ADD PRIMARY KEY (`id_detail`),
  ADD UNIQUE KEY `uq_jawaban_pertanyaan` (`id_jawaban`,`id_pertanyaan`),
  ADD KEY `detail_jawaban_ibfk_2` (`id_pertanyaan`);

--
-- Indeks untuk tabel `dimensi`
--
ALTER TABLE `dimensi`
  ADD PRIMARY KEY (`id_dimensi`),
  ADD UNIQUE KEY `kode_dimensi` (`kode_dimensi`);

--
-- Indeks untuk tabel `hasil_wqi`
--
ALTER TABLE `hasil_wqi`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `hasil_wqi_ibfk_1` (`id_survei`),
  ADD KEY `hasil_wqi_ibfk_2` (`id_dimensi`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD UNIQUE KEY `uq_survei_responden` (`id_survei`,`id_responden`),
  ADD KEY `jawaban_ibfk_2` (`id_responden`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD UNIQUE KEY `uq_kode_pertanyaan` (`kode_pertanyaan`),
  ADD KEY `pertanyaan_ibfk_1` (`id_dimensi`);

--
-- Indeks untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id_responden`);

--
-- Indeks untuk tabel `situs`
--
ALTER TABLE `situs`
  ADD PRIMARY KEY (`id_situs`),
  ADD UNIQUE KEY `uq_situs_url` (`url_situs`);

--
-- Indeks untuk tabel `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id_survei`),
  ADD KEY `survei_ibfk_1` (`id_situs`);

--
-- Indeks untuk tabel `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  ADD PRIMARY KEY (`id_survei`,`id_pertanyaan`),
  ADD KEY `survei_pertanyaan_ibfk_2` (`id_pertanyaan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_jawaban`
--
ALTER TABLE `detail_jawaban`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dimensi`
--
ALTER TABLE `dimensi`
  MODIFY `id_dimensi` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hasil_wqi`
--
ALTER TABLE `hasil_wqi`
  MODIFY `id_hasil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `situs`
--
ALTER TABLE `situs`
  MODIFY `id_situs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `survei`
--
ALTER TABLE `survei`
  MODIFY `id_survei` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_jawaban`
--
ALTER TABLE `detail_jawaban`
  ADD CONSTRAINT `detail_jawaban_ibfk_1` FOREIGN KEY (`id_jawaban`) REFERENCES `jawaban` (`id_jawaban`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_wqi`
--
ALTER TABLE `hasil_wqi`
  ADD CONSTRAINT `hasil_wqi_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_wqi_ibfk_2` FOREIGN KEY (`id_dimensi`) REFERENCES `dimensi` (`id_dimensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id_responden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_dimensi`) REFERENCES `dimensi` (`id_dimensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survei`
--
ALTER TABLE `survei`
  ADD CONSTRAINT `survei_ibfk_1` FOREIGN KEY (`id_situs`) REFERENCES `situs` (`id_situs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  ADD CONSTRAINT `survei_pertanyaan_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survei_pertanyaan_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
