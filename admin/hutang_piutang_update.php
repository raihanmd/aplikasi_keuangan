<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$status  = $_POST['status'];
$tipe  = $_POST['tipe'];
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "update hutang_piutang set tanggal='$tanggal', nominal=$nominal, keterangan='$keterangan', tipe='$tipe', status='$status' where id='$id'") or die(mysqli_error($koneksi));
header("location:hutang_piutang.php");