<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data Pinjaman</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Data Pinjaman</li>
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

                <?php foreach ($pinjam as $u) { ?>

                  <form action="<?php echo base_url() . 'admin/pinjamupdate'; ?>" method="post">

                    <div class="form-group">
                      <label>NIDN/NIM</label>
                      <input id="icon_prefix" type="text" name="nim" value="<?php echo $u->nim ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>Nama Peminjam</label>
                      <input id="icon_prefix" type="text" class="form-control" name="nama" value="<?php echo $u->nama ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Tujuan/Judul Penelitian</label>
                      <input id="icon_prefix" type="text" class="form-control" name="tujuan" value="<?php echo $u->tujuan ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Kondisi Alat</label>
                      <select class="form-control" name="kondisi" required>
                        <option value="">Pilih..</option>
                        <option value="Baik" <?php if($u->kondisi == 'Baik'){echo  'selected';}?>>Baik</option>
                        <option value="Rusak Ringan" <?php if($u->kondisi == 'Rusak Ringan'){echo  'selected';}?>>Rusak Ringan</option>
                        <option value="Rusak Berat" <?php if($u->kondisi == 'Rusak Berat'){echo  'selected';}?>>Rusak Berat</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Pinjaman</label>
                      <input id="icon_prefix" type="date" class="form-control" name="tgl_pinjam" value="<?php echo $u->tgl_pinjam ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Kembali</label>
                      <input id="icon_prefix" type="date" name="tgl_kembali" class="form-control" value="<?php echo $u->tgl_kembali ?>">
                    </div>

                    <div class="form-group">
                      <label>Jaminan</label>
                      <input type="text" name="jaminan" class="form-control" value="<?php echo $u->jaminan ?>" required>
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
  </section>
  <!-- /.content -->
</div>