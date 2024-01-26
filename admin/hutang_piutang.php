<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Hutang - Piutang
      <small>Data Hutang - Piutang</small>
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
            <h3 class="box-title">Catatan Hutang - Piutang</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Hutang - Piutang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="hutang_piutang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Hutang - Piutang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal</label>
                                  <input type="hidden" name="id">
                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nominal</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                                </div>

                                
                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4" placeholder="Masukkan Keterangan .."></textarea>
                                </div>
                                
                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                  <label>Tipe</label><br>
                                  <select name="tipe" class="form-control" required="required" style="width: 100%;">
                                    <option value="KREDIT">KREDIT</option>
                                    <option value="DEBIT">DEBIT</option>
                                  </select>
                                </div>

                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                  <label>Status</label><br>
                                  <select name="status" class="form-control" required="required" style="width: 100%;">
                                    <option value="BELUM LUNAS">BELUM LUNAS</option>
                                    <option value="LUNAS">LUNAS</option>
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
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th width="30%" class="text-center">KETERANGAN</th>
                    <th class="text-center">KREDIT</th>
                    <th class="text-center">DEBIT</th>
                    <th width="10%" class="text-center">STATUS</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM hutang_piutang");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                      <td class="text-center"><?php echo $d['keterangan']; ?></td>
                      <td class="text-center"><?php echo $d['tipe'] == 'KREDIT' ? "Rp. ".number_format($d['nominal'])." ,-" : '-' ?></td>
                      <td class="text-center"><?php echo $d['tipe'] == 'DEBIT' ? "Rp. ".number_format($d['nominal'])." ,-" : '-' ?></td>
                      <td class="text-center"><?php echo $d['status']; ?></td>
                      <td>    

                       <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?php echo $d['id'] ?>">
                        <i class="fa fa-cog"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_<?php echo $d['id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


                      <form action="hutang_piutang_update.php" method="post">
                        <div class="modal fade" id="edit_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Edit Hutang - Piutang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal</label>
                                  <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['tanggal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nominal</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?= $d['nominal']; ?>">
                                </div>

                                
                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                <label>Keterangan</label>
                                <textarea name="keterangan" style="width:100%" class="form-control" rows="4" placeholder="Masukkan Keterangan .." ><?php echo $d['keterangan']; ?></textarea>
                                </div>
                                
                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                  <label>Tipe</label><br>
                                  <select name="tipe" class="form-control" required="required" style="width: 100%;">
                                    <option <?php $d['tipe'] == 'KREDIT' ? 'selected' : null ?> value="KREDIT">KREDIT</option> ?> value="KREDIT">KREDIT</option>
                                    <option <?php $d['tipe'] == 'DEBIT' ? 'selected' : null ?> value="DEBIT">DEBIT</option>
                                  </select>
                                </div>

                                <div class="form-group" style="width:100%; margin-top: 20px;">
                                  <label>Status</label><br>
                                  <select name="status" class="form-control" required="required" style="width: 100%;">
                                    <option <?= $d['status'] == 'BELUM LUNAS' ? 'selected' : null ?> value="BELUM LUNAS">BELUM LUNAS</option>
                                    <option <?= $d['status'] == 'LUNAS' ? 'selected' : null ?> value="LUNAS">LUNAS</option>
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
                      <div class="modal fade" id="hapus_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <p>Yakin ingin menghapus data ini ?</p>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <a href="hutang_piutang_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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