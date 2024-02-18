<?php
include '../koneksi.php';
$id = $_POST['id'];
$pt_id  = $_POST['pt_id'];
$bank_id  = $_POST['bank_id'];
$atas_nama  = $_POST['atas_nama'];
$no_rekening  = $_POST['no_rekening'];



mysqli_query($koneksi, "UPDATE rekening SET pt_id=$pt_id,bank_id=$bank_id,atas_nama='$atas_nama',no_rekening='$no_rekening' WHERE id = '$id'") or die(mysqli_error($koneksi));
header("location:rekening.php");
