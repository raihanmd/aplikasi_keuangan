<?php
include '../koneksi.php';
$id  = $_GET['id'];
mysqli_query($koneksi, "delete from bank where id='$id'");
header("location:bank.php");
