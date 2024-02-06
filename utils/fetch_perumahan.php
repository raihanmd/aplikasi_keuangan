<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $pengembangId = $_GET['id'];
    // Query untuk mendapatkan perumahan berdasarkan id pengembang
    $query = mysqli_query($koneksi, "SELECT id, pt_id, nama_perumahan, alamat_perumahan FROM perumahan WHERE pt_id = '$pengembangId'");
    $data = [];

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // Handle the query error, you might want to log it or provide a generic error message
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to fetch data']);
    }
}
