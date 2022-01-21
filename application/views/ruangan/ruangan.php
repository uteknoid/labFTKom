<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Favicon  -->
  <link rel="icon" href="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; } ?>">

  <meta charset="utf-8">
  <meta http-equiv="refresh" content="30">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="DESCription" content="">
  <meta name="author" content="">

  <title><?php foreach ($option as $u) { echo $u->nama; }?></title>

  <!-- Custom Fonts -->
  <link href="<?= base_url('assets/'); ?>login/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>login/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
        body {
          background-image:url("<?= base_url('assets/'); ?>img/bg.jpg"); background-size:cover; 
          background-attachment: fixed;

        }
        .labku{
          position: absolute;
          border-radius: 24px;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);

        }
        .foot{
          background: #ffffff;
          border-top: 1px solid #dee2e6;
          color: #869099;
          -webkit-transform: translate(0, 0);
          transform: translate(0, 0);
          margin-left: 0 !important;
          min-height: 0 !important;
          bottom: 0;
          left: 0;
          position: static;
          right: 0;
          z-index: 1032;
          transition: none !important;
          padding: 1rem;
        }
      </style> 
    </head>

    <body>
     <div class="conten">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="panel-heading"><center>
            <img src="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; }?>" width="70" height="70"><br>
            <h3 class="panel-title"><b><?php foreach ($option as $u) { echo $u->nama; }?></b></h3></center>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <div class="container">
        <div class="row" style="justify-content: center;">
          <section class="col-lg-12 center">
            <!-- Map card -->
            <div class="card bg-gradient" style="background: rgba(0, 125, 255, 0.5);">

              <div class="card-body">



                <div style="height: 58px; width: 100%; vertical-align: middle;"> 
                 <div class="labku">
                  <?php 
                  date_default_timezone_set("Asia/Makassar");
                  $tz_time = date("F j, Y h:i:s A");
                  ?>
                  <center><h1><b><font color="yellow" size="50em"><p id="clock" style="-webkit-text-stroke: 1.5px red; border-radius: 5px;"> </p></font></b></h1></center>

                  <script type="text/javascript">
                        var currenttime = '<?php echo $tz_time;?>'; // Timestamp of the timezone you want to use, in this case, it's server time
                        var servertime=new Date(currenttime);
                        function padlength(l){
                          var output=(l.toString().length==1)? "0"+l : l;
                          return output;
                        }
                        function digitalClock(){
                          servertime.setSeconds(servertime.getSeconds()+1);
                          var timestring=padlength(servertime.getHours())+":"+padlength(servertime.getMinutes())+":"+padlength(servertime.getSeconds());
                          document.getElementById("clock").innerHTML=timestring;
                        }
                        window.onload=function(){
                          setInterval("digitalClock()", 1000);
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->

            </section>
          </div>
        </div>
        <div class="container">
          <div class="row">

            <section class="col-lg-6 connectedSortable">
              <!-- Map card -->
              <div class="card bg-gradient-primary">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-university mr-1"></i>
                    Laboratorium 1
                  </h3>
                </div>
                <div class="card-body">
                  <div style="height: 195px; width: 100%; vertical-align: middle;"> 
                   <div class="labku">
                     <?php
                     if (is_array($lab1) && count($lab1) > 0) {
                     foreach($lab1 as $row){ ?>
                     <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
                      <?php
                    }
                  }else { ?>
                  <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
                  <?php } ?> 
                </div>
              </div>
            </div>
            <!-- /.card-body-->
          </div>
          <!-- /.card -->


          <!-- Map card -->
          <div class="card bg-gradient-primary">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-university mr-1"></i>
                Laboratorium 3
              </h3>
            </div>
            <div class="card-body">
              <div style="height: 195px; width: 100%;"> 
               <div class="labku">
                 <?php
                 if (is_array($lab3) && count($lab3) > 0) {
                 foreach($lab2 as $row){ ?>
                 <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
                  <?php
                }
              }else { ?>
              <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->

      <!-- Map card -->
      <div class="card bg-gradient-primary">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-university mr-1"></i>
            Laboratorium 5
          </h3>
        </div>
        <div class="card-body">
          <div style="height: 195px; width: 100%;"> 
           <div class="labku">
             <?php
             if (is_array($lab5) && count($lab5) > 0) {
             foreach($lab2 as $row){ ?>
             <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
              <?php
            }
          }else { ?>
          <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- /.card-body-->
  </div>
  <!-- /.card -->


</section>

<section class="col-lg-6 connectedSortable">

  <!-- Map card -->
  <div class="card bg-gradient-primary">
    <div class="card-header border-0">
      <h3 class="card-title">
        <i class="fas fa-university mr-1"></i>
        Laboratorium 2
      </h3>
    </div>
    <div class="card-body">
      <div style="height: 195px; width: 100%;"> 
       <div class="labku">
         <?php
         if (is_array($lab2) && count($lab2) > 0) {
         foreach($lab2 as $row){ ?>
         <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
          <?php
        }
      }else { ?>
      <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
      <?php } ?>
    </div>
  </div>
</div>
<!-- /.card-body-->
</div>
<!-- /.card -->
<!-- Map card -->
<div class="card bg-gradient-primary">
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-university mr-1"></i>
      Laboratorium 4
    </h3>
  </div>
  <div class="card-body">
    <div style="height: 195px; width: 100%;"> 
     <div class="labku">
       <?php
       if (is_array($lab4) && count($lab4) > 0) {
       foreach($lab2 as $row){ ?>
       <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
        <?php
      }
    }else { ?>
    <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
    <?php } ?>
  </div>
</div>
</div>
<!-- /.card-body-->
</div>
<!-- /.card -->
<!-- Map card -->
<div class="card bg-gradient-primary">
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-university mr-1"></i>
      Laboratorium 6
    </h3>
  </div>
  <div class="card-body">
    <div style="height: 195px; width: 100%;"> 
     <div class="labku">
       <?php
       if (is_array($lab6) && count($lab6) > 0) {
       foreach($lab2 as $row){ ?>
       <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="yellow"><b> <?php echo $row->jam_akhir; ?></b></font><h2></b></center>
        <?php
      }
    }else { ?>
    <center><h2><b><font color="yellow"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
    <?php } ?>
  </div>
</div>
</div>
<!-- /.card-body-->
</div>
<!-- /.card -->

</section>
</div>
</div>
</div>
<!-- /.content-wrapper -->
<footer class="foot">
  Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php foreach ($option as $u) { echo $u->nama; }?></a>
  <div class="float-right d-none d-sm-inline-block">
    Support by: <a href="kelompok8" style="text-decoration:none" target="_blank"><font color="#f87217">UTeknoID</font>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>login/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>login/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>login/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/'); ?>login/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/'); ?>login/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/'); ?>login/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/'); ?>login/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/'); ?>login/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/'); ?>login/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>login/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>login/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/'); ?>login/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>login/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>login/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/'); ?>login/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/'); ?>login/dist/js/demo.js"></script>

</body>

</html>



