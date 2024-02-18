<?php
include '../koneksi.php';
include '../utils/crypt.php';

// Nonaktifkan autocommit untuk memulai transaksi
mysqli_autocommit($koneksi, false);

try {
    // Periksa dan tangani nilai-nilai yang mungkin kosong dari $_POST
    function checkEmpty($value)
    {
        return $value !== "" ? "'$value'" : "NULL";
    }

    // Tangani nilai-nilai yang mungkin kosong dari $_POST
    $user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);
    // Check if the user exists
    $user_exists_query = "SELECT * FROM nasabah WHERE user_id = '$user_id'";
    $user_exists_result = mysqli_query($koneksi, $user_exists_query);
    if (mysqli_num_rows($user_exists_result) > 0) {
        // User exists, update the record
        $query_nasabah = "UPDATE nasabah SET ";
    } else {
        // User does not exist, insert a new record
        $query_nasabah = "UPDATE nasabah SET user_id = '$user_id', ";
    }

    // Continue building the query
    $query_nasabah .= "pt_id = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['pt_id'])) . ", ";
    $query_nasabah .= "perumahan_id = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['perumahan_id'])) . ", ";
    $query_nasabah .= "rekening_id = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['rekening_id'])) . ", ";
    $query_nasabah .= "kavling = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['kavling'])) . ", ";
    $query_nasabah .= "tanggal_pendataan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['tanggal_pendataan'])) . ", ";
    $query_nasabah .= "luas_tanah = " . (isset($_POST['luas_tanah']) ? $_POST['luas_tanah'] : 0) . ", ";
    $query_nasabah .= "luas_rumah = " . (isset($_POST['luas_rumah']) ? $_POST['luas_rumah'] : 0) . ", ";
    $query_nasabah .= "tempat_lahir = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['tempat_lahir'])) . ", ";
    $query_nasabah .= "tanggal_lahir = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir'])) . ", ";
    $query_nasabah .= "pekerjaan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['pekerjaan'])) . ", ";
    $query_nasabah .= "jabatan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['jabatan'])) . ", ";
    $query_nasabah .= "nik = " . (isset($_POST['nik']) && $_POST['nik'] !== '' ? "'" . encrypt($_POST['nik']) . "'" : "NULL") . ", ";
    $query_nasabah .= "alamat = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['alamat'])) . ", ";
    $query_nasabah .= "no_hp = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['no_hp'])) . ", ";
    $query_nasabah .= "email = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['email'])) . ", ";
    $query_nasabah .= "nama_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['nama_pasangan'])) . ", ";
    $query_nasabah .= "tempat_lahir_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_pasangan'])) . ", ";
    $query_nasabah .= "tanggal_lahir_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_pasangan'])) . ", ";
    $query_nasabah .= "pekerjaan_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['pekerjaan_pasangan'])) . ", ";
    $query_nasabah .= "nik_pasangan = " . (isset($_POST['nik_pasangan']) && $_POST['nik_pasangan'] !== '' ? "'" . encrypt($_POST['nik_pasangan']) . "'" : "NULL") . ", ";
    $query_nasabah .= "alamat_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['alamat_pasangan'])) . ", ";
    $query_nasabah .= "no_hp_pasangan = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['no_hp_pasangan'])) . ", ";
    $query_nasabah .= "nama_instansi = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['nama_instansi'])) . ", ";
    $query_nasabah .= "alamat_instansi = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['alamat_instansi'])) . ", ";
    $query_nasabah .= "no_hp_instansi = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['no_hp_instansi'])) . ", ";
    $query_nasabah .= "gaji = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['gaji'])) . ", ";
    $query_nasabah .= "gaji_terbilang = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['gaji_terbilang'])) . ", ";
    $query_nasabah .= "no_npwp = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['no_npwp'])) . ", ";
    $query_nasabah .= "harga_jual_rumah = " . (isset($_POST['harga_jual_rumah']) ? $_POST['harga_jual_rumah'] : 0) . ", ";
    $query_nasabah .= "uang_muka = " . (isset($_POST['uang_muka']) ? $_POST['uang_muka'] : 0) . ", ";
    $query_nasabah .= "plafon_kredit = " . (isset($_POST['plafon_kredit']) ? $_POST['plafon_kredit'] : 0) . ", ";
    $query_nasabah .= "marketing = " . checkEmpty(mysqli_real_escape_string($koneksi, $_POST['marketing']));

    $query_nasabah .= " WHERE user_id = $user_id";

    // Execute the query
    $result_nasabah = mysqli_query($koneksi, $query_nasabah);

    if (!$result_nasabah) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Commit transaksi jika semua query berhasil
    mysqli_commit($koneksi);

    // Aktifkan autocommit lagi setelah transaksi berhasil
    mysqli_autocommit($koneksi, true);

    // Redirect setelah transaksi selesai
    header("location:nasabah_detail.php?user_id=$user_id");
} catch (Exception $e) {
    // Rollback transaksi jika ada kesalahan
    mysqli_rollback($koneksi);

    // Aktifkan autocommit lagi setelah transaksi gagal
    mysqli_autocommit($koneksi, true);

    // Handle kesalahan (Anda dapat menambahkan tindakan lebih lanjut sesuai kebutuhan)
    echo "Query gagal: " . $e->getMessage();
}
