<?php
include '../koneksi.php';
include '../utils/crypt.php';

// Nonaktifkan autocommit untuk memulai transaksi
mysqli_autocommit($koneksi, false);

try {
    $user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $kavling = mysqli_real_escape_string($koneksi, $_POST['kavling']);
    $tanggal_pendataan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pendataan']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $nik = encrypt(mysqli_real_escape_string($koneksi, $_POST['nik']));
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nama_pasangan = mysqli_real_escape_string($koneksi, $_POST['nama_pasangan']);
    $tempat_lahir_pasangan = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_pasangan']);
    $tanggal_lahir_pasangan = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_pasangan']);
    $pekerjaan_pasangan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_pasangan']);
    $nik_pasangan = encrypt(mysqli_real_escape_string($koneksi, $_POST['nik_pasangan']));
    $alamat_pasangan = mysqli_real_escape_string($koneksi, $_POST['alamat_pasangan']);
    $no_hp_pasangan = mysqli_real_escape_string($koneksi, $_POST['no_hp_pasangan']);
    $nama_instansi = mysqli_real_escape_string($koneksi, $_POST['nama_instansi']);
    $alamat_instansi = mysqli_real_escape_string($koneksi, $_POST['alamat_instansi']);
    $no_hp_instansi = mysqli_real_escape_string($koneksi, $_POST['no_hp_instansi']);
    $gaji = mysqli_real_escape_string($koneksi, $_POST['gaji']);
    $gaji_terbilang = mysqli_real_escape_string($koneksi, $_POST['gaji_terbilang']);
    $no_npwp = mysqli_real_escape_string($koneksi, $_POST['no_npwp']);
    $nama_bank = mysqli_real_escape_string($koneksi, $_POST['nama_bank']);
    $branch_manager = mysqli_real_escape_string($koneksi, $_POST['branch_manager']);
    $pt_id = mysqli_real_escape_string($koneksi, $_POST['pt_id']);
    $perumahan_id = mysqli_real_escape_string($koneksi, $_POST['perumahan_id']);
    $marketing = mysqli_real_escape_string($koneksi, $_POST['marketing']);
    $harga_jual_rumah = mysqli_real_escape_string($koneksi, $_POST['harga_jual_rumah']);
    $uang_muka = mysqli_real_escape_string($koneksi, $_POST['uang_muka']);
    $plafon_kredit = mysqli_real_escape_string($koneksi, $_POST['plafon_kredit']);
    $saldo = 0;

    // Query pertama: Update data di tabel user
    $query_user = "UPDATE user SET user_nama = '$nama'";
    // Cek apakah password diisi, jika ya, tambahkan ke query
    if (!empty($_POST['password'])) {
        $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));
        $query_user .= ", password = '$password'";
    }
    $query_user .= " WHERE user_id = '$user_id'";

    $result_user = mysqli_query($koneksi, $query_user);

    if (!$result_user) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Query kedua: Update data di tabel rekening
    $query_rekening = "UPDATE rekening SET nama_bank = '$nama_bank', branch_manager = '$branch_manager' WHERE user_id = '$user_id'";
    $result_rekening = mysqli_query($koneksi, $query_rekening);

    if (!$result_rekening) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Query ketiga: Update data di tabel nasabah
    $query_nasabah = "UPDATE nasabah SET pt_id = $pt_id, perumahan_id = $perumahan_id, kavling = '$kavling', tanggal_pendataan = '$tanggal_pendataan', tanggal_lahir = '$tanggal_lahir', tempat_lahir = '$tempat_lahir', pekerjaan = '$pekerjaan', jabatan = '$jabatan', nik = '$nik', alamat = '$alamat', no_hp = '$no_hp', email = '$email', nama_pasangan = '$nama_pasangan', tempat_lahir_pasangan = '$tempat_lahir_pasangan', tanggal_lahir_pasangan = '$tanggal_lahir_pasangan', pekerjaan_pasangan = '$pekerjaan_pasangan', nik_pasangan = '$nik_pasangan', alamat_pasangan = '$alamat_pasangan', no_hp_pasangan = '$no_hp_pasangan', nama_instansi = '$nama_instansi', alamat_instansi = '$alamat_instansi', no_hp_instansi = '$no_hp_instansi', gaji = $gaji, gaji_terbilang = '$gaji_terbilang', no_npwp = '$no_npwp', marketing = '$marketing', harga_jual_rumah = $harga_jual_rumah, uang_muka = $uang_muka, plafon_kredit = $plafon_kredit, saldo = $saldo WHERE user_id = '$user_id'";

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
