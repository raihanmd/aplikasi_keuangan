<?php
include '../koneksi.php';

$nasabah_id = $_POST['nasabah_id'];
$tanggal = $_POST['tanggal'];
$jenis = $_POST['jenis'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['keterangan'];
$status = $_POST['status'];

// Mulai transaction
mysqli_begin_transaction($koneksi);

try {

    // Insert data ke tabel transaksi_akad
    mysqli_query($koneksi, "INSERT INTO transaksi_akad VALUES (NULL,'$nasabah_id','$tanggal','$jenis','$keterangan','$nominal', '$status')");

    // Commit transaction jika semua query berhasil
    mysqli_commit($koneksi);

    header("location:transaksi_akad.php?alert=berhasil");
} catch (Exception $e) {
    // Rollback transaction jika terjadi kesalahan
    mysqli_rollback($koneksi);

    header("location:transaksi_akad.php?alert=gagal&message=" . urlencode($e->getMessage()));
}
