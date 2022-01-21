<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data Pengeluaran</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Data Pengeluaran</li>
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

                <?php foreach ($pengeluaran as $p) { ?>

                  <form action="<?php echo base_url() . 'admin/pengeluaran_update'; ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <label>Tanggal</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $p->tanggal ?>">
                    </div>

                    <div class="form-group">
                      <label>Uraian</label>
                      <input type="text" class="form-control" id="uraian" name="uraian" value="<?php echo $p->uraian ?>">
                    </div>

                    <div class="form-group">
                      <label>Merek/Tipe</label>
                      <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo $p->tipe ?>">
                    </div>

                    <div class="form-group">
                      <label>Volume</label>
                      <input type="number" class="form-control" id="volume" name="volume" value="<?php echo $p->volume ?>">
                    </div>

                    <div class="form-group">
                      <label>Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $p->satuan ?>">
                    </div>

                    <div class="form-group">
                      <label>Harga</label>
                      <input type="number" class="form-control" id="harga" name="harga" placeholder="Hanya Angka (tanpa titik ataupun koma)" value="<?php echo $p->harga ?>">
                    </div>
                    <div class="form-group">
                      <label>Bukti</label>
                      <input type="file" class="form-control" id="bukti" name="bukti">
                      <small>kosongkan jika tidak ingin mengubah</small>
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>

                    <input type="hidden" name="id" id="id" value="<?php echo $p->id ?>" />
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