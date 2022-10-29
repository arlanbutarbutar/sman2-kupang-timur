<?php require_once("controller/script.php"); ?>
<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head><?php require_once("resources/header.php"); ?></head>
<!-- body -->

<body class="main-layout" style="font-family: 'Montserrat', sans-serif;">
  <!-- header -->
  <header>
    <!-- header inner -->
    <div class="header-top">
      <div class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
              <div class="full">
                <div class="center-desk">
                  <div class="logo">
                    <a href="./"><img src="<?= $baseURL ?>assets/images/logo.png" width="65" alt="#" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
              <div class="header_information">
                <div class="menu-area">
                  <div class="limit-box">
                    <nav class="main-menu">
                      <ul class="menu-area-main">
                        <li> <a class="action text-white" id="beranda" style="cursor: pointer;" onclick="window.location.href='./'">Beranda</a> </li>
                        <li> <a class="action text-white" id="profil" style="cursor: pointer;" onclick="window.location.href='#about'">Profil Sekolah</a> </li>
                        <li> <a class="action text-white" id="jadwal" style="cursor: pointer;" onclick="window.location.href='jadwal'">Jadwal</a> </li>
                        <li> <a class="action text-white" id="guru" style="cursor: pointer;" onclick="window.location.href='guru'">Data Guru</a> </li>
                        <li> <a class="action text-white" id="siswa" style="cursor: pointer;" onclick="window.location.href='siswa'">Data Siswa</a> </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                <div class="mean-last text-center">
                  <a href="auth/" class="font-weight-bold" style="font-size: 16px;">Masuk</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end header inner -->

      <!-- end header -->
      <section class="slider_section">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <?php if (mysqli_num_rows($nama_sekolah) > 0) {
              $row_sekolah = mysqli_fetch_assoc($nama_sekolah); ?>
              <div class="carousel-item active">
                <div class="container-fluid padding_dd">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                        <div class="text-bg">
                          <h1><?= $row_sekolah['judul'] ?></h1>
                          <p><?= $row_sekolah['judul'] ?>, merupakan salah satu Sekolah Menengah Atas Negeri yang ada di Provinsi Nusa Tenggara Timur, Indonesia.</p>
                          <a href="#teacher">Lihat Guru</a>
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="<?= $baseURL ?>assets/images/header1.png"></figure>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container-fluid padding_dd">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                        <div class="text-bg">
                          <h1><?= $row_sekolah['judul'] ?></h1>
                          <p><?= $row_sekolah['judul'] ?>, merupakan salah satu Sekolah Menengah Atas Negeri yang ada di Provinsi Nusa Tenggara Timur, Indonesia.</p>
                          <a href="#teacher">Lihat Guru</a>
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="<?= $baseURL ?>assets/images/header2.png"></figure>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container-fluid padding_dd">
                  <div class="carousel-caption ">
                    <div class="row">
                      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                        <div class="text-bg">
                          <h1><?= $row_sekolah['judul'] ?></h1>
                          <p><?= $row_sekolah['judul'] ?>, merupakan salah satu Sekolah Menengah Atas Negeri yang ada di Provinsi Nusa Tenggara Timur, Indonesia.</p>
                          <a href="#teacher">Lihat Guru</a>
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="<?= $baseURL ?>assets/images/header3.png"></figure>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </section>
    </div>
  </header>

  <div id="teacher" class="learn">
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Data <strong class="yellow">Guru</strong></h2>
            <?php if (mysqli_num_rows($data_guru) > 0) { ?>
              <div class="table-responsive mt-4">
                <table class="table table-striped table-hover table-borderless table-sm text-center">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">TTL</th>
                      <th scope="col">Golongan</th>
                      <th scope="col">TMT <small>(Terhitung Mulai Tanggal)</small></th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Gelar</th>
                      <th scope="col">Tahun Lulus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($data_guru)) { ?>
                      <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $row['nip'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir'] ?></td>
                        <td><?= $row['gol'] ?></td>
                        <td>
                          <?php $tmt = date_create($row['tmt']);
                          echo date_format($tmt, "l, d M Y"); ?>
                        </td>
                        <td><?= $row['jabatan'] ?></td>
                        <td><?= $row['gelar'] ?></td>
                        <td><?= $row['thn_lulus'] ?></td>
                      </tr>
                    <?php $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("resources/footer.php"); ?>
</body>

</html>