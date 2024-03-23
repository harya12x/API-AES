<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="apple-touch-icon" href="<?= base_url();?>assets/img/favicon-apple.png">
      <link rel="icon" href="assets/img/Yayasan Ar-Rahmah.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="<?= base_url();?>assets/vendor/materializeicon/material-icons.css">

    <!-- animate CSS -->
    <link rel="stylesheet" href="<?= base_url();?>assets/vendor/animatecss/animate.css">
    <link id="theme" rel="stylesheet" href="<?= base_url();?>/assets/css/purplesidebar.css" type="text/css">
</head>
<?php
if($this->session->userdata('kode_petugas')) {
    redirect('/');
}
?>
<body class="fixed-header d-flex align-items-center" style="background: #22B07D">
    <div class="container">
        <div class="card mx-auto col-lg-5">
            <div class="container-md">
                <div class="card-body">
                    <form class="mt-3" method="post" action="<?= site_url('login');?>">
                        <div class="form-group" style="display:flex; justify-content:center;">
                            <img src="<?= base_url(); ?>/assets/img/Yayasan Ar-Rahmah.jpeg" alt="" width="110" height="80" srcset="">
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group mb-3">
                            <h4 class="text-center font-weight-light">Aplikasi Pengelolaan SPP</h4>
                        </div>
                        <div class="form-group ml-3 mr-3 was-validation" >
                            <label for="exampleInputUsername1">ID</label>
                            <input type="text" class="form-control" name="id" value="<?= set_value('id');?>" id="exampleInputUsername1" aria-describedby="emailHelp" >
                             <?= form_error('id','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ml-3 mr-3 has-validation">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" value="<?= set_value('password') ?>" id="exampleInputPassword1">
                             <?= form_error('password','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ml-3 mr-3">
                            <button type="submit" class="btn btn-block btn-success">Login</button>
                        </div>
                         <!-- <div class="form-group mb-3">
                            <h6 class="text-center font-weight-light">Belum memiliki akun?</h6>
                        </div>
                        <div class="form-group ml-3 mr-3">
                            <a href="<?= site_url('registrasi'); ?>" class="btn btn-block btn-primary">Registrasi</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url();?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>

    <!-- Cookie jquery file -->
    <script src="<?= base_url();?>/assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="<?= base_url();?>/assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="<?= base_url();?>/assets/vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Swiper carousel jquery file -->
    <script src="<?= base_url();?>/assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- Chart js jquery file -->
    <script src="<?= base_url();?>/assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url();?>/assets/vendor/chartjs/utils.js"></script>

    <!-- Footable jquery file -->
    <script src="<?= base_url();?>/assets/vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- datepicker jquery file -->
    <script src="<?= base_url();?>/assets/vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="<?= base_url();?>/assets/vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>

    <!-- jVector map jquery file -->
    <script src="<?= base_url();?>/assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="<?= base_url();?>/assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Bootstrap tour jquery file -->
    <script src="<?= base_url();?>/assets/vendor/bootstrap_tour/js/bootstrap-tour-standalone.min.js"></script>

    <!-- jquery toast message file -->
    <script src="<?= base_url();?>/assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="<?= base_url();?>/assets/js/main.js"></script>

    <!-- page specific script -->
</body>
</html>