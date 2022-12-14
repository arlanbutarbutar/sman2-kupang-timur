-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Des 2022 pada 12.33
-- Versi server: 10.3.37-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhdbfgel_sman2_kupang_timur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` varchar(35) NOT NULL,
  `status` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `gelar` varchar(35) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `tempat_lahir`, `tgl_lahir`, `status`, `jenis_kelamin`, `gelar`, `created_at`, `updated_at`) VALUES
(9, '197604182008011013', 'Yulius B. Tenawahang', 'Belogili-Flores Timur', '18 Apr 1976', 'PNS', 'Laki-Laki', 'S.Fil,M.Pd', '2022-11-14 12:49:55', '2022-11-15 19:59:03'),
(10, '1968011519970222002', 'Lusia Jian', 'Lema', '15 Jan 1968', 'PNS', 'Perempuan', 'S.Pd,M.Pd', '2022-11-15 08:07:20', '2022-11-15 19:59:49'),
(11, '196411061993031005', 'Drs. Simson Oematan', 'Naibonat', '05 Nov 1964', 'PNS', 'Laki-Laki', 'Drs', '2022-11-15 08:12:16', '2022-11-15 20:00:43'),
(12, '1971093019993031004', 'Petrus Mado Betan', 'Waibalun - FLOTIM', '30 Sep 1971', 'PNS', 'Laki-Laki', 'S.Pd', '2022-11-15 08:17:49', '2022-11-15 20:01:39'),
(13, '197610022005022007', 'Inawati', 'Sleman', '02 Oct 1976', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 08:21:00', '2022-11-15 20:03:27'),
(14, '197411022005012005', 'Emelia Theak', 'Sulamu', '02 Nov 1974', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 08:26:16', '2022-11-15 20:21:30'),
(15, '197207132005011007', 'Ahmad Safan', 'Bengkalis', '13 Jul 1972', 'PNS', 'Laki-Laki', 'S.Pd', '2022-11-15 08:28:46', '2022-11-15 20:20:42'),
(16, '1', 'Dominika Laga', 'Mehona', '29 Nov 1994', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-15 08:31:56', '2022-11-15 20:19:40'),
(17, '197508272005012012', 'Felipina Agustina Kale', 'Kupang', '27 Aug 1975', 'PNS', 'Perempuan', 'S.Pd,M.Pd', '2022-11-15 08:35:17', '2022-11-15 20:18:06'),
(18, '196402022000031004', 'Syahrir Masneno', 'Taimbira', '02 Feb 1964', 'PNS', 'Laki-Laki', 'Drs', '2022-11-15 08:39:59', '2022-11-15 20:17:16'),
(19, '197904262005012010', 'Camelia Selan', 'Sikka', '26 Apr 1979', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 08:43:15', '2022-11-15 20:16:06'),
(20, '198003092005012006', 'Trovina R. V. E. Walangara', 'Lolajangi', '09 Mar 1980', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 08:46:18', '2022-11-15 20:14:47'),
(21, '197707022006042031', 'Elsy Y. Lubalu', 'Babau', '02 Jul 1977', 'PNS', 'Perempuan', 'S.P, M.Si', '2022-11-15 08:51:11', '2022-11-15 20:13:38'),
(22, '197509012007012010', 'Asis Solideo Tameno', 'Oesao', '01 Sep 1975', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 08:55:03', '2022-11-15 20:22:46'),
(23, '197312072006041014', 'Derson S. Djawa', 'Pukdale', '07 Dec 1973', 'PNS', 'Laki-Laki', 'S.Sos, M.Pd', '2022-11-15 09:00:19', '2022-11-15 20:12:21'),
(24, '197905292009031001', 'Piterson Pulungtana', 'Napu- Sumba Timur', '29 May 1979', 'PNS', 'Laki-Laki', 'S.Pd', '2022-11-15 09:03:40', '2022-11-15 20:11:13'),
(25, '197911032009031006', 'Dan Taebonat', 'Tanenofunan', '03 Nov 1979', 'PNS', 'Laki-Laki', 'S.Pd, M.Fis', '2022-11-15 09:06:47', '2022-11-15 20:10:23'),
(26, '198403282010012030', 'Marlistiyati P. Tolok', 'Kupang', '28 Mar 1984', 'PNS', 'Perempuan', 'S.Pd, M.Si', '2022-11-15 09:10:23', '2022-11-15 20:09:17'),
(27, '197908122010012021', 'Ester A. Naitboho', 'TTS', '12 Aug 1979', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 09:34:50', '2022-11-15 20:08:30'),
(28, '198006102010012021', 'Yani M. Kapitan', 'Kupang', '10 Jun 1980', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 09:37:20', '2022-11-15 20:06:15'),
(29, '198311152009031005', 'Handrianus Y. H. Jami', 'Mehona', '15 Nov 1983', 'PNS', 'Laki-Laki', 'S.Pd', '2022-11-15 17:59:25', '2022-11-15 20:30:06'),
(30, '198001312010012021', 'Linda Lidia Falukas', 'Merdeka', '31 Jan 1980', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 18:02:09', '2022-11-15 20:32:58'),
(31, '198801282015032001', 'Herlina Perdanawaty', 'Surakarta', '28 Jan 1988', 'PNS', 'Perempuan', 'S.Pd', '2022-11-15 18:05:03', '2022-11-15 20:35:55'),
(32, '198410272014061003', 'Tri Giyanto', 'Sragen', '27 Oct 1984', 'PNS', 'Laki-Laki', 'S.Pd ,M.Fis,AIFO', '2022-11-15 18:08:19', '2022-11-15 20:39:24'),
(33, '197203142014061003', 'Simson Karlau', 'Naibonat', '03 14 1972', 'PNS', 'Laki-Laki', 'S.Pd', '2022-11-15 18:13:12', '2022-11-15 18:13:12'),
(34, '', 'Devesty Mariance Foes', 'Naibonat', '24 Dec 1986', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-15 18:15:48', '2022-12-13 17:31:50'),
(35, '', 'Aksamina Nubatonis', 'Oebaki', '22 Nov 1982', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:06:55', '2022-12-13 17:36:09'),
(36, '', 'Elvis H. Bod', 'Kupang', '20 May 1987', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-16 02:08:11', '2022-12-13 17:36:55'),
(37, '', 'Gregorius F. Gado', 'Lekebai', '02 Jan 1980', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-16 02:09:16', '2022-12-13 17:37:55'),
(38, '6', 'Margareta L. Seran', 'Kupang', '11 14 1993', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:10:38', '2022-11-16 02:10:38'),
(39, '', 'Yuliet Ratu Mana', 'Kupang', '04 Jul 1983', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:13:39', '2022-12-13 17:38:40'),
(40, '8', 'Agnes Praga Ea', 'Bengga', '03 06 1991', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:15:28', '2022-11-16 02:15:28'),
(41, '9', 'Ronald E. Bire', 'Sahan', '11 11 1993', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-16 02:16:58', '2022-11-16 02:16:58'),
(42, '10', 'Mira Lesiangi', 'Pukdal', '02 20 1994', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:18:14', '2022-11-16 02:18:14'),
(43, '11', 'Adriana Luruk Bau', 'Webriamata', '07 06 1992', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:19:38', '2022-11-16 02:19:38'),
(44, '12', 'Celsetino Da Costa Gusmao', 'Quelicai', '08 28 1989', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-16 02:22:33', '2022-11-16 02:22:33'),
(45, '', 'Reno Dethan', 'Naibonat', '06 Mar 1995', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-16 02:24:01', '2022-12-13 17:39:56'),
(46, '', 'Adrianus Kiik Bermali', 'Haliren', '16 Dec 1992', 'Honorer', 'Laki-Laki', 'S.Fil', '2022-11-16 02:26:02', '2022-12-13 17:30:26'),
(47, '', 'Maria F. Resky Radja', 'Kupang', '15 Jan 1997', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:27:27', '2022-12-13 17:29:14'),
(48, '', 'Maria Ermince Soba', 'Ermera', '01 Jan 1995', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:29:15', '2022-12-13 17:27:25'),
(49, '', 'Yolantry J.  Foes', 'Koli', '11 Apr 1998', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:31:13', '2022-12-13 17:26:23'),
(50, '', 'Vony A. Pulungtana', 'Napu- Sumba Timur', '11 Jul 1998', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:33:15', '2022-12-10 14:54:18'),
(51, '', 'Florentina Mein', 'Welu', '17 May 1997', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:34:39', '2022-12-10 14:53:16'),
(52, '', 'Etmin Y. Oematan', 'Naibonat', '17 Jul 1979', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:36:17', '2022-12-10 14:52:21'),
(53, '', 'Febri Ariantji Pe', 'Kupang', '17 Feb 1983', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:38:03', '2022-12-10 14:50:59'),
(54, '', 'Welince Adelta Bengkiuk', 'Naibonat', '05 Apr 1982', 'Honorer', 'Perempuan', 'S.Pd', '2022-11-16 02:39:57', '2022-12-10 14:48:45'),
(56, '', 'Napolion Satrio Freitas', 'Dili', '04 Nov 1991', 'Honorer', 'Laki-Laki', 'S.Pd', '2022-11-28 20:39:25', '2022-12-08 12:23:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `kelas` varchar(35) NOT NULL,
  `mapel` varchar(75) NOT NULL,
  `jam_mulai` varchar(10) NOT NULL,
  `jam_selesai` varchar(10) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_guru`, `kelas`, `mapel`, `jam_mulai`, `jam_selesai`, `hari`, `created_at`, `updated_at`) VALUES
