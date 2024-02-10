<?php
include '../koneksi.php';
$id = $_POST['id'];
$nama_pt  = $_POST['nama_pt'];
$alamat_pt  = $_POST['alamat_pt'];
$dirut_pt  = $_POST['dirut_pt'];



mysqli_query($koneksi, "UPDATE pt SET nama_pt = '$nama_pt', alamat_pt = '$alamat_pt', dirut_pt = '$dirut_pt' WHERE id = '$id'") or die(mysqli_error($koneksi));
header("location:pt.php");
