-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2026 pada 13.41
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
-- Database: `calon_mhs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_mhs`
--

CREATE TABLE `calon_mhs` (
  `id` int(11) NOT NULL,
  `kode_pendaftaran` varchar(30) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `pekerjaan_ortu` varchar(100) NOT NULL,
  `matematika` tinyint(3) UNSIGNED NOT NULL,
  `bahasa_inggris` tinyint(3) UNSIGNED NOT NULL,
  `umum` tinyint(3) UNSIGNED NOT NULL,
  `rata_rata` decimal(5,2) NOT NULL,
  `keterangan` enum('Lulus','Cadangan','Tidak Lulus') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `calon_mhs`
--

INSERT INTO `calon_mhs` (`id`, `kode_pendaftaran`, `nama_pendaftar`, `jenis_kelamin`, `ttl`, `asal_sekolah`, `pekerjaan_ortu`, `matematika`, `bahasa_inggris`, `umum`, `rata_rata`, `keterangan`, `created_at`) VALUES
(1, 'A2-100-1', 'MUHAMMAD AL GADAFI', 'Laki-laki', '18', 'SMK LINK AND MATCH', 'Buruh', 90, 92, 92, 91.33, 'Lulus', '2026-10-28 12:38:08'),
(2, 'A2-101-2', 'Aditya Pratama', 'Laki-laki', 'Tangerang, 12-03-2005', 'SMA Negeri 1 Tangerang', 'Wiraswasta', 85, 78, 82, 81.67, 'Lulus', '2026-10-28 12:39:37'),
(3, 'A2-102-3', 'Siti Nurhaliza', 'Perempuan', 'Jakarta, 21-07-2005', 'SMA Negeri 5 Jakarta', 'Guru', 92, 88, 90, 90.00, 'Lulus', '2026-10-28 12:39:37'),
(4, 'A2-103-4', 'Muhammad Rizky', 'Laki-laki', 'Depok, 05-11-2004', 'SMK Negeri 2 Depok', 'Karyawan Swasta', 65, 70, 68, 67.67, 'Cadangan', '2026-10-28 12:39:37'),
(5, 'A2-104-5', 'Putri Amelia', 'Perempuan', 'Bogor, 14-02-2005', 'SMA Negeri 3 Bogor', 'PNS', 75, 80, 72, 75.67, 'Lulus', '2026-10-28 12:39:37'),
(6, 'A2-105-6', 'Fajar Ramadhan', 'Laki-laki', 'Bekasi, 19-09-2004', 'SMK Negeri 1 Bekasi', 'Pedagang', 55, 58, 60, 57.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(7, 'A2-106-7', 'Nadia Safitri', 'Perempuan', 'Tangerang, 02-06-2005', 'SMA Negeri 8 Tangerang', 'Perawat', 88, 84, 86, 86.00, 'Lulus', '2026-10-28 12:39:37'),
(8, 'A2-107-8', 'Andi Saputra', 'Laki-laki', 'Serang, 23-01-2005', 'SMK Negeri 4 Serang', 'Petani', 62, 61, 65, 62.67, 'Cadangan', '2026-10-28 12:39:37'),
(9, 'A2-108-9', 'Dewi Anggraini', 'Perempuan', 'Jakarta, 30-04-2005', 'SMA Negeri 12 Jakarta', 'Karyawan Swasta', 70, 73, 75, 72.67, 'Lulus', '2026-10-28 12:39:37'),
(10, 'A2-109-1', 'Rafi Maulana', 'Laki-laki', 'Depok, 16-12-2004', 'SMA Negeri 6 Depok', 'Sopir', 45, 52, 50, 49.00, 'Tidak Lulus', '2026-10-28 12:39:37'),
(11, 'A2-110-2', 'Intan Permata', 'Perempuan', 'Tangerang Selatan, 08-08-2005', 'SMK Negeri 2 Tangsel', 'Wiraswasta', 95, 91, 94, 93.33, 'Lulus', '2026-10-28 12:39:37'),
(12, 'A2-111-3', 'Bima Arya', 'Laki-laki', 'Bogor, 17-05-2005', 'SMA Negeri 2 Bogor', 'PNS', 72, 68, 70, 70.00, 'Lulus', '2026-10-28 12:39:37'),
(13, 'A2-112-4', 'Aulia Rahma', 'Perempuan', 'Bekasi, 27-10-2004', 'SMA Negeri 4 Bekasi', 'Ibu Rumah Tangga', 60, 62, 59, 60.33, 'Cadangan', '2026-10-28 12:39:37'),
(14, 'A2-113-5', 'Dimas Kurniawan', 'Laki-laki', 'Jakarta, 11-01-2005', 'SMK Negeri 7 Jakarta', 'Teknisi', 81, 77, 79, 79.00, 'Lulus', '2026-10-28 12:39:37'),
(15, 'A2-114-6', 'Citra Lestari', 'Perempuan', 'Serang, 09-09-2005', 'SMA Negeri 1 Serang', 'Guru', 68, 66, 64, 66.00, 'Cadangan', '2026-10-28 12:39:37'),
(16, 'A2-115-7', 'Farhan Akbar', 'Laki-laki', 'Tangerang, 25-12-2004', 'SMK Negeri 5 Tangerang', 'Buruh', 50, 55, 57, 54.00, 'Tidak Lulus', '2026-10-28 12:39:37'),
(17, 'A2-116-8', 'Maya Puspita', 'Perempuan', 'Depok, 13-06-2005', 'SMA Negeri 2 Depok', 'Dokter', 89, 90, 87, 88.67, 'Lulus', '2026-10-28 12:39:37'),
(18, 'A2-117-9', 'Rizal Firmansyah', 'Laki-laki', 'Bogor, 04-04-2005', 'SMK Negeri 3 Bogor', 'Wiraswasta', 74, 76, 71, 73.67, 'Lulus', '2026-10-28 12:39:37'),
(19, 'A2-118-1', 'Anisa Khairunnisa', 'Perempuan', 'Jakarta, 18-02-2005', 'SMA Negeri 9 Jakarta', 'PNS', 58, 63, 60, 60.33, 'Cadangan', '2026-10-28 12:39:37'),
(20, 'A2-119-2', 'Yoga Pratama', 'Laki-laki', 'Bekasi, 22-08-2004', 'SMK Negeri 6 Bekasi', 'Karyawan Swasta', 77, 82, 80, 79.67, 'Lulus', '2026-10-28 12:39:37'),
(21, 'A2-120-3', 'Laila Fitriani', 'Perempuan', 'Tangerang Selatan, 07-07-2005', 'SMA Negeri 7 Tangsel', 'Pedagang', 66, 70, 67, 67.67, 'Cadangan', '2026-10-28 12:39:37'),
(22, 'A2-121-4', 'Ilham Maulana', 'Laki-laki', 'Tangerang, 15-10-2004', 'SMK Negeri 1 Tangerang', 'Petani', 40, 48, 52, 46.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(23, 'A2-122-5', 'Vina Oktaviani', 'Perempuan', 'Depok, 29-03-2005', 'SMA Negeri 4 Depok', 'Perawat', 84, 86, 88, 86.00, 'Lulus', '2026-10-28 12:39:37'),
(24, 'A2-123-6', 'Bagas Setiawan', 'Laki-laki', 'Serang, 03-12-2004', 'SMK Negeri 2 Serang', 'PNS', 71, 69, 73, 71.00, 'Lulus', '2026-10-28 12:39:37'),
(25, 'A2-124-7', 'Rani Aprilia', 'Perempuan', 'Bogor, 20-01-2005', 'SMA Negeri 6 Bogor', 'Karyawan Swasta', 63, 60, 65, 62.67, 'Cadangan', '2026-10-28 12:39:37'),
(26, 'A2-125-8', 'Arif Hidayat', 'Laki-laki', 'Jakarta, 06-05-2005', 'SMK Negeri 8 Jakarta', 'Wiraswasta', 91, 85, 89, 88.33, 'Lulus', '2026-10-28 12:39:37'),
(27, 'A2-126-9', 'Dinda Maharani', 'Perempuan', 'Bekasi, 24-11-2004', 'SMA Negeri 10 Bekasi', 'Guru', 56, 59, 61, 58.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(28, 'A2-127-1', 'Reza Pahlevi', 'Laki-laki', 'Tangerang, 10-02-2005', 'SMK Negeri 3 Tangerang', 'Teknisi', 78, 74, 76, 76.00, 'Lulus', '2026-10-28 12:39:37'),
(29, 'A2-128-2', 'Nisa Azzahra', 'Perempuan', 'Depok, 31-07-2005', 'SMA Negeri 1 Depok', 'PNS', 69, 72, 70, 70.33, 'Lulus', '2026-10-28 12:39:37'),
(30, 'A2-129-3', 'Aldi Firmansyah', 'Laki-laki', 'Bogor, 12-09-2004', 'SMK Negeri 5 Bogor', 'Pedagang', 48, 45, 55, 49.33, 'Tidak Lulus', '2026-10-28 12:39:37'),
(31, 'A2-130-4', 'Sarah Amelia', 'Perempuan', 'Serang, 26-06-2005', 'SMA Negeri 4 Serang', 'Wiraswasta', 87, 83, 90, 86.67, 'Lulus', '2026-10-28 12:39:37'),
(32, 'A2-131-5', 'Rangga Saputra', 'Laki-laki', 'Bekasi, 14-03-2005', 'SMK Negeri 9 Bekasi', 'Karyawan Swasta', 61, 65, 63, 63.00, 'Cadangan', '2026-10-28 12:39:37'),
(33, 'A2-132-6', 'Elsa Novita', 'Perempuan', 'Tangerang Selatan, 01-12-2004', 'SMA Negeri 3 Tangsel', 'Guru', 73, 75, 78, 75.33, 'Lulus', '2026-10-28 12:39:37'),
(34, 'A2-133-7', 'Doni Kurnia', 'Laki-laki', 'Jakarta, 09-08-2005', 'SMK Negeri 4 Jakarta', 'Sopir', 52, 57, 54, 54.33, 'Tidak Lulus', '2026-10-28 12:39:37'),
(35, 'A2-134-8', 'Fitri Handayani', 'Perempuan', 'Depok, 28-02-2005', 'SMA Negeri 7 Depok', 'Perawat', 90, 92, 88, 90.00, 'Lulus', '2026-10-28 12:39:37'),
(36, 'A2-135-9', 'Wahyu Nugroho', 'Laki-laki', 'Tangerang, 16-04-2004', 'SMK Negeri 6 Tangerang', 'Buruh', 67, 64, 69, 66.67, 'Cadangan', '2026-10-28 12:39:37'),
(37, 'A2-136-1', 'Amelia Putri', 'Perempuan', 'Bogor, 05-05-2005', 'SMA Negeri 5 Bogor', 'PNS', 80, 79, 82, 80.33, 'Lulus', '2026-10-28 12:39:37'),
(38, 'A2-137-2', 'Gilang Ramadhan', 'Laki-laki', 'Serang, 19-07-2005', 'SMK Negeri 1 Serang', 'Wiraswasta', 59, 58, 62, 59.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(39, 'A2-138-3', 'Tasya Rahmadani', 'Perempuan', 'Bekasi, 23-09-2004', 'SMA Negeri 11 Bekasi', 'Karyawan Swasta', 86, 81, 84, 83.67, 'Lulus', '2026-10-28 12:39:37'),
(40, 'A2-139-4', 'Kevin Alfarizi', 'Laki-laki', 'Tangerang Selatan, 02-01-2005', 'SMK Negeri 3 Tangsel', 'Teknisi', 76, 70, 74, 73.33, 'Lulus', '2026-10-28 12:39:37'),
(41, 'A2-140-5', 'Nabila Salsabila', 'Perempuan', 'Jakarta, 17-06-2005', 'SMA Negeri 13 Jakarta', 'Guru', 64, 68, 62, 64.67, 'Cadangan', '2026-10-28 12:39:37'),
(42, 'A2-141-6', 'Hendra Wijaya', 'Laki-laki', 'Depok, 30-10-2004', 'SMK Negeri 2 Depok', 'Pedagang', 43, 50, 47, 46.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(43, 'A2-142-7', 'Yuni Kartika', 'Perempuan', 'Tangerang, 08-04-2005', 'SMA Negeri 9 Tangerang', 'PNS', 93, 89, 91, 91.00, 'Lulus', '2026-10-28 12:39:37'),
(44, 'A2-143-8', 'Robby Kurniawan', 'Laki-laki', 'Bogor, 21-12-2004', 'SMK Negeri 7 Bogor', 'Karyawan Swasta', 70, 71, 69, 70.00, 'Lulus', '2026-10-28 12:39:37'),
(45, 'A2-144-9', 'Salsa Bila', 'Perempuan', 'Serang, 11-11-2005', 'SMA Negeri 2 Serang', 'Wiraswasta', 57, 61, 58, 58.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(46, 'A2-145-1', 'Tegar Prakoso', 'Laki-laki', 'Bekasi, 06-02-2005', 'SMK Negeri 10 Bekasi', 'Teknisi', 82, 80, 77, 79.67, 'Lulus', '2026-10-28 12:39:37'),
(47, 'A2-146-2', 'Aisyah Zahra', 'Perempuan', 'Tangerang Selatan, 27-05-2005', 'SMA Negeri 5 Tangsel', 'Perawat', 74, 78, 72, 74.67, 'Lulus', '2026-10-28 12:39:37'),
(48, 'A2-147-3', 'Daffa Alfarizi', 'Laki-laki', 'Jakarta, 15-09-2004', 'SMK Negeri 11 Jakarta', 'Sopir', 49, 53, 56, 52.67, 'Tidak Lulus', '2026-10-28 12:39:37'),
(49, 'A2-148-4', 'Monica Aprilia', 'Perempuan', 'Depok, 04-07-2005', 'SMA Negeri 8 Depok', 'Guru', 88, 85, 83, 85.33, 'Lulus', '2026-10-28 12:39:37'),
(50, 'A2-149-5', 'Rian Permana', 'Laki-laki', 'Tangerang, 22-01-2005', 'SMK Negeri 4 Tangerang', 'Wiraswasta', 65, 67, 70, 67.33, 'Cadangan', '2026-10-28 12:39:37'),
(51, 'A2-150-6', 'Zahra Nurfadila', 'Perempuan', 'Bogor, 13-10-2004', 'SMA Negeri 7 Bogor', 'PNS', 79, 84, 81, 81.33, 'Lulus', '2026-10-28 12:39:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon_mhs`
--
ALTER TABLE `calon_mhs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pendaftaran` (`kode_pendaftaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_mhs`
--
ALTER TABLE `calon_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
