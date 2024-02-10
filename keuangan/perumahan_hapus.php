<?php
include '../koneksi.php';
$id  = $_GET['id'];
mysqli_query($koneksi, "delete from perumahan where id='$id'");
header("location:pt.php");
