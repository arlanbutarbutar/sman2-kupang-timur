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
                    <a href="./"><img src="assets/images/logo.png" width="65" alt="#" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
              <div class="header_information">
                <?php require_once("resources/navbar.php"); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end header inner -->

      <!-- end header -->
      <section class="slider_section">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="assets/images/header1.png"></figure>
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
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="assets/images/header2.png"></figure>
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
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="images_box">
                          <figure><img src="assets/images/header3.png"></figure>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    </div>
  </header>

  <div id="learn" class="learn">
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="titlepage">
            <h2 class="text-center"><strong class="yellow">Jadwal Belajar</strong></h2>
            <?php if (mysqli_num_rows($jadwal_belajar) > 0) { ?>
              <div class="table-responsive mt-4">
                <table class="table table-striped table-hover table-borderless table-sm text-center">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Hari</th>
                      <th scope="col">Jam Mulai - Selesai</th>
                      <th scope="col">Guru Pengajar</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Mata Pelajaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    while ($row_belajar = mysqli_fetch_assoc($jadwal_belajar)) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row_belajar['hari'] ?></td>
                        <td><?= $row_belajar['jam_mulai'] . " - " . $row_belajar['jam_selesai'] ?></td>
                        <td><?= $row_belajar['nama'] . ", " . $row_belajar['gelar'] ?></td>
                        <td><?= $row_belajar['kelas'] ?></td>
                        <td><?= $row_belajar['mapel'] ?></td>
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