-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.2.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table toko.akad
CREATE TABLE IF NOT EXISTS `akad` (
  `user_id` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_dp` enum('LUNAS','BELUM LUNAS') NOT NULL DEFAULT 'BELUM LUNAS',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `fk_akad_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.akad: ~0 rows (approximately)

-- Dumping structure for table toko.rekening
CREATE TABLE IF NOT EXISTS `rekening` (
  `user_id` int(11) NOT NULL,
  `nama_bank` enum('BJB','BTN','BTN SYARIAH','BJB SYARIAH','MANDIRI') NOT NULL,
  `branch_manager` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_rekening_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.rekening: ~2 rows (approximately)
INSERT INTO `rekening` (`user_id`, `nama_bank`, `branch_manager`) VALUES
	(39, 'BJB', 'v'),
	(40, 'BTN SYARIAH', 'a');

-- Dumping structure for table toko.saldo
CREATE TABLE IF NOT EXISTS `saldo` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` bigint(20) NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `fk_saldo_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table toko.saldo: ~0 rows (approximately)

-- Dumping structure for table toko.transaksi_akad
CREATE TABLE IF NOT EXISTS `transaksi_akad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nasabah_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `status` enum('LUNAS','BELUM LUNAS') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tr_nasabah` (`nasabah_id`),
  CONSTRAINT `fk_tr_nasabah` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.transaksi_akad: ~1 rows (approximately)
INSERT INTO `transaksi_akad` (`id`, `nasabah_id`, `tanggal`, `jenis`, `keterangan`, `nominal`, `status`) VALUES
	(17, 1, '2023-12-13', 'Pemasukan', '5555', 555550000, 'BELUM LUNAS');

-- Dumping structure for table toko.transaksi_pt
CREATE TABLE IF NOT EXISTS `transaksi_pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tr_pt` (`pt_id`),
  CONSTRAINT `fk_tr_pt` FOREIGN KEY (`pt_id`) REFERENCES `pt` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.transaksi_pt: ~2 rows (approximately)
INSERT INTO `transaksi_pt` (`id`, `pt_id`, `tanggal`, `jenis`, `keterangan`, `nominal`) VALUES
	(2, 12, '2023-12-06', 'Pengeluaran', '4', 4444000),
	(3, 12, '2024-02-12', 'Pemasukan', 'Hadiah', 10000000);

-- Dumping structure for table toko.transaksi_umum
CREATE TABLE IF NOT EXISTS `transaksi_umum` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_jenis` enum('Pengeluaran','Pemasukan') NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_nominal` bigint(20) NOT NULL DEFAULT 0,
  `transaksi_keterangan` text NOT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table toko.transaksi_umum: ~7 rows (approximately)
INSERT INTO `transaksi_umum` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`) VALUES
	(3, '2022-06-21', 'Pemasukan', 1, 500000, 'Bu inem beli kerupuk 1 kg'),
	(4, '2022-06-21', 'Pengeluaran', 6, 5000000, 'Beli perlengkapan kebutuhan toko'),
	(5, '2022-06-21', 'Pengeluaran', 5, 200000, 'Mang aji kirim pesanan ke bu inem'),
	(6, '2022-06-21', 'Pengeluaran', 4, 200000, 'beli super 1 slop'),
	(7, '2023-08-07', 'Pengeluaran', 6, 80000, 'Meja plastik'),
	(8, '2023-07-31', 'Pemasukan', 10, 6, '667'),
	(9, '2024-01-21', 'Pemasukan', 4, 5000000, 'Hehe');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
