<?php
include '../koneksi.php';
$id = $_POST['id'];
$nama_bank  = $_POST['nama_bank'];
$branch_manager  = $_POST['branch_manager'];



mysqli_query($koneksi, "UPDATE bank SET nama_bank = '$nama_bank', branch_manager = '$branch_manager' WHERE id = '$id'") or die(mysqli_error($koneksi));
header("location:bank.php");
