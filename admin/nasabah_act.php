<?php
include '../koneksi.php';
include '../utils/crypt.php';

// Nonaktifkan autocommit untuk memulai transaksi
mysqli_autocommit($koneksi, false);

try {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));
    $kavling = mysqli_real_escape_string($koneksi, $_POST['kavling']);
    $tanggal_pendataan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pendataan']);
    $luas_tanah = $_POST['luas_tanah'] != "" ? mysqli_real_escape_string($koneksi, $_POST['luas_tanah']) : 0;
    $luas_rumah = $_POST['luas_rumah'] != "" ? mysqli_real_escape_string($koneksi, $_POST['luas_rumah']) : 0;
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nama_pasangan = mysqli_real_escape_string($koneksi, $_POST['nama_pasangan']);
    $tempat_lahir_pasangan = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_pasangan']);
    $tanggal_lahir_pasangan = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_pasangan']);
    $pekerjaan_pasangan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_pasangan']);
    $nik_pasangan = mysqli_real_escape_string($koneksi, $_POST['nik_pasangan']);
    $alamat_pasangan = mysqli_real_escape_string($koneksi, $_POST['alamat_pasangan']);
    $no_hp_pasangan = mysqli_real_escape_string($koneksi, $_POST['no_hp_pasangan']);
    $nama_instansi = mysqli_real_escape_string($koneksi, $_POST['nama_instansi']);
    $alamat_instansi = mysqli_real_escape_string($koneksi, $_POST['alamat_instansi']);
    $no_hp_instansi = mysqli_real_escape_string($koneksi, $_POST['no_hp_instansi']);
    $gaji = $_POST['gaji'] != "" ? mysqli_real_escape_string($koneksi, $_POST['gaji']) : 0;
    $gaji_terbilang = mysqli_real_escape_string($koneksi, $_POST['gaji_terbilang']);
    $no_npwp = mysqli_real_escape_string($koneksi, $_POST['no_npwp']);
    $rekening_id = isset($_POST['rekening_id']) ? mysqli_real_escape_string($koneksi, $_POST['rekening_id']) : null;
    $pt_id = mysqli_real_escape_string($koneksi, $_POST['pt_id']);
    $perumahan_id = isset($_POST['perumahan_id']) ? mysqli_real_escape_string($koneksi, $_POST['perumahan_id']) : null;
    $marketing = mysqli_real_escape_string($koneksi, $_POST['marketing']);
    $harga_jual_rumah = $_POST['harga_jual_rumah'] != "" ? mysqli_real_escape_string($koneksi, $_POST['harga_jual_rumah']) : 0;
    $uang_muka = $_POST['uang_muka'] != "" ? mysqli_real_escape_string($koneksi, $_POST['uang_muka']) : 0;
    $plafon_kredit = $_POST['plafon_kredit'] != "" ? mysqli_real_escape_string($koneksi, $_POST['plafon_kredit']) : 0;

    // Query pertama: Insert ke tabel user
    $query_user = "INSERT INTO user VALUES (NULL, '$nama', '$username', '$password', '', 'nasabah')";
    $result_user = mysqli_query($koneksi, $query_user);

    if (!$result_user) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Mendapatkan ID user yang baru saja di-insert
    $user_id = mysqli_insert_id($koneksi);

    $query_nasabah = "INSERT INTO nasabah (user_id, pt_id, perumahan_id, rekening_id, kavling, tanggal_pendataan, luas_tanah, luas_rumah, tempat_lahir, tanggal_lahir, pekerjaan, jabatan, nik, alamat, no_hp, email, nama_pasangan, tempat_lahir_pasangan, tanggal_lahir_pasangan, pekerjaan_pasangan, nik_pasangan, alamat_pasangan, no_hp_pasangan, nama_instansi, alamat_instansi, no_hp_instansi, gaji, gaji_terbilang, no_npwp, marketing, harga_jual_rumah, uang_muka, plafon_kredit) 
    VALUES ($user_id, " . ($_POST['pt_id'] != "" ? $_POST['pt_id'] : "NULL") . ", " . (isset($_POST['perumahan_id']) ? $_POST['perumahan_id'] : "NULL") . ", " . (isset($_POST['rekening_id']) ? $_POST['rekening_id'] : "NULL") . ", '$kavling', '$tanggal_pendataan', $luas_tanah, $luas_rumah, '$tempat_lahir', '$tanggal_lahir', '$pekerjaan', '$jabatan', " . ($nik != "" ? '"' . encrypt($nik) . '"' : "''") . ", '$alamat', '$no_hp', '$email', '$nama_pasangan', '$tempat_lahir_pasangan', '$tanggal_lahir_pasangan', '$pekerjaan_pasangan', " . ($nik_pasangan != "" ? '"' . encrypt($nik_pasangan) . '"' : "''") . ", '$alamat_pasangan', '$no_hp_pasangan', '$nama_instansi', '$alamat_instansi', '$no_hp_instansi', $gaji , '$gaji_terbilang', '$no_npwp', '$marketing', $harga_jual_rumah, $uang_muka, $plafon_kredit)";


    $result_nasabah = mysqli_query($koneksi, $query_nasabah);

    if (!$result_nasabah) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Commit transaksi jika semua query berhasil
    mysqli_commit($koneksi);

    // Aktifkan autocommit lagi setelah transaksi berhasil
    mysqli_autocommit($koneksi, true);

    // Redirect setelah transaksi selesai
    header("location:nasabah.php");
} catch (Exception $e) {
    // Rollback transaksi jika ada kesalahan
    mysqli_rollback($koneksi);

    // Aktifkan autocommit lagi setelah transaksi gagal
    mysqli_autocommit($koneksi, true);

    // Handle kesalahan (Anda dapat menambahkan tindakan lebih lanjut sesuai kebutuhan)
    echo "Query gagal: " . $e->getMessage();
}
