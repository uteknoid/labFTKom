  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data Ruangan</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Ruangan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">


        <div id="page-wrapper">

          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-5">
                <div class="card-header">

                  <?php foreach ($ruang as $u) { ?>
                    <form action="<?php echo base_url() . 'admin/ruangupdate'; ?>" method="post">

                      <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input class="form-control" id="nama_lab" name="nama_lab" value="<?php echo $u->nama_lab ?>" required>
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status" selected="<?php echo $u->status ?>">
                          <option value="Kosong"<?php if ($u->status == 'Kosong') {
                            echo 'selected';
                          } ?>>Kosong</option>
                          <option value="Digunakan"<?php if ($u->status == 'Digunakan') {
                            echo 'selected';
                          } ?>>Digunakan</option>
                        </select>
                      </div>

                      <button class="btn btn-primary" type="submit" name="submit">Update</button>
                      <input type="hidden" name="id_lab" value="<?php echo $u->id_lab ?>" />
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

</div>
</section>
</div>