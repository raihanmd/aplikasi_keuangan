<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">

    <div class="row">

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-blue"><i class="fa fa-line-chart"></i></span>
          <div class="">
            <span class="info-box-text">Pemasukan Hari ini</span>
            <?php
            $tanggal = date('Y-m-d');
            $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi_umum WHERE transaksi_jenis='Pemasukan' and transaksi_tanggal='$tanggal'");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-green"><i class="fa fa-line-chart"></i></span>
          <div class="">
            <span class="info-box-text">Pemasukan Bulan Ini</span>
            <?php
            $bulan = date('m');
            $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi_umum WHERE transaksi_jenis='Pemasukan' and month(transaksi_tanggal)='$bulan'");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-orange"><i class="fa fa-tags"></i></span>
          <div class="">
            <span class="info-box-text">Total Hutang</span>
            <?php
            $total_hutang = mysqli_query($koneksi, "SELECT sum(nominal) as total_hutang FROM hutang_piutang WHERE tipe='KREDIT' AND status='BELUM LUNAS'");
            $p = mysqli_fetch_assoc($total_hutang);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_hutang']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-yellow"><i class="fa fa-arrow-down"></i></span>
          <div class="">
            <span class="info-box-text">Pengeluaran Hari Ini</span>
            <?php
            $tanggal = date('Y-m-d');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi_umum WHERE transaksi_jenis='pengeluaran' and transaksi_tanggal='$tanggal'");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-red"><i class="fa fa-arrow-down"></i></span>
          <div class="">
            <span class="info-box-text">Pengeluaran Bulan Ini</span>
            <?php
            $bulan = date('m');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi_umum WHERE transaksi_jenis='pengeluaran' and month(transaksi_tanggal)='$bulan'");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-info bg-teal"><i class="fa fa-tags"></i></span>
          <div class="">
            <span class="info-box-text">Total Piutang</span>
            <?php
            $total_piutang = mysqli_query($koneksi, "SELECT sum(nominal) as total_piutang FROM hutang_piutang  WHERE tipe='DEBIT' AND status='BELUM LUNAS'");
            $p = mysqli_fetch_assoc($total_piutang);
            ?>
            <span class="info-box-number"><?php echo "Rp. " . number_format($p['total_piutang']) . " ,-" ?></span>
            <a href="#">Lebih lanjut...</a>
          </div>
        </div>
      </div>

    </div>















    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <!-- Left col -->
      <section class="col-lg-12">

        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs pull-right">
            <!-- <li><a href="#tab2" data-toggle="tab">Pemasukan</a></li> -->
            <li class="active"><a href="#tab1" data-toggle="tab">Pemasukan & Pengeluaran</a></li>
            <li class="pull-left header">Grafik</li>
          </ul>

          <div class="tab-content" style="padding: 20px">

            <div class="chart tab-pane active" id="tab1">


              <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Bulan</b></h4>
              <canvas id="grafik1" style="position: relative; height: 300px;"></canvas>

              <br />
              <br />
              <br />

              <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Tahun</b></h4>
              <canvas id="grafik2" style="position: relative; height: 300px;"></canvas>

            </div>
          </div>

        </div>

      </section>
      <!-- /.Left col -->


      <!-- right col -->
    </div>
    <!-- /.row (main row) -->










  </section>

</div>

















<?php include 'footer.php'; ?>