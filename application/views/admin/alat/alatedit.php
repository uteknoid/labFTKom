  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data alat</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Data alat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Main row -->
        <div id="page-wrapper">

          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-5">
                <div class="card-header">

                  <?php foreach ($alat as $u) { ?>
                    <form action="<?php echo base_url() . 'admin/alatupdate'; ?>" method="post">

                      <div class="form-group">
                        <label>Nama alat</label>
                        <input class="form-control" id="nama_alat" name="nama_alat" value="<?php echo $u->nama_alat ?>" required>
                      </div>

                      <div class="form-group">
                        <label>Jumlah Alat</label>
                        <input class="form-control" type="number" id="jumlah" name="jumlah" value="<?php echo $u->jumlah ?>" required>
                      </div>

                      <div class="form-group">
                        <label>Jenis Alat</label>
                        <select class="form-control" name="jenis" id="jenis" selected="<?php echo $u->jenis ?>">
                          <option value="Habis" <?php if ($u->jenis == 'Habis') {
                            echo 'selected';
                          } ?>>Habis</option>
                          <option value="Tidak Habis" <?php if ($u->jenis == 'Tidak Habis') {
                            echo 'selected';
                          } ?>>Tidak Habis</option>
                        </select>
                      </div>

                      <button class="btn btn-primary" type="submit" name="submit">Update</button>
                      <input type="hidden" name="id" value="<?php echo $u->id ?>" />
                    </form>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>