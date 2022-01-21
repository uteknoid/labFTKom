  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="nav-icon fas fa-cog"></i> <b>Pengaturan Laporan</b></h1>
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
                      padding: 2% 0;
                    }
                  </style>

                  <?php foreach ($laporan as $u) { ?>
                    <form enctype="multipart/form-data" action="<?php echo base_url() . 'admin/olaporanupdate'; ?>" method="post">
                      <table width="100%">
                        <tr>
                          <div class="form-group">
                            <td><label>Header</label></td>
                            <td>:</td>
                            <td width="85%">
                              <label>Header 1:</label>
                              <input class="form-control" id="header1" name="header1" value="<?php echo $u->header1 ?>" required>
                              <small style="margin-left: 2%"><i>Masukkan Header pertama untuk laporan Anda</i></small>

                              <br>
                              <label>Header 2:</label>
                              <input class="form-control" id="header2" name="header2" value="<?php echo $u->header2 ?>" required>
                              <small style="margin-left: 2%"><i>Masukkan Header kedua untuk laporan Anda</i></small>

                              <br>
                              <label>Alamat Instansi:</label>
                              <input class="form-control" id="alamat" name="alamat" value="<?php echo $u->alamat ?>">
                              <small style="margin-left: 2%"><i>Kosongkan untuk menggunakan komponen dari pengaturan aplikasi</i></small>

                              <br>
                              <label>No. Telpon Instansi:</label>
                              <input class="form-control" id="telp" name="telp" value="<?php echo $u->telp ?>">
                              <small style="margin-left: 2%"><i>Kosongkan untuk menggunakan komponen dari pengaturan aplikasi</i></small>

                              <br>
                              <label>Situs Instansi:</label>
                              <input class="form-control" id="situs" name="situs" value="<?php echo $u->situs ?>">
                              <small style="margin-left: 2%"><i>Kosongkan untuk menggunakan komponen dari pengaturan aplikasi</i></small>

                              <br>
                              <label>Email Instansi:</label>
                              <input class="form-control" id="email" name="email" value="<?php echo $u->email ?>">
                              <small style="margin-left: 2%"><i>Kosongkan untuk menggunakan komponen dari pengaturan aplikasi</i></small>

                            </td>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                            <td><label>Footer</label></td>
                            <td>:</td>
                            <td width="85%">
                              <label>Lokasi:</label>
                              <input class="form-control" id="kota" name="kota" value="<?php echo $u->kota ?>" required>
                              <small style="margin-left: 2%"><i>Kota, Kabupaten, Kecamatan atau Desa</i></small>

                              <br>
                              <label>Atas Nama:</label>
                              <input class="form-control" id="an" name="an" value="<?php echo $u->an ?>" required>
                              <small style="margin-left: 2%"><i>Teks yang akan menjadi atas nama</i></small>

                              <br>
                              <label>Nama Ketua Instansi / Penanggungjawab:</label>
                              <input class="form-control" id="nama" name="nama" value="<?php echo $u->nama ?>" required>
                              <small style="margin-left: 2%"><i>Masukkan nama ketua instansi atau penanggungjawab</i></small>

                              <br>
                              <label>NIP:</label>
                              <input class="form-control" id="nip" name="nip" value="<?php echo $u->nip ?>" required>
                              <small style="margin-left: 2%"><i>Masukkan NIP ketua instansi atau penanggungjawab</i></small>

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
