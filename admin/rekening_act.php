<?php
include '../koneksi.php';
$pt_id  = $_POST['pt_id'];
$bank_id  = $_POST['bank_id'];
$atas_nama  = $_POST['atas_nama'];
$no_rekening  = $_POST['no_rekening'];

mysqli_query($koneksi, "INSERT INTO rekening (pt_id, bank_id, atas_nama, no_rekening) VALUES ($pt_id, $bank_id, '$atas_nama', '$no_rekening')") or die(mysqli_error($koneksi));
header("location:rekening.php");
