<?php
include '../koneksi.php';

$id = $_POST['id'];
$pt_id = $_POST['pt_id'];
$nama_perumahan = $_POST['nama_perumahan'];
$alamat_perumahan = $_POST['alamat_perumahan'];

mysqli_begin_transaction($koneksi);

try {

    mysqli_query($koneksi, "UPDATE perumahan SET pt_id = '$pt_id', nama_perumahan = '$nama_perumahan', alamat_perumahan = '$alamat_perumahan' WHERE id = '$id'") or die(mysqli_error($koneksi));

    mysqli_commit($koneksi);

    header("location:perumahan.php?alert=berhasil");
} catch (Exception $e) {
    mysqli_rollback($koneksi);

    header("location:perumahan.php?alert=gagal&message=" . urlencode($e->getMessage()));
}
