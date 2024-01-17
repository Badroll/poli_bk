<?php
require_once "_config/config.php";

if(!isset($_SESSION['user'])) {
    echo "<script>window.location='".base_url('auth/login')."';</script>";
    exit; // Hentikan eksekusi jika belum login
} 
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik - BK</title>
  <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/_assets/src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?=base_url()?>/_assets/src/assets/css/styles.min.css" />
</head>
<body>
    <script src="../_assets/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../_assets/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <div id="wrapper">
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
          <img src="../_assets/src/assets/images/logos/logo-pol.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php
          if (isset($_SESSION['user'])) {
              // Jika sudah login, tampilkan menu untuk pengguna yang sudah login
              ?>
              <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('dashboard')?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DAFTAR</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../obat/data_obat.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">DATA OBAT</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../pasien/data_pasien.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">DATA PASIEN</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../dokter/data_dokter.php" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">DATA DOKTER</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../poli/data_poli.php" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">DATA POLI</span>
              </a>
            </li>
          </ul>
              </nav>
              <?php
          } elseif (isset($_SESSION['dokter'])) {
              // Jika ada kondisi lain, tampilkan menu alternatif untuk kondisi tersebut
              ?>
              <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url('dashboard')?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DAFTAR</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="jadwal_periksa_dokter.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Jadwal Periksa</span>
              </a>
            </li>
          </ul>
              </nav>
              </nav>
              <?php
          } else {
              // Jika belum login dan tidak memenuhi kondisi lain, tampilkan menu alternatif
              ?>
              <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                  <!-- ... (your existing code for not logged-in users) ... -->
              </nav>
              <?php
          }
          ?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../_assets/src/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="<?=base_url('auth/logout.php')?>" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">