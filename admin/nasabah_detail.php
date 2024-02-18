<?php
$user_id = $_GET['user_id'];
include '../koneksi.php';
$user_detail = mysqli_query($koneksi, "SELECT pr.id AS perumahan_id, pr.*, b.*, r.*, p.*, u.*, n.* FROM nasabah as n 
    JOIN user as u ON n.user_id = u.user_id 
    LEFT JOIN pt as p ON n.pt_id = p.id 
    LEFT JOIN rekening as r ON r.pt_id = p.id 
    LEFT JOIN bank as b ON r.bank_id = b.id 
    LEFT JOIN perumahan as pr ON p.id = pr.pt_id 
    WHERE u.user_id = $user_id");
if (mysqli_num_rows($user_detail) == 0) {
    return header("location:nasabah.php");
}
include '../utils/crypt.php';
include 'header.php';

?>

<div class="content-wrapper">
    <?php
    while ($d = mysqli_fetch_assoc($user_detail)) {
    ?>
        <section class="content-header">
            <button class="btn btn-primary" style="margin-bottom: 1rem;" onclick="window.location.href='nasabah.php'; return false;">
                <i class="fa fa-arrow-left"></i>&nbsp; Kembali
            </button>
            <h1>
                Nasabah
                <small>Data Nasabah</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box box-info">

                        <div class="box-header">
                            <h3 class="box-title">Data Nasabah</h3>
                            <div class="btn-group pull-right">

                                <button type="button" class="btn btn-warning btn-sm" style="margin-right: 1rem;" data-toggle="modal" data-target="#exampleModal">
                                    Edit Nasabah
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_nasabah_<?php echo $d['user_id']
                                                                                                                                    ?>">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <form action="nasabah_update.php" method="post">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Nasabah</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <input type="text" hidden name="user_id" value="<?php echo $d['user_id']; ?>">
                                                    <div class="form-group">
                                                        <label>Nama <span class="text-red">
                                                                *
                                                            </span></label>
                                                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama .." value="<?= $d['user_nama'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username <span class="text-red">
                                                                *
                                                            </span></label>
                                                        <input type="text" name="username" required="required" class="form-control" placeholder="Username .." value="<?= $d['user_username'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password <span class="text-red">
                                                                *
                                                            </span></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password ..">
                                                        <small class="text-muted">Isi hanya jika ingin mengganti password.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kavling <span class="text-red">
                                                                *
                                                            </span></label>
                                                        <input type="text" name="kavling" required="required" class="form-control" placeholder="Kavling .." value="<?= $d['kavling'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Pendataan <span class="text-red">
                                                                *
                                                            </span></label>
                                                        <input type="text" name="tanggal_pendataan" required="required" class="form-control datepicker2" placeholder="Tanggal Pendataan .." value="<?= $d['tanggal_pendataan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Luas Tanah (M<sup>2</sup>)</label>
                                                        <input type="number" name="luas_tanah" class="form-control" placeholder="Luas Tanah .." value="<?= $d['luas_tanah'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Luas Rumah (M<sup>2</sup>)</label>
                                                        <input type="number" name="luas_rumah" class="form-control" placeholder="Luas Rumah .." value="<?= $d['luas_rumah'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tempat Lahir</label>
                                                        <input type="text" name="tempat_lahir" class="form-control datepicker2" placeholder="Tempat Lahir .." value="<?= $d['tempat_lahir'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input autocomplete="off" type="text" name="tanggal_lahir" class="form-control datepicker2" placeholder="Tanggal Lahir" value="<?= $d['tanggal_lahir'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan .." value="<?= $d['pekerjaan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan .." value="<?= $d['jabatan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIK</label>
                                                        <input type="text" name="nik" class="form-control" placeholder="NIK .." value="<?= decrypt($d['nik']) ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat .." value="<?= $d['alamat'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No HP</label>
                                                        <input type="text" name="no_hp" class="form-control" placeholder="No HP .." value="<?= $d['no_hp'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Email .." value="<?= $d['email'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Pasangan</label>
                                                        <input type="text" name="nama_pasangan" class="form-control" placeholder="Nama Pasangan .." value="<?= $d['nama_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tempat Lahir Pasangan</label>
                                                        <input type="text" name="tempat_lahir_pasangan" class="form-control" placeholder="Tempat Lahir Pasangan .." value="<?= $d['tempat_lahir_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir Pasangan</label>
                                                        <input autocomplete="off" type="text" name="tanggal_lahir_pasangan" class="form-control datepicker2" placeholder="Tanggal Lahir Pasangan" value="<?= $d['tanggal_lahir_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan Pasangan</label>
                                                        <input type="text" name="pekerjaan_pasangan" class="form-control" placeholder="Pekerjaan Pasangan .." value="<?= $d['pekerjaan_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIK Pasangan</label>
                                                        <input type="text" name="nik_pasangan" class="form-control" placeholder="NIK Pasangan .." value="<?= decrypt($d['nik_pasangan']) ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Pasangan</label>
                                                        <input type="text" name="alamat_pasangan" class="form-control" placeholder="Alamat Pasangan .." value="<?= $d['alamat_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No HP Pasangan</label>
                                                        <input type="text" name="no_hp_pasangan" class="form-control" placeholder="No HP Pasangan .." value="<?= $d['no_hp_pasangan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Instansi</label>
                                                        <input type="text" name="nama_instansi" class="form-control" placeholder="Nama Instansi .." value="<?= $d['nama_instansi'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Instansi</label>
                                                        <input type="text" name="alamat_instansi" class="form-control" placeholder="Alamat Instansi .." value="<?= $d['alamat_instansi'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No Pimpinan Instansi</label>
                                                        <input type="text" name="no_hp_instansi" class="form-control" placeholder="No HP Instansi .." value="<?= $d['no_hp_instansi'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gaji Pokok</label>
                                                        <input type="number" name="gaji" class="form-control" placeholder="Gaji Pokok .." value="<?= $d['gaji'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gaji Terbilang</label>
                                                        <input type="text" name="gaji_terbilang" class="form-control" placeholder="Gaji Terbilang .." value="<?= $d['gaji_terbilang'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No NPWP</label>
                                                        <input type="text" name="no_npwp" class="form-control" placeholder="No NPWP .." value="<?= $d['no_npwp'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Pengembang</label>
                                                        <select name="pt_id" id="nama_pengembang" class="form-control">
                                                            <option value="">- Pilih -</option>
                                                            <?php
                                                            $pt = mysqli_query($koneksi, "SELECT id, nama_pt, dirut_pt FROM pt");
                                                            while ($k = mysqli_fetch_array($pt)) {
                                                                $selected = ($k['id'] == $d['pt_id']) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?php echo $k['id']; ?>" data-dirut="<?php echo $k['dirut_pt']; ?>" <?php echo $selected; ?>><?php echo $k['nama_pt']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Dirut</label>
                                                        <input type="text" name="dirut_pt" id="dirut" class="form-control" readonly placeholder="Nama Dirut .." value="<?= $d['dirut_pt'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Perumahan</label>
                                                        <select name="perumahan_id" id="nama_perumahan" class="form-control">
                                                            <option value="">- Pilih -</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Alamat Perumahan</label>
                                                        <input type="text" name="alamat_perumahan" id="alamat_perumahan" class="form-control" readonly placeholder="Alamat Perumahan .." value="<?= $d['alamat_perumahan'] ?>">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Nama Bank</label>
                                                        <select name="rekening_id" id="nama_bank" class="form-control">
                                                            <option value="">- Pilih -</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Branch Manager</label>
                                                        <input type="text" id="branch_manager" name="branch_manager" class="form-control" placeholder="Branch Manager .." disabled value="<?= $d['branch_manager'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Atas Nama</label>
                                                        <input type="text" id="atas_nama" name="atas_nama" class="form-control" placeholder="Atas Nama .." disabled value="<?= $d['atas_nama'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No Rekening</label>
                                                        <input type="text" id="no_rekening" name="no_rekening" class="form-control" placeholder="No Rekening .." disabled value="<?= $d['no_rekening'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Harga Jual Rumah</label>
                                                        <input type="number" name="harga_jual_rumah" id="harga_jual_rumah" class="form-control" placeholder="Harga Jual Rumah .." value="<?= $d['harga_jual_rumah'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Uang Muka</label>
                                                        <input type="number" name="uang_muka" id="uang_muka" class="form-control" placeholder="Uang Muka .." value="<?= $d['uang_muka'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Plafon Kredit</label>
                                                        <input type="number" name="plafon_kredit" id="plafon_kredit" class="form-control" placeholder="Plafon Kredit .." readonly value="<?= $d['plafon_kredit'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Marketing </label>
                                                        <input type="text" name="marketing" class="form-control" placeholder="Marketing .." value="<?= $d['marketing'] ?>">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <?php
                                $desiredKeys = ['user_nama', 'user_username', 'kavling', 'tanggal_pendataan', 'luas_tanah', 'luas_rumah', 'tempat_lahir', 'tanggal_lahir', 'pekerjaan', 'jabatan', 'nik', 'alamat', 'no_hp', 'email', 'nama_pasangan', 'tempat_lahir_pasangan', 'tanggal_lahir_pasangan', 'pekerjaan_pasangan', 'nik_pasangan', 'alamat_pasangan', 'no_hp_pasangan', 'nama_instansi', 'alamat_instansi', 'no_hp_instansi', 'gaji', 'gaji_terbilang', 'no_npwp', 'nama_bank', 'branch_manager', 'atas_nama', 'no_rekening', 'nama_pt', 'dirut_pt', 'nama_perumahan', 'alamat_perumahan', 'harga_jual_rumah', 'uang_muka', 'plafon_kredit', 'marketing'];


                                ?>
                                <?php foreach ($desiredKeys as $desiredKey) : ?>
                                    <div class="col-16 col-sm-6 col-lg-4">
                                        <h4><?php echo ucwords(str_replace('_', ' ', $desiredKey)); ?></h4>
                                        <p><?php if ($desiredKey == 'nik' || $desiredKey == 'nik_pasangan') {
                                                echo $d[$desiredKey] ? decrypt($d[$desiredKey]) : "-";
                                            } else if ($desiredKey == 'luas_tanah' || $desiredKey == 'luas_rumah') {
                                                echo $d[$desiredKey] ? $d[$desiredKey] . 'M<sup>2</sup>' : "-";
                                            } else {
                                                echo $d[$desiredKey] ? $d[$desiredKey] : "-";
                                            }
                                            ?></p>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>
                    <div class="modal fade" id="hapus_nasabah_<?php echo $d['user_id']
                                                                ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <p>Yakin ingin menghapus data ini ?</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <a href="nasabah_hapus.php?user_id=<?php echo $d['user_id']
                                                                        ?>" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    <?php
    }
    ?>
</div>

<?php include 'footer.php'; ?>