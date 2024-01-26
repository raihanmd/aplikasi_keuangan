<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from hutang_piutang where id='$id'");
header("location:hutang_piutang.php");