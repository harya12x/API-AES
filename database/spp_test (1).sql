-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 08:10 AM
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
('12121', 'Jane Doo', '$2y$10$/1U0T0dDIrxvacXMWGjZceHf95uQC2S2ftA07wEwm/Uc1erTYmZzO', 1),
('12122', 'Alex', '$2y$10$BfFmuKbzhTbxf6Kuzi3Yh.1rTTTvRJW7w5XQps8MI2C3MkNSTAAqK', 1),
('12123', 'Malas', '$2y$10$vC7SssMXOFs5UYq6fEfSzuDoVRR2oc88/J4Ysj6w5TAFNGMZZAwCO', 1),
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
(6, 'Biaya SPP SMP', 350000, 'SMP AR-RAHMAH', 0),
(9, 'Biaya SPP TK', 250000, 'TK AR-RAHMAH', 1),
(10, 'Tabungan TK', 25000, 'TK AR-RAHMAH', 1);

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
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `no_transaksi` int(11) DEFAULT NULL,
  `nominal` int(10) NOT NULL,
  `arus_kas` tinyint(1) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `no_transaksi`, `nominal`, `arus_kas`, `keterangan`, `status`) VALUES
(1, 1, 275000, 1, NULL, 1),
(2, NULL, 275000, 0, 'Pengeluaran untuk makan', 1),
(3, 16, 275000, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nipd` int(10) NOT NULL,
  `nama_siswa` varchar(40) NOT NULL,
  `kelas` varchar(6) DEFAULT NULL,
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
(3, 'Jane Do', 'TK A', '2023/2024', '$2y$10$fLKQTn7cWuv6EhGxpMdleeGJane..tpdPLWxieEYpVY4O4PTxwB2C', 0, 1),
(101010149, 'Jin Doe', 'TK A', '2023/2024', '$2y$10$WtSBthYxMUQlbEXImw8RZeZaLYdqkyDKlHlGzirPnXK.x95io843W', 0, 1),
(101010150, 'Jon Doe', 'TK A', '2023/2024', '$2y$10$DH7P5j6QNr9qImnxmljh.OqniPu84Hh92/Tu3ozhrA6JrQe5HlfEu', 0, 1),
(101010151, 'Jan Doe', 'TK B', '2023/2024', '$2y$10$i3BDQk6GjqbHbfA5SqTTcuGQC0TFvelm2BleNRXX/jdM2wsu6PxCm', 0, 1),
(101010152, 'Jun Doe', 'TK B', '2023/2024', '$2y$10$/4XchA5ARGd2SqfHJv5oruKW/19NCSHTsHweBSyWMDRKY69aFMs.i', 0, 1),
(101010153, 'Jen Doe', 'TK A', '2023/2024', '$2y$10$uLkddx.1qFpKbuILccCiKetn5x9mjTnUwWlIBVi57TFT6BRBodzqe', 0, 1),
(101010154, 'Johnny', 'TK A', '2023/2024', '$2y$10$umoqk.0M0EZ.H1Ijz5Su8OY3uCfB75zAdZzTVlq4b73I4kimfiNsW', 0, 1),
(101010155, 'Wahyu', 'TK B', '2023/2024', '$2y$10$THRt6oWwL.76kPdmkNLXUuk5oPPBg9fhcsdVrkfeh4tRJ1rlr4nR2', 0, 1),
(101010156, 'Leo', 'TK B', '2023/2024', '$2y$10$snk9yTwFA90aEz6WLZK1lOxV5GSED3YvS56Xtzh3TRK7HF1SOc/zC', 0, 1),
(101010157, 'Ali', 'TK A', '2023/2024', '$2y$10$JyTEA42nZJFE9X43zPGh5.PGTncnk4aHMXegoo0Zddcv1B8lkB4kW', 0, 1),
(101010158, 'Asep', 'TK A', '2023/2024', '$2y$10$YH3vq.uc7A3upQWDJi3azepGAuCiStJ0rBwhT7gEur10VWXUmE/Zm', 0, 1),
(101010159, 'Anip', 'TK B', '2023/2024', '$2y$10$7QYkSFxFOxyL0hnxs0Pv6.0YHKM/cEt2Fn4sqHzbGtdlAVa3kIRn6', 0, 1),
(101010160, 'Mimin', 'TK B', '2023/2024', '$2y$10$jDPJxQuACY8PuotDTfuv0uOrxla0nPzE6Q0CaASUPHcdQsoy35yF2', 0, 1),
(101010161, 'Lulu', 'TK A', '2023/2024', '$2y$10$5QO.lyll6c5QgX/EKWoZgu9f.r102GTUFdX9j5FD3tY2b3bgrxwjy', 0, 1),
(101010162, 'Lala', 'TK A', '2023/2024', '$2y$10$vJvF/xERW2ZS1ptusah3ruHTW/x2H/wUbmOcw5Gn2qRxm9sHZISRu', 0, 1),
(101010163, 'Lili', 'TK B', '2023/2024', '$2y$10$hOUiDiijXH/3gXLkvURWVOzkwJwgCe1a6rzgHYOw4h1YOP3hmEdSa', 0, 1),
(101010164, 'Roro', 'TK B', '2023/2024', '$2y$10$6OF9NZlOBlAXKYNQ8rOk7e6sHYVURK8D5eCtO2EWT2Zg8qlGNydWO', 0, 1);

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
('2023/2024', 1),
('2024/2025', 0),
('2025/2026', 0);

--
-- Triggers `tahun_akademik`
--
DELIMITER $$
CREATE TRIGGER `update_status` AFTER UPDATE ON `tahun_akademik` FOR EACH ROW UPDATE siswa SET siswa.thn_akademik = new.thn_akademik WHERE status in (SELECT status from tahun_akademik WHERE status = 1)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tahun_akademik` AFTER UPDATE ON `tahun_akademik` FOR EACH ROW UPDATE siswa 
SET siswa.thn_akademik = NEW.thn_akademik
WHERE siswa.thn_akademik = NEW.thn_akademik
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
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`no_transaksi`, `nipd`, `thn_akademik`, `nominal`, `status`, `image`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '2023/2024', 250000, 2, 'bukti.png', 'Biaya SPP TK', '2023-07-10 08:13:08', '2023-07-10 08:14:25'),
(3, 1, '2023/2024', 250000, 2, 'bukti.png', 'Biaya SPP TK', '2023-06-08 13:18:15', '2023-07-10 08:27:44'),
(4, 3, '2023/2024', 250000, 0, 'bukti.png', 'Biaya SPP TK', '2023-05-04 13:18:15', '2023-07-10 08:33:05'),
(5, 1, '2024/2025', 250000, 2, 'bukti.png', 'Biaya SPP TK', '2023-07-11 02:24:20', '2023-07-11 02:29:03'),
(6, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-08-04 21:32:20', NULL),
(7, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-09-06 21:33:17', NULL),
(8, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-10-06 21:33:17', NULL),
(9, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-11-03 21:36:04', NULL),
(10, 3, '2023/2024', 250000, 2, 'bukti.png', 'Biaya SPP TK', '2023-07-10 08:16:43', '2023-07-10 08:17:36'),
(11, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-12-04 21:41:08', NULL),
(12, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2024-01-08 21:42:07', NULL),
(13, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2024-02-08 21:42:07', NULL),
(14, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2024-03-07 21:43:22', NULL),
(15, 1, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2024-04-05 21:43:22', NULL),
(16, 3, '2023/2024', 275000, 1, 'bukti.png', 'Biaya SPP TK', '2023-08-04 11:24:55', NULL);

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `insert_pemasukan` AFTER INSERT ON `transactions` FOR EACH ROW INSERT INTO pengeluaran(no_transaksi, nominal, arus_kas, status) VALUES(new.no_transaksi, new.nominal, 1, 1)
$$
DELIMITER ;

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
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `no_transaksi` (`no_transaksi`);

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
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transactions` (`no_transaksi`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`nipd`) REFERENCES `siswa` (`nipd`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
