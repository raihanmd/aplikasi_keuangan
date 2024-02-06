<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi Umum
      <small>Data Transaksi Umum</small>
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
            <h3 class="box-title" style="margin-bottom: 2rem;">Transaksi Pemasukan & Pengeluaran</h3>
            <br />
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#transaksi_modal">
              <i class="fa fa-plus"></i> &nbsp Tambah Transaksi
            </button>
            <?php if (isset($_GET['query'])) : ?>
              <br />
              <br />
              <a href="transaksi_umum.php">
                <button type="button" class="btn btn-sm btn-success">KEMBALI</button>
              </a>
            <?php endif; ?>
            <form action="" method="get" class="form-inline pull-right">
              <div class="form-group">
                <label for="query">Pencarian:</label>
                <input type="text" class="form-control" name="query" id="query" placeholder="Masukkan kata kunci">
                <button type="submit" class="btn btn-default">Cari</button>
              </div>
            </form>
            <?php
            if (isset($_GET['alert'])) {
              if ($_GET['alert'] == 'gagal') {
            ?>
                <div class="alert alert-warning alert-dismissible" style="margin-top: 20px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                  Ekstensi Tidak Diperbolehkan
                </div>
              <?php
              } elseif ($_GET['alert'] == "berhasil") {
              ?>
                <div class="alert alert-success alert-dismissible" style="margin-top: 20px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success</h4>
                  Berhasil Disimpan
                </div>
              <?php
              } elseif ($_GET['alert'] == "berhasilupdate") {
              ?>
                <div class="alert alert-success alert-dismissible" style="margin-top: 20px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success</h4>
                  Berhasil Update
                </div>
            <?php
              }
            }
            ?>
          </div>

          <div class="box-body">


            <!-- Transaksi Modal -->
            <form action="transaksi_umum_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="transaksi_modal" tabindex="-1" role="dialog" aria-labelledby="transaksi_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="transaksi_modalLabel">Tambah Transaksi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <option value="Pemasukan">Pemasukan</option>
                          <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                          while ($k = mysqli_fetch_array($kategori)) {
                          ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" required></textarea>
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

              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="1%" rowspan="2">NO</th>
                    <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                    <th width="15%" rowspan="2" class="text-center">KATEGORI</th>
                    <th rowspan="2" class="text-center">KETERANGAN</th>
                    <th colspan="2" class="text-center">JENIS</th>
                    <th rowspan="2" width="12%" class="text-center">OPSI</th>
                  </tr>
                  <tr>
                    <th class="text-center">PEMASUKAN</th>
                    <th class="text-center">PENGELUARAN</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  // Proses pencarian
                  if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $data = mysqli_query($koneksi, "SELECT * FROM transaksi_umum, kategori WHERE kategori_id=transaksi_kategori AND (transaksi_keterangan LIKE '%$query%' OR kategori LIKE '%$query%') ORDER BY transaksi_id DESC");
                  } else {
                    $data = mysqli_query($koneksi, "SELECT * FROM transaksi_umum, kategori WHERE kategori_id=transaksi_kategori ORDER BY transaksi_id DESC");
                  }
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td><?php echo $d['transaksi_keterangan']; ?></td>
                      <td class="text-center">
                        <?php
                        if ($d['transaksi_jenis'] == "Pemasukan") {
                          echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                        } else {
                          echo "-";
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                        if ($d['transaksi_jenis'] == "Pengeluaran") {
                          echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                        } else {
                          echo "-";
                        }
                        ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['transaksi_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['transaksi_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>

                        <a href="transaksi_umum_xlsx.php?query=<?= $d['transaksi_keterangan'] ?>&jenis=satuan" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i></a>

                        <a href="transaksi_umum_print.php?query=<?= $d['transaksi_keterangan'] ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>



                        <form action="transaksi_umum_update.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit transaksi</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['transaksi_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Jenis</label>
                                    <select name="jenis" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <option <?php if ($d['transaksi_jenis'] == "Pemasukan") {
                                                echo "selected='selected'";
                                              } ?> value="Pemasukan">Pemasukan</option>
                                      <option <?php if ($d['transaksi_jenis'] == "Pengeluaran") {
                                                echo "selected='selected'";
                                              } ?> value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Kategori</label>
                                    <select name="kategori" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php
                                      $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                                      while ($k = mysqli_fetch_array($kategori)) {
                                      ?>
                                        <option <?php if ($d['transaksi_kategori'] == $k['kategori_id']) {
                                                  echo "selected='selected'";
                                                } ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Nominal</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['transaksi_nominal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Keterangan</label>
                                    <textarea required name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['transaksi_keterangan'] ?></textarea>
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

                        <div class="modal fade" id="lihat_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Lihat Bukti Upload</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <embed src="../gambar/bukti/<?php echo $d['transaksi_foto']; ?>" type="application/pdf" width="100%" height="400px" />
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="transaksi_umum_hapus.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Hapus</a>
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