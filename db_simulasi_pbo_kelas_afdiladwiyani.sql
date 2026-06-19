-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2026 at 04:06 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_kelas_afdiladwiyani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Yogyakarta', 87.50, 250000.00, 'Reguler', 'Sistem Informasi', 'Kampus Kota', NULL, NULL, NULL, NULL),
(2, 'Citra Lestari', 'SMAN 5 Surabaya', 79.20, 250000.00, 'Reguler', 'Manajemen', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Dedi Kurniawan', 'SMKAN 1 Medan', 82.00, 250000.00, 'Reguler', 'Teknik Elektro', 'Kampus Barat', NULL, NULL, NULL, NULL),
(4, 'Eka Putri', 'SMA Kristen Petra', 91.10, 250000.00, 'Reguler', 'Akuntansi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Fahri Hamzah', 'MAN 2 Jakarta', 84.60, 250000.00, 'Reguler', 'Hukum', 'Kampus Kota', NULL, NULL, NULL, NULL),
(6, 'Gita Gutawa', 'SMAN 3 Semarang', 88.30, 250000.00, 'Reguler', 'Psikologi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Hendra Wijaya', 'SMAN 1 Makassar', 76.80, 250000.00, 'Reguler', 'Teknik Sipil', 'Kampus Barat', NULL, NULL, NULL, NULL),
(8, 'Indah Permata', 'SMAN 2 Bandung', 94.50, 150000.00, 'Prestasi', NULL, NULL, 'Fisika', 'Nasional', NULL, NULL),
(9, 'Kevin Sanjaya', 'SMA Katolik St. Louis', 89.00, 150000.00, 'Prestasi', NULL, NULL, 'Bulutangkis', 'Internasional', NULL, NULL),
(10, 'Larasati Dewi', 'SMAN 1 Surakarta', 91.80, 150000.00, 'Prestasi', NULL, NULL, 'Karya Ilmiah Remaja', 'Provinsi', NULL, NULL),
(11, 'Muhammad Rizky', 'MAN 1 Malang', 93.20, 150000.00, 'Prestasi', NULL, NULL, 'Tahfidz Al-Quran 30 Juz', 'Nasional', NULL, NULL),
(12, 'Nadia Utami', 'SMAN 8 Jakarta', 95.00, 150000.00, 'Prestasi', NULL, NULL, 'Debat Bahasa Inggris', 'Nasional', NULL, NULL),
(13, 'Oki Setiawan', 'SMAN 1 Palembang', 88.50, 150000.00, 'Prestasi', NULL, NULL, 'Catur', 'Provinsi', NULL, NULL),
(14, 'Putri Ayu', 'SMAN 4 Denpasar', 90.70, 150000.00, 'Prestasi', NULL, NULL, 'Tari Tradisional', 'Internasional', NULL, NULL),
(15, 'Rangga Putra', 'SMAN 1 Balikpapan', 86.40, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-102/BKN/2026', 'Badan Kepegawaian Negara'),
(16, 'Siti Nurhaliza', 'SMA Al-Azhar Jakarta', 89.90, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-554/KEMENKEU/2026', 'Kementerian Keuangan'),
(17, 'Taufik Hidayat', 'SMAN 1 Padang', 85.10, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-088/KEMENHUB/2026', 'Kementerian Perhubungan'),
(18, 'Vania Larissa', 'SMAN 2 Pontianak', 87.30, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-312/BMKG/2026', 'BMKG'),
(19, 'Wawan Setiawan', 'SMK Penerbangan Bogor', 84.00, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-701/DISHUB/2026', 'Dinas Perhubungan Provinsi'),
(20, 'Yulia Ningsih', 'SMAN 1 Ambon', 88.20, 250000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-442/KEMENKES/2026', 'Kementerian Kesehatan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
