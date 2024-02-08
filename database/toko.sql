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

-- Dumping structure for table toko.hutang_piutang
CREATE TABLE IF NOT EXISTS `hutang_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nominal` bigint(20) unsigned NOT NULL DEFAULT 0,
  `keterangan` text NOT NULL,
  `tipe` enum('KREDIT','DEBIT') NOT NULL,
  `status` enum('LUNAS','BELUM LUNAS') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.hutang_piutang: ~2 rows (approximately)
INSERT INTO `hutang_piutang` (`id`, `tanggal`, `nominal`, `keterangan`, `tipe`, `status`) VALUES
	(1, '2023-12-26', 800000, 'Rizik Siab', 'KREDIT', 'LUNAS'),
	(6, '2023-12-19', 850000, 'Adit', 'DEBIT', 'LUNAS'),
	(7, '2023-12-02', 50000, 'Hansip', 'KREDIT', 'BELUM LUNAS');

-- Dumping structure for table toko.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL,
  `kategori_status` enum('EDITABLE','UNEDITABLE') NOT NULL DEFAULT 'EDITABLE',
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table toko.kategori: ~8 rows (approximately)
INSERT INTO `kategori` (`kategori_id`, `kategori`, `kategori_status`) VALUES
	(2, 'PACKING', 'EDITABLE'),
	(4, 'PEMBELIAN PRODUK ', 'EDITABLE'),
	(5, 'KURIR', 'EDITABLE'),
	(6, 'BARANG INVENTORY TOKO', 'EDITABLE'),
	(7, 'KEAMANAN', 'EDITABLE'),
	(8, 'UANG KEBERSIHAN', 'EDITABLE'),
	(9, 'GAJI KARYAWAN', 'EDITABLE'),
	(10, 'belanja bensin', 'EDITABLE');

