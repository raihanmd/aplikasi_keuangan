<?php
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$jenis  = $_POST['jenis'];
$kategori  = $_POST['kategori'];
$keterangan  = $_POST['keterangan'];
$nominal = $_POST['nominal'];


mysqli_query($koneksi, "update transaksi_umum set transaksi_tanggal='$tanggal', transaksi_jenis='$jenis', transaksi_kategori='$kategori', transaksi_nominal=$nominal, transaksi_keterangan='$keterangan' where transaksi_id='$id'") or die(mysqli_error($koneksi));
header("location:transaksi_umum.php?alert=berhasilupdate");
