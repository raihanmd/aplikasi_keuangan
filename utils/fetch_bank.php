<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $pengembangId = $_GET['id'];

    $query;

    if (isset($_GET['rekening'])) {
        $query = "SELECT b.id, b.nama_bank 
                  FROM bank AS b 
                  LEFT JOIN rekening AS r ON b.id = r.bank_id 
                  WHERE (r.pt_id IS NULL OR r.pt_id != $pengembangId)";
    } else {
        $query =  "SELECT b.id AS bank_id, r.id, r.pt_id, r.bank_id, b.nama_bank, b.branch_manager, r.atas_nama, r.no_rekening FROM rekening AS r JOIN bank AS b ON r.bank_id = b.id WHERE r.pt_id = $pengembangId";
    }

    $res = mysqli_query($koneksi, $query);
    $data = [];

    if ($query) {
        while ($row = mysqli_fetch_assoc($res)) {
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
