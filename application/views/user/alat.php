<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

  <a class="navbar-brand logo-image" href="index"><img src="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->logo; }?>" alt="alternative"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-awesome fas fa-bars"></span>
    <span class="navbar-toggler-awesome fas fa-times"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Klik "Logout" untuk mengakhiri sesi anda. Dan Keluar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>


<header id="header" class="header">
  <div class="header-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="text-container">
            <h2>Selamat Datang<br><?php foreach ($user as $u) { echo $u->name; } ?></h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="image-container">
            <img class="img-fluid" src="<?= base_url('assets/'); ?>img/header-teamwork.svg" alt="alternative">
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<div class="slider-1">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h5>Data Penggunaan Ruang LAB Anda</h5>



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
            <div class="card mb-5">
              <div class="card-header">
                <button type="button" id="gunakna" class="btn btn-primary" data-toggle="modal" data-target="#tambahgunakan"><i class="fa fa-plus"></i> Gunakan LAB</button>

              </div>

              <div class="panel-body table-responsive">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
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
                    <?php

                    

                    $i = 1;
                    foreach ($gunakan as $u) {
                      if($u > 0){
                    ?>
                      <tr class="<?php if ($i % 2 == 0) {
                                    echo "odd";
                                  } else {
                                    echo "even";
                                  } ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->nama_matkul ?></td>
                        <td><?php echo $u->hari.', '.$u->tanggal ?></td>
                        <td><?php echo $u->jam_awal ?></td>
                        <td><?php echo $u->jam_akhir ?></td>
                        <td><?php echo $u->ruang ?></td>
                        <td><?php echo $u->dosen_pengampu ?></td>
                        <td>
                        <div class="row-actions">
                            <?php
                            if ($u->status == 'Digunakan') {
                              echo anchor('auth/kosongkan/' . $u->id, '<span class="btn btn-success">Kosongkan</span>', array('onclick' => "return confirm('Lab telah kosong?')"));
                            } else {
                              echo 'Selesai';
                            }
                            ?>
                        </div>
                        </td>
                    </tr>
                    <?php
                      $i++;
                    }else{
                    echo '<tr><td>Data Belum Ada</td></tr>';
                  }
                  }
                    
                    $i++;
                    ?>
                  </tbody>

                </table>


                <div class="modal fade" id="tambahgunakan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Gunakan Ruang LAB</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">



                        <form action="gunakan_daftar" method="post">
                          <div class="form-group">
                            <input id="icon_prefix" type="text" name="npm" value="<?php
                              foreach ($user as $u) { echo $u->npm; }
                              ?>" class="form-control" required hidden>
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




      <h5>Data Pinjaman Alat Anda</h5>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-5">
              <div class="card-header">
                <button type="button" id="pinjam" class="btn btn-primary" data-toggle="modal" data-target="#tambahpinjam"><i class="fa fa-plus"></i> Pinjam Alat</button>

              </div>

              <div class="panel-body table-responsive">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                      <th>Tanggal Kembali</th>
                      <th>Jaminan</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    

                    $i = 1;
                    foreach ($pinjam as $u) {
                      if($u > 0){
                    ?>
                      <tr class="<?php if ($i % 2 == 0) {
                                    echo "odd";
                                  } else {
                                    echo "even";
                                  } ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $u->nim ?></td>
                        <td><?php echo $u->nama ?></td>
                        <td><?php echo $u->tujuan ?></td>
                        <td>
                          <?php echo $u->nama_alat ?>
                        </td>
                        <td><?php echo $u->kondisi ?></td>
                        <td><?php echo $u->jumlah_alat ?></td>
                        <td><?php echo $u->tgl_pinjam ?></td>
                        <td><?php 
                        if($u->proses == 'Selesai'){
                          echo $u->tgl_kembali;
                        }else{
                          echo 'Belum Kembali';
                        } ?>
                        </td>
                        <td><?php echo $u->jaminan ?></td>
                      <td>
                        <div class="row-actions">
                            <?php
                            if ($u->proses == 'Belum Selesai') {
                              echo 'Belum Kembali';
                            } else {


                              echo 'Selesai';
                            }
                            ?>
                        </div>
                      </td>
                    </tr>
                    <?php
                      $i++;
                    }else{
                    echo '<tr><td>Anda Belum Meminjam Alat Apapun</td></tr>';
                  }
                  }
                    
                    $i++;
                    ?>
                  </tbody>

                </table>



                <div class="modal fade" id="tambahpinjam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Pinjam Alat</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">



                        <form action="pinjam_daftar" method="post">

                          <?php 
                          foreach ($user as $u) {
                            ?>

                          <div class="form-group">
                            <label>NIDN/NIM</label>
                            <input autocomplete="off" id="icon_prefix" type="text" name="nim" class="form-control" value="<?php echo $u->npm ?>" required>
                          </div>

                          <div class="form-group">
                            <label>Nama Peminjam</label>
                            <input autocomplete="off" id="icon_prefix" type="text" class="form-control" name="nama" value="<?php echo $u->name ?>" required>
                          </div>

                          <?php
                        }
                          ?>

                          <div class="form-group">
                            <label>Tujuan/Judul Penelitian</label>
                            <input autocomplete="off" id="icon_prefix" type="text" class="form-control" name="tujuan" required>
                          </div>
                          <div class="form-group">

                            <label>Alat</label>
                            <select class="form-control" name="nama_alat" required>
                              <option value="">Pilih..</option>
                              <?php 
                          foreach ($alat as $u) {
                            ?>
                            <option value="<?php echo $u->nama_alat ?>"><?php echo $u->nama_alat.'  (stok: ' . $u->jumlah . ')'; ?></option>
                            <?php
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
                            <input id="icon_prefix" type="number" class="form-control" name="jumlah_alat" required>
                          </div>

                          <div class="form-group">
                            <label>Tanggal Pinjaman</label>
                            <input id="icon_prefix" type="date" class="form-control" name="tgl_pinjam" required>
                          </div>

                          <div class="form-group">
                            <label>Jaminan</label>
                            <input autocomplete="off" type="text" name="jaminan" class="form-control" required>
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
  </div>
</div>