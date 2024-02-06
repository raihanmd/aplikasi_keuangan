<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nasabah_id = $_POST['nasabah_id'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];

    // Mulai transaction
    mysqli_autocommit($koneksi, false);
    $error = false;

    try {
        // Ambil saldo sebelumnya
        $query_saldo = "SELECT saldo FROM nasabah WHERE id = $nasabah_id FOR UPDATE";
        $result_saldo = mysqli_query($koneksi, $query_saldo);

        if ($result_saldo) {
            $saldo_sebelumnya = mysqli_fetch_assoc($result_saldo)['saldo'];

            // Hitung selisih nominal
            $selisih_nominal = $nominal;

            // Jika jenis transaksi sebelumnya adalah pengeluaran, ubah selisih menjadi positif
            if ($jenis == 'Pemasukan' && $saldo_sebelumnya < 0) {
                $selisih_nominal = abs($saldo_sebelumnya) + $nominal;
            }

            // Hitung saldo setelah transaksi
            if ($jenis == 'Pemasukan') {
                $saldo_terbaru = $saldo_sebelumnya + $selisih_nominal;
            } elseif ($jenis == 'Pengeluaran') {
                $saldo_terbaru = $saldo_sebelumnya - $selisih_nominal;
            } else {
                // Jenis transaksi tidak valid
                $error = true;
            }

            // Update data transaksi_akad dan saldo nasabah
            $update_query = "UPDATE transaksi_akad SET
                nasabah_id = '$nasabah_id',
                tanggal = '$tanggal',
                jenis = '$jenis',
                nominal = '$nominal',
                status = '$status',
                keterangan = '$keterangan'
                WHERE id = $id";

            $update_saldo_query = "UPDATE nasabah SET saldo = '$saldo_terbaru' WHERE id = $nasabah_id";

            if (!mysqli_query($koneksi, $update_query) || !mysqli_query($koneksi, $update_saldo_query)) {
                // Rollback jika ada error
                mysqli_rollback($koneksi);
                $error = true;
            }
        } else {
            // Gagal mengambil saldo sebelumnya
            $error = true;
        }

        if ($error) {
            // Rollback jika ada error
            mysqli_rollback($koneksi);
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
