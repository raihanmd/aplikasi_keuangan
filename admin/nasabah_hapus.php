<?php
include '../koneksi.php';
$user_id = $_GET['user_id'];

$query = "SELECT id AS nasabah_id FROM nasabah WHERE user_id = '$user_id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nasabah_id = $row['nasabah_id'];

    mysqli_query($koneksi, "DELETE FROM transaksi_akad WHERE nasabah_id = '$nasabah_id'");

    mysqli_query($koneksi, "DELETE FROM nasabah WHERE user_id = '$user_id'");

    mysqli_query($koneksi, "DELETE FROM user WHERE user_id = '$user_id'");

    header("location:nasabah.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
