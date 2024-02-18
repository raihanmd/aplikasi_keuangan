<?php
include '../koneksi.php';
$nama_bank  = $_POST['nama_bank'];
$branch_manager  = $_POST['branch_manager'];

mysqli_query($koneksi, "INSERT INTO bank (nama_bank, branch_manager) VALUES ('$nama_bank', '$branch_manager')") or die(mysqli_error($koneksi));
header("location:bank.php");
