<?php
include '../koneksi.php';
$id = $_POST['id'];
$no_rumah  = $_POST['no_rumah'];
$nama  = $_POST['nama'];
$alamat  = $_POST['alamat'];
$nik  = $_POST['nik'];
$no_hp  = $_POST['no_hp'];
$no_hp_2  = $_POST['no_hp_2'];


mysqli_query($koneksi, "UPDATE pt SET no_rumah='$no_rumah', nama='$nama', alamat='$alamat', nik='$nik', no_hp='$no_hp', no_hp_2='$no_hp_2' WHERE id='$id'");
header("location:pt.php");
