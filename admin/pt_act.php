<?php
include '../koneksi.php';
$no_rumah  = $_POST['no_rumah'];
$nama  = $_POST['nama'];
$alamat  = $_POST['alamat'];
$nik  = $_POST['nik'];
$no_hp  = $_POST['no_hp'];
$no_hp_2  = $_POST['no_hp_2'];

mysqli_query($koneksi, "INSERT INTO pt (no_rumah, nama, alamat, nik, no_hp, no_hp_2) VALUES ('$no_rumah', '$nama', '$alamat', '$nik','$no_hp','$no_hp_2')") or die(mysqli_error($koneksi));
header("location:pt.php");
