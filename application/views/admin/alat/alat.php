<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Data alat</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data alat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
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
              <a href="<?php echo base_url() . 'admin/alat_print'; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahalat"><i class="fa fa-plus"></i> Tambah Alat</button>
            </div>
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Stok</th>
                    <th>Jenis ALat</th>
                    <th style="text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($alat as $u) {
                    ?>
                    <tr class="<?php if ($i % 2 == 0) {
                      echo "odd";
                      } else {
                        echo "even";
                      } ?>">
                      <td><?php echo $i; ?></td>
                      <td>
                        <?php echo $u->nama_alat ?>
                      </td>
                      <td><?php echo $u->jumlah ?></td>
                      <td><?php echo $u->jenis ?></td>
                      <td>
                        <div class="row-actions" align="center">
                          <?php echo anchor('admin/alat_edit/' . $u->id, '<i class="fa fa-edit fa-fw"></i>'); ?>
                          | <?php echo anchor('admin/alat_hapus/' . $u->id, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus Alat ini?')")); ?>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Alat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url() . 'admin/alat_daftar'; ?>" method="post">

                  <div class="form-group">
                    <label>Nama Alat</label>
                    <input type="text" class="form-control" name="nama_alat" id="nama_alat" required>
                  </div>

                  <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                  </div>

                  <div class="form-group">
                    <label>Jenis Alat</label>
                    <select class="form-control" name="jenis" id="jenis">
                      <option value="Habis">Habis</option>
                      <option value="Tidak Habis">Tidak Habis</option>
                    </select>
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