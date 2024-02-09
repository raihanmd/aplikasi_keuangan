<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	// Mulai transaction
	mysqli_begin_transaction($koneksi);

	try {
		// Ambil data transaksi_akad
		$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi_akad WHERE id='$id' FOR UPDATE");
		$data_transaksi = mysqli_fetch_assoc($transaksi);

		if (!$data_transaksi) {
			throw new Exception("Transaksi tidak ditemukan.");
		}

		// Hapus transaksi_akad
		$hapus_transaksi = mysqli_query($koneksi, "DELETE FROM transaksi_akad WHERE id='$id'");

		if (!$hapus_transaksi) {
			throw new Exception("Gagal menghapus transaksi.");
		}

		// Commit jika semua query berhasil
		mysqli_commit($koneksi);
		header("location: transaksi_akad.php");
	} catch (Exception $e) {
		// Rollback jika terjadi kesalahan
		mysqli_rollback($koneksi);
		die($e->getMessage());
	}
} else {
	echo "ID transaksi_akad tidak valid.";
}
