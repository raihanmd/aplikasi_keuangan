<?php
include '../koneksi.php';
$user_id  = $_GET['user_id'];
mysqli_query($koneksi, "delete from akad where user_id='$user_id'");
header("location:akad.php");
