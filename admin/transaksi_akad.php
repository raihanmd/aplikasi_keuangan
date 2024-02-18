<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi Akad
      <small>Data Transaksi Akad</small>
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
              <a href="transaksi_akad.php">
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
            <form action="transaksi_akad_act.php" method="post" enctype="multipart/form-data">
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
                        <label>Nama</label>
                        <select name="nasabah_id" id="nama_pengembang" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php
                          $nasabah = mysqli_query($koneksi, "SELECT n.id, u.user_nama FROM nasabah as n JOIN user as u ON u.user_id = n.user_id");
                          while ($k = mysqli_fetch_array($nasabah)) {
                          ?>
                            <option value="<?php echo $k['id']; ?>"><?php echo $k['user_nama']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2" placeholder="Masukan Tanggal ..">
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
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>


                      <div class="form-group" style="width:100%; margin-top: 20px;">
                        <label>Status</label><br>
                        <select name="status" class="form-control" required="required" style="width: 100%;">
                          <option value="BELUM LUNAS">BELUM LUNAS</option>
                          <option value="LUNAS">LUNAS</option>
                        </select>
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
                    <th width="1%">NO</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th class="text-center">NAMA</th>
                    <th width="15%" class="text-center">KETERANGAN</th>
                    <th width="12%" class="text-center">KREDIT</th>
                    <th width="12%" class="text-center">DEBIT</th>
                    <th width="10%" class="text-center">STATUS</th>
                    <th width="8%" class="text-center">OPSI</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $data = mysqli_query($koneksi, "SELECT u.user_nama, t.*, n.user_id FROM transaksi_akad as t JOIN nasabah as n ON t.nasabah_id = n.id JOIN user as u ON n.user_id = u.user_id WHERE keterangan LIKE '%$query%' ORDER BY t.tanggal DESC");
                  } else {
                    $data = mysqli_query($koneksi, "SELECT u.user_nama, t.*, n.user_id FROM transaksi_akad as t JOIN nasabah as n ON t.nasabah_id = n.id JOIN user as u ON n.user_id = u.user_id ORDER BY t.tanggal DESC");
                  }
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                      <td><?php echo $d['user_nama']; ?></td>
                      <td><?php echo $d['keterangan']; ?></td>
                      <td class="text-center"><?php echo $d['jenis'] == 'Pemasukan' ? "Rp. " . number_format($d['nominal']) . " ,-" : '-' ?></td>
                      <td class="text-center"><?php echo $d['jenis'] == 'Pengeluaran' ? "Rp. " . number_format($d['nominal']) . " ,-" : '-' ?></td>
                      <td class="text-center"><?php echo $d['status']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>

                        <!-- <a href="transaksi_akad_xlsx.php?query=<?php // $d['keterangan'] 
                                                                    ?>&jenis=satuan" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i></a>

                        <a href="transaksi_akad_print.php?query=<?php // $d['keterangan'] 
                                                                ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a> -->



                        <form action="transaksi_akad_update.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_transaksi_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit transaksi</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                  <div class="form-group">
                                    <label>Nama</label>
                                    <select name="nasabah_id" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php
                                      $nasabah = mysqli_query($koneksi, "SELECT n.id, u.user_nama FROM nasabah as n JOIN user as u ON u.user_id = n.user_id");
                                      while ($k = mysqli_fetch_array($nasabah)) {
                                      ?>
                                        <option value="<?php echo $k['id']; ?>" <?php echo ($k['id'] == $d['nasabah_id']) ? 'selected' : ''; ?>><?php echo $k['user_nama']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal" required="required" class="form-control datepicker2" placeholder="Masukan Tanggal .." value="<?php echo $d['tanggal']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="jenis" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <option value="Pemasukan" <?php echo ($d['jenis'] == 'Pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                                      <option value="Pengeluaran" <?php echo ($d['jenis'] == 'Pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['nominal']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Status</label><br>
                                    <select name="status" class="form-control" required="required">
                                      <option value="BELUM LUNAS" <?php echo ($d['status'] == 'BELUM LUNAS') ? 'selected' : ''; ?>>BELUM LUNAS</option>
                                      <option value="LUNAS" <?php echo ($d['status'] == 'LUNAS') ? 'selected' : ''; ?>>LUNAS</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3" required><?php echo $d['keterangan']; ?></textarea>
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
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="transaksi_akad_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
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