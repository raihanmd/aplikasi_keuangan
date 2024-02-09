<?php
include '../koneksi.php';

$pt_id = $_POST['pt_id'];
$tanggal = $_POST['tanggal'];
$jenis = $_POST['jenis'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];

// Mulai transaction
mysqli_begin_transaction($koneksi);

try {

    // Insert data ke tabel transaksi_pt
    mysqli_query($koneksi, "INSERT INTO transaksi_pt VALUES (NULL,'$pt_id','$tanggal','$jenis','$keterangan','$nominal')");

    // Commit transaction jika semua query berhasil
    mysqli_commit($koneksi);

    header("location:transaksi_pt.php?alert=berhasil");
} catch (Exception $e) {
    // Rollback transaction jika terjadi kesalahan
    mysqli_rollback($koneksi);

    header("location:transaksi_pt.php?alert=gagal&message=" . urlencode($e->getMessage()));
}