(6, 40, '10 IPA 1', 'Pendidikan Agama', '08:15 am', '09:00 am', 'Senin', '2022-11-15 14:01:08', '2022-11-15 14:01:08'),
(7, 35, '11 IPA 2', 'Biologi', '08:15 am', '09:00 am', 'Senin', '2022-11-15 14:02:31', '2022-11-15 14:02:31'),
(8, 27, '10 IPA 3', 'Fisika', '08:15 am', '09:00 am', 'Selasa', '2022-11-15 14:03:30', '2022-11-15 20:47:53'),
(9, 40, '10 IPS 1', 'Pendidikan Agama', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:50:36', '2022-11-16 02:50:36'),
(11, 25, '10 IPS 3', 'Sejarah Indonesia', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:52:28', '2022-11-16 02:52:28'),
(12, 24, '11 IPA 1', 'PJOK', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:53:34', '2022-11-16 02:53:34'),
(13, 44, '11 IPA 2', 'Bahasa Indonesia', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:55:20', '2022-11-16 02:55:20'),
(14, 24, '11 IPA 3', 'PJOK', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:56:17', '2022-11-16 02:56:17'),
(15, 25, '11 IPS 1', 'Sejarah Indonesia', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:56:58', '2022-11-16 02:56:58'),
(16, 41, '11 IPS 2', 'Geografi', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:57:53', '2022-11-16 02:57:53'),
(17, 31, '11 IPS 3', 'PJOK', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:58:34', '2022-11-16 02:58:34'),
(18, 17, '11 IPS 4', 'Prakarya', '08:15 am', '09:00 am', 'Senin', '2022-11-16 02:59:17', '2022-11-16 02:59:17'),
(19, 30, '12 IPA 1', 'Biologi', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:00:04', '2022-11-16 03:00:04'),
(20, 28, '12 IPA 2', 'Matematika Peminatan', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:00:50', '2022-11-16 03:00:50'),
(21, 40, '12 IPA 3', 'Pendidikan Agama', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:01:24', '2022-11-16 03:01:24'),
(22, 20, '12 IPS 1', 'Seni Budaya', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:02:18', '2022-11-16 03:02:18'),
(23, 41, '12 IPS 2', 'Geografi', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:02:55', '2022-11-16 03:02:55'),
(24, 40, '12 IPS 3', 'Pendidikan Agama', '08:15 am', '09:00 am', 'Senin', '2022-11-16 03:03:27', '2022-11-16 03:03:27'),
(26, 36, '10 IPA 1', 'Bahasa Indonesia', '11:30 am', '02:45 pm', 'Senin', '2022-11-16 03:08:14', '2022-11-16 03:08:14'),
(27, 39, '10 IPA 2', 'Bahasa Inggris', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:09:41', '2022-11-16 03:09:41'),
(28, 20, '10 IPA 3', 'Kimia', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:10:34', '2022-11-16 03:10:34'),
(30, 32, '10 IPS 1', 'PPKN', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:12:57', '2022-11-16 03:12:57'),
(31, 31, '10 IPS 2', 'PJOK', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:13:38', '2022-11-16 03:13:38'),
(33, 18, '10 IPS 3', 'Mulok', '10:45 am', '11:30 am', 'Senin', '2022-11-16 03:17:04', '2022-11-16 03:17:04'),
(34, 34, '11 IPA 1', 'Pendidikan Agama', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:17:51', '2022-11-16 03:17:51'),
(35, 0, '11 IPA 2', 'Bahasa Indonesia', '10:45 am', '11:30 am', 'Senin', '2022-11-16 03:18:43', '2022-11-16 03:18:43'),
(36, 0, '11 IPA 3', 'Seni Budaya', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:20:00', '2022-11-16 03:20:00'),
(37, 0, '11 IPS 1', 'PJOK', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:21:34', '2022-11-16 03:21:34'),
(38, 0, '11 IPS 2', 'Geografi', '10:45 am', '11:30 am', 'Senin', '2022-11-16 03:22:18', '2022-11-16 03:22:18'),
(39, 0, '11 IPS 3', 'Pendidikan Agama', '10:45 am', '12:15 pm', 'Senin', '2022-11-16 03:22:58', '2022-11-16 03:22:58'),
(40, 0, '11 IPS 3', 'Pendidikan Agama', '10:25 am', '12:30 pm', 'Senin', '2022-11-16 03:23:41', '2022-11-16 03:23:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id_profil` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `rombel_ipa10` char(20) NOT NULL,
  `rombel_ipa11` char(20) NOT NULL,
  `rombel_ipa12` char(20) NOT NULL,
  `rombel_ips10` char(20) NOT NULL,
  `rombel_ips11` char(20) NOT NULL,
  `rombel_ips12` char(20) NOT NULL,
  `fasilitas` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id_profil`, `judul`, `rombel_ipa10`, `rombel_ipa11`, `rombel_ipa12`, `rombel_ips10`, `rombel_ips11`, `rombel_ips12`, `fasilitas`, `isi`, `created_at`, `updated_at`) VALUES
(2, 'SMA Negeri 2 Kupang Timur', '3', '3', '3', '3', '4', '3', 'Lapangan Futsal, Laboratorium Kimia dan Komputer, WC Guru dan Siswa, Sanitasi Siswa, Perpustakaan, Wifi, Listrik', '<p>(50300259) SMA Negeri 2 Kupang Timur.</p>\r\n\r\n<p>SMAN 2 KUPANG TIMUR adalah salah satu satuan pendidikan dengan jenjang SMA di JL. Timor Raya KM. 33, Naibonat, Kec. Kupang Timur, Kab Kupang, Nusa Tenggara Timur, dengan kode pos 85362. Dalam Menjalankan kegiatannya, SMAN2 KUPANG TIMUR berada di bawah naungan Kementrian Pendidikan dan Kebudayaan</p>\r\n\r\n<p>Jam pembelajaran di SMAN 2 KUPANG TIMUR dilakukan pada Pagi. Dalam seminggu, pembelajaran dilakukan selama 6 hari.</p>\r\n\r\n<p>SMAN 2 KUPANG TIMUR memliki akreditasi A, berdasarkan sertifikat 68/BAP-S/MNTT/XI/2012</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2022-10-28 19:43:00', '2022-11-30 16:13:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `ortu` varchar(75) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `no_hp_ortu` char(12) NOT NULL,
  `no_hp_siswa` char(12) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `agama`, `kelas`, `ortu`, `pekerjaan`, `no_hp_ortu`, `no_hp_siswa`, `created_at`, `updated_at`) VALUES
(9, '0038217005', 'Adi Papa Stevanus Manafe', 'Lili, Camplong', '2003-11-29', 'Lili, Camplong', 'Kristen', '11 IPS 1', '', '', '', '', '2022-11-22 06:40:14', '2022-11-22 06:40:14'),
(10, '0061914642', 'Adolfo Matias Varela', 'Kupang', '2006-06-04', 'Jln Timor  Raya km 35', 'Katolik', '11 IPS 1', '', '', '', '', '2022-11-22 06:44:04', '2022-11-22 06:44:04'),
(11, '0028620289', 'Adriana De Araujo', 'Tuapukan', '2002-04-05', 'Naibonat', 'Katolik', '11 IPS 1', '', '', '', '', '2022-11-22 06:47:36', '2022-11-22 06:47:36'),
(12, '0057099622', 'Adriano Abel Lois Da Costa Tael', 'Naibonat', '2005-04-28', 'Jln Timor  Raya km 35', 'Katolik', '12 IPS 3', '', '', '', '', '2022-11-22 06:51:03', '2022-11-22 06:51:03'),
(13, '0045427045', 'Adriano S. A. Lopes', 'Naibonat', '2004-02-11', 'Tetelek', 'Katolik', '12 IPS 3', '', '', '', '', '2022-11-22 06:53:16', '2022-11-22 06:53:16'),
(14, '0079929307', 'Agil Priyadi Sakbana', 'Tetelek', '2007-08-31', 'Manusak', 'Kristen', '10 IPS 1', '', '', '', '', '2022-11-22 07:54:05', '2022-11-22 07:54:05'),
(15, '0058601645', 'Agnes Carvalho Fernandes Pinto', 'Naibonat', '2005-04-30', 'Jln Timor  Raya km 35', 'Katolik', '12 IPA 2', '', '', '', '', '2022-11-22 07:56:10', '2022-11-22 07:56:10'),
(16, '0048596994', 'Agnes Heldina Belo', 'Naibonat', '2004-01-28', 'Naibonat', 'Katolik', '12 IPA 2', '', '', '', '', '2022-11-22 07:57:59', '2022-11-22 07:57:59'),
(17, '0063455293', 'Agung Eprit Rusaldi Faot', 'Noelbaki', '2006-04-14', 'Jln Timor  Raya km 35', 'Kristen', '10 IPA 1', 'Imanuel Faot', 'Petani', '081237617768', '082245432321', '2022-11-25 10:29:45', '2022-11-25 10:29:45'),
(18, '0058859995', 'Alberto Gusmao Lobo', 'Naibonat', '2005-06-18', 'Manusak', 'Katolik', '11 IPA 2', 'Januario Parada Gusmao', 'Petani', '081238762903', '082246674289', '2022-11-28 19:30:24', '2022-11-28 19:30:24'),
(19, '0067581295', 'Aldero Samuel Beka', 'Naibonat', '2007-02-12', 'Jln Timor  Raya km 35', 'Kristen', '10 IPS 1', 'Amsal Soleman Beka', 'PNS', '081338987342', '085738876341', '2022-11-28 19:35:18', '2022-11-28 19:35:18'),
(20, '0073573449', 'Agostina Moraira Maria Fraga', 'Naibonat', '2007-08-06', 'Jln Timor  Raya km 35', 'Katolik', '11 IPA 1', 'Inocecio Dacosta', 'PNS', '081245618972', '081237413305', '2022-11-28 19:45:58', '2022-11-28 19:45:58'),
(21, '00697009188', 'Albertine Tresia Melani Tilman', 'Waingapu', '2006-05-13', 'Asrama Kodim', 'Katolik', '10 IPS 1', 'Manuel Tilman', 'PNS', '081236862793', '081236862793', '2022-11-28 19:52:39', '2022-11-28 19:52:39'),
(22, '0054821430', 'Alexander Nirwandi Tasilima', 'Naibonat', '2005-11-30', 'Jln Timor  Raya km 35', 'Kristen', '11 IPS 2', 'Daud Y. Tasilima', 'Petani', '081236066911', '081236066911', '2022-11-28 19:57:57', '2022-11-28 19:57:57'),
(23, '0022725103', 'Alexandre Riki Marques Cabral', 'Tuapukan', '2002-06-27', 'Manusak', 'Katolik', '12 IPA 2', 'Inasio M. Cabral', 'Petani', '082359049242', '082359049242', '2022-11-28 20:16:13', '2022-11-28 20:16:13'),
(24, '3039510524', 'Anastasia Lendi Gusmao', 'Naibonat', '2002-12-17', 'Jln Timor  Raya km 35', 'Katolik', '12 IPA 1', 'Marcelino Belo', 'Petani', '082147253672', '082147253672', '2022-11-28 20:20:38', '2022-11-28 20:20:38'),
(25, '0054774426', 'Ana Rosali Dasilva Gama', 'Naibonat', '2005-04-14', 'Raknamo', 'Katolik', '11 IPA 2', 'Thomas Dasilva', 'Petani', '081353193374', '081353019374', '2022-11-28 20:24:45', '2022-11-28 20:24:45'),
(26, '0059590123', 'Andini Susana Windesy', 'Irian Jaya', '2005-04-04', 'Jln Timor  Raya km 35', 'Kristen', '11 IPA 2', 'Edward Windesy', 'Petani', '081236066900', '081236066900', '2022-11-28 20:29:12', '2022-11-28 20:29:12'),
(27, '0057105378', 'Andreas Adonia Ruben Freitas', 'Naibonat', '2005-07-12', 'Jln Timor  Raya km 35', 'Katolik', '11 IPA 3', 'Joao E. N. Freaitas', 'Petani', '081235170319', '081235170319', '2022-11-28 20:33:04', '2022-11-28 20:33:04'),
(28, '0046966606', 'Angelina Ana Freitas', 'Naibonat', '2004-08-30', 'Jln Timor  Raya km 35', 'Katolik', '12 IPA 3', 'Janio Guterres Soares', 'Petani', '081338868568', '081338868568', '2022-11-28 20:36:32', '2022-11-28 20:36:32'),
(29, '0047247296', 'Angelina Delvia Gaio', 'Naibonat', '2004-12-10', 'Manusak', 'Katolik', '12 IPA 3', 'Alexandre Guterres', 'Petani', '081229347016', '081220347016', '2022-11-28 21:02:39', '2022-11-28 21:02:39'),
(31, '0047486992', 'Anjelita Pires Gomes', 'Tuapukan', '2004-05-09', 'Naunu', 'Katolik', '11 IPS 3', 'Justino Gomes', 'Petani', '081240384799', '081240384799', '2022-11-28 21:24:11', '2022-11-28 21:24:11'),
(32, '0069250051', 'Anna A De J S Ximenes', 'Kupang', '2006-10-02', 'Jln Timor  Raya km 35', 'Katolik', '10 IPA 1', 'Adriano De Jesus', 'Petani', '081236066820', '081236066820', '2022-11-28 21:27:26', '2022-11-28 21:27:26'),
(33, '0066629875', 'Antonio De Jesus P Sarmento', 'Denpasar', '2006-12-03', 'Jalan Pulau Riau No. 36', 'Katolik', '10 IPA 2', 'Armindo De Jesus Sarmento', 'PNS', '081339003282', '081339003282', '2022-11-28 21:31:37', '2022-11-28 21:31:37'),
(34, '0067369399', 'Zulino Dos Santos', 'Naibonat', '2006-07-27', 'Jln Timor  Raya km 35', 'Katolik', '12 IPS 3', 'Carlos Dos Santos', 'Petani', '085738568762', '', '2022-12-12 03:53:58', '2022-12-12 03:53:58'),
(35, '0045171332', 'Zakharias Aprianus Lopes', 'Naibonat', '2006-04-26', 'Naibonat', 'Katolik', '12 IPS 3', 'Agustino Lopes', 'Petani', '082256780934', '082256780934', '2022-12-12 03:57:50', '2022-12-12 12:28:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$rT/TkiuLGq7sOpO4aq6MfeaDCIZXMQoSri5Dgs.ZSUb0hwFjVbCiG', '2022-10-27 10:39:20', '2022-10-27 10:39:20'),
(5, 'Suzana Pinto', 'suzanapinto1901@gmail.com', '$2y$10$0i/DQkyp.r6NxLBXLxX2XOeDRhN1b/HOg6LEyIRe/A57HFKtvl.h.', '2022-11-28 21:39:56', '2022-11-28 21:39:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nama orang tua` (`id_siswa`,`nis`,`nama`,`tempat_lahir`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
