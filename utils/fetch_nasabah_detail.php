<?php
// Include file koneksi ke database
include '../koneksi.php';

// Ambil nilai user_id dari parameter GET
$user_id = $_GET['user_id'];

// Query untuk mengambil detail nasabah beserta informasi terkait
$query = "
    SELECT n.*, u.*, p.*, r.*, b.*, pr.*
    FROM nasabah AS n
    JOIN user AS u ON n.user_id = u.user_id
    LEFT JOIN pt AS p ON n.pt_id = p.id
    LEFT JOIN rekening AS r ON r.pt_id = p.id
    LEFT JOIN bank AS b ON r.bank_id = b.id
    LEFT JOIN perumahan AS pr ON p.id = pr.pt_id
    WHERE u.user_id = '$user_id'
";

// Eksekusi query
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ubah hasil query menjadi array asosiatif
    $data = mysqli_fetch_assoc($result);
    // Encode data sebagai JSON dan kirimkan ke klien
    echo json_encode($data);
} else {
    // Jika query gagal, kirimkan respon error
    http_response_code(500); // Internal Server Error
    echo json_encode(array("message" => "Gagal mengambil detail nasabah."));
}
