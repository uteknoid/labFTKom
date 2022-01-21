<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Data Ruangan</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Ruangan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">


      <?php
      error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      $message = $_GET['msg'];

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

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahalat"><i class="fa fa-plus"></i> Tambah Ruangan</button>
              </div>
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ruangan</th>
                      <th>Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $i = 1;
                    foreach ($ruang as $u) {
                      ?>
                      <tr class="<?php if ($i % 2 == 0) {
                        echo "odd";
                        } else {
                          echo "even";
                        } ?>">
                        <td><?php echo $i; ?></td>
                        <td>
                          <?php echo $u->nama_lab ?>
                        </td>
                        <td><?php echo $u->status ?></td>
                        <td>
                          <div class="row-actions" align="center">
                            <?php echo anchor('admin/ruang_edit/' . $u->id_lab, '<i class="fa fa-edit fa-fw"></i>'); ?>
                            | <?php echo anchor('admin/ruang_hapus/' . $u->id_lab, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus Ruangan ini?')")); ?>
                          </div>
                        </td>
                        <?php
                        $i++;
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <div class="modal fade" id="tambahalat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Tambah Ruangan</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form action="<?php echo base_url() . 'admin/ruang_daftar'; ?>" method="post">

                    <div class="form-group">
                      <label>Nama Ruangan</label>
                      <input type="text" class="form-control" name="nama_lab" id="nama_lab" required>
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

</div>
</section>
</div>