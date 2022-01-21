<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Saldo Masuk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Saldo Masuk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div id="page-wrapper">

        <?php
        // $saldo = 100000;
        // $lama = 90000;
        // $saldo = $saldo-$lama;
        // echo $saldo.'<br>';
        // $baru = 900000;
        // echo ($saldo+$lama)-$baru;

        
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $message = $_GET['msg'];

        $npmadmin = $this->session->userdata('npm');

        if ($message == 'success') {
          ?>
          <div class="alert alert-success">Berhasil</div>
        <?php } else if ($message == 'failed') { ?>
          <div class="alert alert-warning">Error</div>
        <?php } ?>

        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahsaldo"><i class="fa fa-user fa-plus-circle"></i> Tambah Saldo Masuk</button>

                <div style="float: right;">
                  <?php
                  foreach ($saldosekarang as $ss) { ?>
                    <h4>Saldo Terbaru: <span style="color: #059805; font-weight: bold;"><?php echo "Rp. " . number_format($ss->saldo_terkini, 0, ",", "."); ?></span></h4>

                  <?php } ?>
                </div>

                <!-- <a href="<?php //echo base_url() . 'admin/user_print'; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Jumlah Saldo Masuk</th>
                      <th style="text-align: center">Bukti</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($saldo as $s) {
                      ?>
                      <tr class="<?php if ($i % 2 == 0) {
                        echo "odd";
                        } else {
                          echo "even";
                        } ?>">
                        <td><?php echo $i; ?></td>
                        <td> <?php echo $s->tanggal ?> </td>
                        <td><?php echo "Rp. " . number_format($s->saldo_masuk, 0, ",", "."); ?></td>
                        <td align="center"><a class="btn btn-info btn-sm" target="_blank" href="<?php echo base_url('assets/img/saldo/').$s->bukti_saldo; ?>">LIHAT</a></td>
                        <td>
                          <div class="row-actions" align="center">
                            <?php echo anchor('admin/saldo_edit/' . $s->id, '<i class="fa fa-edit fa-fw"></i>'); 
                            if ($s->npm != $npmadmin){ echo ' | '. anchor('admin/saldo_hapus/'.$s->id, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus data ini?')")); } ?>
                          </div>
                        </td>
                        <?php
                        $i++;
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>



                <div class="modal fade" id="tambahsaldo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Saldo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo base_url() . 'admin/saldo_tambah'; ?>" method="post" enctype="multipart/form-data">

                          <div class="form-group">
                            <label>Tanggal Saldo Masuk</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal'); ?>">
                            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Jumlah Saldo Masuk</label>
                            <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Hanya Angka (tanpa titik ataupun koma)" value="<?= set_value('saldo'); ?>">
                            <?= form_error('saldo', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>
                          <div class="form-group">
                            <label>Bukti</label>
                            <input type="file" class="form-control" id="bukti" name="bukti" value="<?= set_value('bukti'); ?>">
                            <?= form_error('bukti', '<small class="text-danger pl-3">', '</small>') ?>
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