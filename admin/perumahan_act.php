<?php
include '../koneksi.php';

$pt_id = $_POST['pt_id'];
$nama_perumahan = $_POST['nama_perumahan'];
$alamat_perumahan = $_POST['alamat_perumahan'];

mysqli_begin_transaction($koneksi);

try {

    mysqli_query($koneksi, "INSERT INTO perumahan VALUES (NULL,'$pt_id','$nama_perumahan','$alamat_perumahan')");

    mysqli_commit($koneksi);

    header("location:perumahan.php?alert=berhasil");
} catch (Exception $e) {
    mysqli_rollback($koneksi);

    header("location:perumahan.php?alert=gagal&message=" . urlencode($e->getMessage()));
}
