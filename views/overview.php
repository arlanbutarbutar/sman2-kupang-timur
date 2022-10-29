<?php require_once("../controller/script.php"); ?>
<div class="tab-content tab-content-basic">
  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
    <div class="row">
      <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between">
          <div>
            <p class="statistics-title">Kelola Pengguna</p>
            <h3 class="rate-percentage"><?= $count_users ?></h3>
            <a href="users" class="text-decoration-none">
              <p class="text-warning d-flex"><i class="bi bi-gear"></i><span style="padding-left: 5px;">Kelola</span></p>
            </a>
          </div>
          <div>
            <p class="statistics-title">Data Guru</p>
            <h3 class="rate-percentage"><?= $count_gurux ?></h3>
            <a href="guru" class="text-decoration-none">
              <p class="text-success d-flex"><i class="bi bi-eye"></i><span style="padding-left: 5px;">Lihat Data Guru</span></p>
            </a>
          </div>
          <div>
            <p class="statistics-title">Data Siswa</p>
            <h3 class="rate-percentage"><?= $count_siswax ?></h3>
            <a href="siswa" class="text-decoration-none">
              <p class="text-success d-flex"><i class="bi bi-eye"></i><span style="padding-left: 5px;">Lihat Data Siswa</span></p>
            </a>
          </div>
          <div class="d-none d-md-block">
            <p class="statistics-title">Profil Sekolah</p>
            <a href="profil-sekolah" class="btn btn-success btn-sm text-white d-flex"><i class="bi bi-building"></i><span style="padding-left: 5px;">Kelola Profil</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>