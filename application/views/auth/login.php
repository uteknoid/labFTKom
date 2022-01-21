  <div class="container">
    <?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
    <style type="text/css">
      
      body {
        background-image: url("<?= base_url('assets/'); ?>img/bg.jpg");
  			background-size: cover;
  			background-repeat: no-repeat;
  			background-position: center;
  			background-attachment: fixed;
      }
      .qrcode{
        display: block;
        height: 3.5em;
        width: 100%;
        padding: 0.375rem .75rem;
        font-size: 0.8rem;
        font-weight: 400;
        line-height: 1.5;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 50px;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
    </style>

    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                  </div>

                  <?= $this->session->flashdata('message'); ?>

                  <form class="user" method="post" action="<?= base_url('auth/index_login'); ?>">
                    <div class="form-group">
                      <input type="number" class="form-control form-control-user" id="npm" name="npm" placeholder="NPM/NIP" value="<?= set_value('npm'); ?>">
                      <?= form_error('npm', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-user btn-block">
                      Masuk
                    </button>
                  </form>
                  <div class="text-center" style="margin: 0.8rem 0;">
                    <span align="center" class="small">atau</hr></span>
                  </div>
                  <button type="button" class="qrcode btn btn-success btn-user btn-block" data-toggle="modal" onclick="ShowCam()" data-target="#scan">Scan QR Code</button>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="#" data-toggle="modal" onclick="ShowCam()" data-target="#lupa">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth/'); ?>registration">Buat Akun Baru!</a>
                  </div>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script src="<?= base_url('assets/'); ?>js/jquery-3.4.1.min.js"></script>
  <script src="<?= base_url('assets/'); ?>scanner/vendor/modernizr/modernizr.js"></script>
  <script src="<?= base_url('assets/'); ?>scanner/vendor/vue/vue.min.js"></script>

  <style>
    .sidebar{ width: 350px; margin:auto; padding: 10px }
    .camera{ width: 610px; margin:auto; }
  </style>


  <div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Login via QR Code</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="app" class="row box">
            <div class="">
              <ul type="none" style="margin-left: -2rem;">
                <li v-if="cameras.length === 0" class="empty">No cameras found</li>
                <li v-for="camera in cameras">
                  <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active"><input type="radio" checked> {{ formatName(camera.name) }}</span>
                  <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                    <a @click.stop="selectCamera(camera)"> <input type="radio">@{{ formatName(camera.name) }}</a>
                  </span>
                </li>
              </ul>
              <div class="clearfix"></div>
              <form action="<?= base_url('auth/qrlogin'); ?>" method="POST" id="myForm" hidden>
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border"> Form Scan </legend>
                  <input type="text" name="code" id="code" autofocus>
                </fieldset>
              </form>
            </div>
            <div class="col-xs-12 preview-container camera">
              <video width="100%" id="preview" class="thumbnail"></video>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="lupa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Lupa Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row container">
            Silahkan Hubungi Admin Jika Anda Lupa Password!
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/'); ?>scanner/js/app.js"></script>
  <script src="<?= base_url('assets/'); ?>scanner/vendor/instascan/instascan.min.js"></script>
  <script src="<?= base_url('assets/'); ?>scanner/js/scanner.js"></script>
