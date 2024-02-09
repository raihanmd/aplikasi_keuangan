<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nasabah_id = $_POST['nasabah_id'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis']; // Tambahkan jenis transaksi

    // Mulai transaction
    mysqli_autocommit($koneksi, false);
    $error = false;

    try {
        // Update data transaksi_akad
        $update_query = "UPDATE transaksi_akad SET
            nasabah_id = '$nasabah_id',
            tanggal = '$tanggal',
            status = '$status',
            nominal = '$nominal',
            keterangan = '$keterangan',
            jenis = '$jenis'
            WHERE id = $id";

        if (!mysqli_query($koneksi, $update_query)) {
            // Rollback jika ada error
            mysqli_rollback($koneksi);
            $error = true;
        }

        if ($error) {
            // Redirect ke halaman transaksi_akad dengan alert gagal
            header("location:transaksi_akad.php?alert=gagalupdate");
            exit();
        } else {
            // Commit jika tidak ada error
            mysqli_commit($koneksi);
            // Redirect ke halaman transaksi_akad dengan alert berhasil
            header("location:transaksi_akad.php?alert=berhasilupdate");
            exit();
        }
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        mysqli_rollback($koneksi);
        die($e->getMessage());
    }
} else {
    // Jika bukan POST request, redirect ke halaman transaksi_akad
    header("location:transaksi_akad.php");
    exit();
}
