<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">


      <div id="page-wrapper">

        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $message = $_GET['msg'];

        $npmadmin = $this->session->userdata('npm');

        if ($message == 'success') {
          ?>
          <div class="alert alert-success">Berhasil</div>
        <?php } else if ($message == 'failed') { ?>
          <div class="alert alert-warning">Error</div>
        <?php } ?>

        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser"><i class="fa fa-user fa-plus-circle"></i> Tambah User</button>

                <a href="<?php echo base_url() . 'admin/user_print'; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>
              </div>
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NPM / NIM</th>
                      <th>Nama Lengkap</th>
                      <th>Email</th>
                      <th>No.HP</th>
                      <th>Level</th>
                      <th>QR Code</th>
                      <th>Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($users as $u) {
                      ?>
                      <tr class="<?php if ($i % 2 == 0) {
                        echo "odd";
                        } else {
                          echo "even";
                        } ?>">
                        <td><?php echo $i; ?></td>
                        <td> <?php echo $u->npm ?> </td>
                        <td><?php echo $u->name ?></td>
                        <td><?php echo $u->email ?></td>
                        <td><?php echo $u->hp ?></td>
                        <td><?php
                        if ($u->role_id == 1) {
                          echo 'Admin';
                        } else if($u->role_id == 2) {
                          echo 'Dosen';
                        } else {
                          echo 'Mahasiswa';
                        }
                        ?></td>
                        <td align="center"> <a href="<?php echo base_url('assets/img/qr/'); echo $u->npm ?>.png" target="_blank"><img src="<?php echo base_url('assets/img/qr/'); echo $u->npm ?>.png" alt="Lihat" width="80rem"></a> </td>
                        <td><?php if($u->is_active == 1){echo 'Aktif';}else{ echo 'Belum Aktif';} ?></td>
                        <td>
                          <div class="row-actions" align="center">
                            <?php echo anchor('admin/user_edit/' . $u->id, '<i class="fa fa-edit fa-fw"></i>'); 
                            if ($u->npm != $npmadmin){ echo ' | '. anchor('admin/user_hapus/'.$u->id, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus User ini?')")); } ?>
                          </div>
                        </td>
                        <?php
                        $i++;
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>



                <div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo base_url() . 'admin/user_daftar'; ?>" method="post">

                          <div class="form-group">
                            <label>NPM</label>
                            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM" value="<?= set_value('npm'); ?>">
                            <?= form_error('npm', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>
                          <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level" id="level" required>
                              <option value="">Pilih Level</option>
                              <option value="1">Admin</option>
                              <option value="2">Dosen</option>
                              <option value="3">Mahasiswa</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>No.HP</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nomor HP" value="<?= set_value('phone'); ?>">
                            <?= form_error('phone', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>