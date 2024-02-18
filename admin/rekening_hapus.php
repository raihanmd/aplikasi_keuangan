<?php
include '../koneksi.php';
$id  = $_GET['id'];
mysqli_query($koneksi, "delete from rekening where id='$id'");
header("location:rekening.php");
