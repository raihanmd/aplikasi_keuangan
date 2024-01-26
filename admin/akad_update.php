<?php
include '../koneksi.php';
$user_id = $_POST['user_id'];
$status_dp  = $_POST['status_dp'];


mysqli_query($koneksi, "UPDATE akad SET  status_dp='$status_dp' WHERE user_id=$user_id");
header("location:akad.php");
