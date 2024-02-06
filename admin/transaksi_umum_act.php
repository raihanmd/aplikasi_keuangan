<?php
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$jenis  = $_POST['jenis'];
$kategori  = $_POST['kategori'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];




mysqli_query($koneksi, "insert into transaksi_umum values (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan')") or die(mysqli_error($koneksi));
header("location:transaksi_umum.php?alert=berhasil");

// mysqli_query($koneksi, "insert into transaksi values (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan','$bank')")or die(mysqli_error($koneksi));
// header("location:transaksi.php");