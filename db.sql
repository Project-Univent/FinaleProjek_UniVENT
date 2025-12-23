-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 06:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(1, '', '$2y$10$dSDivjz7YRDA.4.ufRFhhefXoWPrH54uyIhmH67uBcAxpGSq/Yv1S', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_panitia` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_event` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_event` date NOT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `lokasi` varchar(150) NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `catatan_admin` text DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_panitia`, `id_kategori`, `nama_event`, `deskripsi`, `tanggal_event`, `waktu_mulai`, `lokasi`, `poster`, `kuota`, `status`, `catatan_admin`, `id_admin`) VALUES
(28, 1, 1, 'Seminar Teknologi AI untuk Mahasiswa', 'Seminar ini membahas perkembangan terbaru kecerdasan buatan (Artificial Intelligence) serta penerapannya di dunia akademik dan industri. Acara ini ditujukan untuk mahasiswa yang ingin memahami dasar AI, peluang karier, dan tren teknologi masa depan secara praktis dan mudah dipahami.', '2026-01-20', '08:00:00', 'Aula Lantai 3 Ruang 302', NULL, 50, 'approved', NULL, NULL),
(29, 1, 2, 'Workshop Pengembangan Web Dasar', 'Workshop ini dirancang untuk mahasiswa yang ingin mempelajari dasar-dasar pengembangan web menggunakan HTML, CSS, dan JavaScript. Peserta akan mendapatkan pengalaman praktik langsung serta pemahaman alur pembuatan website dari nol hingga siap ditampilkan.', '2026-01-19', '09:30:00', 'Aula Lantai 2 Ruang 201', NULL, 75, 'pending', NULL, NULL),
(30, 1, 3, 'Lomba UI/UX Design Antar Mahasiswa', 'Lomba ini bertujuan untuk mengasah kreativitas dan kemampuan mahasiswa dalam merancang antarmuka dan pengalaman pengguna aplikasi. Peserta ditantang untuk membuat desain UI/UX yang inovatif, user-friendly, dan sesuai dengan kebutuhan pengguna, serta berkesempatan mendapatkan feedback langsung dari praktisi desain.', '2026-01-24', '08:30:00', 'Aula Utama', NULL, 30, 'rejected', NULL, NULL),
(31, 1, 4, 'Webinar Tips Persiapan Karier untuk Fresh Graduate', 'Webinar ini membahas berbagai tips dan strategi persiapan karier bagi mahasiswa tingkat akhir dan fresh graduate, mulai dari penyusunan CV, persiapan wawancara kerja, hingga cara membangun personal branding di dunia profesional. Acara ini cocok untuk mahasiswa yang ingin lebih siap menghadapi dunia kerja setelah lulus.', '2026-01-16', '10:00:00', 'Aula Utama', NULL, 100, 'approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_event`
--

CREATE TABLE `kategori_event` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_event`
--

INSERT INTO `kategori_event` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Seminar Mahasiswa'),
(2, 'Workshop'),
(3, 'Lomba'),
(4, 'Webinar'),
(5, 'UKM & Organisasi');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notification` int(11) NOT NULL,
  `user_role` enum('admin','panitia','peserta') NOT NULL,
  `user_id` int(11) NOT NULL,
  `channel` enum('email','push') NOT NULL DEFAULT 'email',
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `status` enum('sent','failed') NOT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notification`, `user_role`, `user_id`, `channel`, `title`, `message`, `status`, `error_message`, `created_at`) VALUES
(1, 'panitia', 1, 'email', 'Event Disetujui', 'Event \"b\" telah disetujui oleh admin.', 'sent', NULL, '2025-12-21 03:51:37'),
(2, 'panitia', 1, 'email', 'Event Disetujui', 'Halo Panitia,\n\nEvent \"w\" TELAH DISETUJUI oleh admin.\n\nSilakan lanjutkan persiapan acara.\n\n– UniVENT', 'sent', NULL, '2025-12-21 04:23:08'),
(3, 'panitia', 2, 'email', 'Event Disetujui', 'Halo Panitia,\n\nEvent \"yes\" TELAH DISETUJUI oleh admin.\n\nSilakan lanjutkan persiapan acara.\n\n– UniVENT', 'sent', NULL, '2025-12-21 04:27:40'),
(4, 'panitia', 1, 'email', 'Event Disetujui', 'Halo Panitia,\n\nEvent \"w\" TELAH DISETUJUI oleh admin.\n\nSilakan lanjutkan persiapan acara.\n\n– UniVENT', 'sent', NULL, '2025-12-21 17:56:16'),
(5, 'panitia', 2, 'email', 'Event Disetujui', 'Halo Panitia,\n\nEvent \"1\" TELAH DISETUJUI oleh admin.\n\nSilakan lanjutkan persiapan acara.\n\n– UniVENT', 'sent', NULL, '2025-12-21 18:02:51'),
(6, 'panitia', 1, 'email', 'Event Ditolak', 'Halo Panitia,\n\nEvent \"Workshop GITKODING\" DITOLAK oleh admin.\n\nCatatan Admin:\nKesalahan Nama\n\nSilakan perbaiki dan ajukan kembali.\n\n– UniVENT', 'sent', NULL, '2025-12-22 22:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `panitia`
--

CREATE TABLE `panitia` (
  `id_panitia` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panitia`
--

INSERT INTO `panitia` (`id_panitia`, `username`, `password`, `email`) VALUES
(1, '', '$2y$10$C2H8.fb39MpNluPFlge/6uoP41S7dm87qQQnGJpozXQW3Oq2x6Kti', 'panitia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `username`, `password`, `email`, `reset_token`, `reset_expired`) VALUES
(15, 'peserta1', '$2y$10$gohqRriu.1wvCXOdv3eBuuYXXb6HtzwJsvT5T72JRAhxoodS8Yosi', 'peserta1@gmail.com', NULL, NULL),
(16, 'peserta2', '$2y$10$NiHxZ6Llewqqyxp8eKpCMOsdwSHKCKDdgUE7ZiGUeUpLQLfKaCuQW', 'peserta2@gmail.com', NULL, NULL),
(17, 'peserta3', '$2y$10$bfnL5gTQulhaZzmjzsV2gOXulw2e00d4/gxvVyaxZJkd6pcjPtEjy', 'peserta3@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `kode_tiket` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_event`, `id_peserta`, `kode_tiket`, `created_at`) VALUES
(22, 31, 15, 'TKT-53E45C9B', '2025-12-23 16:51:44'),
(23, 28, 15, 'TKT-D91D1D0B', '2025-12-23 16:51:49'),
(24, 28, 16, 'TKT-5205A685', '2025-12-23 16:52:36'),
(25, 28, 17, 'TKT-C5281D50', '2025-12-23 16:52:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_panitia` (`id_panitia`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_event`
--
ALTER TABLE `kategori_event`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notification`);

--
-- Indexes for table `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id_panitia`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD UNIQUE KEY `kode_tiket` (`kode_tiket`),
  ADD UNIQUE KEY `id_event` (`id_event`,`id_peserta`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kategori_event`
--
ALTER TABLE `kategori_event`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id_panitia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`id_panitia`) REFERENCES `panitia` (`id_panitia`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_event` (`id_kategori`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
