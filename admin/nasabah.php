<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
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

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Nasabah
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="nasabah_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Nasabah</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama ..">
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" required="required" class="form-control" placeholder="Username ..">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required="required" class="form-control" placeholder="Password ..">
                      </div>
                      <div class="form-group">
                        <label>Kavling</label>
                        <input type="text" name="kavling" required="required" class="form-control" placeholder="Kavling ..">
                      </div>
                      <div class="form-group">
                        <label>Tanggal Pendataan</label>
                        <input type="text" name="tanggal_pendataan" required="required" class="form-control datepicker2" placeholder="Tanggal Pendataan ..">
                      </div>
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" required="required" class="form-control" placeholder="Tempat Lahir ..">
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input autocomplete="off" type="text" name="tanggal_lahir" required="required" class="form-control datepicker2" placeholder="Tanggal Lahir">
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" required="required" class="form-control" placeholder="Pekerjaan ..">
                      </div>
                      <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" required="required" class="form-control" placeholder="Jabatan ..">
                      </div>
                      <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" required="required" class="form-control" placeholder="NIK ..">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat ..">
                      </div>
                      <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" required="required" class="form-control" placeholder="No HP ..">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required="required" class="form-control" placeholder="Email ..">
                      </div>
                      <div class="form-group">
                        <label>Nama Pasangan (Opsional)</label>
                        <input type="text" name="nama_pasangan" class="form-control" placeholder="Nama Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>Tempat Lahir Pasangan (Opsional)</label>
                        <input type="text" name="tempat_lahir_pasangan" class="form-control" placeholder="Tempat Lahir Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir Pasangan (Optinal)</label>
                        <input autocomplete="off" type="text" name="tanggal_lahir_pasangan" class="form-control datepicker2" placeholder="Tanggal Lahir Pasangan">
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan Pasangan (Opsional)</label>
                        <input type="text" name="pekerjaan_pasangan" class="form-control" placeholder="Pekerjaan Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>NIK Pasangan (Opsional)</label>
                        <input type="text" name="nik_pasangan" class="form-control" placeholder="NIK Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>Alamat Pasangan (Opsional)</label>
                        <input type="text" name="alamat_pasangan" class="form-control" placeholder="Alamat Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>No HP Pasangan (Opsional)</label>
                        <input type="text" name="no_hp_pasangan" class="form-control" placeholder="No HP Pasangan ..">
                      </div>
                      <div class="form-group">
                        <label>Nama Instansi</label>
                        <input type="text" name="nama_instansi" required="required" class="form-control" placeholder="Nama Instansi ..">
                      </div>
                      <div class="form-group">
                        <label>Alamat Instansi</label>
                        <input type="text" name="alamat_instansi" required="required" class="form-control" placeholder="Alamat Instansi ..">
                      </div>
                      <div class="form-group">
                        <label>No Pimpinan Instansi (Opsional)</label>
                        <input type="text" name="no_hp_instansi" class="form-control" placeholder="No HP Instansi ..">
                      </div>
                      <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="number" name="gaji" required="required" class="form-control" placeholder="Gaji Pokok ..">
                      </div>
                      <div class="form-group">
                        <label>Gaji Terbilang</label>
                        <input type="text" name="gaji_terbilang" required="required" class="form-control" placeholder="Gaji Terbilang ..">
                      </div>
                      <div class="form-group">
                        <label>No NPWP</label>
                        <input type="text" name="no_npwp" required="required" class="form-control" placeholder="No NPWP ..">
                      </div>

                      <div class="form-group">
                        <label>Nama Bank</label>
                        <select type="text" name="nama_bank" required="required" class="form-control" placeholder="Nama Bank ..">
                          <option value="">- Pilih -</option>
                          <option value="BJB">BJB</option>
                          <option value="BTN">BTN</option>
                          <option value="BTN SYARIAH">BTN SYARIAH</option>
                          <option value="BJB SYARIAH">BJB SYARIAH</option>
                          <option value="MANDIRI">MANDIRI</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Branch Manager</label>
                        <input type="text" name="branch_manager" required="required" class="form-control" placeholder="Branch Manager ..">
                      </div>

                      <div class="form-group">
                        <label>Nama Pengembang</label>
                        <select name="pt_id" id="nama_pengembang" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $pt = mysqli_query($koneksi, "SELECT id, nama_pt, dirut_pt FROM pt");
                          while ($k = mysqli_fetch_array($pt)) {
                          ?>
                            <option value="<?php echo $k['id']; ?>" data-dirut="<?php echo $k['dirut_pt']; ?>"><?php echo $k['nama_pt']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Nama Dirut</label>
                        <input type="text" name="dirut_pt" id="dirut" class="form-control" readonly placeholder="Nama Dirut ..">
                      </div>

                      <div class="form-group">
                        <label>Nama Perumahan</label>
                        <select name="perumahan_id" id="nama_perumahan" class="form-control" required="required" disabled>
                          <option value="">- Pilih -</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Alamat Perumahan</label>
                        <input type="text" name="alamat_perumahan" id="alamat_perumahan" class="form-control" readonly placeholder="Alamat Perumahan ..">
                      </div>




                      <div class="form-group">
                        <label>Harga Jual Rumah</label>
                        <input type="number" name="harga_jual_rumah" id="harga_jual_rumah" class="form-control" required="required" placeholder="Harga Jual Rumah ..">
                      </div>
                      <div class="form-group">
                        <label>Uang Muka</label>
                        <input type="number" name="uang_muka" id="uang_muka" class="form-control" required="required" placeholder="Uang Muka ..">
                      </div>
                      <div class="form-group">
                        <label>Plafon Kredit</label>
                        <input type="number" name="plafon_kredit" id="plafon_kredit" class="form-control" required="required" placeholder="Plafon Kredit .." readonly>
                      </div>
                      <div class="form-group">
                        <label>Marketing </label>
                        <input type="text" name="marketing" class="form-control" required="required" placeholder="Marketing ..">
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


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th width="20%">Kavling / No Rumah</th>
                    <th>NAMA</th>
                    <th width="15%">Alamat</th>
                    <th width="10%">NO HP</th>
                    <th width="10%">SALDO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT u.user_id, u.user_nama, n.kavling, n.alamat, n.no_hp, 
                          (SELECT SUM(nominal) FROM transaksi_akad WHERE nasabah_id = n.id AND jenis = 'Pemasukan') as pemasukan,
                          (SELECT SUM(nominal) FROM transaksi_akad WHERE nasabah_id = n.id AND jenis = 'Pengeluaran') as pengeluaran
                          FROM nasabah as n
                          JOIN user as u ON u.user_id = n.user_id");
                  while ($d = mysqli_fetch_array($data)) {
                    $saldo = $d['pemasukan'] - $d['pengeluaran'];
                  ?>
                    <tr>
                      <td><?php echo $no++;
                          ?></td>
                      <td><?php echo $d['kavling'];
                          ?></td>
                      <td><?php echo $d['user_nama'];
                          ?></td>
                      <td><?php echo $d['alamat'];
                          ?></td>
                      <td><?php echo $d['no_hp'];
                          ?></td>
                      <td><?php echo "Rp. " . number_format($saldo) . " ,-";
                          ?></td>
                      <td>
                        <a href="nasabah_detail.php?user_id=<?= $d['user_id'] ?>" type="button" class="btn btn-warning btn-sm">
                          <i class="fa fa-info-circle"></i>
                        </a>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_nasabah_<?php echo $d['user_id']
                                                                                                                            ?>">
                          <i class="fa fa-trash"></i>
                        </button>




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

                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>