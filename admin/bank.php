<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Bank
      <small>Data Bank</small>
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
            <h3 class="box-title">Data Bank</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Bank
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="Bank_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Bank</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="nama_bank" required="required" class="form-control" placeholder="Nama Bank ..">
                      </div>
                      <div class="form-group">
                        <label>Branch Manager</label>
                        <input type="text" name="branch_manager" required="required" class="form-control" placeholder="Branch Manager ..">
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
                    <th>NAMA BANK</th>
                    <th width="40%">BRANCH MANAGER</th>
                    <th width="14%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM bank ORDER BY id DESC");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_bank']; ?></td>
                      <td><?php echo $d['branch_manager']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_bank_<?php echo $d['id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="Bank_update.php" method="post">
                          <div class="modal fade" id="edit_bank_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Bank</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <input type="text" hidden value="<?php echo $d['id'] ?>" name="id" required="required">
                                  <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" value="<?php echo $d['nama_bank'] ?>" name="nama_bank" required="required" class="form-control" placeholder="Nama Bank ..">
                                  </div>
                                  <div class="form-group">
                                    <label>Branch Manager</label>
                                    <input type="text" value="<?php echo $d['branch_manager'] ?>" name="branch_manager" required="required" class="form-control" placeholder="Branch Manager ..">
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
                        <div class="modal fade" id="hapus_bank_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="Bank_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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