<?php
include '../koneksi.php';
$nama  = $_POST['nama'];
$alamat  = $_POST['alamat'];
$dirut  = $_POST['dirut'];

mysqli_query($koneksi, "INSERT INTO pt (nama_pt, alamat_pt, dirut_pt) VALUES ('$nama', '$alamat', '$dirut')") or die(mysqli_error($koneksi));
header("location:pt.php");
