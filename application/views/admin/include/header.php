<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Peminjaman Alat <?php foreach ($option as $u) { echo $u->nama; }?></title>
  <!-- Tell the browser to be responsive to screen width -->


  <!-- Favicon  -->
  <link rel="icon" href="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; } ?>">



  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index" class="brand-link">
          <img src="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; }?>" alt="Logo UNCP" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?php foreach ($option as $u) { echo $u->nama; }?></span>
        </a>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="<?= base_url('admin/pagelab'); ?>" class="nav-link<?php if($maktif == 'lab'){ echo ' active';}else{} ?>">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Penggunaan Lab
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/page'); ?>" class="nav-link<?php if($maktif == 'pinjam'){ echo ' active';}else{} ?>">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Peminjaman Alat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/ruangan'); ?>" class="nav-link<?php if($maktif == 'ruangan'){ echo ' active';}else{} ?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/alat'); ?>" class="nav-link<?php if($maktif == 'alat'){ echo ' active';}else{} ?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Alat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/user'); ?>" class="nav-link<?php if($maktif == 'user'){ echo ' active';}else{} ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?php if($maktif == 'saldom'){ echo ' active';}else if($maktif == 'saldok'){ echo ' active';}else{} ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Keuangan
              </p>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item<?php if($maktif == 'saldom'){ echo ' active';}else{} ?>" href="<?= base_url('admin/saldo_masuk'); ?>">Saldo Masuk</a>
              <a class="dropdown-item<?php if($maktif == 'saldok'){ echo ' active';}else{} ?>" href="<?= base_url('admin/pengeluaran'); ?>">Saldo Keluar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?php if($maktif == 'option1'){ echo ' active';}else if($maktif == 'option2'){ echo ' active';}else{} ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan
              </p>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item<?php if($maktif == 'option1'){ echo ' active';}else{} ?>" href="<?= base_url('admin/option'); ?>">Aplikasi</a>
              <a class="dropdown-item<?php if($maktif == 'option2'){ echo ' active';}else{} ?>" href="<?= base_url('admin/option_laporan'); ?>">Laporan</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Logout" untuk mengakhiri sesi anda. Dan Keluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('admin/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>