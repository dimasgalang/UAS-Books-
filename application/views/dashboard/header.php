<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/4.3/examples/dashboard/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Project UAS</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <!-- arahkan url ke direktori 'assets' -->
<link href="<?php echo base_url();?>assets/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <!-- arahkan url ke direktori 'assets' -->
    <link href="<?php echo base_url();?>assets/dashboard.css" rel="stylesheet">
  <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo base_url();?>index.php/dashboard">Books Project</a>

  <!-- tampilkan fullname dari user yang sedang login -->
  <div class="w-100" style="margin-left: 25px; color: white;">Welcome, <?php echo $fullname; ?></div>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <!-- arahkan link ke kontroller 'dashboard/logout' -->
      <a class="nav-link" href="<?php echo site_url('dashboard/logout');?>">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <?php
  if ($_SESSION['role'] !== 'Admin'){
  ?>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/index' -->
            <a class="nav-link" href="<?php echo site_url('dashboard'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/books' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/books'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Data Buku
            </a>
          </li>
  <?php } else { ?>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/index' -->
            <a class="nav-link" href="<?php echo site_url('dashboard'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Dashboard
            </a>
          </li> 
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/books' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/users'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Data User
            </a>
          </li>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/books' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/kategori'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
              Data Kategori
            </a>
          </li>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/books' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/books'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Data Buku
            </a>
          </li>
  </ul>
  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Manage Data</span>
        </h6>
        <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/add' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/addusers'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
              Tambah Data User
            </a>
          </li>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/add' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/addkategori'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
              Tambah Data Kategori
            </a>
          </li>
          <li class="nav-item">
            <!-- arahkan link ke kontroller 'dashboard/add' -->
            <a class="nav-link" href="<?php echo site_url('dashboard/addbooks'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
              Tambah Data Buku
            </a>
          </li>
  <?php }?>
        </ul>

      </div>
    </nav>