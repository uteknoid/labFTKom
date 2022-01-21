<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">


    <a class="navbar-brand logo-image" href="index"><img src="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->logo; }?>" alt="alternative"></a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#datalab">Ruang LAB</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#services">Alat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#pricing">Data Pinjaman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="<?= base_url('auth/index_login'); ?>">Login</a>
            </li>
        </ul>
    </div>
</nav> 

<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h1><span class="turquoise"><?php foreach ($option as $u) { echo $u->nama; }?></span></h1>
                        <p class="p-large"><?php foreach ($option as $u) { echo $u->deskripsi; }?></p>
                        <a class="btn-solid-lg page-scroll" href="<?= base_url('auth/pinjam'); ?>">MULAI</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="<?= base_url('assets/'); ?>img/header-img.png" alt="alternative">
                    </div> 
                </div>
            </div>
        </div> 
    </div> 
</header>


<div id="datalab" class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Ruang LAB</h2>
                <p class="p-heading p-large">Berikut adalah data penggunaan lab saat ini</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <?php foreach($ruang as $row){ 
                    $this->load->model('data_lab');
                    ?>

                    <div class="card col-md-4">
                        <h4 class="card-title">
                            <i class="fas fa-university mr-1"></i><?php echo $row->nama_lab; ?>
                        </h4>
                        <hr>
                        <div class="card-body">
                            <div style="height: 195px; width: 100%; vertical-align: middle;"> 
                                <div class="labku">
                                    <?php
                                    date_default_timezone_set('Asia/Makassar');

                                    $date = new DateTime("now");

                                    $curr_date = $date->format('Y-m-d');

                                    $ruang_lab = $row->nama_lab;
                                    $status = $row->status;

                                    $query = "SELECT * FROM jadwal_lab WHERE ruang='$ruang_lab' AND DATE(tanggal)='$curr_date' AND status='Digunakan' ORDER BY jam_akhir DESC"; 
                                    $lab = $this->db->query($query)->result();

                                    if (is_array($lab) && count($lab) > 0 && $status=='Digunakan') {
                                        foreach($lab as $rows){ ?>
                                            <center><h2><b>Sedang Digunakan</b> </h2><h4> Hingga </h4> <h2><font color="green"><b> <?php echo $rows->jam_akhir; ?></b></font><h2></b></center>
                                                <?php
                                            }
                                        }else { ?>
                                            <center><h2><b><font color="green"><br>Lab Sedang Tidak Digunakan</font></b></h2></center>
                                        <?php } ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>



    <div id="services" class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Alat Yang Tersedia</h2>
                    <p class="p-heading p-large">Kami menyediakan beberapa alat untuk anda pinjam dan gunakan di lab kami</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/crimping.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Tang Krimping</h4>
                            <p>Kami memiliki beberapa unit Tang Krimping yang dapat anda gunakan untuk kegiatan Anda</p>
                        </div>
                    </div>

                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/lan.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Kabel LAN</h4>
                            <p>Kami memiliki beberapa unit kabel LAN yang dapat anda gunakan untuk kegiatan Anda</p>
                        </div>
                    </div>

                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/computer.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Monitor</h4>
                            <p>Kami memiliki beberapa unit Layar/Monitor yang dapat anda gunakan untuk kegiatan Anda</p>
                        </div>
                    </div>

                </div> 

                <div class="col-lg-12">

                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/projector.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Projector</h4>
                            <p>Ada beberapa unit projector yang dapat anda gunakan untuk kegiatan Anda. Seperti presentase dan lain sebagainya</p>
                        </div>
                    </div>


                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/hdmi.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Kabel HDMI</h4>
                            <p>Kami memiliki beberapa unit kabel HDMI yang dapat anda gunakan untuk kegiatan Anda</p>
                        </div>
                    </div>


                    <div class="card crd">
                        <img class="card-image" src="<?= base_url('assets/'); ?>img/vga.svg" alt="alternative">
                        <div class="card-body">
                            <h4 class="card-title">Kabel VGA</h4>
                            <p>Kami memiliki beberapa unit kabel VGA yang dapat anda gunakan untuk kegiatan Anda</p>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>



    <div id="pricing" class="cards-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Data Peminjaman Belum Selesai</h2>
                    <p class="p-heading p-large">Berikut adalah data peminjaman alat yang belum terselesaikan (alat belum kembali).</p>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive col-lg-12">

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN/NIM</th>
                                <th>Nama Peminjam</th>
                                <th>Tujuan/Judul Penelitian</th>
                                <th>Nama Alat</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jaminan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = 1;
                            foreach ($pinjam as $u) {
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
                                  <td><?php echo $u->jumlah_alat ?></td>
                                  <td><?php echo $u->tgl_pinjam ?></td>
                                  <td><?php echo $u->jaminan ?></td>
                              </tr>
                              <?php
                              $i++;
                          }
                          ?>
                      </tbody>

                  </table>

              </div>
          </div>
      </div>
  </div>


  <div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Contact Information</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.326684115508!2d120.19543821428441!3d-3.0065039407683303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d915f1922fc8c71%3A0xa765efb0d43779e0!2sHMTI!5e0!3m2!1sid!2sid!4v1586585434769!5m2!1sid!2sid" width="600" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="list-unstyled li-space-lg">
                    <li class="address">Silahkan Hubungi Nomor Berikut Untuk Informasi Lebih Lanjut.</li><br>
                    <li><i class="fas fa-map-marker-alt"></i><?php foreach ($option as $u) { echo $u->alamat; } ?></li><br><br>
                    <li><i class="fas fa-phone"></i><a class="turquoise" href="tel:<?php foreach ($option as $u) { echo $u->telp; } ?>"><?php foreach ($option as $u) { echo $u->telp; } ?></a></li><br><br>
                    <li><i class="fas fa-envelope"></i><a class="turquoise" href="mailto:<?php foreach ($option as $u) { echo $u->email; } ?>"><?php foreach ($option as $u) { echo $u->email; } ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>