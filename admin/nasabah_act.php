<?php
include '../koneksi.php';
$user_id  = $_POST['user_id'];
$no_rumah  = $_POST['no_rumah'];
$alamat  = $_POST['alamat'];
$nik  = $_POST['nik'];
$no_hp  = $_POST['no_hp'];
$no_hp_2  = $_POST['no_hp_2'];

mysqli_query($koneksi, "INSERT INTO nasabah (user_id, no_rumah, alamat, nik, no_hp, no_hp_2) VALUES ('$user_id', '$no_rumah', '$alamat', '$nik','$no_hp','$no_hp_2')") or die(mysqli_error($koneksi));
header("location:nasabah.php");
