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
                          <a href="#about">Baca Lebih</a>
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
                          <a href="#about">Baca Lebih</a>
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
                          <a href="#about">Baca Lebih</a>
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

  <!-- about  -->
  <div id="about" class="about">
    <div class="container">
      <div class="row mt-5">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="about-box">
            <h2>Profil <strong class="yellow"> Sekolah</strong></h2>
            <?php if (mysqli_num_rows($profil) > 0) {
              $row_profil = mysqli_fetch_assoc($profil); ?>
              <p><?= $row_profil['isi'] ?></p>
            <?php } ?>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="about-box">
            <figure><img src="<?= $baseURL ?>assets/images/profil.png" alt="#" /></figure>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end abouts -->

  <!-- our -->
  <div id="important" class="important">
    <div class="important_bg mt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col col-lg-2">
            <div class="important_box">
              <a href="guru" style="background: none;border: 0;">
                <h3><?= $count_guru ?></h3>
                <span>Guru</span>
              </a>
            </div>
          </div>
          <div class="col col-lg-2">
            <div class="important_box">
              <a href="siswa" style="background: none;border: 0;">
                <h3><?= $count_siswa ?></h3>
                <span>Siswa</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end our -->

  <?php require_once("resources/footer.php"); ?>
</body>

</html>