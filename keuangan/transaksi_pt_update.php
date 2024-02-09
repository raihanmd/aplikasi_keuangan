<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $pt_id = $_POST['pt_id'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    // Mulai transaction
    mysqli_autocommit($koneksi, false);
    $error = false;

    try {
        // Update data transaksi_pt
        $update_query = "UPDATE transaksi_pt SET
            pt_id = '$pt_id',
            tanggal = '$tanggal',
            jenis = '$jenis',
            nominal = '$nominal',
            keterangan = '$keterangan'
            WHERE id = $id";

        if (!mysqli_query($koneksi, $update_query)) {
            // Rollback jika ada error
            mysqli_rollback($koneksi);
            $error = true;
        }

        if ($error) {
            // Redirect ke halaman transaksi_pt dengan alert gagal
            header("location:transaksi_pt.php?alert=gagalupdate");
            exit();
        } else {
            // Commit jika tidak ada error
            mysqli_commit($koneksi);
            // Redirect ke halaman transaksi_pt dengan alert berhasil
            header("location:transaksi_pt.php?alert=berhasilupdate");
            exit();
        }
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        mysqli_rollback($koneksi);
        die($e->getMessage());
    }
} else {
    // Jika bukan POST request, redirect ke halaman transaksi_pt
    header("location:transaksi_pt.php");
    exit();
}
