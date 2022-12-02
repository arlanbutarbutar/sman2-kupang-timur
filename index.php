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
            <?php if (mysqli_num_rows($profil) > 0) {
              $row_profil = mysqli_fetch_assoc($profil); ?>
              <h2 style="font-size: 50px;"><strong class="yellow">Profil Sekolah</strong></h2>
              <p><?= $row_profil['isi'] ?></p>
              <h2 style="font-size: 50px;"><strong class="yellow">Fasilitas Sekolah</strong></h2>
              <p><?= $row_profil['fasilitas'] ?></p>
              <h2 style="font-size: 50px;"><strong class="yellow">Ruang Belajar</strong></h2>
              <div class="d-felx">
                <p>10 IPA : <?= $row_profil['rombel_ipa10'] ?> ruang kelas</p>
                <p style="margin-top: -15px;">10 IPS : <?= $row_profil['rombel_ips10'] ?> ruang kelas</p>
                <p style="margin-top: -15px;">11 IPA : <?= $row_profil['rombel_ipa11'] ?> ruang kelas</p>
                <p style="margin-top: -15px;">11 IPS : <?= $row_profil['rombel_ips11'] ?> ruang kelas</p>
                <p style="margin-top: -15px;">12 IPA : <?= $row_profil['rombel_ipa12'] ?> ruang kelas</p>
                <p style="margin-top: -15px;">12 IPS : <?= $row_profil['rombel_ips12'] ?> ruang kelas</p>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="about-box">
            <figure><img src="assets/images/profil.jpeg" alt="#" /></figure>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end abouts -->

  <!-- Video -->
  <div id="video" class="learn">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="learn_box">
            <figure>
              <iframe style="width: 100%;" height="450" src="https://www.youtube.com/embed/c7EtH692CwQ?autoplay=0&enablejsapi=0&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Video -->

  <!-- Sambutan Kepsek -->
  <div class="make">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2 class="text-white" style="font-size: 50px;">Sambutan Kepala Sekolah</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
          <div class="make_text">
            <p>Salam Hormat seluruh warga SMAN 2 Kupang Timur</p><br>
            <p>Website sekolah yang kita miliki ini diharapkan ikut memberi warna dalam upaya menggerakan geliat literasi di sekolah kita. Oleh karena itu, saya harapkan agar semua warga sekolah terutama bapak dan ibu guru serta para murid dapat memanfaatkan keberadaan website ini untuk mempublikasi berbagai tulisannya seperti artikel/opini, esay, cerita pendek, puisi, renungan, catatan perjalanan, dan karya semacamnya.</p>
          </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-center">
          <div class="make_img">
            <figure><img src="assets/images/kepsek.jpg" style="width: 70%;"></figure>
            <h4 class="text-white font-weight-bold mt-3">YULIUS B. TENAWAHANG</h4>
            <P class="text-white">Kepala Sekolah</P>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Sambutan Kepsek -->

  <?php require_once("resources/footer.php"); ?>
</body>

</html>