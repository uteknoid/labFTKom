<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pengeluaran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pengeluaran</li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahsaldo"><i class="fa fa-user fa-plus-circle"></i> Tambah Pengeluaran</button>

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
                      <th>Uraian</th>
                      <th>Volume</th>
                      <th>Kredit</th>
                      <th style="text-align: center">Bukti</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($pengeluaran as $p) {
                      ?>
                      <tr class="<?php if ($i % 2 == 0) {
                        echo "odd";
                        } else {
                          echo "even";
                        } ?>">
                        <td><?php echo $i; ?></td>
                        <td> <?php echo $p->tanggal ?> </td>
                        <td> <?php echo $p->uraian ?> </td>
                        <td> <?php echo $p->volume ?> </td>
                        <td><?php echo "Rp. " . number_format($p->kredit, 0, ",", "."); ?></td>
                        <td align="center"><a class="btn btn-info btn-sm" target="_blank" href="<?php echo base_url('assets/img/pengeluaran/').$p->bukti; ?>">LIHAT</a></td>
                        <td>
                          <div class="row-actions" align="center">
                            <?php echo anchor('admin/pengeluaran_edit/' . $p->id, '<i class="fa fa-edit fa-fw"></i>'); 
                            if ($s->npm != $npmadmin){ echo ' | '. anchor('admin/pengeluaran_hapus/'.$p->id, '<i class="fa fa-eraser fa-fw"></i>', array('onclick' => "return confirm('Hapus data ini?')")); } ?>
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
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Pengeluaran</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo base_url() . 'admin/pengeluaran_tambah'; ?>" method="post" enctype="multipart/form-data">

                          <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal'); ?>">
                            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Uraian</label>
                            <input type="text" class="form-control" id="uraian" name="uraian" value="<?= set_value('uraian'); ?>">
                            <?= form_error('uraian', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Merek/Tipe</label>
                            <input type="text" class="form-control" id="tipe" name="tipe" value="<?= set_value('tipe'); ?>">
                            <?= form_error('tipe', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Volume</label>
                            <input type="number" class="form-control" id="volume" name="volume" value="<?= set_value('volume'); ?>">
                            <?= form_error('volume', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?= set_value('satuan'); ?>">
                            <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>') ?>
                          </div>

                          <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Hanya Angka (tanpa titik ataupun koma)" value="<?= set_value('harga'); ?>">
                            <?= form_error('harga', '<small class="text-danger pl-3">', '</small>') ?>
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