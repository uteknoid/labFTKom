<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data Saldo Masuk</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Data Saldo Masuk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">

                <?php foreach ($saldo as $s) { ?>

                    <form action="<?php echo base_url() . 'admin/saldo_update'; ?>" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label>Tanggal Saldo Masuk</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $s->tanggal ?>">
                      </div>

                      <div class="form-group">
                        <label>Jumlah Saldo Masuk</label>
                        <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Hanya Angka (tanpa titik ataupun koma)" value="<?php echo $s->saldo_masuk ?>">
                      </div>
                      <div class="form-group">
                        <label>Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti">
                        <small>kosongkan jika tidak ingin mengubah</small>
                      </div>

                      <button class="btn btn-primary" type="submit" name="submit">Simpan</button>

                      <input type="hidden" name="id" id="id" value="<?php echo $s->id ?>" />
                    </form>
                  <?php } ?>
                  <br>

                </div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </section>
  </div>
<!-- /#page-wrapper -->