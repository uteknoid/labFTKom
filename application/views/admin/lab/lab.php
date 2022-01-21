<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Penggunaan Lab</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Penggunaan Lab</li>
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


        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $message = $_GET['msg'];

        if ($message == 'success') {
          ?>
          <div class="alert alert-success">Berhasil</div>
        <?php } else if ($message == 'failed') { ?>
          <div class="alert alert-warning">Error</div>
        <?php } else if ($message == 'kosongkan') { ?>
          <div class="alert alert-success">Ruangan Telah Kosong</div>
        <?php } ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#printlaporan"><i class="fa fa-print"></i> Cetak</button>


                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahpinjam"><i class="fa fa-plus"></i> Gunakan Lab</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIM/NPM</th>
                      <th>Nama Mata Kuliah</th>
                      <th>Hari, Tanggal</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Ruangan</th>
                      <th>Dosen Pengampu</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($lab as $u) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->npm ?></td>
                        <td><?php echo $u->nama_matkul ?></td>
                        <td><?php echo $u->hari.', '.$u->tanggal ?></td>
                        <td><?php echo $u->jam_awal ?></td>
                        <td><?php echo $u->jam_akhir ?></td>
                        <td><?php echo $u->ruang ?></td>
                        <td><?php echo $u->dosen_pengampu ?></td>
                        <td>
                          <div class="row-actions" style="width: 100%;">
                            <?php
                            if ($u->status == 'Digunakan') {
                              echo anchor('admin/kosongkan/' . $u->id, '<span class="btn btn-success" style="width: 100%;">Kosongkan</span>', array('onclick' => "return confirm('Lab telah kosong?')"));
                            } else {
                              echo '<span class="btn btn-primary active" style="width: 100%; opacity: 70%;">Selesai</span>';
                            } echo anchor('admin/lab_hapus/' . $u->id, '<span class="btn btn-danger" style="width: 100%; margin-top: 5px;">Hapus</span>', array('onclick' => "return confirm('Hapus Data ini?')"));
                            ?>
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




            <div class="modal fade" id="printlaporan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Cetak Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                    <script type="text/javascript">
                      function check() {
                        var el = document.getElementById("combo");
                        var str = el.options[el.selectedIndex].text;
                        if (str == "Keseluruhan") {
                          document.getElementById('dummyText1').type = 'hidden';
                          document.getElementById('dummyText2').type = 'hidden';
                          document.getElementById('dummyText').type = 'hidden';
                          hide();
                        }

                        var d = new Date();
                        var y = d.getFullYear();
                        var n = d.getMonth() + 1;
                        if (str == "Semester") {
                          document.getElementById('dummyText').type = 'hidden';
                          document.getElementById('dummyText1').type = 'date';
                          document.getElementById('dummyText2').type = 'date';
                          show();
                        } else {}

                        if (str == "Tahunan") {
                          document.getElementById('dummyText1').type = 'hidden';
                          document.getElementById('dummyText2').type = 'hidden';
                          document.getElementById('dummyText').type = 'number';
                          document.getElementById('dummyText').value = y;
                          hide();
                        } else {}

                        if (str == "Bulanan") {
                          document.getElementById('dummyText1').type = 'hidden';
                          document.getElementById('dummyText2').type = 'hidden';
                          document.getElementById('dummyText').type = 'month';
                          document.getElementById('dummyText').defaultValue = y + '-' + n;
                          document.getElementById('dummyText').value = y + '-' + n;
                          hide();
                        } else {}
                      }

                      function hide() {
                        document.getElementById('dummyDiv').style.visibility = 'hidden';
                      }

                      function show() {
                        document.getElementById('dummyDiv').style.visibility = 'visible';

                      }

                    </script>

                    <form action="<?php echo base_url() . 'admin/lab_print'; ?>" target="_blank" method="post">

                      <div class="form-group">
                        <label>Filter</label>
                        <select class="form-control" name="filter" id="combo" onChange="check();">
                          <option value="Keseluruhan">Keseluruhan</option>
                          <option value="Bulanan">Bulanan</option>
                          <option value="Tahunan">Tahunan</option>
                          <option value="Semester">Semester</option>
                        </select>
                      </div>




                      <input class="form-control" id="dummyText" type="hidden" name="waktu">

                      <div class="row" id="dummyDiv" style="visibility:hidden">
                        <div class="col">
                          <input class="form-control" id="dummyText1" type="hidden" name="waktu1">
                        </div>
                        _ 
                        <div class="col">
                          <input class="form-control" id="dummyText2" type="hidden" name="waktu2">
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button class="btn btn-default" type="submit" name="submit">Cetak</button>
                      </div>
                    </form>


                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="tambahpinjam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Gunakan Lab</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">



                    <form action="<?php echo base_url() . 'admin/lab_daftar'; ?>" method="post">

                      <div class="form-group">
                        <input id="icon_prefix" type="hidden" name="npm" value="<?php echo $npm; ?>" class="form-control" required>
                      </div>

                      <div class="form-group">
                        <label>Mata Kuliah</label>
                        <input id="icon_prefix" type="text" name="nama_matkul" class="form-control" required>
                      </div>

                      <div class="form-group">
                        <label>Jam Masuk</label>
                        <input id="icon_prefix" type="time" class="form-control" name="jam_awal" required>
                      </div>

                      <div class="form-group">
                        <label>Jam Keluar</label>
                        <input id="icon_prefix" type="time" class="form-control" name="jam_akhir" required>
                      </div>

                      <div class="form-group">
                        <label>Hari</label>
                        <select class="form-control" name="hari">
                          <option value="" selected disabled>Pilih Hari</option>
                          <option value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                          <option value="Jumat">Jumat</option>
                          <option value="Sabtu">Sabtu</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input id="icon_prefix" type="date" class="form-control" name="tanggal" required>
                      </div>

                      <div class="form-group">
                        <label>Ruangan</label>
                        <select name="ruang" class="form-control" required>
                          <option value="" selected disabled>Pilih Ruangan</option>

                          <?php
                          foreach ($ruang as $u) {
                            echo "<option value='".$u->nama_lab."'>".$u->nama_lab."</option>";
                          }
                          ?>  
                        </select>
                      </div> 

                      <div class="form-group">
                        <label>Nama Dosen</label>
                        <select name="dosen_pengampu" class="form-control" required>
                          <option value="" selected disabled>Pilih Dosen</option>
                          <?php
                          foreach ($dosen as $u) {
                            echo "<option value='".$u->name."'>".$u->name."</option>";
                          }
                          ?>  
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
    <!-- /#page-wrapper -->

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>