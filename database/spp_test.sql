-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kode_petugas` varchar(10) NOT NULL,
  `nama_petugas` varchar(28) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_petugas`, `nama_petugas`, `password`, `status`) VALUES
('12122', 'Alex', '$2y$10$BfFmuKbzhTbxf6Kuzi3Yh.1rTTTvRJW7w5XQps8MI2C3MkNSTAAqK', 1),
('12123', 'Malas', '$2y$10$vC7SssMXOFs5UYq6fEfSzuDoVRR2oc88/J4Ysj6w5TAFNGMZZAwCO', 1),
('12130', 'Jane Don', '$2y$10$/1U0T0dDIrxvacXMWGjZceHf95uQC2S2ftA07wEwm/Uc1erTYmZzO', 1),
('6873278425', 'nlknlnl', '$2y$10$1mum/RiWanF8h/SO.XH2nupRN5yec/Pm1bMZzuz9Rr5dnUvV7LzEG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `jenis_instansi` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`jenis_instansi`, `status`) VALUES
('PONPES AR-RAHMAH', 1),
('SD AR-RAHMAH', 1),
('SMP AR-RAHMAH', 1),
('TK AR-RAHMAH', 1);

--
-- Triggers `instansi`
--
DELIMITER $$
CREATE TRIGGER `nonactivated_biaya` AFTER UPDATE ON `instansi` FOR EACH ROW IF (NEW.status = 0) 
THEN
    UPDATE jenis_pembayaran SET 
    jenis_pembayaran.status = NEW.status
    WHERE jenis_pembayaran.instansi = NEW.jenis_instansi;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nonactivated_instansi` AFTER UPDATE ON `instansi` FOR EACH ROW IF (NEW.status = 0) THEN
    UPDATE kelas SET kelas.status = NEW.status
    WHERE kelas.instansi = NEW.jenis_instansi;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_instansi` AFTER UPDATE ON `instansi` FOR EACH ROW UPDATE kelas
set kelas.instansi = NEW.jenis_instansi 
WHERE
kelas.instansi = NEW.jenis_instansi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `biaya` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `jenis_pembayaran`, `biaya`, `instansi`, `status`) VALUES
(6, 'Biaya SPP SMP', 350000, 'SMP AR-RAHMAH', 1),
(9, 'Biaya SPP TK', 250000, 'TK AR-RAHMAH', 1),
(10, 'Tabungan TK', 25000, 'TK AR-RAHMAH', 1),
(11, 'Biaya SPP SMP', 300000, 'SMP AR-RAHMAH', 1),
(12, 'Biaya SPP SD', 350000, 'SD AR-RAHMAH', 1),
(13, 'Tabungan SD', 27000, 'SD AR-RAHMAH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas` varchar(6) NOT NULL,
  `instansi` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas`, `instansi`, `status`) VALUES
('1', 'SD AR-RAHMAH', 1),
('2', 'SD AR-RAHMAH', 1),
('3', 'SD AR-RAHMAH', 1),
('4', 'SD AR-RAHMAH', 1),
('5', 'SD AR-RAHMAH', 1),
('6', 'SD AR-RAHMAH', 1),
('7A', 'SMP AR-RAHMAH', 1),
('7C', 'PONPES AR-RAHMAH', 1),
('TK A', 'TK AR-RAHMAH', 1),
('TK B', 'TK AR-RAHMAH', 1);

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `nonactivated_kelas` AFTER UPDATE ON `kelas` FOR EACH ROW IF (NEW.status = 0) THEN
    UPDATE siswa set siswa.status = new.status
    WHERE siswa.kelas = new.kelas;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_kelas` AFTER UPDATE ON `kelas` FOR EACH ROW UPDATE siswa
  SET kelas = NEW.kelas
  WHERE siswa.kelas = NEW.kelas
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nipd` int(10) NOT NULL,
  `nama_siswa` varchar(40) NOT NULL,
  `kelas` varchar(6) NOT NULL,
  `thn_akademik` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `potongan` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nipd`, `nama_siswa`, `kelas`, `thn_akademik`, `password`, `potongan`, `status`) VALUES
