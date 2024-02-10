<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pakarangan Apps</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <link rel="apple-touch-icon" sizes="180x180" href="../gambar/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../gambar/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/favicon/favicon-16x16.png">
  <link rel="manifest" href="../gambar/favicon/site.webmanifest">

  <?php
  include '../koneksi.php';
  session_start();
  if ($_SESSION['status'] != "administrator_logedin") {
    header("location:../index.php?alert=belum_login");
  }
  ?>

</head>

<body class="hold-transition skin-black sidebar-mini">

  <style>
    #table-datatable {
      width: 100% !important;
    }

    #table-datatable .sorting_disabled {
      border: 1px solid #f4f4f4;
    }
  </style>
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b><i class="fa fa-money"></i></b> </span>
        <span class="logo-lg"><b>Pakarangan Apps</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                $id_user = $_SESSION['id'];
                $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
                $profil = mysqli_fetch_assoc($profil);
                if ($profil['user_foto'] == "") {
                ?>
                  <img src="../gambar/sistem/user.png" class="user-image">
                <?php } else { ?>
                  <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
              </a>
            </li>
            <li>
              <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            if ($profil['user_foto'] == "") {
            ?>
              <img src="../gambar/sistem/user.png" class="img-circle">
            <?php } else { ?>
              <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

          <li>
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li>
            <a href="kategori.php">
              <i class="fa fa-folder"></i> <span>DATA KATEGORI</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i>
              <span>TRANSAKSI</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="transaksi_umum.php"><i class="fa fa-circle-o"></i> Umum</a></li>
              <li><a href="transaksi_akad.php"><i class="fa fa-circle-o"></i> Akad</a></li>
              <li><a href="transaksi_pt.php"><i class="fa fa-circle-o"></i> PT</a></li>
            </ul>
          </li>

          <li>
            <a href="nasabah.php">
              <i class="fa fa-university"></i> <span>DATA NASABAH</span>
            </a>
          </li>

          <li>
            <a href="pt.php">
              <i class="fa fa-university"></i> <span>DATA PT</span>
            </a>
          </li>

          <li>
            <a href="perumahan.php">
              <i class="fa fa-home" aria-hidden="true"></i> <span>DATA PERUMAHAN</span>
            </a>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>DATA PENGGUNA</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="user.php"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>
              <li><a href="user_tambah.php"><i class="fa fa-circle-o"></i> Tambah Pengguna</a></li>
            </ul>
          </li>

          <li>
            <a href="laporan.php">
              <i class="fa fa-file"></i> <span>LAPORAN</span>
            </a>
          </li>

          <li>
            <a href="pemberkasan.php">
              <i class="fa fa-file"></i> <span>PEMBERKASAN</span>
            </a>
          </li>



          <li>
            <a href="gantipassword.php">
              <i class="fa fa-lock"></i> <span>GANTI PASSWORD</span>
            </a>
          </li>

          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>