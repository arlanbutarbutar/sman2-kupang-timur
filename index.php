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
      <section class="slider_section" style="background-image: url(assets/images/index.jpg); background-size: cover;height: 100vh;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php if (mysqli_num_rows($nama_sekolah) > 0) {
              $row_sekolah = mysqli_fetch_assoc($nama_sekolah); ?>
              <div class="carousel-item active">
                <div class="container-fluid padding_dd">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="text-bg text-center">
                          <h1 class="text-white"><?= $row_sekolah['judul'] ?></h1>
                          <p class="text-white"><?= $row_sekolah['judul'] ?>, merupakan salah satu Sekolah Menengah Atas Negeri yang ada di Provinsi Nusa Tenggara Timur, Indonesia.</p>
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

  <!-- Sambutan Kepsek -->
  <div class="">
    <div class="container mt-5 mb-3">
      <div class="row">
        <div class="col-lg-6">
          <div class="titlepage">
            <h2 style="font-size: 50px;"><strong class="yellow">Sambutan Kepala Sekolah</strong></h2>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="make_img">
                <figure><img src="assets/images/kepsek.jpg" style="width: 100%;"></figure>
                <h4 class="text-dark font-weight-bold mt-3">YULIUS B. TENAWAHANG</h4>
                <P class="text-dark">Kepala Sekolah</P>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="make_text">
                <p class="text-dark">Salam Hormat seluruh warga SMAN 2 Kupang Timur</p><br>
                <p class="text-dark">Website sekolah yang kita miliki ini diharapkan ikut memberi warna dalam upaya menggerakan geliat literasi di sekolah kita. Oleh karena itu, saya harapkan agar semua warga sekolah terutama bapak dan ibu guru serta para murid dapat memanfaatkan keberadaan website ini untuk mempublikasi berbagai tulisannya seperti artikel/opini, esay, cerita pendek, puisi, renungan, catatan perjalanan, dan karya semacamnya.</p>
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <h5 class="font-weight-bold">Visi SMA Negeri 2 Kupang Timur</h5>
              <p class="text-justify">“Mampu menghasilkan lulusan yang beriman, cerdas, terampil, menguasai ipteks, melalui layanan optimal sesuai standar nasional pendidikan”</p>
              <h5 class="font-weight-bold mt-3">Misi SMA Negeri 2 Kupang Timur</h5>
              <p class="text-justify">Untuk mewujudkan cita-cita dan harapan ke depan sebagaimana yang tertuang dalam visi SMA Negeri 2 Kupang Timur diatas, maka dirumuskan misi sebagai berikut :</p>
              <ol type="A">
                <li>
                  <p class="text-justify">A. Menumbuhkembangkan keimanan, kemadirian berdasarkan penghayatan agama dan budaya masyarakat setempat </p>
                </li>
                <li>
                  <p class="text-justify">B. Menjalankan manajemen pendidikan berbasis sekolah (MBS)</p>
                </li>
                <li>
                  <p class="text-justify">C. Menerapkan pendidikan respontif gender</p>
                </li>
                <li>
                  <p class="text-justify">D. Menigkatkan ketersediaan dokumen kurikulum menjadi 100%</p>
                </li>
                <li>
                  <p class="text-justify">E. Meningkatkan kriteria ketuntasan minimal (KKM) semua mata pelajaran mencapai kriteria ketuntasan minimal ideal, yaitu 78</p>
                </li>
                <li>
                  <p class="text-justify">F. Meningkatkan prosentasi lulusan menjadi 100%</p>
                </li>
                <li>
                  <p class="text-justify">G. Mengembangkan kecakapan hidup (life skill) yang berbasis keunggulan lokal</p>
                </li>
                <li>
                  <p class="text-justify">H. Meningkatkan layanan pendidikan berbasis IT menjadi 100%</p>
                </li>
                <li>
                  <p class="text-justify">I. Meningkatkan profesionalisme pendidik dan tenaga kependidikan</p>
                </li>
                <li>
                  <p class="text-justify">J. Meningkatkan disiplin pendidik, tenaga kependidikan dan peserta didik</p>
                </li>
                <li>
                  <p class="text-justify">K. Menumbuhkembangkan sikap kompetitif semua warga sekolah</p>
                </li>
                <li>
                  <p class="text-justify">L. Meningkatkan sarana prasarana kebutuhan dasar peserta didik</p>
                </li>
                <li>
                  <p class="text-justify">M. Mengembangkan sarana perpustakan dengan rasio satu buku : 1 peserta didik per mata pelajaran</p>
                </li>
                <li>
                  <p class="text-justify">N. Menerapkan sistem informasi manajemen (SIM)</p>
                </li>
                <li>
                  <p class="text-justify">O. Meningkatkan hubungan kemitraan dengan lembaga pemerintah maupun non pemerintah</p>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="titlepage">
            <h2 style="font-size: 50px;"><strong class="yellow">Video Profile Sekolah</strong></h2>
          </div>
          <div class="learn_box">
            <figure>
              <iframe style="width: 100%;" height="450" src="https://www.youtube.com/embed/EIW74vZBDdA?autoplay=0&enablejsapi=0&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Sambutan Kepsek -->

  <?php require_once("resources/footer.php"); ?>
</body>

</html>