<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      PT
      <small>Data PT</small>
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
            <h3 class="box-title">Data PT</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah PT
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="pt_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah PT</h5>
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
                        <label>Alamat</label>
                        <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat ..">
                      </div>
                      <div class="form-group">
                        <label>Dirut</label>
                        <input type="text" name="dirut" required="required" class="form-control" placeholder="Dirut ..">
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
                    <th width="40%">ALAMAT</th>
                    <th width="20%">DIRUT</th>
                    <th width="15%">SALDO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT id, nama_pt, alamat_pt, dirut_pt,
                          (SELECT SUM(nominal) FROM transaksi_pt WHERE pt_id = p.id AND jenis = 'Pemasukan') as pemasukan,
                          (SELECT SUM(nominal) FROM transaksi_pt WHERE pt_id = p.id AND jenis = 'Pengeluaran') as pengeluaran
                          FROM pt as p");
                  while ($d = mysqli_fetch_array($data)) {
                    $saldo = $d['pemasukan'] - $d['pengeluaran'];
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_pt']; ?></td>
                      <td><?php echo $d['alamat_pt']; ?></td>
                      <td><?php echo $d['dirut_pt']; ?></td>
                      <td><?php echo "Rp. " . number_format($saldo) . " ,-" ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kategori_<?php echo $d['id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_<?php echo $d['id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="pt_update.php" method="post">
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
                                    <label>Nama</label>
                                    <input type="text" value="<?php echo $d['nama_pt'] ?>" name="nama_pt" required="required" class="form-control" placeholder="Nama ..">
                                  </div>
                                  <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" value="<?php echo $d['alamat_pt'] ?>" name="alamat_pt" required="required" class="form-control" placeholder="Alamat ..">
                                  </div>
                                  <div class="form-group">
                                    <label>Dirut</label>
                                    <input type="text" value="<?php echo $d['dirut_pt'] ?>" name="dirut_pt" required="required" class="form-control" placeholder="Dirut ..">
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
                                <a href="pt_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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