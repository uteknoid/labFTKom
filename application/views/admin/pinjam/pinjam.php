<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Peminjaman Alat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Peminjaman Alat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div id="page-wrapper">


        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $message = $_GET['msg'];

        if ($message == 'success') {
          ?>
          <div class="alert alert-success">Berhasil</div>
        <?php } else if ($message == 'failed') { ?>
          <div class="alert alert-warning">Error</div>
        <?php } else if ($message == 'kembali') { ?>
          <div class="alert alert-success">Alat Berhasil Dikembalikan</div>
        <?php } ?>

        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#printlaporan"><i class="fa fa-print"></i> Cetak</button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahpinjam"><i class="fa fa-plus"></i> Tambah Peminjam</button>
              </div>
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIDN/NIM</th>
                      <th>Nama Peminjam</th>
                      <th>Tujuan/Judul Penelitian</th>
                      <th>Nama Alat</th>
                      <th>Kondisi Alat</th>
                      <th>Jumlah</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali/Proses</th>
                      <th>Jaminan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($pinjam as $u) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->nim ?></td>
                        <td><?php echo $u->nama ?></td>
                        <td><?php echo $u->tujuan ?></td>
                        <td><?php echo $u->nama_alat ?></td>
                        <td><?php echo $u->kondisi ?></td>
                        <td><?php echo $u->jumlah_alat ?></td>
                        <td><?php echo '' . date("j F Y", strtotime($u->tgl_pinjam)) . ''; ?></td>
                        <td><?php
                        if ($u->proses == 'Belum Selesai') {
                          echo anchor('admin/kembalikan/' . $u->id, '<span class="btn btn-primary">Kembali</span>', array('onclick' => "return confirm('Barang Telah Kembali?')"));
                        } else {


                          echo '' . date("j F Y", strtotime($u->tgl_kembali)) . '';
                        }
                        ?></td>
                        <td><?php echo $u->jaminan ?></td>
                        <td>
                          <div class="row-actions">
                            <?php echo anchor('admin/pinjam_edit/' . $u->id, '<i class="fa fa-edit fa-fw"></i>');
                            if ($u->proses == 'Belum Selesai') {
                            } else {
                              ?>| <?php echo anchor('admin/pinjam_hapus/' . $u->id, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus Data ini?')"));
                            } ?>
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

                    <form action="<?php echo base_url() . 'admin/pinjam_print'; ?>" target="_blank" method="post">

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
                    <h4 class="modal-title" id="myModalLabel">Pinjam Alat</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">



                    <form action="<?php echo base_url() . 'admin/pinjam_daftar'; ?>" method="post">

                      <div class="form-group">
                        <label>NIDN/NIM</label>
                        <input autocomplete="off" value="" type="text" name="nim" id="nim" class="form-control" required>
                      </div>

                      <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input autocomplete="off" value="" type="text" class="form-control" name="nama" id="nama" required>
                      </div>

                      <div class="form-group">
                        <label>Tujuan/Judul Penelitian</label>
                        <input autocomplete="off" type="text" class="form-control" name="tujuan" id="tujuan" required>
                      </div>

                      <div class="form-group">
                        <label>Alat</label>
                        <select class="form-control" name="nama_alat" id="nama_alat" required>
                          <option value="">Pilih Alat</option>
                          <?php
                          foreach ($alat as $u) {
                            echo "<option value='" . $u->nama_alat . "'>" . $u->nama_alat . "  (stok: " . $u->jumlah . ")</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Kondisi Alat</label>
                        <select class="form-control" name="kondisi" required>
                          <option value="">Pilih..</option>
                          <option value="Baik">Baik</option>
                          <option value="Rusak Ringan">Rusak Ringan</option>
                          <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Jumlah Pinjaman</label>
                        <input type="number" class="form-control" name="jumlah_alat" id="jumlah_alat" required>
                      </div>

                      <div class="form-group">
                        <label>Tanggal Pinjaman</label>
                        <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" required>
                      </div>

                      <div class="form-group">
                        <label>Jaminan</label>
                        <input autocomplete="off" type="text" name="jaminan" id="jaminan" class="form-control" required>
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
    </section>
  </div>