<?php
include '../koneksi.php';
$user_id  = $_POST['user_id'];
$status_dp  = $_POST['status_dp'];

mysqli_query($koneksi, "INSERT INTO akad (user_id, status_dp) VALUES ($user_id, '$status_dp')") or die(mysqli_error($koneksi));
header("location:akad.php");