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
                        <select name="user_id" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $kategori = mysqli_query(
                            $koneksi,
                            "SELECT user_nama, u.user_id, u.user_level FROM user as u
                                      LEFT JOIN nasabah as n ON n.user_id = u.user_id 
                                      WHERE u.user_level = 'nasabah' AND n.user_id IS NULL
                                      ORDER BY u.user_id ASC"
                          );
                          while ($k = mysqli_fetch_array($kategori)) {
                          ?>
                            <option value="<?php echo $k['user_id']; ?>"><?php echo $k['user_nama']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nomor Rumah</label>
                        <input type="text" name="no_rumah" required="required" class="form-control" placeholder="Nomor Rumah ..">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat ..">
                      </div>
                      <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" required="required" class="form-control" placeholder="Nik ..">
                      </div>
                      <div class="form-group">
                        <label>NO HP</label>
                        <input type="text" name="no_hp" required="required" class="form-control" placeholder="No Hp ..">
                      </div>
                      <div class="form-group">
                        <label>NO HP 2 (OPSIONAL)</label>
                        <input type="text" name="no_hp_2" class="form-control" placeholder="No Hp ..">
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
                    <th width="8%">NO RUMAH</th>
                    <th>NAMA</th>
                    <th width="20%">ALAMAT RUMAH</th>
                    <th width="15%">NIK</th>
                    <th width="10%">NO HP</th>
                    <th width="10%">NO HP 2</th>
                    <th width="6%">OPSI</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query(
                    $koneksi,
                    "SELECT user_nama, no_rumah, alamat, nik, no_hp, no_hp_2, u.user_id FROM nasabah as n
                    JOIN user as u ON n.user_id = u.user_id 
                    ORDER BY u.user_id ASC"
                  );
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['no_rumah']; ?></td>
                      <td><?php echo $d['user_nama']; ?></td>
                      <td><?php echo $d['alamat']; ?></td>
                      <td><?php echo $d['nik']; ?></td>
                      <td><?php echo $d['no_hp']; ?></td>
                      <td><?php echo $d['no_hp_2'] ? $d['no_hp_2'] : "<p style='color: gray'>Tidak mengisi</p>" ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_nasabah_<?php echo $d['user_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_nasabah_<?php echo $d['user_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="nasabah_update.php" method="post">
                          <div class="modal fade" id="edit_nasabah_<?php echo $d['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <select name="user_id" class="form-control" required="required">
                                      <option value="<?php echo $d['user_id']; ?>"><?php echo $d['user_nama']; ?></option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Nomor Rumah</label>
                                    <input type="text" value="<?php echo $d['no_rumah'] ?>" name="no_rumah" required="required" class="form-control" placeholder="Nomor Rumah ..">
                                  </div>


                                  <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" value="<?php echo $d['alamat'] ?>" name="alamat" required="required" class="form-control" placeholder="Alamat ..">
                                  </div>

                                  <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" value="<?php echo $d['nik'] ?>" name="nik" required="required" class="form-control" placeholder="Nik ..">
                                  </div>

                                  <div class="form-group">
                                    <label>NO HP</label>
                                    <input type="text" value="<?php echo $d['no_hp'] ?>" name="no_hp" required="required" class="form-control" placeholder="No Hp ..">
                                  </div>

                                  <div class="form-group">
                                    <label>NO HP 2 (OPSIONAL)</label>
                                    <input type="text" value="<?php echo $d['no_hp_2'] ?>" name="no_hp_2" class="form-control" placeholder="No Hp ..">
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

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_nasabah_<?php echo $d['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="nasabah_hapus.php?user_id=<?php echo $d['user_id'] ?>" class="btn btn-primary">Hapus</a>
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