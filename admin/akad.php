<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Akad
      <small>Data Akad</small>
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
            <h3 class="box-title">Data Akad</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Akad
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="akad_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Akad</h5>
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
                            LEFT JOIN akad as a ON a.user_id = u.user_id 
                            WHERE u.user_level = 'nasabah' AND a.user_id IS NULL
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
                        <label>Status DP</label>
                        <select class="form-control" name="status_dp" required="required">
                          <option value=""> - Pilih Status DP - </option>
                          <option value="LUNAS"> LUNAS </option>
                          <option value="BELUM LUNAS"> BELUM LUNAS </option>
                        </select>
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
                    <th>NAMA</th>
                    <th width="40%">NO RUMAH</th>
                    <th width="20%">STATUS DP</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query(
                    $koneksi,
                    "SELECT u.user_id, u.user_nama, n.no_rumah, a.status_dp 
                    FROM user AS u
                    LEFT JOIN nasabah AS n ON u.user_id = n.user_id
                    LEFT JOIN akad AS a ON u.user_id = a.user_id
                    WHERE u.user_level = 'nasabah' AND a.user_id IS NOT NULL
                    ORDER BY u.user_id ASC"
                  );

                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['user_nama']; ?></td>
                      <td><?php echo $d['no_rumah'] ? $d['no_rumah'] : '-'; ?></td>
                      <td><?php echo $d['status_dp']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kategori_<?php echo $d['user_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_<?php echo $d['user_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="akad_update.php" method="post">
                          <div class="modal fade" id="edit_kategori_<?php echo $d['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah Akad</h5>
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
                                    <label>Status DP</label>
                                    <select class="form-control" name="status_dp" required="required" value="<?php echo $d['status_dp'] ?>">
                                      <option value=""> - Pilih Status DP - </option>
                                      <option <?= $d['status_dp'] == 'LUNAS' ? 'selected' : '' ?> value="LUNAS"> LUNAS </option>
                                      <option <?= $d['status_dp'] == 'BELUM LUNAS' ? 'selected' : '' ?> value="BELUM LUNAS"> BELUM LUNAS </option>
                                    </select>
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
                        <div class="modal fade" id="hapus_kategori_<?php echo $d['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="akad_hapus.php?user_id=<?php echo $d['user_id'] ?>" class="btn btn-primary">Hapus</a>
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