<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Perumahan
      <small>Data Perumahan</small>
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
            <h3 class="box-title">Data Perumahan</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Perumahan
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="perumahan_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Perumahan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama PT</label>
                        <select name="pt_id" id="nama_pengembang" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $nasabah = mysqli_query($koneksi, "SELECT p.id, p.nama_pt FROM pt as p");
                          while ($k = mysqli_fetch_array($nasabah)) {
                          ?>
                            <option value="<?php echo $k['id']; ?>"><?php echo $k['nama_pt']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Nama Perumahan</label>
                        <input type="text" name="nama_perumahan" required="required" class="form-control" placeholder="Masukan Nama Perumahan ..">
                      </div>

                      <div class="form-group">
                        <label>Alamat Perumahan</label>
                        <input type="text" name="alamat_perumahan" required="required" class="form-control" placeholder="Masukan Alamat Perumahan ..">
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
                    <th>NAMA PT</th>
                    <th width="30%">NAMA PERUMAHAN</th>
                    <th width="30%">ALAMAT PERUMAHAN</th>
                    <th width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT pr.id, pr.pt_id, pr.nama_perumahan, pr.alamat_perumahan, p.nama_pt FROM perumahan as pr JOIN pt as p ON pr.pt_id = p.id");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_pt']; ?></td>
                      <td><?php echo $d['nama_perumahan']; ?></td>
                      <td><?php echo $d['alamat_perumahan']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kategori_<?php echo $d['id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_<?php echo $d['id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="perumahan_update.php" method="post">
                          <div class="modal fade" id="edit_kategori_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit PT</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <input type="text" hidden value="<?php echo $d['id'] ?>" name="id" required="required">
                                  <div class="form-group">
                                    <label>Nama PT</label>
                                    <select name="pt_id" id="nama_pengembang" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php
                                      $perumahan = mysqli_query($koneksi, "SELECT p.id, p.nama_pt FROM pt as p");
                                      while ($k = mysqli_fetch_array($perumahan)) {
                                      ?>
                                        <option value="<?php echo $k['id']; ?>" <?php echo ($k['id'] == $d['pt_id']) ? 'selected' : ''; ?>><?php echo $k['nama_pt']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Nama Perumahan</label>
                                    <input type="text" name="nama_perumahan" required="required" class="form-control" placeholder="Masukan Nama Perumahan .." value="<?php echo $d['nama_perumahan']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Alamat Perumahan</label>
                                    <input type="text" name="alamat_perumahan" required="required" class="form-control" placeholder="Masukan Alamat Perumahan .." value="<?= $d['alamat_perumahan'] ?>">
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
                        <div class="modal fade" id="hapus_kategori_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="perumahan_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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