(1, 'Jane Doe', 'TK A', '2023/2024', '$2y$10$1.iQrTz1upogyod65VF0p.FIzAofKKG4FiPODlfpdJ.bkHHpw.uHu', 100000, 1),
(3, 'Samuel Jane Do Walker Smith Jr', 'TK A', '2023/2024', '$2y$10$fLKQTn7cWuv6EhGxpMdleeGJane..tpdPLWxieEYpVY4O4PTxwB2C', 0, 1),
(4, 'Alex', 'TK B', '2023/2024', '$2y$10$K3vlS.yCP.y4d24uEPUXN.k7ijEPEMorBs7Oss0.GAJ96qRbEYtdG', 0, 1),
(5, 'Mimi', 'TK A', '2023/2024', '$2y$10$QCMmL7JQoxjteaUMmYhfhu5gyticelOHQa7WjtzfeqaReJKcszye6', 0, 1),
(6, 'Jun Doe', 'TK A', '2023/2024', '$2y$10$iyMZjuTi4yBjvE4GIjMybuJ2fyG99.flI6r7zi//nLbcWmP7CEMga', 0, 1),
(7, 'Momo', 'TK A', '2023/2024', '$2y$10$.5.PbikPQtwrURRQzTatv.zainTS.jCW0dMrau4SxEm0n66s.am2K', 0, 1),
(8, 'Mimi', 'TK B', '2023/2024', '$2y$10$HpCIRAcfMo1ri7t.3RJKbe4wWuRNqLuPHkicA4Hx.jA.H8TMx4HcS', 0, 1),
(9, 'Roro', 'TK B', '2023/2024', '$2y$10$6a8v7uNItY8/c4r/BwZr8.eH.CRR//5QgzPjx7aAsHuvjzuAJu6Nu', 0, 1),
(10, 'Imas', 'TK B', '2023/2024', '$2y$10$WkFHtctBTa6SUDbhx0SsleaPRMzaPA76qjD6LhaOomgg1TGvh7P8i', 0, 1),
(1010101, 'Jin Doe', 'TK A', '2023/2024', '$2y$10$eSHisQ0XOnGqSzEiBP1HHu7OrzkDIxcqobw7kFh9pdmpuv27V7Sbe', 0, 1),
(1010102, 'Jon Doe', 'TK A', '2023/2024', '$2y$10$Ur1in9edobjA2LP2lPHjW.IAmZ3njix3.gprClLvoYVKUfxBmJwse', 0, 1),
(1010103, 'Jan Doe', 'TK B', '2023/2024', '$2y$10$QgPGFkJnP5GCPSwCgIRxfuujWFffsLAviTWnF3RAwkQ.Kpqij8f3y', 0, 1),
(1010104, 'Jun Doe', 'TK B', '2023/2024', '$2y$10$yYjQeMqufyyOG2fLrjiXHujpFacHr.l/w4ZP1BNGgH0NevBcodE1q', 0, 1),
(1010105, 'Jun Doe', 'TK B', '2023/2024', '$2y$10$cCheoUH5pwHmztIVM77v..kEDGQbybMts4hwMY2R7FK96.OgNZcci', 1, 1),
(1010108, 'Wahyu', 'TK A', '2023/2024', '$2y$10$i510Tb5Y7YE5jlesbYBfye5l62.emv6OmZ8cnStqZM56rpSwGNhC.', 0, 1),
(1010109, 'Jin Doe', 'TK A', '2023/2024', '$2y$10$B4uySeeePm2Vm/ihNRbaT.EJJKkpJ/YGKRViK2V6lJKDp0qYy5BEa', 0, 1),
(1010110, 'Jon Doe', 'TK B', '2023/2024', '$2y$10$Prs9T6OIfuR4bhbnTb4Ts.hkR8YD14p6.ftR97rUh.k9Sdz8/zxDm', 0, 1),
(1010111, 'Jan Doe', 'TK B', '2023/2024', '$2y$10$OAuFictmvFJZZOM08Wn/5eEsqtzcsNKu4adtsdJcz.P4LKeY8CBYK', 0, 1),
(1010112, 'Jun Doe', 'TK A', '2023/2024', '$2y$10$CZNspeDAiyMIXNtsNzZJ4.p5I9hguEiObFCp9UyCS6lCmv5Zm2NE6', 0, 1),
(1010113, 'Jin Doe', 'TK A', '2023/2024', '$2y$10$G5zzhuEFGM0lEMe5/obxZu8vbhqpKgJ16EoW8EVIKSqUhwlqzPTeK', 0, 1),
(1010114, 'Jon Doe', 'TK B', '2023/2024', '$2y$10$c5aA9K7sPfMvUGyUBk.MVeXXGhIWCP2HmUFCPPtNqzXy9AfMAhdbu', 0, 1),
(1010115, 'Jan Doe', 'TK B', '2023/2024', '$2y$10$3EMEx0OBy2KkNmgZMiOZO.6MVlHO2/Hv8UyeXalQIMMaFuJ.joSLi', 0, 1),
(1010116, 'Jun Doe', 'TK A', '2023/2024', '$2y$10$qv9Yn.3I4R9zFP6ZOi0m9eBDlkROAzVhhUwWBtZ3z4iuPhvY.veYK', 0, 1),
(1010117, 'Lylo', 'TK B', '2023/2024', '$2y$10$J0LqbIDiFq3aK.COg8gZ7esHG6gkoLaLqYdnAGloTFpZKU6.7Kgo2', 50000, 1),
(101010119, 'Hasan', 'TK A', '2023/2024', '$2y$10$LHMxmyMNiTKP/hOze0hLou19aPgXh6YIet5F1Xw1qxL0R2no8ipim', 0, 1),
(101010120, 'Ali', 'TK A', '2023/2024', '$2y$10$Kwn.VAhbqbSzJO9TnNU36.Jl/QrdvltvgdGdS3x5am051soF/PZGq', 0, 1),
(101010121, 'Dewi', 'TK B', '2023/2024', '$2y$10$cNR2zd67d.x3SRP6j/cYpuvZVwbh3gf7uz42zk5MLBC4tyFtc3KHK', 0, 1),
(101010122, 'Ahmad', 'TK B', '2023/2024', '$2y$10$kdzeEEMgPWxg/9w5GLvpYexFdiaEP6ED1VSDsMUmMvvaoaCyorM5q', 0, 1),
(101010123, 'Sulaiman', '1', '2023/2024', '$2y$10$aLn/00WaqBvN36vYwVtlCeVayUNvI3g3PNGZImP5x.uaFAhc.o8cS', 0, 1),
(101010124, 'Abdul', '1', '2023/2024', '$2y$10$cCR4YAqiHhCBdAoywrsOYOJlIMBr3YdWuwWKTvuoXIxM6stlfPy06', 0, 1),
(101010125, 'Adhitya', '2', '2023/2024', '$2y$10$c09KOKUk1ROjvYfSNvp3he.N7udVLm2UyWDoURct8OiZgDdnfabUe', 0, 1),
(101010126, 'Amir', '2', '2023/2024', '$2y$10$0vxlGSh3ru3nshwG7dEzpejnZqAE1hj6ATrwXRWf63RUldX0YUsUi', 0, 1),
(101010127, 'Ahmad', '3', '2023/2024', '$2y$10$vswbhw2m8X3yoMCZ3D0KhO4gBWqlSEys1ZGqaj/5dR0F6RSDmrlf6', 0, 1),
(101010128, 'Raja', '3', '2023/2024', '$2y$10$qSiv21SDQPjZZAApDF0bfOHZiFny.7Z4EQBDYTh5ejj59AS2lCgRW', 0, 1),
(101010129, 'Firman', '4', '2023/2024', '$2y$10$ZmSvsQhBRaDtzRfHsJUBF.Pzzs0bBxjAG3yXWKPgaKKJFV5abBIWi', 0, 1),
(101010130, 'Taslim', '4', '2023/2024', '$2y$10$XLqXBABgcEeofG49Z.QUUeeNpaS/h5g2cSHJq0CL5tux8DjxWP.YW', 0, 1),
(101010131, 'Kipli', '5', '2023/2024', '$2y$10$xyzBW/gsxfo3Hp0OMNeoIOi006bcrMNCwvPWxrF3098YwTdNPcnbu', 0, 1),
(101010132, 'Fikri', '5', '2023/2024', '$2y$10$omlMkIfbkebFjffGYlhGROUuqUa0G40m/tUikQ5aiupWBCTGydT7K', 0, 1),
(101010133, 'Pian', '6', '2023/2024', '$2y$10$81D0YwzY/80rnGtb3bWM6OoDYbTcf6msjmzhhf4jK1Ha.pqayVHdC', 0, 1),
(101010134, 'Ayu', '6', '2023/2024', '$2y$10$URHqQQMV/Dvn467qOhQRY.JXRiDb2xPTSAvTNy9wDMMmVf5efBLVO', 0, 1),
(101010135, 'Purnama Ismail Wibawa', 'TK A', '2023/2024', '$2y$10$LRzFuXwjOs0H8T3tJrcup.vLOflvpJt8XvATy9ttHkgay9byzMioe', 0, 1),
(101010136, 'Adi Yohanes Wibawa', 'TK A', '2023/2024', '$2y$10$P0H8.MWRyoyRr9HlUyhv8unmkCMroZVxkeLnauwETSahsZTbMX4Wi', 0, 1),
(101010137, 'Batari Sulaiman Wibawa', 'TK B', '2023/2024', '$2y$10$hmsu1kEysrKwMLcWvV5sWeeb1Lf4N9BCosGpA/Lzrj4StbQSrtVjS', 0, 1),
(101010138, 'Burhanuddin Tri Wibawa', 'TK B', '2023/2024', '$2y$10$btokIw.OxIy3NpDPTgjao.7ZUMNrdT/X.SHKoz5QusWHlYF.733Qa', 0, 1),
(101010139, 'Arif Susila Wibawa', '1', '2023/2024', '$2y$10$II3B85hfD8gvLAaIhEKCluzZFcV2Vj/4eRnvN4FKNTV6PhdkJCbGO', 150000, 1),
(101010140, 'Akhmad Taufik Wibowo', '1', '2023/2024', '$2y$10$kLnmMj2rsCsd0/YQagc0nOPlAFxTVW/OwO0PVymz7QGBZ65bZl9Ce', 0, 1),
(101010141, 'Darma Budi Wibawa', '2', '2023/2024', '$2y$10$kHcx6E/ioh44eAQvhvvy0eV9NrmisFrfWd8m3DzK2GF6/HtxPTr2O', 0, 1),
(101010142, 'Bambang Yusuf Wibowo', '2', '2023/2024', '$2y$10$1Ct.xFiWflXJl0fz5HcOIOczUCk3VbjuNaYWRIIApZZzay36Ym072', 0, 1),
(101010143, 'Siti Usman Wibawa', '3', '2023/2024', '$2y$10$Z9g28QDnubEt6Z4SsPvzx.mxQIVqQjKngSJZGXMhSRSecJQBM8fhK', 0, 1),
(101010144, 'Mansur Widya Wibowo', '3', '2023/2024', '$2y$10$TaVaTAGPGvd4F480sxITGOML2BRmpbxxO30eEc0TAhhjMZjKIobRG', 0, 1),
(101010145, 'Akhmad Jusuf Wibowo', '4', '2023/2024', '$2y$10$GO9SfnLYYpquWc37ast42usb26M3sNQYoTicaUlyfcKbUbCjJsHDG', 0, 1),
(101010146, 'Intan Idris Wibowo', '4', '2023/2024', '$2y$10$GvnIwVii.9FcZRFl4a03e.xuuG8P5IEuaD0L4/3Otsao6y4MD/zUK', 0, 1),
(101010147, 'Surya Arif Wibowo', '5', '2023/2024', '$2y$10$ff47Xsb8yG.elowuQW3ZmuQrjyWBX21umet4NYuvRM/m37nPxvE0a', 0, 1),
(101010148, 'Mansur Aditya Wibowo', '5', '2023/2024', '$2y$10$fun432r1pQyIKwEMN.UnK.qbeQERHZLCjp6gmctM9FUT2Jd/S/wNy', 0, 1),
(101010149, 'Wangi Hidayat Wibowo', '6', '2023/2024', '$2y$10$Uon1FlSxm2KWvdDBlhsntOgzSFekGbxC2yKys0DiRb3MnYikqt15G', 0, 1),
(101010150, 'Faisal Imran Wibowo', '6', '2023/2024', '$2y$10$mqSMzB0Ua43tFZqfCAmpHupqfw0fogSIRoz1BJpLHbSfSGShc7.Fa', 0, 1),
(101010151, 'Mo Do', '7C', '2023/2024', '$2y$10$2uO0bqrcPuIBmswfpxNsW.Pzfpuu8vOA3/uiuT/3f2wn/isN2nYVa', 0, 1);

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `update_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW UPDATE transactions SET
	transactions.nipd = NEW.nipd
   	WHERE transactions.nipd = NEW.nipd
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `thn_akademik` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`thn_akademik`, `status`) VALUES
('2020/2021', 0),
('2021/2022', 0),
('2023/2024', 1),
('2024/2025', 0),
('2025/2026', 0),
('2026/2027', 0);

--
-- Triggers `tahun_akademik`
--
DELIMITER $$
CREATE TRIGGER `update_status` AFTER UPDATE ON `tahun_akademik` FOR EACH ROW UPDATE siswa SET siswa.thn_akademik = new.thn_akademik WHERE status in (SELECT status from tahun_akademik WHERE status = 1)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `no_transaksi` int(11) NOT NULL,
  `nipd` int(10) NOT NULL,
  `thn_akademik` varchar(11) NOT NULL,
  `nominal` int(7) NOT NULL,
  `bulan` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`no_transaksi`, `nipd`, `thn_akademik`, `nominal`, `bulan`, `status`, `image`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1010102, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 16:14:47', NULL),
(2, 1010102, '2023/2024', 25000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 16:14:47', NULL),
(3, 3, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP untuk satu tahun full', '2023-07-29 16:28:07', NULL),
(4, 3, '2023/2024', 25000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP untuk bulan Agustus (cicil)', '2023-07-29 16:28:07', NULL),
(5, 3, '2023/2024', 250000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 16:28:07', '2023-07-29 16:28:23'),
(6, 3, '2023/2024', 50000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 16:28:07', '2023-07-29 16:28:23'),
(7, 4, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:27:55', NULL),
(8, 4, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:27:55', NULL),
(9, 4, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:41:26', NULL),
(10, 4, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(11, 4, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(12, 4, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(13, 4, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(14, 4, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(15, 4, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(16, 4, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(17, 4, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 17:42:10', NULL),
(18, 4, '2023/2024', 100000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:00:33', NULL),
(19, 4, '2023/2024', 175000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:00:33', '2023-07-29 18:01:49'),
(20, 3, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(21, 3, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(22, 3, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(23, 3, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(24, 3, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(25, 3, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(26, 3, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(27, 3, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(28, 3, '2023/2024', 275000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:10:14', NULL),
(29, 1010102, '2023/2024', 225000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-29 18:24:22', NULL),
(30, 3, '2023/2024', 225000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:05:40', NULL),
(31, 5, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(32, 5, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(33, 5, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(34, 5, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(35, 5, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(36, 5, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(37, 5, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(38, 5, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(39, 5, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(40, 5, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(41, 5, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(42, 5, '2023/2024', 275000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:06:16', NULL),
(43, 6, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:34:00', NULL),
(44, 6, '2023/2024', 25000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:34:00', NULL),
(45, 6, '2023/2024', 250000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:36:47', NULL),
(46, 6, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:41:39', NULL),
(47, 6, '2023/2024', 25000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:41:39', NULL),
(48, 7, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(49, 7, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(50, 7, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(51, 7, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(52, 7, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(53, 7, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(54, 7, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(55, 7, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(56, 7, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(57, 7, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(58, 7, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:47:49', NULL),
(59, 1010108, '2023/2024', 275000, '2025-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 04:55:11', NULL),
(60, 1010109, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(61, 1010109, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(62, 1010109, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(63, 1010109, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(64, 1010109, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(65, 1010109, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(66, 1010109, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(67, 1010109, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(68, 1010109, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(69, 1010109, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(70, 1010109, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(71, 1010109, '2023/2024', 275000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:42:30', NULL),
(115, 1010101, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(116, 1010101, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(117, 1010101, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(118, 1010101, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(119, 1010101, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(120, 1010101, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(121, 1010101, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(122, 1010101, '2023/2024', 275000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(123, 1010101, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(124, 1010101, '2023/2024', 275000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(125, 1010101, '2023/2024', 275000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(126, 1010101, '2023/2024', 275000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 05:56:40', NULL),
(127, 1010112, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 06:20:37', NULL),
(128, 1010112, '2023/2024', 25000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-07-30 06:20:37', NULL),
(133, 1, '2023/2024', 175000, '2023-07-01', 2, 'Bayar langsung', 'Bayar SPP', '2023-07-31 14:04:58', NULL),
(134, 6, '2023/2024', 150000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-01 08:48:47', NULL),
(135, 6, '2023/2024', 100000, '2023-10-01', 2, '', 'Bayar SPP', '2023-08-01 10:09:45', NULL),
(136, 6, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-01 10:10:40', NULL),
(137, 1, '2023/2024', 175000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-04 05:03:26', NULL),
(138, 101010119, '2023/2024', 275000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(139, 101010119, '2023/2024', 275000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(140, 101010119, '2023/2024', 275000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(141, 101010119, '2023/2024', 275000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(142, 101010119, '2023/2024', 275000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(143, 101010119, '2023/2024', 275000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:40:21', NULL),
(144, 101010119, '2023/2024', 275000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 05:41:45', NULL),
(163, 101010139, '2023/2024', 227000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(164, 101010139, '2023/2024', 227000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(165, 101010139, '2023/2024', 227000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(166, 101010139, '2023/2024', 227000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(167, 101010139, '2023/2024', 227000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(168, 101010139, '2023/2024', 227000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(169, 101010139, '2023/2024', 227000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP 7 bulan', '2023-08-05 06:21:13', NULL),
(170, 101010139, '2023/2024', 227000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP 5 bulan', '2023-08-05 06:21:39', NULL),
(171, 101010139, '2023/2024', 227000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP 5 bulan', '2023-08-05 06:21:39', NULL),
(172, 101010139, '2023/2024', 227000, '2024-04-01', 2, 'Bayar Langsung', 'Bayar SPP 5 bulan', '2023-08-05 06:21:39', NULL),
(173, 101010139, '2023/2024', 227000, '2024-05-01', 2, 'Bayar Langsung', 'Bayar SPP 5 bulan', '2023-08-05 06:21:39', NULL),
(174, 101010139, '2023/2024', 227000, '2024-06-01', 2, 'Bayar Langsung', 'Bayar SPP 5 bulan', '2023-08-05 06:21:39', NULL),
(175, 101010145, '2023/2024', 377000, '2023-07-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:23:23', NULL),
(176, 101010145, '2023/2024', 377000, '2023-08-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:23:23', NULL),
(177, 101010145, '2023/2024', 377000, '2023-09-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:23:23', NULL),
(178, 101010145, '2023/2024', 377000, '2023-10-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:23:23', NULL),
(179, 101010145, '2023/2024', 308000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:23:23', NULL),
(180, 101010145, '2023/2024', 69000, '2023-11-01', 2, 'Bayar Langsung', 'Bayar SPP 8 bulan', '2023-08-05 06:24:49', NULL),
(181, 101010145, '2023/2024', 377000, '2023-12-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:27:14', NULL),
(182, 101010145, '2023/2024', 177000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:27:36', NULL),
(183, 101010145, '2023/2024', 200000, '2024-01-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:27:54', NULL),
(184, 101010145, '2023/2024', 100000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:29:31', NULL),
(185, 101010145, '2023/2024', 277000, '2024-02-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:29:50', NULL),
(186, 101010145, '2023/2024', 275000, '2024-03-01', 2, 'Bayar Langsung', 'Bayar SPP', '2023-08-05 06:37:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_petugas`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`jenis_instansi`) USING BTREE;

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`),
  ADD KEY `instansi` (`instansi`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas`) USING BTREE,
  ADD KEY `instansi` (`instansi`) USING BTREE;

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nipd`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `tahun_akademik` (`thn_akademik`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`thn_akademik`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nipd` (`nipd`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD CONSTRAINT `jenis_pembayaran_ibfk_1` FOREIGN KEY (`instansi`) REFERENCES `instansi` (`jenis_instansi`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`instansi`) REFERENCES `instansi` (`jenis_instansi`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`thn_akademik`) REFERENCES `tahun_akademik` (`thn_akademik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`nipd`) REFERENCES `siswa` (`nipd`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
