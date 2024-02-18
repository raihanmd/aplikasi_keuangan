<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Rekening PT
      <small>Data Rekening PT</small>
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
            <h3 class="box-title">Data Rekening PT</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Rekening PT
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="rekening_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening PT</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama PT</label>
                        <select name="pt_id" id="nama_pengembang_rekening" class="form-control" required="required">
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
                        <label>Nama Bank</label>
                        <select name="bank_id" id="nama_bank_rekening" class="form-control" disabled>
                          <option value="">- Pilih -</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" required="required" class="form-control" placeholder="Atas Nama ..">
                      </div>
                      <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" name="no_rekening" required="required" class="form-control" placeholder="No Rekening ..">
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
                    <th width="10%">NAMA BANK</th>
                    <th width="20%">A/N</th>
                    <th width="25%">NO REKENING</th>
                    <th width="14%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query(
                    $koneksi,
                    "SELECT r.id, r.atas_nama, r.no_rekening, b.nama_bank, b.id AS bank_id, p.id AS pt_id, p.nama_pt FROM rekening AS r 
                    JOIN bank AS b ON r.bank_id = b.id
                    JOIN pt AS p ON r.pt_id = p.id
                    ORDER BY p.nama_pt ASC"
                  );
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_pt']; ?></td>
                      <td><?php echo $d['nama_bank']; ?></td>
                      <td><?php echo $d['atas_nama']; ?></td>
                      <td><?php echo $d['no_rekening']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_Rekening_<?php echo $d['id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_Rekening_<?php echo $d['id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="rekening_update.php" method="post">
                          <div class="modal fade" id="edit_Rekening_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Rekening PT</h5>
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
                                      $pt = mysqli_query($koneksi, "SELECT p.id, p.nama_pt FROM pt as p");
                                      while ($k = mysqli_fetch_array($pt)) {
                                      ?>
                                        <option value="<?php echo $k['id']; ?>" <?php echo ($k['id'] == $d['pt_id']) ? 'selected' : ''; ?>><?php echo $k['nama_pt']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Nama Bank</label>
                                    <select name="bank_id" id="nama_bank" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php
                                      $bank = mysqli_query($koneksi, "SELECT b.id, b.nama_bank FROM bank as b");
                                      while ($k = mysqli_fetch_array($bank)) {
                                      ?>
                                        <option value="<?php echo $k['id']; ?>" <?php echo ($k['id'] == $d['bank_id']) ? 'selected' : ''; ?>><?php echo $k['nama_bank']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Atas Nama</label>
                                    <input type="text" name="atas_nama" value="<?php echo $d['atas_nama']; ?>" required="required" class="form-control" placeholder="Atas Nama ..">
                                  </div>
                                  <div class="form-group">
                                    <label>No Rekening</label>
                                    <input type="text" name="no_rekening" value="<?php echo $d['no_rekening']; ?>" required="required" class="form-control" placeholder="No Rekening ..">
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
                        <div class="modal fade" id="hapus_Rekening_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="rekening_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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