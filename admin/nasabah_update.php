<?php
include '../koneksi.php';
$user_id = $_POST['user_id'];
$no_rumah  = $_POST['no_rumah'];
$alamat  = $_POST['alamat'];
$nik  = $_POST['nik'];
$no_hp  = $_POST['no_hp'];
$no_hp_2  = $_POST['no_hp_2'];


mysqli_query($koneksi, "UPDATE nasabah SET no_rumah='$no_rumah', alamat='$alamat', nik='$nik', no_hp='$no_hp', no_hp_2='$no_hp_2' WHERE user_id='$user_id'");
header("location:nasabah.php");
