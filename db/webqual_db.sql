-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2025 pada 13.35
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
(10, 2, 1, 3, 1),
(11, 2, 2, 3, 4),
(12, 2, 3, 3, 1),
(13, 2, 4, 4, 3),
(14, 2, 5, 2, 5),
(15, 2, 6, 2, 4),
(16, 2, 7, 1, 4),
(17, 2, 8, 4, 1),
(18, 2, 9, 3, 1);

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
(3, 'SERVICE_INTERACTION', 'Kualitas Interaksi Layanan', NULL);

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
(2, 1, 4, '2025-10-21 17:45:30');

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
(1, 1, 'US1', 'Navigasi situs mudah dipahami', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(2, 1, 'US2', 'Tata letak dan tampilan konsisten di setiap halaman', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(3, 1, 'US3', 'Kecepatan akses situs memadai', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(4, 2, 'IN1', 'Informasi akurat dan dapat dipercaya', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(5, 2, 'IN2', 'Informasi lengkap dan relevan dengan kebutuhan pengguna', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(6, 2, 'IN3', 'Informasi diperbarui secara tepat waktu', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(7, 3, 'SI1', 'Aktivitas di situs terasa aman', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(8, 3, 'SI2', 'Tersedia kanal komunikasi/umpan balik yang mudah digunakan', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06'),
(9, 3, 'SI3', 'Proses layanan berjalan lancar sesuai harapan', 1, '2025-10-13 01:36:06', '2025-10-13 01:36:06');

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
(4, 'somasufyw@mailinator.com', 'Magna enim nisi veli', 'Reiciendis omnis est', 29, 'Perempuan', 'Lorem optio deserun', 'Animi amet sint in', '2025-10-21 10:45:30', '2025-10-21 10:45:30');

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
(1, 1, 'Survei WebQual MPP Sidoarjo - 2025', '2025-10-01 00:00:00', '2025-12-31 23:59:59', 'berjalan', '2025-10-13 01:36:05', '2025-10-13 01:36:05');

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
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),
(1, 7, 7),
(1, 8, 8),
(1, 9, 9);

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
  ADD KEY `hasil_wqi_ibfk_2` (`id_dimensi`),
  ADD KEY `hasil_wqi_ibfk_1` (`id_survei`);

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
  MODIFY `id_hasil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `detail_jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_wqi`
--
ALTER TABLE `hasil_wqi`
  ADD CONSTRAINT `hasil_wqi_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_wqi_ibfk_2` FOREIGN KEY (`id_dimensi`) REFERENCES `dimensi` (`id_dimensi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id_responden`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_dimensi`) REFERENCES `dimensi` (`id_dimensi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survei`
--
ALTER TABLE `survei`
  ADD CONSTRAINT `survei_ibfk_1` FOREIGN KEY (`id_situs`) REFERENCES `situs` (`id_situs`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survei_pertanyaan`
--
ALTER TABLE `survei_pertanyaan`
  ADD CONSTRAINT `survei_pertanyaan_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survei_pertanyaan_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
