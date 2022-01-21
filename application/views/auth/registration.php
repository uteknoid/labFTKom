<div class="container">
  <style type="text/css">
    .form-pilih{
      display: block;
      width: 100%;
      height: calc(2.9em + .75rem + 2px);
      padding: 0.375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 50px;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
  </style>
  <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    <div class="card-body p-0">
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
            </div>
            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
              <div class="form-group">
                <input type="number" class="form-control form-control-user" id="npm" name="npm" placeholder="NPM" value="<?= set_value('npm'); ?>">
                <?= form_error('npm', '<small class="text-danger pl-3">', '</small>') ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                  <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                  <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="E-mail" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
              </div>
              <div class="form-group">
                <input type="number" class="form-control form-control-user" id="phone" name="phone" placeholder="Nomor HP" value="<?= set_value('phone'); ?>">
                <?= form_error('phone', '<small class="text-danger pl-3">', '</small>') ?>
              </div>
              <div class="form-group">
                <select class="form-pilih" name="role_id" id="role_id" required>
                  <option value="" selected disabled>Anda Adalah</option>
                  <option value="2">Dosen</option>
                  <option value="3">Mahasiswa</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success btn-user btn-block">
                Daftar
              </button>
            </form>
            <hr>
            <div class="text-center">
              Sudah Punya Akun? 
              <a class="small" href="<?= base_url('auth/index_login'); ?>">Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>