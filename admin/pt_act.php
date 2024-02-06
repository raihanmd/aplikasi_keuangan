<?php
include '../koneksi.php';
$nama  = $_POST['nama'];
$alamat  = $_POST['alamat'];
$dirut  = $_POST['dirut'];
$saldo  = $_POST['saldo'];

mysqli_query($koneksi, "INSERT INTO pt (nama, alamat, dirut, saldo) VALUES ('$nama', '$alamat', '$dirut', $saldo)") or die(mysqli_error($koneksi));
header("location:pt.php");