-- Dumping structure for table toko.nasabah
CREATE TABLE IF NOT EXISTS `nasabah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `perumahan_id` int(11) NOT NULL,
  `kavling` varchar(50) NOT NULL,
  `tanggal_pendataan` date NOT NULL DEFAULT current_timestamp(),
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_pasangan` varchar(255) DEFAULT NULL,
  `tempat_lahir_pasangan` varchar(255) DEFAULT NULL,
  `tanggal_lahir_pasangan` varchar(50) DEFAULT NULL,
  `pekerjaan_pasangan` varchar(255) DEFAULT NULL,
  `nik_pasangan` varchar(255) DEFAULT NULL,
  `alamat_pasangan` varchar(255) DEFAULT NULL,
  `no_hp_pasangan` varchar(255) DEFAULT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `alamat_instansi` varchar(255) NOT NULL,
  `no_hp_instansi` varchar(255) DEFAULT NULL,
  `gaji` bigint(20) NOT NULL DEFAULT 0,
  `gaji_terbilang` varchar(255) NOT NULL,
  `no_npwp` varchar(255) NOT NULL,
  `marketing` varchar(255) NOT NULL,
  `harga_jual_rumah` bigint(20) NOT NULL,
  `uang_muka` bigint(20) NOT NULL,
  `plafon_kredit` bigint(20) NOT NULL,
  `saldo` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `fk_nasabah_pt` (`pt_id`),
  KEY `fk_nasabah_perumahan` (`perumahan_id`),
  CONSTRAINT `fk_nasabah_perumahan` FOREIGN KEY (`perumahan_id`) REFERENCES `perumahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nasabah_pt` FOREIGN KEY (`pt_id`) REFERENCES `pt` (`id`),
  CONSTRAINT `fk_nasahab_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.nasabah: ~2 rows (approximately)
INSERT INTO `nasabah` (`id`, `user_id`, `pt_id`, `perumahan_id`, `kavling`, `tanggal_pendataan`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `jabatan`, `nik`, `alamat`, `no_hp`, `email`, `nama_pasangan`, `tempat_lahir_pasangan`, `tanggal_lahir_pasangan`, `pekerjaan_pasangan`, `nik_pasangan`, `alamat_pasangan`, `no_hp_pasangan`, `nama_instansi`, `alamat_instansi`, `no_hp_instansi`, `gaji`, `gaji_terbilang`, `no_npwp`, `marketing`, `harga_jual_rumah`, `uang_muka`, `plafon_kredit`, `saldo`) VALUES
	(1, 39, 12, 1, 'v', '2024-02-04', 'v', '2024-02-04', 'v', 'v', 'Mypix0GF5uODepQdrzjuN2qJFx6N7SM3iKmxcmlGrq0mLqckuQHPi83PYgLAL8MeZk7EKfgIB/ngMr1LIU4O5A==', 'v', 'vv', 'v@a.com', 'v', 'v', '2024/02/01', 'v', '65n68KuQbX7B7a2eVgouwfjklQx454zNe/iHriCtHBVW013Rpy7kr7g3pSRj7Se+Nf5VdKB9lhtlQu7A0iEOIw==', 'v', 'v', 'v', 'v', 'v', 32323123123, 'v', 'v', '1111', 111, 11, 100, -9008190),
	(2, 40, 12, 1, 'a', '2024-02-04', 'a', '2024-02-04', 'a', 'a', '+9Z5gQeBWRa/4bzKxAzI5I6qHbC5rE+kiZRzYwWhNGJWMGLczkeJsNeSa/qjCDV+dUZ293vLno/eQ27TylZLqQ==', 'a', 'a', 'a@a.com', 'a', 'a', '2024/02/04', 'a', 'pz+xw/qai0ec2Pk1rmbgMTJMlQwkxnW8y3DgDmlomypnShv65H4mnTBGPdeQpJaM0dMnkKBXTekn9b/BIo0ixA==', 'a', 'a', 'a', 'a', 'a', 3232323, 'a', 'a', '123', 2313, 11, 2302, 0);

-- Dumping structure for table toko.perumahan
CREATE TABLE IF NOT EXISTS `perumahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` int(11) NOT NULL,
  `nama_perumahan` varchar(255) NOT NULL,
  `alamat_perumahan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pt_id` (`pt_id`),
  CONSTRAINT `fk_perumahan_pt` FOREIGN KEY (`pt_id`) REFERENCES `pt` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.perumahan: ~1 rows (approximately)
INSERT INTO `perumahan` (`id`, `pt_id`, `nama_perumahan`, `alamat_perumahan`) VALUES
	(1, 12, 'Perumakan Kertasari', 'Jalan');

-- Dumping structure for table toko.pt
CREATE TABLE IF NOT EXISTS `pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pt` varchar(255) NOT NULL,
  `alamat_pt` varchar(255) NOT NULL,
  `dirut_pt` varchar(255) NOT NULL DEFAULT '0',
  `saldo` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.pt: ~0 rows (approximately)
INSERT INTO `pt` (`id`, `nama_pt`, `alamat_pt`, `dirut_pt`, `saldo`) VALUES
	(12, 'aaaa', 'aaaaaa', 'aaaaaaaaa', 22222222223);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.transaksi_akad: ~2 rows (approximately)
INSERT INTO `transaksi_akad` (`id`, `nasabah_id`, `tanggal`, `jenis`, `keterangan`, `nominal`, `status`) VALUES
	(7, 1, '2024-02-12', 'Pemasukan', '12313', 123123123123, 'BELUM LUNAS'),
	(8, 1, '2024-01-29', 'Pengeluaran', '12312', 123132131313, 'BELUM LUNAS');

-- Dumping structure for table toko.transaksi_pt
CREATE TABLE IF NOT EXISTS `transaksi_pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` int(11) NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `nominal` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tr_pt` (`pt_id`),
  CONSTRAINT `fk_tr_pt` FOREIGN KEY (`pt_id`) REFERENCES `pt` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table toko.transaksi_pt: ~0 rows (approximately)

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

-- Dumping structure for table toko.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table toko.user: ~3 rows (approximately)
INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
	(1, 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', 'logo.png', 'administrator'),
	(39, 'Adit', 'v', '9e3669d19b675bd57058fd4664205d2a', '', 'nasabah'),
	(40, 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', '', 'nasabah');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
