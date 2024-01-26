<?php
include '../koneksi.php';
$id  = $_GET['id'];
mysqli_query($koneksi, "delete from pt where id='$id'");
header("location:pt.php");
