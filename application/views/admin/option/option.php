<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-cog"></i> <b>Pengaturan</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
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

        <?= $this->session->flashdata('message'); ?>

        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-5">
              <div class="card-header">
                <style type="text/css">
                  td{
                    vertical-align: top;
                    padding: 0 0 1% 0;
                  }
                  .file{
                    position: relative;
                    overflow: hidden;
                    width: 200px;
                    cursor: pointer;
                  }
                  .file input.upload{
                    position: absolute;
                    top: 0;
                    right: 0;
                    margin: 0;
                    padding: 0;
                    font-size: 2rem;
                    cursor: pointer;
                    opacity: 0;
                    filter: alpha(opacity=0);
                  }
                </style>

                <?php foreach ($option as $u) { ?>
                  <form enctype="multipart/form-data" action="<?php echo base_url() . 'admin/optionupdate'; ?>" method="post">
                    <table width="100%">
                      <tr>
                        <div class="form-group">
                          <td><label>Nama Instansi</label></td>
                          <td>: </td>
                          <td width="75%"><input class="form-control" id="nama" name="nama" value="<?php echo $u->nama ?>" required>
                            <small style="margin-left: 1%"><i>Masukkan Nama Instansi Yang Akan Tampil Sebagain Nama Website Anda</i></small>
                          </td>
                        </div>
                      </tr>
                      <br>
                      <tr>
                        <div class="form-group">
                          <td><label>Deskripsi</label></td>
                          <td>: </td>
                          <td width="75%"><textarea rows="3" class="form-control" id="deskripsi" name="deskripsi" required><?php echo $u->deskripsi ?></textarea>
                            <small style="margin-left: 1%"><i>Masukkan Deskripti Yang Akan Tampil Sebagain Nama Website Anda</i></small>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label>Logo (logo pada aplikasi)</label></td>
                          <td>: </td>
                          <td width="75%">
                            <a target="_blank" href="<?php echo base_url() . 'admin/gantilogo'; ?>" class="upload" width="300px" style="width: 300px;">
                              <div class="file btn btn-success">
                                <span>Ganti</span>
                              </div>
                            </a>
                            <br>
                            <small style="margin-left: 1%"><i>Biarkan kosong jika tidak ingin mengubah</i></small>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label>Ikon (logo instansi)</label></td>
                          <td>:</td>
                          <td width="75%">
                            <a target="_blank" href="<?php echo base_url() . 'admin/gantiicon'; ?>" class="upload" width="200px" style="width: 200px;">
                              <div class="file btn btn-success">
                                <span>Ganti</span>
                              </div>
                            </a>
                            <br>
                            <small style="margin-left: 1%"><i>Biarkan kosong jika tidak ingin mengubah</i></small>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label>Kontak</label></td>
                          <td>: </td>
                          <td width="75%">
                            <label>Alamat:</label>
                            <textarea class="form-control" rows="2" id="alamat" name="alamat" required><?php echo $u->alamat ?></textarea>
                            <small style="margin-left: 1%"><i>Masukkan Alamat Instansi</i></small>

                            <br>
                            <label>Telpon:</label>
                            <input class="form-control" id="telp" name="telp" value="<?php echo $u->telp ?>" required>
                            <small style="margin-left: 1%"><i>Masukkan Nomor Telpon Instansi</i></small>

                            <br>
                            <label>Email:</label>
                            <input class="form-control" id="email" name="email" value="<?php echo $u->email ?>" required>
                            <small style="margin-left: 1%"><i>Masukkan Email Instansi</i></small>

                          </td>
                        </div>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>
                          <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                        </td>
                      </tr>
                    </table>
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
