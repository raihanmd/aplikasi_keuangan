<?php
include '../koneksi.php';
$id = $_GET['id'];

// Mulai transaction
mysqli_begin_transaction($koneksi);

try {
    // Ambil data transaksi yang akan dihapus
    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi_akad WHERE id='$id'");
    $t = mysqli_fetch_assoc($transaksi);
    $nasabah_id = $t['nasabah_id'];
    $jenis = $t['jenis'];
    $nominal = $t['nominal'];

    // Ambil saldo sekarang dari tabel nasabah
    $result = mysqli_query($koneksi, "SELECT saldo FROM nasabah WHERE id = '$nasabah_id' FOR UPDATE");
    $row = mysqli_fetch_assoc($result);
    $saldo_sekarang = $row['saldo'];

    // Update saldo berdasarkan jenis transaksi
    if ($jenis == 'Pemasukan') {
        $saldo_baru = $saldo_sekarang - $nominal;
    } elseif ($jenis == 'Pengeluaran') {
        $saldo_baru = $saldo_sekarang + $nominal;
    }

    // Pastikan saldo tidak menjadi negatif
    if ($saldo_baru < 0) {
        throw new Exception("Saldo tidak mencukupi");
    }

    // Update saldo di tabel nasabah
    mysqli_query($koneksi, "UPDATE nasabah SET saldo = '$saldo_baru' WHERE id = '$nasabah_id'");

    // Delete data dari tabel transaksi_akad
    mysqli_query($koneksi, "DELETE FROM transaksi_akad WHERE id='$id'");

    // Commit transaction jika semua query berhasil
    mysqli_commit($koneksi);

    header("location:transaksi_akad.php?alert=berhasildelete");
} catch (Exception $e) {
    // Rollback transaction jika terjadi kesalahan
    mysqli_rollback($koneksi);

    header("location:transaksi_akad.php?alert=gagaldelete&message=" . urlencode($e->getMessage()));
}
