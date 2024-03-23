<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
      <!-- favicons -->
      <link rel="apple-touch-icon" href="<?= base_url();?>/assets/img/favicon-apple.png">
      <link rel="icon" href="<?= base_url();?>assets/img/Yayasan Ar-Rahmah.jpeg">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <!-- <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"> -->
      <!-- Material design icons CSS -->
      <link rel="stylesheet" href="<?= base_url();?>assets/vendor/materializeicon/material-icons.css">
      <!-- footable CSS -->
      <link rel="stylesheet" href="<?= base_url();?>assets/vendor/footable-bootstrap/css/footable.bootstrap.min.css">
      <!-- jvector map CSS -->
      <link rel="stylesheet" href="<?= base_url();?>assets/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
      <link href="https://cdn.jsdelivr.net/npm/intro.js@7.0.1/minified/introjs.min.css" rel="stylesheet">
      <!-- app CSS -->
      <link id="theme" rel="stylesheet" href="<?= base_url();?>/assets/css/dark-greensidebar.css" type="text/css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <title>SPP Web</title>
   </head>
   <body class="fixed-header sidebar-right-close">
   <?php
    if(!$this->session->userdata('kode_petugas')) {
        redirect('login');
    }
   ?>
         <!-- main header -->
         <header class="main-header">
            <div class="container-fluid">
               <nav >
                  <div class="row justify-content-between align-items-center">
                     <div class="col-auto pl-0">
                        <button style="width:10vw;" class="btn success-gradient btn-icon" id="left-menu"><img class="img-fluid" height="40" width="60" src="<?= base_url();?>/assets/img/Yayasan Ar-Rahmah.jpeg" alt=""></button>
                        <a href="<?= base_url('/');?>" class="logo"><span class="text-hide-xs">Yayasan Islam Rahmatan Lil Alamin</span></a>
                     </div>

                     <div class="col-auto pr-0 d-flex align-items-center">             
                        <div class="dropdown guide">
                           <button class="btn  dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="material-icons icon ">help_outline</i></button>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item about">Tentang Aplikasi</a></li>
                              <li><a class="dropdown-item using">Cara Menggunakan Aplikasi</a></li>
                           </ul>
                        </div>
                        <div class="dropdown info">
                           <a class="btn header-color-secondary dropdown-toggle username" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <figure class="userpic"><img src="<?=base_url();?>/assets/img/user.png" alt=""></figure>
                              <h5 class="text-hide-xs">
                                 <small class="header-color-secondary">Welcome,</small>
                                 <span class="header-color-success"><?= $name; ?></span>
                              </h5>
                           </a>
                           <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="dropdownMenuLink">
                              <a href="<?= base_url(''); ?>pages/halamanadmin" class="dropdown-item">
                                 <div class="row align-items-center">
                                    <div class="col">
                                       Informasi
                                    </div>
                                    <div class="col-auto">
                                       <div class="text-danger ml-2">
                                          <i class="material-icons icon">person</i>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                              <div class="dropdown-divider m-0"></div>
                              <a class="dropdown-item" href="<?= base_url('User/logout'); ?>">
                                 <div class="row align-items-center">
                                    <div class="col">
                                       Logout
                                    </div>
                                    <div class="col-auto">
                                       <div class="text-danger ml-2">
                                          <i class="fa-solid fa-right-from-bracket"></i>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>
         </header>
         <!-- main header ends -->
      <div class="wrapper">
         <!-- sidebar left -->
         <div class="sidebar sidebar-left" style="background: #22B07D;">
            <ul class="nav flex-column">
               <li class="nav-item">
                  <a href="<?= base_url(); ?>" class="nav-link dropdwown-toggle "> <i class="material-icons icon">dashboard</i> <span>Dashboard</span></a>
               </li>
               <p class="ml-3 mt-3 mb-2 pt-2 pb-2 border-bottom border-top ">Menu</p>
               <li class="nav-item master-data">
                  <a href="javascript:void(0);" class="nav-link master-data-nav dropdwown-toggle"> <i class="material-icons icon">folder</i> <span>Master Data</span><i class="material-icons icon arrow">expand_more</i></a>
                  <ul class="nav flex-column master-data-ul">
                     <li class="nav-item instansi">
                        <a href="<?= base_url('pages/datainstansi/'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">inbox</i> <span>Data Instansi</span> </a>
                     </li>
                     <li class="nav-item kelas">
                        <a href="<?= base_url('pages/datakelas/'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">group</i> <span>Data Kelas</span> </a>
                     </li>
                     <li class="nav-item tahunakademik">
                        <a href="<?= base_url('pages/datatahunakademik'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">date_range</i> <span>Data Tahun Akademik</span> </a>
                     </li>
                     <li class="nav-item siswa">
                        <a href="<?= base_url('pages/datasiswa'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">person</i> <span>Data Siswa</span></a>
                     </li>
                     <li class="nav-item admin">
                        <a href="<?= base_url(''); ?>pages/dataadmin" class="nav-link success-gradient-active"><i class="material-icons icon">person_outline</i> <span>Data Admin</span></a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item transaksi">
                  <a href="javascript:void(0);" class="nav-link dropdwown-toggle transaksi-nav"> <i class="material-icons icon">folder</i> <span>Transaksi</span><i class="material-icons icon arrow">expand_more</i></a>                  
                  <ul class="nav flex-column transaksi-ul">
                     <li class="nav-item biaya">
                        <a href="<?= base_url('pages/databiaya'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">attach_money</i> <span>Data Biaya</span></a>
                     </li>
                     <li class="nav-item transaksi">
                        <a href="<?= base_url('pages/datatransaksihome'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">credit_card</i> <span>Data Transaksi</span> </a>
                     </li>                     
                     <!-- <li class="nav-item pengeluaran">
                        <a href="<?= base_url('pages/datapengeluaran'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">credit_card</i> <span>Data Pengeluaran</span> </a>
                     </li>                      -->
                  </ul>
               </li>
               <li class="nav-item nonaktif">
                  <a href="javascript:void(0);" class="nav-link dropdwown-toggle nonaktif-nav"> <i class="material-icons icon">folder</i> <span>Data Nonaktif</span><i class="material-icons icon arrow">expand_more</i></a>                  
                  <ul class="nav flex-column nonaktif-ul">
                  <li class="nav-item instansi">
                        <a href="<?= base_url('pages/datanonaktifinstansi'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">inbox</i> <span>Data Instansi</span> </a>
                     </li>
                     <li class="nav-item kelas">
                        <a href="<?= base_url('pages/datanonaktifkelas'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">group</i> <span>Data Kelas</span> </a>
                     </li>
                     <li class="nav-item siswa">
                        <a href="<?= base_url('pages/datanonaktifsiswa'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">person</i> <span>Data Siswa</span></a>
                     </li>
                     <li class="nav-item admin">
                        <a href="<?= base_url('pages/datanonaktifadmin'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">person_outline</i> <span>Data Admin</span></a>
                     </li>
                     <li class="nav-item biaya">
                        <a href="<?= base_url('pages/datanonaktifbiaya'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">attach_money</i> <span>Data Biaya</span></a>
                     </li>                
                     <!-- <li class="nav-item pengeluaran">
                        <a href="<?= base_url('pages/datanonaktifpengeluaran'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">attach_money</i> <span>Data Pengeluaran</span></a>
                     </li>                 -->
                  </ul>
               </li>
            </ul>
         </div>
         <!-- sidebar left ends -->
         
         <!-- content page title --> 
            <div class="container-fluid bg-light-opac">
               <div class="row">
                  <div class="container-fluid my-3 main-container">
                     <div class="row">
                        <div class="col">
                           <h2 class="content-color-success page-title"><?= $title;?></h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- content page title ends -->