<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];
$tipe  = $_POST['tipe'];
$status  = $_POST['status'];

mysqli_query($koneksi, "INSERT INTO hutang_piutang (tanggal, nominal, keterangan, tipe, status) VALUES ('$tanggal',$nominal,'$keterangan', '$tipe', '$status')")or die(mysqli_error($koneksi));
header("location:hutang_piutang.php");