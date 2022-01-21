<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Admin | <?php foreach ($option as $u) { echo $u->nama; } ?></title>


  <!-- Favicon  -->
  <link rel="icon" href="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; } ?>">

  <!-- Bootstrap Core CSS -->
  <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="<?= base_url('assets/'); ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?= base_url('assets/'); ?>dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="<?= base_url('assets/'); ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet">
      <style>
        body {
          background-image: url("<?= base_url('assets/'); ?>img/bg.jpg");
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;
          background-attachment: fixed;
        }
      </style>
    </head>

    <body>

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg">
                    <div class="p-5">
                      <div class="text-center">
                        <img src="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; }?>" width="70" height="70">
                        <b>
                          <h2>LOGIN</h2>
                        </b>
                        <h1><?php foreach ($option as $u) { echo $u->nama; } ?></h1>
                      </div>

                      <?= $this->session->flashdata('message'); ?>
                      <form action="<?= base_url('admin/login'); ?>" method="post">
                        <?= form_error('npm', '<small class="text-danger pl-3">', '</small>') ?>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="npm" name="npm" placeholder="NPM" value="<?= set_value('npm'); ?>" autofocusrequired>
                        </div>

                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                        <div class="form-group input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user fa-lock"></i></span>
                          </div>
                          <input type="text" class="form-control" type="password" id="password" name="password" placeholder="Password">
                        </div>

                        <!-- Change this to a button or input when using this as a form -->
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Masuk</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>