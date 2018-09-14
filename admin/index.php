<?php
session_start();

require_once('../config/config.php');
require_once('../config/database.php');
require_once('../fungsi/fungsi_situs.php');
require_once('../fungsi/aksi.php');

// Periksa kalo udah login
if (!isset($_SESSION['pengguna_id'])) {
    header('Location:' . $config['base_url']);
}

$data_situs = ambil_data_situs();
extract($data_situs);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $halaman_judul;?> | <?php echo $config['site_title'];?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../css/skin-blue.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../css/morris.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="../js/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="../js/bootstrap.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
</head>
<body class="skin-blue">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $config['base_url'];?>/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">APK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Aplikasi Peminjaman Kunci</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="<?php echo $config['base_url'];?>/admin">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span><?php echo $_SESSION['nama_lengkap'];?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo $config['base_url'];?>/logout.php"><i class="fa fa-gears"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $config['base_url'];?>/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama_lengkap'];?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php echo ($menu_aktif == 'home') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
        <li class="<?php echo ($menu_aktif == 'data_peminjaman_kunci') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=data_peminjaman_kunci"><i class="fa fa-table"></i> <span>Data Peminjaman Kunci</span></a></li>
        <li class="<?php echo ($menu_aktif == 'data_penggunaan_material') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=data_penggunaan_material"><i class="fa fa-table"></i> <span>Data Pengunaan Material</span></a></li>
        <li class="<?php echo ($menu_aktif == 'data_perusahaan') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=data_perusahaan"><i class="fa fa-table"></i> <span>Data Perusahaan</span></a></li>
        <li class="<?php echo ($menu_aktif == 'registrasi_peminjaman_kunci') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=registrasi_peminjaman_kunci"><i class="fa fa-edit"></i> <span>Registasi Peminjaman Kunci</span></a></li>
        <li class="<?php echo ($menu_aktif == 'registrasi_penggunaan_material') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=registrasi_penggunaan_material"><i class="fa fa-edit"></i> <span>Registrasi Penggunaan Material</span></a></li>
        <li class="<?php echo ($menu_aktif == 'registrasi_perusahaan') ? 'active' : '';?>"><a href="<?php echo $config['base_url'];?>/admin?lihat=registrasi_perusahaan"><i class="fa fa-edit"></i> <span>Registrasi Perusahaan</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $halaman_judul;?>
        <small><?php echo $halaman_deskripsi;?></small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if (isset($_SESSION['success_text'])): ?>
            <?php if(!empty($_SESSION['success_text'])):?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo implode('<br>', $_SESSION['success_text']);?>
            </div>
            <?php endif;?>
            <?php unset($_SESSION['success_text']);?>
        <?php endif;?>

        <?php if (isset($_SESSION['error_text'])):?>
            <?php if(!empty($_SESSION['error_text'])):?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?php echo implode('<br>', $_SESSION['error_text']);?>
                </div>
            <?php endif;?>
            <?php unset($_SESSION['error_text']);?>
        <?php endif;?>

        <?php include $file_konten;?>
    </section>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi</b> 0.0.1
    </div>
    <strong>Copyright &copy; 2018 <a href="<?php echo $config['base_url'];?>">Adi Hermawan</a>.</strong> All rights reserved.
  </footer>

</body>
</html>
